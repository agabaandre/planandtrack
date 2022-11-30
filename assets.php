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
				
        <div class="card">
          <div class="card-header">
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <!--<button class="btn btn-success float-right" data-toggle="modal" data-target="#new_staff"> Register Travel/Activity</button> -->
              
				<!--end breadcrumb-->
        <div class="row">
          <div class="col-md-4">
              <h6 class="mb-0 text-uppercase">Assets</h6>
          </div>

          <div class="col-md-8">
            <button type="button" style="float: right;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_asset"> + Register Asset</button>
          </div>
          
        </div>
        <div class="modal fade" id="add_asset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register Asset</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="card">
              <div class="card-body">
               <form  method="Post" autocomplete="off">
                  <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <input type="text" class="form-control" name="description" required="">
                  </div>

                    <div class="mb-3">
                    <label class="form-label">Category:</label>
                   <select name="asset_category_id" class="form-control single-select" required="" >
                        <option value="">Select Category</option>';
                        <?php
                            $sql10="SELECT * FROM asset_categories";
                            $result10= mysqli_query($mysqli,$sql10); 
                            while ($row10 = mysqli_fetch_assoc($result10)){
                              ?>
                              <option  value= <?php echo $row10['asset_category_id'].'>'.$row10['category_name']; ?></option>
                              <?php
                            }
                            ?>
                      </select>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Serial No:</label>
                    <input type="text" class="form-control" name="serialno" required="">
                  </div>
                  </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Tag No:</label>
                    <input type="text" class="form-control" name="tagno" required="">
                  </div>
                  </div>
                  </div>

                    <div class="mb-3">
                    <label class="form-label">Condidtion:</label>
                    <input type="text" class="form-control" name="condition_of_asset" required="">
                  </div>

                    <div class="mb-3">
                    <label class="form-label">Purchase Date:</label>
                    <input type="text" class="form-control dob1" name="purchase_date" required="">
                  </div>


                    <div class="row">
                      <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Office:</label>
                     <select name="office_id" class="form-control single-select"  required="" >
                        <option value="">Select Office</option>';
                        <?php
                            $sql10="SELECT * FROM offices";
                            $result10= mysqli_query($mysqli,$sql10); 
                            while ($row10 = mysqli_fetch_assoc($result10)){
                              ?>
                              <option  value= <?php echo $row10['office_id'].'>'.$row10['office_name']; ?></option>
                              <?php
                            }
                            ?>
                      </select>
                  </div>
                  </div>
                     <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Location:</label>
                   <input type="text" class="form-control dob1" name="location" value="<?php echo $row['location']; ?>" required="">
                  </div>
                   </div>
                    </div>

                    <div class="mb-3">
                    <label class="form-label">Estimated Cost:</label>
                    <input type="text" class="form-control" name="cost" required="">
                  </div>

                 
                  <div class="mb-3">
                   <button type="Submit" name="Submit"  style="float: right;" class="btn btn-success">Register</button>
                    </div>
                  
                </form>
              </div>
            </div>
      </div>

    </div>
  </div>
</div>


<?php 
if(isset($_POST['Submit'])){
$cost = $_POST['cost'];
$location = $_POST['location'];
$office_id = $_POST['office_id'];
$purchase_date = $_POST['purchase_date'];
$condition_of_asset = $_POST['condition_of_asset'];
$tagno = $_POST['tagno'];
$serialno = $_POST['serialno'];
$asset_category_id = $_POST['asset_category_id'];
$description = $_POST['description'];


  $result12 = mysqli_query($mysqli,"SELECT * FROM assets WHERE cost='".$cost."'  AND location='".$location."'   AND office_id='".$office_id."'   AND purchase_date='".$purchase_date."'   AND condition_of_asset='".$condition_of_asset."'   AND tagno='".$tagno."'   AND serialno='".$serialno."'   AND asset_category_id='".$asset_category_id."'   AND description='".$description."'  ");

  if($num>0){

    ?>
    <!--<script language="javascript" type="text/javascript">
      alert ("Service Already Existis");
      window.location="<?php  //echo $page_link.'?page='.$page_id ?>";
    </script>-->
    <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show">
<div class="text-dark">Assest Already Exists</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <?php

  }else{ 


$SQL = mysqli_query($mysqli,"INSERT INTO assets(`cost`,`location`,`office_id`,`purchase_date`,`condition_of_asset`,`tagno`,`serialno`,`asset_category_id`,`description`) VALUES ('$cost','$location','$office_id','$purchase_date','$condition_of_asset','$tagno','$serialno','$asset_category_id','$description')");

    ?>
<div class="alert alert-success border-0 bg-success alert-dismissible fade show">
<div class="text-white">Assest Successfully Added</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <!--<script type="text/javascript" language="javascript">
      window.location="<?php  //echo $page_link.'?page='.$page_id ?>";
    </script>-->
    <?php
  }
}
?> 
				
			
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									 <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Serial no </th>
                    <th>Tag no</th>
                    <th>condition_of_asset</th>
                    <th>Purchase Date</th>
                    <th>Office</th>
                    <th>Location</th>
                    <th>Estimated cost</th>
                    <th>Qty</th>
                    <th>Edit </th>
								</thead>
								<tbody>
									<?php    
                  $result = mysqli_query($mysqli,"SELECT * FROM assets a,offices o,asset_categories ac WHERE
                   ac.asset_category_id=a.asset_category_id  AND a.office_id=o.office_id ");
                  $count = 1;
                  while ($row = mysqli_fetch_assoc($result)) {
                    //$id = $row['travel_plan_id'];
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    echo "<td wrap>" . $row['description'] . "</td>";
                    echo "<td>" . $row['category_name'] . "</td>";
                    echo "<td>" . $row['serialno'] . "</td>";
                    echo "<td>" . $row['tagno'] . "</td>";
                    echo "<td>" . $row['condition_of_asset'] . "</td>";
                    echo "<td>" . $row['purchase_date'] . "</td>";
                    echo "<td>" . $row['office_name'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['cost'] . "</td>";
                    echo "<td>" . $row['qty'] . "</td>";
                   
                    $count++;
                    echo "<td>";

                    echo '<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['asset_id'].'"> Edit</button>';
                    echo '<div class="modal fade" id="edit_user' . $row['asset_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" >
                                    <div class="modal-content">
                                    <div class="modal-header"  style="background-color: #629aa9;color:#fff">
                                    <h6 class="modal-title" id="edit_user' . $row['asset_id'] . 'Label" style="color:#fff">Edit Asset </h6>
                                    </div>
                                    <div class="modal-body">';
                  ?>
                     <form  method="Post" autocomplete="off">
                      <input type="text" class="form-control" name="asset_id"  hidden="" value="<?php echo $row['asset_id']; ?>">
                  <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <input type="text" class="form-control" name="description" value="<?php echo $row['description']; ?>" required="">
                  </div>

                    <div class="mb-3">
                    <label class="form-label">Category:</label>
                   <select name="asset_category_id" class="form-control single-select" required="" >
                     <option  value= <?php echo $row['asset_category_id'].'>'.$row['category_name']; ?></option>
                        <option value="">Select Category</option>';
                        <?php
                            $sql10="SELECT * FROM asset_categories";
                            $result10= mysqli_query($mysqli,$sql10); 
                            while ($row10 = mysqli_fetch_assoc($result10)){
                              ?>
                              <option  value= <?php echo $row10['asset_category_id'].'>'.$row10['category_name']; ?></option>
                              <?php
                            }
                            ?>
                      </select>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Serial No:</label>
                    <input type="text" class="form-control" name="serialno" value="<?php echo $row['serialno']; ?>" required="">
                  </div>
                  </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Tag No:</label>
                    <input type="text" class="form-control" name="tagno" value="<?php echo $row['tagno']; ?>" required="">
                  </div>
                  </div>
                  </div>

                    <div class="mb-3">
                    <label class="form-label">Condidtion:</label>
                    <input type="text" class="form-control" name="condition_of_asset" value="<?php echo $row['condition_of_asset']; ?>" required="">
                  </div>

                    <div class="mb-3">
                    <label class="form-label">Purchase Date:</label>
                    <input type="text" class="form-control dob1" name="purchase_date" value="<?php echo $row['purchase_date']; ?>" required="">
                  </div>


                    <div class="row">
                      <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Office:</label>
                     <select name="office_id" class="form-control single-select"  required="" >
                      <option  value= <?php echo $row['office_id'].'>'.$row['office_name']; ?></option>
                        <option value="">Select Office</option>';
                        <?php
                            $sql10="SELECT * FROM offices";
                            $result10= mysqli_query($mysqli,$sql10); 
                            while ($row10 = mysqli_fetch_assoc($result10)){
                              ?>
                              <option  value= <?php echo $row10['office_id'].'>'.$row10['office_name']; ?></option>
                              <?php
                            }
                            ?>
                      </select>
                  </div>
                  </div>
                     <div class="col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Location:</label>
                    <input type="text" class="form-control dob1" name="location" value="<?php echo $row['location']; ?>" required="">
                  </div>
                   </div>
                    </div>

                    <div class="mb-3">
                    <label class="form-label">Estimated Cost:</label>
                    <input type="text" class="form-control" name="cost" value="<?php echo $row['cost']; ?>" required="">
                  </div>


                  <div class="mb-3">
                    <label class="form-label">Qty:</label>
                    <input type="text" class="form-control" name="qty" value="<?php echo $row['qty']; ?>" required="">
                  </div>

                 
                  <div class="mb-3">
                   <button type="Submit" name="Edit"  style="float: right;" class="btn btn-success">Edit</button>
                    </div>
                  
                </form>
                    <!-- <table width="70%" class="table table-hover table-condensed">
                        </table>  -->
                    <?php
                    if (isset($_POST['Edit'])) {
$asset_id = $_POST['asset_id'];
$cost = $_POST['cost'];
$location = $_POST['location'];
$office_id = $_POST['office_id'];
$purchase_date = $_POST['purchase_date'];
$condition_of_asset = $_POST['condition_of_asset'];
$tagno = $_POST['tagno'];
$serialno = $_POST['serialno'];
$asset_category_id = $_POST['asset_category_id'];
$description = $_POST['description'];
$qty = $_POST['qty'];

                      $SQL = mysqli_query($mysqli, "UPDATE assets SET cost='$cost',location='$location',office_id='$office_id',purchase_date='$purchase_date',condition_of_asset='$condition_of_asset',tagno='$tagno',serialno='$serialno',asset_category_id='$asset_category_id',description='$description',qty='$qty' WHERE asset_id=$asset_id");
                    ?>
                      <script type="text/javascript" language="javascript">
                        window.location = "assets.php";
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