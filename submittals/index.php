<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');

$title = 'Submittals';
$submittals = [];
$error = get_error_in_session();

// retrieve the submittals via search.
$search_term = $_GET['search_term'] ?? '';
try {
	$submittals = empty($search_term) ? get_submittals($db): search_submittals($db, $search_term);
} catch(Exception $e) {
	$submittals = [];
	$error = 'Failed to execute search query or fetch data.';
}

if (!empty($submittals)) {
	$submittals = $submittals->fetchAll(PDO::FETCH_ASSOC);
} else {
	$submittals = [];
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
			<div class="grid grid-cols-2 m-4">
				<?php
					if (!empty($error)) {
				?>
					<section class="col-span-2 bg-red-100 border border-red-500 rounded text-red-500 p-4 mb-4">
						<p>
							Error: <?=$error?>
						</p>
					</section>
				<?php
					}
				?>
				<h1 class="text-xl font-semibold">Submittals</h1>
				<div class="text-right">
					<a href="<?=BASE_URL?>/submittals/create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Submittal</a>
				</div>
			</div>
			<form class="m-4 flex" method="GET" action="<?=BASE_URL?>/submittals/index.php">
				<input class="border px-2 rounded grow" type="search" placeholder="Enter Design No. or Author" name="search_term" value="<?=$search_term?>">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search for Submittal</button>
			</form>

			<div class="grid grid-cols-5 gap-8 m-4">
			<?php
			foreach($submittals as $submittal) {
			?>
				<a href="<?=BASE_URL?>/submittals/submittal.php?id=<?=$submittal['Submittal_No']?>" class="border rounded hover:border-blue-500">
					<section>
						<div class="text-center bg-gray-100 h-32">
							<img src="#" alt="Submittal Image Placeholder">						
						</div>
						<dl class="p-2">
							<dt class="font-bold">Submittal No. <?=$submittal['Submittal_No'] ?></dt>
							<dd>Attachments: <?=$submittal['Count']?></dd>
						</dl>
					</section>
				</a>
			<?php
			}
			?>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>