<?php

if(!isset($_SESSION))
{
  session_start();
}
if(isset($_SESSION['msg_sucesso'])){ ?>
 <div class="alert alert-success alert-dismissible" role="alert">
 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong><?= $_SESSION['msg_sucesso'];?> </strong>
    </div>
<?php
}
unset($_SESSION['msg_sucesso']);

if(isset($_SESSION['erros'])){ ?>
 <div class="alert alert-danger alert-dismissible" role="alert">
 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Ops: </strong> <?= $_SESSION['erros']; ?>
    </div>
<?php
}
unset($_SESSION['erros']);

if(isset($_SESSION['mensagem'])){ ?>
 <div class="alert alert-warning alert-dismissible" role="alert">
 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <strong>Atenção: </strong> <?= $_SESSION['mensagem'];?>
    </div>
<?php
}
unset($_SESSION['mensagem']);
