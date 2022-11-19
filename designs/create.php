<?php
$title = 'Add a Design';

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
			<h1 class="text-xl font-semibold m-4">Add a Design</h1>

			<form class="m-4" method="POST" action="post.php">
				<div class="mb-4">
					<input type="number" name="design_no" class="border px-2 rounded" placeholder="Enter Design No.">
				</div>
				<div class="mb-4">
					<input type="number" name="budget" class="border px-2 rounded w-64" placeholder="What's the design's budget?">
				</div>
				<div>
					<button type="submit" name="submit" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Design</button>
				</div>
			</form>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>