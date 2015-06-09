<?php
if(!isset($_SESSION))
{
  session_start();
}
if(isset($_SESSION['msg_sucesso'])){ ?>
 <div class="alert alert-success alert-dismissible" role="alert">
  <?php foreach($_SESSION['msg_sucesso'] as $msg_sucesso): ?>
      <strong>Sucesso: </strong> <?= $msg_sucesso;?> </br>
  <?php endforeach; ?>
    </div>
<?php  }
unset($_SESSION['msg_sucesso']);

if(isset($_SESSION['erros'])){ ?>
 <div class="alert alert-danger alert-dismissible" role="alert">
  <?php foreach($_SESSION['erros'] as $erros): ?>
      <strong>Erro: </strong> <?= $erros;?> </br>
  <?php endforeach; ?>
    </div>
<?php
}
unset($_SESSION['erros']);

if(isset($_SESSION['mensagem'])){ ?>
 <div class="alert alert-warning alert-dismissible" role="alert">
  <?php foreach($_SESSION['mensagem'] as $aviso): ?>
      <strong>Atenção: </strong> <?= $aviso;?> <br>
  <?php endforeach; ?>
    </div>
<?php
}
unset($_SESSION['mensagem']);