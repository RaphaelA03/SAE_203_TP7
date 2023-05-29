<?php


if (isset($_POST['submit'])) {
    require "../config.php";
    //require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "Nom" => $_POST['Nom'],
            "Prenom" => $_POST['Prenom'],
            "Adresse" => $_POST['Adresse']
        );

        $sql = "INSERT INTO Clients (Nom, Prenom, Adresse) VALUES (:Nom, :Prenom, :Adresse)";
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
		echo "Erreur : ";
        echo $sql . "<br>" . $error->getMessage();
    }


}

?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['Nom']; ?> ajouté avec succès</blockquote>
<?php } ?>

<h2>Ajouter un client</h2>

<form method="post">
    <label for="Nom">Nom</label>
    <input type="text" name="Nom" id="Nom">
    <label for="Prenom">Prénom</label>
    <input type="text" name="Prenom" id="Prenom">
    <label for="Adresse">Adresse</label>
    <input type="text" name="Adresse" id="Adresse">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Retour à l'accueil</a>

<?php require "templates/footer.php"; ?>
