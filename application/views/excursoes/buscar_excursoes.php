
  <script type="text/javascript" src="<?php echo base_url('assets/js/valida_buscar_excursao.js'); ?>"></script>   <!-- Valida Formulários -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/cidade_estado.js'); ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/.css'); ?>"> 

  <form class="ui form" method="POST" id="form_pesquisar" style="margin-top: 1.5em" action="<?php echo site_url('pesquisar_excursoes');?>"> 
    <div style="float: left; width: 100%">
      <h2 id="" class="ui dividing header"><span style="float: left; margin-right: 50%"> Excursões Atuais</span>
        <div class="fields" style="float: left; margin-left: 29%; margin-top: -2.5em">
          <div class="field" style="font-size: 0.6em; ">
            <div class="">
              <div class="">
                <label id="" style="">Data inicial</label>
              </div>
            </div>
            <div class="fields">
              <div id="" style="" class="ui left icon input campo_home">
                <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="filtros[data_ini]" id="" type="date" placeholder=""
                value="<?php
                if (isset($this->session->userdata('filtros')['data_ini']))
                {
                  echo $this->session->userdata('filtros')['data_ini'];
                }?>">
                <i class="calendar icon"></i>
              </div>
            </div>
          </div>
          <div class="field" style="font-size: 0.6em;">
            <div class="">
              <div class="">
                <label id="" style="">Data final </label>
              </div>
            </div>
            <div class="fields">
              <div id="" style="" class="ui left icon input campo_home">
                <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="filtros[data_fin]" id="" type="date" placeholder=""
                value="<?php
                if (isset($this->session->userdata('filtros')['data_fin']))
                {
                  echo $this->session->userdata('filtros')['data_fin'];
                }?>">
                <i class="calendar icon"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="ui icon input" style="float: ;font-size: 0.6em; width: 30%; ">
          <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" type="text" placeholder="Busque as excursões pelo nome e intervalo de datas" name="filtros[nome]" id="input_pesquisa"
          value="<?php if (isset($this->session->userdata('filtros')['nome']))
          {
            echo $this->session->userdata('filtros')['nome'];
          }?>">
          <i id="btn_pesquisar" class="circular search link icon"></i>
        </div>
      </h2>
    </div>
    <script type="text/javascript">
      // function ue()
      // {
      //   alert("ue");
      // }
    </script>
    <div id="" class="" style="width: 100%; float: left; margin-top: -1em; margin-bottom: 1em">
  <?php 
    if (isset($msg))
    {
  ?>
      <div class="ui icon message">
        <i class="Info Circle icon"></i>
        <div class="content">
          <div class="header">
            Não há excursões
          </div>
        <?php 
          if (isset($pesq))
          {
            ?>
            <p>Não há nenhuma excursão com os filtros pesquisados, caso queira adicionar uma nova excursão <a style="text-decoration: underline;" href="<?php echo site_url('add_excursao');?>"> clique aqui.</a></p>   
    <?php } 
          else
          {
        ?>
          <p>Não há nenhuma excursão, caso queira adicionar uma nova excursão <a style="text-decoration: underline;" href="<?php echo site_url('add_excursao');?>"> clique aqui.</a></p>  
        <?php 
          }
        ?>
          </div>
        </div>
  <?php } ?>

        <div class="ui three stackable doubling cards">
          <?php
          foreach ($excursoes -> result() as $linha)
          {
            $data = new DateTime($linha->data_part);
            $data = $data -> format("d/m/Y");
            ?>
            <div class="ui card" style="">
              <div class="content">
               <a href="<?php $segments = array('ver_detalhes_excursao', $linha->id_excursao);echo site_url($segments); 
               ?>" class="header" style="font-size: 1.2em" id="titulo"><?= $linha->nome?></a>
             </div>
             <div class="image" id="img_exc" onclick="">
              <img 
              src="<?php 
              if(isset($linha->url_foto) && file_exists($linha->url_foto))
              {
                echo base_url($linha->url_foto);
              }
              else
              {
                echo base_url('assets/img/excursoes/excursao_padrao.png');
              }?>">
              <input type="hidden" id="id_exc" value="<?php echo $linha->id_excursao ?>">
            </div>
            <div class="content" style="margin-top: -0.5em">
              <span style="color: black; font-size: 1em; font-weight: bold;">Saindo: </span>
              <div class="meta">
                <span class="date"><?= $data." - ".$linha->horario_part;?></span>
              </div>
              <div class="description">
                <p id="titulo"><?= $linha->endereco_part;?></p>
                <p><?= $linha->cidade_nome." - ".$linha->sigla;?></p>
              </div>
            </div>
            <div class="extra content" style="margin-top: -0.7em">
              <a>
                <i class="user icon"></i>
                <?= $linha->vagas_disp." vagas";?>
              </a>
              <div class="right floated" style="color: black"><?php echo "R$".$linha->valor?></div>
              <a href="<?php $segments = array('ver_detalhes_excursao', $linha->id_excursao);echo site_url($segments); 
              ?>"><div style="width: 100%; margin-top: 0.7em" id="" class="ui blue labeled icon button">
                Ver mais
                <i class="unhide icon"></i>
              </div></a>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>    
  </form>
  <input type="hidden" value="<?php echo $pesq; ?>" id="input_pag">
  <?php
  if (isset($pagination))
  {
    ?>

    <table class="ui celled table">
      <tfoot style="">
        <tr><th colspan="">
          <?php
          echo $pagination;
          ?>
        </th>
      </tr></tfoot>
    </table>
    <?php
  }?>
  </div>



