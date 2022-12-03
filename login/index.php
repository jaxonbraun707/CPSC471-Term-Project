<?php
require_once('../init.php');
require_once('../db.php');
require_once('../login_functions.php');

if(is_logged_in($db)) {
	header("Location: ../index.php");
	die();
}

$error = get_error_in_session();

include('../templates/top.php');
?>
<div class="bg-slate-200 h-screen pt-48">
	<form class="bg-gray-50 p-4 m-auto	w-2/5 rounded border" method="POST" action="post.php">
		<h1 class="text-xl my-2">Welcome to <strong class="text-blue-500">WORC!</strong></h1>
		<?php
		if(!empty($error))
			include_once('../templates/error.php');
		?>
		<div class="mb-2">
			<input class="w-full p-2 rounded border" type="text" name="username" placeholder="Username">
		</div>
		<div class="mb-2">
			<input class="w-full p-2 rounded border" type="text" name="password" placeholder="Password">
		</div>
		<div class="text-right">
			<input class="px-4 py-2 bg-blue-500 rounded text-blue-50 cursor-pointer hover:bg-blue-400" type="submit" name="submit" value="Log in">
		</div>
	</form>
</div>
<?php
include('../templates/bottom.php');
?>