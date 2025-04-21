<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Management and Tracking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header bg-primary text-white text-center">
            <h4>Add a Product</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="ajouterProduit.php">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" required>
                <label for="designation">Designation</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="categorie" name="categorie">
                  <option value="Nettoyage">Cleaning</option>
                  <option value="Cosmetique">Cosmetics</option>
                  <option value="Electrique">Electrical</option>
                </select>
                <label for="categorie">Category</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="prix" name="prix" step="1" placeholder="Prix" required>
                <label for="prix">Price</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantite" required>
                <label for="quantite">Quantity</label>
              </div>
              <div class="form-floating mb-3">
              <input type="date" class="form-control" id="date" name="date" placeholder="Date creation" required max="<?= date('Y-m-d') ?>">
              <label for="date">Creation Date</label>
              </div>
              <div class="d-grid">
                <button type="submit" name="ajouter" class="btn btn-success">Add Product</button>
                <button type="reset" name="Annuler" value='annuler' class="btn btn-danger mt-2">Cancel</button>
                <a href="listeProduits.php" class='btn btn-warning mt-2'>To Product List</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


<?php

  if (isset($_POST['ajouter'])) {
    $dateCreation = $_POST['date'];
    $today = date('Y-m-d');

    if ($dateCreation <= $today) {
      $conn = new PDO("mysql:host=localhost;dbname=gestionstock", "root", "");
      $stmt = $conn->prepare("INSERT INTO Produit(designation, categorie, prix, quantite, dateCreation) VALUES (?, ?, ?, ?, ?)");
      $stmt->execute([
        $_POST['designation'],
        $_POST['categorie'],
        $_POST['prix'],
        $_POST['quantite'],
        $dateCreation
      ]);
      header("Location: listeProduits.php");
    } else {
      echo "<script>alert('The creation date cannot be in the future.');</script>";
    }
  }
?>
