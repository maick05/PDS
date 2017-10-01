$(document).ready(function()
{
	form_insc = document.getElementById('form_inscrever');	
	form_canc = document.getElementById('form_cancelar');
	comprar = document.getElementById('comprar');

	nome = document.getElementById('psNome');
	valor = document.getElementById('psValor');
	id_insc = document.getElementById('psId_insc');

	$( "#btn_inscrever" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_insc.submit();
	});

	$( "#btn_cancelar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$('#msg_insc').modal('show');
	});

	$( "#btn_conf_canc" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_canc.submit();
	});

	$( "#btn_confirmar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$.post("/pds/pagseguro",{id_inscricao:id_insc.value, nome:nome.value, valor:valor.value},function(data)	// Verifica no banco se o email existe
		{
			$('#code').val(data);
			$('#comprar').submit();
		});
		
	});
});