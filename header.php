<?php
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
    <link rel="stylesheet" href="./PROJET/Css/header.css">
    </head>
    <body>
        <nav> 
            <div class="logo">
                <img src="./PROJET/Icons/LogoIcons/IArtistBigIcon.svg">
            </div>
            <div class="navigation">
                <ul>
                    <li>
                        <a href="./Home.php">
                            <img src="./PROJET/Icons/NavIcons/homeicon1.svg">
                        </a>
                    </li>
                    <li>
                        <a href="./Explore.php">
                            <img src="./PROJET/Icons/NavIcons/expolreicon1.svg">
                        </a>
                    </li>
                    <li>
                        <a href="./Chat.php">
                            <img src="./PROJET/Icons/NavIcons/chaticon1.svg">
                        </a>
                    </li>
                    <li>
                        <a href="./Gallery.php">
                            <img src="./PROJET/Icons/NavIcons/galleryicon1.svg">
                        </a>
                    </li>
                </ul>
            </div>
            <?php if ($_SERVER['PHP_SELF'] == "/Projet-WS/Explore.php"): ?>
                    <div class="head">
                        <form method="POST">
                            <input id="changevalue" type="text" class="input" placeholder="search..." name="searchinput">
                            <button type="submit" class="button" name="searchbutton">
                                <img style="cursor: pointer;" src="./PROJET/Icons/search-icon.svg">
                            </button>
                        </form>
                    </div>
                    <?if(isset($_POST['searchbutton'])){
                        $VAR1 = filter_var($_POST['searchinput'], FILTER_SANITIZE_STRING);
                        $sql10 = $database->prepare("SELECT GENREID FROM GENRES WHERE GENRE = :genre ");
                        $sql10->bindParam("genre", $VAR1);
                        $sql10->execute();
                        $var10 = $sql10->fetchObject();
                        if($sql10->rowcount() > 0):
                            $test = "Location: Explore.php?searchvalue=" . $var10->GENREID;
                            header($test, true);
                        else:?>
                            <script>
                                    document.getElementById('changevalue').setAttribute("value","No result!");
                            </script>
                        <? endif;
                    }
            endif; ?>
            <div class="account" onclick="menumodal();">
                <img src="<?php echo $_SESSION['user']->PHOTOP; ?>">
            </div>
        </nav>
        <section>
            <img src="<?php echo $_SESSION['user']->PHOTOP; ?>">
            <ul>
                <li><?php echo $_SESSION['user']->NOM; ?></li>
                <li>
                    <a href="./Gallery.php?manage=open">Manage Your Account</a>
                </li>
                <li>
                    <form method="GET">
                        <button type="submit" name='log_out'>Log Out</button>
                    </form>
                </li>
            </ul>
        </section>
    </body>
    <script>
        function menumodal(){
            const menumodal = document.querySelector('section');
            menumodal.classList.toggle('active');
        }
    </script>
</html>

<?php
    if( isset($_GET['log_out']) ){
        session_unset();
        session_destroy();
        header("location: LandingPage.php", true);
    }
?>