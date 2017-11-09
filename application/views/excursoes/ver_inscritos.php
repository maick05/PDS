  <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/valida_detalhes_excursao.js'); ?>"></script> -->   <!-- Valida Formulários -->
  <script type="text/javascript" src="<?php echo base_url('assets/css/style.css'); ?>"></script> 
  <script type="text/javascript" src="<?php echo base_url('assets/js/pagseguro.lightbox.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js');?>"></script> 
  <script src="<?php echo base_url('semantic/dist/semantic.min.js');?>"></script> <!-- JavaScript Semantic -->

  <h2 id="" class="ui dividing header">Ver inscritos da excursão</h2>
  <?php
  if(isset($msg))
  {
    ?>
    <div style="display: block;" class="ui <?php echo "green"; ?> success message">
      <div class="header">
        Parabéns
      </div>
      <p style=""><?php echo $msg; ?></p>
    </div>
    <?php
  }
  ?>
  <table class="ui celled table">
    <thead>
      <tr><th>Nome</th>
        <th>Telefone</th>
        <th>Celular</th>
        <th>Email</th>
        <th>Situação</th>
        <th>Pagseguro</th>
        <th></th>
      </tr></thead>
      <tbody>
       <?php
       foreach ($inscritos -> result() as $linha)
       {
        ?>
        <tr>
          <td>
            <h4 class="ui image header">
              <img src="
              <?php 
              if(isset($linha->url_foto) && file_exists($linha->url_foto))
              {
                echo $linha->url_foto;
              }
              else
              {
                echo "assets/img/usuarios/user.jpg";
              }
              ?>
              " class="ui mini rounded image">
              <div class="content">
                <?php echo $linha->nome; ?>
              </div>
            </div>
          </h4></td>
          <td>
            <?php echo $linha->telefone; ?>
          </td>
          <td>
            <?php echo $linha->celular; ?>
          </td>
          <td>
            <?php echo $linha->email; ?>
          </td>
          <td>
            <?php echo $linha->status; ?>
          </td>
          <td>
            <?php
            if ($linha->insc_pag) 
            {
            ?>
            <i class="check icon"></i>
            <?php
            }
            ?>
          </td>
          <td>
            <?php
            if (!$linha->insc_pag) 
            {
              if ($linha->status == "pendente")
              {
                ?>
                <form action="<?php echo site_url('confirmar_inscricao');?>" id="form_conf" method="POST">
                  <input type="hidden" name="id_inscricao" value="<?php echo $linha->id_inscricao;?>">
                  <input type="hidden" name="id_excursao" value="<?php echo $linha->id_exc;?>">
                  <button id="btn_conf_insc" class="ui icon green button">
                    <i class="check icon"></i>
                  </button> 
                </form>
                <?php
              }
              else
              {
              ?>
                <form action="<?php echo site_url('cancelar_inscricao_conf');?>" id="form_canc" method="POST">
                  <input type="hidden" name="id_inscricao" value="<?php echo $linha->id_inscricao;?>">
                  <input type="hidden" name="id_excursao" value="<?php echo $linha->id_exc;?>">
                  <button class="ui icon red button">
                  <i class="cancel icon"></i>
                  </button> 
                </form>
              <?php
              }
            }
      ?>
    </td>
  </tr>
  <?php
}
?>
</tbody>
</table>

</div>


