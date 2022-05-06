<?php

/* Establecer una conexión con la base de datos. El primer argumento es el nombre del servidor, el segundo es el nombre de 
usuario de la base de datos, el tercero es la contraseña (en blanco para mí) y el final es el nombre de la base de datos.*/
$conn = mysqli_connect("localhost","chatbotUser","chatbotPass","Chatbot");

// Si la conexión se establece con éxito
if($conn)
{
     // Obtener el mensaje de los usuarios del objeto de solicitud y los caracteres de escape
    $user_messages = mysqli_real_escape_string($conn, $_POST['messageValue']);

    // crea una consulta SQL para recuperar la respuesta correspondiente
    $query = "SELECT * FROM preguntas WHERE pregunta LIKE '%".$user_messages."%'";

    // Ejecutar consulta en la base de datos conectada utilizando la consulta SQL
     $makeQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($makeQuery) > 0) 
    {

        // Obetener resultado
        $result = mysqli_fetch_assoc($makeQuery);

        // solo de la columna de respuesta
        echo $result['respuesta'];
    }else{

        // De lo contrario, repite este mensaje
        echo "Lo siento, intenta con otra pregunta.";
    }
}else {

    // Si la conexión no se establece, repite un mensaje de error
    echo "Connection failed" . mysqli_connect_errno();
}
?>