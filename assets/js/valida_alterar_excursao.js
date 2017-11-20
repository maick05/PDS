$(document).ready(function()
{
	form_edit = document.getElementById('form_alterar');
input_nome = document.getElementById('input_nome');	// Campo nome
	input_email = document.getElementById('input_email');	
	input_endereco = document.getElementById('input_endereco');	
	input_vagas = document.getElementById('input_vagas');	
	input_horario = document.getElementById('input_horario');
	input_valor = document.getElementById('input_valor');
	input_data = document.getElementById('input_data');	
	input_data_d = document.getElementById('input_data_d');	
	input_estado = document.getElementById('estado_select');	


	msg_nome = document.getElementById('msg_nome');	
	msg_email = document.getElementById('msg_email'); 
	msg_data_d = document.getElementById('msg_data_d');
	msg_data = document.getElementById('msg_data');
	msg_endereco = document.getElementById('msg_endereco');	
	msg_vagas = document.getElementById('msg_vagas');	
	msg_horario = document.getElementById('msg_horario');	
	msg_valor = document.getElementById('msg_valor');	
	msg_estado = document.getElementById('msg_estado');

	span_nome = $("#texto_nome");	// texto da mensagem do campo nome
	span_email = $("#texto_email");	// texto da mensagem do campo email
	span_data_d = $("#texto_data_d");	// texto da mensagem do campo senha
	span_data = $("#texto_data");	// texto da mensagem do campo senha
	span_endereco = $("#texto_endereco");
	span_vagas = $("#texto_vagas");	
	span_horario = $("#texto_horario");
	span_valor = $("#texto_valor");
	span_estado = $("#texto_estado");
	
	txt_vazio = "Preencha esse campo por favor";	
	txt_email_invalido = "Email invalido"; 
	txt_data_menor = "Data inferior a data atual";


	$( "#btn_alterar" ).on('click', function(e)
	{
		if (!IsEmpty(input_nome, msg_nome, span_nome, false, true))
		{
			if(!IsEmpty(input_endereco, msg_endereco, span_endereco, false, true))
			{
				if (!IsEmpty(input_estado, msg_estado, span_estado, false, true))
				{
					if(!IsEmpty(input_data, msg_data, span_data, false, true) &&  verificaData(input_data, msg_data, span_data))
					{					
						if (!IsEmpty(input_horario, msg_horario, span_horario, false, true))
						{
							if(verificaData(input_data_d, msg_data_d, span_data_d) && verificaDatas())
							{
								if (!IsEmpty(input_vagas, msg_vagas, span_vagas, false, true) && verificaVaga(input_vagas))
								{
									if (!IsEmpty(input_valor, msg_valor, span_valor, false, true) && verificaValor(input_valor))
									{
										if (IsEmail(input_email))
										{
											form_edit.submit();
										}
									}
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
			if (isPass)	
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
			
			if (isPass)	
			{
				botao.style.marginTop = "3.5em";	
			}
			campos_vazios++;
			return true;
		}
	}	

	function verificaData(campo, msg, span)	
	{
		if (campo.value) 
		{
			var data_atual = new Date(Date.now());
			var data_exc = new Date(campo.value);
			
			if (data_atual < data_exc) 
			{
				
				msg.style.display = "none";
				return true;
			}
			else 
			{
				msg.style.display = "block";
				span.html(txt_data_menor);
				return false;
			}
		}
		else
		{
			msg.style.display = "none";
			return true;
		}
	}

	function verificaDatas()	
	{
		if (input_data_d.value) 
		{
			var data = new Date(input_data.value);
			var data_d = new Date(input_data_d.value);
			
			if (data < data_d) 
			{
				
				msg_data_d.style.display = "none";
				return true;
			}
			else 
			{
				msg_data_d.style.display = "block";
				span_data_d.html("A data de chegada não pode ser inferior que a data de partida");
				return false;
			}
		}
		else
		{
			msg_data_d.style.display = "none";
			return true;
		}
	}

	function verificaValor(campo)	
	{
		if (campo.value > 0) 
		{
			msg_valor.style.display = "none";
			return true;
		}
		else 
		{
			msg_valor.style.display = "block";
			span_valor.html("Por favor insira um valor para a excursão");
			return false;
		}
	}

	function verificaVaga(campo)
	{
		if (campo.value >= 5) 
		{	
			msg_vagas.style.display = "none";
			return true;
		}
		else 
		{
			msg_vagas.style.display = "block";
			span_vagas.html("A excursão deve possuir pelo menos 5 vagas");
			return false;
		}
	}

	function IsEmail(email)		// Faz validação se é um email válido
	{
		if (email.value) 
		{
			usuario = email.value.substring(0, email.value.indexOf("@"));
			dominio = email.value.substring(email.value.indexOf("@")+ 1, email.value.length);
			if ((usuario.length >=1) &&
			    (dominio.length >=3) && 
			    (usuario.search("@")==-1) && 
			    (dominio.search("@")==-1) &&
			    (usuario.search(" ")==-1) && 
			    (dominio.search(" ")==-1) &&
			    (dominio.search(".")!=-1) &&      
			    (dominio.indexOf(".") >=1)&& 
			    (dominio.lastIndexOf(".") < dominio.length - 1)) 
			{
				msg_email.style.display = "none";
				return true;
			}
			else
			{
				msg_email.style.display = "block";
				span_email.html(txt_email_invalido);
				return false;
			}
		}
		else
		{
			msg_email.style.display = "block";
			span_email.html(txt_email_invalido);
			return true;
		}
   	}
});