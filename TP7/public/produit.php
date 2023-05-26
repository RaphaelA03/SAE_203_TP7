<?php

/**
 * Utilise un formulaire HTML pour créer une nouvelle entrée dans la
 * table "Clients".
 */

if (isset($_POST['submit'])) {
    require "../config.php";
    //require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "CodeProduit" => $_POST['CodeProduit'],
            "Libelle" => $_POST['Libelle'],
            "PrixUnitaire" => $_POST['PrixUnitaire']
        );

        $sql = "INSERT INTO Produit (CodeProduit, Libelle, PrixUnitaire) VALUES (:CodeProduit, :Libelle, :PrixUnitaire)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
		echo "Erreur : ";
        echo $sql . "<br>" . $error->getMessage();
    }

	echo $_POST['CodeProduit'] . " a été ajouté avec succès";

}

?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['CodeProduit']; ?> ajouté avec succès</blockquote>
<?php } ?>

<h2>Ajouter un produit</h2>

<form method="post">
    <label for="CodeProduit">Code Produit</label>
    <input type="text" name="CodeProduit" id="CodeProduit">
    <label for="Libelle">Libelle</label>
    <input type="text" name="Libelle" id="Libelle">
    <label for="PrixUnitaire">Prix Unitaire</label>
    <input type="text" name="PrixUnitaire" id="PrixUnitaire">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Retour à l'accueil</a>

<?php require "templates/footer.php"; ?>
