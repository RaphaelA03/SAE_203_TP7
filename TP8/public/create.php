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

</head>
<body>
  <div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg">
      <h2 class="text-2xl mb-4">Ajouter un client</h2>

      <form class="w-full" method="post">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="Nom">
        Nom
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="Nom" name="Nom" type="text" placeholder="Nom" required>
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="Prenom">
        Prénom
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="Prenom" name="Prenom" type="text" placeholder="Prénom">
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="Adresse">
        Adresse
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="Adresse" name="Adresse" type="text" placeholder="Adresse">
    </div>
  </div>
  <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Enregistrer">
</form>


      <a href="index.php">Retour à l'accueil</a>
    </div>
  </div>

  <?php require "templates/footer.php"; ?>
</body>
</html>
