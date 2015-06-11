<?php

    require 'config/config.php';
    require 'libraries/PHPMailer.php';

function sendVerificationEmail($id_usuario, $email, $hash_ativar_conta)
{
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors
            //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;

        $link = EMAIL_VERIFICATION_URL.'?id='.urlencode($id_usuario).'&verification_code='.urlencode($hash_ativar_conta);

        // the link to your register.php, please set this value in config/email_verification.php
        $mail->Body = EMAIL_VERIFICATION_CONTENT.' '.$link;

        if(!$mail->Send()) {
            $_SESSION['erros'] = "Email de verificação não foi enviado! Erro: " . $mail->ErrorInfo;
            return false;
        } else {
           $_SESSION['msg_sucesso'] = "Email enviado com sucesso, verifique seu email e siga as instruções";
            return true;
        }
}

class Registro
{

    private $conexao = null;

    public function __construct()
    {
          if(!isset($_SESSION))
         {
             session_start();
         }

        if (isset($_POST['checkbox']))
        {
            if($_POST['checkbox'] == 'on'){
                $this->insere_subscribe($_POST['email']);
            }
        }

        if (isset($_POST["nome"]) && isset($_POST['cpf']) && isset($_POST['email'])
         && isset($_POST['usuario']) && isset($_POST['senha']) && isset($_POST['confirma_senha']))
        {
            $this->registra_usuario($_POST['nome'],
                                    $_POST['cpf'],
                                    $_POST['email'],
                                    $_POST['telefone'],
                                    $_POST['celular'],
                                    $_POST['usuario'],
                                    $_POST['senha'],
                                    $_POST['confirma_senha']
                                   );
        }
    }

private function conexao()
{
        if ($this->conexao != null) {
            return true;
        } else {
            try {
                $dsn = 'mysql:host=mysql.hostinger.com.br;dbname=u288492055_food;charset=utf8';
                $usuario = 'u288492055_admin';
                $pass = '3eomu7hl69';
                $this->conexao = new PDO($dsn, $usuario, $pass);
                return true;
            } catch (PDOException $e) {
               $_SESSION['erros'] = 'Erro ao Conectar-se ao Banco de Dados' . $e->getMessage();
            }
    }
    return false;
}

private function registra_usuario($nome,$cpf,$email,$telefone,$celular,$usuario,$senha,$confirma_senha)
{

	$usuario  = trim($usuario);
    $email = trim($email);
    $cpf = trim($cpf);

    if($senha == $confirma_senha){
        $senha = sha1($_POST['senha']);
        $senha_hash = hash('sha512',$senha);
    } else {
        $_SESSION['erros'] = "As senhas não conferem";
    }

if($this->conexao()){

    $pesquisa = "SELECT login, cpf, email from usuarios
    		 WHERE login = :login OR email = :email OR cpf = :cpf";

    $verifica = $this->conexao->prepare($pesquisa);
    $verifica->bindParam('login',$usuario);
    $verifica->bindParam('email',$email);
    $verifica->bindParam('cpf',$cpf);
    $verifica->execute();

    $count = $verifica->fetch();
}

    if($verifica->rowCount() == 1){
    	if($count['login'] == $usuario) {
    		$_SESSION['erros'] = "Usuario Já cadastrado";
    	} elseif ($count['email'] == $email){
    		$_SESSION['erros'] = "Email já cadastrado";
    	} elseif ($count['cpf'] == $cpf){
    		$_SESSION['erros'] = "CPF ja cadastrado";
    	}
    } else {

    $hash_ativar_conta = sha1(uniqid(mt_rand(), true));

if($this->conexao()){

	$sql = "INSERT INTO usuarios (login,senha,email,nome,cpf,telefone,celular,hash_ativar_conta,ip_registro,data_registro)
				 VALUES (:login,:senha,:email,:nome,:cpf,:telefone,:celular,:hash_ativar_conta,:ip_registro,CURRENT_TIMESTAMP)";

	$cmd = $this->conexao->prepare($sql);
	$cmd->bindParam('login',$usuario);
	$cmd->bindParam('senha',$senha_hash);
	$cmd->bindParam('email',$email);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('cpf',$cpf);
	$cmd->bindParam('telefone',$telefone);
	$cmd->bindParam('celular',$celular);
	$cmd->bindParam('hash_ativar_conta',$hash_ativar_conta);
	$cmd->bindParam('ip_registro', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
	$cmd->execute();
}
	$id_usuario = $this->conexao->lastInsertId();

    $_SESSION['id_usuario'] = $id_usuario;

   sendVerificationEmail($id_usuario, $email, $hash_ativar_conta);

        }
}

public function insere_subscribe($email)
{
    if($this->conexao()){
try{
	$sql = "INSERT INTO subscribes (email)
				 VALUES (:email)";

	$cmd = $this->conexao->prepare($sql);
	$cmd->BindParam('email',$email);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
    	}
    }
}

public function verifica_usuario($id_usuario, $hash_ativar_conta)
{
	if($this->conexao()){
try{
     $sql = "UPDATE usuarios SET usr_ativo = 1, hash_ativar_conta = NULL
     		 WHERE id_usuario = :id_usuario AND hash_ativar_conta = :hash_ativar_conta";

     $cmd = $this->conexao->prepare($sql);
     $cmd->bindParam('id_usuario',$id_usuario);
     $cmd->bindParam('hash_ativar_conta',$hash_ativar_conta);
     $cmd->execute();

     $_SESSION['msg_sucesso'] = "Conta Ativada com Sucesso";

}catch(PDOException $e){
 	 echo $e->getMessage();
	   }
    } else {
        $_SESSION['erros'] = "Erro ao ativar conta";
    }
}

public function busca_dados_endereco($cep)
{
    if($this->conexao()){
try{
    $sql = "SELECT c.nome as nome_cidade,
                   c.cep as cep,
                   e.sigla as sigla

            FROM cidades c
            INNER JOIN estados e
            ON c.id_estado = e.cod_estados where cep = :cep";

    $cmd = $this->conexao->prepare($sql);
    $cmd->bindParam('cep',$cep);
    $cmd->execute();

    return $cmd->fetch();

}catch(PDOException $e){
     echo $e->getMessage();
        }
    }
}

private function insere_endereco($logradouro,$numero,$bairro,$complemento,$referencia,$estado,$cidade,$cep,$id_usuario)
{
    if($this->conexao()){
try{
    $sql = "INSERT INTO enderecos (logradouro,numero,bairro,complemento,referencia,estado,cidade,cep,id_usuario)
            VALUES(:logradouro, :numero, :bairro, :complemento, :referencia, :estado, :cidade, :cep, :id_usuario)";

    $cmd = $this->conexao->prepare($sql);
    $cmd->bindParam(':logradouro',$logradouro);
    $cmd->bindParam(':numero',$numero);
    $cmd->bindParam(':bairro',$bairro);
    $cmd->bindParam(':complemento',$complemento);
    $cmd->bindParam(':referencia',$referencia);
    $cmd->bindParam(':estado',$estado);
    $cmd->bindParam(':cidade',$cidade);
    $cmd->bindParam(':cep',$cep);
    $cmd->bindParam(':id_usuario',$id_usuario);
    $cmd->execute();

}catch(PDOException $e){
     echo $e->getMessage();
            }
        }
    }

public function verificaCadastrado()
{
    if(isset($_SESSION['id_usuario'])) {
        $this->msg_sucesso = "Cadastro Realizado com Sucesso, verifique seu e-mail e siga as instruções";
        $_SESSION['cadastrado'] = 1;
    } else {
       $_SESSION['erros'] = "Erro: Não foi possivel realizar o cadastro, verifique os dados e tente novamente";
    }

    if(isset($_SESSION['cadastrado']) AND $_SESSION['cadastrado'] == 1){
        return true;
    } else {
        $_SESSION['erros'] = "Não foi possivel concluir o cadastro. ERRO 1018";
        }
     }
}
