          <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
              <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
                <li><a href="#" class="nav-link nav-link-lg fullscreen-btn"><i data-feather="maximize"></i></a></li>
                <li><a href="#" class="nav-link nav-link-lg" style="color: #304c79;font-size: 19px;font-weight: bold;">PAGIRES_Programme d'Appui à la Gestion Integrée des Ressources</a></li>
              </ul>
            </div>
            <ul class="navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                  <span class="text-muted"><i class="fa fa-user"></i> <?php affiche_profil1(); ?></span>
                  <!--<img alt="image" src="assets/img/bellevue.png" class="user-img-radious-style" width="30" height="30">-->
                  <span class="d-sm-none d-lg-inline-block"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right pullDown">
                  <div class="dropdown-title"></div>
                    <a href="#" class="dropdown-item has-icon">
                      <i class="far fa-user"></i> Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                      Déconnexion
                    </a>
                </div>
              </li>
            </ul>
          </nav>