<?php
$conn = new PDO("mysql:host=localhost;dbname=gestionstock", "root", "");
$ref = $_GET['ref'];

if (!isset($_GET['confirm'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header bg-danger text-white text-center">
            <h4>Delete Confirmation</h4>
          </div>
          <div class="card-body text-center">
            <p class="mb-4">Do you really want to delete this product?</p>
            <div class="d-flex justify-content-center gap-3">
              <a href="supprimerProduit.php?ref=<?= $ref ?>&confirm=1" class="btn btn-danger">Yes, Delete</a>
              <a href="listeProduits.php" class="btn btn-secondary">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
} else {
  $conn->query("DELETE FROM Produit WHERE ref=$ref");
  header("Location: listeProduits.php");
  exit;
}
?>
