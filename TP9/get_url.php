<?php
require "../config.php";
require "../common.php";

if (isset($_POST['client_id']) && isset($_POST['product_id'])) {
  $clientID = $_POST['client_id'];
  $productID = $_POST['product_id'];

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    // Requête pour récupérer l'adresse de livraison en fonction du client et du produit
    $sql = "SELECT adresse_livraison FROM Commande WHERE ClientID = :clientID AND ProduitID = :productID";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':clientID', $clientID);
    $statement->bindParam(':productID', $productID);
    $statement->execute();
    $address = $statement->fetchColumn();

    if ($address) {
      echo $address;
    } else {
      echo "Aucune adresse de livraison trouvée.";
    }
  } catch (PDOException $error) {
    echo "Erreur : " . $error->getMessage();
  }
}
?>
