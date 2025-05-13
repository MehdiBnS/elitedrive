</main>
<footer id="footer">
  <div id="footer-links">
    <ul>
      <li><a href="#" class="footer-link">Mentions légales</a></li>
      <li><a href="#" class="footer-link">Politique de confidentialité</a></li>
      <li><a href="#" class="footer-link">Plan du site</a></li>
      <li><a href="#" class="footer-link">Cookies</a></li>
    </ul>
  </div>
  
  <div id="footer-separetor"></div>
    
  
  <div id="footer-info">
    <p>&copy; 2025 | EliteDrive By MehdiDev</p>
    <p>5 Av. des Citronniers 3, 98000 Monaco</p>
    <p><a href="tel:02.43.28.33.14" class="footer-phone">02.43.28.33.14</a></p>
    <p><a href="mailto:gestion@elitedrive.fr" class="footer-email">gestion@elitedrive.fr</a></p>
    <p><a href="index.php?controller=Home&action=contactAction" class="footer-contact">Formulaire de contact</a></p>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<?php
if (isset($scripts)) {
    foreach ($scripts as $script) {
        // Si le nom contient un /, cela veut dire qu'on a précisé un sous-dossier
        if (strpos($script, '/') !== false) {
            echo '<script src="js/' . $script . '.js"></script>';
        } else {
            // Sinon, par défaut on charge à la racine du dossier js/
            echo '<script src="js/' . $script . '.js"></script>';
        }
    }
}
?>

<script src="../public/js/burger.js"></script>
<script src="../public/js/loadPage.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>