//document.ready
$(document).ready(function(){
	mostrarTabla1();
});
//funciones
function mostrarTabla1(){
	var txt = '0';

	$.ajax({
		url:"../fun/bd.php",
		method:"post",
		data:{search:txt},
		dataType:"text",
		success:function(data)
		{
			$('#result1').html(data);
			$("#tabla1").dataTable().fnDestroy();
			$('#tabla1').DataTable({
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
				},
				"order": [[ 0, "asc" ]]
			});
		}
	});
}
//Alerta Registrar Usuario
jQuery(document).on('submit','#formRU', function(event){
	event.preventDefault();

	jQuery.ajax({
		url: '../fun/bd.php',
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
			$('#btnRU').val('Registrando...');
			document.getElementById("btnRU").disabled=true;

		}
	})
	.done(function(respuesta){
		if(!respuesta.error){
			
			var mensaje = '<div class="alert alert-success" role="alert">'+
                                'Cliente registrado. Espere que se actualice la página.'+
                                '</div>';
                $('.error').html(mensaje); 
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
				
				location.reload();

			}, 5000);

			

		}else{
			var mensaje = '<div class="alert alert-danger" role="alert">'+
                                'No se pudo registrar el Cliente. Verifique los datos.'+
                                '</div>';
                $('.error').html(mensaje); 
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');

			}, 6000);
			setTimeout(function(){
				$('#btnRU').val('Confirmar');
				document.getElementById("btnRU").disabled=false;

			}, 5000);
			

			
			
		}
	})
	.fail(function(resp){
		var mensaje = '<div class="alert alert-warning" role="alert">'+
                                'Contacte con el administrador.'+
                                '</div>';
                $('.error').html(mensaje); 
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');

			}, 6000);
			setTimeout(function(){
				$('#btnRU').val('Confirmar');

			}, 5000);
	})
});