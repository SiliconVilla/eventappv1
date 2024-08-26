/*$(document).ready(function(){
	//alert('Ejecutado');
	$('#lista_de_proyectos').on('change', alCambiarProyecto);
	//Acceder a niveles a través de ajax webservices
	
});


function alCambiarProyecto(){
	var project_id = $(this).val();
	alert(project_id);
	console.log(project_id);

	if (!project_id) {
		$('#lista_de_niveles').html('<option value="">Seleccione Nivel</option>');
		return;
	}

	//Acceder a niveles a través de ajax webservices
	$.get('../api/proyecto/'+project_id+'/niveles', function (data){
		//console.log(data);
		var html_select = '<option value="">Seleccione Nivel</option>';
		for (var i = 0; i < data.length; i++) {
			html_select += '<option value="'+data[i].id+'">'+data[i].namenivel+'</option>';
		}
		console.log(html_select);
		$('#select-level').html(html_select);
	});
}*/