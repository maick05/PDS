  <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/valida_ver_inscritos.js'); ?>"></script> -->   <!-- Valida Formulários -->
  <script type="text/javascript" src="<?php echo base_url('assets/css/style.css'); ?>"></script> 
  <script type="text/javascript" src="<?php echo base_url('assets/js/pagseguro.lightbox.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js');?>"></script> 
  <script src="<?php echo base_url('semantic/dist/semantic.min.js');?>"></script> <!-- JavaScript Semantic -->
  <script type="text/javascript">

    function ver_pagamentos(id)
    {
      var table = document.getElementById('tab_pag');
      var row;

      if (table.rows.length > 1) 
      {
        for (var i = 1; i <= table.rows.length; i++) 
        {
            table.deleteRow(0);
        }
      }

      $.post('ver_pagamentos', {id_insc:id}, function(data)
      { 
        result = $.parseJSON(data);
        result.forEach(function(e, i)
        {
          row = table.insertRow(i + 1);
          row.innerHTML = "<td>"+e.data_abertura+"</td> <td>"+e.situacao+"</td><td>"+e.data_hora_modif+"</td>";
        })
        $('#modal_pag').modal('show');
      }); 
    }
  </script>
  <h2 id="" class="ui dividing header">Ver inscritos da excursão</h2>
  <?php
  if(isset($msg))
  {
    ?>
    <div style="display: block;" class="ui <?php echo "green"; ?> success message">
      <div class="header">
        Atenção
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
              <!-- <i class="check icon"></i> -->
              <div class="ui animated fade button" tabindex="0" onclick="ver_pagamentos(<?php echo $linha->id_inscricao;?>)">
                <div class="visible content"><i class="money icon"></i>Pagamentos </div>
                <div class="hidden content"><i class="unhide icon"></i> Visualizar</div>
              </div>
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

  <div class="ui modal" id="modal_pag">
    <div class="header">Transações iniciadas</div>
    <div class="content">
  <table class="ui celled table" id="tab_pag">
    <thead>
      <tr>
        <th>Data de abertura</th>
        <th>Situação</th>
        <th>Data da última atualização</th>
      </tr>
    </thead>
      </table>
      </div>
      <div class="actions" id="actions_rec" style="">
        <div id="btn_pross" class="ui positive button" style="">Ok</div>
      </div>
    </div>
  </div>


