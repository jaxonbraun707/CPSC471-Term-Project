<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/vendor.php');

$Title = "Vendor";
$error = NULL;

$vendor_id = $_GET['id'] ?? '';
$vendor = get_vendor($db, $vendor_id);


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
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>