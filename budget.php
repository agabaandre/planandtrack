<?php session_start();
 include('connect.php');

 include('header.php');

$name = $_SESSION['name'];

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$access = $_SESSION['access'];

$string =  implode(", ", $access);

$sql11 = "SELECT * FROM budget b,units u,divisions d,fund_centres fc,funds f WHERE b.unit_id=u.unit_id AND u.division_id=d.division_id AND b.fund_centre_id=fc.fund_centre_id AND b.fund_id=f.fund_id AND b.unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";

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
                    <table class="table table-striped table-bordered table-hover">
                <tbody>
                  <form method="post" autocomplete="off">
                    <td>
                      <div class="form-group">
                        <select class="form-control select2bs4" style="width: 100%;" name="division_id">
                          <option value="">Select Division </option>
                          <?php
                          $sql2 = "SELECT * FROM divisions ORDER BY division";
                          $result2 = mysqli_query($mysqli, $sql2);
                          while ($row2 = mysqli_fetch_assoc($result2)) {
                          ?>
                            <option value=<?php echo $row2['division_id'] . '>' . $row2['division']; ?></option>
                            <?php
                          }
                            ?>
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <select class="form-control select2bs4" style="width: 100%;" name="unit_id">
                          <option value="">Select Workstream </option>
                          <?php
                          $sql10 = "SELECT * FROM units ORDER BY unit";
                          $result10 = mysqli_query($mysqli, $sql10);
                          while ($row10 = mysqli_fetch_assoc($result10)) {
                          ?>
                            <option value=<?php echo $row10['unit_id'] . '>' . $row10['unit']; ?></option>
                            <?php
                          }
                            ?>
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <select class="form-control select2bs4" style="width: 100%;" name="fund_centre_id">
                          <option value="">Select Fund Centre </option>
                          <?php
                          $sql10 = "SELECT DISTINCT(fund_centre),fund_centre_id FROM fund_centres ORDER BY fund_centre";
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
                      <div class="form-group">
                        <select class="form-control select2bs4" style="width: 100%;" name="fund_id">
                          <option value="">Select Fund </option>
                          <?php
                          $sql10 = "SELECT DISTINCT(fund),fund FROM funds ORDER BY fund";
                          $result10 = mysqli_query($mysqli, $sql10);
                          while ($row10 = mysqli_fetch_assoc($result10)) {
                          ?>
                            <option value=<?php echo $row10['fund_id'] . '>' . $row10['fund']; ?></option>
                            <?php
                          }
                            ?>
                        </select>
                      </div>
                    </td>
                    <td>
                      <button type="submit" name="Apply" class="btn btn-success">Apply</button>
                    </td>
                  </form>
                </tbody>
              </table>
              <?php
              if (isset($_POST['Apply'])) {
                $division_id = $_POST['division_id'];
                $unit_id = $_POST['unit_id'];
                $fund_center_id = $_POST['fund_center_id'];
                $fund_id = $_POST['fund_id'];
                $nonEmpty = array();
                if ($division_id != '') {
                  $nonEmpty[0] = "d.division_id";
                }
                if ($unit_id != '') {
                  $nonEmpty[1] = "u.unit_id";
                }
                if ($fund_centre_id != '') {
                  $nonEmpty[2] = "fc.fund_centre_id";
                }
                if ($fund_id != '') {
                  $nonEmpty[3] = "f.fund_id";
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
                $sql11 = " SELECT * FROM budget b,units u,divisions d,fund_centres fc,funds f WHERE b.unit_id=u.unit_id AND u.division_id=d.division_id AND b.fund_centre_id=fc.fund_centre_id AND b.fund_id=f.fund_id AND b.unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";
              }
              ?>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Division</th>
                        <th>Workstream</th>
                        <th>Fund Centre</th>
                        <th>Fund Centre Description</th>
                        <th>Fund</th>
                        <th>Fund Description</th>
                        <th>Original Budget</th>
                        <th>Original released</th>
                        <th>Total Expenditure</th>
                        <th>Released Budget Balance</th>
                        <th>Burn Rate</th>
                        <th>Details</th>
                        <!--<th>Edit</th>-->
                    </thead>
                    <tbody>
                      <?php
                      $result = mysqli_query($mysqli, $sql11);
                      $count = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        $budget_id  = $row['budget_id'];
                        $sql12 = "SELECT SUM(estimated_cost) as total FROM expenditures WHERE budget_id=$budget_id";
                        $result12 = mysqli_query($mysqli, $sql12);
                        $num = mysqli_num_rows($result12);
                        while ($row12 = mysqli_fetch_assoc($result12)) {
                          if ($num <= 0) {
                            $rel = $row['original'];
                            $exp = 0;
                            $bal = $row['original'];
                          } else {
                            $bal = $row['original'] - $row12['total'];
                            $exp = $row12['total'];
                          }
                        }
                        $fund_centre = $row['fund_centre'];
                        echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $row['division'] . "</td>";
                        echo "<td>" . $row['unit'] . "</td>";
                        echo '<td><a href="expenditures.php?type_id=' . $row['budget_id'] . ',' . $row['division'] . ',' . $row['unit'] . ',' . $row['fund_centre'] . ',' . $row['fund'] . ',' . $row['original_released'] . ',' . $bal . '">' . $fund_centre . '</a></td>';
                        echo "<td>" . $row['fund_centre_description'] . "</td>";
                        echo "<td>" . $row['fund'] . "</td>";
                        echo "<td>" . $row['fund_description'] . "</td>";
                        echo "<td>" . number_format($row['original']) . "</td>";
                        echo "<td>" . number_format($row['original_released']) . "</td>";
                        echo "<td>" . number_format($exp) . "</td>";
                        echo "<td>" . number_format($bal) . "</td>";
                        // echo "<td>".number_format($rev)."</td>";
                        $rate = ($exp / $row['original_released']) * 100;
                        echo "<td>" . round($rate, 0) . '%' . "</td>";
                        echo '<td><a class="btn btn-success" href="expenditures.php?type_id=' . $row['budget_id'] . ',' . $row['division'] . ',' . $row['unit'] . ',' . $row['fund_centre'] . ',' . $row['fund'] . ',' . $row['original_released'] . ',' . $bal . '"> Details</a></td>';
                        $count++;
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
	
</body>

</html>