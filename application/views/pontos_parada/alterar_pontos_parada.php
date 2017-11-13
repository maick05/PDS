  <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/valida_detalhes_excursao.js'); ?>"></script> -->   <!-- Valida Formulários -->
  <script type="text/javascript" src="<?php echo base_url('assets/css/style.css'); ?>"></script> 
  <script type="text/javascript" src="<?php echo base_url('assets/js/pagseguro.lightbox.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js');?>"></script> 
  <script src="<?php echo base_url('semantic/dist/semantic.min.js');?>"></script> <!-- JavaScript Semantic -->

  <h2 id="" class="ui dividing header">Alterar pontos de parada</h2>
  <div class="ui visible message" id="div_aux" style="width: 100%; display: none">
    <p><span id="msg_aux"></span>
    </div>
    <div id="map" style="width:100%;height:400px;"></div>
    <script type="text/JavaScript">

      var flag = 0;
      var marker;
      var lat;
      var long;
      var id_pt_rem;

      function go_add() 
      {
        flag = 0;
        var mapCanvas = document.getElementById("map");
        var myCenter=new google.maps.LatLng(51.508742,-0.120850);
        var mapOptions = {center: myCenter, zoom: 5};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker_pt;
        var latlngbounds = new google.maps.LatLngBounds();

        $.post("retornar_pontos",{id_excursao:<?php echo $id_excursao;?>}, function(pontos)
        {
          if (pontos) 
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

              if (e.tipo == "Ponto de partida" || e.tipo == "Ponto de chegada") 
              {
                infowindow.open(map,marker_pt);
              }          

              latlngbounds.extend(marker_pt.position);
            });
            map.fitBounds(latlngbounds);

            google.maps.event.addListener(map, 'click', function(event) {
              if (flag==0) 
              {
                marker = placeMarker(map, event.latLng);
                flag++;
              }
              else
              {
                marker.setMap(null);
                marker = placeMarker(map, event.latLng);
                flag++;
              }
            });
          }
        });
      }

      function placeMarker(map, location) 
      {
        var marker = new google.maps.Marker(
        {
          position: location,
          map: map
        });
        lat = location.lat();
        long = location.lng();
        return marker;
      }


      $(document).ready(function()
      {
        var btn_add_pt = document.getElementById("btn_add_pt");
        var btn_ver_pt = document.getElementById("btn_ver_pt");
        var btn_rem_pt = document.getElementById("btn_rem_pt");
        var btn_add_t = document.getElementById("btn_add_t");
        var btn_volt = document.getElementById("btn_volt");
        var div_aux = document.getElementById("div_aux");
        var div_tipo = document.getElementById("div_tipo");
        var tipo = document.getElementById("tipo");
        var msg_mod = $("#msg_mod");
        var msg_aux = $("#msg_aux");

        ver_mapa(false);
        $( "#btn_add_t" ).on('click', function(e)  
        { 
          if(lat && long)
          {
            $.post("adicionar_ponto",{id_excursao:<?php echo $id_excursao;?>, lat:lat, long:long, tipo:tipo.value}, function(e)
            {
              msg_mod.html("Ponto adicionado com sucesso!");
              $('#modal_msg').modal('show');
              go_add();
            });
          }
        }); 

        function remover_pt(id) 
        {
          $.post("remover_ponto",{id_ponto:id}, function(data)
          {
            ver_mapa(false);
          });
        }

        $( "#btn_add_pt" ).on('click', function(e)  
        { 
          go_add();
          btn_volt.style.display = "none";
          btn_add_pt.style.display = "none";
          btn_rem_pt.style.display = "block";
          btn_ver_pt.style.display = "block";
          btn_add_t.style.display = "block";
          btn_ver_pt.style.marginRight = "1%";
          div_aux.style.display = "block";
          div_tipo.style.display = "block";
          msg_aux.html('Clique em um local no mapa e depois clique no botão "Adicionar ponto" para adicionar um ponto de parada.');
        });

        $( "#btn_ver_pt" ).on('click', function(e)  
        { 
          ver_mapa(false);
          btn_volt.style.display = "block";
          btn_add_pt.style.display = "block";
          btn_rem_pt.style.display = "block";
          btn_ver_pt.style.display = "none";
          btn_add_t.style.display = "none";
          div_aux.style.display = "none";
          div_tipo.style.display = "none";
        });

        $( "#btn_rem_pt" ).on('click', function(e)  
        { 
          ver_mapa(true);
          btn_volt.style.display = "none";
          btn_add_pt.style.display = "none";
          btn_rem_pt.style.display = "none";
          btn_ver_pt.style.display = "block";
          btn_ver_pt.style.marginRight = "0%";
          btn_add_t.style.display = "none";
          div_aux.style.display = "block";
          div_tipo.style.display = "none";
          msg_aux.html('Clique em um dos pontos no mapa para removê-los.');
        });

        $( "#btn_conf_rem" ).on('click', function(e)  
        { 
          remover_pt(id_pt_rem);
          msg_mod.html("Ponto removido com sucesso!");
          $('#modal_msg').modal('show');
        });  

        function ver_mapa(remover)
        {
          $.post("retornar_pontos",{id_excursao:<?php echo $id_excursao;?>}, function(data)
          {
            carregarPontos(data, remover);
          });
        }

        function carregarPontos(pontos, remover) 
        {
          var mapCanvas = document.getElementById("map");
          var myCenter=new google.maps.LatLng(51.508742,-0.120850);
          var mapOptions = {center: myCenter, zoom: 5};
          var map = new google.maps.Map(mapCanvas, mapOptions);
          var marker_pt;
          var latlngbounds = new google.maps.LatLngBounds();
          if (pontos) {

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
              if (!remover) 
              {
                map.setZoom(8);
                map.setCenter(new google.maps.LatLng(e.lat, e.long));
              }
              else
              {
                $('#modal_remove').modal('show');
                id_pt_rem = e.id_ponto;
              }
            });

            if (e.tipo == "Ponto de partida" || e.tipo == "Ponto de chegada") 
            {
              infowindow.open(map,marker_pt);
            }          

            latlngbounds.extend(marker_pt.position);
          });
          map.fitBounds(latlngbounds);
        }
      }
      }); 
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtQ0zFPeRkWxK-AKpskEmN7LYXGVbRYGs&callback=myMap"></script>

    <div style="float: right; margin-right: ; margin-top: 1em;" id="btn_add_pt" class="ui right green labeled icon button">
      Adicionar pontos no mapa
      <i class="add icon"></i>
    </div>
    <div style="float: right; margin-right: ; margin-top: 1em; display: none" id="btn_add_t" class="ui right green labeled icon button">
      Adicionar Ponto
      <i class="point icon"></i>
    </div>
    <div class="field" style="display: none; width: 20%; float: right; margin-right: 1%; margin-top: 1em" id="div_tipo">
      <!-- <label>Tipo de ponto:</label> -->
      <select name="tipo" style="" id="tipo" class="ui fluid dropdown">
        <option value="Ponto de partida">Ponto de partida</option>
        <option value="Ponto de parada">Ponto de parada</option>
        <option value="Ponto de chegada">Ponto de chegada</option>
      </select>
    </div>
    <div style="float: right; margin-right: 1%; margin-top: 1em; display: none " id="btn_ver_pt" class="ui right blue labeled icon button">
      Voltar
      <i class="undo icon"></i>
    </div>
    <div style="float: right; margin-right: 1%; margin-top: 1em" id="btn_rem_pt" class="ui right red labeled icon button">
      Remover pontos do mapa
      <i class="grab icon"></i>
    </div>
    <a href="<?php echo site_url('ver_detalhes_excursao/'.$id_excursao);?>">
      <div style="float: right; margin-right: 1%; margin-top: 1em; display: block " id="btn_volt" class="ui right blue labeled icon button">
        Voltar
        <i class="undo icon"></i>
      </div>
    </a>


    <div id="modal_remove" class="ui tiny modal">
      <div class="header">Atenção</div>
      <div class="content">
        <p style="font-size: 1.1em">Deseja realmente remover esse ponto de parada?</p>
      </div>
      <div class="actions">
        <div class="ui negative gray button">Não</div>
        <div style="margin-left:" id="btn_conf_rem" class="ui positive button">Sim</div>
      </div>
    </div>

    <div id="modal_msg" class="ui tiny modal">
      <div class="header">Atenção</div>
      <div class="content">
        <p id="" style="font-size: 1.1em"><span id="msg_mod"></span></p>
      </div>
      <div class="actions">
        <div style="margin-left:" id="btn_conf_rem" class="ui positive button">Ok</div>
      </div>
    </div>
  </div>


