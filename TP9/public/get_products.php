<?php
require "config.php";

if(isset($_POST['client_id'])) {
  $clientID = $_POST['client_id'];

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    // Récupérer la liste des produits commandés par le client
    $sql = "SELECT Produit.Libelle, Commande.AdresseLivraison FROM Commande
            INNER JOIN Produit ON Commande.CodeProduit = Produit.CodeProduit
            WHERE Commande.IDClient = :client_id";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':client_id', $clientID, PDO::PARAM_INT);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Générer les options pour le menu déroulant des produits
    $productOptions = "";
    foreach ($products as $product) {
      $productOptions .= "<option value='" . $product['AdresseLivraison'] . "'>" . $product['Libelle'] . "</option>";
    }

    echo $productOptions;
  } catch (PDOException $error) {
    echo "Erreur : " . $error->getMessage();
  }
}
?>
