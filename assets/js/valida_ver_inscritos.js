$(document).ready(function()
{
	form_conf = document.getElementById('form_conf');	

	$( "#btn_conf_insc" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_conf.submit();
	});
});