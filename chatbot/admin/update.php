<?php

	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( null==$id ) {
		header("Location: index.php");
	}

	if ( !empty($_POST)) {
		// realizar un seguimiento de los errores de validación
		$p_idError = null;
		$pregError = null;
		$respError = null;

		// realizar un seguimiento de los valores de las publicaciones
		$p_id = $_POST['p_id'];
		$preg = $_POST['preg'];
		$resp = $_POST['resp'];

		/// validar input
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
			$sql = "UPDATE preguntas set idPre = ?, pregunta = ?, respuesta =? WHERE idPre = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($p_id,$preg,$resp,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM preguntas where idPre = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$p_id = $data['idPre'];
		$preg = $data['pregunta'];
		$resp = $data['respuesta'];
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
		<!-- se realiza un update en la interfaz del chatbot-->
	<body>
    	<div class="container">
    		<div class="span10 offset1">
    			<div class="row">
		    		<h3>Actualizar una pregunta</h3>
		    	</div>

	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

					  <div class="control-group <?php echo !empty($p_idError)?'error':'';?>">

					    <label class="control-label">id</label>
					    <div class="controls">
					      	<input name="p_id" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
					      	<?php if (!empty($p_idError)): ?>
					      		<span class="help-inline"><?php echo $p_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
								<!-- verificar si el cuadro de texto esta vacio-->
					  <div class="control-group <?php echo !empty($pregError)?'error':'';?>">

					    <label class="control-label">pregunta</label>
					    <div class="controls">
					      	<input name="preg" type="text" placeholder="Pregunta" value="<?php echo !empty($preg)?$preg:'';?>">
					      	<?php if (!empty($pregError)): ?>
					      		<span class="help-inline"><?php echo $pregError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
								<!-- Verificar e impirmir la repsuesta en el chatbot-->
                      <div class="control-group <?php echo !empty($respError)?'error':'';?>">

                        <label class="control-label">respuesta</label>
                        <div class="controls">
                            <input name="resp" type="text" placeholder="Respuesta" value="<?php echo !empty($resp)?$resp:'';?>">
                            <?php if (!empty($respError)): ?>
                                <span class="help-inline"><?php echo $respError;?></span>
                            <?php endif;?>
                        </div>
                        </div>
								<!-- Verifica que se realiazo la actualizacion de las preguntas para respinder una nueva-->

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="index.php">Regresar</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>