<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');

$title = "Order | ";
$error = NULL;

$order_no = $_GET['id'] ?? '';
$order = find_order($db, $order_no);
$labours = find_order_labours($db, $order_no);
$parts = find_order_parts($db, $order_no);

$new_labours = [];
$new_labours = get_new_order_labours($db, $order_no, $_job_types['labour']);
$new_labours = $new_labours->fetchAll(PDO::FETCH_ASSOC);

if(!empty($order)) {
	$order = $order->fetch();
}

if(!empty($labours)) {
	$labours = $labours->fetchAll();
}

if(!empty($parts)) {
	$parts = $parts->fetchAll();
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
							<input type="hidden" name="order_no" value="<?=$order['Order_No'] ?>">
							<dl class="grow">
								<dt class="font-bold text-2xl">
									Order No. 
									<input class="border w-16 pl-2" type="number" name="new_order_no" value="<?=$order['Order_No'] ?>">
								</dt>
								<dd class="text-xl">
                                    Project No.
									<input class="border w-16 pl-2" type="number" name="new_project_no" value="<?=$order['Project_No'] ?>">
								</dd>
                                <dd class="text-xl">
                                    Ship Date
									<input class="border w-40 pl-2" type="date" name="new_ship_date" value="<?=$order['Ship_Date'] ?>">
								</dd>
							</dl>
							<div class="text-right">
								<button class="hover:text-blue-500" type="submit">Update</button>
							</div>
						</form>
						<form method="POST" action="delete.php">
							<input type="hidden" name="order_no" value="<?=$order['Order_No'] ?>">
							<button class="hover:text-red-500" type="submit">Delete Order</button>
						</form>

						<table class="w-full" style="max-height: 500px;">
							<thead>
								<tr>
									<td class="mt-4 py-2 font-bold border-b" colspan="2">Labour</td>
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($labours as $labour) {
								?>
								<tr>
									<td class="py-2">
										<span class="block"><?=$labour['First_Name']?> <?=$labour['Last_Name']?></span>
										<span class="block text-sm"><?=$labour['Email']?></span>
										<span class="block text-sm">Start Date: <?=$labour['Start_Date']?></span>
										<span class="block text-sm">Hours: <?=$labour['Hours']?></span>
									</td>
									<td class="text-right py-2">
										<?php
										if(count($labours) > 1) {
										?>
										<form method="POST" action="delete_labour.php">
											<input type="hidden" name="order_no" value="<?=$order['Order_No']?>">
											<input type="hidden" name="labour" value="<?=$labour['SSN']?>">
											<button type="submit" class="hover:text-red-500">Remove</button>
										</form>
										<?php
										}
										?>
									</td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						<?php
						if (!empty($new_labours)) {
						?>
						<form class="mt-8 border-t py-4 justify-between" method="POST" action="add_labour.php">
							<input type="hidden" name="order_no" value="<?=$order['Order_No']?>">
							<div>
								<select name="labour" id="labour" class="border">
									<option selected>Add Labour</option>
									<?php
									foreach($new_labours as $employee) {
									?>
										<option value="<?=$employee['SSN']?>"><?=$employee['First_Name']?> <?=$employee['Last_Name']?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="m-4">
                    			<?="Labour Start Date?";?>
								<input type="date" name="labour_date" class="border px-2 rounded w-64">
							</div>
                			<div class="m-4">
								<input type="number" name="labour_hours" class="border px-2 rounded" placeholder="Enter Labour Hours">
							</div>
							<button type="submit" class="hover:text-blue-500">Add</button>
						</form>
						<?php
						}
						?>
					</div>
				</section>
				<section>
					<table class="w-2/5" style="max-height: 500px;">
						<thead>
							<tr>
								<td class="mt-4 py-2 font-bold border-b" colspan="2">Parts</td>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($parts as $part) {
							?>
							<tr>
                            <td class="py-2">
									<?="Part No: ".$part['Part_No']." Qty: ".$part['Qty']?>
								</td>
								<td class="text-right py-2">
									<form method="POST" action="delete_part.php">
										<input type="hidden" name="order_no" value="<?=$order['Order_No']?>">
										<input type="hidden" name="part_no" value="<?=$part['Part_No']?>">
										<button type="submit" class="hover:text-red-500">Remove</button>
									</form>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					<form method="POST" action="add_part.php">
						<input type="hidden" name="order_no" value="<?=$order['Order_No']?>">
						<label>Add a Part:</label>
						<input type="number" name="part_no" class="py-2 border rounded pl-2 w-32" placeholder="Part No.">
						<input type="number" name="qty" class="py-2 border rounded pl-2 w-32" placeholder="Qty">
						<button class="hover:text-blue-500 w-2/6" type="submit">Add</button>
					</form>
				</section>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>