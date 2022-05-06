<?php

	require 'database.php';

		$p_idError = null;
		$pregError = null;
		$respError = null;


	if ( !empty($_POST)) {

		// realizar un seguimiento de los valores de las publicaciones
		$p_id = $_POST['p_id'];
		$preg = $_POST['preg'];
		$resp = $_POST['resp'];

		// validar input
		$valid = true;

		if (empty($preg)) {
			$pregError = 'Por favor escribe una pregunta';
			$valid = false;
		}
		if (empty($resp)) {
			$respError = 'Por favor selecciona una respuesta';
			$valid = false;
		}
		// insertar data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO preguntas (idPre,pregunta,respuesta) values(null, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($preg,$resp));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href=	"css/bootstrap.min.css" rel="stylesheet">
	    <script src=	"js/bootstrap.min.js"></script>
	</head>
		<!-- se realiza un cerate en la interfaz del chatbot para las preguntas-->

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h3>Agregar una pregunta nueva</h3>
		   		</div>

				<form class="form-horizontal" action="create.php" method="post">
		<!-- se realiza reliza que no este vacia la pregunta en caso del create-->

					<div class="control-group <?php echo !empty($pregError)?'error':'';?>">
						<label class="control-label">Pregunta</label>
					    <div class="controls">
					      	<input name="preg" type="text"  placeholder="Pregunta" value="<?php echo !empty($preg)?$preg:'';?>">
					      	<?php if (($pregError != null)) ?>
					      		<span class="help-inline"><?php echo $pregError;?></span>
					    </div>
					</div>

					<div class="control-group <?php echo !empty($respError)?'error':'';?>">
						<label class="control-label">Respuesta</label>
					    <div class="controls">
					      	<input name="resp" type="text"  placeholder="Respuesta" value="<?php echo !empty($resp)?$resp:'';?>">
					      	<?php if (($respError != null)) ?>
					      		<span class="help-inline"><?php echo $respError;?></span>
					    </div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn" href="index.php">Regresar</a>
					</div>

				</form>
			</div>
	    </div> <!-- /container -->
	</body>
</html>
