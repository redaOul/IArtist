<?php
        $username = 'root';
        $password = '';
        $database = new PDO('mysql:host=localhost;dbname=IArtist;charset=utf8', $username, $password);



    if (isset($_GET['img-id'])) {
        $sql = $database->prepare("SELECT TABLEAU.DESTINATION, TABLEAU.NOM AS DNOM, TABLEAU.TABDESCRIPTION, 
                                            UTILISATEUR.UTILISATEURID, UTILISATEUR.NOM AS UNOM, 
                                            GENRES.GENRE FROM TABLEAU JOIN UTILISATEUR 
                                    ON ( TABLEAU.UTILISATEURFK = UTILISATEUR.UTILISATEURID )
                                    JOIN GENRES 
                                    ON (TABLEAU.TYPEFK = GENRES.GENREID)
                                    WHERE TABLEAUID = :VAR1");
        $sql->bindParam("VAR1", $_GET['img-id']);
        $sql->execute();
        $res = $sql->fetchObject();
        $resJSON = json_encode($res);
        echo $resJSON;
    }
?>