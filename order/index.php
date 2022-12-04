<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');

$title = 'Orders';
$orders = [];
$error = get_error_in_session();

// retrieve the designs via search.
$search_term = $_GET['search_term'] ?? '';
try {
	$orders = empty($search_term) ? get_orders($db): search_orders($db, $search_term);
	$orders = $orders->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
	$designs = [];
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
				<h1 class="text-xl font-semibold">Orders</h1>
				<div class="text-right">
					<a href="create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Order</a>
				</div>
			</div>
			<form class="m-4 flex" method="GET" action="index.php">
				<input class="border px-2 rounded grow" type="search" placeholder="Enter Order No. or Project No." name="search_term" value="<?=$search_term?>">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search for Order</button>
			</form>

			<div class="grid grid-cols-5 gap-8 m-4">
			<?php
			foreach($orders as $order) {
			?>
				<a href="order.php?id=<?=$order['Order_No']?>" class="border rounded hover:border-blue-500">
					<section>
						<dl class="p-2">
							<dt class="font-bold">Order No. <?=$order['Order_No'] ?></dt>
                            <dt class="font-bold">Project No. <?=$order['Project_No'] ?></dt>
							<dt class="font-bold">Ship Date <?=$order['Ship_Date'] ?></dt>
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