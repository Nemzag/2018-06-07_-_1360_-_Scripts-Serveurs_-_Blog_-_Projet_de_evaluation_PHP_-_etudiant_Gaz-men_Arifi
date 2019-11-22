<!--
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-03-29
 * Time: 13:27
-->
 
 ## Projet Blog (list d'articles)
 ### Avant-Projet
 1. Création de la DB (blog).
    1. Créez une base de donnée permettant la gestion d'articles écrits dans le domaine informatique. Chaque article est lié à un utilisateur et à une catégorie.
    2. Ajoutez des données pour le bon fonctionnement de l'application (dans les postes pas de balise HTML).
    3. Configurez PhpStorm pour utiliser la DB.
2. Configurez la structure du projet.
### Etape 01
1. Création de la fonction connexion.
2. Création du listing 01.
    1. Affichez les données dans un tableau HTML.
    2. Triez les articles sur la date de création.
    3. Affichez le nombre d'article deja postés.
### Etape 02 (listing 02)
1. Ajouté une illustration pour chaque article & afficher la dans un nouveau listing (bloc, list, cards). Vous en affichez seulement 5.

### Projet Blog
**Consignes:**

Utilisez un framework CSS pour le design, la grille et la disposition de vos contenus.  Utilisez les principes de construction PHP vues en classe (respect des dossiers).  Des apports personnels permettront d'améliorer le degré de maitrise.

#### Partie publique (index.php, article.php)
1. En haut dans la page, créez une zone de recherche permettant de retrouver un article particulier. Blog de Arifi Gazmen (navbar bootstrap sans menu et liens).
2. Affichez la liste de tous les articles (title, created, category, firstName et lastName).  Lors d'un clic sur un article affichez le détail de l'article choisi sur une nouvelle page (photo, texte de l'article complet, plus d'info sur le user {email}) {jumbotron}.  Prévoyez aussi un retour vers le listing complet {bouton}.
3. L'utilisateur pourra trier les sites sur les en-têtes de colonnes (title, date...).

#### Partie admin (admin.php)
1. Créez un petit menu (dropdown bootstrap) permettant de gérer les articles et les users.
2. Chaque partie sera composée de deux listings comprenant les options de suppression et d'update (icones) et un bouton ajouter.
3. Pour les articles, prévoyez dans le formulaire d'ajout et d'update la possibilité d'uploader une illustration.
4. Sécurisez l'administration avec un mot de passe crypté et des variables sessions.

Pour admin, le page et sous sections s'affichent dans le meme page.

#### Les plus (degré de maitrise)
1. Proposez une option permettant dans le listing des articles d'afficher ou masquer un article (menu View avec un true / false avec une icon oeil rouge vert en admin caché en publique). Option à rajouter avec del et update.
2. Proposez une pagination {imaginé 500 sites, premiere page j'en affiche 10, puis 11 à 20... Limit dans la requete} pour vos listing (public et/ou admin).
3. Proposez une fonction permettant à un utilisateur ayant déjà visité le site d'obtenir uniquement la liste des derniers articles.  Il pourra toutefois repasser sur le listing complet (cookies).

"Qui dit projet, dit recherche, travail personnel..."

* article.php
* admin.php
* index.php