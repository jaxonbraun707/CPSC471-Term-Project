<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');
require_once('../data/vendor.php');

$title = 'Add a Vendor';
$error = get_error_in_session();

$parts = [];
$parts = get_parts($db);
$parts = $parts->fetchAll(PDO::FETCH_ASSOC);

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
			<h1 class="text-xl font-semibold m-4">Add a Vendor</h1>

			<form class="m-4" method="POST" action="post.php">
				<div class="mb-4">
					<input type="number" name="vendor_id" class="border px-2 rounded" placeholder="Vendor Id">
				</div>
                <div class="mb-4">
					<input type="text" name="vendor_name" class="border px-2 rounded" placeholder="Vendor's Name">
				</div>
                <div class="mb-4">
					<input type="number" name="vendor_phone_no" class="border px-2 rounded" placeholder="Vendor's Phone No.">
				</div>
				<div class="mb-4">
					<label for="part">Select Part:</label>
					<select name="part[]" id="part" multiple class="border align-top">
						<?php
						foreach($parts as $part) {
						?>
							<option value="<?=$part['Part_No']?>"><?=$part['Part_No']?></option>
						<?php
						}
						?>
					</select>
				</div>
                <div class="mb-4">
					<input type="number" step="0.01" name="price" class="border px-2 rounded" placeholder="Price">
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Vendor</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>