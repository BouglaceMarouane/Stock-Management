CREATE TABLE produit (
  ref INT(11) AUTO_INCREMENT PRIMARY KEY,
  designation VARCHAR(30) NOT NULL,
  categorie ENUM('Nettoyage', 'Cosmétique', 'Electrique') NOT NULL,
  prix FLOAT NOT NULL,
  quantite INT(11) NOT NULL,
  dateCreation DATE NOT NULL
);