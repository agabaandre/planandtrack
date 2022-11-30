<?php session_start();
include('header.php');
if (!isset($_SESSION['user_id'])) {
?>
  <script type="text/javascript" language="javascript">
    window.location = "index.php";
  </script>
<?php
}
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
include('connect.php');
?>
<body>
<!--wrapper-->
<div class="wrapper">
<!--sidebar wrapper -->
	<?php
          
          include('top_header.php');
          
          
          ?>
		<!--end header -->
		<!--navigation-->
		<div class="nav-container primary-menu">
			<div class="mobile-topbar-header">
				<div>
					<img src="images/africacdc_2.jpeg" class="logo-icon" alt="logo icon" >
				</div>
				
				
			</div>
			<?php include("sidebar.php"); ?>
		</div>
<div class="page-wrapper">
<div class="page-content">
<div class="row">
	<div class="col-md-12">
		<div class="card card-default">
			<div class="card-header">
				<div class="row">
					<div class="col-md-8">
						<h6><b>Settings </b></h6>
					</div>
					<div class="col-md-4">
						
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">


					<div class="col-6 col-lg-3">
	<a href="office.php">
<div class="card bg-gradient-moonlit rounded-4 border border-4 border-white shadow overflow-hidden">
<div class="card-body">
<div class="d-flex align-items-center justify-content-between">
<div class="">
<h6 class="mb-0 text-white">Offices</h6>
</div>
<div class="widgets-icons rounded-circle bg-gradient-danger text-white">
<i class='bx bx-user'></i>
</div>
</div>
</div>
</div>
</a>
</div>




<div class="col-6 col-lg-3">
	<a href="categories.php">
<div class="card bg-gradient-moonlit rounded-4 border border-4 border-white shadow overflow-hidden">
<div class="card-body">
<div class="d-flex align-items-center justify-content-between">
<div class="">
<h6 class="mb-0 text-white">Categories</h6>
</div>
<div class="widgets-icons rounded-circle bg-gradient-danger text-white">
<i class='bx bx-user'></i>
</div>
</div>
</div>
</div>
</a>
</div>





<div class="col-6 col-lg-3">
	<a href="users.php">
<div class="card bg-gradient-moonlit rounded-4 border border-4 border-white shadow overflow-hidden">
<div class="card-body">
<div class="d-flex align-items-center justify-content-between">
<div class="">
<h6 class="mb-0 text-white">Users</h6>
</div>
<div class="widgets-icons rounded-circle bg-gradient-danger text-white">
<i class='bx bx-user'></i>
</div>
</div>
</div>
</div>
</a>
</div>


<div class="col-6 col-lg-3">
		<a href="staff.php">
<div class="card bg-gradient-moonlit rounded-4 border border-4 border-white shadow overflow-hidden">
<div class="card-body">
<div class="d-flex align-items-center justify-content-between">
<div class="">
<h6 class="mb-0 text-white">Staff</h6>
</div>
<div class="widgets-icons rounded-circle bg-gradient-danger text-white">
<i class='bx bx-group'></i>
</div>
</div>
</div>
</div>
</a>
</div>


<div class="col-6 col-lg-3">
	<a href="divisions.php">
<div class="card bg-gradient-moonlit rounded-4 border border-4 border-white shadow overflow-hidden">
<div class="card-body">
<div class="d-flex align-items-center justify-content-between">
<div class="">
<h6 class="mb-0 text-white">Divisions</h6>
</div>
<div class="widgets-icons rounded-circle bg-gradient-danger text-white">
<i class='bx bx-building'></i>
</div>
</div>
</div>
</div>
</a>
</div>


<div class="col-6 col-lg-3">
<div class="card bg-gradient-moonlit rounded-4 border border-4 border-white shadow overflow-hidden">
<div class="card-body">
<div class="d-flex align-items-center justify-content-between">
<div class="">
<h6 class="mb-0 text-white">Member State</h6>
</div>
<div class="widgets-icons rounded-circle bg-gradient-danger text-white">
<i class='bx bx-group'></i>
</div>
</div>
</div>
</div>
</div>





</div>





<!--end wrapper-->
<?php include'footer.php';?>
</body>
</html>