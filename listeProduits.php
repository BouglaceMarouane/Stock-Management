<?php

  $conn = new PDO("mysql:host=localhost;dbname=gestionstock", "root", "");
  $produits = $conn->query("SELECT * FROM Produit")->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center mb-3 rounded-2">
      <h2 class="m-3">Product List</h2>
      <a href="ajouterProduit.php" class="btn btn-success m-3">Add a Product</a>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-primary text-center">
          <tr>
            <th>Ref</th>
            <th>Designation</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($produits as $prd): ?>
            <tr>
              <td class="text-center"><?= $prd->ref ?></td>
              <td><?= $prd->designation ?></td>
              <td><?= $prd->categorie ?></td>
              <td><?= $prd->prix ?></td>
              <td><?= $prd->quantite ?></td>
              <td><?= $prd->dateCreation ?></td>
              <td class="text-center">
                <a href="modifierProduit.php?ref=<?= $prd->ref ?>" class="btn col-5 btn-warning">Edit</a>
                <a href="supprimerProduit.php?ref=<?= $prd->ref ?>" class="btn col-5 btn-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
