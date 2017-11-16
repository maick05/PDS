$(document).ready(function()
{
	form_alt = document.getElementById('form_alterar');	// Form do cadastro
	botao = document.getElementById('btn_cadastrar');	// Botão de Cadastrar

	input_nome = document.getElementById('input_nome');	// Campo nome
	input_email = document.getElementById('input_email');	// Campo email
	input_data = document.getElementById('input_data');	// Campo data

	msg_nome = document.getElementById('msg_nome');	// Div da mensagem do campo nome
	msg_email = document.getElementById('msg_email'); 	// Div da mensagem do campo nome
	msg_data = document.getElementById('msg_data');	// Div da mensagem do campo senha

	span_nome = $("#texto_nome");	// texto da mensagem do campo nome
	span_email = $("#texto_email");	// texto da mensagem do campo email
	span_data = $("#texto_data");	// texto da mensagem do campo senha
	
	txt_vazio = "Preencha esse campo por favor";	// Texto para campo vazio
	txt_email_existe = "Esse email já está sendo usado, por favor insira um email diferente";	// Texto para email que já existe
	txt_email_invalido = "Email invalido"; //Texto para email invalido

	input_email_rec = document.getElementById('input_email_rec');

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

	$( "#input_email" ).on('change', function(e)		// Função para quando mudar o contéudo do campo email
	{
		// if (!IsEmpty(input_email, msg_email, span_email, false, false)) 
		// {
		// 	validaEmail(false);
		// }
	});

	$( "#btn_rec_senha_perfil" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$('#modal_rec').modal('show');
  	});	

  	$( "#btn_recuperar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$.post("recuperar_senha",{email:input_email_rec.value},function(data)
		{
			$('#modal_msg_email').modal('show');
		});
  	});	

	$( "#btn_alterar_perfil" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		IsSubmit = false;
		
		
		if (!IsEmpty(input_nome, msg_nome, span_nome, false, true))
		{
			if(1 == 1)
			{
				if(verificaData(input_data))
				{
   					//validaEmail(true);
   					form_alt.submit();
   					IsSubmit = true;
   				}
   				else
   				{
   					IsSubmit= false; 
   				}
   			} 
   			else
   			{
   				IsSubmit= false; 
   			}  			
   		}
   		else
   		{
   			IsSubmit= false; 
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
			return true;
		}
	}	


	function validaEmail(IsSubmit)
	{
		if (IsEmail(input_email))
		{
			$.post("verificar_email",{email:input_email.value},function(flag)	// Verifica no banco se o email existe
			{
		        if (flag)	//Condição se o email existir
		        {
		        	msg_email.style.display = "block";		//Div msg_email fica visível
		        	span_email.html(txt_email_existe);	// Escreve a mensagem que o email existe
		        }
		        else
		        {
		        	msg_email.style.display = "none"; //Div msg_email fica invisível
		        	if (IsSubmit) 
		        	{
		        		form_alt.submit();
		        	}
		        }
		    });
		}
		else
		{
			msg_email.style.display = "block";
			span_email.html(txt_email_invalido);
		}
	}


	function IsEmail(email)		// Faz validação se é um email válido
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
			return true;	
		}
		else
		{
			return false;
		}
	}

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


   });