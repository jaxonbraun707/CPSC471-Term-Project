<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');
require_once('../data/employee.php');

$title = 'Add a Design';
$error = get_error_in_session();

// retrieve employees needed for the employees field.
$employees = [];
$employees = get_employees_by_job($db, $_job_types['labour']);
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
			<h1 class="text-xl font-semibold m-4">Add an Order</h1>

			<form class="m-4" method="POST" action="post.php">
				<div class="mb-4">
					<input type="number" name="order_no" class="border px-2 rounded" placeholder="Enter Order No.">
				</div>
                <div class="mb-4">
					<input type="number" name="project_no" class="border px-2 rounded" placeholder="Enter Project No.">
				</div>
				<div class="mb-4">
                    <?="When does the Order Ship?";?>
					<input type="date" name="ship_date" class="border px-2 rounded w-64">
				</div>
				<div class="mb-4">
					<label for="labour">Select Labour:</label>
					<select name="labour[]" id="labour" multiple class="border align-top">
						<?php
						foreach($employees as $employee) {
						?>
							<option value="<?=$employee['SSN']?>"><?=$employee['First_Name']?> <?=$employee['Last_Name']?></option>
						<?php
						}
						?>
					</select>
				</div>
                <div class="mb-4">
                    <?="Labour Start Date?";?>
					<input type="date" name="labour_date" class="border px-2 rounded w-64">
				</div>
                <div class="mb-4">
					<input type="number" name="labour_hours" class="border px-2 rounded" placeholder="Enter Labour Hours">
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Order</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>