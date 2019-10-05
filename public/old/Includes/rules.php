<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freeflight";
			
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$rulesInfo = "SELECT * FROM rulesinfo";
$rulesInfoQuery = mysqli_query($db,$rulesInfo);
$sql_fetch_id = "SELECT * FROM rulesections";
$query_id_users = mysqli_query($db,$sql_fetch_id);
?>
	<style>
	.sidebar {
		padding: 0;
		list-style: none;
		margin: 0 !important;
		box-sizing: border-box;
			display: block;
	}

	.sidebar li {
		box-sizing: border-box;
		display: list-item;
		text-align: -webkit-match-parent;
		border-collapse: separate;
	}

	.sidebar li a {
		line-height: 22px;
		color: inherit;
		display: block;
		padding: 8px 10px;
		position: relative;
		margin-bottom: 2px;
		font-size: 14px;
		cursor: pointer;
		text-decoration: none;
		box-sizing: border-box;
		border-collapse: separate;
	}

	.sidebar li a.active{
		background: #151515;
		color: #fff;
	}

	.sidebar li a:hover {
		color: #fff;
	}
	
	.label {
		display: inline;
		padding: .2em .6em .3em;
		font-size: 75%;
		font-weight: 700;
		line-height: 1;
		color: #fff;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: .25em;
	}
	
	.label-info {
		background-color: #5bc0de;
	}
		
	.badge{display:inline-block;min-width:10px;padding:3px 7px;font-size:12px;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:middle;background-color:#777;border-radius:10px}
	</style>
<div class="insideBox" style="margin-bottom: 0px;">	
  	<h2 style="text-align: center; border: 0px;">
	<img class="ipsImage ipsImage_thumbnailed" style="height: 200px;"src="http://freeflightinteractive.co.uk/old/images/website-top-left-ting.png" alt="">
</h2>
  	<h1 style="text-align: center; color: white; font-size: 26px; margin-top: 14px; margin-bottom: 14px;"><strong>FreeFlight Interactive Community Rules</strong></h1>
    <h3 style="text-align: center; font-weight: 400;font-size: 16px; margin-top: 14px; margin-bottom: 14px;">Created 
		<?php
			if(mysqli_num_rows($rulesInfoQuery) > 0) {
				while($row = $rulesInfoQuery->fetch_assoc()) { ?>
					<?php $timestamp = strtotime($row['created']); echo date("d/m/Y", $timestamp);?>
					- Last Updated 
					<?php $timestamp = strtotime($row['lastUpdated']); echo date("d/m/Y", $timestamp);?></h3>
			<?php
			}
		}
		?>
</div>

<div class="SideAreaSection" style="float: left;">
	<div class="insideBox" style="padding: 0; min-height: 660px;">
		<div class="rightLayoutPadding" style="padding-top: 5px;">
			<h2>Table of Content</h2>
		</div>
		<ul class="sidebar" id="tablinks">
			<?php
			if(mysqli_num_rows($query_id_users) > 0) {
				while($row = $query_id_users->fetch_assoc()) { ?>
				  <li>
					  <a <?php if(isset($_GET['rule'])) { if($_GET['rule'] == "".$row['id'].".X") { ?> id="defaultOpen" <?php } } else { ?> id="defaultOpen" <?php } ?> class="tablinks" onclick="changeTab(event, '<?=$row['id'];?>.X', 'rules')"><b>[<?=$row['id'];?>.X]</b> <?=$row['name'];?></a>
				  </li>
				<?php
				}
			}
			?>
		  </ul>
	</div>
</div>

<div class="AreaSection" style="float: right;">
	<div class="insideBox" style="min-height: 660px;">
		<div id="0.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[0.X]</b> Introduction</h2>
				<p>Hello and welcome to FreeFlight Interactive's rules page! In order to maintain our extremely high level of roleplay throughout our community and servers, we have a rather strict set of rules that all members and players of our community are expected to abide by. Therefore we advise that you take some time to read, and fully understand, all the rules and guidelines listed below. This is to ensure that your, and others experience on our community and servers is all as we advertise!</p>
				<p>FreeFlight Interactive alone is not a very well known community, however, within our community we are quite well known for our strong, yet lenient rules, allowing us to maintain an extremely high level of roleplay on our servers.</p>
				<p>In the following aspects, we are very different from most other ArmA 3 life communities. The way we mean this is that we generally will not kick somebody for wrong doings, but instead offer them a chance to explain themselves. We all strongly believe that a simple kick won't change anything, same with a temporary ban... However, if someone is given the chance to explain themselves, have their wrongs pointed out, or even them having the chance to point out something wrong with the community or server side of things, it will do a great deal more good for everybody involved. Furthermore from that point, our community staff does have an even stricter set of rules to follow than most, however, we have never enforced any set punishments for any set wrongdoing, but simply allow the staff involved to come up with a fair and just punishment. After all the parties involved will always know a situation better than a punishment guide that could have been made a year in the past. However, with that, in the case that a member of the community gets removed, i.e permantly banned, the odds are that will never go away. Again, we are unlike other communities in this aspect, we, again, believe that a permant ban should be just that, permant.</p>
				<p>We are a extremly serious roleplay community, this will never change. Any rules or anything else that you may have taken from other communities, do not apply here. We pride ourselves on our differences from other ArmA 3 communities. What is done here is done here. Don't come onto our servers expecting them to be similar to others. Now yes, all life server across the ArmA 3 community will have their similarities, so don't be coming to staff stating that "this has been stolen... " or "I've seen this before" we do know about things from other servers, however, everybody must remember that there is only so much to do with life servers, and they will generally have been done in the past, but it's our abbility to change said things that sets us apart.</p>
				<p>Now, from what has been said above, it doesn't seam so, but we do attempt to be a friendly and fair community. On top of that we attempt to be a very mature one also. But that doesn't mean we don't allow people under a cirtain age, it simply means we expect the same level of maturity, regarless of a person's age. For all this community cares you could be 10 or 50, but you must act in a mature manner.</p>
				<p>Now, as a footnote before the rules, do note, these are the only offical community rules for FreeFlight. If you know of any documents of pages elsewhere regarding our rules, please contact a member of staff. But always follow these rules and these rules only.</p>
			</div>
		</div>
		<div id="1.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[1.X]</b> General Community Rules</h2>
				<p>FreeFlight Interactive prides itself on its community. We believe that having a maturing gaming community, on any game, is the key to success. Therefore we are very proud to be a mature gaming community.</p>
				<p>Now, as stated in the introduction, we don't require anybody to be a set age but hold a set level of maturity. We have no problem if you are 10 or 50, but if you can't hold a simple level of maturity that we expect from every member of our community, you won't last long. We can also understand the prejudice thoughts towards younger members of our community, however, we do work to stop this.</p>
				<p>Asides from expecting a high standard of maturity, we also expect a high-level fo respect, shown to each and every one of our community members. Now, on that note, if someone is disrespectful towards you or others, that doesn't mean you have to be disrespectful towards them... After all, two wrong don't make a right... Expect in maths... again...</p>
				<div style="font-size: 14px;">
					<p><b>[1.1]</b> Any form of discrimination, stereotyping or prejudice towards others is strictly forbidden and will result in removal from the community</p>    	
					<p><b>[1.2]</b> Any form of bullying will result in a removal from the community.</p>          	
					<p><b>[1.3]</b> Using harsh language towards others, with intent to offend, will result in a given punishment.</p>       	
					<p><b>[1.4]</b> Any form of threatful behaviour towards another person will result in removal from the community and possible police involved.</p>        	
					<p><b>[1.5]</b> Disruptive behaviour to the community will not be tolerated.</p>      	
					<p><b>[1.6]</b> Threatening behaviour will not be tolerated, in any case.</p>       	
					<p><b>[1.7]</b> Staff members have full discretion when dealing with situations. If you feel a staff member is acting in a biased or unfair way, ask for a senior member of the staff team.</p>      	
					<p><b>[1.8]</b> If making an accusation towards a member of staff, regarding a member of the community, you must hold some form of evidence.</p>  	
					<p><b>[1.9]</b> Attempting to advertise in any way, shape or form is a bannable offence. Staff will hold full discretion in these cases.</p>       	
					<p><b>[1.10]</b> Speaking of any real life problems or airing your personal political views is a bannable offence.</p>      	
					<p><b>[1.11]</b> Speaking of others political, cultural or sexual views is not permitted, providing it is with intent to offend.</p>
				</div>
			</div>
		</div>
		<div id="2.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[2.X]</b> Hacking, Cheating & Exploiting Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[2.1]</b> Using any form of software, addons or scripts to gain an advantage over others is strictly forbidden.</p>    	
					<p><b>[2.2]</b> Using any form of in-game bug/exploit to obtain items or advance yourself further than others illegitimately is forbidden.</p>   
					<p><b>[2.3]</b> Doing anything to give your self an advantage in the server, in a report case or anything that can be related to this is strictly against the rules.</p>     
				</div>
				<h2 style="border: 0px;">Notes</h2>
				<ul>	
					<li>
						Staff will determine if you have exploited a feature of the game to gain an advantage over others.
					</li>
          			<li>
						Gaining money and items through functions of the game and not the server is deemed as exploiting.
					</li>
          			<li>
						Exiting the server while in a respawn screen is deemed as exploiting.
					</li>
          			<li>
						Escaping custody in anyway that is not through roleplay is exploiting.
					</li>
				</ul>
			</div>
		</div>
		<div id="3.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[3.X]</b> Roleplay & Metagaming Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[3.1]</b> Roleplay <u>must</u> not be broken at any time on the server.</p>    	
					<p><b>[3.2]</b> Gaining roleplay information through <u>external sources</u> is strictly forbidden.</p>          	
					<p><b>[3.3]</b> For roleplay purposes, <u>negotiators</u> cannot have any form of hostile action taken towards them <u>during negotiations</u>.</p>       	
					<p><b>[3.4]</b> No form of roleplay should be carried out in <u>Civilian Channel</u>.</p>        	
					<p><b>[3.5]</b> A fully working microphone and sound system is required while playing on our servers.</p>      	
					<p><b>[3.6]</b> Roleplaying, using backstories such as being suicidal or anything along those lines, with the intent of getting out of standard roleplay situations is strictly forbidden.</p>       	
					<p><b>[3.7]</b> Once restrained in any way, you are not to communicate with others over TeamSpeak or any other VoIP service. Chat services are involved in this rule also.</p>      	
					<p><b>[3.8]</b> Although using the nametags above people's heads is forbiden, you are, however, permitted to gain information regarding a player's rank or standing within a faction such as the Police or Medics. e.g Cdt. or J/Ofc.</p>  	
					<p><b>[3.9]</b> It is strictly forbiden to respawn while a active situation is going on around you involving Police or Medics. e.g if you have been taken down during combat and the Police have won, you are not to respawn unless all Police/Medics have left the area.</p>       	
				</div>
			</div>
		</div>
		<div id="4.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[4.X]</b> Player Initiation Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[4.1]</b> Initiation can only be carried out through verbal, direct communication towards another player.</p>    	
					<p><b>[4.2]</b> When initiating on a vehicle which has it’s engine on, non-verbal communication is required, therefore you must type out a initiation message while within range of the person.</p>          	
					<p><b>[4.3]</b> When initiating with a player, warning shots maybe fired at passing vehicles if deemed a threat. If the vehicle fails to move off, that is initiation towards yourself.</p>       	
					<p><b>[4.4]</b> If a member of your in-game gang is having hostile actions taken towards them, you are free to fire if only after a warning has been given.</p>        	
					<p><b>[4.5]</b> Any form of initiation lasts 10 minutes after any interaction.</p>      	
					<p><b>[4.6]</b> Two wrongs never make a right... Except in mathematics. e.g If a member of you gang or a friend is RDMed, don't respond with RDM. In the same case, if someone is VDMed, don't respond with VDM. Etc. Etc. Defending yourself is an exception from this rule.</p>       	
					<p><b>[4.7]</b> Using extern software such as TeamSpeak to initiate is strictly forbiden. Using the in-game messaging system to initiate is strictly forbiden.</p>      	
					<p><b>[4.8]</b> Intentionally blocking vehicles is a form of initition. e.g hovering over a landed helicopter, restricting it from taking off.</p>  	
					<p><b>[4.9]</b> Demands made must be made within reason. An example is asking for someone to give you a rifle they don't have within 5 seconds, The staff member handling the report will decide whether it's too extreme of a demand.</p>  
				</div>
			</div>
		</div>
		<div id="5.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[5.X]</b> General Server Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[5.1]</b> Random Deathmatch (AKA, RDM) is engaging another party without a valid roleplay reason. e.g fireing at a person in Kavala without talking to them.</p>    	
					<p><b>[5.2]</b> Vehicle Deathmatch (AKA, VDM) is engaging another party using a vehicle. e.g running people over. Execptions are made for accidental VDM as long as its clear. You are also allowed to run people over if they are in front of your vehicle threatening your life with a weapon.</p>          	
					<p><b>[5.3]</b> New Life Rule (AKA, NLR) is returning (within 1KM) to the scene of your death within 10 minutes. Once you have died, all your previous roleplay memories are to be forgotten and no hostile actions can be taken against your killer without new roleplay reasons. In the case of you getting RDMed, NLR does not apply.</p>       	
					<p><b>[5.4]</b> Trolling in any way is not permitted.</p>        	
					<p><b>[5.5]</b> Combat Logging is when you disconnect during roleplay and is not permitted. Execptions are made in extreme circumstances but you must warn the players in-game of the reason using direct chat.</p>      	
					<p><b>[5.6]</b> Combat Storing is storing any vehicle during roleplay and is not permitted.</p>       	
					<p><b>[5.7]</b> Abusing your in-game microphone is strictly not permitted. e.g playing music down you microphone or making 'toxic' sounds.</p>      	
					<p><b>[5.8]</b> Taking hostile actions towards others within 20 metres of a Cash Point is considered RDM (Ref. 5.1)</p>  	
				</div>
			</div>
		</div>
		<div id="6.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[6.X]</b> Zone Rules</h2><span style="float:right;position:relative;top: -25px;" class="label label-info">Updated!</span>
				<div style="font-size: 14px;">
					<p><b>[6.1]</b> Green Zones or Safezones are areas marked on the map with a green circle. You may not, rob, kill or take any hositle action in these areas.</p>    	
				</div>
				<h2 style="border: 0px;">Notes</h2>
				<ul>	
					<li>
						If your house is bring raided by the police, the inside of your house is then classed as being outside of the greenzone. So you may defend yourself if they enter your house.
					</li>
				</ul>
			</div>
		</div>
		<div id="7.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[7.X]</b> Police/Medical Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[7.1]</b> All active Police/Medical Officers must be on TeamSpeak and in the correct channels.</p>    	
					<p><b>[7.2]</b> Aquiring equipment as a Police/Medical Officer, with the intenet of using said equipment as a civilian is scrictly against server rules.</p>          	
					<p><b>[7.3]</b> Aquiring equipment as a Police/Medical Officer, with the intenet of using said equipment as a civilian is scrictly against server rules.</p>       	
					<p><b>[7.4]</b> Medical Officers are forbidden to revive players during an active gunfight. Three minutes must have passed with no gunfire before player reviving is allowed.</p>        	
					<p><b>[7.5]</b> Police/Medical coruption is not against any server rule. However, any form of coruption that is done, with the intent of disturbing the gameplay of others, is against the rules.</p>      	
					<p><b>[7.6]</b> Using information gained as being a Police/Medical Officer as a civilian is against the rules. Using the Police/Medical Handbook as a civilian to gain an advantage is also against server rules. An exception of using the Police Handbook is to check active laws and punishments.</p>       	
				</div>
			</div>
		</div>
		<div id="8.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[8.X]</b> TeamSpeak Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[8.1]</b> No Voice Changers/Soundboards are to be used in any public channel on our TeamSpeak.</p>    	
					<p><b>[8.2]</b> Music Bots are only permitted for use in the Music Lounge.</p>          	
					<p><b>[8.3]</b> Avatars that are in any way offensive/questionable will be removed and further punishment could follow.</p>       	
					<p><b>[8.4]</b> The, intentional, use of someone else's name is forbidden.</p>        	
					<p><b>[8.5]</b> Spamming is simply considered messaging after requested not to. It is against TeamSpeak rules to spam anyone.</p>      	
					<p><b>[8.6]</b> Leaving an Support Channel without any given permission is not permitted.</p>       	
					<p><b>[8.7]</b> Speaking of events taken place in a Support Room is forbidden.</p>      	
					<p><b>[8.8]</b> Exploiting any permissions error in our TeamSpeak is a bannable offence. e.g. If you can assign a tag you know you shouldn't be able to.</p>  	
					<p><b>[8.9]</b> Skiping the support ladder or a faction's Chain of Command is forbidden. e.g. Don't go messaging the Owner without messaging a Moderator or Administator first.</p>  	
				</div>
			</div>
		</div>
		<div id="9.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[9.X]</b> Website Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[9.1]</b> Avatars/Banners/Signitures that are in any way offensive/questionable will be removed and further punishment could follow.</p>    	
					<p><b>[9.2]</b> Posting offencive topics/replys is against the Website's Rules.</p>          	
					<p><b>[9.3]</b> Replying to topics considered reports are against the Website's Rules.</p>       	
					<p><b>[9.4]</b> Aquiring three warning points will result in further punishment.</p>        					
				</div>
			</div>
		</div>
		<div id="10.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[10.X]</b> Staff Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[10.1]</b> Members of the Staff Team are not to be treated any differently than a normal player.</p>    	
					<p><b>[10.2]</b> Staff members are not to be treated any differently regardless of rank.</p>          	
					<p><b>[10.3]</b> All in-game staff power use is recorded through God's Eye, meaning if a staff member was to compenstate him/herself, it would be logged for the community to see.</p>       	
					<p><b>[10.4]</b> Any issues with the Staff Team are to be taken up with the Head Administator. Any issues with the Head Administator are to be taken up with the Community's Owner, ScarsoLP.</p>        	
					<p><b>[10.5]</b> Staff are not permitted to deal with active situation in-game unless it is causing a major disturbance to the gameplay of others.</p>      	
					<p><b>[10.6]</b> Any decision made by a member of the Staff Team is final. If you feel a decision has been made unfairly, start a report case.</p>       	
					<p><b>[10.7]</b> Offering a member of staff payment is deamed as bribing, and will result in a ban.</p>      	
					<p><b>[10.8]</b> Community/Server Developers develop for the community, not themselves. Therefore any work producded by them, while apart of our development team, exclusively belongs to FreeFlight Interactive and all rights are reserved.</p>  	
					<p><b>[10.9]</b> Attempting to blackmain a member of staff will result in a ban and possible police involement.</p>  	
				</div>
			</div>
		</div>
		<div id="11.X" class="tabcontent">
			<div class="rightLayoutPadding" style="padding-top: 5px;">
				<h2><b>[11.X]</b> Donation Rules</h2>
				<div style="font-size: 14px;">
					<p><b>[11.1]</b> All donations made are made voluntarily, therefore, all donations are final.</p>    	
					<p><b>[11.2]</b> No rewards/perks of your donations will be issued until the payment has arrived into FreeFlight Account.</p>          	
					<p><b>[11.3]</b> Regardless of the situation, your donation will not be refuned. This applied in the case that you are banned, the server is to close, etc.</p>       	
					<p><b>[11.4]</b> Only listed donation rewards/perks will be issued.</p>        					
				</div>
			</div>
		</div>
	</div>
</div>
<div style="clear:both;"></div>
<script>
document.getElementById("defaultOpen").click();
document.getElementById("communityNav").style["box-shadow"] = "0px 0px 0px #00dfff inset";
document.getElementById("ruleNav").style["box-shadow"] = "0px -3px 0px #00dfff inset";

function changeTab(evt, tab, page) {
	switch(page) {
		case "rules":
			history.pushState(null, null, 'http://freeflightinteractive.co.uk/old/Forums/rules/?rule='+tab);
			break;
	}
	var i, tabcontent, tablinks;

	tabcontent = document.getElementsByClassName("tabcontent");
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
<?php
mysqli_close($db);
?>