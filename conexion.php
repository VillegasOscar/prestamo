<?php

$host="ec2-54-162-119-125.compute-1.amazonaws.com";//
$port="5432";
$dbname="d6cq1mu736o1og";//
$user="sasifkwnxzmqbk";//
$password="0fa3f0030e04de727e28e4c07e91d5b11f9919457ffea47bac4337e5689c46f6";//
 
// detalles de la conexion
$conn_string = "host=$host port=$port dbname=$dbname  user=$user password=$password options='--client_encoding=UTF8'";
 
// establecemos una conexion con el servidor postgresSQL
$dbconn = pg_connect($conn_string);
 
// Revisamos el estado de la conexion en caso de errores. 
if(!$dbconn) {
echo "Error: No se ha podido conectar a la base de datos\n";
} else {
//echo "Conexión exitosa\n";
}
 
// Close connection
//pg_close($dbconn);
 
?>