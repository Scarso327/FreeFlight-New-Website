					<main id="police" class="container">
						<div class="box articleB" style="margin-top: 10px;">
							<div class="breadcrumb ipsBreadcrumb_top">
								<a href="http://freeflightinteractive.co.uk/old/police.php">Dashboard</a>
								<span class="slashes">//</span>
								<a class="active" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea">myArea</a>	
							</div>
							<div class="pageHeader">
								<h1>myArea</h1>
							</div>
							<div class="innerBox">
								<p>Welcome to your area! This is were you can find all useful links. These include but are not limited to; Time Sheets, Officer Recommendation Forms etc. If you have any questions about this part of the dashboard please feel free to ask a member of senior command.</p>
							</div>
							<div class="AreaSection innerBox">
								<?php
								if(!(isset($_GET['section']))) {
								?>
									<div class="rightLayoutPadding">
										<h2>Your Information</h2>
									
								<?php
								} else {
									switch($_GET['section']) {
										case "forms": 
											if(isset($_GET['form'])) { 
											
												$rank = grabRank($pid, "Num", false, false);
												$isNPAS = checkDepartments($pid, 1);
												$isMPU = checkDepartments($pid, 2);
												$isSFU = checkDepartments($pid, 3);
												$isNCU = checkDepartments($pid, 4);
												
												if(isset($_GET['sendForm'])) {
													switch($_GET['sendForm']) {
														case "CSOPSCOTimesheet":
															$date1 = new DateTime($_GET['date'].$_GET['timeStart']);
															$date2 = new DateTime($_GET['date'].$_GET['timeEnd']);
															
															$diff = $date2->diff($date1);
															print $diff->format("%H:%I:%S"); 
															
															$sql_fetch_id = "INSERT INTO forms (pid, formType, form, Date, TotalTime, OfficersPatroling, Notes) VALUES ('".$pid."', 'TimeSheet', 'CSOPCSOTimeSheet', '".$_GET['date']."', '".$diff->format("%H:%I:%S")."', '".$_GET['Officers']."', '".$_GET['notes']."')";
															$query_id = mysqli_query($db,$sql_fetch_id);
															if($query_id == true) {
																print $diff->format("%H:%I:%S"); 
																header("Location: http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=CSO-PSCO-Time-Sheet");
																die();
															} else {
																die("Failed to submit");
															}
															break;
														case "NPASTimeSheet":
															$date1 = new DateTime($_GET['date'].$_GET['timeStart']);
															$date2 = new DateTime($_GET['date'].$_GET['timeEnd']);
															
															$diff = $date2->diff($date1);
															print $diff->format("%H:%I:%S"); 
															
															$sql_fetch_id = "INSERT INTO forms (pid, formType, form, Date, TotalTime, Aircraft, OfficersPatroling, Notes) VALUES ('".$pid."', 'TimeSheet', 'NPASTimeSheet', '".$_GET['date']."', '".$diff->format("%H:%I:%S")."', '".$_GET['aircraft']."', '".$_GET['officers']."', '".$_GET['notes']."')";
															$query_id = mysqli_query($db,$sql_fetch_id);
															if($query_id == true) {
																print $diff->format("%H:%I:%S"); 
																header("Location: http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=NPAS-Time-Sheet");
																die();
															} else {
																die("Failed to submit");
															}
															break;
														case "MPUTimeSheet":
															$date1 = new DateTime($_GET['date'].$_GET['timeStart']);
															$date2 = new DateTime($_GET['date'].$_GET['timeEnd']);
															
															$diff = $date2->diff($date1);
															print $diff->format("%H:%I:%S"); 
															
															$sql_fetch_id = "INSERT INTO forms (pid, formType, form, Date, TotalTime, Aircraft, OfficersPatroling, Notes) VALUES ('".$pid."', 'TimeSheet', 'MPUTimeSheet', '".$_GET['date']."', '".$diff->format("%H:%I:%S")."', '".$_GET['aircraft']."', '".$_GET['officers']."', '".$_GET['notes']."')";
															$query_id = mysqli_query($db,$sql_fetch_id);
															if($query_id == true) {
																print $diff->format("%H:%I:%S"); 
																header("Location: http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=MPU-Time-Sheet");
																die();
															} else {
																die("Failed to submit");
															}
															break;
													}
												} else {
													switch($_GET['form']) {
														case "CSO-PSCO-Time-Sheet": 
															if($rank > 0 && $rank < 3 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>CSO/PCSO Time Sheet</h2>
																<p>Used by CSOs and PCSOs to record their time on-duty.</p>
																<br>
																<form action="" method="GET">
																	<input hidden name="page" value="myArea">
																	<input hidden name="section" value="forms">
																	<input hidden name="form" value="CSO-PSCO-Time-Sheet">
																	<input hidden name="sendForm" value="CSOPSCOTimesheet">
																	<h3>Date of activity</h3>
																	<input type="date" name="date">
																	<h5>Here we require to know the date at which you were on duty.</h5><br>
																	<h3>Shift Start</h3>
																	<input type="time" name="timeStart">
																	<h5>Here we need the time at which you went on-duty.</h5><br>
																	<h3>Shift End</h3>
																	<input type="time" name="timeEnd">
																	<h5>Here we need the time at which you went off-duty.</h5><br>
																	<h3>Officer's you partoled with</h3>
																	<input type="text" name="Officers">
																	<h5>Please enter the names of the officers you where with at the time. We may contact them so please be truthful.</h5><br>
																	<h3>Notes</h3>
																	<textarea name="notes" rows="5" style="width:100%; resize: vertical; overflow-y: scroll; overflow-x: hidden; " required></textarea>
																	<h5>Any extra notes you may want to add.</h5><br>
																	<input class="buttonHappy" type="submit" value="Submit">
																</form>
															
															<div class="articleList" id="formList">
															
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "NPAS-Time-Sheet": 
															if($isNPAS > 0 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>NPAS Time Sheet</h2>
																<p>Used by NPAS Pilots to record their time on-duty and with what aircraft.</p>
																																<br>
																<form action="" method="GET">
																	<input hidden name="page" value="myArea">
																	<input hidden name="section" value="forms">
																	<input hidden name="form" value="NPAS-Time-Sheet">
																	<input hidden name="sendForm" value="NPASTimeSheet">
																	<h3>Date of activity</h3>
																	<input type="date" required name="date">
																	<h5>Here we require to know the date at which you were on duty.</h5><br>
																	<h3>Shift Start</h3>
																	<input type="time" required name="timeStart">
																	<h5>Here we need the time at which you went on-duty. For NPAS this is on takeoff.</h5><br>
																	<h3>Shift End</h3>
																	<input type="time" required name="timeEnd">
																	<h5>Here we need the time at which you went off-duty. For NPAS this is on landing.</h5><br>
																	<h3>Aircraft</h3>
																	<select name="aircraft" required>
																		<option value="WhiskeyAlpha-99">Whiskey Alpha-99</option>
																		<option value="WhiskeyBravo-99">Whiskey Bravo-99</option>
																		<option value="Pathfinder-01">Pathfinder-01</option>
																		<option value="India-99">India-99</option>
																		<option value="Omega-Bravo">Omega Bravo</option>
																		<option value="KAP-001">KAP-001</option>
																	</select>
																	<h5>Select the aircraft used.</h5><br>
																	<h3>Name of your Co-Pilot</h3>
																	<select name="officers" required>
																		<?php
																		$sql_fetch_id = "SELECT * FROM officers";
																		$query_id = mysqli_query($db,$sql_fetch_id);
																		
																		if ($query_id->num_rows > 0) {
																			while($row = $query_id->fetch_assoc()) {
																				$userNPAS = checkDepartments($row['pid'], 1);
																				if($userNPAS > 0) { ?>
																					<option value="<?=$row['Username'];?>"><?=$row['Username'];?></option>
																				<?php }
																			}
																		}
																		?>
																	</select>
																	<h5>Please enter the names of the officers you where with at the time. We may contact them so please be truthful.</h5><br>
																	<h3>Notes</h3>
																	<textarea name="notes" rows="5" style="width:100%; resize: vertical; overflow-y: scroll; overflow-x: hidden; "></textarea>
																	<h5>Any extra notes you may want to add.</h5><br>
																	<input class="buttonHappy" type="submit" value="Submit">
																</form>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "MPU-Time-Sheet": 
															if($isMPU > 0 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>MPU Time Sheet</h2>
																<p>Used by MPU Officers to record their time on-duty and with what boat.</p>
																
																<form action="" method="GET">
																	<input hidden name="page" value="myArea">
																	<input hidden name="section" value="forms">
																	<input hidden name="form" value="MPU-Time-Sheet">
																	<input hidden name="sendForm" value="MPUTimeSheet">
																	<h3>Date of activity</h3>
																	<input type="date" required name="date">
																	<h5>Here we require to know the date at which you were on duty.</h5><br>
																	<h3>Shift Start</h3>
																	<input type="time" required name="timeStart">
																	<h5>Here we need the time at which you went on-duty. For NPAS this is on takeoff.</h5><br>
																	<h3>Shift End</h3>
																	<input type="time" required name="timeEnd">
																	<h5>Here we need the time at which you went off-duty. For NPAS this is on landing.</h5><br>
																	<h3>Boat</h3>
																	<select name="aircraft" required>
																		<option value="Assualt-Boat">Assualt Boat</option>
																		<option value="Motor-Boat">Motor Boat</option>
																		<option value="RHIB">RHIB</option>
																		<option value="SDV">SDV</option>
																		<option value="Armed-Assualt-Boat">Armed Assualt Boat</option>
																	</select>
																	<h5>Select the boat used.</h5><br>
																	<h3>MPU Officers you partolled with</h3>
																	<input type="officers" required>
																	<h5>Please enter the names of the officers you where with at the time. We may contact them so please be truthful.</h5><br>
																	<h3>Notes</h3>
																	<textarea name="notes" rows="5" style="width:100%; resize: vertical; overflow-y: scroll; overflow-x: hidden; "></textarea>
																	<h5>Any extra notes you may want to add.</h5><br>
																	<input class="buttonHappy" type="submit" value="Submit">
																</form>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "SFU-Time-Sheet": 
															if($isSFU > 0 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>SFU Time Sheet</h2>
																<p>Used by SFU Officers to record their time on-duty.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "NCU-Time-Sheet": 
															if($isNCU > 0 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>NCU Time Sheet</h2>
																<p>Used by NCU Officers to record their time on-duty.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "CSO-PCSO-Recommendation-Sheet": 
															if($rank > 2 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>CSO/PCSO Recommendation Sheet</h2>
																<p>Consables and higher are able to use this to recommend a CSO or PCSO.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "PC-SPC-Recommendation-Sheet": 
															if($rank > 4 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>PC/SPC Recommendation Sheet</h2>
																<p>Sergeants and higher are able to use this to recommend a PC or S/PC.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "Junior-Command-Recommendation-Sheet": 
															if($rank > 7 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>Junior Command Recommendation Sheet</h2>
																<p>High Command are able to use this to recommend a member of Junior Command.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "NPAS-Damage-Report": 
															if($isNPAS > 0 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>NPAS Damage Report</h2>
																<p>If you ever damage one of NPAS's aircraft, please report it here.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "Leave-of-Absense-Form": 
															if($rank > 0 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>Leave of Absense Form</h2>
																<p>If you are going to be away for an extended period of time, please fill out this form.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														case "Resignation-Form": 
															if($rank > 0 || $debug == true) {?>
															<div class="rightLayoutPadding">
																<h2>Resignation Form</h2>
																<p>If you wish to leave your position, please fill out this form.</p>
															<div class="articleList" id="formList">
															<?php } else { ?>
																<div class="articleList" id="formList">
																	<div class="updateNull">
																		<br>
																		<center>
																			<h3>You don't have access to submit this form.<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																		</center>
															<?php }
															break;
														default: ?>
															<div class="articleList" id="formList">
																<div class="updateNull">
																	<br>
																	<center>
																		<h3>This form can't be found<br><a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms">Return To Forms</a></h3>
																	</center>
															<?php break;
													}
												}?>
													
											<?php 
											} else if(isset($_GET['viewForm'])) { 
												$sql_fetch_id = "SELECT * FROM forms WHERE id='".$_GET['viewForm']."' and pid='".$pid."'";
												$query_id = mysqli_query($db,$sql_fetch_id);
															
												if ($query_id->num_rows > 0) {
													while($row = $query_id->fetch_assoc()) { ?>
													<div class="rightLayoutPadding">
														<h2>View Form: <?=$row['id'];?></h2>
													<div class="articleList" id="formList">
														<br>
													<?php
														switch($row['form']) {
															case "CSOPCSOTimeSheet": 
																?>
																<a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&tab=Tab2">Return To Submitted Forms</a>
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
																<a style="border-bottom: 0px;" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&tab=Tab2">Return To Submitted Forms</a>
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
																echo "Unknown Form Type";
																break;
														}
													}
												}
											} else {?>
											<div class="tab">
											  <button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab1") { ?> id="defaultOpen" <?php } } else { ?> id="defaultOpen" <?php } ?> class="tablinks" onclick="changeTab(event, 'Tab1', 'forms')">Forms</button>
											  <button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab2") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab2', 'forms')">Submitted Forms</button>
											</div>
											<div id="Tab1" class="tabcontent">
												<div class="rightLayoutPadding">
													<form class="selectOptionsPolice SearchForm" action="">
														<input type="text" id="formInput" onkeyup="searchForms('Tab1')" placeholder="Search Through Forms..">
													</form>
													<form class="selectOptionsPolice" id="formTypes" action="">
													  <select name="articleOptions" onchange="changeFormType(this.value,'Tab1')">
														<option value="All">All</option>
														<option value="TimeSheet">Time Sheets</option>
														<option value="Recommendations">Recommendations</option>
														<option value="Other">Other</option>
													  </select>
													</form>
													<h2>Available Forms</h2> 
													<p style="border-bottom: 1px solid rgba(245,245,245,.1);">Here you can find all forms you will be required to fill out. If you believe a form is here that you don't need or one is not that you do, please contact Scarso as soon as possible.</p>
												</div>
												<div class="articleList" id="formList">
													<?php
													$formCount = 0;
													
													$rank = grabRank($pid, "Num", false, false);
													$isNPAS = checkDepartments($pid, 1);
													$isMPU = checkDepartments($pid, 2);
													$isSFU = checkDepartments($pid, 3);
													$isNCU = checkDepartments($pid, 4);

													if($rank > 0 && $rank < 3 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="TimeSheet">
															<a id="TimeSheet" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=CSO-PSCO-Time-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>CSO/PSCO Time Sheet</h3>
																	<p>Used by CSOs and PCSOs to record their time on-duty.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($isNPAS > 0 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="TimeSheet">
															<a id="TimeSheet" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=NPAS-Time-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>NPAS Time Sheet</h3>
																	<p>Used by NPAS Pilots to record their time on-duty and with what aircraft.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($isMPU > 0 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="TimeSheet">
															<a id="TimeSheet" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=MPU-Time-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>MPU Time Sheet</h3>
																	<p>Used by MPU Officers to record their time on-duty and with what boat.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($isSFU > 0 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="TimeSheet">
															<a id="TimeSheet" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=SFU-Time-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>SFU Time Sheet</h3>
																	<p>Used by SFU Officers to record their time on-duty.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($isNCU > 0 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="TimeSheet">
															<a id="TimeSheet" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=NCU-Time-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>NCU Time Sheet</h3>
																	<p>Used by NCU Officers to record their time on-duty.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($rank > 2 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="Recommendations">
															<a id="Recommendations" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=CSO-PCSO-Recommendation-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>CSO/PCSO Recommendation Sheet</h3>
																	<p>Consables and higher are able to use this to recommend a CSO or PCSO.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($rank > 4 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="Recommendations">
															<a id="Recommendations" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=PC-SPC-Recommendation-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>PC/SPC Recommendation Sheet</h3>
																	<p>Sergeants and higher are able to use this to recommend a PC or S/PC.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($rank > 7 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="Recommendations">
															<a id="Recommendations" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=Junior-Command-Recommendation-Sheet">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>Junior Command Recommendation Sheet</h3>
																	<p>High Command are able to use this to recommend a member of Junior Command.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($isNPAS > 0 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="Other">
															<a id="Other" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=NPAS-Damage-Report">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>NPAS Damage Report</h3>
																	<p>If you ever damage one of NPAS's aircraft, please report it here.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($rank > 0 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="Other">
															<a id="Other" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=Leave-of-Absense-Form">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>Leave of Absense Form</h3>
																	<p>If you are going to be away for an extended period of time, please fill out this form.</p>
																</div>
															</a>
														</div>
													<?php
													}
													
													if($rank > 0 || $debug == true) {
														$formCount = $formCount + 1;
													?>
														<div class="Other">
															<a id="Other" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&form=Resignation-Form">
																<div class="listThumbnail">
																	<div class="thumbnail" style="background-image: url();"></div>
																</div>
																<div class="listInfo">
																	<span></span>
																	<h3>Resignation Form</h3>
																	<p>If you wish to leave your position, please fill out this form.</p>
																</div>
															</a>
														</div>
													<?php
													}
													?>
													<?php
													if($formCount < 1) {
													?>
														<div class="updateNull">
															<br>
															<center>
																<h3>No Forms Found</h3>
															</center>
														</div>
													<?php
													}
												}
													?>
										</div>
											<?php break;
										default:
											echo "Section Not Found 404";
											break;
									}
								}
								?>
								</div>
								<div id="Tab2" class="tabcontent">
									<div class="rightLayoutPadding">
										<form class="selectOptionsPolice" id="formTypes" action="">
											<select name="articleOptions" onchange="changeFormType(this.value,'Tab2')">
												<option value="All">All</option>
												<option value="TimeSheet">Time Sheets</option>
												<option value="Recommendations">Recommendations</option>
												<option value="Other">Other</option>
											</select>
										</form>
										<h2>Submitted Forms</h2> 
										<p style="border-bottom: 1px solid rgba(245,245,245,.1);">This page allows you to view your past submitted forms. Some may also have comments added from Senior Command.</p>
									</div>
									<div class="articleList" id="formListPAST">
										<?php
										// Getting the list!
										$sql_fetch_id = "SELECT * FROM forms WHERE pid='".$pid."' ORDER BY ID DESC";
										$query_id = mysqli_query($db,$sql_fetch_id);
													
										if ($query_id->num_rows > 0) {
											while($row = $query_id->fetch_assoc()) {?>
												<div class="<?=$row['formType'];?>">
													<a id="<?=$row['formType'];?>" class="policeItem" href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms&viewForm=<?=$row['id'];?>">
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
							</div>
							<div class="SideAreaSection innerBox">
								<div class="rightLayoutPadding">
									<h2>Quick Links</h2>
								</div>
								<ul class="sidebar">
									<li>
										<a <?php if(!(isset($_GET['section']))) { ?> class="active" <?php } ?> href="http://freeflightinteractive.co.uk/old/police.php?page=myArea"><i class="fa fa-tachometer"></i> myArea</a>
									</li>
									<li>
										<a <?php if(isset($_GET['section']) && $_GET['section'] == 'forms') { ?> class="active" <?php } ?>href="http://freeflightinteractive.co.uk/old/police.php?page=myArea&section=forms"><i class="fa fa-address-card"></i> Forms</a>
									</li>
								</ul>
							</div>
							<div style="clear:both;"></div>
						</div>
					</main>