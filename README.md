# TEST

Ceci est le repository pour le test technique de Farmitoo version développeur full-stack.

## Le cas

L'objectif est d'afficher une page "panier".
Le rendu attendu est celui du fichier assets/maquette.png (une version simplifée de notre page panier).

#### Info TVA
Le business modèle de Farmitoo implique des règles de calculs de la TVA complexes.
Dans notre cas, il est simplifié et le taux de TVA à appliquer est de 20% dans tous les cas.

#### Info frais de port
Les partenaires de Farmitoo ont des règles de calculs de frais de port très différentes.
Dans notre cas, elles sont simplifiées et de 20€ par tranche de 3 produits entamée (ex: 20€ pour 3 produits et 40€ pour 4 produits)

#### Info promotion
Les règles de promotions chez Farmitoo sont complexes.
Dans notre cas, elles sont simplifiées à une seule condition pour l'application et deux effets possibles :
- la promotion est appliquée uniquement si le montant HT de la commande dépasse le montant minimum `minAmount`
- si `freeDelivery` est à `true` les frais de livraison sont mis à 0
- le montant HT de la commande est diminué de la valeur de `reduction` (en pourcentage)

## L'évaluation
Il faut penser ton code comme évolutif :
- ajout de nouvelles règles de calculs de TVA et de calculs de frais de port
- nouvelles conditions d'application des promotions (nombre de produits, date, nombre d'utilisation...)
- réutilisation de "bloc" de l'interface sur d'autres pages

Au niveau global, sera évalué :
- la qualité du code
- la rigueur
- l'organisation du code

#### Front
- la version mobile

#### Back
- les choix de conception

#### Tests Unitaires
L'objectif n'est pas un code coverage de 100% ! 
Mais un choix judicieux des choses à tester.
