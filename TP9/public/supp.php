<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>

  <?php
  // Suppression d'un client
  if (isset($_POST['delete_client'])) {
    require "../config.php";
  
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      $id = $_POST['client_id'];
  
      $sql = "DELETE FROM Clients WHERE id = :id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':id', $id);
      $statement->execute();
  
      $success_message = "Le client a été supprimé avec succès.";
    } catch(PDOException $error) {
      echo "Erreur : " . $error->getMessage();
    }
  }
  
  // Suppression d'un produit
if (isset($_POST['delete_product'])) {
  require "../config.php";

  try {
      $connection = new PDO($dsn, $username, $password, $options);
      $codeProduit = $_POST['delete_product'];

      $sql = "DELETE FROM Produit WHERE CodeProduit = :codeProduit";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':codeProduit', $codeProduit);
      $statement->execute();

      $success_message = "Le produit a été supprimé avec succès.";
  } catch(PDOException $error) {
      echo "Erreur : " . $error->getMessage();
  }
}

  // Suppression d'une commande
  if (isset($_POST['delete_order'])) {
    require "../config.php";
  
    try {
      $connection = new PDO($dsn, $username, $password, $options);
      $id = $_POST['order_id'];
  
      $sql = "DELETE FROM Commande WHERE CommandeID = :CommandeID";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':CommandeID', $id);
      $statement->execute();

  
      $success_message = "La commande a été supprimée avec succès.";
    } catch(PDOException $error) {
      echo "Erreur : " . $error->getMessage();
    }
  }
  ?>

</head>
<body>
  <div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg">
      <?php if (isset($success_message)) { ?>
        <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
          <p class="font-bold"><?php echo $success_message; ?></p>
        </div>
      <?php } ?>

      <h2 class="text-2xl mb-4">Supprimer un client</h2>
      <form class="w-full" method="post">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="client_id">
              ID du client à supprimer
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="client_id" name="client_id" type="text" placeholder="ID du client" required>
          </div>
        </div>
        <input class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="delete_client" value="Supprimer">
      </form>

      <h2 class="text-2xl mt-8 mb-4">Supprimer un produit</h2>
      <form class="w-full" method="post">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product_id">
              ID du produit à supprimer
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="product_id" name="product_id" type="text" placeholder="ID du produit" required>
          </div>
        </div>
        <input class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="delete_product" value="Supprimer">
      </form>

      <h2 class="text-2xl mt-8 mb-4">Supprimer une commande</h2>
      <form class="w-full" method="post">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="order_id">
              ID de la commande à supprimer
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="order_id" name="order_id" type="text" placeholder="ID de la commande" required>
          </div>
        </div>
        <input class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="delete_order" value="Supprimer">
      </form>

      <div class="mt-8">
        <a href="index.php" class="inline-block bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Retour</a>
      </div>
    </div>
  </div>

</body>
</html>
