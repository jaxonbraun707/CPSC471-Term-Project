<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/proposal.php');
require_once('../data/employee.php');

$title = 'Add a Proposal';
$error = get_error_in_session();

// retrieve employees needed for the employees field.
$employees = [];
$employees = get_employees_by_job($db, $_job_types['sales']);
$employees = $employees->fetchAll(PDO::FETCH_ASSOC);

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
			<h1 class="text-xl font-semibold m-4">Add a Proposal</h1>
            
			<form class="m-4" method="POST" action="../proposals/post.php">
                <div class="mb-4">
					<input type="number" name="Proposal_No" class="border px-2 rounded w-64" placeholder="Enter Proposal Number">
				</div>
                <div class="mb-4">
					<input type="text" name="Title" class="border px-2 rounded w-64" placeholder="Enter Proposal Title">
				</div>
				<div class="mb-4">
					<label for="salesperson">Select Sales Person:</label>
					<select name="salesperson" id="salesperson" multiple class="border align-top">
						<?php
						foreach($employees as $employee) {
						?>
							<option value="<?=$employee['SSN']?>"> <?=$employee['First_Name']?> <?=$employee['Last_Name']?></option>
						<?php
						}
						?>
					</select>
				<div class="mb-4">
					<input type="number" name="Client_Id" class="border px-2 rounded w-64" placeholder="Enter Client ID">
				</div>
                <div class="mb-4">
				<dt class="text-base">$ <input type="number" name="Value" class="border px-2 rounded w-64" placeholder="Enter Value">
				</div>
				<dt class="text-base">Issue Date:</dt>
                <div class="mb-4">
					<input type="date" name="Issued_Date" class="border px-2 rounded w-64" placeholder="Enter Issue Date yyyy-mm-dd">
				</div>
				<dt class="text-base">Expiry Date:</dt>
                <div class="mb-4">
					<input type="date" name="Expiry_Date" class="border px-2 rounded w-64" placeholder="Enter Expiry Date yyyy-mm-dd">
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Proposal</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>