$(document).ready(function()
{
	form_insc = document.getElementById('form_inscrever');	
	form_inscritos = document.getElementById('form_inscritos');	
	form_canc = document.getElementById('form_cancelar');
	form_edit = document.getElementById('form_alterar');
	comprar = document.getElementById('comprar');

	nome = document.getElementById('psNome');
	valor = document.getElementById('psValor');
	id_insc = document.getElementById('psId_insc');
	id_criador = document.getElementById('id_criador');

	manter = document.getElementById('manter');
	outra = document.getElementById('outra');
	nao = document.getElementById('nao');

	id_excursao_aut = document.getElementById('id_excursao_aut');

	$( "#btn_inscrever" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_insc.submit();
	});

	$( "#btn_cancelar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$('#msg_insc').modal('show');
	});

	$( "#btn_alterar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_edit.submit();
	});

	$( "#btn_conf_canc" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_canc.submit();
	});

	$( "#btn_inscritos" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_inscritos.submit();
	});

	$( "#btn_confirmar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$.post("/pagseguro",{id_inscricao:id_insc.value, nome:nome.value, valor:valor.value, id_criador:id_criador.value},function(data)	// Verifica no banco se o email existe
		{
			alert(data);
			$('#code').val(data);
			$('#comprar').submit();
		});
		
	});

	$("#btn_vinc").on('click', function(e)
	{
		solicitaAutorizacao();
	});

	$( "#btn_pross" ).on('click', function(e)
	{
		if (manter.checked) 
		{
			$.post("manter_autorizacao",{id:id_excursao_aut.value}, function(data)
			{
				$('#modal_aut').modal('hide');	
			}); 
	    }
		else if (outra.checked) 
		{
			solicitaAutorizacao();
		}
		else(nao.checked)
		{
			$('#modal_aut').modal('hide');	
		}
	});

	function solicitaAutorizacao()
	{
		$.post("solicitar_autorizacao",function(data)
		{
	     	if (data) 
	     	{
	     		window.location.replace("https://pagseguro.uol.com.br/userapplication/v2/authorization/preregistration.jhtml?code=" + data);
	     	}   
	    });
	}

  	function verificaAutorizacao()
  	{
  		$.post("verificar_autorizacao",function(data)
		{
	     	if (data) 
	     	{
	     		$('#modal_aut').modal('show');
	     		label_email_aut.html("Manter a vinculação do pagseguro com a conta " + data);
	     		manter.checked = true;
	     	}
	     	else
	     	{
	     		$('#modal_pag').modal('show');
	     	}  
	    });
  	}
});