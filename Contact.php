<?php
	require_once("utility.php");
	require_once("Mail.php");
	require_once('Mail/mime.php');

	utility($adjust = false, "MegaGospelMusic");
	?>



				<?php
				if(isset($_POST["submitButton"])){
					processForm(); // If the user submits the form, call this function
				}else{
					displayForm(array()); // Display This if the the user loads the page
				}

				function validateFields($fieldName, $missingFields){ // Validating the label i.e putting the red color to show an error.
					if(in_array($fieldName, $missingFields)){
						echo 'class="error"';
					}
				}

				function setValue($fieldName){
					if(isset($_POST[$fieldName])){
						echo $_POST[$fieldName];
					}
				}

				function setChecked($fieldName, $fieldValue){
					if(isset($_POST[$fieldName]) and $_POST[$fieldName]== $fieldValue){
						echo 'checked = "checked"';
					}
				}

				function setSelected($fieldName, $fieldValue){
					if(isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue){
						echo 'selected = "selected"';
					}
				}


				function processForm(){
					$requiredFields = array("CompName","PhoneNo", "Email","Residential_Address", "KnowUs", "Subject");
					$missingFields = array();

					foreach($requiredFields as $requiredField){
						if(!isset(($_POST[$requiredField])) or !trim($_POST[$requiredField])){
							$missingFields[] = $requiredField;
						}
					}
					if($missingFields){
						displayForm($missingFields);
					}else{
						displayThanks();
					}
				}

				function displayForm($missingFields){
				?>



					<h1> What do you have to tell us ?</h1>
					<p> Please be free to tell us anything, your message and email are highly encrypted, and can never be published.</p>




				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 contactForm">
					<?php if($missingFields) { ?>
					<p class="error"> There were some problems with the form you submitted. check the fields highlighted and fill again</p>
					<?php }else {?>
					<p> Thanks for choosing to partner with us. Make sure that the information you provided are correct.</p>



					<?php } ?>

					<form role="form" action="Contact.php" method="post">
						<div class="form-group">
							<label for="name"  <?php validateFields("CompName", $missingFields) ?>>Name *</label>
							<input type="text" class="form-control ind_form" id="name" name="CompName"  placeholder="Company Name is also valid"  value="<?php setValue("CompName") ?>"/>

						</div>

						<div class="form-group">
							<label for="Phone_NO" <?php validateFields("PhoneNo", $missingFields) ?>> PHONE NO *</label>
							<input type="number" class="form-control ind_form" id="Phone_NO" name="PhoneNo" placeholder="Enter Mobile Number" value="<?php setValue("PhoneNo") ?>"/>

							<div class="form-group">
								<label for="Email_Address" <?php validateFields("Email", $missingFields) ?>>Email Address *</label>
								<input type="email" class="form-control ind_form" name="Email" id="Email_Address" value="<?php setValue("Email") ?>" placeholder="Your Email Please"/>

							</div>

							<div class="form-group">
								<label for="Residential_Address" <?php validateFields("Residential_Address", $missingFields) ?>>Residential Address *</label>
								<input type="text" class="form-control ind_form" id="Residential_Address" name="Residential_Address" value="<?php setValue("Residential_Address") ?>" placeholder="Where do you/Company reside ?" />

							</div>

							<div class="ind_form">

								<label for="checked" <?php validateFields("KnowUs", $missingFields) ?>> How did you get to know us ? *</label>
								<div class="radio">
									<label >
									  <input type="radio" name="KnowUs" id="friend"
										 value="A Friend" <?php setChecked("KnowUs", "friend") ?>>  A Friend
								   </label>
								</div>
								<div class="radio">
								   <label for="google">
									  <input type="radio" name="KnowUs"  id ="google"
										 value="google" <?php setChecked("KnowUs","google") ?>>
										 Google
								   </label>
								</div>

								<div class="radio">
								   <label>
									  <input type="radio" name="KnowUs" id="Advertisement"
										 value="Advertisement" <?php setChecked("KnowUs", "Advertisement") ?>>
										 Advertisements
								   </label>
								</div>

								<div class="radio">
								   <label>
									  <input type="radio" name="KnowUs" id="Others"
										 value="others"  <?php setChecked("KnowUs", "others") ?>>
									Others
								   </label>
							</div>

						</div>
						 <div class="form-group">
							<label for="Subject"  <?php validateFields("Subject", $missingFields) ?>>Subject *</label>
								<textarea class="form-control" id="Subject" name="Subject" rows="4" ><?php setValue("Subject") ?></textarea>
						</div>

					</div>
					<div class="btn-group">
						<input type="submit" name="submitButton" class="btn btn-success Submit" align="center" value="Submit" />
					</div>
				</form>
			</div>
			<?php
				}
				function displayThanks(){
					insertToDb();
					sendMailToClient();
				?>
					<h1> <strong> Contact report</strong></h1>
					<p> Thank you  <b><i><strong><?php echo strtoupper($_POST["CompName"]) ?></i></b></strong> Your request have been recieved. The information below has been sent to us. We
						will get back to you as soon as we can.</p>
					<table class="table table-striped">
						<caption id="info-Caption"> <span class="label label-success">Your Info</span> </caption>
							<tr>
								<td>Company/Customer Name</td>
								<td><?php echo  strtoupper($_POST["CompName"])?></td>
							</tr>

							<tr>
								<td>Phone Number </td>
								<td><?php echo strtoupper($_POST["PhoneNo"])?></td>
							</tr>

							<tr>
								<td>Email</td>
								<td><?php echo strtoupper($_POST["Email"])?></td>
							</tr>

							<tr>
								<td>Address</td>
								<td><?php echo strtoupper($_POST["Residential_Address"])?></td>
							</tr>

							<tr>
								<td>You knew us from </td>
								<td><?php echo strtoupper($_POST["KnowUs"]) ?></td>
							</tr>

							<tr>
								<td>Service Description</td>
								<td><?php echo strtoupper($_POST["Subject"])?></td>
							</tr>
					</table>


					<div class="btn-group">
						<a href="index.php"><button class="btn-success"> OK</button></a>
					</div>

					<?php
					}

					function  insertToDb(){
						$dsn = "mysql:host=seventeen;dbname=megagosp_Worshippers";
						$username = "username"; // For security reasons
						$password = "password";// For security reasons

						try{
							$conn = new PDO($dsn, $username, $password);
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection failed: " . $e->getMessage();
						}

						$compName = $_POST["CompName"];
						$phoneNumber = $_POST["PhoneNo"];
						$email = $_POST["Email"];
						$residentialAddress = $_POST["Residential_Address"];
						$knowUs = $_POST["KnowUs"];
						$subject = $_POST["Subject"];
						$orderDate = date("Y-m-d");

						$sql = "INSERT INTO worshipper(name, phoneNum, Address, orderDate, emailAddress, KnowUsFrom, Subject )  VALUES(:compName, :phoneNumber, :residentialAddress, :orderDate , :email , :knowUs, :subject)";

						try{
							$st = $conn->prepare($sql);
							$st->bindValue(":compName", $compName, PDO::PARAM_STR);
							$st->bindValue(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
							$st->bindValue(":email", $email, PDO::PARAM_STR);
							$st->bindValue(":residentialAddress", $residentialAddress, PDO::PARAM_STR);
							$st->bindValue(":knowUs", $knowUs, PDO::PARAM_STR);
							$st->bindValue(":subject", $subject, PDO::PARAM_STR);
							$st->bindValue(":orderDate", $orderDate, PDO::PARAM_STR);
							$st->execute();
						}catch(PDOException $e){
							die("Query failed: ". $e->getMessage());
						}
					}
					?>
				</div>


				<?php
					footer();
				?>

				<?php
						function  sendMailToClient(){
							$name = $_POST["CompName"];
							$email = $_POST["Email"];
							$to = "vicmanthebest@gmail.com";// The email of the person to be sent to , if you have a so many recipient, then it should be splitted with commas
							$username = "info@megagospelmusic.com"; // The domamin email, where the mail is coming from
							$password = ""; // The password of the mail in the top
							$from = "MegaGospelMusic <info@megagospelmusic.com>"; // The domamin email, where the mail is coming from
							$subject  = "MegaGospelMusic"; // It is like a subtopic, or the name of the company the mail is coming from
							$message = "Thank you ".strtoupper($name)."   We have recieved your report. You will hear from us shortly."; // The body of the maill, akind of the content
							$headers = array('From'=>$from, 'To'=>$to, 'Subject'=>$subject); // This is an array containing the header, where the mail is coming from and going.
							$path_to_file= "Images/logo2.jpg";

								$text = ''; // text versions of email.
								$html = "<html><body>Name: $name <br>Message: $message <br></body></html>"; // html versions of email.

								$crlf = "\n";

								$mime = new Mail_mime($crlf);
								$mime->setTXTBody($text);
								$mime->setHTMLBody($html);
								//do not ever try to call these lines in reverse order
								$body = $mime->get();
								$headers = $mime->headers($headers);


							$smtp = Mail::factory('smtp', array('host'=>localhost, 'auth'=>true, 'username'=>$username, 'password'=>$password, 'port'=> 25));
							$mail = $smtp->send($to, $headers, $body);
							if(PEAR::isError($mail)){
								echo "<p>".  $mail->getMessage(). "</p>";
							}else{
								echo "Message sent!! Hurray";
							}
						}
				 ?>
