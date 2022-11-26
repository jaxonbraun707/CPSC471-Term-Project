<?php
/**
 * Unauthorized page
 * used by must_be_admin.php to notify user that they are unauthorized to access
 * a page. 
 */

include('top.php');
?>
<main>
	<section class="text-center py-48">
		<h1 class="text-3xl">You are <strong>unauthorized</strong> to access this page.</h1>
	</section>
</main>
<?php
include('bottom.php');
?>