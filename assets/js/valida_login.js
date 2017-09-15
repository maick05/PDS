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

	span_email = $("#texto_email");	// texto da mensagem do campo email
	span_senha = $("#texto_senha");	// texto da mensagem do campo senha
	span_rec = $("#texto_rec");	// texto da mensagem do campo de email para recuperar senha
	
	txt_vazio = "Preencha esse campo por favor";	// Texto para campo vazio
	txt_email_invalido = "Email inválido";	// Texto para email invalido
	txt_email_inexistente = "Não existe nenhuma conta cadastrada com esse email";	// Texto para email não cadastrado 

	$( "#btn_logar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		vEmail = IsEmpty(input_email, msg_email, span_email, false);
		vSenha = IsEmpty(input_senha, msg_senha, span_senha, true);

		if (!vEmail && !vSenha)
		{
			validaLogin();
		}
		else
		{
			msg_login.style.display = "none";
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
		$.post("verificar_email",{email:input_email_rec.value},function(flag)	// Verifica no banco se o email existe
		{
	        if (flag)	//Condição se o email existir
	        {
	        	msg_rec.style.display = "none";		//Div msg_email fica visível
	        	act.style.marginTop = "";
	        }
	        else
	        {
	        	msg_rec.style.display = "block"; //Div msg_email fica invisível
	        	act.style.marginTop = "2.8em";
	        	span_rec.html(txt_email_inexistente);
	        }
	    });
	}
});