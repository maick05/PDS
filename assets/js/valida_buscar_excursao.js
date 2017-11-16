$(document).ready(function()
{
	
	form_pesquisa = document.getElementById('form_pesquisar');	// Form do cadastro
	input_pesquisa = document.getElementById('input_pesquisa');	// Form do cadastro
	input_pag = document.getElementById('input_pag');	// Form do cadastro
	$( "#btn_pesquisar" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		form_pesquisa.submit();
	});	

	$( "#input_pesquisa" ).on('change', function(e)		// Função para quando mudar o contéudo do campo email
	{
		if (input_pag.value == "tem") 
		{
			form_pesquisa.action = "../pesquisar_excursoes/" + input_pesquisa.value;
		}
		else
		{
			form_pesquisa.action = "pesquisar_excursoes/" + input_pesquisa.value;
		}
	});


	id_exc = document.getElementById('id_exc');	// Campo nome


	$( "#img_exc" ).on('click', function(e)	// Função clique do botao de cadastrar
	{
		$.get("ver_detalhes_excursao", {id:id_exc});
	});	

});