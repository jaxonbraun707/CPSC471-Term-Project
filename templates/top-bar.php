<?php
$first_name = $_SESSION['user']['employee']['First_Name'];
$last_name = $_SESSION['user']['employee']['Last_Name'];
?>
<div class="border flex justify-between p-4 fixed top-0 w-full z-10 bg-white">
	<nav>
		<a href="" class="text-blue-500 text-xl font-bold">WORC!</a>
	</nav>
	<div class="relative inline-block text-left">
		<button onclick="toggle('top-user-dropdown-menu')" type="button" class="inline-flex w-full justify-center bg-white text-sm font-medium hover:text-blue-400" id="top-user-dropdown-button" aria-expanded="true" aria-haspopup="true">
      		Hello, <?=$first_name?> <?=$last_name?>!
      		<!-- Heroicon name: mini/chevron-down -->
      		<svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        		<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      		</svg>
    	</button>
		<nav id="top-user-dropdown-menu" class="absolute right-0 mt-2 z-10 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="top-user-dropdown" tabindex="-1">
	  		<form method="POST" action="<?=BASE_URL?>/logout.php">
	  			<button type="submit" class="text-gray-700 block px-4 py-2 text-sm hover:text-blue-400" role="menuitem" tabindex="1">Log out</button>
	  		</form>
		</nav>
	</div>
	<script type="text/javascript">
		toggle('top-user-dropdown-menu');

		function toggle(element_id) {
	  		let x = document.getElementById(element_id);
	  		if (x.style.display === "none") {
	    		x.style.display = "block";
	  		} else {
				x.style.display = "none";
			}
		}
	</script>
</div>