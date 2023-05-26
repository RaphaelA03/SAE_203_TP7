<?php

require "../config.php";

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_order = array(
            "AdresseLivraison" => $_POST['AdresseLivraison'],
            "ProduitID" => $_POST['ProduitID'],
            "ClientID" => $_POST['ClientID']
        );
        
        $sql = "INSERT INTO Commande (AdresseLivraison, ProduitID, ClientID) VALUES (:AdresseLivraison, :ProduitID, :ClientID)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_order);
    } catch(PDOException $error) {
        echo "Erreur : " . $error->getMessage();
    }
    echo $_POST['CodeProduit'] . " a été ajouté avec succès";
}

?>

<?php require "templates/header.php"; ?>

<h2>Simple gestion d'un magasin</h2>
<p>Commander</p>

<form method="post">
    <label for="ClientID">Client:</label>
    <select name="ClientID">
        <?php
            $connection = new PDO($dsn, $username, $password, $options);
            $sql = "SELECT ID, Nom, Prenom FROM Clients";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($clients as $client) {
                echo "<option value='".$client['ID']."'>".$client['Nom']." ".$client['Prenom']."</option>";
            }
        ?>
    </select>

    <label for="ProduitID">Produit:</label>
    <select name="ProduitID">
        <?php
            $sql = "SELECT CodeProduit, Libelle FROM Produit";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $produits = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($produits as $produit) {
                echo "<option value='".$produit['CodeProduit']."'>".$produit['Libelle']."</option>";
            }
        ?>
    </select>

    <label for="AdresseLivraison">Adresse de livraison:</label>
    <input type="text" name="AdresseLivraison" id="AdresseLivraison">

    <input type="submit" name="submit" value="Ajouter">
</form>

<a href="index.php">Retour à l'accueil</a>

<?php require "templates/footer.php"; ?>
