<?php

    require 'config/config.php';
    require 'libraries/PHPMailer.php';

if(!isset($_SESSION))
 {
   session_start();
 }

$dsn = "mysql:host=localhost;dbname=u288492055_food;charset=utf8;TIME_ZONE='-03:00'";
$usuario = "root";
$pass = "";


$pdo = new PDO($dsn, $usuario, $pass);

function sendVerificationEmail($id_usuario, $email, $hash_ativar_conta)
{
        $mail = new PHPMailer;

        if (EMAIL_USE_SMTP) {

            $mail->IsSMTP();

            $mail->SMTPAuth = true;

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

        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;

        $link = EMAIL_VERIFICATION_URL.'?id='.urlencode($id_usuario).'&verification_code='.urlencode($hash_ativar_conta);

        // the link to your register.php, please set this value in config/email_verification.php
  $mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="box-sizing: border-box; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; margin: 0">
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body itemscope="" itemtype="http://schema.org/EmailMessage" style="-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; background: #f6f6f6; box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; height: 100%; line-height: 1.6em; margin: 0; width: 100% !important" bgcolor="#f6f6f6"><style type="text/css">
img {
max-width: 100%;
}
body {
-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
}
body {
background-color: #f6f6f6;
}
@media only screen and (max-width: 640px) {
  body {
    padding: 0 !important;
  }
  h1 {
    font-weight: 800 !important; margin: 20px 0 5px !important; font-size: 26px !important;
  }
  h2 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h3 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h4 {
    font-weight: 800 !important; margin: 20px 0 5px !important;
  }
  h1 {
    font-size: 22px !important;
  }
  h2 {
    font-size: 18px !important;
  }
  h3 {
    font-size: 16px !important;
  }
  .container {
    padding: 0 !important; width: 100% !important;
  }
  .content {
    padding: 0 !important;
  }
  .content-wrap {
    padding: 10px !important;
  }
  .invoice {
    width: 100% !important;
  }
}
</style>

<table class="body-wrap" style="background: #f6f6f6; box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; width: 100%" bgcolor="#f6f6f6"><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; vertical-align: top" valign="top"></td>
        <td class="container" width="600" style="box-sizing: border-box; clear: both !important; display: block !important; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0 auto; max-width: 600px !important; vertical-align: top" valign="top">
            <div class="content" style="box-sizing: border-box; display: block; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0 auto; max-width: 600px; padding: 20px">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="background: #fff; border-radius: 3px; border: 1px solid #e9e9e9; box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0" bgcolor="#fff"><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td class="alert alert-warning" style="background: #9A2526; border-radius: 3px 3px 0 0; box-sizing: border-box; color: #fff; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 500; margin: 0; padding: 20px; text-align: center; vertical-align: top" align="center" bgcolor="#9A2526" valign="top">
                            <h1>GodFood - Delivery</h1>
                        </td>
                    </tr><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td class="content-wrap" style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; padding: 20px; vertical-align: top" valign="top">
                            <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td class="content-block" style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; padding: 0 0 20px; vertical-align: top" valign="top">
                                     <strong style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"> Obrigado por fazer parte do nosso site, esperamos que você seja muito bem atendido pelos nossos restaurantes parceiros. </strong>
                                    </td>
                                </tr><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td class="content-block" style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; padding: 0 0 20px; vertical-align: top" valign="top">
                                         Para que possa desfrutar de todos os nossos serviços, por favor, confirme sua conta clicando no botão abaixo.
                                    </td>
                                </tr><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td class="content-block" style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; padding: 0 0 20px; vertical-align: top" valign="top">
                                        <a href="'.$link.'" class="btn-primary" style="background: #9a2526; border-color: #9a2526; border-radius: 5px; border-style: solid; border-width: 10px 20px; box-sizing: border-box; color: #FFF; cursor: pointer; display: inline-block; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 2em; margin: 0; text-align: center; text-decoration: none; text-transform: capitalize">CONFIRMAR CONTA</a>
                                    </td>
                                </tr><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td class="content-block" style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; padding: 0 0 20px; vertical-align: top" valign="top">
                                        Obrigado pela confiança. 
                    <br /><br />
                    Atenciosamente,
                    <br />
                    Equipe GodFood
                                    </td>
                                </tr></table></td>
                    </tr></table><div class="footer" style="box-sizing: border-box; clear: both; color: #999; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; padding: 20px; width: 100%">
                    <table width="100%" style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><tr style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0"><td class="aligncenter content-block" style="box-sizing: border-box; color: #999; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 12px; margin: 0; padding: 0 0 20px; text-align: center; vertical-align: top" align="center" valign="top"> Não deixe de nos acompanhar no <a href="https://facebook.com/godfooddelivery" target="_blank" style="box-sizing: border-box; color: #999; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 12px; margin: 0; text-decoration: underline">Facebook clicando aqui.</a></td>
                        </tr></table></div></div>
        </td>
        <td style="box-sizing: border-box; font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; font-size: 14px; margin: 0; vertical-align: top" valign="top"></td>
    </tr></table></body>
</html>'
;

        if(!$mail->Send()) {
            $_SESSION['erros'][] = "Email de verificação não foi enviado! \n" . $mail->ErrorInfo;
        } else {
           $_SESSION['msg_sucesso'][] = "Cadastro realizado com sucesso, verifique seu email e siga as instruções";
            return true;
        }
}

function registra_usuario($nome,$cpf,$email,$telefone,$celular,$usuario,$alcunha,$senha,$confirma_senha)
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

            $hash_ativar_conta = sha1(uniqid(mt_rand(), true));
            $data =  date("Y-m-d H:i:s");

	$sql = "INSERT INTO usuarios (login,alcunha,senha,email,nome,cpf,telefone,celular,hash_ativar_conta,ip_registro,data_registro)
				 VALUES (:login,:alcunha,:senha,:email,:nome,:cpf,:telefone,:celular,:hash_ativar_conta,:ip_registro,:data)";

	$cmd = $pdo->prepare($sql);
	$cmd->bindParam('login',$usuario);
  $cmd->bindParam('alcunha',$alcunha);
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

    if($id_usuario > 0){
        sendVerificationEmail($id_usuario, $email, $hash_ativar_conta);
        }
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

function atualizaDadosCadastrais($nome, $celular, $telefone, $id_usuario)
{
    global $pdo;
try{
    $sql = "UPDATE usuarios SET nome = :nome, celular = :celular,
                telefone = :telefone WHERE id_usuario = :id_usuario";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('nome',$nome);
    $cmd->bindParam('celular',$celular);
    $cmd->bindParam('telefone',$telefone);
    $cmd->bindParam('id_usuario',$id_usuario);
    $cmd->execute();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function alteraSenhaUsuario($senha, $id_usuario)
{
    global $pdo;
try{

    $senha1 = sha1($senha);
    $senha_hash = hash('sha512',$senha1);

    $sql = "UPDATE usuarios SET senha = :senha WHERE id_usuario = :id_usuario";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('senha',$senha_hash);
    $cmd->bindParam('id_usuario',$id_usuario);
    $cmd->execute();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function enviaEmailResetSenha($email)
{
    global $pdo;
try{
    $data =  date("Y-m-d H:i:s");
    $reset_hash = sha1(uniqid(mt_rand(), true));

    $sql = "UPDATE usuarios SET senha_reset_hash = :reset_hash, senha_reset_timestamp = :data
                WHERE email = :email";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('reset_hash',$reset_hash);
    $cmd->bindParam('data',$data);
    $cmd->bindParam('email',$email);
    $cmd->execute();

    enviaEmailHash($reset_hash,$email);

}catch(PDOException $e){
     echo $e->getMessage();
    }
}

function enviaEmailHash($reset_hash, $email)
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

        $mail->From = EMAIL_PASSWORDRESET_FROM;
        $mail->FromName = EMAIL_PASSWORDRESET_FROM_NAME;
        $mail->AddAddress($email);
        $mail->Subject = EMAIL_PASSWORDRESET_SUBJECT;

        $link = EMAIL_PASSWORDRESET_URL.'?email='.urlencode($email).'&verification_code='.urlencode($reset_hash);

        $mail->Body = EMAIL_PASSWORDRESET_CONTENT.' '.$link;

        if(!$mail->Send()) {
            $_SESSION['erros'] = "Email de verificação não foi enviado! \n" . $mail->ErrorInfo;
        } else {
           $_SESSION['msg_sucesso'] = "Enviamos o link de ativação novamente. Caso não receba, procure no Lixo eletronico ou na pasta de Spam. Qualquer problema, por favor não hesite em nos chamar <a href='../contato.php'>clicando aqui</a> ";
            return true;
        }
}

function verificaResetSenha($email, $reset_hash, $senha, $confirma_senha)
{
    global $pdo;

try{
    $verifica = "SELECT email, senha_reset_hash FROM usuarios
                  WHERE email = :email AND senha_reset_hash = :reset_hash";

    $stmt = $pdo->prepare($verifica);
    $stmt->bindParam('email', $email);
    $stmt->bindParam('reset_hash', $reset_hash);
    $stmt->execute();

    $count = $stmt->fetch();

    if($stmt->rowCount() == 0){
        $_SESSION['erros'] = "Erro ao recuperar senha, tente novamente, se o erro persistir, entre em contato conosco.";
    } else {

    if($senha != $confirma_senha){
        $_SESSION['erros'] = "As senhas não conferem";
        return false;
    }

    if($senha == $confirma_senha) {

        $senha = sha1($senha);
        $senha_hash = hash('sha512',$senha);

     $sql = "UPDATE usuarios SET senha = :senha_hash, senha_reset_hash = NULL
             WHERE email = :email AND senha_reset_hash = :reset_hash";

     $cmd = $pdo->prepare($sql);
     $cmd->bindParam('senha_hash',$senha_hash);
     $cmd->bindParam('email',$email);
     $cmd->bindParam('reset_hash',$reset_hash);
     $cmd->execute();

     $_SESSION['msg_sucesso'] = "Senha alterada com sucesso!";
    }
}
    }catch(PDOException $e){
            echo $e->getMessage();
        }
}

function insere_subscribe($email)
{
    global $pdo;
try{
    $sql = "INSERT INTO subscribes (email) VALUES (:email)";

    $cmd = $pdo->prepare($sql);
    $cmd->bindParam('email',$email);
    $cmd->execute();

}catch(PDOException $e){
     echo $e->getMessage();
    }
}