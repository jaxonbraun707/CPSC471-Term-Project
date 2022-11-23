
<?php
$title = 'Employees';
$dbname = 'worc';
$db = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');

$employees = $db->query('SELECT * FROM Employee');
$employees = $employees->fetchAll(PDO::FETCH_ASSOC);

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
                <h1 class="text-xl font-semibold">Employees</h1>
				<div class="text-right">
                    <a href="create.php" class="hover:bg-blue-400 bg-blue-500 text-blue-50 py-2 px-4 rounded font-semibold">Add Employee</a>
                </div>
            </div>
            <form class="m-4" action=search.php>
				<input class="border px-2 rounded" type="search" placeholder="Enter Name">
				<button class="hover:text-blue-400 hover:border-blue-400 border px-2 text-black rounded font-semibold" type="submit">Search</button>
			</form>

			<div class="grid grid-cols-5 gap-8 m-4">
			<?php
			foreach($employees as $employee) {
			?>
				<a href="employee.php?id=<?=$employee['SSN']?>" class="border rounded hover:border-blue-500">
					<section>
						<!-- <div class="text-center bg-gray-100 h-32">
							<img src="#" alt="Employee Image Placeholder">						
						</div> -->
						<dl class="p-2">
							<dt class="font-bold"><?=$employee['First_Name'] ?> <?' '?><?=$employee['Last_Name']?></dt>
							<dt class="font-semibold"><?=$employee['Job_Type'] ?></dt>
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