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
$access = $_SESSION['access'];
$string =  implode(", ", $access);
include('connect.php');
$sql11 = " SELECT tp.initiation_date,tp.travel_plan_id,d.division,u.division_id,b.sub_date,tp.travel_plan_id,d.division,u.unit,tp.ref_no,tp.description,ms.member_state,ms.competition_type_id,tp.financer_id,tp.sourcing_category_id,tp.sourcing_method_id,tp.estimated_cost,fc.fund_centre FROM travel_plan tp,units u,divisions d,member_states ms,budget b,fund_centres fc WHERE tp.division_id=u.division_id AND u.division_id=d.division_id AND tp.competition_type_id=ms.competition_type_id AND b.sub_date=tp.sub_date AND b.fund_centre_id=fc.fund_centre_id AND tp.division_id IN (SELECT division_id FROM units WHERE division_id IN ($string))";
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
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				 <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Unit</th>
              <th>Member State</th>
              <th>Fund Centre</th>
              <th>Apply</th>
            </tr>
          </thead>
          <tbody>
            <form method="post" autocomplete="off">
              <td>
                <div class="form-group">
                  <select class="form-control single-select" style="width: 100%;" name="division_id">
                    <option value="">Select Unit </option>
                    <?php
                    $sql10 = "SELECT * FROM units ORDER BY unit";
                    $result10 = mysqli_query($mysqli, $sql10);
                    while ($row10 = mysqli_fetch_assoc($result10)) {
                    ?>
                      <option value=<?php echo $row10['division_id'] . '>' . $row10['unit']; ?></option>
                      <?php
                    }
                      ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <select class="form-control single-select" style="width: 100%;" name="competition_type_id">
                    <option value="">Select Member State </option>
                    <?php
                    $sql10 = "SELECT * FROM  member_states ORDER BY member_state";
                    $result10 = mysqli_query($mysqli, $sql10);
                    while ($row10 = mysqli_fetch_assoc($result10)) {
                    ?>
                      <option value=<?php echo $row10['competition_type_id'] . '>' . $row10['member_state']; ?></option>
                      <?php
                    }
                      ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <select class="form-control single-select" style="width: 100%;" name="fund_centre_id">
                    <option value="">Select Fund Centre </option>
                    <?php
                    $sql10 = "SELECT * FROM fund_centres ORDER BY fund_centre";
                    $result10 = mysqli_query($mysqli, $sql10);
                    while ($row10 = mysqli_fetch_assoc($result10)) {
                    ?>
                      <option value=<?php echo $row10['fund_centre_id'] . '>' . $row10['fund_centre']; ?></option>
                      <?php
                    }
                      ?>
                  </select>
                </div>
              </td>
              <td>
                <button type="submit" name="Apply" class="btn btn-success">Apply Limits</button>
              </td>
            </form>
          </tbody>
        </table>
        <?php
        if (isset($_POST['Apply'])) {
          $division_id = $_POST['division_id'];
          $fund_centre_id = $_POST['fund_centre_id'];
          $competition_type_id = $_POST['competition_type_id'];
          $nonEmpty = array();
          if ($division_id != '') {
            $nonEmpty[0] = "u.division_id";
          }
          if ($fund_centre_id != '') {
            $nonEmpty[1] = "fc.fund_centre_id";
          }
          if ($competition_type_id != '') {
            $nonEmpty[2] = "ms.competition_type_id";
          }
          $noOfElements = sizeof($nonEmpty);
          if ($noOfElements > 0) {
            $count = 1;
            $query = "AND ";
            foreach ($nonEmpty as $value) {
              if ($count == $noOfElements) {
                $values = explode(".", $value);
                $query = $query . " " . $value . " LIKE '" . $_POST[$values[1]] . "'";
              } else {
                $values = explode(".", $value);
                $query = $query . " " . $value . " LIKE '" . $_POST[$values[1]] . "' AND";
              }
              $count++;
            }
            $sql11 =  $sql11 . " " . $query;
          }
          $sql11 = $sql11;
        } else {
          $sql11 = "SELECT pp.procurement_plan_id,pp.division_id,d.division,pp.ref_no,pp.description,sc.sourcing_category,sm.sourcing_method,ct.competition_type,f.financer,pp.sub_date,pp.initiation_date,pp.opening_date,pp.evaluation_date,pp.tech_approval_date,pp.open_fin_date,com_eva_date,pp.combined_approval_date,pp.contract_vetting,pp.contract_signing FROM procurement_plan pp,divisions d,sourcing_categories sc,sourcing_methods sm,competition_types ct,financers f WHERE pp.division_id=d.division_id  AND pp.division_id IN ($string) AND sc.sourcing_category_id=pp.sourcing_category_id AND sm.sourcing_method_id=pp.sourcing_method_id AND ct.competition_type_id=pp.competition_type_id AND f.financer_id=pp.financer_id";


        }
        ?>
        <div class="card">
          <div class="card-header">
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <!--<button class="btn btn-success float-right" data-toggle="modal" data-target="#new_staff"> Register Travel/ref_no</button> -->
              <div class="modal fade" id="new_staff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: #629aa9;color:#fff">
                      <h4 class="modal-title" id="new_staff">Register Mission / ref_no </h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" name="contact" class="registerForm">
                        <div class="table-responsive">
                          <table width="70%" class="table table-hover table-condensed" border="0">
                            <tbody>
                              <tr>
                                <td style="width: 30.0365%;">Unit *</td>
                                <td style="width: 20%;">
                                  <div class="form-group">
                                    <select class="form-control single-select" style="width: 100%;" name="division_id">
                                      <option value="">Select Unit </option>
                                      <?php
                                      $sql2 = "SELECT * FROM units ORDER BY unit";
                                      $result2 = mysqli_query($mysqli, $sql2);
                                      while ($row2 = mysqli_fetch_assoc($result2)) {
                                      ?>
                                        <option value=<?php echo $row2['division_id'] . '>' . $row2['unit']; ?></option>
                                        <?php
                                      }
                                        ?>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">ref_no/Mission</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><textarea class="form-control" name="ref_no" rows="3" required=""></textarea></div>
                                </td>
                                <td style="width: 5.21897%;"></td>
                                <td style="width: 30.0365%;">description</td>
                                <td style="width: 20%;">
                                  <div class="form-group"><textarea class="form-control" name="description" rows="3" required=""></textarea></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">Start Date</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="date" class="form-control" name="sourcing_category_id" required=""></div>
                                </td>
                                <td style="width: 5.21897%;"></td>
                                <td style="width: 30.0365%;">End Date</td>
                                <td style="width: 20%;">
                                  <div class="form-group"><input type="date" class="form-control" name="sourcing_method_id" required=""></div>
                                </td>
                              </tr>
                              <tr>
                              <tr>
                                <td style="width: 20%;">Member State</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group">
                                    <select class="form-control single-select" style="width: 100%;" name="competition_type_id">
                                      <option value="">Select Member State </option>
                                      <?php
                                      $sql3 = "SELECT * FROM member_states ORDER BY member_state";
                                      $result3 = mysqli_query($mysqli, $sql3);
                                      while ($row3 = mysqli_fetch_assoc($result3)) {
                                      ?>
                                        <option value=<?php echo $row3['competition_type_id'] . '>' . $row3['member_state']; ?></option>
                                        <?php
                                      }
                                        ?>
                                    </select>
                                  </div>
                                </td>
                                <td style="width: 5.21897%;"></td>
                                <td style="width: 30.0365%;">financer_id *</td>
                                <td style="width: 20%;">
                                  <div class="form-group"><input type="text" class="form-control" name="financer_id" required=""></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;">Participants/Travellers</td>
                                <td style="width: 50%;">
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
                                <td style="width: 5.21897%;"></td>
                                <td style="width: 20%;">Estimated Cost</td>
                                <td style="width: 24.7445%;">
                                  <div class="form-group"><input type="text" class="form-control" name="estimated_cost" required=""></div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 30.0365%;">Budget Line *</td>
                                <td style="width: 10%;">
                                  <div class="form-group">
                                    <select class="form-control single-select" style="width: 100%;" name="sub_date">
                                      <option value="">Select Budget Line </option>
                                      <?php
                                      $sql4 = "SELECT * FROM budget b,fund_centers fc WHERE b.fund_center_id=fc.fund_center_id";
                                      $result4 = mysqli_query($mysqli, $sql4);
                                      while ($row4 = mysqli_fetch_assoc($result4)) {
                                      ?>
                                        <option value=<?php echo $row4['sub_date'] . '>' . $row4['fund_center']; ?></option>
                                        <?php
                                      }
                                        ?>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width: 20%;"></td>
                                <td style="width: 24.7445%;"><button type="submit" name="Save" class="btn btn-success btn-lg">Save </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </form>
                      <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                      <?php
                      if (isset($_POST['Save'])) {
                        //$division_id = $_POST['division_id'];
                        $division_id = $_POST['division_id'];
                        $ref_no = $_POST['ref_no'];
                        $description = $_POST['description'];
                        $sourcing_category_id = $_POST['sourcing_category_id'];
                        $sourcing_method_id = $_POST['sourcing_method_id'];
                        $competition_type_id = $_POST['competition_type_id'];
                        $financer_id = $_POST['financer_id'];
                        $estimated_cost = $_POST['estimated_cost'];
                        $estimated_cost =  intval(preg_replace('/[^\d.]/', '', $estimated_cost));
                        $sub_date = $_POST['sub_date'];
                        if ($sourcing_category_id > $sourcing_method_id) {
                      ?>
                          <script type="text/javascript" language="javascript">
                            window.alert('Start date cannot be after End Date');
                            window.location = "travel.php";
                          </script>
                        <?php
                        } else {
                          $SQL = mysqli_query($mysqli, "INSERT INTO travel_plan (`division_id`,`ref_no`,`description`,`sourcing_category_id`,`sourcing_method_id`,`competition_type_id`,`financer_id`,`estimated_cost`,`sub_date`) VALUES ('$division_id','$ref_no','$description','$sourcing_category_id','$sourcing_method_id','$competition_type_id','$financer_id','$estimated_cost','$sub_date')");
                          $SQL5 = mysqli_query($mysqli, "SELECT travel_plan_id FROM travel_plan WHERE  division_id='" . $division_id . "'  AND ref_no='" . $ref_no . "'  AND description='" . $description . "' ");
                          $row5 = mysqli_fetch_assoc($SQL5);
                          $travel_plan_id = $row5['travel_plan_id'];
                          if (isset($_POST["subject"])) {
                            // Retrieving each selected option
                            foreach ($_POST['subject'] as $subject)
                              $SQL = mysqli_query($mysqli, "INSERT INTO travellers_plan (`travel_plan_id`,`staff_id`) VALUES ('$travel_plan_id','$subject')");
                          }
                        ?>
                          <script type="text/javascript" language="javascript">
                            window.location = "travel.php";
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
				<!--end breadcrumb-->
				
				<h6 class="mb-0 text-uppercase">Procurement Plan</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-bordered table-striped">
								<thead>
									 <tr>
                    <th>#</th>
                    <th>Division</th>
                    <th>Ref No</th>
                    <th>Description </th>
                    <th>Sourcing Category</th>
                    <th>Sourcing Method</th>
                    <th>Competition Type</th>
                    <th>Estimated Cost</th>
                    <th>Financer</th>
                    <th>Request Submission Date</th>
                    <th>Initiation Date</th>
                    <th>Opening Date</th>
                    <th>Evaluation Date</th>
                    <th>Technical Approval Date</th>
                    <th>Opening Financial Proposal Date</th>
                    <th>Combined Evaluation Date</th>
                    <th>Combined Approval Date</th>
                    <th>Contract Vetting Date</th>
                    <th>Contract Signing Date</th>
                    <th>Edit </th>
								</thead>
								<tbody>
									<?php
                  $result = mysqli_query($mysqli, $sql11);
                  $count = 1;
                  $show = '';
                  while ($row = mysqli_fetch_assoc($result)) {
                    //$id = $row['travel_plan_id'];
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    echo "<td>" . $row['division'] . "</td>";
                    echo "<td>" . $row['ref_no'] . "</td>";
                    echo "<td wrap>" . $row['description'] . "</td>";
                    echo "<td>" . $row['sourcing_category'] . "</td>";
                    echo "<td>" . $row['sourcing_method'] . "</td>";
                    echo "<td>" . $row['competition_type'] . "</td>";
                    echo "<td>" . $row['financer'] . "</td>";
                    $sub_date = date("d-m-Y", strtotime($row['sub_date']));
                    echo "<td>" . $sub_date . "</td>";
                    $initiation_date = date("d-m-Y", strtotime($row['initiation_date']));
                    echo "<td>" . $initiation_date . "</td>";
                    $opening_date = date("d-m-Y", strtotime($row['opening_date']));
                    echo "<td>" . $opening_date . "</td>";
                    $evaluation_date = date("d-m-Y", strtotime($row['evaluation_date']));
                    echo "<td>" . $evaluation_date . "</td>";
                    $tech_approval_date = date("d-m-Y", strtotime($row['tech_approval_date']));
                    echo "<td>" . $tech_approval_date . "</td>";
                    $open_fin_date = date("d-m-Y", strtotime($row['open_fin_date']));
                    echo "<td>" . $open_fin_date . "</td>";
                    $com_eva_date = date("d-m-Y", strtotime($row['com_eva_date']));
                    echo "<td>" . $com_eva_date . "</td>";
                    $combined_approval_date = date("d-m-Y", strtotime($row['combined_approval_date']));
                    echo "<td>" . $combined_approval_date . "</td>";
                    $tech_approval_date = date("d-m-Y", strtotime($row['tech_approval_date']));
                    echo "<td>" . $tech_approval_date . "</td>";
                    $contract_vetting = date("d-m-Y", strtotime($row['contract_vetting']));
                    echo "<td>" . $contract_vetting . "</td>";
                    $contract_signing = date("d-m-Y", strtotime($row['contract_signing']));
                    echo "<td>" . $contract_signing . "</td>";
                    $count++;
                    echo "<td>";

                    echo '<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['procurement_plan_id'].'"> Edit</button>';
                    echo '<div class="modal fade" id="edit_user' . $row['procurement_plan_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" >
                                    <div class="modal-content">
                                    <div class="modal-header" >
                                    <h4 class="modal-title" id="edit_user' . $row['procurement_plan_id'] . 'Label">Edit </h4>
                                    </div>
                                    <div class="modal-body">';
                  ?>
                    <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                      <input type="hidden" name="procurement_plan_id" value="<?php echo $row['procurement_plan_id']; ?>">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-body">
                <div class="form-group">
                  
                    <label class="col-sm-4 col-form-label">Division *</label>
                    <div class="col-sm-12">
                        <select class="form-control single-select" style="width: 100%;" name="division_id">
 <option selected value="<?php echo $row['division_id']; ?>"><?php echo $row['division']; ?></option>
<?php
$sql10 = "SELECT * FROM divisions ";
$result10 = mysqli_query($mysqli, $sql10);
while ($row10 = mysqli_fetch_assoc($result10)) {
?>
<option value=<?php echo $row10['division_id'] . '>' . $row10['division']; ?></option>
<?php
}
?>
</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Ref No</label>
                    <div class="col-sm-12">
                         <input type="text" class="form-control" value="<?php echo $row['ref_no']; ?>" name="ref_no">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-12">
                       <textarea class="form-control" name="description" rows="3"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Sourcing Category</label>
                    <div class="col-sm-12">
                         <select class="form-control single-select" style="width: 100%;" name="sourcing_category_id">
 <option selected value="<?php echo $row['sourcing_category_id']; ?>"><?php echo $row['division']; ?></option>
<?php
$sql10 = "SELECT * FROM sourcing_categories ";
$result10 = mysqli_query($mysqli, $sql10);
while ($row10 = mysqli_fetch_assoc($result10)) {
?>
<option value=<?php echo $row10['sourcing_category_id'] . '>' . $row10['sourcing_category']; ?></option>
<?php
}
?>
</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Sourcing Method</label>
                    <div class="col-sm-12">
                       <select class="form-control single-select" style="width: 100%;" name="sourcing_method_id">
 <option selected value="<?php echo $row['sourcing_method_id']; ?>"><?php echo $row['sourcing_method']; ?></option>
<?php
$sql10 = "SELECT * FROM sourcing_methods";
$result10 = mysqli_query($mysqli, $sql10);
while ($row10 = mysqli_fetch_assoc($result10)) {
?>
<option value=<?php echo $row10['sourcing_method_id'] . '>' . $row10['sourcing_method']; ?></option>
<?php
}
?>
</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Competition Type</label>
                    <div class="col-sm-12">
<select class="form-control single-select" style="width: 100%;" name="competition_type_id">
<option selected value="<?php echo $row['competition_type_id']; ?>"><?php echo $row['competition_type']; ?></option>
<?php
$sql10 = "SELECT * FROM competition_types";
$result10 = mysqli_query($mysqli, $sql10);
while ($row10 = mysqli_fetch_assoc($result10)) {
?>
<option value=<?php echo $row10['competition_type_id'] . '>' . $row10['competition_type']; ?></option>
<?php
}
?>
</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Estimated Cost</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="proposed_start_date" value="<?php echo $row['proposed_start_date']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Financer</label>
                    <div class="col-sm-12">
                      <select class="form-control single-select" style="width: 100%;" name="competition_type_id">
<option selected value="<?php echo $row['financer_id']; ?>"><?php echo $row['financer']; ?></option>
<?php
$sql10 = "SELECT * FROM financers";
$result10 = mysqli_query($mysqli, $sql10);
while ($row10 = mysqli_fetch_assoc($result10)) {
?>
<option value=<?php echo $row10['financer_id'] . '>' . $row10['financer']; ?></option>
<?php
}
?>
</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Request Submission Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="sub_date" value="<?php echo $row['proposed_end_date']; ?>">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Initiation Date</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="initiation_date" value="<?php echo $row['initiation_date']; ?>">
                    </div>
                </div>


                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Opening Date</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="opening_date" value="<?php echo $row['opening_date']; ?>">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Evaluation Date</label>
                    <div class="col-sm-12">
                       <input type="date" class="form-control" name="evaluation_date" value="<?php echo $row['evaluation_date']; ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Technical Approval Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="tech_approval_date" value="<?php echo $row['tech_approval_date']; ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Opening Financial Proposal Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="open_fin_date" value="<?php echo $row['open_fin_date']; ?>">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Combined Evaluation Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="com_eva_date" value="<?php echo $row['com_eva_date']; ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Combined Approval Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="combined_approval_date" value="<?php echo $row['combined_approval_date']; ?>">
                        
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-4 col-form-label">Contract Vetting Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="contract_vetting" value="<?php echo $row['contract_vetting']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 col-form-label">Contract Signing Date</label>
                    <div class="col-sm-12">
                      <input type="date" class="form-control" name="contract_signing" value="<?php echo $row['contract_signing']; ?>">
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
                      
                      $procurement_plan_id = $_POST['procurement_plan_id'];
                      $division_id = $_POST['division_id'];
                      $ref_no = $_POST['ref_no'];
                      $description = $_POST['description'];
                      $sourcing_category_id = $_POST['sourcing_category_id'];
                      $sourcing_method_id = $_POST['sourcing_method_id'];
                      $competition_type_id = $_POST['competition_type_id'];
                      $financer_id = $_POST['financer_id'];
                      $estimated_cost = $_POST['estimated_cost'];
                      $sub_date = $_POST['sub_date'];
                      $initiation_date = $_POST['initiation_date'];
                      $opening_date = $_POST['opening_date'];
                      $evaluation_date = $_POST['evaluation_date'];
                      $tech_approval_date = $_POST['tech_approval_date'];
                      $open_fin_date = $_POST['open_fin_date'];
                      $com_eva_date = $_POST['com_eva_date'];
                      $combined_approval_date = $_POST['combined_approval_date'];
                      $contract_vetting = $_POST['contract_vetting'];
                      $contract_signing = $_POST['contract_signing'];




$SQL = mysqli_query($mysqli,"UPDATE  travel_plan SET division_id='$division_id',ref_no='$ref_no',description='$description',sourcing_category_id='$sourcing_category_id',sourcing_method_id='$sourcing_method_id',competition_type_id='$competition_type_id',financer_id='$financer_id',estimated_cost='$estimated_cost',sub_date='$sub_date',initiation_date='$initiation_date' ,opening_date='$opening_date' ,evaluation_date='$evaluation_date',tech_approval_date='$tech_approval_date',open_fin_date='$open_fin_date',com_eva_date='$com_eva_date',combined_approval_date='$combined_approval_date',contract_vetting='$contract_vetting',contract_signing='$contract_signing' WHERE procurement_plan_id=$procurement_plan_id");
                    ?>
                      <script type="text/javascript" language="javascript">
                        window.location = "procurement.php";
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