$(document).ready(function()
{
	
	form_pesquisa = document.getElementById('form_pesquisar');	
	input_pesquisa = document.getElementById('input_pesquisa');	
	input_pag = document.getElementById('input_pag');
	$( "#btn_pesquisar" ).on('click', function(e)	
	{
		form_pesquisa.submit();
	});	

	id_exc = document.getElementById('id_exc');	


	$( "#img_exc" ).on('click', function(e)	
	{
		$.get("ver_detalhes_excursao", {id:id_exc});
	});	

});