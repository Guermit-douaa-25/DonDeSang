<?php
// 1️⃣ الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "don_de_sang");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

// 2️⃣ استعلام لجلب جميع الطلبات
$sql = "SELECT * FROM demandes ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Demandes - Don de Sang</title>
    <link rel="stylesheet" href="css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
    <nav class="navbar">
      <a href="index.html"><i class="fas fa-home"></i> Accueil</a>
      <a href="inscription.php"><i class="fas fa-user-plus"></i> S'inscrire</a>
      <a href="formulaire.php"><i class="fas fa-file-alt"></i> Formulaire</a>
      <a href="hopitaux.html"><i class="fas fa-hospital"></i> Hôpitaux</a>
      <a href="demandes.php"><i class="fas fa-list"></i> Demandes</a>
      <a href="statistiques.php"><i class="fas fa-chart-bar"></i> Statistiques</a>
      <a href="apropos.html"><i class="fas fa-info-circle"></i> À propos</a>
    </nav>

    <section class="requests-list">
      <h1>Liste des Demandes</h1>
      <table>
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Téléphone</th>
          <th>Fiche de sang</th>
          <th>Wilaya</th>
          <th>Quantité</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['phone']) ?></td>
              <td><?= htmlspecialchars($row['blood']) ?></td>
              <td><?= htmlspecialchars($row['wilaya']) ?></td>
              <td><?= htmlspecialchars($row['quantity']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align:center;">Aucune demande trouvée</td>
          </tr>
        <?php endif; ?>
      </table>
    </section>

    <footer class="footer">
      <p>&copy; 2026 Don de Sang. Tous droits réservés.</p>
      <p>Contact: contact@dondesang.com | Téléphone: 0555 123 456</p>
    </footer>
  </body>
</html>
<?php $conn->close(); ?>
