<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$login = getFormValue('login');
	$senha = getFormValue('senha');

	$aut = SYSLogin::instanciar();
	if ($aut->login($login, $senha)) {
		$oldURL = base64_decode($args[0]);
		if(strlen($oldURL)==0) $oldURL = baseURL;
		header("Location: ".$oldURL);
	}
}
?>
<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #eee;
}

.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}

.form-signin .form-signin-heading,
.form-signin .checkbox {
	margin-bottom: 10px;
}

.form-signin .checkbox {
	font-weight: normal;
}

.form-signin .form-control {
	position: relative;
	height: auto;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 10px;
	font-size: 16px;
}

.form-signin .form-control:focus {
	z-index: 2;
}

.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>

<div class="container">
	<form class="form-signin" role="form" method="post">
		<h2 class="form-signin-heading">GoofyBNU</h2>
		<label for="login" class="sr-only">Login</label>
		<input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
		<label for="senha" class="sr-only">Senha</label>
		<input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
	</form>
</div> <!-- /container -->
