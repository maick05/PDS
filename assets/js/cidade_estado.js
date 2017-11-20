$(document).ready(function()
{
	$.post("listar_estados", function(data, status)
        {
          result = $.parseJSON(data);
          result.forEach(function(e, i){
            $('#estado_select').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
          })
     });
-
	$('#estado_select').on('change', function(e)
	{
		id_estado = this.value;
		$.post("cidades_por_estado", {id:id_estado}, function(data, status)
		{
			result = $.parseJSON(data);
			$('#cidade_select').empty( );
			result.forEach(function(e, i){
				$('#cidade_select').append('<option value="'+ e.id_cidade + '">'+ e.nome + '</option>')
			})	
		});
	});

	$.post("listar_estados", function(data, status)
        {
          result = $.parseJSON(data);
          result.forEach(function(e, i){
            $('#estado_select2').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
          })
     });
-
	$('#estado_select2').on('change', function(e)
	{
		id_estado = this.value;
		$.post("cidades_por_estado", {id:id_estado}, function(data, status)
		{
			result = $.parseJSON(data);
			$('#cidade_select2').empty( );
			result.forEach(function(e, i){
				$('#cidade_select2').append('<option value="'+ e.id_cidade + '">'+ e.nome + '</option>')
			})	
		});
	});
});