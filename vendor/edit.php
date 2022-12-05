<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/vendor.php');

$Title = "Vendor";
$error = NULL;

$vendor_id = $_GET['id'] ?? '';
$vendor = get_vendor($db, $vendor_id);
$parts = get_parts_vendor($db, $vendor_id);
$new_parts = get_new_parts_vendor($db, $vendor_id);


if(!empty($vendor)) {
    $vendor = $vendor->fetch();
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
							<input type="hidden" name="vendor_id" value="<?=$vendor['Vendor_Id'] ?>">
							<dl class="grow">
								<dt class="font-bold text-2xl">
									Vendor ID:
									<input class="border w-64 pl-2" type="number" name="new_vendor_id" value="<?=$vendor['Vendor_Id']?>">
								</dt>
                                <dt class="font-bold text-2xl">
                                    Vendor's Name:
									<input class="border w-64 pl-2" type="text" name="new_vendor_name" value="<?=$vendor['Vendor_Name']?>">
								</dt>
                                <dt class="font-bold text-2xl">
									Phone No:
									<input class="border w-64 pl-2" type="number" name="new_vendor_phone_no" value="<?=$vendor['Phone_No']?>">
								</dt>
							</dl>
							<div class="text-right">
								<button class="hover:text-blue-500" type="submit">Update</button>
							</div>
						</form>
						<form method="POST" action="delete.php">
							<input type="hidden" name="vendor_id" value="<?=$vendor['Vendor_Id'] ?>">
							<button class="hover:text-red-500" type="submit">Delete Vendor</button>
						</form>
					</div>
				</section>
				<section>
					<table class="w-2/5" style="max-height: 500px;">
						<thead>
							<tr>
								<td class="mt-4 py-2 font-bold border-b" colspan="2">Parts this Vendor Provides</td>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($parts as $part) {
							?>
							<tr>
								<td class="py-2">
									<?="Part No: ".$part['Part_No']." Price: $".$part['Price']." CAD"?>
								</td>
								<td class="text-right py-2">
									<form method="POST" action="delete_part.php">
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
						if (!empty($new_parts)) {
						?>
						<form class="mt-8 border-t py-4 justify-between" method="POST" action="add_part.php">
							<input type="hidden" name="vendor_id" value="<?=$vendor['Vendor_Id']?>">
							<div>
								<select name="part" id="part" class="border">
									<option selected>Add Part</option>
									<?php
									foreach($new_parts as $part) {
									?>
										<option value="<?=$part['Part_No']?>"><?=$part['Part_No']?></option>
									<?php
									}
									?>
								</select>
							</div>
                			<div class="m-4">
								<input type="number" step="0.01" name="vendor_price" class="border px-2 rounded" placeholder="Enter Price">
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