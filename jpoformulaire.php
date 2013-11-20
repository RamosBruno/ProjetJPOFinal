<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>JPO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../../assets/js/html5shiv.js"></script>
          <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            <img src="images/jpo01.png" />
        </header>
        <div class="pull-right">
            <form action="administration/adm.php" method="post">
                Administration:
                <input type="password" name="mdp" placeholder="Mot de passe"/>

                <input type="submit" value="Valider" />
            </form>
        </div>

        <div class = "formulaire">
            <h1>Fiche de renseignements</h1>
            <form action="formulaire_post.php" method="post" enctype="multipart/form-data" id="monForm">
                <table cellpadding="15">
                    <tr>
                        <td>Nom</td>
                        <td><input type="text" name="Nom" required pattern="^[a-zA-Z][a-zA-Z-À�?ÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌ�?Î�?ìíîïÙÚÛÜùúûüÿÑñ]{1,25}$" data-message = "Lettres de A à Z" /></td>
                    </tr>
                    <tr>
                        <td>Prénom</td>
                        <td><input type="text" name="Prenom" required pattern="^[a-zA-Z][a-zA-Z-À�?ÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌ�?Î�?ìíîïÙÚÛÜùúûüÿÑñ]{1,25}$" data-message = "Lettres de A à Z" /></td>
                    </tr>
                    <tr>
                        <td>Sexe</td>
                        <td><input type="radio" name="Sexe" value="Homme" checked/>Homme <input type="radio" name="Sexe" value="Femme"/>Femme</td>
                    </tr>
                    <tr>
                        <td>Date de naissance</td>
                        <td>
                            Jour
                            <select name="Jour">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    echo'<option value=' . $i . '>' . $i . '</option>';
                                }
                                ?>
                            </select>

                            Mois
                            <select name="Mois">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo'<option value=' . $i . '>' . $i . '</option>';
                                }
                                ?>
                            </select>

                            Année
                            <select  name="Annee">
                                <?php
                                for ($i = 85; $i <= 97; $i++) {
                                    echo'<option value=19' . $i . '>19' . $i . '</option>';
                                }
                                ?>	
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Bac d'origine</td>
                        <td> <select name="Bac" onChange="afficherBac(this)">
                                <option value="S">S</option>
                                <option value="ES">ES</option>
                                <option value="STG">STG</option>
                                <option value="STI">STI</option>
                                <option value="Bac Pro">Bac Pro</option>
                                <option value="Autre">Autre</option>
                            </select>
                            <input type="text" name="BacAutre" id="autreBac" placeholder="Indiquez votre Bac"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Option du Bac</td>
                        <td><textarea class = "taille" required pattern="^[a-zA-Z][a-zA-Z0-9]{1,20}$" name="Option" data-message = "Lettres de A à Z, chiffres de 0 à 9"></textarea>
                    </tr>
                    <tr>
                        <td>Etablissement Fréquenté</td>
                        <td> <input type="text" required name="Etablissement" /> </td>
                    </tr>                            
                    <tr>
                        <td>Ville</td>
                        <td><input required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,30}$" type="text" name="Ville" data-message = "Lettres de A à Z, chiffres de 0 à 9 et trait d'union" /></td>
                    </tr>
                    <tr>
                        <td>Filière antérieure</td>
                        <td><input pattern="^[a-zA-Z][a-zA-Z0-9]{1,20}$" type="text" name="Filiere" title="Filière autre que BAC, exemple : Licence" data-message = "Lettres de A à Z, chiffres de 0 à 9" /></td>
                    </tr>
                    <tr>
                        <td>Comment avez-vous connu la SIO?</td>
                        <td><input type="checkbox" name="SourceSIO[]" value="Web" checked/> Via Sites Web
                            <input type="checkbox" name="SourceSIO[]" value="rec" /> Par recommandation
                            <input type="checkbox" id="autreCacher" name="SourceSIO[]" value="autre" onClick="afficher2()" /> Autre
                            <input type="text" id="afficherAutre" name="SourceAutre" placeholder="j'ai connu la SIO..."/>
                        </td>
                    <tr>
                        <td>Expérience Professionnelle</td>
                        <td><textarea name="ExpPro" placeholder="Stage en..."></textarea></td>
                    </tr>
                    <tr>
                        <td>Connaissances informatiques</td>

                        <td><textarea name="Connaissances" rows="5" placeholder="Connaissances en développement et/ou réseau."></textarea></td>
                    </tr>

                    <tr>
                        <td>Mail de contact</td>
                        <td> <input type="email" required name="Mail" placeholder="monmail@mail.com" data-message = "Veuillez donner un email valide" /> </td>
                    </tr>

                    <tr>
                        <td>Temps de trajet</td>
                        <td> <input type="text" name="TempsTrajet" placeholder="5 mins..." title="Temps de trajet entre le domicile et l'ENC" /> </td>
                    </tr>

                    <tr>
                        <td>Motivation</td>
                        <td> <textarea name="Motivation" placeholder="Je choisis la SIO pour..." ></textarea> </td>
                    </tr>
                    <tr>
                        <td>Avis sur la JPO</td>
                        <td> <textarea name="Avis" placeholder="La JPO c'est..." ></textarea> </td>
                    </tr>
                </table>
                <div class = "boutons">
                    <input type="submit" name="Valider" value="Valider" class = "button_valider" />
                    <input type="button" name="Annuler" value="Annuler" class = "button_effacer"/>
                </div>
            </form>
        </div>
        <script src="script.js"></script>
    </body>
</html>
