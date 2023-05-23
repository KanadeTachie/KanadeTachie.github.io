<?php 
  #Honestly not sure why I added this :). This serves no purpose, for now.
  session_start(); 
  
  $db = mysqli_connect('localhost', 'root', '', 'mediaserver');
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel = "stylesheet" href = "style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>

		<div class = "naviBar">
			<a href = "#" class = "active">Home</a>
			<a href = "#">About Us</a>
			<div class = "profile_dropdown">
				<button class = "profile">Profile</button>
				<div class = "profile_content">
					<a href = "#">Settings</a>
					<a href = "user_main.php?logout='1'">Logout</a>
				</div>
			</div>
		</div>
		
		<div class = "main">
			<div class = "col-12">
				<input type="text" id="searchbar" name="searchbar" placeholder="Search name...">
				<button class="butt" id="searchbutton" onclick="refreshList()"><i class="fa fa-refresh"></i></button>
				<button class="butt" id="update" onclick="updateFilelist()"><i class="fa fa-cog fa-spin"></i></button>
				<button class="butt" id="play" onclick="playFile()"><i class="fa fa-play"></i></button>
			</div>
			<div class = "log_book col-6" id = "book">
				<table>
					<thead class = "header">
						<tr>
							<th class = "log_number">#</th>
							<th class = "filename">File</th>
						</tr>
					</thead>
					
					<tbody class = "data">
						<tr>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class = "player col-6" id = "player">
				<video id='mediaplayer' controls='true'></video>
			</div>
		</div>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
			//Autocomplete live searchbar
			$(function(){
				$("#searchbar").autocomplete({
				source: 'autocomp.php'
				});
			});
		</script>
		<script>
			//Very bruteforced approach to handling these functions, could have made them better and shorter
			//but too lazy. AJAX functions based on W3 example, but there are other ways to implement AJAX.
			
			//Mode 1: Scans local 'media/' folder and checks if there are new media files to be added into the database
			function refreshList(){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				  if (this.readyState == 4 && this.status == 200) {
					console.log(this.responseText);
				  }
				};
				xmlhttp.open("GET","system.php?mode=1" ,true);
				xmlhttp.send();
			}
			
			//Mode 2: Updates file list inside browser for easy reference on which files are uploaded onto the server.
			function updateFilelist(){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				  if (this.readyState == 4 && this.status == 200) {
					document.getElementById('book').innerHTML = this.responseText;
				  }
				};
				xmlhttp.open("GET","system.php?mode=2" ,true);
				xmlhttp.send();
			}
			
			//Mode 3: Plays selected file.
			function playFile(){
				var xmlhttp = new XMLHttpRequest();
				var file = document.getElementById('searchbar').value;
				let pfile = file.trim();
				xmlhttp.onreadystatechange = function() {
				  if (this.readyState == 4 && this.status == 200) {
					document.getElementById('player').innerHTML = this.responseText;
				  }
				};
				xmlhttp.open("GET","system.php?mode=3&pfile=" + pfile,true);
				xmlhttp.send();
			}
		</script>
	</body>
</html>
