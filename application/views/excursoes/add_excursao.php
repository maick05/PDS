
<script type="text/javascript" src="<?php echo base_url('assets/js/validaAddExcursao.js'); ?>"></script>   <!-- Valida Formulários -->
<script type="text/javascript" src="<?php echo base_url('assets/js/cidade_estado.js'); ?>"></script> 
<form  id="form_criar" class="ui form" style="" method="POST" action="<?php echo site_url('criar_excursao'); ?>" enctype="multipart/form-data"> 
<div>
  <h2 id="" class="ui dividing header">Criar Excursão</h2>
  <div style="" id="" class="">
        <div class="three fields">
            <div class="field">
              <label>Nome da Excursão*</label>
              <div class="ui left icon input">
                <input autocomplete="off" id="input_nome" type="text" placeholder="Ex: Excursão para o Rio de Janeiro" name="excursoes[nome]"
                value="">
                <i class="info icon"></i>
              </div>
              <div style="" id="msg_nome" class="ui pointing red basic label">
                <span id="texto_nome"></span>
              </div>
            </div>
            <div class="field">
              <label>Categoria*</label>
              <select name="excursoes[categoria]" style="" id="" class="ui fluid dropdown">
                <option value="">Música</option>
                <option value="">Esportes</option>
                <option value="">Turismo</option>
                <option value="">Outros</option>
              </select>
            </div>
        </div>
        <div class="fields">
          <div class="field" style="width: 66.66%">
            <label>Endereço de partida*</label>
            <div class="ui left icon input">
              <input autocomplete="off" id="input_endereco" type="text" placeholder="Ex: Avenida José Bonifácio" name="usuarios[nome]"
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
              <select name="excursoes[id_estado_part]" style="" id="estado_select" class="ui fluid dropdown">
                <option value="" selected disabled>Estado</option>
              </select>
              <div style="" id="msg_estado" class="ui pointing red basic label">
                <span id="texto_estado"></span>
              </div>
            </div>
            
            <div class="field">
              <label>Cidade*</label>
              <select name="excursoes[id_cidade_part]" id="cidade_select" class="ui fluid dropdown">
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
                  <input name="excursoes[data_part]" id="input_data" type="date" placeholder=""
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
                  <input name="excursoes[horario_part]" id="input_horario" type="time" placeholder=""
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
                  <label id="data_label" style="">Vagas Disponíveis*</label>
                </div>
              </div>
              <div class="fields">
                <div id="" style="" class="ui left icon input campo_home">
                  <input name="excursoes[vagas_disp]" id="input_vagas" type="number" placeholder=""
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
                  <input name="excursoes[valor]" id="input_valor" placeholder=""
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
                <input autocomplete="off" id="celular" type="text" placeholder="Telefone" name="excursoes[contato]"
                value="">
                <i class="phone icon"></i>
              </div>
            </div>

            <div class="field">
              <label>Email para Contato</label>
              <div class="ui left icon input">
                <input autocomplete="off" id="celular" type="email" placeholder="Email" name="excursoes[contato_email]"
                value="">
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
              <textarea name="excursoes[observacoes]" rows="4"></textarea>
            </div>
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

