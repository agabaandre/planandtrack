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
$date_today = date("Y-m-d");
if (!isset($_GET['type_id'])) {
  $expenditure_id = $_SESSION['expenditure_id'];
  $activity = $_SESSION['activity'];
  $member_state = $_SESSION['member_state'];
  $proposed_start_date = $_SESSION['proposed_start_date'];
  $proposed_end_date = $_SESSION['proposed_end_date'];
  $estimated_cost = $_SESSION['estimated_cost'];
} else {
  $icon = $_GET['type_id'];
  $values = explode(",", $icon);
  $expenditure_id = $values[0];
  $_SESSION['expenditure_id'] = $expenditure_id;
  $activity = $values[1];
  $_SESSION['activity'] = $activity;
  $member_state = $values[2];
  $_SESSION['member_state'] = $member_state;
  $proposed_start_date = $values[3];
  $_SESSION['proposed_start_date'] = $proposed_start_date;
  $proposed_end_date = $values[4];
  $_SESSION['proposed_end_date'] = $proposed_end_date;
  $estimated_cost = $values[5];
  $_SESSION['estimated_cost'] = $estimated_cost;
}
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
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
			 <div class="row">
          <div class="col-12">
           
				<div class="card">
          <div class="card">
              
              <div class="col-lg-12">
							<div class="border border-3 p-4 rounded">
                              <div class="row g-3">
								<div class="col-md-6">
									<label for="inputPrice" class="form-label">Price</label>
									<input type="email" class="form-control" id="inputPrice" placeholder="00.00">
								  </div>
								  <div class="col-md-6">
									<label for="inputCompareatprice" class="form-label">Compare at Price</label>
									<input type="password" class="form-control" id="inputCompareatprice" placeholder="00.00">
								  </div>
								  <div class="col-md-6">
									<label for="inputCostPerPrice" class="form-label">Cost Per Price</label>
									<input type="email" class="form-control" id="inputCostPerPrice" placeholder="00.00">
								  </div>
								  <div class="col-md-6">
									<label for="inputStarPoints" class="form-label">Star Points</label>
									<input type="password" class="form-control" id="inputStarPoints" placeholder="00.00">
								  </div>
								  <div class="col-12">
									<label for="inputProductType" class="form-label">Product Type</label>
									<select class="form-select" id="inputProductType">
										<option></option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									  </select>
								  </div>
								  <div class="col-12">
									<label for="inputVendor" class="form-label">Vendor</label>
									<select class="form-select" id="inputVendor">
										<option></option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									  </select>
								  </div>
								  <div class="col-12">
									<label for="inputCollection" class="form-label">Collection</label>
									<select class="form-select" id="inputCollection">
										<option></option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									  </select>
								  </div>
								  <div class="col-12">
									<label for="inputProductTags" class="form-label">Product Tags</label>
									<input type="text" class="form-control" id="inputProductTags" placeholder="Enter Product Tags">
								  </div>
								  <div class="col-12">
									  <div class="d-grid">
                                         <button type="button" class="btn btn-primary">Save Product</button>
									  </div>
								  </div>
							  </div> 
						  </div>
						  </div>
                <div class="card-header">

                  
                  <div class="modal fade" id="registerstudents" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="registerstudents">Staff Details</h4>
                        </div>
                        <div class="modal-body">
                          <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="col-md-12">
              <div class="ibox">
                  <div class="ibox-body">
                      <div class="form-group">
                          <label class="col-sm-4 col-form-label">Title *</label>
                          <div class="col-sm-12">
                            <input class="form-control" type="text" name="title" required="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 col-form-label">Firstname</label>
                          <div class="col-sm-12">
                              <input class="form-control" type="text" name="fname">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 col-form-label">Othername</label>
                          <div class="col-sm-12">
                              <input class="form-control" type="text" name="oname">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-4 col-form-label">Surname</label>
                          <div class="col-sm-12">
                              <input class="form-control" type="text" name="lname">
                          </div>
                      </div>
                       </div>
                         </div>
                      
                
          <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                      <div align="right">
                          <button type="submit" name="Save" class="btn btn-success ">Save </button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
                          <?php
                          if (isset($_POST['Save'])) {
                            $title = $_POST['title'];
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $oname = $_POST['oname'];
                            $result12 = mysqli_query($mysqli, "SELECT * FROM staff WHERE title='" . $title . "' AND fname='" . $fname . "' AND lname='" . $lname . "' AND  oname='" . $oname . "'   ");
                            $num = mysqli_num_rows($result12);
                            if ($num > 0) {
                          ?>
                              <script language="javascript" type="text/javascript">
                                alert("Staff Already Existis");
                                window.location = "staff.php";
                              </script>
                            <?php
                            } else {
                              $SQL = mysqli_query($mysqli, "INSERT INTO staff (`title`,`fname`,`lname`,`oname`) VALUES ('$title','$fname','$lname','$oname' )");
                            ?>
                              <script type="text/javascript" language="javascript">
                                window.location = "staff_travelling.php";
                              </script>
                          <?php
                            }
                          }
                          ?>
                        </div>
                        <form class="registerForm" name="frmSample" method="post" autocomplete="off">
                          <div class='modal-footer'>
                           <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                        <div class="col-sm-6">
                          <label class="col-sm-2 col-form-label">Staff</label>
                          <select class="form-control select2bs4" style="width: 100%;" name="staff_id" required="">
                            <option value="">Select Staff </option>
                            <?php
                            $sql10 = "SELECT * FROM  staff ORDER BY lname";
                            $result10 = mysqli_query($mysqli, $sql10);
                            while ($row10 = mysqli_fetch_assoc($result10)) {
                              $staffname = $row10['title'] . ' ' . $row10['lname'] . ' ' . $row10['fname'] . ' ' . $row10['oname'];
                            ?>
                              <option value="<?php echo $row10['staff_id']; ?>"><?php echo $staffname; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-4">
                        <br>
                          <div class="form-group">
                            <button type="submit" name="Add" class="btn btn-success">Add Staff to Activity/Mission</button>
                          </div>
                        </div>
                      </div>
                      </form>
                      <?php
                      if (isset($_POST['Add'])) {
                        $staff_id = $_POST['staff_id'];
                        $SQL6 = mysqli_query($mysqli, "SELECT * FROM travellers WHERE staff_id=$staff_id AND expenditure_id=$expenditure_id  ");
                        $num1 = mysqli_num_rows($SQL6);
                        if ($num1 > 0) {
                      ?>
                          <script language="javascript" type="text/javascript">
                            alert("Already Existis");
                            window.location = "staff_travelling.php";
                          </script>
                        <?php
                        } else {
                          $SQL = mysqli_query($mysqli, "INSERT INTO travellers(`staff_id`,`expenditure_id`)VALUES ('$staff_id','$expenditure_id')");
                        }
                        ?>
                       <script type="text/javascript" language="javascript">
                          window.location = "staff_travelling.php";
                        </script>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								 <thead>
                     <tr>
                          <th>#</th>
                          <th nowrap>Staff</th>
                          <th nowrap>Remove</th>
                        </tr>
                    </thead>
								<tbody>
									  <?php
                        $result56 = mysqli_query($mysqli, "SELECT * FROM travellers t, staff s WHERE t.staff_id=s.staff_id AND expenditure_id=$expenditure_id");
                        $count = 1;
                        while ($row56 = mysqli_fetch_assoc($result56)) {
                          $staffname = $row56['title'] . ' ' . $row56['lname'] . ' ' . $row56['fname'] . ' ' . $row56['oname'];
                          echo "<tr>";
                          echo "<td>" . $count . "</td>";
                          echo "<td>" . $staffname . "</td>";
                          echo "<td>";
                          $count++;
echo '<a  class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_item'.$row56['traveller_id'].'">Remove</a>';
echo '<div class="modal fade" id="delete_item' . $row56['traveller_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" >
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="delete_item' . $row56['traveller_id'] . 'Label">Remove Staff </h5>
</div>
<div class="modal-body">';
                        ?>
                          <form method="post" name="contact" class="registerForm" autocomplete="">
                            <table width="70%" class="table table-hover table-condensed">
                              <tbody>
                                <tr>
                                  <!--<td>User Id </td>-->
                                  <input type="hidden" name="traveller_id" value="<?php echo $row56['traveller_id']; ?>">
                                </tr>
                                <tr>
                                  <td> Staff</td>
                                  <td>
                                    <div class="form-group"><input type="text" class="form-control" value="<?php echo $staffname; ?>" name="staff_id" id="item_name" readonly></div>
                                  </td>
                                </tr>
                                <td>&nbsp;</td>
                                <td><button class="btn btn-danger" type="submit" name="delete">Remove</button>
                                  <!--<button class="btn btn-danger" type="reset">Reset</button>-->
                                </td>
                                </tr>
                              </tbody>
                            </table>
                            <?php
                            if (isset($_POST['delete'])) {
                              $traveller_id = $_POST['traveller_id'];
                              $SQL = mysqli_query($mysqli, "DELETE FROM travellers WHERE traveller_id=$traveller_id ");
                            ?>
                              <script type="text/javascript" language="javascript">
                                window.location = "staff_travelling.php";
                              </script>
                            <?php
                            }
                            ?>
                          </form>
                          <?php echo  '</div>'; ?>
                          <div class='modal-footer'>
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                          </div>
                          <?php echo  '</div>'; ?>
                          <?php echo  '</div>'; ?>
                          <?php echo  '</div>';
                          echo  "</td>"; ?>
                        <?php echo  "</tr>";
                        } ?>


								</tbody>
                                        <tr><td></td><td></td><td><button class="btn btn-success" onClick="window.location.href='expenditures.php'" > Done</button></td></tr>
							</table>
              
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<?php  include'footer.php'; ?>
	
</body>

</html>