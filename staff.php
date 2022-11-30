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
								<h6><b>Staff</b></h6>
							</div>

							<div class="col-md-8">
								<?php 
									echo '<h6 style="float: right;">
							<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_item">+ New Staff</button>
						</h6>'?>
						<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="add_item">Staff Details</h4>
                                        </div>
                                        <div class="modal-body">
                                             <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="col-md-9">
                          <div class="ibox">
                            <div class="ibox-body">
                              <div class="form-group">
                                <label class="col-sm-4 col-form-label"> Title *</label>
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
                        </div>
                        <div class="row">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <div align="right">
                                <button type="submit" name="Submit" class="btn btn-success btn-lg">Save </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                                             <?php
                      if (isset($_POST['Submit'])) {
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
                            window.location = "staff.php";
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
                      <th>Title</th>
                      <th>Firstname</th>
                      <th>Othername</th>
                      <th>Surname</th>
                      <th>Action</th>
                  </tr>
                                        </thead>
								<tbody>
									 <?php
                                           $result = mysqli_query($mysqli, "SELECT  * FROM staff");
                    $counter = mysqli_num_rows($result);
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $count . "</td>";
                      echo "<td>" . $row['title'] . "</td>";
                      echo "<td>" . $row['fname'] . "</td>";
                      echo "<td>" . $row['oname'] . "</td>";
                      echo "<td>" . $row['lname'] . "</td>";
                   
                                                echo "<td>";
                                                $count++;
                                                echo '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['staff_id'].'">Edit</a>';
                                                echo '<div class="modal fade" id="edit_user' . $row['staff_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" >
                                    <div class="modal-content">
                                    <div class="modal-header"  style="background-color: #629aa9;color:#fff">
                                    <h5 class="modal-title" id="edit_user' . $row['staff_id'] . 'Label">Edit Staff Details  For : ' .$row['fname']. ' </h5>
                                    </div>
                                    <div class="modal-body">';
                                            ?>
                                                 <form method="post" name="contact" class="registerForm">
                        <table width="70%" class="table table-hover table-condensed">
                          <tbody>
                            <tr>
                              <!--<td>User Id </td>-->
                              <input type="hidden" name="staff_id1" value="<?php echo $row['staff_id']; ?>">
                            </tr>
                            <tr>
                              <td>Title</td>
                              <td>
                                <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['title']; ?>" name="title"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>Firstname</td>
                              <td>
                                <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['fname']; ?>" name="fname" id="full_name"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>Othername</td>
                              <td>
                                <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['oname']; ?>" name="oname"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>Surname</td>
                              <td>
                                <div class="form-group" style="height: 2em"><input type="text" class="form-control" value="<?php echo $row['lname']; ?>" name="lname"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><button class="btn btn-success btn-lg" type="submit" name="Edit">Save</button>
                                <!--<button class="btn btn-danger" type="reset">Reset</button>-->
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <?php
                        if (isset($_POST['Edit'])) {
                          $staff_id1 = $_POST['staff_id1'];
                          $title = $_POST['title'];
                          $fname = $_POST['fname'];
                          $lname = $_POST['lname'];
                          $oname = $_POST['oname'];
                          $SQL = mysqli_query($mysqli, "UPDATE  staff SET title='$title',fname='$fname',lname='$lname',oname='$oname' WHERE staff_id=$staff_id1");
                        ?>
                          <script type="text/javascript" language="javascript">
                            window.location = "staff.php";
                          </script>
                        <?php
                        }
                        ?>
                      </form>
                      <?php echo  '</div>'; ?>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                      </div>
                      <?php echo  '</div>'; ?>
                      <?php echo  '</div>'; ?>
                      <?php echo  '</div>';  ?>
                      <?php echo  "</td>"; ?>
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