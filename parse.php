<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SPAN Parser</title>
</head>

<body>
	<?php 
		$samplefile='resumeSample.resume';
		$xmlDoc = simplexml_load_file($samplefile);
	if ($xmlDoc ['type'] != "resume"){
		echo ("SPAN Object is not a Resume");
		exit();
	}
		
	?>
	<?php 
	$candidate = $xmlDoc -> head -> candidate;
	$fname = $candidate -> givenname;
	$lname = $candidate -> familyname;
	if ($candidate->givenname ['hasSuffix'] == "true"){
		$suffix = $candidate -> suffix;
		$lname = $lname . ", " . $suffix;
	}
	?>
	<h1><?php echo $fname; ?> <?php echo $lname; ?></h1>
	<hr>
	<?php
		$contacts = $candidate -> contacts;
		foreach ($contacts->contact as $contactObj) {
			if ($contactObj ['type'] == "landphone"){
				$pref = $contactObj ['preferred'];
				$ccode = $contactObj ['country'];
				$cdetail = $contactObj;
				
				if ($ccode != "+1"){
					$cdetail = ($ccode . " " . $cdetail);
				}
								
				if ($pref=="true"){
					echo "<b> Landline: " . $cdetail . "</b> ";
				}
				else {
					echo "Landline: " . $cdetail . " ";
				}
			}
			elseif ($contactObj ['type'] == "mobilephone") {
				$pref = $contactObj ['preferred'];
				$ccode = $contactObj ['country'];
				$cdetail = $contactObj;
				
				if ($ccode != "+1"){
					$cdetail = ($ccode . " " . $cdetail);
				}
								
				if ($pref=="true"){
					echo "<b> Mobile: " . $cdetail . "</b> ";
				}
				else {
					echo "Mobile: " . $cdetail . " ";
				}
			}
			elseif ($contactObj ['type'] == "email"){
				$pref = $contactObj ['preferred'];
				$cdetail = $contactObj;
				if ($pref=="true"){
					echo "<b> email: <a href mailto:" .$cdetail . ">" . $cdetail . "</a></b> ";
				}
				else{
					echo "email: <a href mailto:" .$cdetail . ">" . $cdetail . "</a> ";
				}
			}
			
		}
		
	?>
	<hr>
<h2>Authorizations and Licenses:</h2>
	<?php
		$authorization = $xmlDoc->head->authorization;
	?>
	<table border="1">
		<tr>
			<?php 
				
				foreach($authorization->government as $govAuthObj){
					echo "<td align='center'>";
					$gIssue = $govAuthObj['country'];
					echo ("<b>" . $gIssue . "</b><br>");
					$gType = $govAuthObj['type'];
					switch ($gType){
						case "citizenship":
							echo "Citizen<br>";
							break;
						case "authorization":
							echo "Work Authorization<br>";
							break;
						case "resident":
							echo "Perm Resident<br>";
							break;
						case "clearance":
							echo "Security Clearance<br>";
							$cltype = $govAuthObj->level;
							echo $cltype;
							if ($govAuthObj->active != "true"){
								echo " <i>Inactive</i>";
							}
							break;
						}
					echo "</td>";
				}
			?>
		</tr>
	</table><br>
	<table border="1">
		<tr>
	<?php
		foreach($authorization->license as $govLicObj){
			echo "<td align='center'>";
			if ($govLicObj ['type'] == "driver"){
				echo "<b>Driver License</b><br>";
				$licState = $govLicObj['state'];
				echo ucfirst($licState);
				echo "</td>";
			}
			else {
				$licTitle = $govLicObj->title;
				echo("<b>" . $licTitle . "</b><br>");
				$licIssuer = $govLicObj->issuer->legalName;
				echo $licIssuer;
			}
		}
	?>
		</tr>
	</table>
<hr>
<h2>Formation:</h2>
	<?php 
		$formation = $xmlDoc -> formation;
	
		foreach ($formation->credential as $credentialObj) {

			
			if ($credentialObj['type']=="education"){
				$eduDeg = $credentialObj -> degree;
				$eduTitle = $credentialObj -> title;
				if (isset($credentialObj->latin)){
					$eduLatin = $credentialObj->latin;
				}
				if (isset($credentialObj->gpa)){
					$edugpa = $credentialObj -> gpa;
				}
				echo ("<h3><b>" . $eduDeg . "</b> in  <b><i>" . $eduTitle . "</i></b></h3>");
				if (isset($eduLatin)){
					echo ("<i>" . $eduLatin . "</i> ");
				}				
				if (isset($edugpa)){
					echo ("<b>GPA: </b>" . $edugpa);
				}
			}
			elseif ($credentialObj['type']=="exam"){
				$certTitle = $credentialObj -> title;
				$certCompl = $credentialObj -> complete;
				echo ("<h3>" . $certTitle . "</h3>");
				echo ("<p>" . $certCompl . "</p>");
			}
			$ins = $credentialObj -> institution -> legalName;
			echo ("<h4>" . $ins . "</h4>");
			if (isset($credentialObj -> institution -> city)){
				$insCty = $credentialObj -> institution -> region;
				$insCity = $credentialObj -> institution -> city;
				$insSt = $credentialObj -> institution -> state;
				echo ('<p><i><b>' . $insCity . ', ' . $insSt . '</b> ' . $insCty .'</i><br></p>');
			}
		}
	?> 
<hr>
<h2>Experience:</h2>
	
	<table>
	<?php
		$experience = $xmlDoc -> experience;
		foreach ($experience->role as $rolObj){
			echo "<tr><td>";
			$eObj = $rolObj->employer;
			$eName = $eObj->legalName;
			$eCity = $eObj->city;
			$eState = $eObj->state;
			
			$rTitle=$rolObj->title;
			$rStart=$rolObj->start;
			if (isset($rolObj->complete)){
				$rEnd = $rolObj->complete;
			}
			else {
				$rEnd = "Present";
			}
			echo "<b>" . $rTitle . "</b><br>";
			echo $rStart . " - " . $rEnd . "<br>";
			echo "<b><i>" . $eName . "</i></b> - " . $eCity . ", " . $eState . "<br>";
			echo "<hr>";
			echo "<b>Duties:</b><br>";
			if ($rolObj->duties['format']==bullet){
				echo "<ul>";
				foreach ($rolObj->duties->it as $dutyItem){
					echo "<li>" . $dutyItem . "</li>";
				}
				echo "</ul>";
			}
			else {
				echo "<p>" . $rolObj->duties . "</p>";
			}
			echo "</td></tr>";	
		}
	?>
	</table>
<?php if (isset($experience->internship)){ ?>
<h4>Internships:</h4>

	<table>
	<?php
		$experience = $xmlDoc -> experience;
		foreach ($experience->internship as $rolObj){
			echo "<tr><td>";
			$eObj = $rolObj->employer;
			$eName = $eObj->legalName;
			$eCity = $eObj->city;
			$eState = $eObj->state;
			
			$rTitle=$rolObj->title;
			$rStart=$rolObj->start;
			if (isset($rolObj->complete)){
				$rEnd = $rolObj->complete;
			}
			else {
				$rEnd = "Present";
			}
			echo "<b>" . $rTitle . "</b><br>";
			echo $rStart . " - " . $rEnd . "<br>";
			echo "<b><i>" . $eName . "</i></b> - " . $eCity . ", " . $eState . "<br>";
			echo "<hr>";
			echo "<b>Duties:</b><br>";
			if ($rolObj->duties['format']==bullet){
				echo "<ul>";
				foreach ($rolObj->duties->it as $dutyItem){
					echo "<li>" . $dutyItem . "</li>";
				}
				echo "</ul>";
			}
			else {
				echo "<p>" . $rolObj->duties . "</p>";
			}
			echo "</td></tr>";	
		}
	?>
	</table>
	
<?php } ?>
</body>
</html>