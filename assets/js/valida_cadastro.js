$(document).ready(function()
{
	form_cad = document.getElementById('form_cadastro');	// Form do cadastro
	botao = document.getElementById('btn_cadastrar');	// Botão de Cadastrar

	input_nome = document.getElementById('input_nome');	// Campo nome
	input_email = document.getElementById('input_email');	// Campo email
	input_senha = document.getElementById('input_senha');	// Campo senha

	msg_nome = document.getElementById('msg_nome');	// Div da mensagem do campo nome
	msg_email = document.getElementById('msg_email'); 	// Div da mensagem do campo nome
	msg_senha = document.getElementById('msg_senha');	// Div da mensagem do campo senha

	span_nome = $("#texto_nome");	// texto da mensagem do campo nome
	span_email = $("#texto_email");	// texto da mensagem do campo email
	span_senha = $("#texto_senha");	// texto da mensagem do campo senha
	
	txt_vazio = "Preencha esse campo por favor";	// Texto para campo vazio
	txt_email_existe = "Esse email já está sendo usado, por favor insira um email diferente";	// Texto para email que já existe
	txt_senha_pequena = "Sua senha deve ter pelo menos 6 caracteres"; //Texto para senha muito pequena
	txt_email_invalido = "Email invalido"; //Texto para email invalido


	$( "#input_email" ).on('change', function(e)		// Função para quando mudar o contéudo do campo email
	{
		if (!IsEmpty(input_email, msg_email, span_email, false, false)) 
		{
			validaEmail(false);
		}
	});

	$( "#input_senha" ).on('change', function(e)		// Função para quando mudar o contéudo do campo senha
	{
        validaSenha();
	});

	$( "#btn_cadastrar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$(document).find('#btn_cadastrar').attr('class', 'ui fluid large teal submit loading button');
		botao.disabled = true;
		IsSubmit = false;
		nome = false;

   		nome = !(IsEmpty(input_nome, msg_nome, span_nome, false, true));	
   		
   		if (!IsEmpty(input_email, msg_email, span_email, false, true))
   		{
   			validaEmail(false);
   			IsSubmit = nome;
   		}
   		else
   		{
   			IsSubmit= false; 
   			$(document).find('#btn_cadastrar').attr('class', 'ui fluid large teal submit button');
			botao.disabled = false;
   		}

   		if (!IsEmpty(input_senha, msg_senha, span_senha, true, true)) 
   		{
   			if (validaSenha() && IsSubmit) 
   			{
   				validaEmail(IsSubmit);
   			}
   			else
   			{
   				$(document).find('#btn_cadastrar').attr('class', 'ui fluid large teal submit button');
				botao.disabled = false;
   			}
   		}
   		else
   		{
   			$(document).find('#btn_cadastrar').attr('class', 'ui fluid large teal submit button');
			botao.disabled = false;
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

	function validaSenha()
	{
		if ((input_senha.value.length) < 6)	//Condição se a senha ter menos de 6 caracteres
        {
        	msg_senha.style.display = "block";	
        	span_senha.html(txt_senha_pequena);	// Escreve a mensagem que a senha tem menos de 6 caracteres
        	botao.style.marginTop = "3.5em";
        	return false;
        }
        else
        {
        	msg_senha.style.display = "none";
        	botao.style.marginTop = "0";
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
		        		form_cad.submit();
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
});