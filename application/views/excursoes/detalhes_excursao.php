  <script type="text/javascript" src="<?php echo base_url('assets/js/valida_detalhes_excursao.js'); ?>"></script>   <!-- Valida Formulários -->
   <script type="text/javascript" src="<?php echo base_url('assets/css/style.css'); ?>"></script> 
   <script type="text/javascript" src="<?php echo base_url('assets/js/pagseguro.lightbox.js');?>"></script>
     <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script> 
     <script src="../../pds/semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
     <form  id="form_criar" class="ui form" style="" method="POST" action="<?php echo site_url('criar_excursao'); ?>" enctype="multipart/form-data"> 
   <h2 id="" class="ui dividing header"><?php echo $excursao['nome']; ?></h2>
    <div class="" style="margin-top: 2em">
      <div class="" style="float: left">
        <label style="" id="" for="btn_img_home" style="float: ">
          <img id="" class="ui medium left floated image" src="../../pds/assets/img/usuarios/user_leg.jpg" style="width: 400px; height: 300px">
          <input name="url_foto" type="file" accept="image/png, image/jpeg, image/jpg" id="btn_img_home" multiple>
        </label>
      </div>
      <div class="ui grid">
        <div class="row">
          <div class="six wide column">
            <span id="destaq" style="">Tipo de transporte:</span>
            <span id="norm" style=""> <?php echo $excursao['tipo_transporte']; ?></span>
          </div>
          <div class="three wide column">
            <span id="destaq" style="">Categoria:</span>
            <span id="norm" style=""> <?php echo $excursao['categoria']; ?></span>
          </div>
        </div>
        <div class="row">
          <div class="six wide column">
            <span id="destaq" style="">Data de partida:</span>
            <span id="norm" style="">
            <?php
              $data = new DateTime($excursao['data_part']);
              $data = $data -> format("d/m/Y");
              echo $data;
            ?></span>
          </div>
          <div class="six wide column">
            <span id="destaq" style="">Horário de partida:</span>
            <span id="norm" style=""><?php echo $excursao['horario_part']; ?></span>
          </div>
        </div>
        <div class="row">
          <div class="eleven wide column">
            <span id="destaq" style="">Endereço de partida:</span>
            <span id="norm" style=""><?php echo $excursao['endereco_part']; ?></span>
          </div>
        </div>
        <div class="row">
          <div class="six wide column">
            <span id="destaq" style="">Cidade de partida:</span>
            <span id="norm" style=""><?php echo $excursao['cidade_nome']; ?></span>
          </div>
          <div class="six wide column">
            <span id="destaq" style="">Estado de partida:</span>
            <span id="norm" style=""><?php echo $excursao['sigla']; ?></span>
          </div>
        </div>
        <div class="row">
          <div class="six wide column">
            <span id="destaq" style="">Valor:</span>
            <span id="norm" style=""><?php echo "R$".$excursao['valor']; ?></span>
          </div>
          <div class="six wide column">
            <span id="destaq" style="">Vagas:</span>
            <span id="norm" style=""><?php echo $excursao['vagas_disp']; ?></span>
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="down">
    
  </div>
    

  <div class="desciption" style="margin-top: 7em; left: 0">
    <p id="destaq">Observações</p>
    <p><?php echo $excursao['observacoes']; ?></p>
  </div>

  <div class="actions" style="margin-top: 2em; margin-bottom: 2em;">

<?php 
  if ($status == "não inscrito")
  {
?>
    <form action="<?php echo site_url('inscrever_se'); ?>" id="form_inscrever" method="POST" >
      <input type="hidden" name="inscricoes[id_inscrito]" value="<?php echo $id_usuario; ?>">
      <input type="hidden" name="inscricoes[id_excursao]" value="<?php echo $excursao['id_excursao']; ?>">
      <div style="" id="btn_inscrever" class="ui right denny green labeled icon button">
        Inscrever-se
        <i class="checkmark icon"></i>
      </div>
    </form>
<?php
  }
  else
  {
    if($status == "pendente")
    {
?>
      <input type="hidden" name="inscricao" value="<?php echo $inscricao; ?>">
      <form style="float: left" id="comprar" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
        <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
        <input type="hidden" id="code" name="code" value="" />
        <input type="hidden" id="psValor"  value="<?php echo $excursao['valor']; ?>" />
        <input type="hidden" id="psNome" value="<?php echo $excursao['nome']; ?>" />
        <input type="hidden" id="psId_insc"  value="<?php echo $inscricao; ?>" />
        <input type="hidden" name="iot" value="button" />
        <input type="image" id="btn_confirmar" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
      </form>

      <form action="<?php echo site_url('cancelar_inscricao'); ?>" id="form_cancelar" method="POST" >
        <input type="hidden" name="inscricoes[id_inscricao]" value="<?php echo $inscricao; ?>">
        <input type="hidden" name="inscricoes[id_excursao]" value="<?php echo $excursao['id_excursao']; ?>">
        <div style="margin-left: 0.2em" id="btn_cancelar" class="ui right red labeled icon button">
          Cancelar Inscrição
          <i class="cancel icon"></i>
        </div>
      </form'>
<?php
    }
    else
    {
?>  
    <form action="<?php echo site_url('cancelar_inscricao'); ?>" id="form_cancelar_pag" method="POST" >
      <input type="hidden" name="inscricoes[id_inscricao]" value="<?php echo $inscricao; ?>">
      <input type="hidden" name="inscricoes[id_excursao]" value="<?php echo $excursao['id_excursao']; ?>">
      <div style="margin-left: 0.2em" id="btn_cancelar_pag" class="ui right red labeled icon button">
        Cancelar Inscrição
        <i class="cancel icon"></i>
      </div>
    </form'>
<?php
    }
  }
?>
  </div>

<?php 
  if(isset($msg))
  {
?>
  <div style="display: block;" class="ui <?php echo "green"; ?> success message">
    <div class="header">
     Sobre sua inscrição
    </div>
    <p style=""><?php echo $msg; ?></p>
  </div>
<?php
  }
?>

<div id="msg_insc" class="ui tiny modal">
  <div class="header">Atenção</div>
  <div class="content">
    <p style="font-size: 1.1em">Deseja realmente cancelar sua inscrição?</p>
  </div>
  <div class="actions">
    <div class="ui negative button">Não</div>
    <div style="margin-left:" id="btn_conf_canc" class="ui positive button">Sim</div>
  </div>
</div>


</div>

