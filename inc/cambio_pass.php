<?php include('app_logic.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Resetear Password</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<form class="login-form" action="login.php" method="post">
		<h2 class="form-title">Cambio de Password</h2>
		<!-- form validation messages -->
		<?php include('messages.php'); ?>
		<div class="form-group">
			<label>Usuario o Email</label>
			<input type="text" value="<?php echo $user; ?>" name="user">
		</div>
		<!--div class="form-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="form-group">
			<button type="submit" name="login_user" class="login-btn">Login</button>
		</div-->
		<p><a href="new_pass.php">¿Cambiar Password?</a></p>
	</form>
</body>
</html>