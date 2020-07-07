<?php
include('valida_new_pass.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Resetear Pass</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<form class="login-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		<h2 class="form-title">Nuevo password</h2>
		<!-- form validation messages -->
		
		<div class="form-group">
			<label>Contraseña Actual</label>
			<input type="password" name="act_pass">
		</div>
		<div class="form-group">
			<label>Nueva contraseña</label>
			<input  minlength="8" type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirmar nueva contraseña</label>
			<input minlength="8" type="password" name="new_pass_c">
		</div>
		<div class="form-group">
			<button type="submit" name="new_password" class="login-btn">Confirmar</button>
		</div>
	</form>
</body>
</html>