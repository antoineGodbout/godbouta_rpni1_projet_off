var menu={lblMenuFerme:"Menu",lblMenuOuvert:"Fermer",refBouton:null,refLibelle:null,refMenu:null,configurerNav:function(){this.refMenu=document.querySelector(".menu");this.refBouton=document.createElement("button");this.refLibelle=document.createElement("span");this.refBouton.appendChild(this.refLibelle);this.refBouton.className="menu__controle";this.refLibelle.className="menu__libelle";this.refLibelle.innerHTML=this.lblMenuFerme;this.refMenu.prepend(this.refBouton);this.refBouton.addEventListener("click",function(){menu.ouvrirFermerNav()})},ouvrirFermerNav:function(){this.refMenu.classList.toggle("menu--ferme");if(this.refMenu.classList.contains("menu--ferme")){this.refLibelle.innerHTML=this.lblMenuFerme}else{this.refLibelle.innerHTML=this.lblMenuOuvert}}};window.addEventListener("load",function(){menu.configurerNav()});