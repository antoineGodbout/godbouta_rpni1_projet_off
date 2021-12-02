<header class="entete">
    <div class="conteneur rangee">
        <img src="liaisons/images/logos/Logo_OFF.svg" alt="Le logo du festival comprenant seulement le mot 'Off.'" class="entete__image">
        <h1 class="entete__titre cols_8_de_12">Festival OFF de Québec, festival indépendant de découvertes musicales</h1>
    </div>
    <?php echo('<img srcset="liaisons/images/bannieres/idArtiste'.$intId.'_banniere__375.jpg 375w,
					         liaisons/images/bannieres/idArtiste'.$intId.'_banniere__750.jpg 750w,
					         liaisons/images/bannieres/idArtiste'.$intId.'_banniere__1440.jpg 1440w,
					         liaisons/images/bannieres/idArtiste'.$intId.'_banniere__2880.jpg 2880w"
		 sizes="100vw"
         src="liaisons/images/bannieres/idArtiste'.$intId.'_banniere__2880.jpg"
         alt="Photomontage de '.$arrArtiste['nom'].'" class="entete__banniere">')?>
    <div class="rangee conteneur entete__conteneurNav">
        <nav class="menu menu--ferme cols_8_de_12">
            <ul class="menu__liste">
                <li class="menu__listeItem menu__listeItemPrincipale"><a href="index.php" class="menu__lien menu__lienPrincipal">Le OFF</a>
                    <ul class="menu__sousliste">
                        <li class="menu__listeItem"><a href="index.php#lieux" class="menu__lien">Lieux</a></li>
                        <li class="menu__listeItem"><a href="index.php#tarifs" class="menu__lien">Tarifs</a></li>
                        <li class="menu__listeItem"><a href="index.php#contact" class="menu__lien">Contact</a></li>
                    </ul>
                </li>
                <li class="menu__listeItem menu__listeItemPrincipale"><a href="programmation.php" class="menu__lien menu__lienPrincipal">Programmation</a>
                    <ul class="menu__sousliste">
                        <li class="menu__listeItem"><a href="programmation.php?tri=lieu" class="menu__lien">Par Lieu</a></li>
                        <li class="menu__listeItem"><a href="programmation.php?tri=date" class="menu__lien">Par dates</a></li>
                    </ul>
                </li>
                <li class="menu__listeItem menu__listeItemPrincipale"><a href="artistes.php" class="menu__lien menu__lienPrincipal">Artistes</a>
                    <ul class="menu__sousliste">
                        <li class="menu__listeItem"><a href="artistes.php?tri=artistes" class="menu__lien">Artistes A-Z</a></li>
                        <li class="menu__listeItem"><a href="artistes.php?tri=style" class="menu__lien">Par style musical</a></li>
                    </ul>
                </li>
                <li class="menu__listeItem menu__listeItemPrincipale"><a href="partenaires.php" class="menu__lien menu__lienPrincipal">Partenaires</a>
                    <ul class="menu__sousliste">
                        <li class="menu__listeItem"><a href="partenaires.php#actuels" class="menu__lien">Partenaires actuels</a></li>
                        <li class="menu__listeItem"><a href="partenaires.php#devenir" class="menu__lien">Devenir partenaire</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>