<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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
          
          $success_message = "La commande a été passée avec succès";
      } catch(PDOException $error) {
          $error_message = "Erreur : " . $error->getMessage();
      }
  }

  require "templates/header.php";
  ?>

  <?php if (isset($_POST['submit'])) { ?>
    <?php if (isset($success_message)) { ?>
      <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Success</p>
        <p class="text-sm"><?php echo $success_message; ?></p>
      </div>
    <?php } elseif (isset($error_message)) { ?>
      <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
        <p class="font-bold">Error</p>
        <p class="text-sm"><?php echo $error_message; ?></p>
      </div>
    <?php } ?>
  <?php } ?>

  <div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg">
      <h2 class="text-2xl mb-4">Commander</h2>
      <form class="w-full" method="post">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ClientID">
              Client
            </label>
            <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="ClientID" name="ClientID" required>
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
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="AdresseLivraison">
              Adresse de livraison
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="AdresseLivraison" name="AdresseLivraison" type="text" placeholder="Adresse de livraison">
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ProduitID">
              Produit
            </label>
            <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="ProduitID" name="ProduitID" required>
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
          </div>
        </div>
        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Enregistrer">
      </form>
      <div class="mt-4">
        <a href="index.php" class="inline-block bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Retour</a>
      </div>
    </div>
  </div>
</body>
</html>
