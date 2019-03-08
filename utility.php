<?php
	function utility($adjust = false, $title){
		$baseist =  basename($_SERVER["PHP_SELF"], ".php");
		$theTitle = str_replace("-", " ", $title);
		$description = strtoupper(str_replace("-", " ", $title));
		$keywords = str_replace("-", ", ", $title);
?>
	<!DOCTYPE html>
		<html>
			<head>
				<title><?php echo $theTitle ?></title>
				<link href="<?php if($adjust) echo "../../"?>Css/bootstrap.min.css" rel="stylesheet" type="text/css" />
				<link href="<?php if($adjust) echo "../../"?>Css/toBeHosted.css" rel="stylesheet" type="text/css" />
				<meta name="viewport" content="width=device-width initial-scale = 1.0">
				<meta name="description" content=" Download <?php $description ?>" />
				<meta name="keywords" content="<?php echo $keywords ?>" />
				<meta http-equiv="author" content="vicman" />



				<div id="fb-root"></div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				</script>
			</head>





			<body class="jsOff">
				<div class="container">
					<div class="row" id="logo">
						<div class="col-md-4 col-lg-4">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" >
							<a href="<?php if($adjust) echo "../../"?>index.php"><img src="<?php if($adjust) echo "../../"?>Images/logo2.jpg"   width="300px" height="200px" class="img-rounded"  /></a>
						</div>
					</div>
					<div class="row">
							<p id="acry">...Changing Lives With Music  <span class="glyphicon glyphicon-music"></span></p>
					</div>

					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#home">
							<span class="sr-only mot">MegaGospelMusic</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<?php
								$base = basename($_SERVER["PHP_SELF"], ".php");
							?>

							<a class="navbar-brand mot" href="<?php if($adjust) echo "../../"?>index.php"><strong>MegaGospelMusic</strong></a>
						</div>
						<div class="collapse navbar-collapse" id="home">
							<ul class="nav navbar-nav">

								<li class="<?php if ($base == "index") echo  "active ";?> mot"><a href="<?php if($adjust) echo "../../"?>index.php">Home<span class="glyphicon glyphicon-home"></span></a></li>
								<li class="divider"></li>
								<li class="mot <?php if($base == "MGMmusic") echo "active";?> <?php if ($adjust) echo  "active";?>" ><a href="<?php if($adjust) echo "../../"?>MGMmusic.php">Music<span class="glyphicon glyphicon-music"></span></a></li>
								<li class="divider"></li>
								<li class="divider"></li>
								<li class=" <?php if($base == "upcomingEvent") echo "active "; ?> mot"><a href="<?php if($adjust) echo "../../"?>upcomingEvent.php">Upcoming Concert<span class="glyphicon glyphicon-sort"></span></a></li>
								<li class="divider"></li>
								<li class="<?php if($base == "Contact") echo "active"?> mot"><a href="<?php if($adjust) echo "../../"?>Contact.php">Contact us <span class="glyphicon glyphicon-phone-alt"></span></a></li>
								<li class="<?php if($base == "AboutUs") echo "active"?> mot"><a href="<?php if($adjust) echo "../../"?>AboutUs.php">About us</a></li>

							</ul>
						</div>

					</nav>


							<h2 class="head"> Singing Jesus<br />
								Download your Latest Gospel Music</h2>
								<?php
						if($adjust == false){
							?>
						<form role="form" method="post" action="">
							<div class="form-group">
								<input type="hidden" name="posted" value="true" />
								<input type="search" class="form-control" placeholder=" Search By Artist Name E.g Frank-Edward" name="folderName" /><br />
								<input type="submit" class="btn btn-primary" name="search" value="search" />
							</div>
						</form>

						<?php

						define("MegaGospelMusic", "Artists");

						function searchFolder($current_folder, $folder_to_find, &$matches){
							if(!($handle2 = opendir($current_folder))) die ("Cannot open $current_folder."); // opens the Folder to be searched E.g Artist
								while ($entry = readdir($handle2)) {												//reads the folderName and assign it to $entry
									if(is_dir("$current_folder/$entry")) {										// If it is a directory,
										if($entry != "." && $entry != ".."){									// if the directory is not a directory
											if($entry == $folder_to_find){
												if(basename("$current_folder/$entry", ".php")){
													$matches[] = "$current_folder/$entry";
												}
											}//
												searchFolder("$current_folder/$entry", $folder_to_find, $matches);
								}
							}
						}
						closedir($handle2);
					}

						if(isset ($_POST['posted'])) {
							$folderName = isset ($_POST['folderName']) ? $_POST['folderName']: "";

							if($adjust){
								echo "<p> <i><b> Searching for '$folderName' in in our music library...</p>";
							}
							$matches = array();

								searchFolder (MegaGospelMusic, $folderName, $matches);

							if($matches){
								echo "<h3> Results </h3> ";
								echo '<ul class="list-group">';
								foreach ($matches as $match){
									if(!($handle1 = opendir ($match))) die ("You can't access this file because of some security reasons.");

									?>
									<?php
									while ($file = readdir($handle1)){
										if($file != "." && $file != ".."){
											$info = new SplFileInfo($file);
											if($info->getExtension() == "php"){
												$fileName = basename($file, ".php");
												$link ="$match/$file";

												echo '<li class = "list-group-item">'."<a href= $link > $fileName</a></li>";
											}
										}
									}
									closedir($handle1);
								}
								echo "</ul>";
							}else{
								echo "<p>No match found</p>";
							}

						}
					}




				?>



<?php
	}

	function footer($adjust = false){
			if($adjust){
				moreMusic();
			}


?>
<div class="row list-group-item">
		<p class="mtitle"> ABOUT VICMAN </p>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  list-group-item">
			<img class="musician img-circle" src="<?php if($adjust) echo "../../"?>Images/vic7.jpg" alt="Samsong" />
		</div>
		<div id="vicman">
		<p> <b>Name</b> : OFFORDILE CHIMAOBI VICTOR </p>
		<p> Phone Number :<a href="callto:+2348102764439"> <strong> +2348102764439</strong></a></p>
		<p> Email : <a href="mailto:vicmanthebest@gmail.com">vicmanthebest@gmail.com</a></p>
		<p> CEO VIC-TECH GLOBAL COMPANY </P>
		<p> Founder Of megagospelmusic.com</p>
		<p> Web Designer/Programmer. </p>

		</div>
</div>


	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4">
			<div  class="fb-like list-group-item" data-href="https://www.facebook.com/Megagospelmusic-448232562251897/"
				data-layout="standard" data-action="like" data-size="small" data-show-faces="false" data-share="true">
			</div>
		</div>
	</div>
		<footer>
				<div class="row footer">
					<div class="col-lg-4 col-md-4 col-sm-4">
						copyright &copy;2018 megagospelmusic.com  All rights reserved <br />
						<a href="<?php if($adjust) echo "../../"?>contact.php">Contact us</a><br />
						<a href="">Wants to build a site?</a><br />
						<a href="<?php if($adjust) echo "../../"?>index.php"> To Top</a>


					</div>
					<div class="col-lg-4 col-md-4 col-sm-4">
						Powered by <strong>Vic-Tech Global</strong><br />
						<a href="<?php if($adjust) echo "../../"?>MGMmusic.php">Musics</a><br />
						<a href="<?php if($adjust) echo "../../"?>AboutUs.php">About us</a><br />
					</div>
					<div class="col-lg-4 col-md-24 col-sm-4">
						Scripted by <strong>VICMAN</strong><br />
						<a href="<?php if($adjust) echo "../../"?>Contact.php"> Have a complaint ? </a><br />
						<a href="<?php if($adjust) echo "../../"?>upcomingEvent.php">Upcoming Events</a><br />
					</div>
				</div>
				</footer>

			</div>





			<script src="<?php if($adjust) echo "../../"?>Javascript/jquery-3.2.1.min.js"></script>
			<script src="<?php if($adjust) echo "../../"?>Javascript/bootstrap.min.js"></script>
			<script src="<?php if($adjust) echo "../../"?>Javascript/toBeHosted.js"></script>
		</body>
<?php
	}
?>

<?php

function commenting($nameOfSong){
	?>
	<div class="row">
		<div class="col-xs-12  col-sm-6 col-md-4 col-lg-4 contactForm">

			<h1 style="text-align: center; font-family: Comic Sans Ms; "> Leave a comment</h1>


			<form  role="form" method="post" action="<?php echo basename( $_SERVER['PHP_SELF'] ) ?>">
				<div class="form-group">
					<label for="name"> Name: </label><br />
					<input class="form-control" type="text" name="name" value="" id="name" />
				</div>
				<div class="form-group">
					<label for="email"> Email: </label><br />
					<input class="form-control" type="email" name="email" value="" id="email" />
				</div>
					<label for="comment" style="margin-bottom:20px;"><strong> Please input your comments in the box below .</strong></label><br/>
					<br />
					<textarea id="comment" class="form-control" name="com" rows="4"></textarea><br />
					<input type="submit" value="Comment" name="comment"/>

	<?php
		if(isset($_POST["comment"])){
			if($_POST["name"] != "" && $_POST["com"] != ""){
				$comTime = getdate();
				$commValue = array();
				$commValue[] = $_POST["name"];
				$commValue[] = $_POST["com"];
				$commValue[] = $_POST["email"];
				$commValue[] = $comTime["hours"]. ": ".$comTime["minutes"].": ". $comTime["seconds"]." ". $comTime["weekday"]. " ". $comTime["mday"]. " ". $comTime["month"]. " ".$comTime["year"];


				$handle1 = fopen($nameOfSong."Comment".".csv", "a+");
				$make = implode(',', $commValue);
				$make2 = explode(',', $make);

				fputcsv($handle1, $make2);
			}

		}


		$handle = fopen($nameOfSong."Comment".".csv", "a+");
		$lineNumber = 0;
		echo '<dl>';
		while($line =fgetcsv($handle)){
			echo  " <dt><strong><b>".strtoupper($line[0])." on " .$line[3]. "</b></strong> said </dt>";
			echo '<dd style="margin:5px; border-bottom: 3px solid grey; padding: 5px;">'.$line[1]."</dd>";
			$lineNumber++;
		}
		if($lineNumber > 0){
			echo $lineNumber. " worshipper  commented on this music. <br />";
		}

?>
		</div>
	</div>
<?php
}

function moreMusic(){
	$handle= opendir(".");
?>
	<p style="color:rgb(177, 49, 0); font-size:23px;font-style:italic"> You can also search for:</p>
	<div class="row">
		<div class="col-xs-12  col-sm-6 col-md-4 col-lg-4">

		<ul class="list-group">
<?php
	while($file = readdir($handle)){
		if($file != "." && $file != ".."){

			$info = new SplFileInfo($file);
			if($info->getExtension() == "php"){
				$fileName = basename($file, ".php");
				$link = basename($file);

				echo '<li class="list-group-item">'."<a href=$link >".basename($fileName, ".php")."</a></li>";
			}



		}
	}

	closedir($handle);
	echo "</ul>";
	echo "</div></div>";
}



function noOfComments($artist, $nameOfSong){
	$handle = fopen("Artists/$artist/$artist-$nameOfSong"."Comment.csv", "a+");
	$lineNumber = 0;
	while($line = fgetcsv($handle)){
		$lineNumber++;
	}
	If($lineNumber > 0){
		return $lineNumber;
	}else{
		return "0";
	}
}

?>
