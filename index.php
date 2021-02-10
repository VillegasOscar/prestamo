<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamos</title>
</head>
<body>
<div class="error" ></div>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <h1>Registrar Cliente</h1>
            <form>
            <div class="row">
                <div class="form-group col-md-7">
                    <input  type="text" class="form-control" id="nombre"  placeholder="Nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                <label for="porcentaje">Porcentaje de semanas para renovación: </label>
                    <input  type="number" class="form-control" id="porcentaje"  placeholder="Porcentaje para renovación" required>
                </div>
            </div>
                <div class="form-group col-md-12">
                    <h3>Periodo de préstamo.</h3>
                    <label for="inicio">De: </label>
                    <input type="date"  id="inicio">
                    <label for="termino">A: </label>
                    <input type="date"  id="termino">
                    <button type="button" class="btn btn-success" onclick="calcular()">Calcular</button>
                
                </div>
                <div class="form-group col-md-3">
                <label for="semanas">Número de semanas del periodo: </label>
                <input  type="number" class="form-control" id="semanas"  placeholder="Número de semanas" disabled required>
                </div>
                <div class="form-group col-md-3">
                <label for="renovacion">Fecha de renovación: </label>
                <input type="date"  id="renovacion" disabled>
                </div>
                
                <div class="form-group col-md-12">
                <button type="button" class="btn btn-success" onclick="confirmaRegistrar()">Registrar</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-md-12">
            <h1>Lista de Clientes</h1>
            <div class="row" >
            <div class="form-group col-md-12" >
                <div id="result1"></div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <?php
      include "modal.php";
      ?>
    <script src="css/js/JQuery-3-4-1.min.js"></script>
    <script src="css/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
<script>

function calcular(){
    var termino = $("#termino").val();
    var inicio = $("#inicio").val();
    var porcentaje = $("#porcentaje").val();
    jQuery.ajax({
		url: '../fun/bd.php',
		type: 'POST',
		dataType: 'json',
		data: {ftermino: termino, finicio: inicio, porcentaje: porcentaje}
  })
  .done(function(respuesta){
    var semanas = respuesta[0];
    var renovacion = respuesta[1];
    if(semanas == "false"){

        var mensaje = '<div class="alert alert-danger" role="alert">'+
                                'No debe de haber campos vacíos. Verifique los datos'+
                                '</div>';
                $('.error').html(mensaje); 
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');

			}, 6000);
        }
        if(renovacion == "false"){
            var mensaje = '<div class="alert alert-danger" role="alert">'+
                                'La fecha inicial no debe de ser mayor a la fecha de termino.'+
                                '</div>';
                $('.error').html(mensaje); 
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');

			}, 6000);
        }
        if(semanas != false || renovacion != false){
            $('#semanas').val(semanas);
            $('#renovacion').val(renovacion);
        }
    
  })
}

</script>
<script>
function confirmaRegistrar(){
  $('#edit1').modal('show');
  var texto=document.getElementById("nombre").value;
  document.getElementById("nombrec").value = texto;

  var texto=document.getElementById("porcentaje").value;
  document.getElementById("porcentajec").value = texto;
  
  var texto=document.getElementById("inicio").value;
  document.getElementById("inicioc").value = texto;

  var texto=document.getElementById("termino").value;
  document.getElementById("terminoc").value = texto;

  var texto=document.getElementById("semanas").value;
  document.getElementById("semanasc").value = texto;

  var texto=document.getElementById("renovacion").value;
  document.getElementById("renovacionc").value = texto;
  
                  
                  
                  
  
 
}
</script>