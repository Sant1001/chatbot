<?php
// se realiza un log in para los usarios
 include('conexion.php');

$usu 	= $_POST["txtusuario"];
$pass 	= $_POST["txtpassword"];
$rol 	= $_POST["rol"];

// se indetifca su usario oo un administrador

$queryusuario = mysqli_query($conn,"SELECT * FROM login WHERE usuario ='$usu' and pass = '$pass' and rol = '$rol'");
$nr 		= mysqli_num_rows($queryusuario);  
	
if ($nr == 1 )  
	{ 
		if($rol=="Usuario")
			{	
				header("Location: pag_user.php");
			}
		else if ($rol=="Admin")
			{
				header("Location: /admin/index.php");
			}
	}
else
	{
	echo "<script> alert('Usuario, contraseña o rol incorrecto.');window.location= 'index.html' </script>";
	}

/*VaidrollTeam*/
?>