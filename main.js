document.addEventListener("DOMContentLoaded", function () {
  // === Inscription ===
  const donorForm = document.getElementById("donorForm");
  if (donorForm) {
    donorForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const message = document.getElementById("form-message");
      let valid = true;

      ["name", "email", "phone", "blood", "wilaya"].forEach((id) => {
        const el = document.getElementById(id);
        if (!el.value.trim()) {
          el.style.border = "2px solid red";
          valid = false;
        } else el.style.border = "2px solid green";
      });

      if (!valid) {
        message.textContent = "⚠️ Veuillez remplir tous les champs";
        message.style.color = "red";
        return;
      }

      fetch("inscription.php", { method: "POST", body: new FormData(this) })
        .then((res) => res.json())
        .then((data) => {
          if (data.status === "success") {
            message.textContent = "✅ Inscription réussie";
            message.style.color = "green";
            this.reset();
          } else {
            message.textContent = "❌ Erreur serveur";
            message.style.color = "red";
          }
        });
    });
  }

  // === Formulaire de demande ===
  const demandeForm = document.getElementById("demandeForm");
  if (demandeForm) {
    const loader = document.getElementById("loader");
    const message = document.getElementById("demandeMessage");

    demandeForm.addEventListener("submit", function (e) {
      e.preventDefault();
      message.textContent = "";
      let valid = true;

      ["name", "email", "phone", "blood", "wilaya", "quantity"].forEach(
        (id) => {
          const el = document.getElementById(id);
          if (!el.value.trim()) {
            el.style.border = "2px solid red";
            valid = false;
          } else el.style.border = "2px solid green";
        }
      );

      if (!valid) {
        message.textContent = "⚠️ Veuillez remplir tous les champs";
        message.className = "error";
        return;
      }

      loader.style.display = "block";
      fetch("formulaire.php", { method: "POST", body: new FormData(this) })
        .then((res) => res.json())
        .then((data) => {
          loader.style.display = "none";
          if (data.status === "success") {
            message.textContent =
              "✅ Votre demande de sang a été envoyée avec succès";
            message.className = "success";
            this.reset();
            loadDemandes();
          } else if (data.status === "missing") {
            message.textContent = "⚠️ Veuillez remplir tous les champs";
            message.className = "error";
          } else {
            message.textContent = "❌ Erreur serveur";
            message.className = "error";
          }
        })
        .catch(() => {
          loader.style.display = "none";
          message.textContent = "❌ Erreur de connexion";
          message.className = "error";
        });
    });
  }

  // === Charger demandes dans demandes.php ===
  function loadDemandes() {
    fetch("get_demandes.php")
      .then((res) => res.text())
      .then(
        (html) =>
          (document.getElementById("demandesTable").innerHTML =
            "<tr><th>Nom</th><th>Email</th><th>Téléphone</th><th>Fiche de sang</th><th>Wilaya</th><th>Quantité</th></tr>" +
            html)
      );
  }
  if (document.getElementById("demandesTable")) loadDemandes();
});
