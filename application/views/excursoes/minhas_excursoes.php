  <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/valida_minhas_excursoes.js'); ?>"></script> -->   <!-- Valida Formulários -->
  <script type="text/javascript" src="<?php echo base_url('assets/css/style.css'); ?>"></script> 
  <script type="text/javascript" src="<?php echo base_url('assets/js/pagseguro.lightbox.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js');?>"></script> 
  <script src="<?php echo base_url('semantic/dist/semantic.min.js');?>"></script> <!-- JavaScript Semantic -->

  <h2 id="" class="ui dividing header">Excursões que criei</h2>
  <table class="ui celled table">
    <thead>
      <tr><th>Nome</th>
        <th>Transporte</th>
        <th>Data e hora de Partida</th>
        <th>Cidade de partida</th>
        <th>Valor</th>
        <th>Vagas</th>
        <th></th>
      </tr></thead>
      <tbody>
       <?php
       foreach ($excursoes_criei -> result() as $linha)
       {
        ?>
        <tr>
          <td>
            <?php echo $linha->nome; ?>
          </td>
          <td>
            <?php echo $linha->tipo_transporte; ?>
          </td>
          <td>
            <?php 
            $data = new DateTime($linha->data_part);
            $data = $data->format("d/m/Y");
            echo $data." - ".$linha->horario_part; 
            ?>
          </td>
          <td>
            <?php echo $linha->cidade_nome." - ".$linha->sigla; ?>
          </td>
          <td>
            <?php echo "R$".$linha->valor; ?>
          </td>
          <td>
            <?php echo $linha->vagas."/".$linha->vagas_disp; ?>
          </td>
          <td>
            <a href="<?php echo site_url('ver_detalhes_excursao/'.$linha->id_exc);?>"><div style="margin-left: 0.2em" id="btn_ver_c" class="ui right blue labeled icon button">
              Ver mais
              <i class="Unhide icon"></i>
            </div></a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>

  <h2 id="" class="ui dividing header">Excursões que participo</h2>
  <table class="ui celled table">
    <thead>
      <tr><th>Nome</th>
        <th>Transporte</th>
        <th>Data e hora de Partida</th>
        <th>Cidade de partida</th>
        <th>Valor</th>
        <th>Vagas</th>
        <th>Criador</th>
        <th></th>
      </tr></thead>
      <tbody>
       <?php
       foreach ($excursoes_participo -> result() as $linha)
       {
        ?>
        <tr>
          <td>
            <?php echo $linha->nome; ?>
          </td>
          <td>
            <?php echo $linha->tipo_transporte; ?>
          </td>
          <td>
            <?php 
            $data = new DateTime($linha->data_part);
            $data = $data->format("d/m/Y");
            echo $data." - ".$linha->horario_part; 
            ?>
          </td>
          <td>
            <?php echo $linha->cidade_nome." - ".$linha->sigla; ?>
          </td>
          <td>
            <?php echo "R$".$linha->valor; ?>
          </td>
          <td>
            <?php echo $linha->vagas."/".$linha->vagas_disp; ?>
          </td>
          <td>
            <?php echo $linha->nome_criador; ?>
          </td>
          <td>
            <a href="<?php echo site_url('ver_detalhes_excursao/'.$linha->id_exc);?>"><div style="margin-left: 0.2em" id="btn_ver_c" class="ui right blue labeled icon button">
              Ver mais
              <i class="Unhide icon"></i>
            </div></a>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>

</div>


