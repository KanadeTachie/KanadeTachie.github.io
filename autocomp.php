<?php
//You can probably understand all of this after reading other comments in the other files
$db = mysqli_connect('localhost', 'root', '', 'mediaserver');

if (isset($_GET['term'])) {
    
	$term = $_GET['term'];
	$query = "SELECT * FROM files WHERE filename LIKE '%" . $term . "%' LIMIT 10";
    $result = mysqli_query($db, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($files = mysqli_fetch_array($result)) {
      $res[] = $files['filename'];
     }
    } else {
      $res = array(); //empty array
    }
    //return json res
    echo json_encode($res);
}
?>