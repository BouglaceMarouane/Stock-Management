<?php

  $conn = new PDO("mysql:host=localhost;dbname=gestionstock", "root", "");
  $ref = $_GET['ref'];
  $errorMsg = ""; // Variable pour afficher les erreurs

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $today = date('Y-m-d');
    $dateCreation = $_POST['date'];

    if ($dateCreation <= $today) {
      $stmt = $conn->prepare("UPDATE Produit SET designation=?, categorie=?, prix=?, quantite=?, dateCreation=? WHERE ref=?");
      $stmt->execute([
        $_POST['designation'],
        $_POST['categorie'],
        $_POST['prix'],
        $_POST['quantite'],
        $dateCreation,
        $ref
      ]);
      header("Location: listeProduits.php");
      exit;
    } else {
      $errorMsg = "The creation date cannot be in the future.";
    }
  }

  $prd = $conn->query("SELECT * FROM Produit WHERE Ref=$ref")->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modify Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header bg-primary text-white text-center">
            <h4>Edit Product</h4>
          </div>
          <div class="card-body">
            <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger">
              <?= $errorMsg ?>
            </div>
            <?php endif; ?>
            <form method="POST">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="designation" name="designation" value="<?= $prd->designation ?>" placeholder="Designation">
                <label for="designation">Designation</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="categorie" name="categorie">
                  <option <?= $prd->categorie == "Nettoyage" ? "selected" : "" ?>>Nettoyage</option>
                  <option <?= $prd->categorie == "Cosmetique" ? "selected" : "" ?>>Cosmetique</option>
                  <option <?= $prd->categorie == "Electrique" ? "selected" : "" ?>>Electrique</option>
                </select>
                <label for="categorie">Category</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="prix" name="prix" value="<?= $prd->prix ?>" placeholder="Prix">
                <label for="prix">Price</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="quantite" name="quantite" value="<?= $prd->quantite ?>" placeholder="Quantite">
                <label for="quantite">Quantity</label>
              </div>
              <div class="form-floating mb-3">
              <input type="date" class="form-control" id="date" name="date" value="<?= $prd->dateCreation ?>" placeholder="Date creation" max="<?= date('Y-m-d') ?>">
              <label for="date">Creation Date</label>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-success">Edit</button>
                <a href="listeProduits.php?ref=<?= $prd->ref ?>" value='annuler' class="btn btn-danger mt-2">Cancel</a>
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

