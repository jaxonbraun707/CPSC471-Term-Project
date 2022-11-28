<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/employee.php');

$Title = "Employee";
$error = NULL;

$employee_SSN = $_GET['id'] ?? '';
$employee = find_employee($db, $employee_SSN);
$regions = find_regions($db, $employee_SSN);
$eng_spec = find_eng($db, $employee_SSN);
$lab_spec = find_lab($db, $employee_SSN);

if(!empty($employee)) {
    $employee = $employee->fetch();
}

if(!empty($regions)) {
    $regions = $regions->fetch();
}

if(!empty($eng_spec)) {
    $eng_spec = $eng_spec->fetch();
}

if(!empty($lab_spec)){
    $lab_spec = $lab_spec->fetch();
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
				<div class="text-right">
                    <a href="delete.php?id=<?=$employee_SSN?>" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Delete Employee</a>
                </div>
				<section class="flex">
					<div class="w-2/5 mr-4">
						<div class="mb-4 flex">
							<dl class="grow">
								<dt class="font-bold text-2xl"><?=$employee['First_Name'] ?? '' ?> <?' '?><?=$employee['Last_Name'] ?? ''?></dt>
								<dt class="font-semibold text-xl"><?=$employee['Job_Type']?></dt>

                                <dt class="text-xl">Sales Region: <?=$regions['Sales_Region'] ?? ''?></dt>
                                <dt class="text-xl">Engineering Specialty: <?=$eng_spec['Eng_Specialty'] ?? ''?></dt>
                                <dt class="text-xl">Labour Specialty: <?=$lab_spec['Lab_Specialty'] ?? ''?></dt>
                                <dt class="text-xl">SSN: <?=$employee['SSN'] ?? ''?></dt>
                                <dt class="text-xl">Date of Birth: <?=$employee['DOB'] ?? ''?></dt>
                                <dt class="text-xl">Phone No.: <?=$employee['Phone_No'] ?? ''?></dt>
                                <dt class="text-xl">Email: <?=$employee['Email'] ?? ''?></dt>
                                <dt class="text-xl">Address_Line_1: <?=$employee['Address_Line_1'] ?? ''?></dt>
                                <dt class="text-xl">Address_Line_2: <?=$employee['Address_Line_2'] ?? ''?></dt>
                                <dt class="text-xl">City: <?=$employee['City'] ?? ''?></dt>
                                <dt class="text-xl">Province/State: <?=$employee['Prov_State'] ?? ''?></dt>
                                <dt class="text-xl">Country: <?=$employee['Country'] ?? ''?></dt>
                                <dt class="text-xl">Postal/Zip Code: <?=$employee['Postal_Zip'] ?? ''?></dt>
							</dl>
							<div class="text-right">
								<a href="../employees/edit.php?id=<?=$employee_SSN?>" class="hover:text-blue-500">Edit Employee</a>
							</div>
						</div>
				</section>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>
