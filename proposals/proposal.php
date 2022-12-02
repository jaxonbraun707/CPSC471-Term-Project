<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/proposal.php');

$Title = "Proposal";
$error = NULL;

$Proposal_No = $_GET['id'] ?? '';
$proposal = find_proposal($db, $Proposal_No);

if(!empty($Proposal_No)) {
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
				<div class="text-right">
                    <a href="delete.php?id=<?=$Proposal_No?>" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Delete Proposal</a>
                </div>
				<section class="flex">
					<div class="w-2/5 mr-4">
						<div class="mb-4 flex">
							<dl class="grow">
								<dt class="font-bold text-2xl"><?=$proposal['Title'] ?? '' ?></dt>
								
                                <dt class="text-xl">Proposal_No: <?=$proposal['Proposal_No'] ?? ''?></dt>
                                <dt class="text-xl">Value: <?=$proposal['Value'] ?? ''?></dt>
                                <dt class="text-xl">Issued_Date: <?=$proposal['Issued_Date'] ?? ''?></dt>
                                <dt class="text-xl">Expiry_Date: <?=$proposal['Expiry_Date'] ?? ''?></dt>
								<dt class="text-xl">Sales_SSN: <?=$proposal['Sales_SSN'] ?? ''?></dt>
							</dl>
							<div class="text-right">
								<a href="../proposals/edit.php?id=<?=$Proposal_No?>" class="hover:text-blue-500">Edit Proposal</a>
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