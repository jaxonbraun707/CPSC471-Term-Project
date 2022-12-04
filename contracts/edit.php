<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');

$Title = "Contract";
$error = NULL;

$Contract_No = $_GET['id'] ?? '';
$contract = find_contract($db, $Contract_No);

if(!empty($contract)) {
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
				<section class="flex">
					<div class="w-2/5 mr-4">
						<form class="mb-4 flex" method="POST" action="../contracts/update.php">
							<input type="hidden" name="Contract_No" value="<?=$contract['Contract_No'] ?>">
							<dl class="grow">
								
								<dt class="font-bold text-2xl"><?=$contract['Title'] ?? '' ?></dt>
                                <dt class="text-xl">Contract Number:  <?=$contract['Contract_No'] ?? '' ?></dt>
								<dt class="text-xl">Proposal Number:  <?=$contract['Proposal_No'] ?? '' ?></dt>
								<dt class="text-xl">Client: <?=$contract['Company_Name'] ?? '' ?></dt>
                                <dt class="text-xl">Start Date:  <?=$contract['Start_Date'] ?? '' ?></dt>
                                <dt class="text-xl">
                                    Delivery Date
									<input class="border w-64 pl-2" type="date" name="Delivery_Date" value="<?=$contract['Delivery_Date']?>">
								</dt>
                                <dt class="text-xl">
                                    Payment Terms
									<input class="border w-64 pl-2" type="text" name="Payment_Terms" value="<?=$contract['Payment_Terms']?>">
                                </dt>
                                <dt class="text-xl">Issued Date:  <?=$contract['Issued_Date'] ?? '' ?></dt>
                                <dt class="text-xl">
                                    Expiry Date
									<input class="border w-64 pl-2" type="date" name="Expiry_Date" value="<?=$contract['Expiry_Date']?>">
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