<?php


if (isset($_POST['submit'])) {
    require "../config.php";

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
<style>
    body {
        background: hsl(228, 23%, 51%);
    }
    h2 {
        text-align: center;
}
a {
    display: block;
    text-align: center;
    background-color: purple;
    color: white;
    padding: 6px;
    border: 2px solid #000;
    border-radius: 4px;
    cursor: pointer;
}

    
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

</style>

<form method="post">
    <label for="Nom">Nom</label>
    <input type="text" name="Nom" id="Nom">

    <label for="Prenom">Prénom</label>
    <input type="text" name="Prenom" id="Prenom">

    <label for="Adresse">Adresse</label>
    <input type="text" name="Adresse" id="Adresse">

    <input type="submit" name="Enregistrer" value="Enregistrer">
    <br> </br>
    <a href="index.php">Retour à l'accueil</a>
</form>




<?php require "templates/footer.php"; ?>
