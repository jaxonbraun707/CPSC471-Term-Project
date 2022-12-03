<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');

$Title = "Contract";
$error = NULL;

$Contract_No = $_GET['id'] ?? '';
$contract = find_contract($db, $Contract_No);

if(!empty($Contract_No)) {
    $contract = $contract->fetch();
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
                    <a href="delete.php?id=<?=$Contract_No?>" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Delete Contract</a>
                </div>
				<section class="flex">
					<div class="w-2/5 mr-4">
						<div class="mb-4 flex">
							<dl class="grow">
								<dt class="font-bold text-2xl"><?=$contract['Title'] ?? '' ?></dt>
								<dt class="text-xl">Contract Number: <?=$contract['Contract_No'] ?? ''?></dt>
                                <dt class="text-xl">Proposal_No: <?=$contract['Proposal_No'] ?? ''?></dt>
                                <dt class="text-xl">Start Date: <?=$contract['Start_Date'] ?? ''?></dt>
                                <dt class="text-xl">Delivery Date: <?=$contract['Delivery_Date'] ?? ''?></dt>
                                <dt class="text-xl">Payment_Terms: <?=$contract['Payment_Terms'] ?? ''?></dt>
                                <dt class="text-xl">Expiry_Date: <?=$contract['Expiry_Date'] ?? ''?></dt>
                                <dt class="text-xl">Client Id: <?=$contract['Client_Id'] ?? ''?></dt>
							</dl>
							<div class="text-right">
								<a href="../contracts/edit.php?id=<?=$Contract_No?>" class="hover:text-blue-500">Edit Contract</a>
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