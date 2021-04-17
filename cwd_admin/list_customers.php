<?php
require_once("includes/top.php"); 
require_once("includes/header.php");
require_once("inc_navigation.php");

if(isset($_GET['id']) ? $_GET['id'] : ''){
	$id = $_GET['id'];
	$qury = "DELETE from web_customers where id='".(int)$id."'";	
	
	if(mysqli_query($conn,$qury)){
		$_SESSION['success'] = 'Customer Deleted successfully!';	
	} else {
		$_SESSION['error'] = 'Error in deleting Customer';	
	}	
}
?>
<section class="right-panel">
	<div class="breads"> 
	Home / List Customers
	</div>
	<br/>
	<?php 
	if (isset($_SESSION['error']) && $_SESSION['error'] <>"")
	{?>
	<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> 
		<?php echo trim($_SESSION['error']);?></div>
	<?php   }
		?>
	<?php 
	if (isset($_SESSION['success']) && $_SESSION['success'] <>"")
		{?>
	<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo trim($_SESSION['success']);?></div>
	<?php   }
	?>
	<div class="page-title">
	<h1>List Customers</h1>
	</div>
	<?php
	$sql = "SELECT * from web_customers order by id DESC";
	$execute_sql = mysqli_query($conn,$sql) or die("sql error");
	$count_records = mysqli_num_rows($execute_sql);

	$page_no = (isset($_GET['page_no']))?$_GET['page_no']:1;
	$limit = 20;
	if ($page_no == 1)
		$offset = ( ($page_no-1) * 20 ) ;
	else
		$offset = ( ($page_no-1) * 20 ); 
	$qq = "SELECT * FROM web_customers order by id DESC limit ".$offset.",".$limit;
	$result = mysqli_query($conn,$qq);

	$num_rows = mysqli_num_rows($result);
	if($num_rows>0)
	{
	?>
	<div class="main-content">
	  
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<tr>
                  <th style="width:50px;">S.No</th>
                  <th>Name</th>
                  <th>Email Id</th>	
                  <th>Phone Number</th>
                  <th>Manage</th>
                </tr> 
				<?php
				$count=0;
				while ($row = mysqli_fetch_assoc($result) )
				{
					$count++;
				?>    
				<tr>
					<td><?php echo $count;?></td>
					<td><?php echo $row['first_name']." ". $row['last_name']; ?></td>
					<td><?php echo $row['email']?></td>
					<td><?php echo $row['phone_no']?></td>
					
					<td><a onclick="return confirm('Do you really want to delete?');"  href="list_customers.php?id=<?php echo $row['id'];?>" title="Delete" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>&nbsp;
						<a href="view_customer.php?id=<?php echo $row['id'];?>" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
					</td>
				</tr>
				<?php } ?> 
			</table>
		</div>
	</div>
	
	<ul class="pull-right pagination">

	<?php if (($page_no-1) >0 ): ?>
		<li><a href="list_customers.php?page_no=<?php echo $page_no-1; ?>">«</a></li>
		<?php else: ?>
		<li class="disabled"><a href="javascript:void(0);">«</a></li>
		<?php endif; ?>

		<?php 
		$pages = $count_records / $limit ; 
		$pages = ceil($pages);
		for($page = 1; $page <=$pages ; $page++ ):
			$class = "";
			if ($page == $page_no){
				$class = "active";
			}
			?>
			<li class="<?php echo $class; ?>">
			<a href="list_customers.php?page_no=<?php echo $page; ?>"><?php echo $page; ?> 
			<?php if ($page == $page_no): ?>
			<span class="sr-only">(current)</span>
			<?php endif; ?>
			</a>
			</li>
		<?php 
		endfor;	?>
		<?php
		if ( ( $page_no + 1 ) <= $pages  ): ?>
		<li><a href="list_customers.php?page_no=<?php echo $page_no+1; ?>">»</a></li>
		<?php else: ?>
		<li class="disabled"><a href="javascript:void(0);">»</a></li>
		<?php endif; ?>
	</ul>                
	<?php }  
	else
	{
	echo "<h2>No records </h2>";   
	}
	?>    
	</section>
<?php require_once("includes/footer.php"); ?>

<script>
$(document).ready(function(){
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
        var clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
    }
});
</script>
