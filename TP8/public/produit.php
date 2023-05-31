<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>

<?php


if (isset($_POST['submit'])) {
    require "../config.php";

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


}

?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold"><?php echo $_POST['CodeProduit']; ?></p>
        <p class="text-sm">a été ajouté avec succès</p>
    </div>
<?php } ?>

</head>
<body>
  <div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg">
      <h2 class="text-2xl mb-4">Ajouter produit</h2>

      <form class="w-full" method="post">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="CodeProduit">
        Code Produit
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="CodeProduit" name="CodeProduit" type="text" placeholder="Code Produit" required>
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="Prenom">
        Libelle
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="Libelle" name="Libelle" type="text" placeholder="Libelle">
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="Adresse">
        Prix Unitaire
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="PrixUnitaire" name="PrixUnitaire" type="text" placeholder="Prix Unitaire">
    </div>
  </div>
  <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Enregistrer">
</form>

<div class="mt-4">
      <a href="index.php" class="inline-block bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Retour</a>
    </div>
  </div>

  <?php require "templates/footer.php"; ?>
</body>
</html>
