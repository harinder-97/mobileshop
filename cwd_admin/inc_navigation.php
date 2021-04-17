<section class="left-bar">
    <nav id="sidebar">
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
		<div class="menu-list">
			<ul class="sidebar-menu menu-content collapse show" id="menu-content">
				<li class="sidebar-header">Welcome <?php echo $username;?></li>
                <li>
				  <a href="panel.php">
					  <i class="fa fa-tachometer"></i> <span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-tasks"></i> <span>Categories</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="sidebar-submenu">
						<li><a href="add_category.php"><i class="fa fa-circle-o"></i>Add Category</a></li>
						<li><a href="list_categories.php"><i class="fa fa-circle-o"></i>Manage Categories</a></li>							   
					</ul>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-product-hunt"></i> <span>Products</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="sidebar-submenu">
						<li><a href="add_product.php"><i class="fa fa-circle-o"></i>Add Product</a></li>
						<li><a href="list_products.php"><i class="fa fa-circle-o"></i>Manage Products</a></li>							   
					</ul>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-tasks"></i> <span>Sales</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="sidebar-submenu">
						<li><a href="add_sale.php"><i class="fa fa-circle-o"></i>Add Sales Offers</a></li>
						<li><a href="list_sales.php"><i class="fa fa-circle-o"></i>Manage Sales Offers</a></li>							   
					</ul>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-user"></i> <span>Customers</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="sidebar-submenu">
						<li><a href="list_customers.php"><i class="fa fa-circle-o"></i>Manage Customers</a></li>							   
					</ul>
				</li>	
				<li>
					<a href="#">
						<i class="fa fa-user"></i> <span>Contact Enquires</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="sidebar-submenu">
						<li><a href="list_contacts.php"><i class="fa fa-circle-o"></i>List Contact Enquires</a></li>							   
					</ul>
				</li>	
				<li>
					<a href="#">
						<i class="fa fa-lg fa-fw fa-gear"></i> <span>Account</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="sidebar-submenu">
						<li><a href="changepassword.php"><i class="fa fa-circle-o"></i> Change Password</a></li>
						<li><a href="logout.php"><i class="fa fa-circle-o"></i> Logout</a></li>
					</ul>
				</li>                       
			</ul>
        </div>
    </nav>
</section> 
 