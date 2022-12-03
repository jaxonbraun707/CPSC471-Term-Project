<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');

$title = 'Add a Contract';
$error = get_error_in_session();

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
			<h1 class="text-xl font-semibold m-4">Add a Contract</h1>

			<form class="m-4" method="POST" action="../contracts/post.php">
				<div class="mb-4">
					<input type="number" name="Proposal_No" class="border px-2 rounded w-64" placeholder="Enter Proposal Number">
				</div>
                <div class="mb-4">
					<input type="number" name="Contract_No" class="border px-2 rounded w-64" placeholder="Enter Contract Number">
				</div>
                <div class="mb-4">
					<input type="date" name="Start_Date" class="border px-2 rounded w-64" placeholder="Enter Start Date">
				</div>
                <div class="mb-4">
					<input type="date" name="Delivery_Date" class="border px-2 rounded w-64" placeholder="Enter Delivery Date">
				</div>
                <div class="mb-4">
					<input type="text" name="Payment_Terms" class="border px-2 rounded w-64" placeholder="Enter Payment Terms">
				</div>
                <div class="mb-4">
					<input type="date" name="Issued_Date" class="border px-2 rounded w-64" placeholder="Enter Issued_Date">
				</div>
                <div class="mb-4">
					<input type="date" name="Expiry_Date" class="border px-2 rounded w-64" placeholder="Enter Expiry_Date">
				</div>
                <div class="mb-4">
					<input type="number" name="Client_Id" class="border px-2 rounded w-64" placeholder="Enter Client_Id">
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Contract</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>