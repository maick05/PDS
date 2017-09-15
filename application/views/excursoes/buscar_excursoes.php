
<script type="text/javascript" src="<?php echo base_url('assets/js/valida_buscar_excursao.js'); ?>"></script>   <!-- Valida Formulários -->
<script type="text/javascript" src="<?php echo base_url('assets/js/cidade_estado.js'); ?>"></script> 
 <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/.css'); ?>"> 
<form class="ui form" method="POST" action="<?php echo site_url('pesquisar_excursoes'); ?>" id="form_pesquisar"> 
  <h2 id="" class="ui dividing header"><span style="float: left; margin-right: 50%"> Excursões Atuais</span>
  <div class="ui icon input" style="float: ;font-size: 0.6em; width: 30%;">
      <input type="text" placeholder="Busque as excursões pelo nome" name="nome">
      <i id="btn_pesquisar" class="circular search link icon"></i>
  </div>
  </h2>
    

    <div id="" class="">
      <div class="ui grid">
<?php

      foreach ($excursoes -> result() as $linha)
      {
        $data = new DateTime($linha->data_part);
        $data = $data -> format("d/m/Y");
?>
        <div class="four wide column">
          <div class="ui card" style="">
            <div class="image">
              <img src="assets/img/excursoes/excursao_padrao.png">
            </div>
            <div class="content">
              <a class="header"><?= $linha->nome;?></a>
              <div class="meta">
                <span class="date"><?= $data." - ".$linha->horario_part;?></span>
              </div>
              <div class="description">
                <p><?= $linha->endereco_part;?></p>
                <p><?= $linha->cidade_nome." - ".$linha->sigla;?></p>
              </div>
            </div>
            <div class="extra content">
              <a>
                <i class="user icon"></i>
                <?= $linha->vagas_disp." vagas";?>
              </a>
            </div>
          </div>
        </div>
<?php
}
?>
      </div>
    </div>    
  </form>
</div>



