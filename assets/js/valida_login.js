$(document).ready(function()
{
	form_log = document.getElementById('form_login');	// Form do Login
	botao = document.getElementById('btn_logar');	// Botão de Login

	input_email = document.getElementById('input_email');	// Campo email
	input_senha = document.getElementById('input_senha');	// Campo senha

	msg_email = document.getElementById('msg_email'); 	// Div da mensagem do campo nome
	msg_senha = document.getElementById('msg_senha');	// Div da mensagem do campo senha
	msg_login = document.getElementById('msg_login');	// Div da mensagem do login

	span_email = $("#texto_email");	// texto da mensagem do campo email
	span_senha = $("#texto_senha");	// texto da mensagem do campo senha
	
	txt_vazio = "Preencha esse campo por favor";	// Texto para campo vazio

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

  	function IsEmpty(input, msg, span, isPass)	// Faz a validacao dos campos se eles estao vazios
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
			msg.style.display = "block";
			span.html(txt_vazio);
			if (isPass)		//Condição se o campo for o de senha
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
			if (flag == "sucesso") 
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
});