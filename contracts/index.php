<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');

$title = 'Contracts';
$contracts = [];
$error = NULL;

// retrieve the clients via search.
$search_term = $_GET['search_term'] ?? '';
try {
	$contracts = empty($search_term) ? get_contracts($db): search_contracts($db, $search_term);
	$contracts = $contracts->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
	$contracts = [];
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
				<h1 class="text-xl font-semibold">Contracts</h1>
				<div class="text-right">
					<a href="../contracts/create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Contract</a>
				</div>
			</div>
			<form class="m-4 flex" method="GET" action="index.php">
				<input class="border px-2 rounded grow" type="search" placeholder="Enter Client Name, Contract No or Sales Contact" name="search_term" value="<?=$search_term?>">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search for Contract</button>
			</form>			
			
			<div class="grid grid-cols-5 gap-8 m-4">
			<?php
			foreach($contracts as $contract) {
			?>
				<a href="../contracts/contract.php?id=<?=$contract['Contract_No']?>" class="border rounded hover:border-blue-500">
					<section>
						<dl class="p-2">
							<dt class="font-bold"><?=$contract['Title'] ?></dt>
							<dt class="font-bold">Contract No:</dt>
							<dt class="font-bold"><?=$contract['Contract_No'] ?></dt>
							<dt class="font-bold">Start Date:</dt>
							<dt class="font-bold"><?=$contract['Start_Date'] ?></dt>
							<dt class="font-bold">Delivery Date:</dt>
							<dt class="font-bold"><?=$contract['Delivery_Date'] ?></dt>
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