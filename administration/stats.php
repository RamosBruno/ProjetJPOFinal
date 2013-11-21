<html>

    <head>
        <title> Statistiques JPO </title>
        <meta charset="utf-8">
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <h1>Statistiques</h1>

            <?php
            //requête de récupération des données
            header('Content-type: text/html; charset=UTF-8');
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=jpo', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }



            $nbvisites = $bdd->query('SELECT COUNT(*) as nb FROM identite');
            $data = $nbvisites->fetch();
            $nbvisites = $data['nb'];

            $sexeF = $bdd->query('SELECT SEXE, COUNT( * ) as SEXEF FROM identite WHERE SEXE = "Femme"');
            $data = $sexeF->fetch();
            $sexeF = $data['SEXEF'];

            $sexeH = $bdd->query('SELECT SEXE, COUNT( * ) as SEXEH FROM identite WHERE SEXE = "Homme"');
            $data = $sexeH->fetch();
            $sexeH = $data['SEXEH'];


            $BACstg = $bdd->query('SELECT BAC, COUNT( * ) as BacSTG FROM etude WHERE BAC = "STG"');
            $data = $BACstg->fetch();
            $BACstg = $data['BacSTG'];

            $BACs = $bdd->query('SELECT BAC, COUNT( * ) as BacS FROM etude WHERE BAC = "S"');
            $data = $BACs->fetch();
            $BACs = $data['BacS'];

            $BACes = $bdd->query('SELECT BAC, COUNT( * ) as BacES FROM etude WHERE BAC = "ES"');
            $data = $BACes->fetch();
            $BACes = $data['BacES'];

            $BACpro = $bdd->query('SELECT BAC, COUNT( * ) as BacPRO FROM etude WHERE BAC = "Bac Pro"');
            $data = $BACpro->fetch();
            $BACpro = $data['BacPRO'];

            $BACsti = $bdd->query('SELECT BAC, COUNT( * ) as BacSTI FROM etude WHERE BAC = "STI"');
            $data = $BACsti->fetch();
            $BACsti = $data['BacSTI'];

            $BACautre = $bdd->query('SELECT BAC, BACAUTRE, COUNT( * ) as BacAUTRE FROM etude WHERE BAC = "Autre"');
            $data = $BACautre->fetch();
            $BACautre = $data['BacAUTRE'];

            $pourcentF = ($sexeF / ($sexeF + $sexeH)) * 100;

            $pourcentH = ($sexeH / ($sexeF + $sexeH)) * 100;

            $pourcentBacSTG = ($BACstg/$nbvisites)*100;
            $pourcentBacS = ($BACs/$nbvisites)*100;
            $pourcentBacES = ($BACes/$nbvisites)*100;
            $pourcentBacPro = ($BACpro/$nbvisites)*100;
            $pourcentBacSTI = ($BACsti/$nbvisites)*100;
            $pourcentBacAutre = ($BACautre/$nbvisites)*100;


            $date = date("d-m-Y");
            $horaire = date("H:i");
            $Age16 = 0;
            $Age17 = 0;
            $Age18 = 0;
            $Age19 = 0;
            $Age20 = 0;


            $reponse = $bdd->query('SELECT (YEAR(CURRENT_DATE) - YEAR(DATENAISSANCE)) - (RIGHT(CURRENT_DATE,5) < RIGHT(DATENAISSANCE,5)) as Age FROM identite');



            while ($donnees = $reponse->fetch()) {
                $CalcAge = intval($donnees['Age']);

                if ($CalcAge < 17) {
                    $Age16++;
                }


                if ($donnees['Age'] == 17) {
                    $Age17++;
                }


                if ($donnees['Age'] == 18) {
                    $Age18++;
                }


                if ($donnees['Age'] == 19) {
                    $Age19++;
                }


                if ($CalcAge > 19) {
                    $Age20++;
                }
            }

            $reponse->closeCursor();

            $pourcent16 = ($Age16/$nbvisites)*100;
            $pourcent17 = ($Age17/$nbvisites)*100;
            $pourcent18 = ($Age18/$nbvisites)*100;
            $pourcent19 = ($Age19/$nbvisites)*100;
            $pourcent20 = ($Age20/$nbvisites)*100;

            echo '<table class="table table-bordered">';
            echo '  <tr>
                <td>Nombre de visiteurs inscrits</td>
                <td>' . $nbvisites . '</td>
                </tr>
                <tr>
                <td>Sexe f�minin</td>
                <td> ' . $sexeF . ' (';
            printf("%.1f", $pourcentF);
            echo '%)
            </td>
                </tr>
                <tr>
                <td>Sexe masculin</td>
                <td> ' . $sexeH . ' (';
            printf("%.1f", $pourcentH);
            echo '%) 
                </td>
                </tr>
                <tr>
                <td>BAC STG</td>
                <td> ' . $BACstg . ' (';
                printf("%.1f", $pourcentBacSTG);
                echo '%)  </td>
                </tr>
                <tr>
                <td>BAC S</td>
                <td> ' . $BACs . ' (';
                printf("%.1f", $pourcentBacS);
                echo '%) </td>
                </tr>
                <tr>
                <td>BAC ES</td>
                <td> ' . $BACes . ' (';
                printf("%.1f", $pourcentBacES);
                echo '%) </td>
                </tr>
                <tr>
                <td>BAC STI</td>
                <td> ' . $BACsti . ' (';
                printf("%.1f", $pourcentBacSTI);
                echo '%) </td>
                </tr>
                <tr>
                <td>BACP PRO</td>
                <td> ' . $BACpro . ' (';
                printf("%.1f", $pourcentBacPro);
                echo '%) </td>
                </tr>
                <tr>
                <td>BAC Autre</td>
                <td> ' . $BACautre . ' (';
                printf("%.1f", $pourcentBacAutre);
                echo '%) </td>
                </tr>
                <tr>
                <td>Inscrit(s) de moins de 17 ans</td>
                <td> ' . $Age16 . ' (';
                printf("%.1f", $pourcent16);
                echo '%) </td></td>
                </tr>
                <tr>
                <td>Inscrit(s) de 17 ans</td>
                <td> ' . $Age17 . ' (';
                printf("%.1f", $pourcent17);
                echo '%) </td></td>
                </tr>
                <tr>
                <td>Inscrit(s) de 18 ans</td>
                <td> ' . $Age18 . ' (';
                printf("%.1f", $pourcent18);
                echo '%) </td></td>
                </tr>
                <tr>
                <td>Inscrit(s) de 19 ans</td>
                <td> ' . $Age19 . ' (';
                printf("%.1f", $pourcent19);
                echo '%) </td></td>
                </tr>
                <tr>
                <td>Inscrit(s) de plus de 19 ans</td>
                <td> ' . $Age20 . ' (';
                printf("%.1f", $pourcent20);
                echo '%) </td></td>
                </tr>';

            echo '</table>';
            echo '</div>';
            ?>
    </body>

</html>