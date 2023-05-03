<?php
include_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		table, th, td {
  border: 1px solid black;
  width: auto;
  padding: 30px	;
  text-align: center;
  font-size: 20px;
}
a, select {
	
	font-size: xxx-large;
	padding: 10px;
}
button {
	font-size: large;
	padding: 7px;
}
.btn{
	width: 20%;
	height: 35px;
margin-bottom: 20px;
border-radius:30px;
}
span{
    position: absolute;
    right: 20px;
}
</style>
	<title>Pagination</title>
	
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>table without ajax</title>
</head>
<h1 align="center">Pagination For Product Table</h1>
<body>
	<input type="search" class="btn" placeholder="Search" id="dtUserSearch">
	<button onclick="search();" > Search </button>
<span align="right">
	<button > CSV </button>
	<button > PDF </button>
	<button > JSN </button>
</span>

	<?php
	if(isset($_GET["page"])){
		$page = $_GET["page"];
	}else{
		$page = 1;
	}
	if(isset($_GET["records"])){
		$per_page_record = $_GET["records"];
	}else{
		$per_page_record = 5;
	}
	
	$starting = ($page-1) * $per_page_record;
	?>

<table>
		<thead style="font-weight: 1000;">
		<strong>
			<tr>
			<td style="width: 5%;">ID</td>
			<td style="width: 12%;">NAME</td>
			<td style="width: 12%;">DESCRIPTION</td>
			<td style="width: 10%;">PRICE</td>
			<td style="width: 12%;">CATEGORY ID</td>
			<td style="width: 12%;">CREATED ON</td>
			<td style="width: 12%;">MODIFIED ON</td>
		</tr>
		</strong>
		</thead>
			<?php 
			if(isset($_GET["srh"])){
				$total_pages = ceil(mysqli_num_rows(mysqli_query($con, "SELECT * FROM products where name like '%".$srh."%'"))/ $per_page_record);
			$result = mysqli_query($con, "SELECT * FROM products LIMIT $starting, $per_page_record");
			}else{
			$total_pages = ceil(mysqli_num_rows(mysqli_query($con, "SELECT * FROM products"))/ $per_page_record);
			$result = mysqli_query($con, "SELECT * FROM products LIMIT $starting, $per_page_record");
			}
			while($row = mysqli_fetch_array($result))
			{?>
			<tr>
			<td><?php echo $row["id"]; ?></td>
			<td><?php echo $row["name"]; ?></td>
			<td><?php echo $row["description"]; ?></td>
			<td><?php echo $row["price"]; ?></td>
			<td><?php echo $row["category_id"]; ?></td>
			<td><?php echo $row["created"]; ?></td>
			<td><?php echo $row["modified"]; }?></td>
			</tr>
	</table>	
	<div style = "font-size: xxx-large;">
	<?php 
	if($page>=2){
		echo "<a style href='pagination.php?page=".($page-1)."'>  Prev </a>";
	}
		for($i=0; $i<$total_pages;$i++){
			if($page == ($i+1)){
				echo "<a style='color: red;' href='pagination.php?page=".($i+1)."'>".($i+1)."</a>";
			}else{
		echo "<a style='color: blue;' href='pagination.php?page=".($i+1)."'>".($i+1)."</a>";
		 }
		}
	if($page<$total_pages){
		echo "<a href='pagination.php?page=".($page+1)."'>  Next </a>";	
	}
?>
<select align="right" onchange="myhref(<?php echo $page;?>, this.value);">
		<option  >no of records</option>";
  	<option value='5'>5</option>
  	<option value='10' >10</option>
  	<option value='25' >25</option>
  	<option value='50' >50</option>
	
</select>
</div>
<script>
	function myhref(page, records) {
            location.href =
              "pagination.php?page="+page+"&records="+records;
        }
		function search(page){
			var srh = document.getElementById("dtUserSearch").value;
			location.href = 
              "pagination.php?page="+page+"&records="+records+"&search="+srh;
		}
    </script>
</body>
</html>