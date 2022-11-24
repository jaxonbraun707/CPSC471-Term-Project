
<?php
$title = 'Add an Employee';

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
			<h1 class="text-xl font-semibold m-4">Add an Employee</h1>

			<form class="m-4" method="POST" action="post.php">
				<div class="mb-4">
					<input type="number" name="SSN" class="border px-2 rounded" placeholder="Enter SSN">
				</div>
				<div class="mb-4">
					<input type="text" name="First_Name" class="border px-2 rounded w-64" placeholder="Enter First Name">
				</div>
                <div class="mb-4">
					<input type="text" name="Last_Name" class="border px-2 rounded w-64" placeholder="Enter Last Name">
				</div>
                <div class="mb-4">
					<input type="text" name="DOB" class="border px-2 rounded w-64" placeholder="YYYY-MM-DD">
				</div>
                <div class="mb-4">
					<input type="number" name="Phone_No" class="border px-2 rounded w-64" placeholder="Enter Phone Number">
				</div>
                <div class="mb-4">
					<input type="text" name="Email" class="border px-2 rounded w-64" placeholder="Enter Email">
				</div>
                <div class="mb-4">
					<input type="text" name="Address_Line_1" class="border px-2 rounded w-64" placeholder="Enter Address Line 1">
				</div>
                <div class="mb-4">
					<input type="text" name="Address_Line_2" class="border px-2 rounded w-64" placeholder="Enter Address Line 2">
				</div>
                <div class="mb-4">
					<input type="text" name="City" class="border px-2 rounded w-64" placeholder="Enter City">
				</div>
                <div class="mb-4">
					<input type="text" name="Prov_State" class="border px-2 rounded w-64" placeholder="Enter Enter Province/State">
				</div>
                <div class="mb-4">
					<input type="text" name="Country" class="border px-2 rounded w-64" placeholder="Enter Country">
				</div>
                <div class="mb-4">
					<input type="text" name="Postal_Zip" class="border px-2 rounded w-64" placeholder="Enter Postal/ZIP Code">
				</div>
                <div class="mb-4">
					<input type="text" name="Job_Type" class="border px-2 rounded w-64" placeholder="Enter Your Job Title">
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Employee</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>