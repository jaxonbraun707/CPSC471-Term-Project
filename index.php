<?php
require_once('init.php');
require_once('must_be_logged_in.php');
require_once('db.php');

$title = 'WORC';
$designs = [];
$error = get_error_in_session();

include('templates/top.php');
?>
<?php
include('templates/top-bar.php');
?>
<div>
	<?php
	include('templates/side-bar.php');
	?>
	<div class="pt-16 ml-64">
		<main class="m-4 border rounded">
			<!-- ideally, can put stuff here -->
			<h1 class="text-5xl p-16 text-center">Welcome to <strong class="text-blue-500">WORC!</strong></h1>
		</main>
	</div>
</div>
<?php
include('templates/bottom.php');
?>