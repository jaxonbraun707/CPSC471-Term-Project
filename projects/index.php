<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/project.php');

$title = 'Projects';
$projects = [];
$error = get_error_in_session();

// retrieve the projects via search.
$search_term = $_GET['search_term'] ?? '';
try {
	$projects = empty($search_term) ? get_projects($db): search_projects($db, $search_term);
	$projects = $projects->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
	$projects = [];
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
				<h1 class="text-xl font-semibold">Projects</h1>
				<div class="text-right">
					<a href="<?=BASE_URL?>/projects/create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Project</a>
				</div>
			</div>
			<form class="m-4 flex" method="GET" action="<?=BASE_URL?>/projects/index.php">
				<input class="border px-2 py-4 rounded grow" type="search" placeholder="Enter Project No. or Client Company/Contact Name" name="search_term" value="<?=$search_term?>">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search for Project</button>
			</form>

			<table class="w-full">
				<thead>
					<tr class="border-b">
						<td class="py-2 px-4">Project No</td>
						<td class="py-2 px-4">Start Date</td>
						<td class="py-2 px-4">End Date</td>
						<td class="py-2 px-4">Budget</td>
						<td class="py-2 px-4">Client</td>
						<td class="py-2 px-4">Contact</td>
						<td class="py-2 px-4">&nbsp;</td>
					</tr>
				</thead>
			<?php
			foreach($projects as $project) {
			?>
				<tbody>
					
						<tr>
							<td class="py-2 px-4"><?=$project['Project_No']?></td>
							<td class="py-2 px-4"><?=date_format(date_create($project['Start_Date']), "F m, Y")?></td>
							<td class="py-2 px-4"><?=date_format(date_create($project['End_Date']), "F m, Y")?></td>
							<td class="py-2 px-4"><?=number_format($project['Budget'], 2).' CAD' ?></td>
							<td class="py-2 px-4"><?=$project['Company_Name']?></td>
							<td class="py-2 px-4"><?=$project['Contact_Name']?></td>
							<td class="py-2 px-4">
								<a href="<?=BASE_URL?>/projects/project.php?id=<?=$project['Project_No']?>" class="hover:text-blue-500 font-semibold underline">
									View Details
								</a>
							</td>
						</tr>
				</tbody>
			<?php
			}
			?>
			</table>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>