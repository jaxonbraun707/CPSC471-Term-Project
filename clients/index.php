<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/design.php');

$title = 'Clients';
$clients = [];
$error = NULL;

// retrieve the clients via search.
$search_term = $_GET['search_term'] ?? '';
try {
	$clients = empty($search_term) ? get_designs($db): search_designs($db, $search_term);
	$clients = $clients->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
	$clients = [];
	$error = 'Failed to execute search query or fetch data.';
}

include('../templates/top.php');
?>
<?php
include('../templates/top-bar.php');
?>
<div>
	<?php
	include('../templates/side-bar.php');
	?>
	<div class="pt-16 ml-64">
		<main class="m-4 border rounded">
			<!-- ideally, can put stuff here -->
			<h1 class="text-xl font-semibold p-4">Clients</h1>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>