<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/client.php');

$Title = "Client";
$error = NULL;

$Client_Id = $_GET['id'] ?? '';
$client = find_client($db, $Client_Id);

if(!empty($client)) {
    $client = $client->fetch();
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
						<form class="mb-4 flex" method="POST" action="../clients/update.php">
							<input type="hidden" name="Client_Id" value="<?=$client['Client_Id'] ?>">
							<dl class="grow">
								<dt class="text-xl">
                                    Company Name
									<input class="border w-64 pl-2" type="text" name="Company_Name" value="<?=$client['Company_Name']?>">
								</dt>
                                <dt class="text-xl">
                                    Contact Name
									<input class="border w-64 pl-2" type="text" name="Contact_Name" value="<?=$client['Contact_Name']?>">
								</dt>
                                <dt class="text-xl">
                                    Email
									<input class="border w-64 pl-2" type="text" name="Email" value="<?=$client['Email']?>">
								</dt>
                                <dt class="text-xl">
                                    Website
									<input class="border w-64 pl-2" type="text" name="Website" value="<?=$client['Website']?>">
								</dt>
                                <dt class="text-xl">
                                    Phone Number
									<input class="border w-64 pl-2" type="number" name="Phone_No" value="<?=$client['Phone_No']?>">
								</dt>
                                <dt class="text-xl">
                                    Address Line 1
									<input class="border w-64 pl-2" type="text" name="Address_Line_1" value="<?=$client['Address_Line_1']?>">
								</dt>
                                <dt class="text-xl">
                                    Address Line 2
									<input class="border w-64 pl-2" type="text" name="Address_Line_2" value="<?=$client['Address_Line_2']?>">
								</dt>
                                <dt class="text-xl">
                                    City
									<input class="border w-64 pl-2" type="text" name="City" value="<?=$client['City']?>">
								</dt>
                                <dt class="text-xl">
                                    Province/State
									<input class="border w-64 pl-2" type="text" name="Prov_State" value="<?=$client['Prov_State']?>">
								</dt>
                                <dt class="text-xl">
                                    Country
									<input class="border w-64 pl-2" type="text" name="Country" value="<?=$client['Country']?>">
								</dt>
                                <dt class="text-xl">
                                    Postal/Zip Code
									<input class="border w-64 pl-2" type="text" name="Postal_Zip" value="<?=$client['Postal_Zip']?>">
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