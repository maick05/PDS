$(document).ready(function()
{
	
	form_pesquisa = document.getElementById('form_pesquisar');	// Form do cadastro
	$( "#btn_pesquisar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_pesquisa.submit();
  	});	

});