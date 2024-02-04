<?php
	session_start();
	if( isset($_SESSION['user']) ){

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
		<link rel="stylesheet" href="./PROJET/Css/Chat.css">
		<title>IArtist - Chat</title>
		<link rel="shortcut icon" href="./PROJET/Icons/LogoIcons/IAtistSmallIcon.svg" />
		<script src="./PROJET/Js/jquery-3.6.0.min.js"></script>
	</head>
	<body>
		<?php include './header.php'; ?>
		<main class="container">
			<div class="left">
				<div class="head">
					<form method="GET">
						<input type="text" class="input" placeholder="search..." name="searchinput">
						<button type="submit" class="button" name="searchbutton">
							<img style="cursor: pointer;" src="./PROJET/Icons/search-icon.svg">
						</button>
					</form>
				</div>

				<div class="list-container">
					<ul class="list" id="list">
						<?php
							if (isset($_GET['searchbutton']) ) {
								$VAR1 = filter_var($_GET['searchinput'], FILTER_SANITIZE_STRING);
								$sql1 = $database->prepare("SELECT * FROM UTILISATEUR WHERE NOM LIKE :VAR1 AND UTILISATEUR.UTILISATEURID <> :VAR2");
								$sql1->bindParam("VAR2", $_SESSION['user']->UTILISATEURID);
								$VAR1 = '%' . $VAR1 . '%';
								$sql1->bindParam("VAR1", $VAR1);
								$sql1->execute();
								if ($sql1->rowcount() > 0):
									foreach($sql1 as $result): ?>
										<li class="msg-container">
											<a style="text-decoration: none;" href="./Chat.php?user-id=<?= $result['UTILISATEURID'] ?>" >
												<?php
													if (!file_exists($result['PHOTOP'])) $result['PHOTOP'] = "./PROJET/Images/Images/photo-profil/Unknown.png";
												?>
												<img src="<?= $result['PHOTOP'] ?>" class="img">
												<h1 id="account-name" class="account-name"><?= $result['NOM'] ?></h1>
												<?php 
													$sql1sub = $database->prepare("SELECT MESSAGE, TEMPS FROM MESSAGES WHERE
																( EXPEDITEURID = :VAR1 AND DESTINATAIREID = :VAR2 )
																OR( EXPEDITEURID = :VAR2 AND DESTINATAIREID = :VAR1 )
																ORDER BY MESSAGEID DESC LIMIT 1");
													$sql1sub->bindParam("VAR1", $_SESSION['user']->UTILISATEURID);
													$sql1sub->bindParam("VAR2", $result['UTILISATEURID']);
													$sql1sub->execute();
													$var1 = $sql1sub->fetchObject();
													if($sql1sub->rowcount() > 0){
														$res1 = $var1->TEMPS;
														$res2 = $var1->MESSAGE;
														(strlen($res2) > 10) ? $res2 =  substr($res2, 0, 10) . '...' : $res2;
													}else{$res1 = ""; $res2 = "No message available";}
												?>
												<h2 class="time"><?= $res1; ?></h2>
												<span class="last-msg"><?= $res2; ?></span>
											</a>
										</li>
									<? endforeach; 
								else: ?>
									<div class="nullusers" >
										<h2>No user found</h2>
									</div>
								<? endif;
							}
							else {												//the magic query hahahah
								$sql2 = $database->prepare("SELECT * FROM UTILISATEUR WHERE NOT UTILISATEURID = :VAR1 ");
								$sql2->bindParam("VAR1", $_SESSION['user']->UTILISATEURID);
								$sql2->execute();
								if ($sql2->rowcount() > 0) :
									foreach ($sql2 as $result): ?>
										<li class="msg-container">
											<a style="text-decoration: none;" href="./Chat.php?user-id=<?= $result['UTILISATEURID'] ?>" >
												<?php
													if (!file_exists($result['PHOTOP'])) $result['PHOTOP'] = "./PROJET/Images/Images/photo-profil/Unknown.png";
												?>
												<img src="<?= $result['PHOTOP'] ?>" class="img">
												<h1 id="account-name" class="account-name"><?= $result['NOM'] ?></h1>
												<?php 
													$sql2sub = $database->prepare("SELECT MESSAGE, TEMPS FROM MESSAGES WHERE
																( EXPEDITEURID = :VAR1 AND DESTINATAIREID = :VAR2 )
																OR( EXPEDITEURID = :VAR2 AND DESTINATAIREID = :VAR1 )
																ORDER BY MESSAGEID DESC LIMIT 1");
													$sql2sub->bindParam("VAR1", $_SESSION['user']->UTILISATEURID);
													$sql2sub->bindParam("VAR2", $result['UTILISATEURID']);
													$sql2sub->execute();
													$var1 = $sql2sub->fetchObject();
													if($sql2sub->rowcount() > 0){
														$res1 = $var1->TEMPS;
														$res2 = $var1->MESSAGE;
														(strlen($res2) > 10) ? $res2 =  substr($res2, 0, 25) . '...' : $res2;
													}else{$res1 = ""; $res2 = "No message available";}
												?>
												<h2 class="time"><?= $res1; ?></h2>
												<span class="last-msg"><?= $res2; ?></span>
											</a>
										</li>
									<? endforeach;
								endif;
							}
						?>
					</ul>
				</div>
			</div>

			<?php if(empty($_GET['user-id'])):?>
				<div class="nullcontent">
					<h2>Select a user</h2>
				</div>
			<? else: ?>
				<div class="right">
					<?php
						$sql4 = $database->prepare("SELECT UTILISATEURID, NOM FROM UTILISATEUR WHERE UTILISATEURID = :VAR1");
						$sql4->bindParam("VAR1", $_GET['user-id']);
						$sql4->execute();
						$result4  = $sql4->fetchObject();
					?>
					<div class="head">
						<span>To: 
							<a style="text-decoration: none;" href="./Gallery.php?user-id=<?= $result4->UTILISATEURID; ?>">
								<label style="cursor: pointer;" class="account-name"><?php echo $result4->NOM; ?></label>
							</a>
						</span>
					</div>

					<div id="loadddd" class="content">
						<div id="chats" class="messages">
							<?php
									$sql2 = $database->prepare("SELECT * FROM MESSAGES WHERE (DESTINATAIREID = :VAR1
																							OR EXPEDITEURID = :VAR1) AND (EXPEDITEURID = :VAR2 
																							OR DESTINATAIREID = :VAR2) ORDER BY MESSAGEID ASC");
									$sql2->bindParam("VAR1", $_SESSION['user']->UTILISATEURID);
									$sql2->bindParam("VAR2", $result4->UTILISATEURID);
									$sql2->execute();
									foreach ($sql2 as $result) {
										if ($result['EXPEDITEURID'] === $_SESSION['user']->UTILISATEURID): ?>
											<div class="send"><?= $result['MESSAGE'] ?><SUb><?= $result['TEMPS'] ?></SUb></div>
										<?php else: ?>
											<div class="receive"><?= $result['MESSAGE'] ?><SUb><?= $result['TEMPS'] ?></SUb></div>
										<?php endif;
									}
							?>
						</div>
					</div>

					<div class="footer">
						<form method="POST">
							<input type="text" class="input" placeholder="write a message..." name="messageinput">
							<button type="submit" class="button" name="messagebutton">
								<img style="cursor: pointer;" src="./PROJET/Icons/send-icon.svg">
							</button>
						</form>
						<?php
							if (isset($_POST['messagebutton'])) {
								$sql3 = $database->prepare( 'INSERT INTO MESSAGES (EXPEDITEURID, DESTINATAIREID, MESSAGE) VALUES (:VAR1, :VAR2, :VAR3)' );
								$sql3->bindParam('VAR1', $_SESSION['user']->UTILISATEURID);
								$sql3->bindParam('VAR2', $result4->UTILISATEURID);
								$sql3->bindParam('VAR3', $_POST['messageinput']);
								$sql3->execute();
							}
						?>
					</div>
				</div>
			<? endif; ?>
		</main>

		<script src="./PROJET/Js/Chat.js"></script>
	</body>
</html>
