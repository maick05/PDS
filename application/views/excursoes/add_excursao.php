
<script type="text/javascript" src="<?php echo base_url('assets/js/validaAddExcursao.js'); ?>"></script>   <!-- Valida Formulários -->
<script type="text/javascript" src="<?php echo base_url('assets/js/cidade_estado.js'); ?>"></script> 
<script type="text/javascript">
  $(document).ready(function()
  {
    <?php
    if(isset($usuario_logado['id_estado']))
    {
      ?>      $.post("listar_estados", function(data, status)
      {
        result = $.parseJSON(data);
        result.forEach(function(e, i){
          $('#estado_select').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
        })
        $("#estado_select").val("<?php echo $usuario_logado['id_estado'];?>");  
      });



      id_estado = <?php echo $usuario_logado['id_estado'];?>;
      $.post("cidades_por_estado", {id:id_estado}, function(data, status)
      {
        result = $.parseJSON(data);
        $('#cidade_select').empty( );
        result.forEach(function(e, i){
          $('#cidade_select').append('<option value="'+ e.id_cidade + '">'+ e.nome + '</option>')
        }) 
        $("#cidade_select").val("<?php echo $usuario_logado['id_cidade'];?>"); 
      });
      <?php
    }
    else
    {
      ?>
      $.post("listar_estados", function(data, status)
      {
        result = $.parseJSON(data);
        result.forEach(function(e, i){
          $('#estado_select').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
        }) 
      });
      <?php
    }
    ?>    
  });
</script>
<form  id="form_criar" class="ui form" style="" method="POST" action="<?php echo site_url('criar_excursao'); ?>" enctype="multipart/form-data"> 
  <div>
    <h2 id="" class="ui dividing header">Criar Excursão</h2>
    <div style="" id="" class="">
      <div class="fields">
        <div class="field" style="width: 66.66%">
          <label>Nome da Excursão*</label>
          <div class="ui left icon input">
            <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" autocomplete="off" id="input_nome" type="text" placeholder="Ex: Excursão para o Rio de Janeiro" name="excursoes[nome]"
            value="">
            <i class="info icon"></i>
          </div>
          <div style="" id="msg_nome" class="ui pointing red basic label">
            <span id="texto_nome"></span>
          </div>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Tipo de transporte*</label>
          <select style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[tipo_transporte]" style="" id="" class="ui fluid dropdown">
            <option value="Carro">Carro</option>
            <option value="Ônibus">Ônibus</option>
            <option value="Van">Van</option>
            <option value="Avião">Avião</option>
            <option value="Barco">Barco</option>
          </select>
        </div>
        <div class="field">
          <label>Categoria*</label>
          <select style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[categoria]" style="" id="" class="ui fluid dropdown">
            <option value="Música">Música</option>
            <option value="Esportes">Esportes</option>
            <option value="Turismo">Turismo</option>
            <option value="Tecnologia">Tecnologia</option>
            <option value="Tecnologia">Religião</option>
            <option value="Outros">Outros</option>
          </select>
        </div>
      </div>
      <div class="fields">
        <div class="field" style="width: 66.66%">
          <label>Endereço de partida*</label>
          <div class="ui left icon input">
            <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" autocomplete="off" id="input_endereco" type="text" placeholder="Ex: Avenida José Bonifácio" name="excursoes[endereco_part]"
            value="">
            <i class="point icon"></i>
          </div>
          <div style="" id="msg_endereco" class="ui pointing red basic label">
            <span id="texto_endereco"></span> 
          </div>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Estado*</label>
          <select style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[id_estado_part]" style="" id="estado_select" class="ui fluid dropdown">
            <option value="" selected disabled>Estado</option>
          </select>
          <div style="" id="msg_estado" class="ui pointing red basic label">
            <span id="texto_estado"></span>
          </div>
        </div>

        <div class="field">
          <label>Cidade*</label>
          <select style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[id_cidade_part]" id="cidade_select" class="ui fluid dropdown">
            <option value="" selected disabled>Selecione o estado</option>
          </select>
        </div>
      </div>
      <div class="fields">
        <div class="field" style="width: 66.66%">
          <label>Endereço de chegada</label>
          <div class="ui left icon input">
            <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" autocomplete="off" id="input_endereco_d" type="text" placeholder="Ex: Avenida José Bonifácio" name="excursoes[endereco_part]"
            value="">
            <i class="point icon"></i>
          </div>
          <div style="" id="msg_endereco_d" class="ui pointing red basic label">
            <span id="texto_endereco_d"></span> 
          </div>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Estado</label>
          <select style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[id_estado_dest]" style="" id="estado_select2" class="ui fluid dropdown">
            <option value="" selected disabled>Estado</option>
          </select>
          <div style="" id="msg_estado" class="ui pointing red basic label">
            <span id="texto_estado_d"></span>
          </div>
        </div>

        <div class="field">
          <label>Cidade</label>
          <select style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[id_cidade_dest]" id="cidade_select2" class="ui fluid dropdown">
            <option value="" selected disabled>Selecione o estado</option>
          </select>
        </div>
      </div>
      <div class="three fields">
        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Data de Partida*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[data_part]" id="input_data" type="date" placeholder=""
              value="">
              <i class="calendar icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_data" class="ui pointing red basic label">
              <span id="texto_data"></span>
            </div>
          </center>
        </div>

        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Horário de partida*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[horario_part]" id="input_horario" type="time" placeholder=""
              value="">
              <i class="clock icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_horario" class="ui pointing red basic label">
              <span id="texto_horario"></span>
            </div>
          </center>
        </div>
      </div>
      <div class="three fields">
        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Data de chegada</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[data_dest]" id="input_data_d" type="date" placeholder=""
              value="">
              <i class="calendar icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_data_d" class="ui pointing red basic label">
              <span id="texto_data_d"></span>
            </div>
          </center>
        </div>

        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Horário de chegada</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[horario_dest]" id="input_horario_d" type="time" placeholder=""
              value="">
              <i class="clock icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_horario_d" class="ui pointing red basic label">
              <span id="texto_horario_d"></span>
            </div>
          </center>
        </div>
      </div>
      <div class="three fields">
        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Vagas Disponíveis*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[vagas_disp]" id="input_vagas" type="number" placeholder=""
              value="">
              <i class="users icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_vagas" class="ui pointing red basic label">
              <span id="texto_vagas"></span>
            </div>
          </center>
        </div>

        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Valor*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" name="excursoes[valor]" id="input_valor" placeholder=""
              value="" type="number" step="0.01" min="0">
              <i class="money icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_valor" class="ui pointing red basic label">
              <span id="texto_valor"></span>
            </div>
          </center>
        </div>
      </div>

      <div class="three fields">
        <div class="field">
          <label>Telefone para Contato</label>
          <div class="ui left icon input">
            <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" autocomplete="off" id="telefone" type="text" placeholder="" name="excursoes[contato]"
            value="<?php 
            if(isset($usuario_logado['telefone']))
            {
               echo $usuario_logado['telefone']; 
            }
            ?>">
            <i class="phone icon"></i>
          </div>
        </div>

        <div class="field">
          <label>Celular para Contato</label>
          <div class="ui left icon input">
            <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" autocomplete="off" id="celular" type="text" placeholder="Celular" name="excursoes[contato_celular]"
            value="<?php 
            if(isset($usuario_logado['celular']))
            {
              echo $usuario_logado['celular']; 
            }
            ?>">
            <i class="mobile icon"></i>
          </div>
        </div>
      </div>

      <div class="three fields">
        <div class="field">
          <label>Email para Contato</label>
          <div class="ui left icon input">
            <input style="border: 0.5px solid rgba(0, 100, 181, 0.45);" autocomplete="off" type="text" placeholder="Email" name="excursoes[contato_email]"
            id="input_email"  value="<?php echo $usuario_logado['email']; ?>">
            <i class="mail icon"></i>
          </div>
          <div style="" id="msg_email" class="ui pointing red basic label">
            <span id="texto_email"></span>
          </div>
        </div>
      </div>

      <div class="field" style="width: 66.66%">
        <div class="field">
          <label>Observações</label>
          <textarea name="excursoes[observacoes]" rows="4" style="border: 0.5px solid rgba(0, 100, 181, 0.45);"></textarea>
        </div>
            *Campos obrigatórios 
      </div>
      <div class="actions" style="">
        <div style="" id="btn_criar" class="ui green labeled icon large button">
          Criar Excursão
          <i class="check icon"></i>
        </div>
      </div> 
    </div>
  </form> 
</div>

