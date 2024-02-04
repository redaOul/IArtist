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
        <link rel="stylesheet" href="./PROJET/Css/Home.css">
        <title>IArtist - Home</title>
        <link rel="shortcut icon" href="./PROJET/Icons/LogoIcons/IAtistSmallIcon.svg" />
    </head>
    <body>
        <?php include './header.php'; ?>
        <main>
            <div class="container">
                <div class="gallery">
                    <?php
                    $sql = $database->prepare("SELECT * FROM ARTISTE");
                    $sql->execute();
                    foreach($sql as $result): 
                    if (!file_exists($result['PHOTOP'])) $result['PHOTOP'] = "./PROJET/Images/famous/artist/Unknown.png";
                    ?>
                        <div class="grid-image">
                            <a href="./Gallery.php?famous-id=<?= $result['ARTISTEID']; ?>">
                                <h1 ><?= $result['NOM']; ?></h1>
                                <img src="<?= $result['PHOTOP']; ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </body>
</html>
