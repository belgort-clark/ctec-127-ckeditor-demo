<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CKEditor Sample</title>
	<script src="ckeditor/ckeditor.js"></script>
	<link href="css/style.css" rel="stylesheet">
</head>
<?php include "includes/mysqli_connect.inc.php"; ?>
<?php 
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		// update table
		$html = mysqli_real_escape_string($dbc,$_POST['editor1']);
		$sql = "UPDATE content SET sort_order={$_POST['sort_order']},html=\"{$html}\" where id={$_GET['edit']}"; 
		$result	= mysqli_query($dbc,$sql); 			
	}
?>
<body>
	<header>
		<h1>CTEC 127 / PHP with SQL 1</h1>
		<h2>Using the CKEditor</h2>
	</header>
	<?php 
		// Let's get some data to display for CRUD first
		$sql = "SELECT * from content ORDER BY sort_order";
		$result = mysqli_query($dbc,$sql);
	?>

	<table>
	<tr><th>Action</th><th>ID</th><th>Description</th><th>Order</th></tr>
	<?php
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td><a href=\"?edit={$row['id']}\">Edit</a> ";
			echo "<a href=\"?del={$row['id']}\">Delete</a>";
			echo "<td>{$row['id']}</td>";
			echo "<td>{$row['description']}</td>";
			echo "<td>{$row['sort_order']}</td>";
			echo "</tr>";
		}
	?>

	</table>

   <?php 
   	  if(isset($_GET['edit']) && !isset($_GET['saved'])){
   ?>
   <br><br>
   <form method="POST" action="?edit=<?php echo "{$_GET['edit']}&saved";?>">
			<?php 
               	// query the database to get the HTML
               	$sql = "SELECT * from content where id={$_GET['edit']}";
                $result = mysqli_query($dbc,$sql);
                $row = mysqli_fetch_array($result);
			?>

			<label for="description">Description</label>&nbsp;<input type="text" name="description" id="description" value="<?php echo $row['description'];?>" size="50">
			<br><br>

			<label for="sort_order">Order</label>&nbsp;<input type="text" name="sort_order" id="sort_order" value="<?php echo $row['sort_order'];?>" size="20">
			<br><br>

			<label for="html">HTML Content</label><br><br>
            <textarea name="editor1" id="editor1" rows="10" cols="80" id="html">
                <?php  
               	echo $row['html'];
                ?>
            </textarea>
	<input type="submit" value="Save">
   </form>
   <?php } ?>

   <script>

   	CKEDITOR.replace( 'editor1', {
    customConfig: '../config.js'
} );
   	
   </script>

</body>
</html>
