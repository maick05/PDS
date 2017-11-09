$(document).ready(function()
{
	form_ver_p = document.getElementById('form_ver_p');	
	form_ver_c = document.getElementById('form_ver_c');	

	$( "#btn_ver_p" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_ver_p.submit();
	});

	$( "#btn_ver_c" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_ver_c.submit();
	});
});