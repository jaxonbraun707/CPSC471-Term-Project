<?php
$title = 'Designs';

$dbname = 'worc';
$db = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');

$designs = $db->query('SELECT * FROM Design');
$designs = $designs->fetchAll(PDO::FETCH_ASSOC);

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
			<div class="grid grid-cols-2 m-4">
				<h1 class="text-xl font-semibold">Designs</h1>
				<div class="text-right">
					<a href="/designs/create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Design</a>
				</div>
			</div>
			<form class="m-4">
				<input class="border px-2 rounded" type="search" placeholder="Enter Design No.">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search for Design</button>
			</form>

			<div class="grid grid-cols-5 gap-8 m-4">
			<?php
			foreach($designs as $design) {
			?>
				<a href="design.php?id=<?=$design['Design_No']?>" class="border rounded hover:border-blue-500">
					<section>
						<div class="text-center bg-gray-100 h-32">
							<img src="#" alt="Design Image Placeholder">						
						</div>
						<dl class="p-2">
							<dt class="font-bold"><?=$design['Design_No'] ?></dt>
							<dd><?=number_format($design['Budget'], 2).' CAD' ?></dd>
						</dl>
					</section>
				</a>
			<?php
			}
			?>
			</div>
		</main>
	</div>
</div>
<?php
include('../templates/bottom.php');
?>