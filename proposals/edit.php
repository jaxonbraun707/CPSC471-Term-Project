<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/proposal.php');
require_once('../data/employee.php');

$Title = "Proposal";
$error = NULL;

$Proposal_No = $_GET['id'] ?? '';
$proposal = find_proposal($db, $Proposal_No);

if(!empty($proposal)) {
    $proposal = $proposal->fetch();
}

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
			<div class="m-4">
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
				<section class="flex">
					<div class="w-2/5 mr-4">
						<form class="mb-4 flex" method="POST" action="../proposals/update.php">
							<input type="hidden" name="Proposal No" value="<?=$proposal['Proposal_No'] ?>">
							<dl class="grow">
								
								<dt class="text-xl">
                                    Title	
									<input class="border w-64 pl-2" type="text" name="Title" value="<?=$proposal['Title']?>">
								</dt>
								<dt class="text-xl">Client: <?=$proposal['Company_Name'] ?? ''?></dt>
                                <dt class="text-xl">
                                    Value: $<input class="border w-64 pl-2" type="number" name="Value" value="<?=$proposal['Value']?>">
								</dt>
                                <dt class="text-xl">
                                    Issued Date:
									<input class="border w-64 pl-2" type="date" name="Issued_Date" value="<?=$proposal['Issued_Date']?>">
								</dt>
                                <dt class="text-xl">
                                    Expiry Date:
									<input class="border w-64 pl-2" type="date" name="Expiry_Date" value="<?=$proposal['Expiry_Date']?>">
								</dt>
								<div class="text-xl">
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
								</div>
							</dl>
							<div class="text-right">
								<button class="hover:text-blue-500" type="submit">Update</button>
							</div>
						</form>
					</div>
				</section>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>