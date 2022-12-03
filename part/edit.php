<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');

$Title = "Part";
$error = NULL;

$part_no = $_GET['id'] ?? '';
$part = get_part($db, $part_no);


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
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>