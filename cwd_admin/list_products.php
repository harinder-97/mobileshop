<?php
require_once("includes/top.php"); 
require_once("includes/header.php");
require_once("inc_navigation.php");

if(isset($_GET['id']) ? $_GET['id'] : ''){
	$id = $_GET['id'];
	$qury = "DELETE from web_products where id='".(int)$id."'";	
	
	if(mysqli_query($conn,$qury)){
		$iqury = "DELETE from web_productpics where pid='".(int)$id."'";	
		if(mysqli_query($conn,$iqury)){		
			$_SESSION['success'] = 'Product Image Deleted successfully!';	
		} else {
			$_SESSION['error'] = 'Error in deleting Product Image';	
		}	
		$_SESSION['success'] = 'Product Deleted successfully!';	
	} else {
		$_SESSION['error'] = 'Error in deleting Product';	
	}	
}
?>
<section class="right-panel">
	<div class="breads"> 
	Home / List Products
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
	<h1>List Products</h1>
	</div>
	<?php
	$sql = "SELECT * from web_products order by id DESC";
	$execute_sql = mysqli_query($conn,$sql) or die("sql error");
	$count_records = mysqli_num_rows($execute_sql);

	$page_no = (isset($_GET['page_no']))?$_GET['page_no']:1;
	$limit = 20;
	if ($page_no == 1)
		$offset = ( ($page_no-1) * 20 ) ;
	else
		$offset = ( ($page_no-1) * 20 ); 
	$qq = "SELECT * FROM web_products order by id DESC limit ".$offset.",".$limit;
	$result = mysqli_query($conn,$qq);

	$num_rows = mysqli_num_rows($result);
	if($num_rows>0)
	{
	?>
	<div class="main-content">
	  <a href="add_product.php" class="btn btn-primary pull-right"><span class="fa fa-plus"></span>&nbsp;ADD PRODUCT</a>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<tr>
                  <th style="width:50px;">S.No</th>
                  <th>Product Name</th>
                  <th>Product Category</th>	
                  <th>Status</th>
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
					<td><?php echo $row['product_name']; ?></td>
					<td>
					<?php
					$cat_sql = "SELECT * from web_category where id='".(int)$row['product_category']."' AND _status= '0' order by id DESC";
					$ce_sql = mysqli_query($conn,$cat_sql);
					$count_records = mysqli_num_rows($ce_sql);
					if($count_records>0)
					{
						$pcrow = mysqli_fetch_assoc($ce_sql);
						echo $pcrow['category_name'];
					}
					?>					
					</td>
					<td><?php $status= $row['_status']; 
					  if($status==0)
						{
						  echo"<span class='btn btn-mini btn-success'>Enable</span>";
						}
						else
						{
						  echo"<span class='btn btn-mini btn-danger'>Disable</span>";
						}
					?></td>
					<td><a onclick="return confirm('Do you really want to delete?');"  href="list_products.php?id=<?php echo $row['id'];?>" title="Delete" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>&nbsp;
						<a href="edit_product.php?id=<?php echo $row['id'];?>" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
					</td>
				</tr>
				<?php } ?> 
			</table>
		</div>
	</div>
	
	<ul class="pull-right pagination">

	<?php if (($page_no-1) >0 ): ?>
		<li><a href="list_products.php?page_no=<?php echo $page_no-1; ?>">«</a></li>
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
			<a href="list_products.php?page_no=<?php echo $page; ?>"><?php echo $page; ?> 
			<?php if ($page == $page_no): ?>
			<span class="sr-only">(current)</span>
			<?php endif; ?>
			</a>
			</li>
		<?php 
		endfor;	?>
		<?php
		if ( ( $page_no + 1 ) <= $pages  ): ?>
		<li><a href="list_products.php?page_no=<?php echo $page_no+1; ?>">»</a></li>
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
