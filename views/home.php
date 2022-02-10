<?php

require_once('../config.php');
require_once('../models/dataBase.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>

    <div class="global">
        <div class="text-center fw-bold header">
            <a href="home.php">
                <h1 class="text-center fw-bold title">Hôpital Velpo</h1>
            </a>
        </div>


        <nav class="navbar navbar-expand-lg bg-secondary">
            <div class="container-fluid m-0">
                <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white pt-1 pe-5">Menu</span>
                </button>
                <a href="../index.php" class="navbar-toggler text-white border border-dark d-flex d-lg-none text-decoration-none">Accueil</a>

                <div class="collapse navbar-collapse text-start" id="navbarNav">
                    <ul class="navbar-nav container row">
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end ">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active" aria-current="page" href="../index.php"><span class="text fs-5 btn fw-bold text-white">Accueil</span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active  text-dark" aria-current="page" href="ajout-patient.php"><span class="text fs-5 btn fw-bold text-white">Ajouter un client</span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active text-white" aria-current="page" href="liste-patients.php">
                                    <form action="liste-patients.php" method="POST">
                                        <input type="submit" name="showPatients" value="Liste des clients" class="text fs-5 btn fw-bold text-white">
                                    </form>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active text-white" aria-current="page" href="liste-rendezvous.php">
                                    <form action="liste-rendezvous.php" method="POST">
                                        <input type="submit" name="showRdv" class="text fs-5 btn fw-bold text-white" value="Liste des Rendez-vous">
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <p class="text-center fw-bold title2 pt-3">Bienvenue sur le site de l'Hôpital Velpo</p>
        <div class="text-center">
            <img src="../assets/doctor.jpg" alt="">
        </div>

        <h3 class="text-center">Veuillez choisir une des actions ci-dessous</h3>

        <div class="text-center row justify-content-center pb-5">
            <div>

                <a href="ajout-patient.php" class="mt-3 btn btn-outline-dark col-lg-2">Ajouter un client</a>
            </div>
            <form action="liste-patients.php" method="POST" class="col-lg-2">
                <input type="submit" name="showPatients" class="mt-3 btn btn-outline-dark" value="Voir la liste des clients">
            </form>
            <a href="ajout-rendezvous.php" class="mt-3 btn btn-outline-dark col-lg-2">Ajouter un rdv</a>
        </div>

        <footer class="footer">
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>