<?php
	function transferEmployee() {
		$host        = "host = 127.0.0.1";
		$port        = "port = 5432";
		$dbname      = "dbname = delivery";
		$credentials = "user = delivery password=frozen";

		$db = pg_connect( "$host $port $dbname $credentials");
		$sid = $_POST['template-contactform-default-select'];
		$wid = $_POST['template-contactform-default-selector'];
		$pid = $_POST['template-contactform-default-selected'];
		$qty = $_POST['template-contactform'];

		$sql = "SELECT max(Order_ID) FROM purchase_order";
		$ret = pg_query($db, $sql);

		while ($row = pg_fetch_row($ret)) {
			$maxId = $row[0];
			break;
		}
		$maxId++;
		$query = "INSERT INTO purchase_order (Order_ID, Date_Submitted, S_ID) VALUES ('$maxId', CURRENT_DATE, '$sid')";
		pg_query($db, $query);
		$query = "INSERT INTO supplies (Order_ID, Ware_ID, Product_ID, Quantity, Sup_Date)
			VALUES ('$maxId', '$wid', '$pid', '$qty', NULL)";
		$sql = "Update supplies SET Quantity = '$quan' WHERE Order_ID = '$oid' AND Sup_Date IS NULL";
		pg_query($db, $sql);

		header('Location: suppList.php'); exit();
	}

	if(isset($_POST['template-contactform-submit'])) {
		updateOrder();
	}
?>

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
	<!-- Bootstrap File Upload CSS -->
	<link rel="stylesheet" href="css/components/bs-filestyle.css" type="text/css" />
	<link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />
	<!-- Bootstrap Select CSS -->
	<link rel="stylesheet" href="css/components/bs-select.css" type="text/css" />
	<!-- Date & Time Picker CSS -->
	<link rel="stylesheet" href="css/components/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="css/components/timepicker.css" type="text/css" />

	<!-- Range Slider CSS -->
	<link rel="stylesheet" href="css/components/ion.rangeslider.css" type="text/css" />

	<!-- Star Rating CSS -->
	<link rel="stylesheet" href="css/components/bs-rating.css" type="text/css" />

	<!-- Bootstrap Switch CSS -->
	<link rel="stylesheet" href="css/components/bs-switches.css" type="text/css" />

	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Schwan's | New Order</title>

	<style>
		.file-caption.icon-visible .file-caption-name {
			font-family: 'Lato', sans-serif;
			color: #666;
		}
	.form-process {
		position: absolute;
		-webkit-transition: all .3s ease;
		-o-transition: all .3s ease;
		transition: all .3s ease;
		background-image: none;
	}

	.form-process > div { background-color: #999;  }

	.form-process,
	#template-contactform-submitted,
	.template-contactform-complete .form-process {
		display: none;
		opacity: 0;
		background-color: rgba(255,255,255,0.7);
	}

	.template-contactform-processing .form-process {
		display: block;
		opacity: 1;
	}
	</style>

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
							<li><a href="suppliers.php"><div>Suppliers</div></a>
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
							<li class="current"><a href="purchOrder.php"><div>Purchase Orders</div></a>
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
				<h1>Create New Order</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item"><a href="purchOrder.php">Purchase Orders</a></li>
					<li class="breadcrumb-item active" aria-current="page">New Order</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap bg-light">

				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10">
							<div class="card shadow-sm">
								<div class="card-header">
									<h4 class="mb-0">Create Order</h4>
								</div>
								<div class="card-body">

									<div class="form-widget">

										<div class="form-result"></div>

										<div class="form-process css3-spinner">
											<div class="css3-spinner-double-bounce1"></div>
											<div class="css3-spinner-double-bounce2"></div>
										</div>

										<form class="nobottommargin" id="template-contactform" name="template-contactform" action="include/form.php" method="post" enctype="multipart/form-data">

											<div class="row">

												<div class="col-12 bottommargin-sm">
													<label for="template-contactform-default-select">Select Supplier:<small class="text-danger">*</small></label>
													<select id="template-contactform-default-select" name="template-contactform-default-select" class="form-control">
														<option value="" disabled selected>Select One</option>
<?php													$host        = "host = 127.0.0.1";
														$port        = "port = 5432";
														$dbname      = "dbname = delivery";
														$credentials = "user = delivery password=frozen";

														$db = pg_connect( "$host $port $dbname $credentials"  );
														$sql ="SELECT * FROM supplier ORDER BY S_Name";
														$ret = pg_query($db, $sql);
														if(!$ret) {
															echo pg_last_error($db);
															exit;
														}
														while($row = pg_fetch_row($ret)) {
															echo
															'<option value = "', $row[0], '">',
																$row[1], '</option>';
														}
?>													</select>
												</div>

												<div class="col-12 bottommargin-sm">
													<label for="template-contactform-default-selector">Select Warehouse<small class="text-danger">*</small></label>
													<select id="template-contactform-default-selector" name="template-contactform-default-selector" class="form-control">
														<option value="" disabled selected>Select One</option>
<?php													$host        = "host = 127.0.0.1";
														$port        = "port = 5432";
														$dbname      = "dbname = delivery";
														$credentials = "user = delivery password=frozen";

														$db = pg_connect( "$host $port $dbname $credentials"  );
														$sql ="SELECT w.Ware_ID, a.City_Name || ' Warehouse' FROM warehouse w INNER JOIN address a ON w.Address_ID = a.Address_ID ORDER BY a.City_Name";
														$ret = pg_query($db, $sql);
														if(!$ret) {
															echo pg_last_error($db);
															exit;
														}
														while($row = pg_fetch_row($ret)) {
															echo
															'<option value = "', $row[0], '">',
																$row[1], '</option>';
														}
?>													</select>
												</div>

												<div class="col-12 bottommargin-sm">
													<label for="template-contactform-default-selected">Select Product:<small class="text-danger">*</small></label>
													<select id="template-contactform-default-selected" name="template-contactform-default-selected" class="form-control">
														<option value="" disabled selected>Select One</option>
<?php													$host        = "host = 127.0.0.1";
														$port        = "port = 5432";
														$dbname      = "dbname = delivery";
														$credentials = "user = delivery password=frozen";

														$db = pg_connect( "$host $port $dbname $credentials"  );
														$sql ="SELECT Product_ID, Product_Name FROM products ORDER BY Product_Name";
														$ret = pg_query($db, $sql);
														if(!$ret) {
															echo pg_last_error($db);
															exit;
														}
														while($row = pg_fetch_row($ret)) {
															echo
															'<option value = "', $row[0], '">',
																$row[1], '</option>';
														}
?>													</select>
												</div>

												<div class="col-12 bottommargin-sm">
													<label for="template-contactform">Enter Quantity:</label>
													<input type="text" id="template-contactform" name="template-contactform" value="" class="form-control" placeholder="Enter New Value" />
												</div>

												<div class="col-12">
													<button type="submit" name="template-contactform-submit" class="btn btn-secondary btn-block btn-lg">Order</button>
												</div>

										</form>
									</div>
								</div>
							</div>
						</div>
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

</body>
</html>
