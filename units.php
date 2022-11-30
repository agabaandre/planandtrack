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
if (!isset($_GET['type_id'])) {
  $division_id = $_SESSION['division_id'];
  $division = $_SESSION['division'];
} else {
  $icon = $_GET['type_id'];
  $values = explode(",", $icon);
  $division_id = $values[0];
  $_SESSION['division_id'] = $division_id;
  $division = $values[1];
  $_SESSION['division'] = $division;
}
include('connect.php');
$sql11 = " SELECT * FROM units WHERE division_id=$division_id";
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
								<h6><b><?php echo 'Units Under' . ' ' . $division; ?></b></h6>
							</div>

							<div class="col-md-8">
								<?php 
									echo '<h6 style="float: right;">
							<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_item">+ New Unit</button>
						</h6>'?>
						<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="add_item">Unit</h4>
                                        </div>
                                        <div class="modal-body">
                                             <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="col-md-9">
                          <div class="ibox">
                            <div class="ibox-body">
                              <div class="form-group">
                                <label class="col-sm-4 col-form-label"> Unit *</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" name="unit" required="">
                                </div>
                              </div>

                               <div class="form-group">
                                <label class="col-sm-4 col-form-label"> Description *</label>
                                <div class="col-sm-12">
                                 <input type="text" class="form-control" name="description" required="">
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                         <br>
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="float: left;">Cancel</button>
                                            
                                                <button type="submit" name="Save" class="btn btn-success" style="float: right;">Save </button>
                            </div>
                          </div>
                        </div>
                      </form>
                        <?php
                          if (isset($_POST['Save'])) {
                            $unit = $_POST['unit'];
                            $description = $_POST['description'];
                            $result12 = mysqli_query($mysqli, "SELECT * FROM units WHERE unit='" . $unit . "' AND division_id=$division_id ");
                            $num = mysqli_num_rows($result12);
                            if ($num > 0) {
                          ?>
                              <script language="javascript" type="text/javascript">
                                alert("Unit Already Existis");
                                window.location = "units.php";
                              </script>
                            <?php
                            } else {
                              $SQL = mysqli_query($mysqli, "INSERT INTO units (`division_id`,`unit`,`description`) VALUES ('$division_id','$unit','$description')");
                            ?>
                              <script type="text/javascript" language="javascript">
                                window.location = "units.php";
                              </script>
                          <?php
                            }
                          }
                          ?>
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
                        <th>Unit</th>
                        <th>Description</th>
                        <th>Edit</th>
                  </tr>
                                        </thead>
								<tbody>
									 <?php
                       $result = mysqli_query($mysqli, "SELECT * FROM units WHERE division_id=$division_id ");
                      $counter = mysqli_num_rows($result);
                      $count = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $row['unit'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                   
                                                echo "<td>";
                                                $count++;
                                                echo '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['unit_id'].'">Edit</a>';
                                                echo '<div class="modal fade" id="edit_user' . $row['unit_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" >
                                    <div class="modal-content">
                                    <div class="modal-header"  style="background-color: #FFFFFF;color:#fff">
                                    <h5 class="modal-title" id="edit_user' . $row['unit_id'] . 'Label">Edit Divison Details  </h5>
                                    </div>
                                    <div class="modal-body">';
                                            ?>
                                                <form method="post" class="registerForm">
                          <table width="80%" class="table table-hover table-condensed" border="0">
                            <tbody>
                              <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="unit_id1" value="<?php echo $row['unit_id']; ?>">
                              </tr>
                              <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="old_unit" value="<?php echo $row['unit']; ?>">
                              </tr>
                              <tr>
                                <td style="width: 20%;">Unit</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="text" class="form-control" name="unit" required="" value="<?php echo $row['unit']; ?>"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">Description</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="text" class="form-control" name="description" value="<?php echo $row['description']; ?>"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;"><button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="float: left;">Cancel</button></td>
                                <td style="width: 24.7445%;">
                                            
                                                <button type="submit" name="Edit" class="btn btn-success" style="float: right;">Save </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </form>
                        <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                        <?php
                        if (isset($_POST['Edit'])) {
                          $unit_id1 = $_POST['unit_id1'];
                          $unit = $_POST['unit'];
                          $description = $_POST['description'];
                          $old_unit = $_POST['old_unit'];
                          $result12 = mysqli_query($mysqli, "SELECT * FROM units WHERE unit='" . $unit . "' AND division_id=$division_id ");
                          $num = mysqli_num_rows($result12);
                          if ($num > 0 && ($unit != $old_unit)) {
                        ?>
                            <script language="javascript" type="text/javascript">
                              alert("Unit Already Existis");
                              window.location = "units.php";
                            </script>
                          <?php
                          } else {
                            $SQL = mysqli_query($mysqli, "UPDATE  units SET unit='$unit',description='$description' WHERE unit_id=$unit_id1");
                          ?>
                            <script type="text/javascript" language="javascript">
                              window.location = "units.php";
                            </script>
                        <?php
                          }
                        }
                        ?>
                        <?php echo  '</div>'; ?>
                       
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>';  ?>
                      <?php echo "</td>";
                        echo  '</tr>';
                      }
                      ?>
								</tbody>
								</table>
							
						</div>
			</div>
		<!--end page wrapper -->
		
		<?php include'footer.php'; ?>
</body>

</html>