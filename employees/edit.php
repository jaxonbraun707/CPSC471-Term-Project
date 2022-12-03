<?php
require_once('../init.php');
require_once('../must_be_admin.php');
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
				<section class="flex">
					<div class="w-2/5 mr-4">
						<form class="mb-4 flex" method="POST" action="update.php">
							<input type="hidden" name="ssn" value="<?=$employee['SSN'] ?>">
							<dl class="grow">
								<dt class="font-bold text-2xl">
									SSN
									<input class="border w-64 pl-2" type="number" name="new_ssn" value="<?=$employee['SSN']?>">
								</dt>
								<dt class="text-xl">
                                    First Name
									<input class="border w-64 pl-2" type="text" name="first_name" value="<?=$employee['First_Name']?>">
								</dt>
                                <dt class="text-xl">
                                    Last Name
									<input class="border w-64 pl-2" type="text" name="last_name" value="<?=$employee['Last_Name']?>">
								</dt>
                                <dt class="text-xl">
                                    Date of Birth
									<input class="border w-64 pl-2" type="text" name="dob" value="<?=$employee['DOB']?>">
								</dt>
                                <dt class="text-xl">
                                    Phone Number
									<input class="border w-64 pl-2" type="number" name="phone_no" value="<?=$employee['Phone_No']?>">
								</dt>
                                <dt class="text-xl">
                                    Email
									<input class="border w-64 pl-2" type="text" name="email" value="<?=$employee['Email']?>">
								</dt>
                                <dt class="text-xl">
                                    Address Line 1
									<input class="border w-64 pl-2" type="text" name="address_line_1" value="<?=$employee['Address_Line_1']?>">
								</dt>
                                <dt class="text-xl">
                                    Address Line 2
									<input class="border w-64 pl-2" type="text" name="address_line_2" value="<?=$employee['Address_Line_2']?>">
								</dt>
                                <dt class="text-xl">
                                    City
									<input class="border w-64 pl-2" type="text" name="city" value="<?=$employee['City']?>">
								</dt>
                                <dt class="text-xl">
                                    Province/State
									<input class="border w-64 pl-2" type="text" name="prov_state" value="<?=$employee['Prov_State']?>">
								</dt>
                                <dt class="text-xl">
                                    Country
									<input class="border w-64 pl-2" type="text" name="country" value="<?=$employee['Country']?>">
								</dt>
                                <dt class="text-xl">
                                    Postal/Zip Code
									<input class="border w-64 pl-2" type="text" name="postal_zip" value="<?=$employee['Postal_Zip']?>">
								</dt>
                                <dt class="text-xl">
                                    Job Title
									<input class="border w-64 pl-2" type="text" name="job_type" value="<?=$employee['Job_Type']?>">
								</dt>
                                <dt class="text-xl">
                                    Sales Region
									<input class="border w-64 pl-2" type="text" name="sales_region" value="<?=$regions['Sales_Region'] ?? ''?>">
								</dt>
                                <dt class="text-xl">
                                    Engineering Specialty
									<input class="border w-64 pl-2" type="text" name="eng_specialty" value="<?=$eng_spec['Eng_Specialty'] ?? ''?>">
								</dt>
                                <dt class="text-xl">
                                    Labour Specialty
									<input class="border w-64 pl-2" type="text" name="lab_specialty" value="<?=$lab_spec['Lab_Specialty'] ?? ''?>">
								</dt>
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