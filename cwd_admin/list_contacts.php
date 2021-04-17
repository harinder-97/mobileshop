<?php
require_once("includes/top.php");
require_once("includes/header.php");
require_once("inc_navigation.php");

if(isset($_GET['id']) ? $_GET['id'] : ''){
	$id = $_GET['id']; 
	
	$qury = "DELETE FROM web_contacus where id='".(int)$id."'";	 

	if(mysqli_query($conn,$qury)) {
		$_SESSION['success'] = 'Contact Enquiry removed successfully!';	
	} else {
		$_SESSION['error'] = 'Error in removing Contact Enquiry Offers';	
	} 
}

?>
<section class="right-panel">
<div class="breads">
	Home / Manage Contacts Enquiry
</div>
<div class="page-title">
	<h2>Manage Contacts Enquiry</h2>
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
	
       
$sql = "SELECT * FROM web_contacus";
$execute_sql = mysqli_query($conn,$sql) or die("sql error");
$count_records = mysqli_num_rows($execute_sql);
$page_no = (isset($_GET['page_no']))?$_GET['page_no']:1;
$limit = 20;

if ($page_no == 1)
	$offset = ( ($page_no-1) * 20 ) ;
else
	$offset = ( ($page_no-1) * 20 ); 
$qq = "SELECT * FROM web_contacus order by id DESC limit ".$offset.",".$limit;

$result = mysqli_query($conn,$qq);

$num_rows = mysqli_num_rows($result);
if($num_rows>0)
{

?>
<div class="main-content clearfix">
			  
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>					  
				<tr>
					<th style="width:50px;">S.No</th>
					<th>Name</th>			   
					<th>Email</th>			   
					<th>Phone Number</th>			   
					<th>Address</th>
					<th>Send On</th>
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
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row['phone_no']; ?></td>
                    <td><?php echo $row['address']; ?></td>                   
                    <td><?php echo $row['updated_on']; ?></td>                   
                    <td><a onclick="return confirm('Do you really want to delete?');" href="list_contacts.php?id=<?php echo $row['id'];?>" title="Delete"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                </tr>
            <?php } ?>                
            </tbody>
        </table>
    </div>
</div>
    <ul class="pull-right pagination">
        <?php if (($page_no-1) >0 ): ?>
            <li><a href="list_contacts.php?page_no=<?php echo $page_no-1; ?>">«</a></li>
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
                <a href="list_contacts.php?page_no=<?php echo $page; ?>"><?php echo $page; ?> 
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
                <li><a href="list_contacts.php?page_no=<?php echo $page_no+1; ?>">»</a></li>
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