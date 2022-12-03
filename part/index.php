<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');

$title = 'Part';
$parts = [];
$error = NULL;

$search_term = $_GET['search_term'] ?? '';
try {
	$parts = empty($search_term) ? get_parts($db): search_parts($db, $search_term);
	$parts = $parts->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
	$parts = [];
	$error = 'Failed to execute search query or fetch data.';
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
            <div class="grid grid-cols-2 m-4">
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
                <h1 class="text-xl font-semibold">Parts</h1>
				<div class="text-right">
                    <a href="create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Part</a>
                </div>
            </div>
            <form class="m-4" method="GET" action="index.php">
				<input class="border px-2 rounded" type="search" placeholder="Part_No" name="search_term" value="<?=$search_term?>">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search Part</button>
			</form>

			<div class="grid grid-cols-10 gap-8 m-4">
			<?php
			foreach($parts as $part) {
			?>
				<a href="part.php?id=<?=$part['Part_No']?>" class="border rounded hover:border-blue-500">
					<section>
						<dl class="p-2">
							<dt class="font-bold"><?="Part No: ".$part['Part_No'] ?></dt>
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






<?php
include('../templates/bottom.php');
?>