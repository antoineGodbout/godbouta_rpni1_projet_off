<?php

//Liaisons de la connection
include ("liaisons/fragments/config.inc.php");

//Récupérer l'id de l'artiste
$intId= $_GET["id"];

//Verrifier s'il y a un id dans l'url
if ($intId == null)
{
    $intId=3;
}

//Requete pour les informations de l'artiste
$strSql="SELECT nom, description, provenance, pays, site_web, myspace FROM artistes WHERE id=".$intId."";
$objStmt = $objPdo->prepare($strSql);
$objStmt->execute();
$arrArtiste= $objStmt->fetch();

//Requete pour les styles de l'artiste
$strSqlStyles="SELECT styles.nom FROM styles INNER JOIN styles_artistes ON styles.id = styles_artistes.style_id INNER JOIN artistes on styles_artistes.artiste_id = artistes.id WHERE artistes.id=".$intId."";
$objStmtStyles = $objPdo->prepare($strSqlStyles);
$objStmtStyles->execute();
$arrStyles= $objStmtStyles->fetchAll();

//Requete pour les infos des evenements de l'artiste
$strSqlEvenements="SELECT HOUR(evenements.date_et_heure) as Heure, MINUTE(evenements.date_et_heure) as Minutes, DAY(evenements.date_et_heure) as Jour, MONTH(evenements.date_et_heure) as Mois, lieux.nom, lieux.id FROM evenements INNER JOIN lieux on lieux.id = evenements.lieu_id INNER JOIN artistes on evenements.artiste_id = artistes.id WHERE artistes.id=".$intId."";
$objStmtEvenements = $objPdo->prepare($strSqlEvenements);
$objStmtEvenements->execute();
$arrEvenements= $objStmtEvenements->fetchAll();

//Requete pour des artistes ayant des styles similaires
$strSqlIdStyles="SELECT style_id FROM styles_artistes WHERE artiste_id=".$intId."";
$objStmtIdStyles = $objPdo->prepare($strSqlIdStyles);
$objStmtIdStyles->execute();
$arrIdStyles= $objStmtIdStyles->fetchAll();
$strIdSql = "";
//Mettre le résultat dans une string
for($int = 0; $int < count($arrIdStyles); $int++) {
    if ($int == (count($arrIdStyles) - 1))
    {
        $strIdSql = $strIdSql . $arrIdStyles[$int]['style_id'];
    }
    else
    {
        $strIdSql = $strIdSql . $arrIdStyles[$int]['style_id'] . ', ';
    }
}

//Requete des informations des artistes ayant un style en commun
$strSqlArtistesSim="SELECT DISTINCT artistes.id, artistes.nom, artistes.provenance FROM artistes INNER JOIN styles_artistes on artistes.id = styles_artistes.artiste_id WHERE style_id IN (".$strIdSql.") AND artistes.id NOT LIKE ".$intId."";
$objStmtArtistesSim = $objPdo->prepare($strSqlArtistesSim);
$objStmtArtistesSim->execute();
$arrArtistesSim= $objStmtArtistesSim->fetchAll();
//Shuffle le tableau
shuffle($arrArtistesSim);
//Raccourcir tableau

//Requete des informations les styles des artistes en commun
for($int = 0; $int < 3; $int++) {
    ${"strSqlStylesSimilaires" . $int} = "SELECT styles.nom FROM styles INNER JOIN styles_artistes ON styles.id = styles_artistes.style_id INNER JOIN artistes on styles_artistes.artiste_id = artistes.id WHERE artistes.id=".$arrArtistesSim[$int]['id']."";
    ${"objStmtStylesSimilaires" . $int} = $objPdo->prepare(${"strSqlStylesSimilaires" . $int});
    ${"objStmtStylesSimilaires" . $int}->execute();
    ${"arrStylesSimilaires" . $int}= ${"objStmtStylesSimilaires" . $int}->fetchAll();
}
?>
<!Doctype HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo($arrArtiste['nom'])?> - Festival OFF 2020</title>
    <link rel="icon" type="image/png" href="liaisons/images/logos/logo_off.ico" />
    <link rel="stylesheet" href="liaisons/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="fond">
    <!-- Entete -->
    <?php include "liaisons/fragments/enteteFicheArtiste.php" ?>
    <main class="blocArtiste">
        <div class="conteneur rangee blocArtiste__conteneur">
            <h2 class="blocArtiste__titre cols_8_de_12"><?php echo($arrArtiste['nom'])?></h2>
            <div class="cols_8_de_12">
                <h3 class="blocArtiste__categorie">Provenance:</h3>
                <p class="blocArtiste__element"><?php echo($arrArtiste['provenance'])?>, <?php echo($arrArtiste['pays']) ?></p>
            </div>
            <!-- AJOUTER LE PAYS À LA SUITE DE LA VILLE DIRECTEMENT -->
            <div class="cols_8_de_12">
                <h3 class="blocArtiste__categorie">Genre<?php if(count($arrStyles)>1){echo('s');} ?>:</h3>
                <?php for($int = 0; $int < count($arrStyles); $int++) {
                    echo('<p class="blocArtiste__element">'.$arrStyles[$int]['nom'].'</p>');
                } ?>
            </div>
            <div class="cols_8_de_12">
                <h3 class="blocArtiste__categorie">Biographie:</h3>
                <p class="blocArtiste__element"><?php echo($arrArtiste['description'])?></p>
            </div>
            <div class="cols_12_de_12">
                <?php if($arrArtiste['site_web']!=null){
                    echo('<div><h3 class="blocArtiste__categorie">Site internet:</h3><p class="blocArtiste__element"><a href="'.$arrArtiste["site_web"].'" class="blocArtiste__lien">Site internet</a></p></div>');
                }
                if ($arrArtiste['myspace'] != null) {
                    echo('<div><h3 class="blocArtiste__categorie">Site MySpace:</h3><p class="blocArtiste__element"><a href="' . $arrArtiste["myspace"] . '" class="blocArtiste__lien">Site MySpace</a></p></div>');
                }
                ?>
            </div>
            <?php for($int=1; $int<5; $int++){
                echo('<img srcset="liaisons/images/images_artiste/idArtiste'.$intId.'_img'.$int.'__330.jpg 330w,
                         liaisons/images/images_artiste/idArtiste'.$intId.'_img'.$int.'__375.jpg 375w,
                         liaisons/images/images_artiste/idArtiste'.$intId.'_img'.$int.'__660.jpg 660w,
                         liaisons/images/images_artiste/idArtiste'.$intId.'_img'.$int.'__750.jpg 750w"
                 sizes="100vw"
                 src="liaisons/images/images_artiste/idArtiste'.$intId.'_img'.$int.'__750.jpg"
                 alt="Image de '.$arrArtiste['nom'].'" class="blocArtiste__image">'
                );
            }?>
        </div>
    </main>
    <section class="representations">
        <div class="representations__conteneur conteneur rangee">
            <h2 class="representations__titre cols_12_de_12">Représentations</h2>
            <?php for($int = 0; $int < count($arrEvenements); $int++){
                switch ($arrEvenements[$int]['Jour']) {
                    case 8: $Jour="Jeudi";
                    break;
                    case 9: $Jour="Vendredi";
                    break;
                    case 10: $Jour="Samedi";
                    break;
                    case 11: $Jour="Dimanche";
                }
                echo('<div class="representations__bloc"><h3 class="representations__date">Le '.$Jour.' '.$arrEvenements[$int]['Jour'].' Juillet</h3>
                      <h4 class="representations__heure">à '.$arrEvenements[$int]["Heure"].'h'.$arrEvenements[$int]["Minutes"].'</h4>
                      <p class="representations__lieu">'.$arrEvenements[$int]["nom"].'</p>
                      <img srcset="liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__235.jpg 235w,
                         liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__330.jpg 330w,
                         liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__375.jpg 375w,
                         liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__490.jpg 490w,
                         liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__570.jpg 570w,
                         liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__660.jpg 660w,
                         liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__750.jpg 750w,
                         liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__980.jpg 980w"
                 sizes="100vw"
                 src="liaisons/images/images_lieu/idLieux'.$arrEvenements[$int]["id"].'__980.jpg"
                 alt="Image de '.$arrEvenements[$int]["nom"].'" class="representations__image"></div>');
            } ?>
        </div>
    </section>
    <section class="similaires">
        <h2 class="similaires__titre">Vous pourriez aimer ces artistes</h2>
        <div class="conteneur rangee">
            <?php for($int = 0; $int < 3; $int++) {
                $genres="";
                for($int2 = 0; $int2 < count(${"arrStylesSimilaires" . $int}); $int2++) {
                    if ($int2 != count(${"arrStylesSimilaires" . $int})-1)
                    {
                        $genres = $genres . ${"arrStylesSimilaires" . $int}[$int2]['nom']. ", ";
                    }
                    else
                    {
                        $genres = $genres . ${"arrStylesSimilaires" . $int}[$int2]['nom'];
                    }
                }
                echo ('<div class="similaires__bloc cols_4_de_12"><a href="fiche_artiste.php?id='.$arrArtistesSim[$int]['id'].'" class="similaires__lien">
                       <img srcset="liaisons/images/images_artiste/idArtiste'.$arrArtistesSim[$int]['id'].'_img1__330.jpg 330w,
                         liaisons/images/images_artiste/idArtiste'.$arrArtistesSim[$int]['id'].'_img1__375.jpg 375w,
                         liaisons/images/images_artiste/idArtiste'.$arrArtistesSim[$int]['id'].'_img1__660.jpg 660w,
                         liaisons/images/images_artiste/idArtiste'.$arrArtistesSim[$int]['id'].'_img1__750.jpg 750w"
                 sizes="100vw"
                 src="liaisons/images/images_artiste/idArtiste'.$arrArtistesSim[$int]['id'].'_img1__750.jpg"
                 alt="Image de '.$arrArtistesSim[$int]['nom'].'" class="similaires__image">
                 <h3 class="similaires__nom">'.$arrArtistesSim[$int]['nom'].'</h3>
                 <p class="similaires__infos">Provenance: '.$arrArtistesSim[$int]['provenance'].'</p>
                 <p class="similaires__infos">Genres: '.$genres.'</p>
                 <p class="similaires__bouton">Découvrir l\'artiste</p></a>
                 </div>');
            } ?>
        </div>
    </section>
    <!-- Footer -->
    <?php include "liaisons/fragments/footer.html" ?>
    <script src="liaisons/js/_menu.js"></script>
</body>
</html>