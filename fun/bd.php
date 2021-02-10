<?php
require_once '../conexion.php';
//Búsqueda usuario
if (isset($_POST['search']))
{
    $salida = '';
    $query = "SELECT *from usuario";
    $result = pg_query($dbconn, $query);
    if (pg_num_rows($result) > 0)
    {

        $salida .= '<div class="table-responsive">
<table id="tabla1">
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Inicio Préstamo</th>
<th>Fin Préstamo</th>
<th>Semanas</th>
<th>Fecha de renovación</th>
<th>% de semanas para renovación</th>
</tr>
</thead>
<tbody>';
        while ($fila = pg_fetch_array($result))
        {
            $salida .= '
<tr>
<td>' . $fila["iduser"] . '</td>
<td>' . $fila["nombre"] . '</td>
<td>' . $fila["fechainicio"] . '</td>
<td>' . $fila["fechatermino"] . '</td>
<td>' . $fila["semanas"] . '</td>
<td>' . $fila["fecharenovacion"] . '</td>
<td>' . $fila["renovacionporcen"] . '</td>
</tr>';
        }
        $salida .= '</tbody>
</table>
</div>';
        echo $salida;
    }
    else
    {
        echo 'No se encontraron datos.';
    }
}

if (isset($_POST['finicio'], $_POST['ftermino'], $_POST['porcentaje']))
{
    $confirm = "true";
    $aviso = "";
    if($_POST['porcentaje'] == null || $_POST['finicio'] == "" || $_POST['ftermino']  == "" ){
        $semanas = "false";
        $renovacion = "true";
        echo json_encode(array(
            $semanas,
            $renovacion
        ));
    }else{
        $fechainicio = date_create($_POST['finicio']);
        $fechatermino = date_create($_POST['ftermino']);
    if($fechainicio > $fechatermino){
            $semanas = "true";
            $renovacion = "false";
            echo json_encode(array(
                $semanas,
                $renovacion
            ));
        }else{
            /*$fechainicio = date_create("2021-02-09"); //9 de febrero
            $fechatermino = date_create("2021-04-20");// 20 de abril
            echo "Fecha inicio: ".date_format($fechainicio, 'Y-m-d');*/

            
            //echo " Porcentaje: ".
            $porcentaje = $_POST['porcentaje'] / 100;
            //echo " Fecha renovacion1: ".date_format($fechainicio,'Y-m-d');
            //echo " dia de la semana: ".date_format($fechainicio, 'w');
            if (date_format($fechainicio, 'w') == '1') {
                date_modify($fechainicio, 'monday');
                date_modify($fechatermino, 'monday');
            }
            if (date_format($fechainicio, 'w') == '2') {
                date_modify($fechainicio, 'tuesday');
                date_modify($fechatermino, 'tuesday');
            }
            if (date_format($fechainicio, 'w') == '3') {
                date_modify($fechainicio, 'wednesday');
                date_modify($fechatermino, 'wednesday');
            }
            if (date_format($fechainicio, 'w') == '4') {
                date_modify($fechainicio, 'thursday');
                date_modify($fechatermino, 'thursday');
            }
            if (date_format($fechainicio, 'w') == '5') {
                date_modify($fechainicio, 'friday');
                date_modify($fechatermino, 'friday');
            }
            if (date_format($fechainicio, 'w') == '6') {
                date_modify($fechainicio, 'saturday');
                date_modify($fechatermino, 'saturday');
            }
            if (date_format($fechainicio, 'w') == '0') {
                date_modify($fechainicio, 'sunday');
                date_modify($fechatermino, 'sunday');
            }
            //echo " Fecha renovacion2: ".date_format($fechainicio,'Y-m-d');
            //echo " Semana inicio: ".
            $semanai = date_format($fechainicio, "W");
            //echo " Semana termino: ".
            $semanat = date_format($fechatermino, "W");
            //echo " Semanas: ".
            $semanas = $semanat - $semanai;

            //echo" Porcentaje: ".
            $porcentajef = round($semanas * $porcentaje);

            //date_add($fechainicio, date_interval_create_from_date_string($porcentajef.' weeks'));
            //$renovacion = date_format($fechainicio,'Y-m-d');
            $renovacion = date_format($fechainicio,'Y-m-d');
            //echo " Fecha renovacion: ". $renovacion;
            echo json_encode(array(
                $semanas,
                date('Y-m-d',strtotime($renovacion.'+ '.$porcentajef.' week'))

            ));
        }
    }
    
}

//registrar usuario
if (isset($_POST['nombre'], $_POST['porcentaje'], $_POST['inicio'], $_POST['termino'], $_POST['semanas'], $_POST['renovacion']))
{

    $nombre = $_POST['nombre'];
    $porcentaje = $_POST['porcentaje'];
    $fechainicio = $_POST['inicio'];
    $fechatermino = $_POST['termino'];
    $semanas = $_POST['semanas'];
    $fecharenovacion = $_POST['renovacion'];
   

        if (($nombre && $fechainicio && $fechatermino && $fecharenovacion) != "" && (($porcentaje && $semanas) != 0))
        {
            $query = "INSERT into usuario (nombre, fechainicio, fechatermino, semanas, renovacionporcen, fecharenovacion)
                                 values ('$nombre', '$fechainicio', '$fechatermino', $semanas, $porcentaje, '$fecharenovacion')";
            $result = pg_query($dbconn, $query) or die('La consulta fallo: ' . pg_last_error());
            if (!$result)
            {
                echo json_encode(array(
                    'error' => true
                ));
            }
            else
            {
                echo json_encode(array(
                    'error' => false
                ));
            }
        }
        else
        {
            echo json_encode(array(
                'error' => true
            ));
        }
    
}