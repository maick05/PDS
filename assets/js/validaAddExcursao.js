$(document).ready(function()
{
	form_add = document.getElementById('form_criar');	// Form do cadastro	// Botão de Cadastrar

	input_nome = document.getElementById('input_nome');	// Campo nome
	input_email = document.getElementById('input_email');	
	input_endereco = document.getElementById('input_endereco');	
	input_vagas = document.getElementById('input_vagas');	
	input_horario = document.getElementById('input_horario');
	input_valor = document.getElementById('input_valor');
	input_data = document.getElementById('input_data');	
	input_estado = document.getElementById('estado_select');	

	msg_nome = document.getElementById('msg_nome');	
	msg_email = document.getElementById('msg_email'); 
	msg_data = document.getElementById('msg_data');
	msg_endereco = document.getElementById('msg_endereco');	
	msg_vagas = document.getElementById('msg_vagas');	
	msg_horario = document.getElementById('msg_horario');	
	msg_valor = document.getElementById('msg_valor');	
	msg_estado = document.getElementById('msg_estado');

	span_nome = $("#texto_nome");	// texto da mensagem do campo nome
	span_email = $("#texto_email");	// texto da mensagem do campo email
	span_data = $("#texto_data");	// texto da mensagem do campo senha
	span_endereco = $("#texto_endereco");
	span_vagas = $("#texto_vagas");	
	span_horario = $("#texto_horario");
	span_valor = $("#texto_valor");
	span_estado = $("#texto_estado");

	campos_vazios = 0;

	
	txt_vazio = "Preencha esse campo por favor";	// Texto para campo vazio
	txt_email_existe = "Esse email já está sendo usado, por favor insira um email diferente";	// Texto para email que já existe
	txt_email_invalido = "Email invalido"; //Texto para email invalido


	$( "#btn_criar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		if (!IsEmpty(input_nome, msg_nome, span_nome, false, true))
		{
			if(!IsEmpty(input_endereco, msg_endereco, span_endereco, false, true))
			{
				if (!IsEmpty(input_estado, msg_estado, span_estado, false, true))
				{
					if(!IsEmpty(input_data, msg_data, span_data, false, true))
					{					
						if (!IsEmpty(input_horario, msg_horario, span_horario, false, true))
						{
							if (!IsEmpty(input_vagas, msg_vagas, span_vagas, false, true))
							{
								if (!IsEmpty(input_valor, msg_valor, span_valor, false, true))
								{
									form_add.submit();
								}
							}
						}		
					}
				}
			}
		}
  	});	

	function IsEmpty(input, msg, span, isPass, isClick)	// Faz a validacao dos campos se eles estao vazios
	{
		if (input.value) 	//Condicao se tiver algo escrito no campo
		{
			msg.style.display = "none";		
			if (isPass)		//Condição se o campo for o de senha
			{
				botao.style.marginTop = "0";
			}
			return false;
		}
		else 
		{
			if (isClick)
			{
				msg.style.display = "block";
				span.html(txt_vazio);	// Escreve a mensagem de texto vazio
			}
			else
			{
				msg.style.display = "none";	
			}
			
			if (isPass)		//Condição se o campo for o de senha
			{
				botao.style.marginTop = "3.5em";	
			}
			campos_vazios++;
			return true;
		}
	}	

  	$.post("listar_estados", function(data, status)
        {
          result = $.parseJSON(data);
          result.forEach(function(e, i){
            $('#estado_select').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
          })
     });
-
	$('#estado_select').on('change', function(e)
	{
		id_estado = this.value;
		$.post("cidades_por_estado", {id:id_estado}, function(data, status)
		{
			result = $.parseJSON(data);
			$('#cidade_select').empty( );
			result.forEach(function(e, i){
				$('#cidade_select').append('<option value="'+ e.id_cidade + '">'+ e.nome + '</option>')
			})	
		});
	});
});