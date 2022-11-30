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
                                <h6><b>Categories</b></h6>
                            </div>

                            <div class="col-md-8">
                                <?php 
                                    echo '<h6 style="float: right;">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_item">+ New Category</button>
                        </h6>'?>
                        <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="add_item">Categories Details</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form class="registerForm" name="frmSample" method="post" enctype="multipart/form-data" autocomplete="off">
                                                <div class="col-md-9">
                                                    <div class="ibox">
                                                        <div class="ibox-body">
                                                            <div class="form-group">
                                                                <label class="col-sm-4 col-form-label">Name *</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text" name="category_name" required="">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
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
                                            <?php
                                            if (isset($_POST['Save'])) {
                                                $category_name = $_POST['category_name'];

                                                $result12 = mysqli_query($mysqli, "SELECT * FROM asset_categories WHERE category_name='" .$category_name. "' ");
                                                $num = mysqli_num_rows($result12);
                                                if ($num > 0) {
                                            ?>
                                                    <script language="javascript" type="text/javascript">
                                                        alert("Ofice Already Existis");
                                                        window.location = "Categories.php";
                                                    </script>
                                                <?php
                                                } else {
                                                    $SQL = mysqli_query($mysqli, "INSERT INTO asset_categories (`category_name`) VALUES ('$category_name' )");
                                                ?>
                                                    <script type="text/javascript" language="javascript">
                                                        window.location = "Categories.php";
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
                                                <th>Edit</th>
                                        </thead>
                                <tbody>
                                     <?php
                                            $result = mysqli_query($mysqli, "SELECT * FROM asset_categories");
                                            $counter = mysqli_num_rows($result);
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $count . "</td>";
                                                echo "<td>" . $row['category_name'] . "</td>";
                                                echo "<td>";
                                                $count++;
                                                echo '<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user'.$row['asset_category_id'].'">Edit</a>';
                                                echo '<div class="modal fade" id="edit_user' . $row['asset_category_id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" >
                                    <div class="modal-content">
                                    <div class="modal-header"  style="background-color: #629aa9;color:#fff">
                                    <h6 class="modal-title" id="edit_user' . $row['asset_category_id'] . 'Label" style="color:#fff">Edit Categories</h6>
                                    </div>
                                    <div class="modal-body">';
                                            ?>
                                                <form method="post" name="contact" class="registerForm">
                                                    <table  class="table table-hover table-condensed">
                                                        <tbody>
                                                            <tr>
                                                                <!--<td>User Id </td>-->
                                                                <input type="hidden" name="asset_category_id" value="<?php echo $row['asset_category_id']; ?>">
                                                            </tr>
                                                          
                                                            <tr>
                                                                <td>Name</td>
                                                                <td>
                                                                    <div class="form-group"><input type="text" class="form-control" value="<?php echo $row['category_name']; ?>" name="category_name"></div>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td><button class="btn btn-success" type="submit" name="Edit">Save </button>
                                                                    <!--<button class="btn btn-danger" type="reset">Reset</button>-->
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                    if (isset($_POST['Edit'])) {
                                                        $asset_category_id = $_POST['asset_category_id'];
                                                        $category_name = $_POST['category_name'];

                                                        $SQL = mysqli_query($mysqli, "UPDATE asset_categories SET category_name='$category_name' WHERE asset_category_id=$asset_category_id");
                                                    ?>
                                                        <script type="text/javascript" language="javascript">
                                                            window.location = "Categories.php";
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
                                                echo  "</td>"; ?>
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