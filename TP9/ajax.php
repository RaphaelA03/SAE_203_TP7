<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#client_id').change(function() {
        var clientID = $(this).val();
        $.ajax({
          url: 'get_url.php', 
          type: 'POST',
          data: { client_id: clientID },
          success: function(response) {
            $('#product_id').html(response);
          }
        });
      });
    });
  </script>
</head>
<body>
  <div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg">
      <h2 class="text-2xl mb-4">Retrouver l'adresse de livraison d'une commande</h2>
      <form class="w-full" method="post">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="client_id">
              Client
            </label>
            <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="client_id" name="client_id">
              <option value="">Sélectionnez un client</option>
              <?php
// Affichage des clients
require "../config.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT ID, Nom FROM Client"; // Vérifiez les noms de colonnes ici
  $statement = $connection->prepare($sql);
  $statement->execute();
  $clients = $statement->fetchAll(PDO::FETCH_ASSOC);

  foreach ($clients as $client) {
    echo "<option value='" . $client['ID'] . "'>" . $client['Nom'] . "</option>"; // Utilisez les bonnes colonnes ici
  }
} catch (PDOException $error) {
  echo "Erreur : " . $error->getMessage();
}
?>





            </select>
          </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product_id">
              Produit commandé
            </label>
            <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="product_id" name="product_id">
              <option value="">Sélectionnez un client d'abord</option>
            </select>
          </div>
        </div>

        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Valider">
      </form>

      <?php
      // Affichage de l'adresse de livraison
      if (isset($_POST['submit'])) {
        $clientID = $_POST['client_id'];
        $productID = $_POST['product_id'];

        if (!empty($clientID) && !empty($productID)) {
          try {
            $connection = new PDO($dsn, $username, $password, $options);
            $sql = "SELECT adresse_livraison FROM Commande WHERE ClientID = :clientID AND ProduitID = :productID";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':clientID', $clientID);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $address = $statement->fetchColumn();

            if ($address) {
              echo "<p class='mt-4'><strong>Adresse de livraison :</strong> " . $address . "</p>";
            } else {
              echo "<p class='mt-4'>Aucune adresse de livraison trouvée.</p>";
            }
          } catch (PDOException $error) {
            echo "Erreur : " . $error->getMessage();
          }
        }
      }
      ?>

      <div class="mt-8">
        <a href="index.php" class="inline-block bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Retour</a>
      </div>
    </div>
  </div>

</body>
</html>
