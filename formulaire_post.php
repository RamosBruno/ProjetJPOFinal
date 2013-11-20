<?php

header('Content-type: text/html; charset=UTF-8');

try {
    $bdd = new PDO('mysql:host=localhost;dbname=jpo', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//r�cup�ration des valeur du formulaire
$Nom = $_POST['Nom'];
$Prenom = $_POST['Prenom'];
$Jour = $_POST['Jour'];
$Mois = $_POST['Mois'];
$Annee = $_POST['Annee'];
$DateNaissance = $Annee . "-" . $Mois . "-" . $Jour;
$Bac = $_POST['Bac'];
$BacAutre = $_POST['BacAutre'];
$Option = $_POST['Option'];
$Etablissement = $_POST['Etablissement'];
$Ville = $_POST['Ville'];
$Filiere = $_POST['Filiere'];
$SourceSIO = $_POST['SourceSIO'];
$SourceAutre = $_POST['SourceAutre'];
$ExpPro = $_POST['ExpPro'];
$Connaissances = $_POST['Connaissances'];
$Mail = $_POST['Mail'];
$TempsTrajet = $_POST['TempsTrajet'];
$Motivation = $_POST['Motivation'];
$Avis = $_POST['Avis'];
$Sexe = $_POST['Sexe'];


//insertion dans la table etude
$req = $bdd->prepare('INSERT INTO etude(ETABLISSEMENT,BAC,BACAUTRE,FILIERE,OPTIONS) VALUES (:Etablissement,:Bac,:BacAutre,:Filiere,:Options)');
$req->execute(array(
    ':Etablissement' => $Etablissement,
    ':Bac' => $Bac,
    ':BacAutre' => $BacAutre,
    ':Filiere' => $Filiere,
    ':Options' => $Option,
));
$req->closeCursor();

//insertion dans la table competence
$req = $bdd->prepare('INSERT INTO competence(EXPPRO,CONNAISSANCEINF) VALUES (:ExpPro, :Connaissances)');
$req->execute(array(
    ':ExpPro' => $ExpPro,
    ':Connaissances' => $Connaissances,
));
$req->closeCursor();


//ajout dans la table information complémentaire	
$req = $bdd->prepare('INSERT INTO infocomplementaires(AVIS,CONNAISSANCESIO,CONNAISSANCEAUTRE,TPSTRAJET,MOTIVATION) VALUES (:Avis,:ConnaissanceSIO,:ConnaissanceAutre,:TpsTrajet,:Motivation)');
$req->execute(array(
    ':Avis' => $Avis,
    ':ConnaissanceSIO' => $SourceSIO,
    ':ConnaissanceAutre' => $SourceAutre,
    ':TpsTrajet' => $TempsTrajet,
    ':Motivation' => $Motivation,
));
$req->closeCursor();

$cleEtrangere = $bdd->lastInsertId();
//ajout dans la table étude (les clés étrangère se trouve dans cette table, elle reçoit les clés primaires des autres tables)	
$req = $bdd->prepare('INSERT INTO identite(NUMETUDE,NUMINFO,NUMCOMP,NOM,PRENOM,DATENAISSANCE,VILLE,SEXE,ADRMAIL) VALUES (:NumEtude,:NumInfo,:NumComp,:Nom,:Prenom,:DateNaissance,:Ville,:Sexe,:AdrMail)');
$req->execute(array(
    ':NumEtude' => $cleEtrangere,
    ':NumInfo' => $cleEtrangere,
    ':NumComp' => $cleEtrangere,
    ':Nom' => $Nom,
    ':Prenom' => $Prenom,
    ':DateNaissance' => $DateNaissance,
    ':Ville' => $Ville,
    ':Sexe' => $Sexe,
    ':AdrMail' => $Mail,
));
$req->closeCursor();

header('Location: jpoformulaire.php');
?>