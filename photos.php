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
  $expenditure_id = $_SESSION['expenditure_id'];
  $member_state = $_SESSION['member_state'];
  $activity = $_SESSION['activity'];
  $proposed_start_date = $_SESSION['proposed_start_date'];
  $proposed_end_date = $_SESSION['proposed_end_date'];
} else {
  $icon = $_GET['type_id'];
  $values = explode(",", $icon);
  $expenditure_id = $values[0];
  $_SESSION['expenditure_id'] = $expenditure_id;
  $member_state = $values[1];
  $_SESSION['member_state'] = $member_state;
  $activity = $values[2];
  $_SESSION['activity'] = $activity;
  $proposed_start_date = $values[3];
  $_SESSION['proposed_start_date'] = $proposed_start_date;
  $proposed_end_date = $values[4];
  $_SESSION['proposed_end_date'] = $proposed_end_date;
}
include('connect.php');
$sql11 = " SELECT * FROM expenditures e,member_states ms WHERE e.member_state_id=ms.member_state_id AND expenditure_id=$expenditure_id";
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
		<!--start page wrapper -->
		  <div class="page-wrapper">
  <div class="page-content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                  <p>
                  <h6><?php echo $activity . ' : ', $member_state . ' : ' . $proposed_start_date . ' : ' . $proposed_end_date; ?></h6>
                  </p>
                </div>

                <div class="col-md-2">
                  <button type="button" class="btn btn-success btn-sm" style="float:right" data-bs-toggle="modal" data-bs-target="#upload">+ Upload Photo</button>
                </div>
              </div>
              <hr>

              <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="upload">Upload Photo</h4>
                                        </div>
                        <div class="modal-body">
                          <form method="post" name="contact" class="registerForm">
                            <div class="table-responsive">
                              <table width="80%" class="table table-hover table-condensed" border="0">
                                <tbody>
                                  <tr>
                                    <!--<td>User Id </td>-->
                                    <input type="hidden" name="expenditure_id1" value="<?php echo $row['expenditure_id']; ?>">
                                  </tr>
                                  <tr>
                                    <td style="width: 20%;">Upload Photo</td>
                                    <td style="width: 24.7445%;">
                                      <div class="form-group"><input type="file" name="newfile"></div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 24.7445%;"><button type="submit" name="Photo" class="btn btn-success btn-md">Save </button>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </form>
                          <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                          <?php
                          if (isset($_POST['Photo'])) {
                            $image = $_FILES['newfile']['name'];
                            $games_tmp = $_FILES['image']['tmp_name'];
                            echo $image;
                            $date_time = date("Y-m-d  H:i:s");
                            /*  
                     if (filesize($games_tmp) > 4000000){
                                             ?>
                                                                <script type="text/javascript" language="javascript">
                                                                  alert ("File Size cannot exceed 4MB, Please upload a smaller file");
                                                                   window.location="photos.php";
                                                                </script>
                                                       <?php
                                        }else{
                    $SQL = mysqli_query($mysqli, "INSERT INTO activity_photos (`expenditure_id`,`date_time`) VALUES ('$expenditure_id','$date_time')");
                     $SQL3=mysqli_query($mysqli,"SELECT activity_photo_id FROM activity_photos WHERE date_time = '$date_time' AND expenditure_id = $expenditure_id ");
                    $row3 = mysqli_fetch_assoc($SQL3);
                    $activity_photo_id=$row3['activity_photo_id'];
                    $games_image=activity_photo_id.'-'.$games_image; 
                    //echo $games_image;
                     move_uploaded_file($games_tmp,"photos/$games_image");  
                     $SQL4 = mysqli_query($mysqli, "UPDATE activity_photos SET `activity_photo`='$games_image' WHERE activity_photo_id='".$activity_photo_id."'");
                     $_SESSION['activity_photo_id'] =  $activity_photo_id;
                    echo "UPDATE activity_photos SET `activity_photo`='$games_image' WHERE activity_photo_id='".$activity_photo_id."'";
                ?>
                    <script type="text/javascript" language="javascript">
                       window.location="photos.php";
                    </script>
                 <?php
                    }*/
                          }
                          ?>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
          
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								 <thead>
                     <tr>
                        <th>#</th>
                        <th>Mission/Activity</th>
                        <th>Host Member State</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Participants/Travellers</th>
                        <th>Amount</th>
                        <th>Approval Memo</th>
                        <th>Report</th>
                        <th>Edit</th>
                        <th>Edit Travellers</th>
                        <th>Upload Approval Memo</th>
                        <th>Upload Report</th>
                        <th>Add Photos</th>
                      </tr>
                    </thead>
								<tbody>
									 <?php
                      $result = mysqli_query($mysqli, $sql11);
                      $count = 1;
                      $show = '';
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['expenditure_id'];
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $row['activity'] . "</td>";
                        echo "<td>" . $row['member_state'] . "</td>";
                        echo "<td>" . $row['proposed_start_date'] . "</td>";
                        echo "<td>" . $row['proposed_end_date'] . "</td>";
                        $SQL9 = mysqli_query($mysqli, "SELECT s.title,s.fname,s.lname,s.oname FROM travellers t,staff s WHERE s.staff_id=t.staff_id AND expenditure_id = '" . $id . "' ");
                        while ($row9 = mysqli_fetch_assoc($SQL9)) {
                          $show = $show . ' : ' . $row9['title'] . ' ' . $row9['fname'] . ' ' . $row9['oname'] . ' ' . $row9['lname'];
                        }
                        echo "<td>" . $show . "</td>";
                        echo "<td>" . number_format($row['amount']) . "</td>";
                        //echo "<td>".$row['file_name']."</td>";
                        echo '<td><a  href="view_approval.php?type_id=' . $row['approval'] . '">' . $row['approval'] . '</a></td>';
                        echo '<td><a  href="view.php?type_id=' . $row['file_name'] . '">' . $row['file_name'] . '</a></td>';
                        $show = '';
                        $count++;

                        echo "<td>";
 echo '<a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['expenditure_id'].'">Edit</a>';
                echo '<div class="modal fade" id="edit_user' . $row['expenditure_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
    <div class="modal-content">
    <div class="modal-header" >
    <h5 class="modal-title" id="edit_user' . $row['expenditure_id'] . 'Label">Edit  </h5>
    </div>
    <div class="modal-body">';
?>
                        <form method="post" class="registerForm">
                          <table width="80%" class="table table-hover table-condensed" border="0">
                            <tbody>
                              <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="expenditure_id1" value="<?php echo $row['expenditure_id']; ?>">
                              </tr>
                              <tr>
                                <td style="width: 20%;">Activity</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['activity']; ?>" name="activity"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">Host Member State</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group">
                                    <select class="form-control select2bs4" style="width: 100%;" name="member_state_id">
                                      <option selected value="<?php echo $row['member_state_id']; ?>"><?php echo $row['member_state']; ?></option>
                                      <?php
                                      $sql10 = "SELECT * FROM member_states ORDER BY member_state";
                                      $result10 = mysqli_query($mysqli, $sql10);
                                      while ($row10 = mysqli_fetch_assoc($result10)) {
                                      ?>
                                        <option value=<?php echo $row10['member_state_id'] . '>' . $row10['member_state']; ?></option>
                                        <?php
                                      }
                                        ?>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">Start Date</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="date" class="form-control" name="proposed_start_date" required="" value="<?php echo $row['proposed_start_date']; ?>"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">End Date</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="date" class="form-control" name="proposed_end_date" required="" value="<?php echo $row['proposed_end_date']; ?>"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">Amount</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['amount']; ?>" name="amount"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;"></td>
                                <td style="width: 24.7445%;"><button type="submit" name="Edit" class="btn btn-success btn-md">Save </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </form>
                        <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                        <?php
                        if (isset($_POST['Edit'])) {
                          $expenditure_id1 = $_POST['expenditure_id1'];
                          $activity = $_POST['activity'];
                          $amount = $_POST['amount'];
                          $amount =  intval(preg_replace('/[^\d.]/', '', $amount));
                          $proposed_start_date = $_POST['proposed_start_date'];
                          $proposed_end_date = $_POST['proposed_end_date'];
                          $member_state_id = $_POST['member_state_id'];
                          if ($proposed_start_date > $proposed_end_date) {
                        ?>
                            <script type="text/javascript" language="javascript">
                              window.alert('Start date cannot be after End Date');
                              window.location = "expenditures.php";
                            </script>
                          <?php
                          } elseif ($amount > $bal) {
                          ?>
                            <script type="text/javascript" language="javascript">
                              window.alert("Expenditure cannot be more than Balance");
                              window.location = "expenditures.php";
                            </script>
                          <?php
                          } else {
                            $SQL = mysqli_query($mysqli, "UPDATE  expenditures SET activity='$activity',member_state_id='$member_state_id',proposed_start_date='$proposed_start_date',proposed_end_date='$proposed_end_date',amount='$amount' WHERE expenditure_id=$expenditure_id1");
                          ?>
                            <script type="text/javascript" language="javascript">
                              window.location = "expenditures.php";
                            </script>
                        <?php
                          }
                        }
                        ?>
                        <?php echo  '</div>'; ?>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                        </div>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>';  ?>
                        <?php echo "</td>";
                        echo "<td>";
            
echo '<a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user2'.$row['expenditure_id'].'">Edit</a>';
echo '<div class="modal fade" id="edit_user2' . $row['expenditure_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" >
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="edit_user2' . $row['expenditure_id'] . 'Label">Edit  </h5>
</div>
<div class="modal-body">';
?>
                     
                        <form method="post" class="registerForm">
                          <table width="80%" class="table table-hover table-condensed" border="0">
                            <tbody>
                              <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="expenditure_id1" value="<?php echo $row['expenditure_id']; ?>">
                              </tr>
                              <tr>
                                <td style="width: 20%;">Participants/Travellers</td>
                                <td style="width: 80%;">
                                  <div class="form-group">
                                    <select name='subject[]' multiple size=6 required="">
                                      <?php
                                      $sql14 = "SELECT * FROM staff";
                                      $result14 = mysqli_query($mysqli, $sql14);
                                      while ($row14 = mysqli_fetch_assoc($result14)) {
                                      ?>
                                        <option value=<?php echo $row14['staff_id'] . '>' . $row14['title'] . ' ' . $row14['fname'] . ' ' . $row14['oname'] . ' ' . $row14['lname']; ?></option>
                                        <?php
                                      }
                                        ?>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;"></td>
                                <td style="width: 24.7445%;"><button type="submit" name="Edit2" class="btn btn-success btn-md">Save </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </form>
                        <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                        <?php
                        if (isset($_POST['Edit2'])) {
                          $expenditure_id1 = $_POST['expenditure_id1'];
                          $SQLDEL = mysqli_query($mysqli, "DELETE FROM travellers WHERE expenditure_id=$expenditure_id1");
                          if (isset($_POST["subject"])) {
                            // Retrieving each selected option
                            foreach ($_POST['subject'] as $subject)
                              $SQL = mysqli_query($mysqli, "INSERT INTO travellers (`expenditure_id`,`staff_id`) VALUES ('$expenditure_id1','$subject')");
                          }
                        ?>
                          <script type="text/javascript" language="javascript">
                            window.location = "expenditures.php";
                          </script>
                        <?php
                        }
                        ?>
                        <?php echo  '</div>'; ?>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                        </div>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>';  ?>
                        <?php echo "</td>";
                        echo "<td>";
                      
echo '<a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approval'.$row['expenditure_id'].'">Upload Approval</a>';
echo '<div class="modal fade" id="approval' . $row['expenditure_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" >
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="approval' . $row['expenditure_id'] . 'Label">Edit  </h5>
</div>
<div class="modal-body">';
                        ?>
                        <form method="post" class="registerForm" enctype="multipart/form-data">
                          <table width="80%" class="table table-hover table-condensed" border="0">
                            <tbody>
                              <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="expenditure_id1" value="<?php echo $row['expenditure_id']; ?>">
                              </tr>
                              <tr>
                                <td style="width: 20%;">Upload</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="file" name="newfile"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;"></td>
                                <td style="width: 24.7445%;"><button type="submit" name="Approval" class="btn btn-success btn-md">Save </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </form>
                        <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                        <?php
                        if (isset($_POST['Approval'])) {
                          $expenditure_id1 = $_POST['expenditure_id1'];
                          $approval = $row['approval'];
                          if ($approval) {
                            unlink('approval/' . $approval);
                          }
                          // name of the uploaded file
                          $approval = $_FILES['newfile']['name'];
                          $approval = $expenditure_id1 . '-' . $approval;
                          // destination of the file on the server
                          $destination = 'approval/' . $approval;
                          // get the file extension
                          $extension = pathinfo($approval, PATHINFO_EXTENSION);
                          // the physical file on a temporary uploads directory on the server
                          $file = $_FILES['newfile']['tmp_name'];
                          $size = $_FILES['newfile']['size'];
                          if (!in_array($extension, ['pdf'])) {
                            echo "You file extension must be  .pdf";
                          } /*elseif ($_FILES['newfile']['size'] > 8000000) { // file shouldn't be larger than 1Megabyte
                                                ?>
                                                    <script type="text/javascript" language="javascript">
                                                           window.alert=("File too large (Less than 8MB)");
                                                           window.location="expenditures.php";
                                                    </script>
                                                <?php
                                            }*/ else {
                            // move the uploaded (temporary) file to the specified destination
                            move_uploaded_file($file, $destination);
                            //$filename = $mou_id.'-'.$filename;
                            $sql = mysqli_query($mysqli, "UPDATE expenditures SET approval='$approval' WHERE expenditure_id = $expenditure_id1");
                          }
                        ?>
                          <script type="text/javascript" language="javascript">
                            window.location = "expenditures.php";
                          </script>
                        <?php
                        }
                        ?>
                        <?php echo  '</div>'; ?>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                        </div>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>';  ?>
                        <?php
                        echo "</td>";
                        echo "<td>";


echo '<a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reupload'.$row['expenditure_id'].'">Upload</a>';
echo '<div class="modal fade" id="reupload' . $row['expenditure_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" >
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="reupload' . $row['expenditure_id'] . 'Label">Edit  </h5>
</div>
<div class="modal-body">';
                        ?>
                        <form method="post" class="registerForm" enctype="multipart/form-data">
                          <table width="80%" class="table table-hover table-condensed" border="0">
                            <tbody>
                              <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="expenditure_id1" value="<?php echo $row['expenditure_id']; ?>">
                              </tr>
                              <tr>
                                <td style="width: 20%;">Upload</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="file" name="newfile"></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;"></td>
                                <td style="width: 24.7445%;"><button type="submit" name="Reupload" class="btn btn-success btn-md">Save </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </form>
                        <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                        <?php
                        if (isset($_POST['Reupload'])) {
                          $expenditure_id1 = $_POST['expenditure_id1'];
                          $file = $row['file_name'];
                          echo $file;
                          if ($file) {
                            unlink('reports/' . $file);
                          }
                          // name of the uploaded file
                          $filename = $_FILES['newfile']['name'];
                          $filename = $expenditure_id1 . '-' . $filename;
                          // destination of the file on the server
                          $destination = 'reports/' . $filename;
                          // get the file extension
                          $extension = pathinfo($filename, PATHINFO_EXTENSION);
                          // the physical file on a temporary uploads directory on the server
                          $file = $_FILES['newfile']['tmp_name'];
                          $size = $_FILES['newfile']['size'];
                          if (!in_array($extension, ['pdf'])) {
                            echo "You file extension must be  .pdf";
                          } /*elseif ($_FILES['newfile']['size'] > 8000000) { // file shouldn't be larger than 1Megabyte
                                                ?>
                                                    <script type="text/javascript" language="javascript">
                                                           window.alert=("File too large (Less than 8MB)");
                                                           window.location="expenditures.php";
                                                    </script>
                                                <?php
                                            }*/ else {
                            // move the uploaded (temporary) file to the specified destination
                            move_uploaded_file($file, $destination);
                            //$filename = $mou_id.'-'.$filename;
                            $sql = mysqli_query($mysqli, "UPDATE expenditures SET file_name='$filename' WHERE expenditure_id = $expenditure_id1");
                          }
                        ?>
                          <script type="text/javascript" language="javascript">
                            window.location = "expenditures.php";
                          </script>
                        <?php
                        }
                        ?>
                        <?php echo  '</div>'; ?>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                        </div>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>'; ?>
                        <?php echo  '</div>';  ?>
                      <?php
                        echo "</td>";
                        echo '<td><a class="btn btn-success" href="photos.php?type_id=' . $row['expenditure_id'] . ',' . $row['activity'] . ',' . $row['proposed_start_date'] . ',' . $row['proposed_end_date'] . '"> View Photos</a></td>';
                        echo  '</tr>';
                      }
                      ?>
								</tbody>
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