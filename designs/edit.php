<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/design.php');

$title = "Design | ";
$error = NULL;

$design_no = $_GET['id'] ?? '';
$design = find_design($db, $design_no);
$authors = find_design_authors($db, $design_no);
$drawings = find_design_drawings($db, $design_no);
// retrieve new_authors needed for the authors field.
$new_authors = [];
$new_authors = get_new_design_authors($db, $design_no, $_job_types['engineering']);
$new_authors = $new_authors->fetchAll(PDO::FETCH_ASSOC);

if(!empty($design)) {
	$design = $design->fetch();
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
						<form class="mb-4 flex" method="POST" action="<?=BASE_URL?>/designs/update.php">
							<input type="hidden" name="design_no" value="<?=$design['Design_No'] ?>">
							<dl class="grow">
								<dt class="font-bold text-2xl">
									Design No. 
									<input class="border w-16 pl-2" type="number" name="new_design_no" value="<?=$design['Design_No'] ?>">
								</dt>
								<dd class="text-xl">
									<input class="border w-32 pl-2" type="number" name="budget" value="<?=$design['Budget'] ?>">
									CAD
								</dd>
							</dl>
							<div class="text-right">
								<button class="hover:text-blue-500" type="submit">Update</button>
							</div>
						</form>
						<form method="POST" action="<?=BASE_URL?>/designs/delete.php">
							<input type="hidden" name="design_no" value="<?=$design['Design_No'] ?>">
							<button class="hover:text-red-500" type="submit">Delete Design</button>
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
											<input type="hidden" name="design_no" value="<?=$design['Design_No']?>">
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
							<input type="hidden" name="design_no" value="<?=$design['Design_No']?>">
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
							<img src="#" alt="Design Image Placeholder">						
						</div>
					</div>
				</section>
				<section>
					<table class="w-full" style="max-height: 500px;">
						<thead>
							<tr>
								<td class="mt-4 py-2 font-bold border-b" colspan="2">Drawings</td>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($drawings as $drawing) {
							?>
							<tr>
								<td class="py-2">
									<?=$drawing['Drawing_No']?>
								</td>
								<td class="text-right py-2">
									<form method="POST" action="delete_drawing.php">
										<input type="hidden" name="design_no" value="<?=$design['Design_No']?>">
										<input type="hidden" name="drawing" value="<?=$drawing['Drawing_No']?>">
										<button type="submit" class="hover:text-red-500">Remove</button>
									</form>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					<form method="POST" action="add_drawing.php">
						<input type="hidden" name="design_no" value="<?=$design['Design_No']?>">
						<label>Add a drawing:</label>
						<input type="number" name="drawing" class="py-2 border rounded pl-2 w-32">
						<button class="hover:text-blue-500" type="submit">Add</button>
					</form>
				</section>
				<section>
					<h2 class="mt-4 py-2 font-bold border-b">Used by the following Projects</h2>
				</section>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>