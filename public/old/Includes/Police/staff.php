<main id="police" class="container">
						<?php
						if($isAdmin == 1) {?>
						<div class="box articleB" style="margin-top: 10px;">
							<div class="breadcrumb ipsBreadcrumb_top">
								<a href="http://freeflightinteractive.co.uk/old/police.php">Dashboard</a>
								<span class="slashes">//</span>
								<a class="active" href="http://freeflightinteractive.co.uk/old/police.php?page=staff">Staff Panel</a>	
							</div>
							<div class="pageHeader">
								<h1>Staff Panel</h1>
							</div>
							<div class="innerBox">
								<p>This is the staff panel. It is used to manage members of the police force and any other aspects we allow to be edited by senior command through this panel.</p>
							</div>
							<div class="AreaSection innerBox">
								<?php
								if(!(isset($_GET['section']))) {
								?>
								<div class="rightLayoutPadding">
									<h2>Staff Overview</h2>
								</div>
								<?php
								} else {
									switch($_GET['section']) {
										case "officers": 
											if(isset($_GET['officer']) && !(isset($_GET['doInterview']))) {
												if(isset($_GET['viewForm'])) { 
													$sql_fetch_id = "SELECT * FROM forms WHERE id='".$_GET['viewForm']."' and pid='".$_GET['officer']."'";
													$query_id = mysqli_query($db,$sql_fetch_id);
																
													if ($query_id->num_rows > 0) {
														$sql_fetch_id2 = "SELECT * FROM officers WHERE pid='".$_GET['officer']."'";
														$query_id2 = mysqli_query($db,$sql_fetch_id2);
														if ($query_id2->num_rows > 0) {
															while($row = $query_id2->fetch_assoc()) {
																$officerName = $row['Username'];
															}
															while($row = $query_id->fetch_assoc()) { ?>
															<div class="rightLayoutPadding">
																<h2>Viewing Form: <?=$row['id'];?> Submitted By <?=$officerName;?></h2>
															</div>
															<div class="articleList" id="formList">
																<br>
															<?php
																switch($row['form']) {
																	case "CSOPCSOTimeSheet": 
																		?>
																		<h3>Date of activity</h3>
																		<input type="date" value="<?=$row['Date'];?>"name="date" readonly>
																		<h5>This is the date at which you entered you were on-duty.</h5><br>
																		<h3>Duty Time</h3>
																		<input type="text" value="<?=$row['TotalTime'];?>"name="timeStart" readonly>
																		<h5>Your total time on duty. (HH:MM:SS)</h5><br>
																		<h3>Officer's you partoled with</h3>
																		<input type="text" value="<?=$row['OfficersPatroling'];?>" name="Officers" readonly>
																		<h5>Here is the names of the officers you said partoled with you.</h5><br>
																		<h3>Notes</h3>
																		<textarea readonly name="notes" rows="5" style="width:100%; resize: vertical; overflow-y: scroll; overflow-x: hidden; "><?=$row['Notes'];?></textarea>
																		<h5>Here are your notes.</h5><br>
																	<?php break;
																	case "NPASTimeSheet":
																		?>
																		<h3>Date of activity</h3>
																		<input type="date" value="<?=$row['Date'];?>" name="date" readonly>
																		<h5>Here we require to know the date at which you were on duty.</h5><br>
																		<h3>Duty Time</h3>
																		<input type="text" value="<?=$row['TotalTime'];?>"name="timeStart" readonly>
																		<h5>Your total time on duty. (HH:MM:SS)</h5><br>
																		<h3>Aircraft</h3>
																		<input type="text" value="<?=$row['Aircraft'];?>" name="Aircraft" readonly>
																		<h5>This is the aircraft you selected.</h5><br>
																		<h3>Name of your Co-Pilot</h3>
																		<input type="text" value="<?=$row['OfficersPatroling'];?>" name="Officers" readonly>
																		<h5>This is the Co-Pilot you selected.</h5><br>
																		<h3>Notes</h3>
																		<textarea readonly name="notes" rows="5" style="width:100%; resize: vertical; overflow-y: scroll; overflow-x: hidden; "><?=$row['Notes'];?></textarea>
																		<h5>Any extra notes you may have added.</h5>
																		<?php break;
																	case "MPUTimeSheet":
																		?>
																		<h3>Date of activity</h3>
																		<input type="date" value="<?=$row['Date'];?>" name="date" readonly>
																		<h5>Here we require to know the date at which you were on duty.</h5><br>
																		<h3>Duty Time</h3>
																		<input type="text" value="<?=$row['TotalTime'];?>"name="timeStart" readonly>
																		<h5>Your total time on duty. (HH:MM:SS)</h5><br>
																		<h3>Boat</h3>
																		<input type="text" value="<?=$row['Aircraft'];?>" name="Aircraft" readonly>
																		<h5>This is the boat you selected.</h5><br>
																		<h3>Name of your Co-Pilot</h3>
																		<input type="text" value="<?=$row['OfficersPatroling'];?>" name="Officers" readonly>
																		<h5>This is the the MPU Officers you selected.</h5><br>
																		<h3>Notes</h3>
																		<textarea readonly name="notes" rows="5" style="width:100%; resize: vertical; overflow-y: scroll; overflow-x: hidden; "><?=$row['Notes'];?></textarea>
																		<h5>Any extra notes you may have added.</h5>
																		<?php break;
																	case "SFUTimeSheet":
																		echo "SFU Time Sheet";
																		break;
																	case "NCUTimeSheet":
																		echo "NCU Time Sheet";
																		break;
																	case "CSOPSCORecommendation":
																		echo "CSO/PCSO Recommendation Sheet";
																		break;
																	case "PCSPCRecommendation":
																		echo "PC/SPC Recommendation Sheet";
																		break;
																	case "JuniorCommandRecommendation":
																		echo "Junior Command Recommendation Sheet";
																		break;
																	case "NPASDamageReport":
																		echo "NPAS Damage Report";
																		break;
																	case "LeaveofAbsenseForm":
																		echo "Leave of Absense Form";
																		break;
																	case "ResignationForm":
																		echo "Resignation Form";
																		break;
																	default:
																		echo "Unknown Form Type";
																		break;
																}
															} 
														} ?>
														</div>
														<?php
													}
												} else {
													$sql_fetch_id = "SELECT * FROM officers WHERE pid='".$_GET['officer']."'";
													$query_id = mysqli_query($db,$sql_fetch_id);
														
													if ($query_id->num_rows > 0) {
														while($row = $query_id->fetch_assoc()) {
															?>
																<?php
																$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=4C05220E7DC9A7C562CB5277B7AE5280&steamids=".$_GET['officer'];
																$ch = curl_init();
																curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
																curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
																curl_setopt($ch, CURLOPT_URL,$apifr);
																$url = curl_exec($ch);
																curl_close($ch);
																$content = json_decode($url, true);
																
																$_SESSION['officer_avatarfull'] = $content['response']['players'][0]['avatarfull'];
																
																if($row['isInterviewed'] != 1) {
																	if($isInterviewer == 1) {
																?>
																	<center>
																		<div style="width: 100%; height: 35px; background-color: #d9534f;">Requires Interview<br><a href="http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&doInterview&officer=<?=$_GET['officer'];?>" style="text-decoration: none;">Do Interview</a></div>
																	</center>
																<?php
																	} else {
																?>
																	<center>
																		<div style="width: 100%; height: 25px; line-height: 1.6; background-color: #d9534f;">Requires Interview</div>
																	</center>
																<?php
																	}
																}
																?>
																<div class="articleList">
																	<a class="">
																		<div class="listThumbnail">
																			<div class="thumbnail" style="background-image: url(<?=$_SESSION['officer_avatarfull'];?>);"></div>
																		</div>
																		<div class="listInfo" style="top: -125;">
																			<span>Added To PNC: <?=$row['TimeAdded'];?></span>
																			<h3><?=$row['Username'];?></h3>
																			<p><?=grabRank($row['pid'], "Abr", false, true);?></p>
																		</div>
																	</a>
																</div>
																<div class="tab">
																  <button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab1") { ?> id="defaultOpen" <?php } } else { ?> id="defaultOpen" <?php } ?> class="tablinks" onclick="changeTab(event, 'Tab1', 'officerProfile')">Profile</button>
																  <button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab2") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab2', 'officerProfile')">Submitted Forms</button>
																</div>
																<div id="Tab1" class="tabcontent">
																	<div class="SideAreaSection innerBox" style="float: left; background-color: #1B1B1B;">
																		<h2>Duty Time (HH:MM)</h2>
																		<p>Recorded: <?php 
																		$sql_fetch_id2 = "SELECT TotalTime FROM forms WHERE pid='".$row['pid']."'";
																		$query_id2 = mysqli_query($db,$sql_fetch_id2);
																		
																		$alltimes = [];
																		if ($query_id2->num_rows > 0) {
																			while($reportedTime = $query_id2->fetch_assoc()) { 
																				
																				$alltimes[] = date('H:i', strtotime($reportedTime['TotalTime']));
																			}
																			$finalTime = date('H:i', strtotime("00:00"));
																			foreach ($alltimes as $value) {
																				$finalTime = addTwoTimes($finalTime, $value);
																			}
																			echo $finalTime;
																		} else {
																			echo "00:00";
																		}
																		?> 
																		<br>
																		Actual: <?=getPlayTime($row['pid']);?></p>
																	</div>
																	<div class="AreaSection innerBox" style="float: right; background-color: #1B1B1B;">
																		test
																	</div>
																</div>
																<div id="Tab2" class="tabcontent">
																	<form class="selectOptionsPolice" id="formTypes" action="" style="top: 223; right: 5;">
																		<select name="articleOptions" onchange="changeFormType(this.value,'Tab2')">
																			<option value="All">All</option>
																			<option value="TimeSheet">Time Sheets</option>
																			<option value="Recommendations">Recommendations</option>
																			<option value="Other">Other</option>
																		</select>
																	</form>
																	<div class="articleList" id="formListPAST">
																		<?php
																		// Getting the list!
																		$sql_fetch_id = "SELECT * FROM forms WHERE pid='".$_GET['officer']."' ORDER BY ID DESC";
																		$query_id = mysqli_query($db,$sql_fetch_id);
																					
																		if ($query_id->num_rows > 0) {
																			while($row = $query_id->fetch_assoc()) {?>
																				<div class="<?=$row['formType'];?>">
																					<a id="<?=$row['formType'];?>" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&officer=76561198092567307&viewForm=<?=$row['id'];?>">
																						<div class="listThumbnail">
																							<div class="thumbnail" style="background-image: url();"></div>
																						</div>
																						<div class="listInfo">
																							<span>
																							<?php
																							echo "Date Submitted: ".$row['Date']."";
																							?>
																							</span>
																							<h3>
																							<?php
																							
																							switch($row['form']) {
																								case "CSOPCSOTimeSheet":
																									echo "CSO/PSCO Time Sheet";
																									break;
																								case "NPASTimeSheet":
																									echo "NPAS Time Sheet";
																									break;
																								case "MPUTimeSheet":
																									echo "MPU Time Sheet";
																									break;
																								case "SFUTimeSheet":
																									echo "SFU Time Sheet";
																									break;
																								case "NCUTimeSheet":
																									echo "NCU Time Sheet";
																									break;
																								case "CSOPSCORecommendation":
																									echo "CSO/PCSO Recommendation Sheet";
																									break;
																								case "PCSPCRecommendation":
																									echo "PC/SPC Recommendation Sheet";
																									break;
																								case "JuniorCommandRecommendation":
																									echo "Junior Command Recommendation Sheet";
																									break;
																								case "NPASDamageReport":
																									echo "NPAS Damage Report";
																									break;
																								case "LeaveofAbsenseForm":
																									echo "Leave of Absense Form";
																									break;
																								case "ResignationForm":
																									echo "Resignation Form";
																									break;
																								default:
																									echo "Unknown Form";
																									break;
																							}
																							
																							?>
																							</h3>
																							<p>
																							<?php
																							
																							switch($row['form']) {
																								case "CSOPCSOTimeSheet":
																									echo "Duty Time: ".$row['TotalTime']."";
																									break;
																								case "NPASTimeSheet":
																									echo "Duty Time: ".$row['TotalTime']."";
																									break;
																								case "MPUTimeSheet":
																									echo "Duty Time: ".$row['TotalTime']."";
																									break;
																								case "SFUTimeSheet":
																									echo "Duty Time: ".$row['TotalTime']."";
																									break;
																								case "NCUTimeSheet":
																									echo "Duty Time: ".$row['TotalTime']."";
																									break;
																								case "CSOPSCORecommendation":
																									echo "Recommended: ";
																									break;
																								case "PCSPCRecommendation":
																									echo "Recommended: ";
																									break;
																								case "JuniorCommandRecommendation":
																									echo "Recommended: ";
																									break;
																								case "NPASDamageReport":
																									echo "Aircraft: ";
																									break;
																							}
																							
																							?>
																							</p>
																						</div>
																					</a>
																				</div>
																		<?php }
																		}
																		?>
																	</div>
																</div>
															<?php
															}
														}
													}
											} else { 
											if(isset($_GET['doInterview'])) {
														$sql_fetch_id = "SELECT * FROM officers WHERE pid='".$_GET['officer']."'";
														$query_id = mysqli_query($db,$sql_fetch_id);
															
														if ($query_id->num_rows > 0) {
															while($row = $query_id->fetch_assoc()) {
																if($row['isInterviewed'] != 1) {
																	$interviewed = false;
																} else {
																	$interviewed = true;
																}
															}		
														}
														if($interviewed == false) {
															if($isInterviewer == 1) { ?>
																<div class="interviewSheet">
																	<center>
																		<h1 class="title">Police Training Academy - Interview</h1>
																		<span class="warning">This document must never be given out to anyone outside the Police Training Academy.</span>
																		<table style="margin-top: 10px; font-size: 14px;">
																		  <tr>
																			<th style="width: 20%;"><span>Username</span></th>
																			<th style="width: 25%;"><input type="text" value="Test" readonly style="height: 100%; width: 100%;"></th>
																			<th style="width: 25%;"><span>This username <b>must</b> be the same in-game as it is on TeamSpeak</span></th>
																			<th style="width: 12%;"><span>Interview Date:</span></th>
																			<th style="width: 12%;"><input type="date" value=""></th>
																		  </tr>
																		  <tr>
																			<th style="width: inherit;"><span>Player ID</span></th>
																			<th style="width: inherit;"><input type="text" value="pid" readonly style="height: 100%; width: 100%;"></th>
																			<th style="width: inherit;"><span>This can be found on the user's in-game, ArmA 3, profile</span></th>
																			<th style="width: inherit;"><span>Identification:</span></th>
																			<th style="width: inherit;"><input type="text" value=""></th>
																		  </tr>
																		<tr>
																		<th style="width: inherit;"><span>Requested Department</span></th>
																		<th style="width: inherit;"><input type="text" value="SFU" readonly style="height: 100%; width: 100%;"></th>
																		<th style="width: inherit;"><span>Make a note here on the department the candidate is aiming to join</span></th>
																				  </tr>
																				  <tr>
																					<th style="width: inherit;"><span>Police Interviewer</span></th>
																					<th style="width: inherit;"><input type="text" value="pid" readonly style="height: 100%; width: 100%;"></th>
																					<th style="width: inherit;"><span>Please select your name from the dropdown.</span></th>
																				  </tr>
																				  <tr>
																					<th style="width: inherit;"><span>Forum Application</span></th>
																					<th style="width: inherit;"><input type="text" value="pid" readonly style="height: 100%; width: 100%;"></th>
																				  </tr>
																				</table><br>
																				<h2 style="text-align: left; font-size: 18px; border: 0px;">Questions that have a green score box are ones which are scored.</h2><br>
																				<h2 style="text-align: left; font-size: 18px; border: 0px;">Green Zone          > A score above 75. Instant pass granted.</h2>
																				<h2 style="text-align: left; font-size: 18px; border: 0px;">Orange Zone         > A score between 50 and 75. Extended review is required.</h2>
																				<h2 style="text-align: left; font-size: 18px; border: 0px;">Red Zone            > A score below 50. Instant failure issued.</h2><br>
																				<table>
																				  <tr>
																					<th>Question</th>
																					<th>Notes (Record response here)</th>
																					<th>Textbook Answer</th>
																					<th>Score Issued</th>
																					<th>Maximum Score</th>
																				  </tr>
																				  <tr>
																					<td></td>
																					<td></td>
																					<td></td>
																					<td></td>
																					<td></td>
																				  </tr>
																				</table><br>
																				<table>
																				  <tr>
																					<th>Attitude in general?</th>
																					<th></th>
																					<th>Deduct 1 Mark for a negative attitude.</th>
																					<th>0</th>
																					<th>0</th>
																				  </tr>
																				  <tr>
																					<th>Microphone Quality?</td>
																					<th></td>
																					<th>Deduct 1 Mark for a poor microphone.</td>
																					<th>0</td>
																					<th>0</td>
																				  </tr>
																				  <tr>
																					<th>Overall Personality?</th>
																					<th></th>
																					<th>Deduct 1 Mark for a negative personality.</th>
																					<th>0</th>
																					<th>0</th>
																				  </tr>
																				</table><br>
																				<div class="totalscore">
																				
																				</div>
																			</center>
																		</div>
																	<?php } else {
																		echo "Only qualified officers have permission to interview other officers.";
																	}
																} else {
																	echo "Interview already completed and passed for this officer";
																}
											} else {?>
											<div class="rightLayoutPadding">
												<form class="selectOptionsPolice" action="" style="top: 0; right: 5;">
													<select name="articleOptions" onChange="changeNews();">
														<option value="All">All Officers</option>
														<option value="Kavala">Kavala Officers</option>
														<option value="Athira">Athira Officers</option>
														<option value="Pygros">Pygros Officers</option>
														<option value="MPU">NPAS Pilots</option>
														<option value="MPU">MPU Officers</option>
														<option value="MPU">NCU Officers</option>
														<option value="SFU">SFU Officers</option>
													</select>
													<br><br>
												</form>
												<h2>Officers</h2>
											</div>
											<div class="articleList">
											<?php
											if (isset($_GET["pageNumber"])) { 
												if($_GET["pageNumber"] != 0 && $_GET["pageNumber"] != "") {
													$page  = $_GET["pageNumber"]; 
												} else {
													$page=1; 
												}
											} else { 
												Header ("Location: http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&pageNumber=1");
											}; 
												
											$results_per_page = 10;
												
											$start_from = ($page-1) * $results_per_page;
											$sql_fetch_id = "SELECT * FROM officers ORDER BY ID ASC LIMIT ".$start_from.", ".$results_per_page;
											$query_id_users = mysqli_query($db,$sql_fetch_id);
												
											if(mysqli_num_rows($query_id_users) > 0) {
												while($row = $query_id_users->fetch_assoc()) {
													$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=4C05220E7DC9A7C562CB5277B7AE5280&steamids=".$row['pid'];
													$ch = curl_init();
													curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
													curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
													curl_setopt($ch, CURLOPT_URL,$apifr);
													$url = curl_exec($ch);
													curl_close($ch);
													$content = json_decode($url, true);
													
													$_SESSION['steamlist_avatarfull'] = $content['response']['players'][0]['avatarfull'];
											?>
												<a class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&officer=<?=$row['pid'];?>">
													<div class="listThumbnail">
														<div class="thumbnail" style="background-image: url(<?=$_SESSION['steamlist_avatarfull'];?>);"></div>
													</div>
													<div class="listInfo">
														<span></span>
														<h3><?=$row['Username'];?></h3>
														<p><?=grabRank($row['pid'], "Abr", false, true);?></p>
													</div>
												</a>	
											<?php
												}
											} else { ?>
												<div class="updateNull">
													<br>
													<center>
														<h3>No Officers Found</h3>
													</center>
												</div>
											<?php
											}
											?>
										</div>
										<div class="pageList">
										<?php 
											$sql = "SELECT COUNT(id) AS total FROM officers";
											
											$query_id_users = mysqli_query($db,$sql);
																
											if(mysqli_num_rows($query_id_users) > 0) {
												$row = $query_id_users->fetch_assoc();
												$total_pages = ceil($row["total"] / $results_per_page); 

												$page = $_GET["pageNumber"] - 1; 
												if($page < 1) {
													$page = 1;
												}
												?> 
												<a href='http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&pageNumber=<?=$page;?>'><<</a>
												<?php 
												for ($i=1; $i<=$total_pages; $i++) {  
															echo "<a href='http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&pageNumber=".$i."'";
															if ($i==$_GET["pageNumber"])  echo " class='selected'";
															echo ">".$i."</a> "; 
												}; 
												$page = $_GET["pageNumber"] + 1; 
												if($page == $total_pages || $page > $total_pages) {
													$page = $total_pages;
												}
												?> 
												<a href='http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers&pageNumber=<?=$page;?>'>>></a>
												<?php 
											}
											?>
										</div>
										<?php }
										}
										break;
										case "addOfficer": 
											if(isset($_GET['create'])) {
												if($isInterviewer == 1) {
													$pass = password_hash($_GET['uid'], PASSWORD_BCRYPT);
													$sql_fetch_id = "INSERT INTO officers (pid, Username, Password) VALUES ('".$_GET['uid']."', '".$_GET['name']."', '".$pass."')";
													$query_id = mysqli_query($db,$sql_fetch_id);
													
													$servername = "localhost";
													$username = "root";
													$password = "";
													$dbname = "freeflightdata";
																	
													$dbRank = new mysqli($servername, $username, $password, $dbname);

													if ($dbRank->connect_error) {
														die("Connection failed: " . $dbRank->connect_error);
													}
														
													$sql_fetch_id2 = "UPDATE players SET coplevel='1' WHERE pid='".$_GET['uid']."'";
													$query_id2 = mysqli_query($dbRank,$sql_fetch_id2);
													mysqli_close($dbRank);
													
													if($query_id == true && $query_id2 == true) {
														header("Location: http://freeflightinteractive.co.uk/old/police.php?page=staff&section=addOfficer");
														die();
													} else {
														echo "Error updating record: " . $db->error;
														die();
													}
												} else {
													echo "Only qualified officers have permission to add new officers.";
												}
											} else {
												if($isInterviewer == 1) { ?>
													<div class="rightLayoutPadding">
														<h2>Add Officer</h2>
													</div>
													<p>You can use this page to add an officer to the database. Make sure all information is correct. Remember, the password will be the officer's UID, what sure they change this. We will fill out their interview information later etc.</p>
													<form action="" method="GET">
														<input type="text" name="page" value="staff" hidden>
														<input type="text" name="section" value="addOfficer" hidden>
														<input type="text" name="create" value="True" hidden>
														Officer's Name:<br>
														<input type="text" name="name" value="" placeholder="Input Officer's Name...">
														<br>
														Officer's UID:<br>
														<input type="text" name="uid" value="" placeholder="Input UID...">
														<br><br>
														<input type="submit" value="Submit">
													</form> 
													<?php } else {
													echo "Only qualified officers have permission to add new officers.";
												}
										}
										break;
										default:
											echo "Section Not Found 404";
											break;
									}
								}
								?>
							</div>
							<div class="SideAreaSection innerBox">
								<div class="rightLayoutPadding">
									<h2>Quick Links</h2>
								</div>
								<ul class="sidebar">
									<li>
										<a <?php if(!(isset($_GET['section']))) { ?> class="active" <?php } ?> href="http://freeflightinteractive.co.uk/old/police.php?page=staff"><i class="fa fa-tachometer"></i> Overview</a>
									</li>
									<li>
										<a <?php if(isset($_GET['section']) && $_GET['section'] == 'officers') { ?> class="active" <?php } ?>href="http://freeflightinteractive.co.uk/old/police.php?page=staff&section=officers"><i class="fa fa-address-card"></i> Officers</a>
									</li>
									<li>
										<a <?php if(isset($_GET['section']) && $_GET['section'] == 'addOfficer') { ?> class="active" <?php } ?>href="http://freeflightinteractive.co.uk/old/police.php?page=staff&section=addOfficer"><i class="fa fa-address-card"></i> Add Officer</a>
									</li>
								</ul>
							</div>
							<div style="clear:both;"></div>
						</div>
						<?php
						} else {
						?>
						<div class="box articleB" style="margin-top: 10px;">
								<div class="breadcrumb ipsBreadcrumb_top">
									<a href="http://freeflightinteractive.co.uk/old/police.php">Dashboard</a>
									<span class="slashes">//</span>
									<a class="active" href="http://freeflightinteractive.co.uk/old/police.php?page=staff">Access Denied</a>						
								</div>
								<h1>Access Denied</h1>
						</div>
						<?php
						}
						?>
					</main>