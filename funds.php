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
$sql = " SELECT * FROM funds WHERE division_id=$division_id";
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
								<h6><b><?php echo 'Funds Under' . ' ' . $division; ?></b></h6>
							</div>

							<div class="col-md-8">
								<?php 
									echo '<h6 style="float: right;">
							<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_item">+ New Fund</button>
						</h6>'?>
						<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="add_item">Fund</h4>
                                        </div>
                                        <div class="modal-body">
                                             <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="col-md-9">
                          <div class="ibox">
                            <div class="ibox-body">
                              <div class="form-group">
                                <label class="col-sm-4 col-form-label"> Fund *</label>
                                <div class="col-sm-12">
                                  <input class="form-control" type="text" name="fund" required="">
                                </div>
                              </div>

                               <div class="form-group">
                                <label class="col-sm-4 col-form-label"> Description *</label>
                                <div class="col-sm-12">
                                  <input class="form-control" type="text" name="fund_description">
                                </div>
                              </div>
                              
                            </div>
                         
                            <div class="form-group">
                              <div align="right">
                                <button type="submit" name="Save" class="btn btn-success">Save </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                         <?php
                      if (isset($_POST['Save'])) {
                        $fund = $_POST['fund'];
                        $fund_description = $_POST['fund_description'];
                        $result12 = mysqli_query($mysqli, "SELECT * FROM funds WHERE fund='" . $fund . "' AND division_id=$division_id ");
                        $num = mysqli_num_rows($result12);
                        if ($num > 0) {
                      ?>
                          <script language="javascript" type="text/javascript">
                            alert("Fund Already Existis");
                            window.location = "funds.php";
                          </script>
                        <?php
                        } else {
                          $SQL = mysqli_query($mysqli, "INSERT INTO funds (`division_id`,`fund`,`fund_description`) VALUES ('$division_id','$fund','$fund_description' )");
                        ?>
                          <script type="text/javascript" language="javascript">
                            window.location = "funds.php";
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
                        <th>Fund</th>
                        <th>Fund Description</th>
                        <th>Edit</th>
                  </tr>
                                        </thead>
								<tbody>
									 <?php
                       $result = mysqli_query($mysqli, $sql);
                      $counter = mysqli_num_rows($result);
                      $count = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $row['fund'] . "</td>";
                        echo "<td>" . $row['fund_description'] . "</td>";
                   
                                                echo "<td>";
                                                $count++;
                                                echo '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['fund_id'].'">Edit</a>';
                                                echo '<div class="modal fade" id="edit_user' . $row['fund_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" >
                                    <div class="modal-content">
                                    <div class="modal-header"  style="background-color: #629aa9;color:#fff">
                                    <h5 class="modal-title" id="edit_user' . $row['fund_id'] . 'Label">Edit Fund Details  </h5>
                                    </div>
                                    <div class="modal-body">';
                                            ?>
                                              <form method="post" name="contact" class="registerForm">
                          <table width="70%" class="table table-hover table-condensed">
                            <tbody>
                              <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="fund_id1" value="<?php echo $row['fund_id']; ?>">
                              </tr>
                              <tr>
                                <td>Fund</td>
                                <td>
                                  <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['fund']; ?>" name="fund"></div>
                                </td>
                              </tr>
                              <tr>
                                <td>Fund Description</td>
                                <td>
                                  <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['fund_description']; ?>" name="fund_description"></div>
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><button class="btn btn-success btn-lg" type="submit" name="Edit">Save </button>
                                  <!--<button class="btn btn-danger" type="reset">Reset</button>-->
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <?php
                          if (isset($_POST['Edit'])) {
                            $fund = $_POST['fund'];
                            $fund_description = $_POST['fund_description'];
                            $fund_id1 = $_POST['fund_id1'];
                            $SQL = mysqli_query($mysqli, "UPDATE  funds SET fund='$fund',fund_description='$fund_description' WHERE fund_id=$fund_id1");
                          ?>
                            <script type="text/javascript" language="javascript">
                              window.location = "funds.php";
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
                      <?php echo  '</div>';
                        echo  "</td>";
                        echo  "</tr>";
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