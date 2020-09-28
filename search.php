<?php
include('connectvars.php');
if($_POST)
{
$q=$_POST['search'];
$connection = mysqli_connect('localhost','root','root','bwdb');
$query="select md_name,md_rating,md_year,md_poster,md_type from media where md_name like '%$q%' or md_rating like '%$q%' or md_year like '%$q%' or md_poster like '%$q%' order by mid";
$sql_res=mysqli_query($connection,$query);
$counter = mysqli_num_rows($sql_res);
$limitres = 0;

while( $row=mysqli_fetch_array($sql_res))
{
	$poster=$row['md_poster'];
  	$name=$row['md_name'];
  	$year=$row['md_year'];
  	$rating=$row['md_rating'];
  	$type=$row['md_type'];
?>

<div class="show">

<div class="section group-search">

	<div class="col-search searchcol_small">
		<div class="search-image">
			<img src="<?php echo $poster;?>"/>
		</div>
	</div>

	<div class="col-search searchcol_big">
		<div class="search-info">
		  	<div class="search-name"><?php echo $name; ?></div>
		  	<div class="search-type">
		  	<?php 
		  		if ($type==1) {
		  			echo "TV Show";
		  		}
		  		elseif ($type==2) {
		  			echo "Movie";
		  		}
		  		else {
		  			exit;
		  		}
		  	?>
		  	</div>
		  	<div class="search-year"><span class="search-bold">Year:</span> <?php echo $year; ?></div>
		  	<div class="search-rating"><span class="search-bold">IMDb:</span> <?php echo $rating; ?>/10</div>
		</div>
	</div>

</div>

</div>

<?php
$limitres++;
if ($limitres == 3) {
	break;
}
}

if ($counter == 0) {
	echo '<div class="no-results">No results found for "<span class="bolded">'.$q.'</span>"</div>';
}

if ($counter > 3) {
	echo '<a href="search-results.php?q='.$q.'" class="show-more">SHOW MORE</a>';
}

}
?>
