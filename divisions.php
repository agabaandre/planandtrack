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
			<div class="col-md-12">
				<?php //include'../controllers/add_users.php';?>
				<div class="card card-default">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4">
								<h6><b>Divisions</b></h6>
							</div>

							<div class="col-md-8">
								<?php 
									echo '<h6 style="float: right;">
							<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_item">+ New Division</button>
						</h6>'?>
						<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="add_item">Division</h4>
                                        </div>
                                        <div class="modal-body">
                                             <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="col-md-9">
                          <div class="ibox">
                            <div class="ibox-body">
                              <div class="form-group">
                                <label class="col-sm-4 col-form-label"> Name *</label>
                                <div class="col-sm-12">
                                  <input class="form-control" type="text" name="division" required="">
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <div align="right">
                                <button type="submit" name="Save" class="btn btn-success btn-lg">Save </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                        <?php
                      if (isset($_POST['Save'])) {
                        $division = $_POST['division'];
                        $result12 = mysqli_query($mysqli, "SELECT * FROM divisions WHERE division='" . $division . "' ");
                        $num = mysqli_num_rows($result12);
                        if ($num > 0) {
                      ?>
                          <script language="javascript" type="text/javascript">
                            alert("Division Already Existis");
                            window.location = "divisions.php";
                          </script>
                        <?php
                        } else {
                          $SQL = mysqli_query($mysqli, "INSERT INTO divisions (`division`) VALUES ('$division' )");
                        ?>
                          <script type="text/javascript" language="javascript">
                            window.location = "divisions.php";
                          </script>
                      <?php
                        }
                      }
                      ?>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
						
					
					
					<div class="card">
				<div class="card-body">
				
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								 <thead>
                                             <tr>
                     <th>#</th>
                        <th> Name</th>
                        <th>Edit</th>
                        <th>Units</th>
                        <th>Fund Centres</th>
                  </tr>
                                        </thead>
								<tbody>
									 <?php
                       $result = mysqli_query($mysqli, "SELECT * FROM divisions ");
                      $counter = mysqli_num_rows($result);
                      $count = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $row['division'] . "</td>";
                   
                                                echo "<td>";
                                                $count++;
                                                echo '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['division_id'].'">Edit</a>';
                                                echo '<div class="modal fade" id="edit_user' . $row['division_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" >
                                    <div class="modal-content">
                                    <div class="modal-header"  style="background-color: #FFFFFF;color:#fff">
                                    <h5 class="modal-title" id="edit_user' . $row['division_id'] . 'Label">Edit  Division  </h5>
                                    </div>
                                    <div class="modal-body">';
                                            ?>
                                                 <form method="post" name="contact" class="registerForm">
                        <table width="70%" class="table table-hover table-condensed">
                          <tbody>
                            <tr>
                              <!--<td>User Id </td>-->
                              <input type="hidden" name="division_id1" value="<?php echo $row['division_id']; ?>">
                            </tr>
                            <tr>
                              <td>Title</td>
                              <td>
                                <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['division']; ?>" name="division"></div>
                              </td>
                            </tr>
                           
                            <tr>
                              <td>&nbsp;</td>
                              <td>
                                  
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="float: left;">Cancel</button>
                                            
                                                <button type="submit" name="Edit" class="btn btn-success" style="float: right;">Save </button>
                                
                              </td>
                            </tr>
                          </tbody>
                        </table>
                       <?php
                          if (isset($_POST['Edit'])) {
                            $division = $_POST['division'];
                            $division_id1 = $_POST['division_id1'];
                            $SQL = mysqli_query($mysqli, "UPDATE  divisions SET division='$division' WHERE division_id=$division_id1");
                          ?>
                            <script type="text/javascript" language="javascript">
                              window.location = "divisions.php";
                            </script>
                          <?php
                          }
                          ?>
                      </form>
                      <?php echo  '</div>'; ?>
                     
                      <?php echo  '</div>'; ?>
                      <?php echo  '</div>'; ?>
                      <?php echo  '</div>';  ?>
                      <?php echo  "</td>"; 

                      echo '<td><a class="btn btn-success  btn-sm" href="units.php?type_id=' . $row['division_id'] . ',' . $row['division'] . '"> Units</a></td>';
                        echo '<td><a class="btn btn-success  btn-sm" href="fund_centres.php?type_id=' . $row['division_id'] . ',' . $row['division'] . '"> Fund Centres</a></td>';

                      ?>
                    <?php echo  "</tr>";
                    } ?>
								</tbody>
								</table>
							
						</div>
			</div>
		<!--end page wrapper -->
		
		<?php include'footer.php'; ?>
</body>

</html>