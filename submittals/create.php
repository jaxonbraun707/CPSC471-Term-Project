<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');
require_once('../data/employee.php');
require_once('../data/contract.php');

$title = 'Add a Submittal';
$error = get_error_in_session();

// retrieve employees needed for the employees field.
$employees = [];
$employees = get_employees_by_job($db, $_job_types['engineering']);
$employees = $employees ? $employees->fetchAll(PDO::FETCH_ASSOC) : [];

$contracts = [];
$contracts = get_contracts($db);
$contracts = $contracts ? $contracts->fetchAll(PDO::FETCH_ASSOC) : [];


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
			<h1 class="text-xl font-semibold m-4">Add a Submittal</h1>

			<form class="m-4" method="POST" action="<?=BASE_URL?>/submittals/post.php" enctype="multipart/form-data">
				<div class="mb-4">
					<input type="number" name="submittal_no" class="border px-2 rounded" placeholder="Enter Submittal No.*">
				</div>
				<div class="mb-4">
					<input type="file" name="attachment">
				</div>
				<div class="mb-4">
					<label for="contract">Select Contract:</label>
					<select name="contract" id="contract" class="border">
						<option selected value="">None</option>
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
					<label for="authors">Select Authors: *</label>
					<select name="authors[]" id="authors" multiple class="border align-top">
						<?php
						foreach($employees as $employee) {
						?>
							<option value="<?=$employee['SSN']?>"><?=$employee['First_Name']?> <?=$employee['Last_Name']?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Submittal</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>