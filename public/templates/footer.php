    <!-- Footer -->
    <footer class="py-5" style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%); color: white;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-exchange-alt me-2"></i>Takalo-takalo
                    </h5>
                    <p class="text-light opacity-75 mb-4">
                        La plateforme d'échange d'objets qui redonne vie à vos affaires tout en préservant l'environnement.
                    </p>
                    <div class="social-links">
                        <a href="#" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.1); display: inline-flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; margin: 0 5px;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.1); display: inline-flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; margin: 0 5px;"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.1); display: inline-flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; margin: 0 5px;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.1); display: inline-flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; margin: 0 5px;"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Navigation</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/" class="text-light opacity-75 text-decoration-none">Accueil</a></li>
                        <li class="mb-2"><a href="/objects" class="text-light opacity-75 text-decoration-none">Objets</a></li>
                        <li class="mb-2"><a href="#how-it-works" class="text-light opacity-75 text-decoration-none">Comment ça marche</a></li>
                        <li class="mb-2"><a href="/login" class="text-light opacity-75 text-decoration-none">Connexion</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Catégories</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Vêtements</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Livres</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Électronique</a></li>
                        <li class="mb-2"><a href="#" class="text-light opacity-75 text-decoration-none">Sports</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h6 class="fw-bold mb-3">Contact</h6>
                    <div class="d-flex mb-2">
                        <i class="fas fa-envelope text-warning me-3 mt-1"></i>
                        <span class="text-light opacity-75">contact@takalo-takalo.mg</span>
                    </div>
                    <div class="d-flex mb-2">
                        <i class="fas fa-phone text-warning me-3 mt-1"></i>
                        <span class="text-light opacity-75">+261 34 12 345 67</span>
                    </div>
                    <div class="d-flex">
                        <i class="fas fa-map-marker-alt text-warning me-3 mt-1"></i>
                        <span class="text-light opacity-75">Antananarivo, Madagascar</span>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 opacity-25">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light opacity-75">
                        &copy; 2026 Takalo-takalo. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-light opacity-75">
                        Projet P18/P5DS - <strong>Nom ETU: [VOTRE NOM]</strong> - <strong>N° ETU: [VOTRE NUMERO]</strong>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php if (isset($customJS)) echo $customJS; ?>
    <?php if (isset($additionalJS)) echo $additionalJS; ?>
</body>
</html>