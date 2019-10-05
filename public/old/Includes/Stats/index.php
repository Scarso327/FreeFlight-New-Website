<?php
$page = "Unknown";
	
switch ($_GET['page']) {
	case "AdminLogs":
		$page = "Admin Logs";
		break;
	default: 
		$page = "MyStats";
		break;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freeflightdata";
			
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

// Setup Account Information
// 1) Check if we are logged
// 2) Get our steam information from our account
// 3) Get our account information from our account
// 4) Check for correct information as well as if we actually have a linked steam account.
// 5) Assign all required variables for admin activities plus show we have an account.
if (\IPS\Member::loggedIn()->member_id) {
	$steam = \IPS\steam\Profile::load(\IPS\Member::loggedIn()->member_id);
	$member = \IPS\Member::loggedIn();
	if ($steam->member_id == $member->member_id && $steam->steamid && $member->group['steam_pull']) {
		$account = true;
		$myID = $steam->steamid;
		
		if($myID == "76561198120407724") {
			die("Banned User");
		}
		
		$servernamecheckAdmin = "localhost";
		$usernamecheckAdmin = "root";
		$passwordcheckAdmin = "";
		$dbnamecheckAdmin = "freeflight";
			
		$checkAdmin = new mysqli($servernamecheckAdmin, $usernamecheckAdmin, $passwordcheckAdmin, $dbnamecheckAdmin);

		if ($checkAdmin->connect_error) {
			die("Connection failed: " . $checkAdmin->connect_error);
		}
		
		$sql_fetch_id = "SELECT * FROM databaseusers WHERE steamid='".$myID."'";
		$query_id_users = mysqli_query($checkAdmin,$sql_fetch_id);
		
		if(mysqli_num_rows($query_id_users) > 0) {
			while($info = $query_id_users->fetch_assoc()) {
				$staffID = $info['id'];
				$staffName = $info['name'];
				$editLicenses = $info['editLicenses'];
				$editPolice = $info['editPolice'];
				$editNHS = $info['editNHS'];
				$editAdmin = $info['editAdmin'];
				$editDonator = $info['editDonator'];
			}
		} else {
			$staffID = "Not Staff";
			$editLicenses = 0;
			$editPolice = 0;
			$editNHS = 0;
			$editAdmin = 0;
			$editDonator = 0;
		}
		
		mysqli_close($checkAdmin);
	} else {
		$account = false;
	}
} else {
	$account = false;
}

function stripdown($value)
{	
	$value = str_replace('"','',$value);
	$value = str_replace('[[','',$value);
	$value = str_replace(']]','',$value);
	
	$striped = explode("],[", $value);

	return $striped;
}

function getLicenseN($license) {
	switch($license) {
		case "`license_civ_driver`":
			return "Driver's License";
		case "`license_civ_boat`":
			return "Boating's License";
		case "`license_civ_ppilot`":
			return "Private Pilot's License";
		case "`license_civ_cpilot`":
			return "Commercial Pilot's License";
		case "`license_civ_trucking`":
			return "Trucking's License";
		case "`license_civ_rebel`":
			return "Syndikat Training";
		case "`license_civ_arebel`":
			return "Insurgent Training";
		case "`license_cop_cAir`":
			return "Officer's Pilot's License";
		case "`license_med_mAir`":
			return "Doctor's Pilot's License";
		case "`license_cop_cg`":
			return "Coast Guard";
		default:
			$license = explode("_", $license);
			$licenseReturn = str_replace("`","",$license[2]);
			$licenseReturn = ucfirst(strtolower($licenseReturn)); 
			return $licenseReturn;
	}
}

function getAchievements($Achievement, $unlocked) {
	$Achievement = str_replace('"','',$Achievement);
	$Achievement = str_replace('[[','',$Achievement);
	$Achievement = str_replace(']]','',$Achievement);
	$Achievement = str_replace("`","",$Achievement);
	$Achievement = explode("],[", $Achievement);
	
	$mysteryCount = 0;
	foreach ($Achievement as $value) {
		$value = explode(",", $value);
		
		$noShow = false;
		$mystery = false;
		switch($value[0]) {
			case "firstSpawn":
				$name = "First Spawn";
				$des = "";
				break;
			case "joinedAPC":
				$name = "Joined The Police";
				$des = "";
				break;
			case "joinedNHS":
				$name = "Joined The NHS";
				$des = "";
				break;
			case "first200k":
				$name = "£200,000!";
				$des = "";
				break;
			case "first500k":
				$name = "£500,000!";
				$des = "";
				break;
			case "first1mill":
				$name = "£1,000,000!";
				$des = "";
				break;
			case "first2mill":
				$name = "£2,000,000!";
				$des = "";
				break;
			case "first5mill":
				$name = "£5,000,000!";
				$des = "";
				break;
			case "benToilet":
				$name = "Ben's Hidden Toilet";
				$des = "";
				$mystery = true;
				break;
			case "cave":
				$name = "The Hidden Cave";
				$des = "";
				$mystery = true;
				break;
			case "waterRuins":
				$name = "The Lost Ruins";
				$des = "";
				$mystery = true;
				break;
			default:
				$noShow = true;
				break;
		}
		if($unlocked == false && $value[1] == 0 && $noShow == false && $mystery == false) {
			?>
			<a class="policeItem" href="" style="border-left: 1px solid rgba(245,245,245,.1); border-right: 1px solid rgba(245,245,245,.1);">
				<div class="listThumbnail">
					<div class="thumbnail" style="background-image: url('http://freeflightinteractive.co.uk/old/images/locked.png');"></div>
				</div>
				<div class="listInfo" style="top: -30px;">
					<span></span>
					<h3><?=$name;?></h3>
					<p><?=$des;?></p>
				</div>
			</a>	
			<?php
		} else if($unlocked == true && $value[1] == 1 && $noShow == false) {
			?>
			<a class="policeItem" href="" style="border-left: 1px solid rgba(245,245,245,.1); border-right: 1px solid rgba(245,245,245,.1);">
				<div class="listThumbnail">
					<div class="thumbnail" style="<?php if($mystery == true) { ?> background-image: url('http://freeflightinteractive.co.uk/old/images/mystery.png' <?php } else { ?> background-image: url('http://freeflightinteractive.co.uk/old/images/unlocked.png' <?php } ?>);"></div>
				</div>
				<div class="listInfo" style="top: -30px;">
					<span></span>
					<h3><?=$name;?></h3>
					<p><?=$des;?></p>
				</div>
			</a>	
			<?php
		} else if($unlocked == false && $mystery == true && $value[1] == 0) {
			$mysteryCount = $mysteryCount + 1;
		}
	}
	if($mysteryCount > 0 && $unlocked == false) {
		?>
		<a class="policeItem" href="" style="border-left: 1px solid rgba(245,245,245,.1); border-right: 1px solid rgba(245,245,245,.1);">
			<div class="listThumbnail">
				<div class="thumbnail" style="background-image: url('http://freeflightinteractive.co.uk/old/images/mystery.png');"></div>
			</div>
			<div class="listInfo" style="top: -30px;">
				<span></span>
				<h3><?=$mysteryCount;?> Mystery Achievement<?php if($mysteryCount > 1) { ?>s<?php } ?></h3>
				<p></p>
			</div>
		</a>	
		<?php
	}
}

function getGUID($steamID) {
	$temp = '';
	for ($i = 0; $i < 8; $i++) {
		$temp .= chr($steamID & 0xFF);
		$steamID >>= 8;
	}
	$return = md5('BE' . $temp);
	return $return;
}
?>
		<div id="statsPage">
			<?php
			switch($page) {
				case "MyStats": 
					if(isset($_GET['search'])) {
						if($_GET['search'] == "") { ?>
								<?php echo "Empty Search..." ?>
						<?php } else {  ?>
								<div class="articleList" style="background-color: #1E1E1E; margin-top: 5px;">
									<?php
									$sql_fetch_id = "SELECT * FROM players WHERE name LIKE '%{$_GET['search']}%' OR pid LIKE '%{$_GET['search']}%'";
									$query_id_users = mysqli_query($db,$sql_fetch_id);
										
									if(mysqli_num_rows($query_id_users) > 0) {
										while($row = $query_id_users->fetch_assoc()) {
											$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=3BD25795A7A5A3736F055BAE05F00290&steamids=".$row['pid'];
											$ch = curl_init();
											curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
											curl_setopt($ch, CURLOPT_URL,$apifr);
											$url = curl_exec($ch);
											curl_close($ch);
											$content = json_decode($url, true);
														
											if($row['pid'] != "76561198120407724") {
												$_SESSION['steamlist_avatarfull'] = $content['response']['players'][0]['avatarfull'];
											} else {
												$_SESSION['steamlist_avatarfull'] = "Profile Picture Banned";
											}
											?>
												<a class="policeItem" href="http://freeflightinteractive.co.uk/old/Forums/Stats/?user=<?=$row['pid'];?>">
													<div class="listThumbnail">
														<div class="thumbnail" style="background-image: url(<?=$_SESSION['steamlist_avatarfull'];?>);"></div>
													</div>
													<div class="listInfo" style="top: -20px;">
														<span></span>
														<h3><?=$row['name'];?></h3>
														<p><?=$row['pid'];?></p>
													</div>
												</a>	
											<?php
										}
									} else { ?>
										<div class="updateNull">
											<br>
											<center>
													<h3>No Results Found For: <?=$_GET['search'];?></h3>
											</center>
										</div>
									<?php
									}
									?>
								</div>
						<?php }
					} else if (isset($_GET['user'])) { 
						$sql_fetch_id = "SELECT * FROM players WHERE pid='".$_GET['user']."'";
						$query_id_users = mysqli_query($db,$sql_fetch_id);
													
						if(mysqli_num_rows($query_id_users) > 0) {
							while($row = $query_id_users->fetch_assoc()) {
								$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=3BD25795A7A5A3736F055BAE05F00290&steamids=".$_GET['user'];
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($ch, CURLOPT_URL,$apifr);
								$url = curl_exec($ch);
								curl_close($ch);
								$content = json_decode($url, true);
									
								if($row['pid'] != "76561198120407724") {
									$_SESSION['steamlist_avatarfull'] = $content['response']['players'][0]['avatarfull'];
								} else {
									$_SESSION['steamlist_avatarfull'] = "Profile Picture Banned";
								}
								?>
									<div style="background-color: #1E1E1E; padding: 5px; margin-top: 5px;">
										<div class="articleList">
											<a class="">
												<div class="listThumbnail">
													<div class="thumbnail" style="background-image: url(<?=$_SESSION['steamlist_avatarfull'];?>);"></div>
												</div>
												<div class="listInfo" style="top: -110px;">
													<span>Last Seen: <?=$row['last_seen'];?></span>
													<h3><?=$row['name'];?></h3>
													<p><?=$row['pid'];?></p>
												</div>
											</a>
										</div>
										<div class="tab" style="margin-top: 5px;">
											<button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab1") { ?> id="defaultOpen" <?php } } else { ?> id="defaultOpen" <?php } ?> class="tablinks" onclick="changeTab(event, 'Tab1', 'profile')">Main Stats</button>
											<button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab2") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab2', 'profile')">Forum Information</button>
											<button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab3") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab3', 'profile')">Licenses</button>
											<button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab4") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab4', 'profile')">Professions</button>
											<button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab5") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab5', 'profile')">Achievements</button>
										</div>
										<div id="Tab1" class="tabcontent" style="padding: 0;">
											<h2>Player Information</h2>
											Current Alias: <?=$row['name'];?><br>
											Past Aliases: <?=$row['aliases'];?><br>
											Player ID: <?=$row['uid'];?><br>
											Steam ID: <?=$row['pid'];?><br>
											<?php
											$cash = number_format($row['cash']);
											?>
											Cash: £<?=$cash;?><br>
											<?php
											$bank = number_format($row['bankacc']);
											?>
											Bank: £<?=$bank;?>
										</div>
										<div id="Tab2" class="tabcontent" style="padding: 0;">
											<?php
											$servernameSteam = "localhost";
											$usernameSteam = "root";
											$passwordSteam = "";
											$dbnameSteam = "fffroums";
														
											$dbSteam = new mysqli($servernameSteam, $usernameSteam, $passwordSteam, $dbnameSteam);
											
											if ($dbSteam->connect_error) {
												die("Connection failed: " . $dbSteam->connect_error);
											}

											$sqlSteam = "SELECT * FROM core_members WHERE steamid='".$_GET['user']."'";
											$sqlSteamQuery = mysqli_query($dbSteam,$sqlSteam);
																		
											if(mysqli_num_rows($sqlSteamQuery) > 0) {
												while($rowSteam = $sqlSteamQuery->fetch_assoc()) {
													$user = \IPS\Member::load($rowSteam['member_id']);

													$coverPhoto = $user->coverPhoto();
													?>
														<header data-role="profileHeader">
															<div style="height: 200px;" class='ipsPageHead_special <?php if ($small === true) {?>cProfileHeaderMinimal<?php } ?>' id='elProfileHeader' data-controller='core.front.core.coverPhoto' data-url="<?=$user->url()->csrf();?>" data-coverOffset='<?=$coverPhoto->offset;?>'>
																<div class='ipsCoverPhoto_container'>
																	<img src='<?=$coverPhoto->file->url;?>' class='ipsCoverPhoto_photo' alt=''>
																</div>

																<div class='ipsColumns ipsColumns_collapsePhone'>
																	<div style="position: absolute; top: 105px;" class='ipsColumn ipsColumn_fixed ipsColumn_narrow ipsPos_center' id='elProfilePhoto'>
																		<?php if ($user->pp_main_photo and ( mb_substr( $user->pp_photo_type, 0, 5 ) === 'sync-' or $user->pp_photo_type === 'custom' )) { ?>
																			<a class='ipsUserPhoto ipsUserPhoto_xlarge'>					
																				<img src='<?php if($row['pid'] != "76561198120407724") { echo $user->photo; }?>' alt=''>
																			</a>
																		<?php } else { ?>
																			<span class='ipsUserPhoto ipsUserPhoto_xlarge'>					
																				<img src='<?=$user->photo;?>' alt=''>
																			</span>
																		<?php } ?>
																	</div>
																	<div class='ipsColumn ipsColumn_fluid'>
																		<div style="position: relative;left: 120px;top: 105px;"class='ipsPos_left ipsPad cProfileHeader_name'>
																			<h1 class='ipsType_reset' style="margin-bottom: 0 !important;">
																				<?=$user->name;?>
																			</h1>
																			<span><p><?php echo \IPS\Member\Group::load( $user->member_group_id )->formattedName;?></p></span>
																		</div>
																	</div>
																</div>
															</div>

															<div id='elProfileStats' class='ipsClearfix'>
																<div data-role='switchView' class='ipsResponsive_hidePhone ipsResponsive_block'>
																	<a style="float: none; width: 100%; background-color: #1B1B1B; border: 0px; color: #c8c8c8;" href='<?=$user->url();?>' class='ipsButton ipsButton_veryLight ipsButton_medium ipsPos_right' data-action="goToProfile" data-type='full'><i class='fa fa-user'></i> <span class='ipsResponsive_showDesktop ipsResponsive_inline'>&nbsp; View Forum Profile</span></a>
																</div>
															</div>
														</header>
													<?php 
												}
											} else { ?>
												<div class="articleList">
													<div class="updateNull">
														<br>
														<center>
															<h3>Hive Sync Failure</h3>
															<p>This could have been caused by a database error or this user has not linked their steam account with their forum account.</p>
														</center>
													</div>
												</div>
											<?php
											}
											mysqli_close($dbSteam);
											?>
										</div>
										<div id="Tab3" class="tabcontent" style="padding: 0;">
											<div class="statSections">
												<?php
												if($row['coplevel'] > 0) {
													?>
													<h2>Police Licenses</h2>
													<?php
													$licenseArray = stripdown($row['cop_licenses']);
													foreach ($licenseArray as $value) {
														$value = explode(",", $value); ?>
														<div class="license <?php if($value[1] == 1) { ?>green<?php } ?>">
															<?php
															$licenseName = getLicenseN($value[0]);
															echo $licenseName;
															?>
														</div>
														<?php
													}
												}
												?>
											</div>
											<div class="statSections">
												<?php
												if($row['mediclevel'] > 0) {
													?>
													<h2>Medic Licenses</h2>
													<?php
													$licenseArray = stripdown($row['med_licenses']);
													foreach ($licenseArray as $value) {
														$value = explode(",", $value); ?>
														<div class="license <?php if($value[1] == 1) { ?>green<?php } ?>">
															<?php
															$licenseName = getLicenseN($value[0]);
															echo $licenseName;
															?>
														</div>
														<?php
													}
												}
												?>
											</div>
											<div class="statSections">
												<h2>Civilian Licenses</h2>
												<?php
												$licenseArray = stripdown($row['civ_licenses']);
												foreach ($licenseArray as $value) {
													$value = explode(",", $value); ?>
													<div class="license <?php if($value[1] == 1) { ?>green<?php } ?>">
														<?php
														$licenseName = getLicenseN($value[0]);
														echo $licenseName;
														?>
													</div>
													<?php
												}
												?>
											</div>
										</div>
										<div id="Tab4" class="tabcontent" style="padding: 0;">
											<div class="statSections">
												<?php
												if($row['mediclevel'] > 0) {
													?>
													<h2>Police Professions</h2>
													<?php
													echo $row['cop_profession'];
												}
												?>
											</div>
											<div class="statSections">
												<?php
												if($row['mediclevel'] > 0) {
													?>
													<h2>Medic Professions</h2>
													<?php
													echo $row['med_profession'];
												}
												?>
											</div>
											<div class="statSections">
												<h2>Civilian Professions</h2>
												<?php
												echo $row['civ_profession'];
												?>
											</div>
										</div>
										<div id="Tab5" class="tabcontent" style="padding: 0;">
											<div class="AreaSection" style="width: 50%;">
												<h2>Unlocked Achievements</h2>
												<div class="articleList">
													<?php
													getAchievements($row['achievements'], true);
													?>
												</div>
											</div>
											<div class="SideAreaSection" style="width: 50%;">
												<h2>Locked Achievements</h2>
												<div class="articleList">
													<?php
													getAchievements($row['achievements'], false);
													?>
												</div>
											</div>
											<div style="clear:both;"></div>
										</div>
									</div>
								<?php 
							}
						}
					} else { ?>
							<div class="tab" style="margin-top: 5px;">
								<button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab1") { ?> id="defaultOpen" <?php } } else { ?> id="defaultOpen" <?php } ?> class="tablinks" onclick="changeTab(event, 'Tab1', 'main')">Search</button>
								<button <?php if(isset($_GET['tab'])) { if($_GET['tab'] == "Tab2") { ?> id="defaultOpen" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Tab2', 'main')">Leaderboards</button>
								<?php if($account == true) { ?>
									<a class="tablinks" style="float: right; background-color: #00dfff;border: none;outline: none;cursor: pointer;padding: 14px 16px;transition: 0.3s;color: black;" href="http://freeflightinteractive.co.uk/old/Forums/Stats/?user=<?=$myID;?>&tab=Tab1">MyStats</a>
								<?php } ?>
								<a class="tablinks" style="float: right; background-color: inherit;border: none;outline: none;cursor: pointer;padding: 14px 16px;transition: 0.3s;color: inherit;" href="http://freeflightinteractive.co.uk/old/Forums/Stats/?page=AdminLogs&pageNumber=1">Logs</a>
							</div>
							<div style="margin-top: 5px;">
								<div id="Tab1" class="tabcontent" style="padding: 0;">
									<div style="background-color: #1E1E1E; padding: 5px;">
										<p style="font-size: 16px;">Any information obtained through the stats page must not be used within Roleplay. This is considered Meta-Gaming and is a bannable offense! This also applies to the Leaderboards. If you have any further questions please contact our support team through teamspeak @ ts3.freeflightinteractive.co.uk</p>
										<br>
										<form action="" method="GET">
											<input type="text" name="search" placeholder="Search for a player...">
											<p style="font-size: 14px;">You are able to search using the player's UID as well as name.</p>
											<input type="submit" value="Submit">
										</form>
									</div>
								</div>
								<div id="Tab2" class="tabcontent" style="padding: 0;">
									<div class="tab">
										<button <?php if(isset($_GET['stab'])) { if($_GET['stab'] == "Cash") { ?> id="defaultOpens" <?php } } else { ?> id="defaultOpens" <?php } ?> class="tablinks" onclick="changeTab(event, 'Cash', 'second')">Cash</button>
										<button <?php if(isset($_GET['stab'])) { if($_GET['stab'] == "Bank") { ?> id="defaultOpens" <?php } } ?> class="tablinks" onclick="changeTab(event, 'Bank', 'second')">Bank</button>
									</div>
									<div style="margin-top: 5px;">
										<div id="Cash" class="tabcontents">
											<div style="background-color: #1E1E1E; padding: 5px;">
												<h2>Cash (Top 5 Biggest Pockets)</h2>
												<div class="articleList">
													<?php
													$sql_fetch_id = "SELECT * FROM players ORDER BY cash DESC LIMIT 5";
													$query_id_users = mysqli_query($db,$sql_fetch_id);
													
													if(mysqli_num_rows($query_id_users) > 0) {
														while($row = $query_id_users->fetch_assoc()) {
															$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=3BD25795A7A5A3736F055BAE05F00290&steamids=".$row['pid'];
															$ch = curl_init();
															curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
															curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
															curl_setopt($ch, CURLOPT_URL,$apifr);
															$url = curl_exec($ch);
															curl_close($ch);
															$content = json_decode($url, true);
														
															if($row['pid'] != "76561198120407724") {
																$_SESSION['steamlist_avatarfull'] = $content['response']['players'][0]['avatarfull'];
															} else {
																$_SESSION['steamlist_avatarfull'] = "Profile Picture Banned";
															}
															$cash = number_format($row['cash']);
															?>
																<a class="policeItem" href="http://freeflightinteractive.co.uk/old/Forums/Stats/?user=<?=$row['pid'];?>&tab=Tab1">
																	<div class="listThumbnail">
																		<div class="thumbnail" style="background-image: url(<?=$_SESSION['steamlist_avatarfull'];?>);"></div>
																	</div>
																	<div class="listInfo" style="top: -20px;">
																		<span></span>
																		<h3><?=$row['name'];?></h3>
																		<p>£<?=$cash;?></p>
																	</div>
																</a>	
															<?php
														}
													} else { ?>
														<div class="updateNull">
															<br>
															<center>
																<h3>No Stats Found</h3>
															</center>
														</div>
													<?php
													}
													?>
												</div>
											</div>
										</div>
										<div id="Bank" class="tabcontents">
											<div style="background-color: #1E1E1E; padding: 5px;">
												<h2>Bank (Top 5 Biggest Vaults)</h2>
												<div class="articleList">
													<?php
													$sql_fetch_id = "SELECT * FROM players ORDER BY bankacc DESC LIMIT 5";
													$query_id_users = mysqli_query($db,$sql_fetch_id);
													
													if(mysqli_num_rows($query_id_users) > 0) {
														while($row = $query_id_users->fetch_assoc()) {
															$apifr = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=3BD25795A7A5A3736F055BAE05F00290&steamids=".$row['pid'];
															$ch = curl_init();
															curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
															curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
															curl_setopt($ch, CURLOPT_URL,$apifr);
															$url = curl_exec($ch);
															curl_close($ch);
															$content = json_decode($url, true);
														
															if($row['pid'] != "76561198120407724") {
																$_SESSION['steamlist_avatarfull'] = $content['response']['players'][0]['avatarfull'];
															} else {
																$_SESSION['steamlist_avatarfull'] = "Profile Picture Banned";
															}
															$bank = number_format($row['bankacc']);
															?>
																<a class="policeItem" href="http://freeflightinteractive.co.uk/old/Forums/Stats/?user=<?=$row['pid'];?>&tab=Tab1">
																	<div class="listThumbnail">
																		<div class="thumbnail" style="background-image: url(<?=$_SESSION['steamlist_avatarfull'];?>);"></div>
																	</div>
																	<div class="listInfo" style="top: -20px;">
																		<span></span>
																		<h3><?=$row['name'];?></h3>
																		<p>£<?=$bank;?></p>
																	</div>
																</a>	
															<?php
														}
													} else { ?>
														<div class="updateNull">
															<br>
															<center>
																<h3>No Stats Found</h3>
															</center>
														</div>
													<?php
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php }
					break;
				case "Admin Logs": ?>
						<h2>Admin Logs</h2> 
						<p style="border-bottom: 1px solid rgba(245,245,245,.1);">Here you are able to see all admin logs live. Useful if you believe someone is abusing.</p>
						<div class="articleList" id="formList">
								<?php
								$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "FreeFlightData";
											
								$db2 = new mysqli($servername, $username, $password, $dbname);

								if ($db->connect_error) {
									die("Connection failed: " . $db2->connect_error);
								}
									
								if (isset($_GET["pageNumber"])) { 
									if($_GET["pageNumber"] != 0 && $_GET["pageNumber"] != "") {
										$page  = $_GET["pageNumber"]; 
									} else {
										$page=1; 
									}
								} else { 
									Header ("Location: http://freeflightinteractive.co.uk/old/Forums/Stats/?page=AdminLogs&pageNumber=1");
								}; 
									
								$results_per_page = 10;
									
								$start_from = ($page-1) * $results_per_page;
								$sql_fetch_id = "SELECT * FROM godseye ORDER BY id DESC LIMIT ".$start_from.", ".$results_per_page;
								$query_id_users = mysqli_query($db2,$sql_fetch_id);
									
								if(mysqli_num_rows($query_id_users) > 0) { ?>
									<table>
									  <tr>
										<th>Admin</th>
										<th>Command Used</th>
										<th>Information</th>
										<th>Time & Date</th>
									  </tr>
									<?php while($row = $query_id_users->fetch_assoc()) {?>
									<tr>
										<td><?=$row['admin_name'];?></td>
										<td><?=$row['command_used'];?></td>
										<td><?=$row['information'];?></td>
										<td><?php $timestamp = strtotime($row['insert_time']); echo date("d/m/Y h:i:s", $timestamp);?></td>
									</tr>
								<?php
									}
								} else { ?>
									<div class="updateNull">
										<br>
										<center>
											<h3>No Logs Found</h3>
										</center>
									</div>
								<?php
								}
								?>
							</table>
					</div>
						<div class="pageList">
						<?php 
							$sql = "SELECT COUNT(id) AS total FROM godseye";
							
							$query_id_users = mysqli_query($db,$sql);
												
							if(mysqli_num_rows($query_id_users) > 0) {
								$row = $query_id_users->fetch_assoc();
								$total_pages = ceil($row["total"] / $results_per_page); 

								$page = $_GET["pageNumber"] - 1; 
								if($page < 1) {
									$page = 1;
								}
								?> 
								<a href='http://freeflightinteractive.co.uk/old/Forums/Stats/?page=AdminLogs&pageNumber=<?=$page;?>'><<</a>
								<?php 
								for ($i=1; $i<=$total_pages; $i++) {  
											echo "<a href='http://freeflightinteractive.co.uk/old/Forums/Stats/?page=AdminLogs&pageNumber=".$i."'";
											if ($i==$_GET["pageNumber"])  echo " class='selected'";
											echo ">".$i."</a> "; 
								}; 
								$page = $_GET["pageNumber"] + 1; 
								if($page == $total_pages || $page > $total_pages) {
									$page = $total_pages;
								}
								?> 
								<a href='http://freeflightinteractive.co.uk/old/Forums/Stats/?page=AdminLogs&pageNumber=<?=$page;?>'>>></a>
								<?php 
							}
							?>
						</div>
					<?php break;
				default:
					echo "Error 404";
					break;
			}
			?>
		<script>
		document.getElementById("communityNav").style["box-shadow"] = "0px 0px 0px #00dfff inset";
		document.getElementById("statsNav").style["box-shadow"] = "0px -3px 0px #00dfff inset";
		document.getElementById("defaultOpen").click();
		<?php
		if(isset($_GET['stab'])) { 
		?>
			document.getElementById("defaultOpens").click();
		<?php
		}
		?>
		function changeTab(evt, tab, page) {
			switch(page) {
				case "main":
					if(tab == 'Tab2') {
						history.pushState(null, null, '?tab='+tab+'&stab=Cash');
						document.getElementById("defaultOpens").click();
					} else {
					history.pushState(null, null, '?tab='+tab);
					}
					break;
				case "second":
					history.pushState(null, null, '?tab=Tab2&stab='+tab);
					break;
				case "profile":
					history.pushState(null, null, '?user=<?=$_GET['user'];?>&tab='+tab);
					break;
			}
			var i, tabcontent, tablinks;

			switch(page) {
				case "main":
					//if(tab == 'Tab1') {
						tabcontent = document.getElementsByClassName("tabcontents");
					//}
					tabcontent = document.getElementsByClassName("tabcontent");
					break;
				case "second":
					if(tab == 'Tab1') {
						tabcontent = document.getElementsByClassName("tabcontent");
					}
					tabcontent = document.getElementsByClassName("tabcontents");
					break;
				case "profile":
					tabcontent = document.getElementsByClassName("tabcontent");
					break;
			}
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}

			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}

			document.getElementById(tab).style.display = "block";
			evt.currentTarget.className += " active";
		}
		</script>
	</div>
<?php 
mysqli_close($db);
mysqli_close($db2);
?>