<html>

    <head>
        <title> Administration JPO </title>
        <meta charset="utf-8">
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>

    <body>
        <h1>Administration</h1>

        <a href="stats.php">par ici les stats</a>
        <?php
        //requête de récupération des données
        header('Content-type: text/html; charset=UTF-8');

        if (!isset($_POST['mdp']) OR $_POST['mdp'] != "profjpo2014!") 
        {
            echo ("Pas bon");
        } else 
        {

            try {
                $bdd = new PDO('mysql:host=localhost;dbname=jpo', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }



            $nbvisites = $bdd->query('SELECT COUNT(*) as nb FROM identite');
            $data = $nbvisites->fetch();
            $nbvisites = $data['nb'];
            echo 'Il y a <b>' . $nbvisites . '</b> personnes inscrites. <br/><br/>';
            $reponse = $bdd->query('SELECT * FROM identite,etude,competence,infocomplementaires WHERE identite.NUMETUDE=etude.NUMETUDE AND identite.NUMCOMP=competence.NUMCOMP AND identite.NUMINFO=infocomplementaires.NUMINFO');
            
            echo '<table class="table table-bordered">';
            echo '<tr class="success"><td>Nom</td> <td>Prénom</td> <td>Date de naissance</td> <td>Ville</td> <td>Sexe</td> <td>Mail</td> <td>Etablissement d\'origine</td> <td>Bac</td> <td>Autre bac</td> <td>Filière antérieure</td> <td>Option du bac</td> <td>Expérience professionnelle</td> <td>Connaissances en info</td> <td>Avis sur la JPO</td> <td>Connaissance filère</td> <td>Autre connaissance filère</td> <td>Temps de trajet</td> <td>Motivation</td> </tr>';
            while ($donnees = $reponse->fetch()) {

                echo '<tr><td>' . $donnees['NOM'] . '</td><td>' . $donnees['PRENOM'] . '</td><td>' . $donnees['DATENAISSANCE'] . '</td><td>' . $donnees['VILLE'] . '</td><td>' . $donnees['SEXE'] . '</td><td>' . $donnees['ADRMAIL'] . '</td><td>' . $donnees['ETABLISSEMENT'] . '</td><td>' . $donnees['BAC'] . '</td><td>' . $donnees['BACAUTRE'] . '</td><td>' . $donnees['FILIERE'] . '</td><td>' . $donnees['OPTIONS'] . '</td><td>' . $donnees['EXPPRO'] . '</td><td>' . $donnees['CONNAISSANCEINF'] . '</td><td>' . $donnees['AVIS'] . '</td><td>' . $donnees['CONNAISSANCESIO'] . '</td><td>' . $donnees['CONNAISSANCEAUTRE'] . '</td><td>' . $donnees['TPSTRAJET'] . '</td><td>' . $donnees['MOTIVATION'] . '</td></tr>';
            }

            echo '</table>';
            
            $reponse->closeCursor();
        }





//echo $reponse;
        ?>
    </body>

</html>