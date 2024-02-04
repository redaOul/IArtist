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
        <link rel="stylesheet" href="./PROJET/Css/Explore.css">
        <title>IArtist - Explore</title>
        <link rel="shortcut icon" href="./PROJET/Icons/LogoIcons/IAtistSmallIcon.svg" />
    </head>
    <body>
        <?php include './header.php'; ?>
        <main>
            <div class="container">
                <div class="gallery">
                    <?php
                    if (empty($_GET['searchvalue'])) {
                        $sql = $database->prepare("SELECT * FROM TABLEAU WHERE UTILISATEURFK <> :VAR1 ORDER BY TABLEAUID DESC");
                        $sql->bindParam("VAR1", $_SESSION['user']->UTILISATEURID);
                    }else {
                        $sql = $database->prepare("SELECT * FROM TABLEAU WHERE UTILISATEURFK <> :VAR1 AND TYPEFK = :VAR2 ORDER BY TABLEAUID DESC");
                        $sql->bindParam("VAR1", $_SESSION['user']->UTILISATEURID);
                        $sql->bindParam("VAR2", $_GET['searchvalue']);
                    }
                    $sql->execute();
                    foreach($sql as $result): ?>
                        <div class="grid-image">
                            <h1 id="Drawing_Name"><?= $result['NOM']; ?></h1>
                            <?php
                                if (!file_exists($result['DESTINATION'])) $result['DESTINATION'] = "./PROJET/Images/Images/painting/images.png";
                            ?>
                            <img onclick="imagemodal(this.id)" id="<?= $result['TABLEAUID'] ?>" class="Painting" src="<?= $result['DESTINATION']; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>            
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
                        <a id="UName" href="#" class="profil_link"></a><br>
                        <span id="DType" class="profil_link"></span>
                        <div class="paracontainer"> <p id="DDescription" ></p> </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="./PROJET/Js/Explore.js" > </script>
    </body>
</html>