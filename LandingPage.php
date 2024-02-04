<?php
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
        <link rel="stylesheet" href="./PROJET/Css/LandingPage.css">
        <title>IArtist</title>
        <link rel="shortcut icon" href="./PROJET/Icons/LogoIcons/IAtistSmallIcon.svg" />
    </head>
    <body>
        <nav>
            <div class="logo">
                <img src="./PROJET/Icons/LogoIcons/IArtistBigIcon.svg">
            </div>
            <div class="account">
                <form method="POST">
                    <span>Your Name:</span>
                    <input type="text" placeholder="Write here..." name="user_name" required >
                    <span>Your Password:</span>
                    <input type="password" placeholder="Write here..." name="user_password" required >
                    <button type="submit" name="log_in">Log In</button>
                </form>
                <div style="margin-left: 15px; color: #FECD41; position: relative; top: 7px;">
                    <?php
                        if (isset($_POST['log_in'])) {
                            $name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
                            $login = $database->prepare("SELECT * FROM UTILISATEUR WHERE NOM = :name AND MOTDEPASSE = :password");
                            $login->bindParam("name", $name);
                            $login->bindParam("password", $_POST['user_password']);
                            $login->execute();
                            if ($login->rowcount() === 1) {
                                $user = $login->fetchObject();
                                session_start();
                                $_SESSION['user'] = $user;
                                header("location: Home.php", true);
                            }
                            else {
                                echo 'Wrong name or password';
                            }
                        }
                    ?>
                </div>
            </div>
        </nav>
        <main>
            <div>Create Your Account</div>
            <form method="POST">
                <input type="text" placeholder="Your Name" name="user_name" required >
                <input type="password" placeholder="Your Password" name="user_password" required >
                <input type="password" placeholder="Confirm Your Password" name="confirm_password" required >
                <button type="submit" name="sign_up">Sign Up</button>
            </form>
            <div style="margin-top: 10px; font-size: 17px;">
                <?php
                    if(isset($_POST['sign_up'])){
                        $sign_up = $database->prepare("SELECT * FROM UTILISATEUR WHERE NOM = :name");
                        $sign_up->bindParam("name", $_POST['user_name']);
                        $sign_up->execute();
                        if ($sign_up->rowcount() === 0) {
                            if ($_POST['user_password'] === $_POST['confirm_password']) {
                                $VAR1 = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
                                $sign_up = $database->prepare("INSERT INTO UTILISATEUR (NOM, MOTDEPASSE) VALUES (:name, :password)");
                                $sign_up->bindParam("name", $VAR1);
                                $sign_up->bindParam("password", $_POST['user_password']);
                                $sign_up->execute();
                                $sign_upsub = $database->prepare("SELECT * FROM UTILISATEUR WHERE NOM = :VAR1 AND MOTDEPASSE = :VAR2");
                                $sign_upsub->bindParam("VAR1", $VAR1);
                                $sign_upsub->bindParam("VAR2", $_POST['user_password']);
                                $sign_upsub->execute();
                                $user = $sign_upsub->fetchObject();
                                session_start();
                                $_SESSION['user'] = $user;
                                header("location: Home.php", true);
                                exit();
                            }
                            else {
                                echo "Password wasn't confirmed successfully";
                            }
                        }
                        else {
                            echo 'This name has been used before';
                        }
                    }
                ?>
            </div>
        </main>
    </body>
</html>
