<html>
   <head>
      <title>
         Modelo de aplicações
      </title>
   </head>
   <body>
      <h2>Modelo de aplicações</h2>
                              
      <label><b>Permissões:</b></label><br>
      <form action="<?= base_url('autoriza');?>" method="POST">
      <input type="checkbox" name="permissions[]" value="CREATE_CHECKOUTS">Criar transações de pagamento.<br>
      <input type="checkbox" name="permissions[]" value="RECEIVE_TRANSACTION_NOTIFICATIONS">Receber as notificações.<br>
      <input type="checkbox" name="permissions[]" value="DIRECT_PAYMENT">Criar checkout transparente.<br><br>
      <input type="submit" value="Próximo passo">

      </form>
   </body>
</html>