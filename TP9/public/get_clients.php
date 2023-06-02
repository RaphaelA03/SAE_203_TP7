<?php
require "config.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT ID, Nom, Prenom FROM Clients";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $clients = $statement->fetchAll(PDO::FETCH_ASSOC);

  $clientOptions = "";
  foreach ($clients as $client) {
    $clientOptions .= "<option value='" . $client['ID'] . "'>" . $client['Nom'] . " " . $client['Prenom'] . "</option>";
  }

  echo $clientOptions;
} catch (PDOException $error) {
  echo "Erreur : " . $error->getMessage();
}
?>
