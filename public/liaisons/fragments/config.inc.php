<?php
//Établir s'il s'agit d'un serveur local ou non
if (stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')) {
    $blnLocal = true;
} else {
    $blnLocal = false;
}

// Selon l'environnement d'exécution (développement ou en ligne)
if ($blnLocal==true) {
    $strHost = 'localhost';
    $strBD='20_rpni_off';
    $strUser = 'root';
    $strPassword= '';
} else {
    $strHost = 'localhost';
    $strBD='20_rpni1_OFF';
    $strUser = '20_rpni1_user';
    $strPassword = '20_rpni1_mdp';
}

//Configure le DSN
$strDsn='mysql:dbname='.$strBD.';host='.$strHost;
//Crée un objet de type PDO
$objPdo = new PDO($strDsn, $strUser, $strPassword);
//Relève le niveau d’erreur affiché par le pilote PDO
$objPdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$objPdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
//Configure l’assortiment de caractère pour utf8
$objPdo ->exec("SET CHARACTER SET utf8");
?>