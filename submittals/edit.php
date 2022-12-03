<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');
require_once('../data/contract.php');

$title = "Submittal | ";
$error = NULL;

$submittal_no = $_GET['id'] ?? '';
$submittal = find_submittal($db, $submittal_no);
$authors = find_submittal_authors($db, $submittal_no);
$attachments = find_submittal_attachments($db, $submittal_no);
$contracts = get_contracts($db);
// retrieve new_authors needed for the authors field.
$new_authors = [];
$new_authors = get_new_submittal_authors($db, $submittal_no, $_job_types['engineering']);
$new_authors = $new_authors->fetchAll(PDO::FETCH_ASSOC);

if(!empty($submittal)) {
	$submittal = $submittal->fetch();
}

if(!empty($authors)) {
	$authors = $authors->fetchAll();
}

if(!empty($drawings)) {
	$drawings = $drawings->fetchAll();
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
						<form class="mb-4 flex" method="POST" action="<?=BASE_URL?>/submittals/update.php">
							<input type="hidden" name="submittal_no" value="<?=$submittal['Submittal_No'] ?>">
							<dl class="grow">
								<dt class="font-bold text-2xl">
									Submittal No. 
									<input class="border w-16 pl-2" type="number" name="new_submittal_no" value="<?=$submittal['Submittal_No'] ?>">
								</dt>
								<dd class="text-xl">
									Contract: 
									<select name="contract" class="border">
										<?php
										if(empty($submittal['contract'])) {
										?>
										<option selected value="">None</option>
										<?php
										} else {
										?>
										<option value="">None</option>
										<?php
										}
										foreach ($contracts as $contract) {
											$selected = !empty($submittal['Contract_No']) && $contract['Contract_No'] == $submittal['Contract_No'] ? 'selected' : null;
										?>
											<option <?=$selected?> value="<?=$contract['Contract_No']?>"><?=$contract['Contract_No']?></option>
										<?php
										}
										?>
									</select>
										
								</dd>
							</dl>
							<div class="text-right">
								<button class="hover:text-blue-500" type="submit">Update</button>
							</div>
						</form>
						<form method="POST" action="<?=BASE_URL?>/submittals/delete.php">
							<input type="hidden" name="submittal_no" value="<?=$submittal['Submittal_No'] ?>">
							<button class="hover:text-red-500" type="submit">Delete Submittal</button>
						</form>

						<table class="w-full" style="max-height: 500px;">
							<thead>
								<tr>
									<td class="mt-4 py-2 font-bold border-b" colspan="2">Authors</td>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($authors as $author) {
								?>
								<tr>
									<td class="py-2">
										<span class="block"><?=$author['First_Name']?> <?=$author['Last_Name']?></span>
										<span class="block text-sm"><?=$author['Email']?></span>
									</td>
									<td class="text-right py-2">
										<?php
										if(count($authors) > 1) {
										?>
										<form method="POST" action="delete_author.php">
											<input type="hidden" name="submittal_no" value="<?=$submittal['Submittal_No']?>">
											<input type="hidden" name="author" value="<?=$author['SSN']?>">
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
						if (!empty($new_authors)) {
						?>
						<form class="mt-8 border-t py-4 flex justify-between" method="POST" action="add_author.php">
							<input type="hidden" name="submittal_no" value="<?=$submittal['Submittal_No']?>">
							<div>
								<select name="author" id="author" class="border">
									<option selected>Add an author</option>
									<?php
									foreach($new_authors as $employee) {
									?>
										<option value="<?=$employee['SSN']?>"><?=$employee['First_Name']?> <?=$employee['Last_Name']?></option>
									<?php
									}
									?>
								</select>
							</div>
							<button type="submit" class="hover:text-blue-500">Add</button>
						</form>
						<?php
						}
						?>
					</div>
					<div class="w-3/5 ml-4">
						<div class="text-center bg-gray-100" style="height: 600px">
							<img src="#" alt="Submittal Image Placeholder">						
						</div>
					</div>
				</section>
				<section>
					<table class="w-full" style="max-height: 500px;">
						<thead>
							<tr>
								<td class="mt-4 py-2 font-bold border-b" colspan="2">Attachments</td>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($attachments as $attachment) {
							?>
							<tr>
								<td class="py-2">
									<a href="<?=BASE_URL.'/attachments/'.$attachment['Filename']?>" class="h-32 w-32"><?=$attachment['Filename']?></a>
								</td>
								<td class="text-right py-2">
									<form method="POST" action="<?=BASE_URL?>/submittals/delete_attachment.php">
										<input type="hidden" name="submittal_no" value="<?=$submittal['Submittal_No']?>">
										<input type="hidden" name="attachment" value="<?=$attachment['Attachment_No']?>">
										<button type="submit" class="hover:text-red-500">Delete</button>
									</form>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					<form method="POST" action="<?=BASE_URL?>/submittals/add_attachment.php" enctype="multipart/form-data" class="flex justify-between">
						<input type="hidden" name="submittal_no" value="<?=$submittal['Submittal_No']?>">
						<div>
							<label>Add an attachment:</label>
							<input type="file" name="attachment">
						</div>
						<div>
							<button class="hover:text-blue-500" type="submit">Upload</button>
						</div>
					</form>
				</section>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>