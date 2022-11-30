<?php session_start();
 include('connect.php');

 include('header.php');


?>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card rounded-4">
							<div class="card-body">
								<div class="border p-4 rounded-4">
									<div class="text-center">
										<img src="images/africacdc_2.png" width="250" alt="" />
										<p class="mb-4">Please login before enter the page</p>
									</div>
									
									<div class="form-body">
                                        <form class="row g-3" id="login-form" method="post">

											<div class="col-12">
												<input type="text" class="form-control rounded-5" name="username" placeholder="Username" autocomplete="off" focus>
											</div>
											<div class="col-12">
												
												<input  class="form-control rounded-5" type="password" name="password" placeholder="Enter Password">
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
													<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div>
										<!--	<div class="col-md-6 text-end">
												<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div> -->
											<div class="col-12">
												<div class="d-grid">
													<button class="btn btn-gradient-info rounded-5" type="submit" name="Submit"><i class="bx bxs-lock-open"></i>Sign in</button>
												</div>
											</div>
											
											
											
										</form>
                                        
                                        <?php
                if (isset($_POST['Submit'])) {
                    
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username='" . $username . "' AND password='" . md5($password) . "' AND flag=1");
                    
                    
                $row = mysqli_fetch_assoc($result);  
                    if ($row['username'] == $username & $row['password'] == md5($password)) {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['name'] = $row['name'];
                        $access = array();
                        if ($row['EPR'] == 'Yes') {
                            $access[0] = 1;
                        }
                        if ($row['EO'] == 'Yes') {
                            $access[1] = 2;
                        }
                        if ($row['RCC'] == 'Yes') {
                            $access[2] = 3;
                        }
                        if ($row['LAB'] == 'Yes') {
                            $access[3] = 4;
                        }
                        if ($row['PHI'] == 'Yes') {
                            $access[4] = 5;
                        }
                        if ($row['PHC'] == 'Yes') {
                            $access[5] = 6;
                        }
                        if ($row['ADMIN'] == 'Yes') {
                            $access[6] = 7;
                        }
                        if ($row['SDI'] == 'Yes') {
                            $access[7] = 8;
                        }
                        if ($row['DCV'] == 'Yes') {
                            $access[8] = 9;
                        }
                        $_SESSION['access'] = $access;
                        $user_id  = $row['user_id'];
                        $date_loged_in = date("Y-m-d");
                        $time_loged_in = date("H:i:s");
                        $SQL = mysqli_query($mysqli, "INSERT INTO user_log (`user_id`,`date_loged_in`,`time_loged_in`) VALUES ('$user_id','$date_loged_in','$time_loged_in')");
                ?>
                        <script type="text/javascript" language="JavaScript">
                            window.location = "dashboard.php";
                        </script>
                    <?php
                    } else {
                    ?>
                        <script type="text/javascript" language="JavaScript">
                            alert("WRONG USERNAME OR PASSWORD");
                            window.location = "index.php";
                        </script>
                <?php
                    }
                }
                ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>