<?php
// Inclua o autoload do Composer
require 'vendor/autoload.php';

class Navbar {
    public function render() {
        echo '
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="image/logo.jpg" alt="WandersonWeb Logo" style="height: 40px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">Sobre Nós</a></li>
                            <li class="nav-item"><a class="nav-link" href="#services">Serviços</a></li>
                            <li class="nav-item"><a class="nav-link" href="#store">Loja</a></li>
                            <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                            <li class="nav-item"><a class="nav-link" href="#supporters">Apoiadores</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>';
    }
}
?>
