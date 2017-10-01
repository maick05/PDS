$(document).ready(function()
{
	
	form_pesquisa = document.getElementById('form_pesquisar');	// Form do cadastro
	$( "#btn_pesquisar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_pesquisa.submit();
  	});	

  	
	id_exc = document.getElementById('id_exc');	// Campo nome


	$( "#img_exc" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$.get("ver_detalhes_excursao", {id:id_exc});
  	});	

});