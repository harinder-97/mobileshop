<?php
require_once("includes/top.php");
require_once("includes/header.php");
require_once("inc_navigation.php");

if(isset($_GET['id']) ? $_GET['id'] : ''){
	$id = $_GET['id']; 
	
	$qury = "DELETE FROM web_sale where id='".(int)$id."'";	 

	if(mysqli_query($conn,$qury)) {
		$_SESSION['success'] = 'Sales Offers removed successfully!';	
	} else {
		$_SESSION['error'] = 'Error in removing Sales Offers';	
	} 
}

?>
<section class="right-panel">
<div class="breads">
	Home / Manage Sales Offers
</div>
<div class="page-title">
	<h2>Manage Sales Offers</h2>
</div>
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
	
       
$sql = "SELECT * FROM web_sale";
$execute_sql = mysqli_query($conn,$sql) or die("sql error");
$count_records = mysqli_num_rows($execute_sql);
$page_no = (isset($_GET['page_no']))?$_GET['page_no']:1;
$limit = 20;

if ($page_no == 1)
	$offset = ( ($page_no-1) * 20 ) ;
else
	$offset = ( ($page_no-1) * 20 ); 
$qq = "SELECT * FROM web_sale order by id DESC limit ".$offset.",".$limit;

$result = mysqli_query($conn,$qq);

$num_rows = mysqli_num_rows($result);
if($num_rows>0)
{

?>
<div class="main-content clearfix">
	<a href="add_sale.php" class="btn btn-primary pull-right" style="margin: 10px;"><i class="fa fa-plus-circle"></i>ADD SALES OFFERS</a>
			  
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>					  
				<tr>
					<th style="width:50px;">S.No</th>
					<th>Product Category</th>			   
					<th>Product Name</th>			   
					<th>Discount</th>			   
					<th>Status</th>
					<th>Manage</th>
				</tr>
			</thead>
            <tbody>
    <?php          
			while ($row = mysqli_fetch_assoc($result) )
			{
            $offset++;
          ?>    
                <tr>
                    <td><?php echo $offset;?></td>
					<td>
					<?php
						$product_category = $row['product_category'];
					
						$cat_sql = "SELECT * from web_category where id='".$product_category."' and _status=0 order by id DESC";
						$ce_sql = mysqli_query($conn,$cat_sql);
						$count_records = mysqli_num_rows($ce_sql);
						if($count_records>0)
						{
							$pcrow = mysqli_fetch_assoc($ce_sql);
							echo $pcrow["category_name"];  
						}
					?>
					</td>
					<td><?php
						$product_id = $row['product_id'];
					
						$pro_sql = "SELECT * from web_products where id='".$product_id."' and _status=0 order by id DESC";
						$pr_sql = mysqli_query($conn,$pro_sql);
						$count_records = mysqli_num_rows($pr_sql);
						if($count_records>0)
						{
							$prrow = mysqli_fetch_assoc($pr_sql);
							echo $prrow["product_name"];  
						}
					?></td>
					<td><?php echo $row['discount']; ?>%</td>
                    <td><?php $status= $row['_status']; 
						if($status==0){
							echo"<span class='btn btn-mini btn-success'>Enable</span>";
						}else{
							echo"<span class='btn btn-mini btn-danger'>Disable</span>";
						}?>
					</td>                   
                    <td><a onclick="return confirm('Do you really want to delete?');" href="list_sales.php?id=<?php echo $row['id'];?>" title="Delete"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>&nbsp;
                        <a href="edit_sale.php?id=<?php echo $row['id'];?>" title="Edit"><button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a></td>
                </tr>
            <?php } ?>                
            </tbody>
        </table>
    </div>
</div>
    <ul class="pull-right pagination">
        <?php if (($page_no-1) >0 ): ?>
            <li><a href="list_sales.php?page_no=<?php echo $page_no-1; ?>">«</a></li>
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
                <a href="list_sales.php?page_no=<?php echo $page; ?>"><?php echo $page; ?> 
                <?php if ($page == $page_no): ?>
                    <span class="sr-only">(current)</span>
                <?php endif; ?>
                </a>
              </li>
              <?php 
                endfor;
              ?>

              <?php
               if ( ( $page_no + 1 ) <= $pages  ): ?>
                <li><a href="list_sales.php?page_no=<?php echo $page_no+1; ?>">»</a></li>
              <?php else: ?>
                <li class="disabled"><a href="javascript:void(0);">»</a></li>
              <?php endif; ?>
            </ul>                   
                  
 <?php } 
 else
 {
 echo "<h2>  No records </h2> ";
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