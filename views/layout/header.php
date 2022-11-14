<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <!-- Hacer la aplicacion web adaptable a cada resolución  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Robles Steel SPA</title>
    <meta name="description" content="Robles Steel SPA. es una empresa que presta servicio a la pequeña y 
            gran minería en asistencia técnica estructural, reparación y fabricación de componentes de equipos mineros." />
    <meta name="author" content="Alejo Palma Santoro">
    <meta name="google-site-verification" content="" />

    <!-- MDB ESSENTIAL -->
    <link rel="stylesheet" href="<?= base_url ?>css/mdb.min.css" />
    <!-- MDB PLUGINS -->
    <link rel="stylesheet" href="<?= base_url ?>plugins/css/all.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

    <link rel="stylesheet" href="<?= base_url ?>css/styles.css" />
    <link rel="shortcut icon" href="<?= base_url ?>img/logo.webp">
</head>

<body>
    <!-- CABECERA -->
    <header>
        <?php $servicios = Utils::showServicios(); ?>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top bg-primary text-white">
            <!-- Container wrapper -->
            <div class="container">

                <!-- Navbar brand -->
                <a class="navbar-brand" href="<?= base_url ?>">Robles Steel SPA</a>

                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url ?>#sobreNosotros">Sobre Nosotros</a>
                        </li>

                        <!-- Dropdown categoria -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                Servicios
                            </a>
                            <!-- Dropdown menu categorías -->
                            <ul class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                                <?php while ($servicio = $servicios->fetch_object()) : ?>
                                    <li><a class="dropdown-item" href="<?= base_url ?>servicio/ver&id=<?= $servicio->id ?>"><?= $servicio->nombre ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url ?>#contacto">Contacto</a>
                        </li>

                        <!-- Mostrar enlaces a la sesión admin -->
                        <?php if (isset($_SESSION['admin'])) :
                            $id_usuario = $_SESSION['identity']->id;
                        ?>
                            <!-- Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-edit fa-fw me-1"></i>Administrar tienda
                                </a>
                                <!-- Dropdown menu -->
                                <ul class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url ?>servicio/gestion">Gestionar servicios</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>galeria_imagenes/gestion">Gestionar Galeria imagenes</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>galeria_videos/gestion">Gestionar Galeria videos</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>usuario/editar&id=<?= $id_usuario ?>">Editar mi perfil</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>usuario/logout">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>

    <!-- CONTENIDO CENTRAL -->
    <div class="container-fluid" id="central" style="margin-top: 65px;">

        <div class="fixed-bottom" style="width: 50px; left: 12px; bottom: 20px;">
            <a id="iconodewhatsap" href="https://wa.me/+56962199284" class="btn btn-primary btn-floating float-start" target="_blank" style="background-color: #128C7E; width:50px; height:50px">
                <i class="fab fa-whatsapp fa-3x" style="margin-top:6px ;"></i>
            </a>
        </div>