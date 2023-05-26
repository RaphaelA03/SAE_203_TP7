<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Système simple de gestion d'un magasin</title>

    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>

    <?php include "templates/header.php"; ?>

<ul>
  <li>
    <a href="create.php"><strong>Nouveau client</strong></a> - ajouter un client
  </li>
  <li>
    <a href="produit.php"><strong>Nouveau Produit</strong></a> - ajouter un produit
  </li>
  <li>
    <a href="commande.php"><strong>Commander</strong></a> - commander un produit  </li>
</ul>

<?php include "templates/footer.php"; ?>
  </body>
</html>