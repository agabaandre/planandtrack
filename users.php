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
				<div class="card card-default">
					<div class="card-header">
						<div class="row">
							<div class="col-md-4">
								<h6><b>Users</b></h6>
							</div>

<div class="col-md-8">
	<?php 
		echo '<h6 style="float: right;">
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_item">+ New User</button>
</h6>'?>
<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="add_item">User Details</h4>
            </div>
            <div class="modal-body">
                <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-md-9">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Name *</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="name" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="Password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Retype Password</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="Password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Role</label>
                                    <div class="col-sm-12">
                                        <select name="role" class="form-control">
                                            <option value="">Select Role</option>
                                            <option value="admin_all">Admin</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">EPR</label>
                                    <div class="col-sm-12">
                                        <select name="EPR" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Executive Office</label>
                                    <div class="col-sm-12">
                                        <select name="EO" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">RCC</label>
                                    <div class="col-sm-12">
                                        <select name="RCC" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Laboratory Systems and Networks</label>
                                    <div class="col-sm-12">
                                        <select name="LAB" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">PHI & R</label>
                                    <div class="col-sm-12">
                                        <select name="PHI" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Policy,Health Diplomacy and Communication</label>
                                    <div class="col-sm-12">
                                        <select name="PHC" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Mgt & Admin</label>
                                    <div class="col-sm-12">
                                        <select name="ADMIN" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Surv and Disease Intel</label>
                                    <div class="col-sm-12">
                                        <select name="SDI" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-form-label">Disease Control and Prevention</label>
                                    <div class="col-sm-12">
                                        <select name="DCV" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
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
                    $name = $_POST['name'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $role = $_POST['role'];
                    $password = md5($_POST['password']);
                    $EPR = $_POST['EPR'];
                    $EO    = $_POST['EO'];
                    $RCC = $_POST['RCC'];
                    $LAB = $_POST['LAB'];
                    $PHI = $_POST['PHI'];
                    $PHC = $_POST['PHC'];
                    $ADMIN = $_POST['ADMIN'];
                    $SDI = $_POST['SDI'];
                    $DCV = $_POST['DCV'];
                    $result12 = mysqli_query($mysqli, "SELECT * FROM users WHERE username='" . $username . "' ");
                    $num = mysqli_num_rows($result12);
                    if ($num > 0) {
                ?>
                        <script language="javascript" type="text/javascript">
                            alert("User Already Existis");
                            window.location = "users.php";
                        </script>
                    <?php
                    } else {
                        $SQL = mysqli_query($mysqli, "INSERT INTO users (`name`,`username`,`password`,`role`,`EPR`,`EO`,`RCC`,`LAB`,`PHI`,`PHC`,`ADMIN`,`SDI`,`DCV`) VALUES ('$name','$username','$password','$role','$EPR','$EO','$RCC','$LAB','$PHI','$PHC','$ADMIN','$SDI','$DCV' )");
                    ?>
                        <script type="text/javascript" language="javascript">
                            window.location = "users.php";
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
                <th>Username</th>
                <th>Role</th>
                <th>EPR</th>
                <th>Executive Office</th>
                <th>RCC</th>
                <th>Lab Systems & Networks</th>
                <th>PHI & R</th>
                <th>Policy,Health Diplomacy and Communication</th>
                <th>Mgt & Admin</th>
                <th>Surv and Disease Intel</th>
                <th>Disease Control and Prevention</th>
                <th>Action</th>
        </thead>
<tbody>
	 <?php
            $result = mysqli_query($mysqli, "SELECT * FROM users WHERE  flag=1");
            $counter = mysqli_num_rows($result);
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $count . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>" . $row['EPR'] . "</td>";
                echo "<td>" . $row['EO'] . "</td>";
                echo "<td>" . $row['RCC'] . "</td>";
                echo "<td>" . $row['LAB'] . "</td>";
                echo "<td>" . $row['PHI'] . "</td>";
                echo "<td>" . $row['PHC'] . "</td>";
                echo "<td>" . $row['ADMIN'] . "</td>";
                echo "<td>" . $row['SDI'] . "</td>";
                echo "<td>" . $row['DCV'] . "</td>";
                echo "<td>";
                $count++;
                echo '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['user_id'].'">Edit</a>';
                echo '<div class="modal fade" id="edit_user' . $row['user_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
    <div class="modal-content">
    <div class="modal-header"  style="background-color: #629aa9;color:#fff">
    <h5 class="modal-title" id="edit_user' . $row['user_id'] . 'Label">Edit User Details  For  ' . $row['name'] . ' </h5>
    </div>
    <div class="modal-body">';
            ?>
                <form method="post" name="contact" class="registerForm">
                    <table  class="table table-hover table-condensed">
                        <tbody>
                            <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="user_id1" value="<?php echo $row['user_id']; ?>">
                            </tr>
                            <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="current_pwd" value="<?php echo $row['password']; ?>">
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="name"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <div class="form-group" style="height: 2em"><input type="text" class="form-control" value="<?php echo $row['username']; ?>" name="username" id="business_phone1"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <div class="form-group"><input type="password" class="form-control" name="password"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>
                                    <div class="form-group">
                                        <select name="role" class="form-control">
                                            <option selected value="<?php echo $row['role']; ?>"><?php echo $row['role']; ?></option>
                                            <option value="admin_all">Admin</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>EPR</td>
                                <td>
                                    <div class="form-group">
                                        <select name="EPR" class="form-control">
                                            <option selected value="<?php echo $row['EPR']; ?>"><?php echo $row['EPR']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Executive Office</td>
                                <td>
                                    <div class="form-group">
                                        <select name="EO" class="form-control">
                                            <option selected value="<?php echo $row['EO']; ?>"><?php echo $row['EO']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>RCC</td>
                                <td>
                                    <div class="form-group">
                                        <select name="RCC" class="form-control">
                                            <option selected value="<?php echo $row['RCC']; ?>"><?php echo $row['RCC']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Laboratory Systems and Networks</td>
                                <td>
                                    <div class="form-group">
                                        <select name="LAB" class="form-control">
                                            <option selected value="<?php echo $row['LAB']; ?>"><?php echo $row['LAB']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PHI & R</td>
                                <td>
                                    <div class="form-group">
                                        <select name="PHI" class="form-control">
                                            <option selected value="<?php echo $row['PHI']; ?>"><?php echo $row['PHI']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Policy,Health Diplomacy and Communication</td>
                                <td>
                                    <div class="form-group">
                                        <select name="PHC" class="form-control">
                                            <option selected value="<?php echo $row['PHC']; ?>"><?php echo $row['PHC']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Mgt & Admin</td>
                                <td>
                                    <div class="form-group">
                                        <select name="ADMIN" class="form-control">
                                            <option selected value="<?php echo $row['ADMIN']; ?>"><?php echo $row['ADMIN']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Surv and Disease Intel</td>
                                <td>
                                    <div class="form-group">
                                        <select name="SDI" class="form-control">
                                            <option selected value="<?php echo $row['SDI']; ?>"><?php echo $row['SDI']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Disease Control and Prevention</td>
                                <td>
                                    <div class="form-group">
                                        <select name="DCV" class="form-control">
                                            <option selected value="<?php echo $row['DCV']; ?>"><?php echo $row['DCV']; ?></option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
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
                        $name = $_POST['name'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        if ($current_pwd == $password) {
                            $password = $_POST['password'];
                        } else {
                            $password = md5($_POST['password']);
                        }
                        $role = $_POST['role'];
                        $user_id1 = $_POST['user_id1'];
                        $EPR = $_POST['EPR'];
                        $EO    = $_POST['EO'];
                        $RCC = $_POST['RCC'];
                        $LAB = $_POST['LAB'];
                        $PHI = $_POST['PHI'];
                        $PHC = $_POST['PHC'];
                        $ADMIN = $_POST['ADMIN'];
                        $SDI = $_POST['SDI'];
                        $DCV = $_POST['DCV'];
                        $SQL = mysqli_query($mysqli, "UPDATE  users SET name='$name',username='$username',password='$password',role='$role',EPR='$EPR',EO='$EO',RCC='$RCC',LAB='$LAB',PHI='$PHI',PHC='$PHC',ADMIN='$ADMIN',SDI='$SDI',DCV='$DCV' WHERE user_id=$user_id1");
                    ?>
                        <script type="text/javascript" language="javascript">
                            window.location = "users.php";
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
                echo '<a data-toggle="modal" data-target="#delete' . $row['user_id'] . '"><i style="color:red"  class="fa fa-trash fa-2x"></i></a>';
                echo '<div class="modal fade" id="delete' . $row['user_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header" style="background-color: #d9534f;color:#fff">
    <h4 class="modal-title" id="delete' . $row['user_id'] . 'Label">Delete User Details  For  ' . $row['name'] . ' </h4>
    </div>
    <div class="modal-body">';
                ?>
                <form method="post" name="contact" class="registerForm">
                    <table width="70%" class="table table-hover table-condensed">
                        <tbody>
                            <tr>
                                <!--<td>User Id </td>-->
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="name" id="full_name" readonly></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['username']; ?>" name="username" id="business_phone1" readonly></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="role" value="<?php echo $row['role']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><button class="btn btn-danger btn-lg" type="submit" name="Delete">Delete User</button>
                                    <!--<button class="btn btn-danger" type="reset">Reset</button>-->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    if (isset($_POST['Delete'])) {
                        $user_id = $_POST['user_id'];
                        $SQL = mysqli_query($mysqli, "UPDATE  users set flag=0 WHERE user_id=$user_id");
                    ?>
                        <script type="text/javascript" language="javascript">
                            window.location = "users.php";
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
                <?php echo  '</div>'; ?>
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