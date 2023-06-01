<?php
require "config.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT ID, Nom FROM Client";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $clients = $statement->fetchAll(PDO::FETCH_ASSOC);

  $options = "<option value=''>Sélectionnez un client</option>";
  foreach ($clients as $client) {
    $options .= "<option value='" . $client['ID'] . "'>" . $client['Nom'] . "</option>";
  }

  echo $options;
} catch (PDOException $error) {
  echo "Erreur : " . $error->getMessage();
}
?>
