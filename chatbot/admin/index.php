<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href="css/bootstrap.min.css" rel="stylesheet">
	    <script src="js/bootstrap.min.js"></script>
	</head>
	<!-- se reliaza la conexion con la base de datos -->
	<body>
	    <div class="container">

    		<div class="row">
    			<h3>Panel Administrativo de la base de datos del Chatbot</h3>
    		</div>

			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Agregar una nueva pregunta</a>
				</p>

				<table class="table table-striped table-bordered">
		            <thead>
							<!-- se identifican las llaves primarias -->

		                <tr>
		                	<th>ID 	</th>
		                	<th>Pregunta 			</th>
                        	<th>Respuesta 			</th>
		                </tr>
		            </thead>
		            <tbody>
		              	<?php
						// conexion con la base de datos

					   	include 'database.php';
					   	$pdo = Database::connect();
					   	$sql = 'SELECT * FROM preguntas';
	 				   	foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
    					   	echo '<td>'. $row['pregunta'] . '</td>';
    					  	echo '<td>'. $row['respuesta'] . '</td>';
                            echo '<td width=250>';
    					   	echo '<a class="btn" href="read.php?id='.$row['idPre'].'">Detalles</a>';
    					   	echo '&nbsp;';
    					  	echo '<a class="btn btn-success" href="update.php?id='.$row['idPre'].'">Actualizar</a>';
    					   	echo '&nbsp;';
    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['idPre'].'">Eliminar</a>';
    					   	echo '</td>';
						  	echo '</tr>';
					    }
					   	Database::disconnect();
					  	?>
				    </tbody>
	            </table>
                <br /><br /><a href="/index.php"><div class="btn btn-danger">Cerrar Sesion</div></a>
	    	</div>

	    </div> <!-- /container -->
	</body>
</html>
