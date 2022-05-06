<?php
	//el coidgo leera lo que se le ingreso para compara con las primary key y se hace la conexion a la base de datos
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( $id==null) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM preguntas where idPre = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href=	"css/bootstrap.min.css" rel="stylesheet">
	    <script src=	"js/bootstrap.min.js"></script>
	</head>
    <!-- se lee primero la idPre la cual es nuestra primary key para verificar que lo hay --> 
	<body>
    	<div class="container">

    		<div class="span10 offset1">
    			<div class="row">
		    		<h3>Detalles de una pregunta</h3>
		    	</div>

	    		<div class="form-horizontal" >

					<div class="control-group">
						<label class="control-label">ID</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['idPre'];?>
							</label>
					    </div>
					</div>
	<!-- Se indetifican las preguntas a la base de datos para verifcar que es la pregunta que edera del primary key -->
					<div class="control-group">
					    <label class="control-label">Pregunta</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['pregunta'];?>
						    </label>
					    </div>
					</div>
	<!-- se identifca la respuesta de la pregunta -->
					<div class="control-group">
					    <label class="control-label">Respuesta</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['respuesta'];?>
						    </label>
					    </div>
					</div>

				    <div class="form-actions">
						<a class="btn" href="index.php">Regresar</a>
					</div>

				</div>
			</div>
		</div> <!-- /container -->
  	</body>
</html>
