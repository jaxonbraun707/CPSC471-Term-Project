<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/client.php');

$Title = "Client";
$error = NULL;

$Client_Id = $_GET['id'] ?? '';
$client = find_client($db, $Client_Id);

if(!empty($Client_Id)) {
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
				<div class="text-right">
                    <a href="delete.php?id=<?=$Client_Id?>" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Delete Client</a>
                </div>
				<section class="flex">
					<div class="w-2/5 mr-4">
						<div class="mb-4 flex">
							<dl class="grow">
								<dt class="font-bold text-2xl"><?=$client['Company_Name'] ?? '' ?></dt>

                                <dt class="text-xl">Client Id: <?=$client['Client_Id'] ?? ''?></dt>
                                <dt class="text-xl">Contact Name: <?=$client['Contact_Name'] ?? ''?></dt>
                                <dt class="text-xl">Email: <?=$client['Email'] ?? ''?></dt>
                                <dt class="text-xl">Website: <?=$client['Website'] ?? ''?></dt>
                                <dt class="text-xl">Address Line 1: <?=$client['Address_Line_1'] ?? ''?></dt>
                                <dt class="text-xl">Address Line 2: <?=$client['Address_Line_2'] ?? ''?></dt>
                                <dt class="text-xl">City: <?=$client['City'] ?? ''?></dt>
                                <dt class="text-xl">Province/State: <?=$client['Prov_State'] ?? ''?></dt>
                                <dt class="text-xl">Country: <?=$client['Country'] ?? ''?></dt>
                                <dt class="text-xl">Postal/Zip Code: <?=$client['Postal_Zip'] ?? ''?></dt>
							</dl>
							<div class="text-right">
								<a href="../clients/edit.php?id=<?=$Client_Id?>" class="hover:text-blue-500">Edit Client</a>
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