<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<link rel="icon" type="image/png" href="images/mini-logo.png"/>

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Schwan's | Supplier Listing</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="home.php" class="standard-logo" data-dark-logo="images/comp-logo.png"><img src="images/upper-logo.png" alt="Schwan's Logo"></a>
					</div><!-- #logo end -->

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu" class="style-4">
						<ul>
							<li><a href="home.php"><div>Home</div></a></li>
							<li class="current"><a href="suppliers.php"><div>Suppliers</div></a>
								<ul>
									<li><a href="suppList.php"><div><i class="icon-clipboard-list"></i>Supplier Listing</div></a></li>
									<li><a href="addSupp.php"><div><i class="icon-file-add"></i>Add New Supplier</div></a></li>
								</ul>
							</li>
							<li><a href="ware.php"><div>Warehouses</div></a>
								<ul>
									<li><a href="wareList.php"><div><i class="icon-clipboard-list"></i>Warehouse Listing</div></a></li>
									<li><a href="empList.php"><div><i class="icon-users1"></i>Warehouse Employees</div></a></li>
									<li><a href="addEmp.php"><div><i class="icon-file-settings"></i>Transfer Employee</div></a></li>
								</ul>
							</li>
							<li><a href="purchOrder.php"><div>Purchase Orders</div></a>
								<ul>
									<li><a href="purchList.php"><div><i class="icon-clipboard-list"></i>Purchase Order History</div></a></li>
									<li><a href="addPurch.php"><div><i class="icon-file-add"></i>Create New Order</div></a></li>
									<li><a href="updPurch.php"><div><i class="icon-file-settings"></i>Update Pending Order</div></a></li>
								</ul>
							</li>
							<li><a href="login.html"><div>Logout</div></a></li>
						</ul>

					</nav><!-- #primary-menu end -->

				</div>

			</div>

		</header><!-- #header end -->

		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Supplier Management</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item"><a href="suppliers.php">Suppliers</a></li>
					<li class="breadcrumb-item active" aria-current="page">Supplier Listing</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content">

				<div class="section">

					<div class="container clear-bottommargin clearfix">

						<div class="heading-block center">
							<h2>Supplier Listing</h2>
							<span>Listing of all current suppliers.</span>
						</div>

						<table class="table table-striped">
						<thead>
							<tr>
							<th>Supplier Name</th>
							</tr>
						</thead>
<?php						$host        = "host = 127.0.0.1";
						$port        = "port = 5432";
						$dbname      = "dbname = delivery";
						$credentials = "user = delivery password=frozen";

						$db = pg_connect( "$host $port $dbname $credentials"  );
						$sql =<<<EOF
						SELECT * FROM supplier ORDER BY S_Name;
EOF;
						$ret = pg_query($db, $sql);
						if(!$ret) {
							echo pg_last_error($db);
							exit;
						}
						while($row = pg_fetch_row($ret)) {
							echo
							'<tr>',
								'<td>', $row[1], '</td>',
							'</tr>';
						}
?>						</table>
					</div>
				</div>
			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container clearfix">

					<div class="col_half">
						Copyrights &copy; 2019 All Rights Reserved by Schwan's Inc.<br>
					</div>

					<div class="col_half col_last tright">
						<div class="clear"></div>
						<i class="icon-envelope2"></i> fakemail@domain.com <span class="middot">&middot;</span> <i class="icon-phone"></i> 0118-999-881-999-119-725-3
					</div>
				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

	<script>

	</script>

</body>
</html>
