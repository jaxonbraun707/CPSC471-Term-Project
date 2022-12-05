<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');

$Title = "Part";
$error = NULL;

$part_no = $_GET['id'] ?? '';
$part = get_part($db, $part_no);
$vendors = get_vendors_part($db, $part_no);
$new_vendors = get_new_vendors_part($db, $part_no);


if(!empty($part)) {
    $part = $part->fetch();
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
							<input type="hidden" name="ssn" value="<?=$part['Part_No'] ?>">
							<dl class="grow">
								<dt class="font-bold text-2xl">
									Part No.
									<input class="border w-64 pl-2" type="number" name="new_part_no" value="<?=$part['Part_No']?>">
								</dt>
							</dl>
							<div class="text-right">
								<button class="hover:text-blue-500" type="submit">Update</button>
							</div>
						</form>
						<form method="POST" action="delete.php">
							<input type="hidden" name="part_no" value="<?=$part['Part_No'] ?>">
							<button class="hover:text-red-500" type="submit">Delete Part</button>
						</form>
					</div>
				</section>
				<section>
					<table class="w-2/5" style="max-height: 500px;">
						<thead>
							<tr>
								<td class="mt-4 py-2 font-bold border-b" colspan="2">Vendors that Provide This Part</td>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($vendors as $vendor) {
							?>
							<tr>
								<td class="py-2">
									<?="Name: ".$vendor['Vendor_Name']?>
								</td>
                                <td class="py-2">
									<?="Phone No: ".$vendor['Phone_No']?>
								</td>
								<td class="py-2">
									<?="Price: $".$vendor['Price']." CAD"?>
								</td>
								<td class="text-right py-2">
									<form method="POST" action="delete_vendor.php">
										<input type="hidden" name="part_no" value="<?=$part['Part_No']?>">
										<input type="hidden" name="vendor_id" value="<?=$vendor['Vendor_Id']?>">
										<button type="submit" class="hover:text-red-500">Remove</button>
									</form>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					<?php
						if (!empty($new_vendors)) {
						?>
						<form class="mt-8 border-t py-4 justify-between" method="POST" action="add_vendor.php">
							<input type="hidden" name="part_no" value="<?=$part['Part_No']?>">
							<div>
								<select name="vendor" id="vendor" class="border">
									<option selected>Add Vendor</option>
									<?php
									foreach($new_vendors as $vendor) {
									?>
										<option value="<?=$vendor['Vendor_Id']?>"><?=$vendor['Vendor_Name']?></option>
									<?php
									}
									?>
								</select>
							</div>
                			<div class="m-4">
								<input type="number" step="0.01" name="vendor_price" class="border px-2 rounded" placeholder="Enter Vendor Price">
							</div>
							<button type="submit" class="hover:text-blue-500">Add</button>
						</form>
						<?php
						}
						?>
				</section>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>