<?php

    require 'config/config.php';
    require 'libraries/PHPMailer.php';

if(!isset($_SESSION))
 {
   session_start();
 }

$dsn = 'mysql:host=localhost;dbname=u288492055_food;charset=utf8';
$usuario = 'root';
$pass = '';

$pdo = new PDO($dsn, $usuario, $pass);

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
            $mail->SMTPAuth = true;
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
            $_SESSION['erros'][] = "Email de verificação não foi enviado! \n" . $mail->ErrorInfo;
        } else {
           $_SESSION['msg_sucesso'][] = "Cadastro realizado com sucesso, verifique seu email e siga as instruções";
            return true;
        }
}

function registra_usuario($nome,$cpf,$email,$telefone,$celular,$usuario,$senha,$confirma_senha)
{

	$usuario  = trim($usuario);
    $email = trim($email);
    $cpf = trim($cpf);

    global $pdo;

    $pesquisa = "SELECT login, cpf, email from usuarios
    		      WHERE login = :login OR email = :email OR cpf = :cpf";

    $verifica = $pdo->prepare($pesquisa);
    $verifica->bindParam('login',$usuario);
    $verifica->bindParam('email',$email);
    $verifica->bindParam('cpf',$cpf);
    $verifica->execute();

    $count = $verifica->fetch();

    if($verifica->rowCount() == 1){
    	if($count['login'] == $usuario) {
    		$_SESSION['erros'][] = "Usuario Já cadastrado";
    	}
        if ($count['email'] == $email){
    		$_SESSION['erros'][] = "Email já cadastrado";
    	}
        if ($count['cpf'] == $cpf){
    		$_SESSION['erros'][] = "CPF ja cadastrado";
    	}
    }

    if($senha != $confirma_senha){
        $_SESSION['erros'][] = "As senhas não conferem";
        return false;
    }

    if($senha == $confirma_senha) {

        $senha = sha1($_POST['senha']);
        $senha_hash = hash('sha512',$senha);

            $hash_ativar_conta = NULL;
            $data =  date("Y-m-d H:i:s");

	$sql = "INSERT INTO usuarios (login,senha,email,nome,cpf,telefone,celular,usr_ativo,hash_ativar_conta,ip_registro,data_registro)
				 VALUES (:login,:senha,:email,:nome,:cpf,:telefone,:celular,1,:hash_ativar_conta,:ip_registro,:data)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('login',$usuario);
	$cmd->bindParam('senha',$senha_hash);
	$cmd->bindParam('email',$email);
	$cmd->bindParam('nome',$nome);
	$cmd->bindParam('cpf',$cpf);
	$cmd->bindParam('telefone',$telefone);
	$cmd->bindParam('celular',$celular);
	$cmd->bindParam('hash_ativar_conta',$hash_ativar_conta);
	$cmd->bindParam('ip_registro', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
    $cmd->bindParam('data',$data);
	$cmd->execute();

	$id_usuario = $pdo->lastInsertId();

    $_SESSION['id_usuario'] = $id_usuario;

    }
}

function insere_subscribe($email)
{
    global $pdo;
try{
	$sql = "INSERT INTO subscribes (email)
				 VALUES (:email)";

	$cmd = $pdo->prepare($sql);
	$cmd->BindParam('email',$email);
	$cmd->execute();

}catch(PDOException $e){
 	 echo $e->getMessage();
    }
}

function verifica_usuario($id_usuario, $hash_ativar_conta)
{
	global $pdo;

    $verifica = "SELECT id_usuario, hash_ativar_conta FROM usuarios
                  WHERE id_usuario = :id_usuario AND hash_ativar_conta = :hash_ativar_conta";

    $stmt = $pdo->prepare($verifica);
    $stmt->bindParam('id_usuario', $id_usuario);
    $stmt->bindParam('hash_ativar_conta', $hash_ativar_conta);
    $stmt->execute();

    $count = $stmt->fetch();

    if($stmt->rowCount() == 0){
        $_SESSION['erros'] = "Erro ao ativar conta, tente novamente, talvez ela já está ativa, se o erro persistir, entre em contato conosco.";
    } else {

try{
     $sql = "UPDATE usuarios SET usr_ativo = 1, hash_ativar_conta = NULL
     		 WHERE id_usuario = :id_usuario AND hash_ativar_conta = :hash_ativar_conta";

     $cmd = $pdo->prepare($sql);
     $cmd->bindParam('id_usuario',$id_usuario);
     $cmd->bindParam('hash_ativar_conta',$hash_ativar_conta);
     $cmd->execute();

     $_SESSION['msg_sucesso'] = "Conta Ativada com Sucesso";

}catch(PDOException $e){
 	 echo $e->getMessage();
	}
  }
}

function busca_dados_endereco($cep)
{
    global $pdo;
try{
    $sql = "SELECT c.nome as nome_cidade,
                   c.cep as cep,
                   e.sigla as sigla

            FROM cidades c
            INNER JOIN estados e
            ON c.id_estado = e.cod_estados where cep = :cep";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('cep',$cep);
    $cmd->execute();

    return $cmd->fetch();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function insere_endereco($logradouro,$numero,$bairro,$complemento,$referencia,$estado,$cidade,$cep,$id_usuario)
{
    global $pdo;
try{
    $sql = "INSERT INTO enderecos (logradouro,numero,bairro,complemento,referencia,estado,cidade,cep,id_usuario)
            VALUES(:logradouro, :numero, :bairro, :complemento, :referencia, :estado, :cidade, :cep, :id_usuario)";

    $cmd = $pdo->prepare($sql);
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

function verificaCadastrado()
{
    if(isset($_SESSION['id_usuario']) AND $_SESSION['id_usuario'] > 0) {
        $_SESSION['cadastrado'] = 1;
    } else {
       unset($_SESSION['cadastrado']);
    }

    if(isset($_SESSION['cadastrado']) AND $_SESSION['cadastrado'] == 1){
        return true;
    }
}

function deleta_usuario_invalido($id_usuario)
{
    global $pdo;
try{
    $sql = "DELETE from usuarios where id_usuario = :id_usuario";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('id_usuario',$id_usuario);
    $cmd->execute();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function buscaCodAtivacao($id_usuario)
{
    global $pdo;
try{
    $sql = "SELECT email, hash_ativar_conta FROM usuarios WHERE id_usuario = :id_usuario";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('id_usuario',$id_usuario);
    $cmd->execute();

    return $cmd->fetch();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function reenviaEmailConfirmacao($id_usuario, $email, $hash_ativar_conta)
{
        $mail = new PHPMailer;

        if (EMAIL_USE_SMTP) {
            $mail->IsSMTP();

            $mail->SMTPAuth = EMAIL_SMTP_AUTH;

            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
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

        $mail->Body = EMAIL_VERIFICATION_CONTENT.' '.$link;

        if(!$mail->Send()) {
            $_SESSION['erros'] = "Email de verificação não foi enviado! \n" . $mail->ErrorInfo;
        } else {
           $_SESSION['msg_sucesso'] = "Enviamos o link de ativação novamente. Caso não receba, procure no Lixo eletronico ou na pasta de Spam. Qualquer problema, por favor não hesite em nos chamar <a href='../contato.php'>clicando aqui</a> ";
            return true;
        }
}

function buscaDadosCadastrais($id_usuario,$login)
{
    global $pdo;
try{
    $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND login = :login";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('id_usuario',$id_usuario);
    $cmd->bindParam('login',$login);
    $cmd->execute();

    return $cmd->fetch();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function buscaDadosCadastraisGET($id_usuario,$hash_senha)
{
    global $pdo;
try{
    $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND senha = :hash_senha";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('id_usuario',$id_usuario);
    $cmd->bindParam('hash_senha',$hash_senha);
    $cmd->execute();

    return $cmd->fetch();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function atualizaDadosCadastrais($nome, $cpf, $email, $celular, $telefone, $id_usuario)
{
    global $pdo;
try{
    $sql = "UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email, celular = :celular,
                telefone = :telefone WHERE id_usuario = :id_usuario";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('nome',$nome);
    $cmd->bindParam('cpf',$cpf);
    $cmd->bindParam('email',$email);
    $cmd->bindParam('celular',$celular);
    $cmd->bindParam('telefone',$telefone);
    $cmd->bindParam('id_usuario',$id_usuario);
    $cmd->execute();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}