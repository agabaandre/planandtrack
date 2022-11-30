<?php
session_start();
include 'header.php';
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
			<div class="col-md-6">
				<div class="card card-default">
					<div class="card-header">
						<div class="row">
							<div class="col-md-8">
								<h6><b>Change Password</b></h6>
							</div>

							
						</div>
						</div>
						
					
					<div class="card">
				<div class="card-body">
				
      <div class="modal-body">
        <div class="card">
              <div class="card-body">
               <form  method="Post" autocomplete="off">
                  <div class="mb-3">
                    <label class="form-label">Password:<span style="color:red">*</span></label>
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required="" >
                  </div>

                   
                  

                  <div class="mb-3">
                   <button type="Submit" name="Submit"  class="btn btn-success">Save</button>
                    </div>
                  
                </form>
              </div>
            </div>
      </div>



<?php 
if(isset($_POST['Submit'])){
  $password = md5($_POST['password']);
 
  $result12 = mysqli_query($mysqli,"UPDATE users SET password='$password' WHERE user_id='$user_id'");
 
    

    ?>
<div class="alert alert-success border-0 bg-success alert-dismissible fade show">
<div class="text-white">Password Successfully Changed</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <!--<script type="text/javascript" language="javascript">
      window.location="<?php  //echo $page_link.'?page='.$page_id ?>";
    </script>-->
    <?php
  
}
?> 
			</div>
		<!--end page wrapper -->
		
		<?php include'footer.php'; ?>
</body>

</html>