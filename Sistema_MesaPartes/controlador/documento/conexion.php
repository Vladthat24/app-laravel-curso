<?php 
$mysqli = new mysqli("localhost","root","","bd_mesapartes8"); 	
if(mysqli_connect_errno()){
  echo 'Conexion Fallida : ', mysqli_connect_error();
  exit();
}

function conexion(){
	return mysqli_connect("localhost","root","","bd_mesapartes8"); 	
}
?>