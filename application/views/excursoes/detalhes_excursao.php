  <script type="text/javascript" src="<?php echo base_url('assets/js/valida_detalhes_excursao.js'); ?>"></script>   <!-- Valida Formulários -->
  <script type="text/javascript" src="<?php echo base_url('assets/css/style.css'); ?>"></script> 
  <script type="text/javascript" src="<?php echo base_url('assets/js/pagseguro.lightbox.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js');?>"></script> 
  <script src="<?php echo base_url('semantic/dist/semantic.min.js');?>"></script> <!-- JavaScript Semantic -->
  <!-- <form  id="form_criar" class="ui form" style="" method="POST" action="<?php echo site_url('criar_excursao'); ?>" enctype="multipart/form-data">  -->
   <input type="hidden" id="id_excursao_aut" value="<?php echo $excursao['id_excursao'];?>">
   <input type="hidden" id="id_criador" value="<?php echo $excursao['id_criador'];?>">
   <input type="hidden" id="media" value="<?php echo $media['media'];?>">
   <input type="hidden" id="minha_av" value="<?php echo $minha_av;?>">
   <h2 id="" class="ui dividing header"><?php echo $excursao['nome']; ?></h2>
   <?php 
   if(isset($novo))
   {
    ?>
    <script type="text/javascript">
      $(document).ready(function()
      {
        label_email_aut = $("#email_aut");
        $.post("verificar_autorizacao",function(data)
        {
          if (data) 
          {
            $('#modal_aut').modal('show');
            label_email_aut.html("Manter conta " + data + " vinculada");
          }
          else
          {
            $('#modal_pag').modal('show');
          }  
        });
      });
    </script>
    <?php
  }
  if(isset($msg_exc))
  {
    ?>
    <div style="display: block;" class="ui <?php echo "green"; ?> success message">
      <div class="header">
        Parabéns
      </div>
      <p style=""><?php echo $msg_exc; ?></p>
    </div>
    <?php
  }
  ?>
  <div class="" style="margin-top: 2em">
    <div class="image content" id="img_perfil" style="">
      <div id="div_img_det" class="ui massive image" style="">
        <form action="<?php echo site_url('alterar_foto'); ?>" id="form_foto" method="POST" style="float:left" enctype="multipart/form-data">
          <input type="hidden" name="id_excursao" value="<?php echo $excursao['id_excursao']?>">
          <label style="" id="" for="btn_img_home">
            <img id="label_img_exc"
            src="<?php 
            if(isset($excursao['url_foto']) && file_exists($excursao['url_foto']))
            {
              echo base_url($excursao['url_foto']);
            }
            else
            {
              echo base_url('assets/img/excursoes/excursao_padrao.png');
            }?>">
          </label>
          <input name="url_foto" type="file" accept="image/png, image/jpeg, image/jpg" id="btn_img_home" multiple>
          <div style="margin-top:0.2em; width: 100%" id="btn_foto" class="ui right gray labeled icon button">
            Alterar Foto
            <i class="edit icon"></i>
          </div>
        </form>
      </div>
    </div>
    <div class="ui grid" style="">
      <div class="row">
        <div class="six wide column">
          <span id="destaq" style="">Tipo de transporte:</span>
          <span id="norm" style=""> <?php echo $excursao['tipo_transporte']; ?></span>
        </div>
        <div class="three wide column">
          <span id="destaq" style="">Categoria:</span>
          <span id="norm" style=""><?php echo $excursao['categoria']; ?></span>
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
    <!-- </form> -->

    <div class="desciption" style="margin-top: 8em; left: 0">
      <p id="destaq">Observações</p>
      <p><?php echo $excursao['observacoes']; ?></p>
    </div>
    <br>
    <?php
    if (isset($rota) && $rota)
    {
      ?>

      <div id="map" style="width:80%;height:320px;"></div>
      <script>
        function myMap() 
        {
          var mapCanvas = document.getElementById("map");
          var myCenter=new google.maps.LatLng(51.508742,-0.120850);
          var mapOptions = {center: myCenter, zoom: 5};
          var map = new google.maps.Map(mapCanvas, mapOptions);
          var marker_pt;
          var latlngbounds = new google.maps.LatLngBounds();

          $.post("../retornar_pontos",{id_excursao:<?php echo $excursao['id_excursao'];?>}, function(pontos)
          {
            result = $.parseJSON(pontos);
            result.forEach(function(e, i)
            {
              marker_pt = new google.maps.Marker(
              {
                position: new google.maps.LatLng(e.lat, e.long),
                title: e.tipo,
                map: map
              });

              var infowindow = new google.maps.InfoWindow(
              {
                content: e.tipo
              });

              marker_pt.addListener('click', function()
              {
                map.setZoom(8);
                map.setCenter(new google.maps.LatLng(e.lat, e.long));
              });

              if (e.tipo == "Ponto de partida" || e.tipo == "Ponto de chegada") 
              {
                infowindow.open(map,marker_pt);
              }          

              latlngbounds.extend(marker_pt.position);
            });
            map.fitBounds(latlngbounds);
          }); 
        }
      </script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtQ0zFPeRkWxK-AKpskEmN7LYXGVbRYGs&callback=myMap"></script>
      <?php
      if ($status == "criador") 
      {
        ?>
        <form action="<?php echo site_url('alterar_pontos_parada'); ?>" id="form_epp" method="POST" style="float:left">
          <input type="hidden" name="id_excursao" value="<?php echo $excursao['id_excursao']; ?>">
          <div style="margin-left:; margin-top: 0.5em" id="btn_epp" class="ui right orange labeled icon button">
            Alterar pontos de paradas
            <i class="point icon"></i>
          </div>
        </form>
        <?php
      }
      ?>
      <?php
    }
    else if ($status == "criador") 
    {
      ?>
      <form action="<?php echo site_url('alterar_pontos_parada'); ?>" id="form_app" method="POST" style="float:left">
        <input type="hidden" name="id_excursao" value="<?php echo $excursao['id_excursao']; ?>">
        <div style="margin-left:; margin-top: 0.5em" id="btn_app" class="ui right green labeled icon button">
          Adicionar pontos de paradas
          <i class="point icon"></i>
        </div>
      </form>
      <?php
    }
    ?>
    <div style="margin-top: 4em">
     <h2 id="" class="ui dividing header"></h2>
     <p style="font-size: 1.1em"><span id="destaq" style="">Criada por:</span>
       <span id="norm" style=""><?php echo $excursao['criador']; ?></span></p>
       <p style=""><span id="destaq" style="">Telefone para contato:</span>
         <span id="norm" style=""><?php echo $excursao['contato']; ?></span></p>
         <p style=""><span id="destaq" style="">Email para contato:</span>
           <span id="norm" style=""><?php echo $excursao['contato_email']; ?></span></p>
           <div id="rating_c" class="ui huge star rating"></div>
           <!-- <span id="media_c"><?php echo $media['media'];?></span>: -->
           <span id="num_av"><?php echo $media['numero'];?></span> avaliações
           <?php
           if ($status != "criador") 
           {
            ?>
            <br>Sua avaliação:<div id="rating_av"class="ui huge star rating"></div>
     <?php } ?>
            <h2 id="" class="ui dividing header"></h2>
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
            else if ($status != "criador")
            {
              if($status == "pendente")
              {
                if ($excursao['pagseguro'])
                {
                  ?>
                  <input type="hidden" name="inscricao" value="<?php echo $inscricao; ?>">
                  <input type="hidden" id="id_pagamento" value="<?php echo $inscricao; ?>">
                  <form style="float: left" id="comprar" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post" onsubmit="
                  PagSeguroLightbox(this,  
                  {
                   success : function(transactionCode) 
                   {

                   },
                   abort : function() 
                   {

                    $.post('/pds/deletar_pagamento', {id_inscricao:<?php echo $inscricao; ?>, id_excursao:<?php echo $excursao['id_excursao'];?>});
                  }
                }); 
                  return false;
                  ">
                  <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                  <input type="hidden" id="code" name="code" value="" />
                  <input type="hidden" id="psValor"  value="<?php echo $excursao['valor']; ?>" />
                  <input type="hidden" id="psNome" value="<?php echo $excursao['nome']; ?>" />
                  <input type="hidden" id="psId_insc"  value="<?php echo $inscricao; ?>" />
                  <input type="hidden" name="iot" value="button" />
                  <input type="image" id="btn_confirmar" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                </form>
                <?php }?>

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
                <form action="<?php echo site_url('cancelar_inscricao'); ?>" id="form_cancelar" method="POST" >
                  <input type="hidden" name="inscricoes[id_inscricao]" value="<?php echo $inscricao; ?>">
                  <input type="hidden" name="inscricoes[id_excursao]" value="<?php echo $excursao['id_excursao']; ?>">
                  <div style="margin-left: 0.2em" id="btn_cancelar" class="ui right red labeled icon button">
                    Cancelar Inscrição
                    <i class="cancel icon"></i>
                  </div>
                </form>
                <?php
              }
            }
            else
            {
              ?>
              <form action="<?php echo site_url('alterar_excursao'); ?>" id="form_alterar" method="POST" style="float:left">
                <input type="hidden" name="excursao[id_excursao]" value="<?php echo $excursao['id_excursao']; ?>">
                <div style="margin-left: 0.2em" id="btn_alterar" class="ui right orange labeled icon button">
                  Alterar Excursão
                  <i class="edit icon"></i>
                </div>
              </form>

              <form action="<?php echo site_url('ver_inscritos'); ?>" id="form_inscritos" method="POST" >
                <input type="hidden" name="excursao[id_excursao]" value="<?php echo $excursao['id_excursao']; ?>">
                <div style="margin-left: 0.2em" id="btn_inscritos" class="ui right blue labeled icon button">
                  Ver inscritos
                  <i class="users icon"></i>
                </div>
              </form>
              <?php
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

        <div id="msg_comp" class="ui tiny modal">
          <div class="header">Confirme sua inscrição</div>
          <div class="content">
            <p style="font-size: 1.1em">Envie uma foto ou arquivo do comprovante de pagamento para que o organizador possa confirmar sua inscrição</p>
            <input type="file" name="">
          </div>
          <div class="actions">
            <div class="ui negative button">Cancelar</div>
            <div style="margin-left:" id="btn_conf_canc" class="ui positive button">Sim</div>
          </div>
        </div>


        <div class="ui tiny modal" id="modal_pag">
          <div class="header">Vincular conta do pagseguro</div>
          <div class="content">
            <p>Caso você queira gerenciar seus pagamentos online, você pode integrar sua conta do pagseguro, deseja fazer isso?</p>
          </div>
          <div class="actions" id="actions_rec" style="">
            <div class="ui cancel button">Não, obrigado!</div>
            <div id="btn_vinc" class="ui denny green button" style="">Integrar Pagseguro</div>
          </div>
        </div>

        <div class="ui tiny modal" id="modal_aut">
          <div class="header">Vincular conta do pagseguro</div>
          <div class="content">
            <p>Você já possui uma vinculação com o pagseguro, deseja mantê-la?</p>

            <input type="radio" name="vinc_pag" tabindex="0" class="" id="manter" checked>
            <label id="email_aut"></label>
            <br>
            <input type="radio" name="vinc_pag" tabindex="0" class="" id="outra">
            <label>Usar outra conta</label>
            <br>
            <input type="radio" name="vinc_pag" tabindex="0" class="" id="nao">
            <label>Não vincular nenhuma conta do pagseguro</label>
            <br>
          </div>
          <div class="actions" id="actions_rec" style="">
            <div class="ui cancel button">Não, obrigado!</div>
            <div id="btn_pross" class="ui denny green button" style="">Prosseguir</div>
          </div>
        </div>
      </div>



