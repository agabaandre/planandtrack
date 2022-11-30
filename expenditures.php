<?php session_start();
include('connect.php');

include('header.php');

$name = $_SESSION['name'];

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
$budget_id = $_SESSION['budget_id'];
$division = $_SESSION['division'];
$unit = $_SESSION['unit'];
$fund_center = $_SESSION['fund_center'];
$fund = $_SESSION['fund'];
$original_released = $_SESSION['original_released'];
$bal = $_SESSION['bal'];
} else {
$icon = $_GET['type_id'];
$values = explode(",", $icon);
$budget_id = $values[0];
$_SESSION['budget_id'] = $budget_id;
$division = $values[1];
$_SESSION['division'] = $division;
$unit = $values[2];
$_SESSION['unit'] = $unit;
$fund_center = $values[3];
$_SESSION['fund_center'] = $fund_center;
$fund = $values[4];
$_SESSION['fund'] = $fund;
$original_released = $values[5];
$_SESSION['original_released'] = $original_released;
$bal = $values[6];
$_SESSION['bal'] = $bal;
}
include('connect.php');
$sql11 = " SELECT * FROM expenditures e,member_states ms,types t WHERE e.member_state_id=ms.member_state_id AND budget_id=$budget_id AND t.type_id=e.type_id";

?>

<body>
<!--wrapper-->
<div class="wrapper">
<!--start header -->
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
<!--end navigation-->
<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">


<div class="card">
    

	<div class="card-body">
<div class="row">
<div class="col-md-10">
            <p>
  <h5><?php echo $division . ' : ', $unit . ' : ' . $fund_center . ' : ' . $original_released . ' : ' . $bal; ?></h5>
  </p>
</div>
<div class="col-md-2">
        <?php 
  echo '<h6 style="float: right;">
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_item">+ Register Activity</button>
</h6>'?>
</div>
</div>
<hr>
<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="add_item">Register Activity</h4>
                        </div>
                        <div class="modal-body">
                           <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="col-md-12">
                                    <div class="ibox">
                                        <div class="ibox-body">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="activity" placeholder="Activity"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="justification" placeholder="Justification"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select class="form-control select2bs4" style="width: 100%;" name="type_id">
                                                      <option value="">Select Activity Type </option>
                                                      <?php
                                                      $sql111 = "SELECT * FROM types ORDER BY type";
                                                      $result111 = mysqli_query($mysqli, $sql111);
                                                      while ($row111 = mysqli_fetch_assoc($result111)) {
                                                      ?>
                                                        <option value=<?php echo $row111['type_id'] . '>' . $row111['type']; ?></option>
                                                        <?php
                                                      }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="estimated_cost" placeholder="Estimated Cost">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 col-form-label">Host Member State</label>
                                                <div class="col-sm-12">
                                                   <select class="form-control select2bs4" style="width: 100%;" name="member_state_id">
                          <option value="">Select Member State </option>
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
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 col-form-label">City</label>
                                                <div class="col-sm-12">
                                                   <input type="text" class="form-control" name="city">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 col-form-label">Proposed Start Date</label>
                                                <div class="col-sm-12">
                                                   <input type="date" class="form-control" name="proposed_start_date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 col-form-label">Proposed End Date</label>
                                                <div class="col-sm-12">
                                                   <input type="date" class="form-control" name="proposed_end_date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 col-form-label">Remarks/Comments</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" name="remarks" rows="3"></textarea>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div align="right">
                                                <button type="submit" name="Save" class="btn btn-success">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
          <!-- <table width="70%" class="table table-hover table-condensed">
        </table>  -->
          <?php
          if (isset($_POST['Save'])) {
            $activity = $_POST['activity'];
            $justification = $_POST['justification'];
            $type_id = $_POST['type_id'];
            $member_state_id = $_POST['member_state_id'];
            $city = $_POST['city'];
            $proposed_start_date = $_POST['proposed_start_date'];
            $proposed_end_date = $_POST['proposed_end_date'];
            $estimated_cost = $_POST['estimated_cost'];
            $estimated_cost =  intval(preg_replace('/[^\d.]/', '', $estimated_cost));
            $remarks = $_POST['remarks'];
            if ($proposed_start_date > $proposed_end_date) {
          ?>
              <script type="text/javascript" language="javascript">
                window.alert('Start date cannot be after End Date');
                window.location = "expenditures.php";
              </script>
            <?php
            } elseif ($estimated_cost > $bal) {
            ?>
              <script type="text/javascript" language="javascript">
                window.alert("Expenditure cannot be more than Balance");
                window.location = "expenditures.php";
              </script>
            <?php
            } else {
              $SQL = mysqli_query($mysqli, "INSERT INTO expenditures (`budget_id`,`justification`,`type_id`,`activity`,`proposed_start_date`,`proposed_end_date`,`estimated_cost`,`remarks`,`user_id`,`member_state_id`,`city`) VALUES ('$budget_id','$justification','$type_id','$activity','$proposed_start_date','$proposed_end_date','$estimated_cost','$remarks','$user_id','$member_state_id','$city')");
            ?>
              <script type="text/javascript" language="javascript">
                window.location = "expenditures.php";
              </script>
          <?php
            }
          }
          ?>
                        </div>
                        <div class='modal-footer'>
                           <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
     
  
<div class=" table-responsive">
			<table id="example" class="table table-bordered table-striped wrap" >
    <thead>
      <tr>
        <th>#</th>
        <th>Activity</th>
        <th>Justification</th>
        <th>Activity Type</th>
        <th>Host Member State</th>
        <th>City</th>
        <th>Participants/Travellers</th>
        <th>Proposed Start Date</th>
        <th>Proposed End Date</th>
        <th>Estimated Cost</th>
        <th>Actual Start Date</th>
        <th>Actual End Date</th>
        <th>Approved Cost</th>
        <th>Actual Cost</th>
        <th>Approval Memo</th>
        <th>Report</th>
        <th>Edit</th>
        <th>Add/Remove Travellers</th>
        <th>Upload Approval Memo</th>
        <th>Upload Report</th>
        <th>Add Photos</th>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($mysqli, $sql11);
      $count = 1;
      $show = '';
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['expenditure_id'];
        $ms = $row['member_state'];
        echo "<tr>";
        echo "<td>" . $count . "</td>";
        echo "<td >" . $row['activity'] . "</td>";
        echo "<td>" . $row['justification'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['member_state'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
        $SQL9 = mysqli_query($mysqli, "SELECT title,fname,lname,oname FROM travellers t,staff s WHERE s.staff_id=t.staff_id AND expenditure_id = '" . $id . "' ");
        while ($row9 = mysqli_fetch_assoc($SQL9)) {
          $show = $show . ' : ' . $row9['title'] . ' ' . $row9['fname'] . ' ' . $row9['oname'] . ' ' . $row9['lname'];
        }
        echo "<td>" . $show . "</td>";
        echo "<td>" . $row['proposed_start_date'] . "</td>";
        echo "<td>" . $row['proposed_end_date'] . "</td>";
        echo "<td>" . number_format($row['estimated_cost']) . "</td>";
        echo "<td>" . $row['actual_start_date'] . "</td>";
        echo "<td>" . $row['actual_end_date'] . "</td>";
        echo "<td>" . number_format($row['approved_cost']) . "</td>";
        echo "<td>" . number_format($row['actual_cost']) . "</td>";
        echo '<td><a  href="view_approval.php?type_id=' . $row['approval'] . '">' . $row['approval'] . '</a></td>';
        echo '<td><a  href="view.php?type_id=' . $row['file_name'] . '">' . $row['file_name'] . '</a></td>';
        $show = '';
        $count++;
        echo "<td>";
         echo '<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['expenditure_id'].'"> Edit</button>';
        echo '<div class="modal fade" id="edit_user' . $row['expenditure_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" >
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="edit_user' . $row['expenditure_id'] . 'Label">Edit </h5>
                    </div>
                    <div class="modal-body">';
      ?>
       <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-body">
                <div class="form-group">
                      <div class="col-sm-12">                            <!--<td>User Id </td>-->
                             <input type="hidden" name="expenditure_id1" value="<?php echo $row['expenditure_id']; ?>">
                          </div>
                    <label class="col-sm-4 col-form-label">Activity *</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="activity"> <?php echo $row['activity']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Justification</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="justification" ><?php echo $row['justification']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Activity Type</label>
                    <div class="col-sm-12">
                        <select class="form-control select2bs4" style="width: 100%;" name="type_id">
                         <option selected value="<?php echo $row['type_id']; ?>"><?php echo $row['type']; ?></option>
                          <?php
                          $sql111 = "SELECT * FROM types ORDER BY type";
                          $result111 = mysqli_query($mysqli, $sql111);
                          while ($row111 = mysqli_fetch_assoc($result111)) {
                          ?>
                            <option value=<?php echo $row111['type_id'] . '>' . $row111['type']; ?></option>
                            <?php
                          }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Estimated Cost</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" value="<?php echo $row['estimated_cost']; ?>" name="estimated_cost">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Host Member State</label>
                    <div class="col-sm-12">
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
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">City</label>
                    <div class="col-sm-12">
                       <input type="text" class="form-control" name="city" value="<?php echo $row['city']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Proposed Start Date</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="proposed_start_date" value="<?php echo $row['proposed_start_date']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Proposed End Date</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="proposed_end_date" value="<?php echo $row['proposed_end_date']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Actual Start Date</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="actual_start_date" value="<?php echo $row['actual_start_date']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Actual End Date</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="actual_end_date" value="<?php echo $row['actual_end_date']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Approved Cost</label>
                    <div class="col-sm-12">
                       <input type="text" class="form-control" name="approved_cost" value="<?php echo $row['approved_cost']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Actual Cost</label>
                    <div class="col-sm-12">
                       <input type="text" class="form-control" name="actual_cost" value="<?php echo $row['actual_cost']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Remarks/Comments</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="remarks" rows="3"><?php echo $row['remarks']; ?></textarea>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div align="right">
                    <button type="submit" name="Edit" class="btn btn-success btn-lg">Save </button>
                </div>
            </div>
        </div>
    </div>
</form>

        <!-- <table width="70%" class="table table-hover table-condensed">
        </table>  -->
        <?php
        if (isset($_POST['Edit'])) {
          $expenditure_id1 = $_POST['expenditure_id1'];
          $activity = $_POST['activity'];
          $justification = $_POST['justification'];
          $type_id = $_POST['type_id'];
          $member_state_id = $_POST['member_state_id'];
          $city = $_POST['city'];
          $proposed_start_date = $_POST['proposed_start_date'];
          $proposed_end_date = $_POST['proposed_end_date'];
          $estimated_cost = $_POST['estimated_cost'];
          $estimated_cost =  intval(preg_replace('/[^\d.]/', '', $estimated_cost));
          $remarks = $_POST['remarks'];
          $actual_start_date = $_POST['actual_start_date'];
          $actual_end_date = $_POST['actual_end_date'];
          $approved_cost = $_POST['approved_cost'];
          $approved_cost =  intval(preg_replace('/[^\d.]/', '', $approved_cost));
          $actual_cost = $_POST['actual_cost'];
          $actual_cost =  intval(preg_replace('/[^\d.]/', '', $actual_cost));
            
            
          if ($proposed_start_date > $proposed_end_date || $actual_start_date > $actual_end_date) {
        ?>
            <script type="text/javascript" language="javascript">
              window.alert('Start date cannot be after End Date');
              window.location = "expenditures.php";
            </script>
          <?php
          } elseif ($estimated_cost > $bal  || $actual_cost > $bal || $approved_cost > $bal) {
          ?>
            <script type="text/javascript" language="javascript">
              window.alert("Expenditure cannot be more than Balance");
              window.location = "expenditures.php";
            </script>
          <?php
          } else {
            $SQL = mysqli_query($mysqli, "UPDATE  expenditures SET activity='$activity',justification='$justification',type_id='$type_id',member_state_id='$member_state_id',city='$city',proposed_start_date='$proposed_start_date',proposed_end_date='$proposed_end_date',estimated_cost='$estimated_cost',actual_start_date='$actual_start_date',actual_end_date='$actual_end_date',approved_cost='$approved_cost',actual_cost='$actual_cost',remarks='$remarks' WHERE expenditure_id=$expenditure_id1");
              
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
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
        <?php echo  '</div>'; ?>
        <?php echo  '</div>'; ?>
        <?php echo  '</div>';
        echo '<td><a href="staff_travelling.php?type_id=' . $row['expenditure_id'] . ',' . $row['activity'] . ',' . $row['member_state'] . ',' . $row['proposed_start_date'] . ',' . $row['proposed_end_date'] . ',' . $row['estimated_cost'] . '">Add/Remove</a></td>';
        echo "</td>";


        echo "<td>";
      

echo '<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approval'.$row['expenditure_id'].'"> Upload</button>';
echo '<div class="modal fade" id="approval' . $row['expenditure_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" >
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="approval' . $row['expenditure_id'] . 'Label" >Upload Approval </h5>
</div>
<div class="modal-body">';
        ?>
        <form method="post" class="registerForm" enctype="multipart/form-data">
          <table width="80%" class="table table-hover table-condensed" border="0">
            <tbody>
                <tr>
                <!--<td>User Id </td>-->
                <input type="hidden" name="approval1" value="<?php echo $row['approval']; ?>">
              </tr>
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
          $approval1 = $_POST['approval1'];
          if ($approval1) {
            unlink('approval/'."$approval1");
              
              $sql = mysqli_query($mysqli, "UPDATE expenditures SET file_name='' WHERE expenditure_id = $expenditure_id1"); 
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
          if (!in_array($extension, ['pdf', 'PDF'])) {
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

echo '<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reupload'.$row['expenditure_id'].'"> Upload</button>';
echo '<div class="modal fade" id="reupload'.$row['expenditure_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" >
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="reupload'.$row['expenditure_id']. 'Label" >Upload Report </h5>
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
                <!--<td>User Id </td>-->
                <input type="hidden" name="file_name1" value="<?php echo $row['file_name']; ?>">
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
        
            $file_name1 = $_POST['file_name1'];
          if ($file_name1) {
            unlink('reports/'."$file_name1");
              
              $sql = mysqli_query($mysqli, "UPDATE expenditures SET file_name='' WHERE expenditure_id = $expenditure_id1"); 
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
          if (!in_array($extension, ['pdf', 'PDF'])) {
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
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
        <?php echo  '</div>'; ?>
        <?php echo  '</div>'; ?>
        <?php echo  '</div>';  ?>
      <?php
        echo "</td>";
        echo '<td><a class="btn btn-success" href="photos.php?type_id=' . $id . ',' . $ms . ',' . $row['activity'] . ',' . $row['proposed_start_date'] . ',' . $row['proposed_end_date'] . '"> View Photos</a></td>';
        echo  '</tr>';
      }
      ?>
    </tbody>
  </table>
		</div>
	</div>
</div>

<hr/>

</div>
</div>
<!--end page wrapper -->
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<?php


include("footer.php");

?>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
</div>
<div class="switcher-body">
<div class="d-flex align-items-center">
<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
</div>
<hr/>
<h6 class="mb-0">Theme Styles</h6>
<hr/>
<div class="d-flex align-items-center justify-content-between">
<div class="form-check">
	<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
	<label class="form-check-label" for="lightmode">Light</label>
</div>
<div class="form-check">
	<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
	<label class="form-check-label" for="darkmode">Dark</label>
</div>
<div class="form-check">
	<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
	<label class="form-check-label" for="semidark">Semi Dark</label>
</div>
</div>
<hr/>
<div class="form-check">
<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
</div>
<hr/>
<h6 class="mb-0">Header Colors</h6>
<hr/>
<div class="header-colors-indigators">
<div class="row row-cols-auto g-3">
	<div class="col">
		<div class="indigator headercolor1" id="headercolor1"></div>
	</div>
	<div class="col">
		<div class="indigator headercolor2" id="headercolor2"></div>
	</div>
	<div class="col">
		<div class="indigator headercolor3" id="headercolor3"></div>
	</div>
	<div class="col">
		<div class="indigator headercolor4" id="headercolor4"></div>
	</div>
	<div class="col">
		<div class="indigator headercolor5" id="headercolor5"></div>
	</div>
	<div class="col">
		<div class="indigator headercolor6" id="headercolor6"></div>
	</div>
	<div class="col">
		<div class="indigator headercolor7" id="headercolor7"></div>
	</div>
	<div class="col">
		<div class="indigator headercolor8" id="headercolor8"></div>
	</div>
</div>
</div>
</div>
</div>
<!--end switcher-->
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>
<script>
$(document).ready(function() {
var table = $('#example2').DataTable( {
lengthChange: false,
buttons: [ 'copy', 'excel', 'pdf', 'print']
} );

table.buttons().container()
.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
} );
</script>
<!--app JS-->
<script src="assets/js/app.js"></script>
</body>

</html>