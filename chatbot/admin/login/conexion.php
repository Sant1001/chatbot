<?php
// se identifica el host , usario y contraseña que se quiere hacer referencias
$conn = new mysqli("localhost","chatbotUser","chatbotPass","Chatbot");
	
	if($conn->connect_errno)
	{
		echo "No hay conexión: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
?>