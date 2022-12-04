<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/project.php');
require_once('../data/design.php');
require_once('../data/contract.php');

$title = 'Add a Project';
$error = get_error_in_session();

$contracts = [];
$contracts = get_contracts($db);
$contracts = $contracts ? $contracts->fetchAll(PDO::FETCH_ASSOC) : [];

$designs = [];
$designs = get_designs($db);
$designs = $designs ? $designs->fetchAll(PDO::FETCH_ASSOC) : [];


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
			<?php
				if (!empty($error)) {
			?>
				<section class="bg-red-100 border border-red-500 rounded text-red-500 p-4 m-4">
					<p>
						Error: <?=$error?>
					</p>
				</section>
			<?php
				}
			?>
			<h1 class="text-xl font-semibold m-4">Add a Project</h1>

			<form class="m-4" method="POST" action="<?=BASE_URL?>/projects/post.php">
				<div class="mb-4">
					Start Date: <input class="border rounded px-2" type="date" name="start_date">
				</div>
				<div class="mb-4">
					End Date: <input class="border rounded px-2" type="date" value="<?=$project['End_Date']?>" name="end_date">
				</div>
				<div class="mb-4">
					<label for="contract">Select Contract:</label>
					<select name="contract" id="contract" class="border">
						<?php
						foreach($contracts as $contract) {
						?>
							<option value="<?=$contract['Contract_No']?>"><?=$contract['Contract_No']?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="mb-4">
					<label for="design">Select Design:</label>
					<select name="design" id="design" class="border">
						<?php
						foreach($designs as $design) {
						?>
							<option value="<?=$design['Design_No']?>"><?=$design['Design_No']?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Project</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>