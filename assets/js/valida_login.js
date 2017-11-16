$(document).ready(function()
{
	form_log = document.getElementById('form_login');	// Form do Login
	botao = document.getElementById('btn_logar');	// Botão de Login

	input_email = document.getElementById('input_email');	// Campo email
	input_senha = document.getElementById('input_senha');	// Campo senha
	input_email_rec = document.getElementById('input_email_rec');	// Campo email para recuperar senha

	msg_email = document.getElementById('msg_email'); 	// Div da mensagem do campo nome
	msg_senha = document.getElementById('msg_senha');	// Div da mensagem do campo senha
	msg_login = document.getElementById('msg_login');	// Div da mensagem do login
	msg_rec = document.getElementById('msg_rec'); 	//Div da mensagem do campo email para recuperar senha
	act = document.getElementById('actions_rec'); 	//Div da mensagem do campo email para recuperar senha
	act2 = document.getElementById('actions_rec2'); 	//Div da mensagem do campo email para recuperar senha
	id_u = document.getElementById('id_u'); 	//Div da mensagem do campo email para recuperar senha
	senha1 = document.getElementById('senha1'); 	//Div da mensagem do campo email para recuperar senha
	senha2 = document.getElementById('senha2'); 	//Div da mensagem do campo email para recuperar senha
	msg_s1 = document.getElementById('msg_s1'); 	//Div da mensagem do campo email para recuperar senha
	msg_s2 = document.getElementById('msg_s2'); 	//Div da mensagem do campo email para recuperar senha

	span_email = $("#texto_email");	// texto da mensagem do campo email
	span_senha = $("#texto_senha");	// texto da mensagem do campo senha
	span_rec = $("#texto_rec");	// texto da mensagem do campo de email para recuperar senha
	span_s1 = $("#texto_s1");	
	span_s2 = $("#texto_s2");
	
	txt_vazio = "Preencha esse campo por favor";	// Texto para campo vazio
	txt_email_invalido = "Email inválido";	// Texto para email invalido
	txt_email_inexistente = "Não existe nenhuma conta cadastrada com esse email";	// Texto para email não cadastrado 

	$( "#btn_logar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$(document).find('#btn_logar').attr('class', 'ui fluid large teal submit loading button');
		msg_login.style.display = "none";
		botao.disabled = true;
		vEmail = IsEmpty(input_email, msg_email, span_email, false);
		vSenha = IsEmpty(input_senha, msg_senha, span_senha, true);

		if (!vEmail && !vSenha)
		{
			validaLogin();
		}
		else
		{
			msg_login.style.display = "none";
			$(document).find('#btn_logar').attr('class', 'ui fluid large teal submit button');
			botao.disabled = false;	
		}

  	});	

  	$( "#btn_redefinir" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		msg_s1.style.display = "none";
		msg_s2.style.display = "none";
		if (!IsEmpty(senha1, msg_s1, span_s1, false) && !IsEmpty(senha2, msg_s2, span_s2, true))
		{
			if (validaSenha(senha1, msg_s1, span_s1, false) && validaSenha(senha2, msg_s2, span_s2, true))
			{
				if (senha1.value == senha2.value) 
				{
					act2.style.marginTop = "";
					$.post("redefinir_senha",{senha:senha1.value, id:id_u.value},function(flag)
					{
						$('#modal_msg_senha').modal('show');
					});
				}
				else
				{
					msg_s2.style.display = "block";
					act2.style.marginTop = "2.8em";
					span_s2.html("As senhas não são iguais!");
				}
			}
		}
  	});	

  	$( "#div_esq_senha" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$('#modal_rec').modal('show');

  	});	

  	$( "#btn_recuperar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		if (!IsEmpty(input_email_rec, msg_rec, span_rec, false))
		{
			if(IsEmail(input_email_rec))
			{
				act.style.marginTop = "";
				validaEmail(input_email_rec);
			}
			else
			{
				msg_rec.style.display = "block";
				act.style.marginTop = "2.8em";
				span_rec.html(txt_email_invalido);
			}
		}
  	});	

  	function IsEmpty(input, msg, span, isPass)	// Faz a validacao dos campos se eles estao vazios
	{
		if (input.value) 	//Condicao se tiver algo escrito no campo
		{
			msg.style.display = "none";		
			act.style.marginTop = "";
			if (isPass)		//Condição se o campo for o de senha
			{
				botao.style.marginTop = "0";
				act2.style.marginTop = "0";
			}
			return false;
		}
		else 
		{
			msg.style.display = "block";
			act.style.marginTop = "2.8em";
			span.html(txt_vazio);
			if (isPass)		//Condição se o campo for de senha
			{
				botao.style.marginTop = "3.5em";	
				act2.style.marginTop = "2.8em";
			}
			return true;
		}
	}	

	function validaLogin()
	{
		$.post("verificar_login",{email:input_email.value, senha:input_senha.value},function(flag)	// Verifica no banco se o email existe
		{
			if (flag == "sucesso") 	// Condição se o email existir
			{
				msg_login.style.display = "none";
				form_log.submit();
			}
			else
			{
				botao.disabled = false;
				$(document).find('#btn_logar').attr('class', 'ui fluid large teal submit button');
				msg_login.style.display = "block";
			}
		});
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

   	function validaEmail()
	{
		$.post("verificar_email",{email:input_email_rec.value},function(flag)
		{
	        if (flag)	//Condição se o email existir
	        {
	        	botao.disabled = true;
	        	msg_rec.style.display = "none";	
	        	act.style.marginTop = "";
	        	recuperaSenha();
	        }
	        else
	        {
	        	msg_rec.style.display = "block";
	        	act.style.marginTop = "2.8em";
	        	span_rec.html(txt_email_inexistente);
	        }
	    });
	}

	function recuperaSenha()
	{
		$.post("recuperar_senha",{email:input_email_rec.value},function(data)
		{
			alert(data);
		});
	}

	function validaSenha(campo, msg, span, flag)
	{
		if ((campo.value.length) < 6)	//Condição se a senha ter menos de 6 caracteres
        {
        	msg.style.display = "block";	
        	span.html("A senha deve possuir pelo menos 6 caracteres");	// Escreve a mensagem que a senha tem menos de 6 caracteres
        	if (flag) 
        	{
        		act2.style.marginTop = "3.5em";
        	}
        	return false;
        }
        else
        {
        	msg.style.display = "none";
        	if (flag) 
        	{
        		act2.style.marginTop = "0em";
        	}
        	return true;
        }
	}
});