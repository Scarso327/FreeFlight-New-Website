<?php

function addTwoTimes($time1, $time2){
        $time2_arr = [];
        $time1 = $time1;
        $time2_arr = explode(":", $time2);
        //Hour
        if(isset($time2_arr[0]) && $time2_arr[0] != ""){
            $time1 = $time1." +".$time2_arr[0]." hours";
            $time1 = date("H:i", strtotime($time1));
        }
        //Minutes
        if(isset($time2_arr[1]) && $time2_arr[1] != ""){
            $time1 = $time1." +".$time2_arr[1]." minutes";
            $time1 = date("H:i", strtotime($time1));
        }

	return date("H:i", strtotime($time1));
}
	
function getPlayTime($pid) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "freeflightdata";
				
	$dbRank = new mysqli($servername, $username, $password, $dbname);

	if ($dbRank->connect_error) {
		die("Connection failed: " . $dbRank->connect_error);
	}

	$sql_fetch_id = "SELECT playtime FROM players WHERE pid='".$pid."'";
	$query_id = mysqli_query($dbRank,$sql_fetch_id);
	
	if ($query_id->num_rows > 0) {
		while($row = $query_id->fetch_assoc()) {
			$playTime = $row['playtime'];
			
			// Strip Altis Life Syntax Stuff
			$playTime = str_replace('"','',$playTime);
			$playTime = str_replace('[','',$playTime);
			$playTime = str_replace(']','',$playTime);
			
			// Seperate all sides into an array.
			$playTime = explode(",", $playTime);
			
			// Convert to seconds.
			$playTimeRETURN = round($playTime[0] * 60);

			// Convert seconds to hours:minutes.
			$playTimeRETURN = gmdate('H:i', $playTimeRETURN);
			
			// Return only the police play time.
			return $playTimeRETURN;
		}
	} else {
		echo ("Error W/ Client, Code: 1C<br>Play time error!");
	};
}

function grabRank($pid, $type, $dots, $fullRank) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "freeflightdata";
				
	$dbRank = new mysqli($servername, $username, $password, $dbname);

	if ($dbRank->connect_error) {
		die("Connection failed: " . $dbRank->connect_error);
	}

	$sql_fetch_id = "SELECT * FROM players WHERE pid='".$pid."'";
	$query_id = mysqli_query($dbRank,$sql_fetch_id);
	
	if ($query_id->num_rows > 0) {
		while($row = $query_id->fetch_assoc()) {
			$databaseLevel = $row['coplevel'];
		}
	} else {
		echo ("Error W/ Client, Code: 1B<br>Report this to Scarso or another senior officer!");
	};
	
	if($type == "Abr") {
		switch($databaseLevel) {
			case 1:
				if($fullRank == false) {
					if($dots == true) {
						echo "CSO.";
					} else {
						echo "CSO";
					}
				} else {
					echo "Community Support Officer";
				}
				break;
			case 2:
				if($fullRank == false) {
					if($dots == true) {
						echo "PCSO.";
					} else {
						echo "PCSO";
					}
				} else {
					echo "Police Community Support Officer";
				}
				break;
			case 3:
				if($fullRank == false) {
					if($dots == true) {
						echo "PC.";
					} else {
						echo "PC";
					}
				} else {
					echo "Police Constable";
				}
				break;
			case 4:
				if($fullRank == false) {
					if($dots == true) {
						echo "S/PC.";
					} else {
						echo "S/PC";
					}
				} else {
					echo "Senior Police Constable";
				}
				break;
			case 5:
				if($fullRank == false) {
					if($dots == true) {
						echo "Sgt.";
					} else {
						echo "Sgt";
					}
				} else {
					echo "Sergeant";
				}
				break;
			case 6:
				if($fullRank == false) {
					if($dots == true) {
						echo "Insp.";
					} else {
						echo "Insp";
					}
				} else {
					echo "Inspector";
				}
				break;
			case 7:
				if($fullRank == false) {
					if($dots == true) {
						echo "C/Insp.";
					} else {
						echo "C/Insp";
					}
				} else {
					echo "Chief Inspector";
				}
				break;
			case 8:
				if($fullRank == false) {
					if($dots == true) {
						echo "Supt.";
					} else {
						echo "Supt";
					}	
				} else {
					echo "Superintendent";
				}
				break;
			case 9:
				if($fullRank == false) {
					if($dots == true) {
						echo "C/Supt.";
					} else {
						echo "C/Supt";
					}
				} else {
					echo "Chief Superintendent";
				}
				break;
			case 10:
				if($fullRank == false) {
					if($dots == true) {
						echo "ACC.";
					} else {
						echo "ACC";
					}
				} else {
					echo "Assistant Chief Constable";
				}
				break;
			case 11:
				if($fullRank == false) {
					if($dots == true) {
						echo "DCC.";
					} else {
						echo "DCC";
					}
				} else {
					echo "Deputy Chief Constable";
				}
				break;
			case 12:
				if($fullRank == false) {
					if($dots == true) {
						echo "CC.";
					} else {
						echo "CC";
					}
				} else {
					echo "Chief Constable";
				}
				break;
			default:
				// Not a cop....
				break;
		}
	} else if($type == "Num") {
		return $databaseLevel;
	}
	
	mysqli_close($dbRank);
}

function checkDepartments($pid, $type) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "freeflightdata";
				
	$dbRank = new mysqli($servername, $username, $password, $dbname);

	if ($dbRank->connect_error) {
		die("Connection failed: " . $dbRank->connect_error);
	}

	$sql_fetch_id = "SELECT * FROM players WHERE pid='".$pid."'";
	$query_id = mysqli_query($dbRank,$sql_fetch_id);
	
	if ($query_id->num_rows > 0) {
		while($row = $query_id->fetch_assoc()) {
			$NPAS = $row['isNPAS'];
			$MPU = $row['isMPU'];
			$SFU = $row['isSFU'];
			$NCU = $row['isNCU'];
		}
	} else {
		echo ("Error W/ Client, Code: 1B<br>Report this to Scarso or another senior officer!");
	};

	switch($type) {
		case 1:
			return $NPAS;
		case 2:
			return $MPU;
		case 3:
			return $SFU;
		case 4:
			return $NCU;
		default:
			break;
	}

	mysqli_close($dbRank);
}
?>