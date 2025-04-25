<?php
    session_start();
    include '../include/validar_sesion.php';
    include 'encabezado.php';
    $conex = new database;
    $con = $conex ->conectar();
    
?>
<?php
if (isset($_POST['enviar'])) {
    $doc_usuario = $_SESSION['documento'];
    $id_libro = $_POST['libro'];
	$fe_prestamo = date('Y-m-d');

    $fecha = new DateTime($fe_prestamo);
    $fecha->modify('+10 days');
    $fe_devolucion = $fecha->format('Y-m-d');
    $id_estado = 1;
	
	$consulta_validacion = "SELECT detalle_prestamo_libro.id_libro 
	FROM prestamos 
	INNER JOIN detalle_prestamo_libro 
	ON prestamos.id_prestamo = detalle_prestamo_libro.id_prestamo 
	WHERE prestamos.doc_usuario = '$doc_usuario' 
	AND detalle_prestamo_libro.id_libro = '$id_libro' 
	AND prestamos.estado = 1";

$resultado_validacion = $con->query($consulta_validacion);

	if ($resultado_validacion->rowCount() > 0) {
	echo "<script>alert('Ya tienes este libro prestado y no lo has devuelto. No puedes solicitarlo nuevamente.');</script>";
	} else {
	
		$insertar_prestamo = "INSERT INTO prestamos (doc_usuario, fe_prestamo, fe_devolucion, estado)
			VALUES ('$doc_usuario', '$fe_prestamo', '$fe_devolucion', '$id_estado')";
		$con->exec($insertar_prestamo);

		$id_prestamo = $con->lastInsertId();

		$insertar_detalle = "INSERT INTO detalle_prestamo_libro (id_prestamo, id_libro)
			VALUES ('$id_prestamo', '$id_libro')";
		$con->exec($insertar_detalle);

		$actualizar_libro = "UPDATE libros 
			SET cantidad = cantidad - 1 
			WHERE id_libro = '$id_libro' AND cantidad > 0";
		$con->exec($actualizar_libro);

		echo "<script>alert('Préstamo realizado con éxito. Recuerde que el tiempo de devolución es de 10 días.');</script>";
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>solicitar prestamo</title>
	<link rel="stylesheet" href="../css/styles_admin.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <ul>
        <li><a href="index.php" class="current">Volver </a></li>
    </ul> 

    <div class="contenedor_form">
        <form class="FormularioAjax" method="POST" data-form="save" data-lang="es" action="" autocomplete="off" enctype="multipart/form-data">            
			<div class="texto_separador">
				<h1>Formulario para solicitar libro</h1>
				<div>
					<ul>   
						<li>
							<label for="categoria" class="nav-link"><strong>Categoría del libro</strong></label>
							<select class="form-control" name="categoria" id="categoria" required>
								<option value="" selected>-- Seleccione la categoría --</option>
								<?php
									$consulta = $con->prepare('SELECT id_categoria, categoria FROM categoria');
									$consulta->execute();
									while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
										echo "<option value=" . $fila['id_categoria'] . ">" . $fila['categoria'] . "</option>";
									}
								?>
							</select>
						</li>

						<li>
							<label for="autor" class="nav-link"><strong>Autor del libro</strong></label>
							<select class="form-control" name="autor" id="autor" required>
								<option value="" selected>-- Seleccione el autor --</option>
								<?php
									$consulta = $con->prepare('SELECT id_autor, autor FROM autor');
									$consulta->execute();
									while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
										echo "<option value=" . $fila['id_autor'] . ">" . $fila['autor'] . "</option>";
									}
								?>
							</select>
						</li>

						<li>
							<label for="libro" class="nav-link"><strong>Nombre del libro</strong></label>
							<select class="form-control" name="libro" id="libro" required>
								<option value="" selected>-- Seleccione el libro --</option>
								<?php
									$consulta = $con->prepare('SELECT id_libro, nom_libro FROM libros');
									$consulta->execute();
									while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
										echo "<option value=" . $fila['id_libro'] . ">" . $fila['nom_libro'] . "</option>";
									}
								?>
							</select>
						</li>

						<li>
							<label for="imagen" class="nav-link"><strong>Libro</strong></label>
							<div id="imagen" style="width: 300px; height: auto;">
							</div>
						</li>

						<li>
							<input type="submit" name="enviar" value="solicitar">
						</li>
					</ul>
				</div>
			</div>
		</form>
	</div> 

</div> 

</body>
<!-- Autor -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#categoria').change(function() {
            $.ajax({
                type: "POST",
                url: "consultas/autores.php",
                data: { categoria: $('#categoria').val() },
                success: function(r) {
                    $('#autor').html(r);
                    $('#libro').html('<option value="">-- Seleccione el libro --</option>');
                    $('#imagen').html('');
                }
            });
        });
    });
</script>

<!-- Libros -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#autor').change(function() {
            $.ajax({
                type: "POST",
                url: "consultas/libros.php",
                data: { autor: $('#autor').val() },
                success: function(r) {
                    $('#libro').html(r);
                    $('#imagen').html('');
                }
            });
        });
    });
</script>

<!-- imagen -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#libro').change(function() {
            $.ajax({
                type: "POST",
                url: "consultas/imagen.php",
                data: { libro: $('#libro').val() },
                success: function(r) {
                    $('#imagen').html(r);
                }
            });
        });
    });
</script>