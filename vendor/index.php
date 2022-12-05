<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/vendor.php');

$title = 'Vendor';
$vendors = [];
$error = NULL;

$search_term = $_GET['search_term'] ?? '';
try {
	$vendors = empty($search_term) ? get_vendors($db): search_vendors($db, $search_term);
	$vendors = $vendors->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
	$vendors = [];
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
                <h1 class="text-xl font-semibold">Vendors</h1>
				<div class="text-right">
                    <a href="create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Vendor</a>
                </div>
            </div>
            <form class="m-4 flex" method="GET" action="index.php">
				<input class="border px-2 rounded grow" type="search" placeholder="Enter Vendor Name" name="search_term" value="<?=$search_term?>">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search Vendor</button>
			</form>

			<div class="grid grid-cols-10 gap-8 m-4">
			<?php
			foreach($vendors as $vendor) {
			?>
				<a href="vendor.php?id=<?=$vendor['Vendor_Id']?>" class="border rounded hover:border-blue-500">
					<section>
						<dl class="p-2">
							<dt class="font-bold"><?=$vendor['Vendor_Name'] ?></dt>
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
