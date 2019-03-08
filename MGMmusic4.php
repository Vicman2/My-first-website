<!DOCTYPE html>
	<html>
		<head>
			<title> MegaGospelMusic</title>
			<link href="Css/bootstrap.min.css" rel="stylesheet" type="text/css" />
			<link href="Css/toBeHosted.css" rel="stylesheet" type="text/css" />
			<meta name="viewport" content="width=device-width initial-scale = 1.0">
		</head>
		
		
		
		<body class="jsOff">
			<div class="container">
				<div id="logo">
			
				<img src="Images/logo2.jpg"   width="200px" height="40px" />
				<p id="acry">...Changing Lives With Music  <span class="glyphicon glyphicon-music"></span></p>
				</div>
				
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#home">
						<span class="sr-only">MegaGospelMusic</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php"><strong>MegaGospelMusic</strong></a>
					</div>
					<div class="collapse navbar-collapse" id="home">
						<ul class="nav navbar-nav">					

							<li><a href="index.php">Home <span class="glyphicon glyphicon-home"></span></a></li>
							<li class="divider"></li>
							<li  class="active"><a href="MGMmusic.php">Music <span class="glyphicon glyphicon-music"></span></a></li>
							<li class="divider"></li>
							<li><a href="MGMvideos.php">Videos <span class="glyphicon glyphicon-hd-video"></span></a></li>
							<li class="divider"></li>
							<li><a href="upcomingEvent.php">Upcoming Concert <span class="glyphicon glyphicon-sort"></span></a></li>
							<li class="divider"></li>
							<li><a href="Contact.php">Contact us <span class="glyphicon glyphicon-phone-alt"></span></a></li>
							<li><a href="AboutUs.php">About us</a></li>
							
						</ul>
					</div>
					
				</nav>
				
				<h2 class="head"><span class="glyphicon glyphicon-music"></span><b style="font-style:italic">M</b>usic <b style="font-style:italic">M</b>oving <b style="font-style:italic">M</b>ountains<span class="glyphicon glyphicon-music"></span></h2>
					<form role="form" method="post" action="">
						<div class="form-group">
							<input type="hidden" name="posted" value="true" />
							<input type="search" class="form-control" placeholder=" Search here" name="folderName" /><br />
							<input type="submit" class="btn btn-primary" name="search" value="search" />
						</div>
					</form>
					
					<?php
					define("MegaGospelMusic", "Artists");
					
					if(isset ($_POST['posted'])) {
						$folderName = isset ($_POST['folderName']) ? $_POST['folderName']: "";
						
						echo "<p> <i><b> Searching for '$folderName' in '" . MegaGospelMusic."'...</p>";
						$matches = array();
						searchFolder (MegaGospelMusic, $folderName, $matches);
						
						if($matches){
							echo "<h3> Results </h3> ";
							echo "<ul>";
							foreach ($matches as $match){
								if(!($handle1 = opendir ($match))) die ("You cant access this file because of some security reasons.");
								
								?>
								<?php
								while ($file = readdir($handle1)){
									if ($file != "." && $file != ".."){
								$fileName = basename($file, ".php");
								$link ="$match/$file";
								
								echo "<li><a href= $link > $fileName</a></li>";
									}
								}
								closedir($handle1);
							}
							echo "</ul>";
						}else{
							echo "<p>No match found</p>";
						}
						
					}
					
					
				function searchFolder($current_folder, $folder_to_find, &$matches){
				if(!($handle2 = opendir($current_folder))) die ("Cannot open $current_folder."); // opens the Folder to be searched E.g Artist
				while ($entry = readdir($handle2)) {												//reads the folderName and assign it to $entry
					if(is_dir("$current_folder/$entry")) {										// If it is a directory, 
						if($entry != "." && $entry != ".."){									// if the directory is not a directory
							if($entry == $folder_to_find) $matches[] = "$current_folder/$entry"; //
							searchFolder("$current_folder/$entry", $folder_to_find, $matches);
						}
					}
				}
				closedir($handle2);
			}
			
			?>
				
				<ol class="breadcrumb">
						<li><a href="index.php">MegaGospelMusic</a></li>
						<li><a href="MGMmusic.php">Music</a></li>
						
				</ol>
				
				<ul class="pager">
					<li class="previous"><a href="MGMmusic5.php">&larr; Previous</a></li>
					<li class="next"><a href="MGMmusic3.php">&rarr; Next</a></li>
				</ul>
				
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					
						<article>
							<p class="mtitle"> Fred Hammomnd - I Love You</p>
							<figcaption>
							<a href="Artists/Fred-Hammomnd/Fred-Hammomnd-I-Love-You.php"><img class="musician" src="Images/Fred.jpg" alt="Fred" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/Fred i luv u.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Can you ever check out the amount of  God's love on your life ? is it measurable? Now check out how much you love God. Is it...</p>
							<a href="Artists/Fred-Hammomnd/Fred-Hammomnd-I-Love-You.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						<article>
							<p class="mtitle"> Salvation Ministry Choir - Glorified</p>
							<figcaption>
							<a href="Artists/Salvation-Ministry-Choir/Salvation-Ministry-Choir-Glorified.php"><img class="musician" src="Images/Salvation-Ministry.jpg" alt="Salvation-Ministry" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/Glorified @megagospelmusic.com.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Salvation Ministry Choir is one of the leading Choirs in the world because of the uniqueness of their songs...</p>
							<a href="Artists/Fred-Hammomnd/Fred-Hammomnd-I-Love-You.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						<article>
							<p class="mtitle"> Sinach - Glorify Your Name</p>
							<figcaption>
							<a href="Artists/Sinach/Sinach-Glorify-Your-Name.php"><img class="musician" src="Images/Sinach.jpg" alt="Sinach" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/Glorify-Your-Name.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Our praise and worship shouldn't just be what we do within. We express it with with our voice, body and feelings....</p>
							<a href="Artists/Sinach/Sinach-Glorify-Your-Name.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						<article>
							<p class="mtitle"> Brooklyn Tabernacle Choir - God Is Working</p>
							<figcaption>
							<a href="Artists/Brooklyn-Tabernacle-Choir/Brooklyn-Tabernacle-Choir-God-Is-Working.php"><img class="musician" src="Images/Brooklyn.jpg" alt="BTC" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/god is working track 02.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail">  Are you in doubt if God is working? Are you doubting the existence that the Supreme being ?  If yes, then this song...</p>
							<a href="Artists/Brooklyn-Tabernacle-Choir/Brooklyn-Tabernacle-Choir-God-Is-Working.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						<article>
						<p class="mtitle"> Viwe Nikita - God Of Everything</p>
							<figcaption>
							<a href="Artists/Viwe-Nikita/Viwe-Nikita-God-Of-Everything.php"><img class="musician" src="Images/Viwe.jpg" alt="Viwe" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/GOD OF EVERYTHING .mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> The King of Kings is the first and the last, he is the beginning and the end. He is the God of everything.  He knows all things and can do...</p>
							<a href="Artists/Viwe-Nikita/Viwe-Nikita-God-Of-Everything.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						<article>
							<p class="mtitle"> Elijah Oyelade - Highly Lifed</p>
							<figcaption>
							<a href="Artists/Elijah-Oyelade/Elijah-Oyelade-Highly-Lifted.php"><img class="musician" src="Images/Oyelade.jpg" alt="Oyelade" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/gospelmenu-elijah-oyelade-1752.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Worship him for there is no one like him. He deserves our worship and praise. Lift him higher above all things because...</p>
							<a href="Artists/Elijah-Oyelade/Elijah-Oyelade-Highly-Lifted.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					
					<p class="mtitle"> Max Lucado - My Heart Will Trust</p>
							<figcaption>
							<a href="Artists/Max-Lucado/Max-Lucado-My-Heart-Will-Trust.php"><img class="musician" src="Images/Lucado.jpg" alt="Lucado" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/GospMy Heart Will Trust.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> At the point of depression, where will your heart be? Who will trust? What will you believe ?  Our God is a comforter, just trust in him and you will...</p>
							<a href="Artists/Max-Lucado/Max-Lucado-My-Heart-Will-Trust.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						<p class="mtitle"> Alexandra Burke - Hallelujah</p>
							<figcaption>
							<a href="Artists/Alexandra-Burke/Alexandra-Burke-Hallelujah.php"><img class="musician" src="Images/Burke.jpg" alt="Burke" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/Hallelujah.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Sometimes people think that where their are, what their have become, what they have today is just by what thier have done....</p>
							<a href="Artists/Alexandra-Burke/Alexandra-Burke-Hallelujah.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						
						<p class="mtitle"> Steve Green - Hallelujah, Salvation And Glory</p>
							<figcaption>
							<a href="Artists/Steve-Green/Steve-Green-Hallelujah-Salvation-And-Glory.php"><img class="musician" src="Images/SGreen.jpg" alt="SGreen" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/halleluyah, salvation and glory.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Steve Green is a very popular Gospel musician that is well known for his tenor vocal range. He sang a whole lot of song which...</p>
							<a href="Artists/Steve-Green/Steve-Green-Hallelujah-Salvation-And-Glory.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						
						<p class="mtitle"> Tasha Cobbs - Happy</p>
							<figcaption>
							<a href="Artists/Tasha-Cobbs/Tasha-Cobbs-Happy.php"><img class="musician" src="Images/Tasha.jpg" alt="Tasha" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/HAPPY by tasha cobbs.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Is there anyone that can make you happy other than God? He is the God that can never fail. Adopting that to your mind is a useful tool...</p>
							<a href="Artists/Tasha-Cobbs/Tasha-Cobbs-Happy.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						
						<p class="mtitle"> Don Meon - He Never Sleep</p>
							<figcaption>
							<a href="Artists/Don-Meon/Don-Meon-He-Never-Sleep.php"><img class="musician" src="Images/Don Meon.jpg" alt="Don Meon" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/He Never Sleeps.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail"> Our Lord God never sleep nor slumber. He is always awake to take Good care of us at any. He is the almighty living God that always keep to his promises...</p>
							<a href="Artists/Don-Meon/Don-Meon/He-Never-Sleep.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
						<p class="mtitle"> Brooklyn Tabernacle Choir - He Reigns Forever</p>
							<figcaption>
							<a href="Artists/Brooklyn-Tabernacle-Choir/Brooklyn-Tabernacle-Choir-He-Reigns-Forever.php"><img class="musician" src="Images/Brooklyn.jpg" alt="BTC" /></a>
							</figcaption><br />
							<audio class="audio" src="Music/HE REIGNS FOREVER.mp3" width="30%" heigth="30" controls></audio><br /><br />
							<p><b>UPLOADED :</b></p>
							<p class="detail">  Our Lord God never sleep nor slumber. He is always awake to take Good care of us at any. He is the almighty living God that always keep to his promises...</p>
							<a href="Artists/Brooklyn-Tabernacle-Choir/Brooklyn-Tabernacle-Choir-He-Reigns-Forever.php"><button type="button" class="btn btn-primary">More  &rsaquo; </button></a>
						</article>
						<hr class="demacator" />
						
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					</div>
				</div>
				
				<ul class="pager">
					<li class="previous"><a href="MGMmusic5.php">&larr; Previous</a></li>
					<li class="next"><a href="MGMmusic3.php">&rarr; Next</a></li>
				</ul>
				
				<footer>
				<div class="row footer">
					<div class="col-lg-4 col-md-4 col-sm-4">
						copyright &copy;2018 megagospelmusic.com   All rights reserved <br />
						<a href="../../Contact.php">Contact us</a><br />
						<a href="#">Wants to build a site?</a><br />
						<a href=""> To Top</a>
						
						
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4">
						Powered by Vic-Tech Global<br />
						<a href="../../MGMmusic.php">Musics</a><br />
						<a href="../../MGMvideos.php">Videos</a><br />
						<a href="../../AboutUs.php">About us</a><br />
					</div>
					<div class="col-lg-4 col-md-24 col-sm-4">
						<a href="#"> Have a complaint ? </a><br />
					</div>
				</div>
				</footer>
				
			</div>
		
		
		
		
		
			<script src="Javascript/jquery-3.2.1.min.js"></script>
			<script src="Javascript/bootstrap.min.js"></script>
			<script src="Javascript/toBeHosted.js"></script>
		</body>
			
		