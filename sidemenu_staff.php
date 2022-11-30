<nav class="navbar navbar-expand-xl w-100">
				<ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
					  <a href="dashboard.php" class="nav-link <?php echo activelink('dashboard', $uri_segment) ?>">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title ">Dashboard</div>
                    </a>
                    
					<li class="nav-item dropdown">
                        <a href="budget.php" class="nav-link <?php echo activelink('budget', $uri_segment) ?>">
                            <div class="parent-icon"><i class="bx bx-category"></i>
                            </div>
                            <div class="menu-title">Plan/Track/Report</div>
                        </a>
                    </li>
					 <li class="nav-item dropdown">
                        <a href="locator.php" class="nav-link <?php echo activelink('locator', $uri_segment) ?>">
                            <div class="parent-icon"><i class='bx bx-cart'></i>
                            </div>
                            <div class="menu-title">Staff Locator</div>
                        </a>
                    </li>
					  

                   

					
					<li class="nav-item dropdown">
                        <a href="change_password.php" class="nav-link <?php echo activelink('change_password', $uri_segment) ?>">
                            <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                            </div>
                            <div class="menu-title">Change Password</div>
                        </a>

                    </li>
					
					
					  
				  </ul>
			</nav>