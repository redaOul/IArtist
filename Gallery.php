<?php
	session_start();
	if( isset($_SESSION['user']) ){
		// -------------------
	}else {
		header("Location: LandingPage.php", true);
		die("");
	}
	$username = 'root';
	$password = '';
	$database = new PDO('mysql:host=localhost;dbname=IArtist;charset=utf8', $username, $password);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./PROJET/Css/Gallery.css">
		<title>IArtist - Gallery</title>
		<link rel="shortcut icon" href="./PROJET/Icons/LogoIcons/IAtistSmallIcon.svg" />
	</head>
	<body>
		<?php
			if (isset($_GET['manage'])) : ?>
				<body onload="editmodal();">
			<? endif; 
			include './header.php';
		?>
		<ul>   <!-- select wich button will appear -->
			<?php
				if (empty($_GET['famous-id'])) {
					if (isset($_GET['user-id'])): ?>
						<li>
							<a href="./Chat.php?user-id=<?= $_GET['user-id'] ?>">
									<button type="button" class="head-button">chat</button>
							</a>
						</li>
					<? else:?>
						<li>
							<button type="button" class="head-button" onclick="editmodal();">edit</button>
						</li>
					<? endif;
				}else {}?>
		</ul>
		<?php  // select wich type of user
			if (empty($_GET['user-id'])) {
					if (empty($_GET['famous-id'])) {
						$varID = $_SESSION['user']->UTILISATEURID;
						$varsign = 1;
					}
					else {
						$varID = $_GET['famous-id'];
						$varsign = 2;
					}
			}else {
					$varID = $_GET['user-id'];
					$varsign = 1;
			}
		?>
		<main>
			<?php
				if ($varsign == 1){
					$sql1 = $database->prepare("SELECT * FROM UTILISATEUR WHERE UTILISATEURID = :VAR1");
				}else{
					$sql1 = $database->prepare("SELECT * FROM ARTISTE WHERE ARTISTEID = :VAR1");
				}
				$sql1->bindParam("VAR1", $varID);
				$sql1->execute();
				$sql1res = $sql1->fetchObject();
				if (!file_exists($sql1res->PHOTOC)) $sql1res->PHOTOC = "./PROJET/Images/Images/cover-profil/unnamed.jpg";
				if (!file_exists($sql1res->PHOTOP)) $sql1res->PHOTOP = "./PROJET/Images/Images/photo-profil/Unknown.png";
			?>
			<header style="background-image: url('<?= $sql1res->PHOTOC ?>') !important;" ></header>   <!-- edit on css to change cover -->
			<div class="account-img"> <img class="photo" src="<?= $sql1res->PHOTOP ?>"/> </div>
			<div class="account-info">
				<h4 class="name"><?= $sql1res->NOM ?></h4>
				<?php if ($varsign == 1): ?>
					<p class="desc"><?= $sql1res->BIO ?></p>
				<? endif;?>
			</div>
			
			<?php if (($varID === $_SESSION['user']->UTILISATEURID) && ($varsign != 2)): ?>
					<div style="margin-top: 20px;">
						<div class="add-drawing" >
							<h2 >Add more drawings</h2>
							<form method="POST" enctype="multipart/form-data">
								<span>Add drawing:</span>
								<div class="image-upload">
									<label for="file-input" required>
										<img style="cursor: pointer" src="./PROJET/Icons/adddrawing.svg" required/>
										<img id="output">
									</label>
									<input id="file-input" onchange="loadFile(event)" type="file" accept="image/*" name="drawing" required><br>
								</div>
								<span>Drawing name:</span>
								<input class="name" type="text" placeholder="Drawing name" name="Dname" required >
								<div>Drawing description:</div>
								<textarea name="Ddesc"></textarea><br>
								<span>Drawing type:</span>
								<select style="cursor: pointer" name="Dtype" required >
									<option value="">Select drawing type</option>
									<?php
										$sql5 = $database->prepare("SELECT * FROM GENRES");
										$sql5->execute();
										foreach($sql5 as $sql5res): ?>
											<option value="<?= $sql5res['GENREID'] ?>"><?= $sql5res['GENRE'] ?></option>
										<? endforeach;
									?>
								</select>
								<div class="button">
									<button type="submit" name="Dadd" class="add">Add</button>
									<button type="reset" class="cancel" >Cancel</button>
								</div>
							</form>
							<?php
								if (isset($_POST['Dadd'])) {
									$time = date("d-m-Y")."-".time();
									$fileName = $_FILES['drawing']['name'];
									$file = $_FILES['drawing']['tmp_name'];
									move_uploaded_file($file, "./PROJET/Images/Images/painting/". $_SESSION['user']->NOM. $time. $fileName);
									$tmp_position = './PROJET/Images/Images/painting/'. $_SESSION['user']->NOM. $time. $fileName;
									$VAR1 = filter_var($_POST['Dname'], FILTER_SANITIZE_STRING);
									$VAR2 = filter_var($_POST['Ddesc'], FILTER_SANITIZE_STRING);
									$sql4 = $database->prepare("INSERT INTO TABLEAU (NOM, DESTINATION, TABDESCRIPTION, UTILISATEURFK, TYPEFK) VALUES (:VAR1, :VAR2, :VAR3, :VAR4, :VAR5)");
									$sql4->bindParam("VAR1", $VAR1);
									$sql4->bindParam("VAR2", $tmp_position);
									$sql4->bindParam("VAR3", $VAR2);
									$sql4->bindParam("VAR4", $_SESSION['user']->UTILISATEURID);
									$sql4->bindParam("VAR5", $_POST['Dtype']);
									$sql4->execute();
								}
							?>
						</div>
					</div>
			<? endif; ?>
				
			<div class="container">
				<div class="gallery">
					<?php
						if ($varsign == 1){
							$sql2 = $database->prepare("SELECT * FROM TABLEAU WHERE UTILISATEURFK = :VAR1");
						}else{
							$sql2 = $database->prepare("SELECT * FROM PEINTUREPOPULAIRE	 WHERE ARTISTEFK = :VAR1");
						}
						$sql2->bindParam("VAR1", $varID);
						$sql2->execute();
						if ($sql2->rowcount() > 0):
							foreach($sql2 as $sql2res): ?>
								<div class="grid-image">
									<?php if ($varsign == 1): ?>
											<h1 id="Drawing_Name"><?php echo $sql2res['NOM']; ?></h1>
											<?php if (!file_exists($sql2res['DESTINATION'])) $sql2res['DESTINATION'] = "./PROJET/Images/Images/painting/images.png"; ?>
											<img onclick="imagemodal(this.id)" id="<?= $sql2res['TABLEAUID'] ?>" class="Painting" src="<?= $sql2res['DESTINATION'] ?>">
										<? else: ?>
											<h1 id="Drawing_Name"><?php echo $sql2res['NOM']; ?></h1>
											<?php if (!file_exists($sql2res['DESTINATION'])) $sql2res['DESTINATION'] = "./PROJET/Images/famous/drawing/Unknown.png"; ?>
											<img class="Painting" src="<?= $sql2res["DESTINATION"] ?>">
										<? endif; ?>
								</div>
							<? endforeach; ?>
				</div>
			</div>		<!-- to finish container and gallery elements -->
							<div style="margin-top: 5px; margin-bottom: 60px;">
								<div class="end-drawing">
									<h2 ><?= $sql1res->NOM ?>'s gallery is over, you can visit later to see his latest drawings</h2>
								</div>
							</div>
						<? else : ?>
				</div>
			</div>		<!-- to finish container and gallery elements -->
							<div style="margin-top: 5px; margin-bottom: 60px;">
								<div class="end-drawing">
									<h2 ><?= $sql1res->NOM ?> has not added any drawings yet</h2>
								</div>
							</div>
						<? endif;
					?>
		</main>

		<div class="model-layerA">
            <div class="model-container">
                <div class="back-icon">
                    <img onclick="closepreviewmodal();" src="./PROJET/Icons/back-icon.svg">
                </div>
                <div class="image-bloc">
                    <img id="image-src" src="#">
                </div>
                <div class="content-bloc">
                    <div>
                        <b id="DName"></b><br>
                        <span id="UName" class="profil_link"></span><br>
                        <span id="DType" class="profil_link"></span>
                        <div class="paracontainer"> <p id="DDescription" ></p> </div>
                    </div>
                </div>
            </div>
        </div>

		<div class="model-layerB" >
			<div class="model-container">
				<form method="POST" enctype="multipart/form-data">
					<div>Change your name:</div>
					<input type="text" placeholder="Your Name" name="editname" value="<?= $sql1res->NOM ?>" >
					<div>Change your password:</div>
					<input type="password" placeholder="Password" name="editpw" value="<?= $sql1res->MOTDEPASSE ?>">
					<div>Change your description:</div>
					<textarea name="editbio"><?= $sql1res->BIO ?></textarea>
					<div>Change your profile picture:</div>
					<div class="image-upload">
						<label for="file-input1">
							<img style="cursor: pointer;" src="./PROJET/Icons/adddrawing.svg"/>
							<img id="output1" src="<?= $sql1res->PHOTOP ?>" >
						</label>
						<input id="file-input1" onchange="loadFile1(event)" type="file" accept="image/*" name="editpp">
					</div>
					<div>Change your profile cover:</div>
					<div class="image-upload">
						<label for="file-input2">
							<img style="cursor: pointer;" src="./PROJET/Icons/adddrawing.svg"/>
							<img id="output2" src="<?= $sql1res->PHOTOC ?>" >
						</label>
						<input id="file-input2" onchange="loadFile2(event)" type="file" accept="image/*" name="editpc" >
					</div>
					<div class="button">
						<button type="submit" class="save"  name="savebtn" >Save</button>
						<button type="reset"  class="cancel" onclick="closeeditmodal();">Cancel</button>
					</div>                   
				</form>
			</div>
			<?php
				if (isset($_POST['savebtn'])) {					
					if(is_uploaded_file($_FILES['editpp']['tmp_name'])) {
						$fileName1 = $_FILES['editpp']['name'];
						$file1 = $_FILES['editpp']['tmp_name'];
						move_uploaded_file($file1, "./PROJET/Images/Images/photo-profil/" . $fileName1);
						$tmp_position1 = './PROJET/Images/Images/photo-profil/' . $fileName1;
					}else {
						$tmp_position1 = $sql1res->PHOTOP;
					}
					if(is_uploaded_file($_FILES['editpc']['tmp_name'])) {
						$fileName2 = $_FILES['editpc']['name'];
						$file2 = $_FILES['editpc']['tmp_name'];
						move_uploaded_file($file2, "./PROJET/Images/Images/cover-profil/" . $fileName2);
						$tmp_position2 = './PROJET/Images/Images/cover-profil/' . $fileName2;
					}else {
						$tmp_position2 = $sql1res->PHOTOC;
					}
					$tmpname = $database->prepare("SELECT * FROM UTILISATEUR WHERE NOM = :name");
					$tmpname->bindParam("name", $_POST['editname']);
					$tmpname->execute();
					if ($tmpname->rowcount() === 0) {
						$sql3 = $database->prepare("UPDATE UTILISATEUR SET NOM = :VAR1, MOTDEPASSE= :VAR2, PHOTOP = :VAR3, PHOTOC = :VAR4, BIO = :VAR5 WHERE UTILISATEURID = :VAR6");
						$sql3->bindParam("VAR1", $_POST['editname']);
						$sql3->bindParam("VAR2", $_POST['editpw']);
						$sql3->bindParam("VAR3", $tmp_position1);
						$sql3->bindParam("VAR4", $tmp_position2);
						$sql3->bindParam("VAR5", $_POST['editbio']);
						$sql3->bindParam("VAR6", $_SESSION['user']->UTILISATEURID);
						$sql3->execute();
					}
				}
			?>
		</div>
		<script src="./PROJET/Js/Gallery.js"></script>
	</body>
</html>