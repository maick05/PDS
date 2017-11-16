$(document).ready(function()
{	
	form_conc = document.getElementById('form_home');	// Form do Login
	botao = document.getElementById('btn_concluir');	// Botão de Login
	msg_data =  document.getElementById('msg_data');	// Div da mensagem do campo data
	span_data =  document.getElementById('texto_data'); // Span da mensagemdo campo data

	input_data =  document.getElementById('input_data'); //Campo data
	telefone =  document.getElementById('telefone'); // Span da mensagemdo campo data
	celular =  document.getElementById('celular'); // Span da mensagemdo campo data
	cidade =  document.getElementById('cidade_select'); // Span da mensagemdo campo data
	estado =  document.getElementById('estado_select'); // Span da mensagemdo campo data 
	input_foto =  document.getElementById('btn_img_home');
	
	menu =  document.getElementById('menu_lateral');
	divs =  document.getElementById('divs');

	$( "#btn_concluir" ).on('click', function(e)	// Função clique do botao de concluir
	{
		if (verificaData(input_data))
		{
			form_conc.submit();
		}

  	});	

  	$( "#btn_ignorar" ).on('click', function(e)	// Função clique do botao de concluir
	{
		$('#msg_home').modal('show');
  	});	

	function verificaData(campo)	//Valida se a data de nascimento é maior que a data atual e se ela ultrapassa 140 anos
	{
		if (campo.value) 
		{
			var data_atual = new Date(Date.now());
			var data_nasc = new Date(campo.value);
			
			if (data_atual > data_nasc) 
			{
				var diffMilissegundos = data_atual - data_nasc;
				var diffSegundos = diffMilissegundos / 1000;
				var diffMinutos = diffSegundos / 60;
				var diffHoras = diffMinutos / 60;
				var diffDias = diffHoras / 24;
				var diffMeses = diffDias / 30;
				var diffAnos = diffMeses / 12;

				if(diffAnos > 140)
				{
					msg_data.style.display = "block";
					return false;
				}
				else
				{
					msg_data.style.display = "none";
					return true;
				}
			}
			else 
			{
				msg_data.style.display = "block";
				return false;
			}
		}
		else
		{
			msg_data.style.display = "none";
			return true;
		}
	}

	function concluir()
	{
		$.post("concluir_cadastro", {telefone:telefone.value, celular:celular.value, id_estado:estado.value, id_cidade:cidade.value, data_nasc:input_data.value, 
			foto:$( "#btn_img_home" ).val()},
		function(data, status)
		{
   			$('#modal_home').modal('hide');	
   			//$('#msg_home').modal('show');
		});
	}

	document.querySelector('.menu-abrir').onclick = function() 
	{
		if ($("#menu_ativo").length) 
		{
			$(document).find('#menu_ativo').attr('id', 'menu_lateral');
		}
		else
		{
			$(document).find('#menu_lateral').attr('id', 'menu_ativo');
		}
    	
	};


	document.documentElement.onclick = function(event) 
	{
		if ($("#menu_ativo").length)
		{
			document.documentElement.onclick = function(event) 
			{
			    if (event.target === document.documentElement) 
			    {
			        document.documentElement.classList.add('menu-ativo');
			    }
			};
		}
	}
});