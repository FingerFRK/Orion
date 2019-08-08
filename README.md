# Orion
Un framework PHP pour les applications web.

# À propos d'Orion

Orion est un framework PHP basé sur le modèle MVC qui vous aidera dans le développement de vos applications web. Les principales qualités d'Orion sont :

- Facile d'utilisation
- Système de routing simple, rapide & efficace
- Un moteur de template propre à lui : Spark

# Modèle MVC



# Routing

Orion embarque son propre router. Celui-ci se veut simple d'utilisation et facile à comprendre.

Pour créer une route, rien de plus simple. Rendez-vous dans `routes/web.php`.

Une route se présente sous la forme :

`$router->add('methodes', 'lien', 'fonction|vue|controller@fonction', 'nom');`

## Les méthodes

Le router de Orion utilise les 5 principales méthodes HTTP qui sont : GET, POST, PUT, DELETE, PATCH .

Vous pouvez préciser plusieurs méthodes en les séparants avec un pipe `|`.

## Le lien

Le lien est le modèle utilisé par le router pour créer une route.

C'est ici que vous allez préciser les paramètres regex de votre route.

Par exemple :

`$router->add('GET', '/article/voir/[*:slug]-[i:id]', 'ArticleController@voir', 'article-voir');`

Cette route va retourner deux variables : `$slug` et `$id` qui seront transmises à la fonction `voir` du controller `ArticleController`.

Les différents Regex pré-enregistré dans le router sont :

```
'i'  => '[0-9]++'
'a'  => '[0-9A-Za-z]++'
'h'  => '[0-9A-Fa-f]++'
'*'  => '.+?'
'**' => '.++'
''   => '[^/\.]++'
```

Il est aussi possible de faire un regex customisé en ajoutant un `@` devant.

## La cible

Grâce à son système de routing, Orion est en mesure de pouvoir éxecuter trois type de cible.

- Une fonction directement intégrée à la route : `$router->add('GET', '/', function() {
}, 'home');`
- Une vue : `$router->add('GET', '/', 'vue', 'home');`
- Une fonction appelée depuis un controller : `$router->add('GET', '/', 'FrontController@index', 'home');`

## Le nom

Une route n'est pas obligée d'avoir un nom. Cependant, si vous voulez faire appel à celle-ci dans votre application, vous devez impérativement lui donner un nom.

Il est impossible de donner le même nom à deux routes différentes. Ceci vous retournera une erreur.

# Le moteur de template : Spark (bêta)

Le moteur de template Spark est un moteur de template spécialement conçu pour Orion.

Celui-ci est encore en bêta mais est totalement fonctionnel.

## Une extension propre à Spark

Les vues de Spark doivent avoir pour extension `.spark.php` impérativement

## Système d'extension de fichier

Le moteur de template Spark est en mesure de pouvoir étendre des fichier template afin de facilité la mise en place de vos différentes pages

Pour cela, il vous faudra éxecuter la fonction `extends` au début de votre vue.

Exemple :

```
<?php $this->extends('nom du template'); ?>
```

## Système de blocking

Spark embarque un système de blocking. Celui-ci se compose de deux principales fonctions : block et endblock

Exemple :

##### Dans la vue
```
<?php $this->block('nom du block'); ?>
    Contenu de votre block
<?php $this->endblock('nom du block'); ?>
```

##### Dans son template 
```
<?= $this->getBlockContent('nom du block') ?>
```
