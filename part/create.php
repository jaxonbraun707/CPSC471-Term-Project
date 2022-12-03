<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');
require_once('../data/vendor.php');

$title = 'Add a Part';
$error = get_error_in_session();

$vendors = [];
$vendors = get_vendors($db);
$vendors = $vendors->fetchAll(PDO::FETCH_ASSOC);

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
			<?php
				if (!empty($error)) {
			?>
				<section class="bg-red-100 border border-red-500 rounded text-red-500 p-4 m-4">
					<p>
						Error: <?=$error?>
					</p>
				</section>
			<?php
				}
			?>
			<h1 class="text-xl font-semibold m-4">Add a Part</h1>

			<form class="m-4" method="POST" action="post.php">
				<div class="mb-4">
					<input type="number" name="part_no" class="border px-2 rounded" placeholder="Enter Part No.">
				</div>
				<div class="mb-4">
					<label for="vendor">Select Vendor:</label>
					<select name="vendor[]" id="vendor" multiple class="border align-top">
						<?php
						foreach($vendors as $vendor) {
						?>
							<option value="<?=$vendor['Vendor_Id']?>"><?=$vendor['Vendor_Name']?></option>
						<?php
						}
						?>
					</select>
				</div>
                <div class="mb-4">
					<input type="number" step="0.01" name="price" class="border px-2 rounded" placeholder="Enter Price">
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Part</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>