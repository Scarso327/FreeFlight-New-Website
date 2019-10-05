	<?php	
		switch($_GET['section']) {
					
					default: ?>
						<main id="police" class="container">
							<div class="box articleB" style="margin-top: 10px;">
								<div class="breadcrumb ipsBreadcrumb_top">
									<a href="http://freeflightinteractive.co.uk/old/police.php">Dashboard</a>
									<span class="slashes">//</span>
									<a href="http://freeflightinteractive.co.uk/old/police.php"><?=$_SESSION['username'];?></a>
									<span class="slashes">//</span>
									<a class="active" href="http://freeflightinteractive.co.uk/old/police.php?page=settings">Settings</a>						
								</div>
								<div class="settingsMain">
									<div class="settingsHeader">
										<h1>Settings</h1>
										<div class="settingsInfo">
											Manage your account settings.
										</div>
									</div>
									<div>
										<div class="leftLayout leftLayout280">
											<div>
												<ul class="sidebar">
													<li>
														<a <?php if(!(isset($_GET['section']))) { ?> class="active" <?php } ?> href="http://freeflightinteractive.co.uk/old/police.php?page=settings"><i class="fa fa-tachometer"></i> Overview</a>
													</li>
													<li>
														<a <?php if(isset($_GET['section']) && $_GET['section'] == 'pw') { ?> class="active" <?php } ?>href="http://freeflightinteractive.co.uk/old/police.php?page=settings&section=pw"><i class="fa fa-key"></i> Password</a>
													</li>
												</ul>
											</div>
										</div>
										<div class="rightLayout rightLayoutPadding rightWidth80">
											<section>
												<?php
												if(isset($_GET['pwChange'])) {
													$sql_fetch_id = "SELECT Password FROM officers WHERE Username='".$_SESSION['username']."'";
													$query_id = mysqli_query($db,$sql_fetch_id);
													
													if ($query_id->num_rows > 0) {
														while($row = $query_id->fetch_assoc()) {
															$hash = $row['Password'];
														}
													} else {
														header("Location: http://freeflightinteractive.co.uk/old/police.php?page=settings&section=pw&msg=1A");
														exit;
													};
													
													if (password_verify($_GET['oldpwd'], $hash)) {
														if($_GET['newpwd'] != $_GET['rnewpwd']) {
															header("Location: http://freeflightinteractive.co.uk/old/police.php?page=settings&section=pw&msg=1B");
															exit;
														}
														$newPass = password_hash($_GET['newpwd'], PASSWORD_DEFAULT);
														
														$sql_fetch_id = "UPDATE officers SET Password='".$newPass."' WHERE Username='".$_SESSION['username']."'";
														$query_id = mysqli_query($db,$sql_fetch_id);
														
														header("Location: http://freeflightinteractive.co.uk/old/police.php?page=settings");
														exit;
													} else {
														header("Location: http://freeflightinteractive.co.uk/old/police.php?page=settings&section=pw&msg=1A");
														exit;
													}
												} else {
													switch($_GET['section']) {
														case "pw": ?>
																<?php
																if(isset($_GET['msg'])) {
																	switch($_GET['msg']) {
																		case "1A":
																			echo "<span style='color: red;'>You have entered incorrect information!</span>";
																			break;
																		case "1B":
																			echo "<span style='color: red;'>Your new passwords don't match!</span>";
																			break;
																	}
																}
																?>
															<form action="/police.php">
																<input type="text" name="page" value="settings" hidden>
																<input type="text" name="section" value="pw" hidden>
																<input type="text" name="pwChange" value="1" hidden>
																Current Password:<br>
																<input type="Password" name="oldpwd" value="" placeholder="Input Current Password...">
																<br>
																New Password:<br>
																<input type="Password" name="newpwd" value="" placeholder="Input New Password...">
																<br>
																Retype New Password:<br>
																<input type="Password" name="rnewpwd" value="" placeholder="Input Retype New Password...">
																<br><br>
																<input type="submit" value="Submit">
															</form> 
															<?php break;
														default: 
														
															break;
													}
												}
												
												?>
											</section>
										</div>
									</div>
								</div>
							</div>
						</main>
					<?php	break;
				}?>