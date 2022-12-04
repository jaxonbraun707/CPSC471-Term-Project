<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/project.php');
require_once('../data/order.php');

$title = "Project | ";
$error = get_error_in_session() ?? null;

$project_no = $_GET['id'] ?? '';
$project = find_project($db, $project_no);
$employees = get_project_employees($db, $project_no) ?? [];
// $authors = find_project_authors($db, $project_no);
// $drawings = find_project_drawings($db, $project_no);
// // retrieve new_authors needed for the authors field.
// $new_authors = [];
// $new_authors = get_new_project_authors($db, $project_no, $_job_types['engineering']);
// $new_authors = $new_authors->fetchAll(PDO::FETCH_ASSOC);

if(!empty($project)) {
	$project = $project->fetch();
	$days_remaining = (date_create($project['End_Date']))->diff(new DateTime('now'))->days;
}

$parts = find_order_parts_with_average_price($db, $project['Order_No']) ?? [];
if (!empty($parts)) {
	$parts = $parts->fetchAll(PDO::FETCH_ASSOC);
}

$order_stats = find_order_aggregate_stats($db, $project['Order_No']);
if (!empty($order_stats)) {
	$order_stats = $order_stats->fetch();
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
		<form class="m-4" method="POST" action="<?=BASE_URL?>/projects/update.php">
			<!-- ideally, can put stuff here -->
			<input type="hidden" name="project_no" value="<?=$project['Project_No']?>">
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
				<div class="px-4 py-8 flex border-b">
					<dl class="grow">
						<dt class="font-bold text-2xl">Project No. <?=$project['Project_No'] ?></dt>
						<dd class="text-xl"><?=$days_remaining?> Days Remaining</dd>
					</dl>
					<div class="text-right">
						<button type="submit" class="hover:bg-blue-400 px-4 py-2 bg-blue-500 rounded text-white">Update</button>
					</div>
				</div>
				<div class="grid grid-cols-5 my-8 gap-8">
					<section class="border rounded col-span-3">
						<div>
							<div class="p-4">
								<dl class="grid grid-cols-2 grid-rows-2 gap-4">
									<div>
										<dt class="font-semibold">Start Date</dt>
										<input class="border rounded px-2" type="date" value="<?=$project['Start_Date']?>" name="start_date">
									</div>

									<div>
										<dt class="font-semibold">End Date</dt>
										<input class="border rounded px-2" type="date" value="<?=$project['End_Date']?>" name="end_date">
									</div>

									<div>
										<dt class="font-semibold">Budget</dt>
										<dd><?=number_format($project['Budget'], 2).' CAD' ?></dd>
										<dd class="text-sm">
											<a class="hover:text-blue-500" href="<?=BASE_URL?>/designs/design.php?id=<?=$project['Design_No']?>">
												per Design No. <?=$project['Design_No']?>
											</a>
												
										</dd>
									</div>

									<div>
										<dt class="font-semibold">Payment Terms</dt>
										<dd><?=$project['Payment_Terms']?></dd>
										<dd class="text-sm">
											<a class="hover:text-blue-500" href="<?=BASE_URL?>/contracts/contract.php?id=<?=$project['Contract_No']?>">
												per Contract No. <?=$project['Contract_No']?>
											</a>
												
										</dd>
									</div>
								</dl>

								<h2 class="text-lg mt-8 mb-4 border-b">Client Information</h2>
								<dl class="grid grid-cols-2 grid-rows-1 gap-4">
									<div>
										<dt class="font-semibold">Company</dt>
										<dd><?=$project['Company_Name']?></dd>
										<dd><?=$project['City']?>, <?=$project['Prov_State']?></dd>
									</div>

									<div>
										<dt class="font-semibold">Contact</dt>
										<dd><?=$project['Contact_Name']?></dd>
										<dd><?=$project['Email']?></dd>
									</div>
								</dl>

								<h2 class="text-lg mt-8 border-b">Team Members</h2>
								<div class="grid grid-cols-4 gap-8 mt-4">
								<?php
								foreach($employees as $employee) {
								?>
									<a href="<?=BASE_URL?>/employees/employee.php?id=<?=$employee['SSN']?>" class="border rounded hover:border-blue-500">
										<section>
											<dl class="p-2">
												<dt class="font-bold"><?=$employee['First_Name'] ?> <?' '?><?=$employee['Last_Name']?></dt>
												<dt class="font-semibold"><?=$employee['Job_Type'] ?></dt>
											</dl>
										</section>
									</a>
								<?php
								}
								?>
								</div>
							</div>
					</section>
					<section class="border rounded col-span-2">
						<div class="p-4">
							<div class="flex justify-between border-b">
								<h2 class="text-lg">Order Information</h2>
								<a class="hover:text-blue-500" href="<?=BASE_URL?>/order/order.php?id=<?=$project['Order_No']?>">View</a>
							</div>
							<table class="w-full mt-4">
								<tr>
									<td class="border-b py-2">Part</td>
									<td class="border-b py-2 text-right">Quantity</td>
									<td class="border-b py-2 text-right">Average Price</td>
									<td class="border-b py-2 text-right">Subtotal Estimate</td>
								</tr>
								<?php
								$total = 0;
								foreach($parts as $part) {
									$total += $part['Estimate_Subtotal'];
								?>
								<tr>
									<td class="py-2"><?=$part['Part_No']?></td>
									<td class="py-2 text-right"><?=$part['Qty']?></td>
									<td class="py-2 text-right"><?=number_format($part['Average_Price'], 2).' CAD' ?></td>
									<td class="py-2 text-right"><?=number_format($part['Estimate_Subtotal'], 2).' CAD' ?></td>
								</tr>
								<?php
								}
								?>
								<tr>
									<td colspan="3" class="text-right border-t">Total</td>
									<td class="text-right border-t"><?=number_format($total, 2).' CAD' ?></td>
								</tr>
							</table>
							<dl class="grid grid-cols-2 gap-4 mt-4">
								<div>
									<dt class="font-semibold">Number of Labourers</dt>
									<dd><?=$order_stats['Num_Labour']?></dd>
								</div>
								<div>
									<dt class="font-semibold">Total Labour Hours</dt>
									<dd><?=$order_stats['Total_Hours']?></dd>
								</div>
								<div>
									<dt class="font-semibold">Average Labour Hours</dt>
									<dd><?=$order_stats['Average_Hours']?></dd>
								</div>
							</dl>
						</div>
					</section>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>