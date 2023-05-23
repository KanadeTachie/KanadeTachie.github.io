<?php
  
  $db = mysqli_connect('localhost', 'root', '', 'mediaserver'); #Used to connect to SQL database
  #'researchstudy' and '6)sooTKi88z[ypAh' are the username and password of the database
  #Default configuration for username and password is 'root' and '', respectively.
  #$db = mysqli_connect('localhost', 'root', '', 'databaseName')
  
  $filedir = "media/"; #Inside server folder, create a directory named 'media'
  $mode = strval($_GET['mode']); #Assigns the passed value 'mode' to a local variable
  $x = 0;
  if(isset($_GET['pfile'])){ #Checks if value 'pfile' was passed, then assigns it to a local variable
	$play = strval($_GET['pfile']);
  }

  if($mode == 1){ #Scans media folder and adds them to the database if there are new additions.
	  foreach(array_filter(glob("media/*"), 'is_file') as $file){ #returns as 'media/filename.ext' and assigns it to '$file'
		  $filename = trim($file, "media/"); #removes 'media/' from $file
		  $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION)); #returns the filetype
		  $user_check_query = "SELECT * FROM files WHERE filename='$filename' LIMIT 1";
		  $result = mysqli_query($db, $user_check_query); #mysqli_query() is used to execute a php query
		  $user = mysqli_fetch_assoc($result); #returns the associated data from the query
		  if(!$user) {
			  $query = "INSERT INTO files (filename, extension)
						VALUES('$filename', '$imageFileType')"; #Only filename will be passed into the database, as well as the extension.
			  $execQuery = mysqli_query($db, $query);           #Though, the extension is not needed. Just did it just to be sure.
			  $x += 1;
		  }
	  }
	  echo "Added " . $x . " files"; #Returns value to as 'responseText' in the main script
	  
  } elseif($mode == 2){ #Update the file list in the main script.
	  $query = "SELECT * FROM files";
	  $result = mysqli_query($db, $query);
	  echo "<table>
	  			<thead class = 'header'>
	  				<tr>
	  					<th class = 'log_number'>#</th>
						<th class = 'filename'>File</th>
	  				</tr>
	  			</thead>
	  									
	  			<tbody class = 'data'>"; #returns HTML elements as string that are then implemented in the main script using the innerHTML function
	  while($row = mysqli_fetch_array($result)) { #Loops through all the available data in the 'files' table and assigns them to the HTML table rows element
	  	echo "<tr>";
	  	echo "<td>" . $row['fileno'] . "</td>";
	  	echo "<td>" . $row['filename'] . "</td>";
	  	echo "</tr>";
	  }
	  echo "</table>";
  } elseif($mode == 3){ #Plays the chosen file
	  echo "<video id='mediaplayer' controls='true'>
			<source src='media/" . $play . "'>
			</video>";	
  }	  
?>