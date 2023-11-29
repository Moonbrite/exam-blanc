<header>
    <nav class="navbar navbar-expand-lg  position-fixed w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Foot 2 ouf</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <div class="navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <button class="btn btn-dark dropdown-toggle no-border ps-0 <?php
                                if(!array_key_exists("user",$_SESSION)){
                                    echo("disabled");
                                }
                                ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                    Menu Admin
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <?php
                                    if(array_key_exists("user",$_SESSION)) {
                                        echo('<li><a class="text-decoration-none d-flex flex-column dropdown-item" href="admin.php">Ajouter un membre</a></li>
                                              <li><a class="dropdown-item" href="destroy.php">Se déconnecter</a></li>');
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul
                    </div>
                    <div class="navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <button class="btn btn-dark dropdown-toggle no-border ps-0" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filtré par poste
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php?postes=Attaquant">Attaquant</a>
                                    </li>
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php?postes=Défenseur">Défenseur</a>
                                    </li>
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php?postes=Gardien">Gardien</a>
                                    </li>
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php?postes=Milieu">Milieu</a>
                                    </li>
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php">Pas de Filtre</a>
                                    </li>
                                </ul>
                            </li>
                        </ul
                    </div>
                    <div class="navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <button class="btn btn-dark dropdown-toggle no-border ps-0" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filtré par age
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php?ages=DESC">DESC</a>
                                    </li>
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php?ages=ASC">ASC</a>
                                    </li>
                                    <li>
                                        <a class="text-decoration-none d-flex flex-column dropdown-item" href="index.php">Pas de Filtre</a>
                                    </li>
                                </ul>
                            </li>
                        </ul
                    </div>
                </ul>
                <ul class="navbar-nav align-items-lg-end">
                    <li class="nav-item text-lg-center text-start">
                        <?php
                        if(array_key_exists("user",$_SESSION)) {
                            echo ('<img class="img-moi" src="assets/dider.webp" alt="">
                                    <a class="nav-link" href="admin.php">Ajouter un membre</a>');
                        }else {
                            echo ('<svg width="46" height="46" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2Zm0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2Zm0-12C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4Zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"></path>
                                    </svg><a class="nav-link" href="connection.php">Me connecter</a>');
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

