<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/proposal.php');

$Title = "Proposal";
$error = NULL;

$Proposal_No = $_GET['id'] ?? '';
$proposal = find_proposal($db, $Proposal_No);

if(!empty($proposal)) {
    $proposal = $proposal->fetch();
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
						<form class="mb-4 flex" method="POST" action="../proposals/update.php">
							<input type="hidden" name="Proposal_No" value="<?=$proposal['Proposal_No'] ?>">
							<dl class="grow">
								<dt class="text-xl">
                                    Title
									<input class="border w-64 pl-2" type="text" name="Title" value="<?=$proposal['Title']?>">
								</dt>
                                <dt class="text-xl">
                                    Value
									<input class="border w-64 pl-2" type="number" name="Value" value="<?=$proposal['Value']?>">
								</dt>
                                <dt class="text-xl">
                                    Issued Date
									<input class="border w-64 pl-2" type="date" name="Issued_Date" value="<?=$proposal['Issued_Date']?>">
								</dt>
                                <dt class="text-xl">
                                    Expiry Date
									<input class="border w-64 pl-2" type="date" name="Expiry_Date" value="<?=$proposal['Expiry_Date']?>">
								</dt>
                                <dt class="text-xl">
                                    Sales SSN
									<input class="border w-64 pl-2" type="number" name="Sales_SSN" value="<?=$proposal['Sales_SSN']?>">
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