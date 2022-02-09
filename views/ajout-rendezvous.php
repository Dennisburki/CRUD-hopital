<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../controllers/controllerAjoutRendezVous.php');

var_dump($_POST);
var_dump($arrayErrorsRdv);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
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

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid m-0">
                <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white pt-1 pe-5">Menu</span>
                </button>
                <a href="../index.php" class="navbar-toggler text-white border border-dark d-flex d-lg-none text-decoration-none">Accueil</a>

                <div class="collapse navbar-collapse text-start" id="navbarNav">
                    <ul class="navbar-nav container row">
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end ">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active" aria-current="page" href="../index.php"><span class="text text-dark">Accueil</span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active  text-dark" aria-current="page" href="ajout-patient.php"><span class="text text-dark">Ajouter un client</span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active text-white" aria-current="page" href="liste-patients.php"><span class="text-dark">
                                        <form action="liste-patients.php" method="POST">
                                            <input type="submit" name="showPatients" class="btn text-dark" value="Voir la liste des clients">
                                        </form>
                                    </span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                        <div class="text-start text-lg-center">
                                <a class="menu nav-link active text-white" aria-current="page" href="liste-rendezvous.php"><span class="text-dark">
                                        <form action="liste-rendezvous.php" method="POST">
                                            <input type="submit" name="showRdv" class="btn text-dark" value="Voir la liste des Rendez-vous">
                                        </form>
                                    </span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>




        <?php if (empty($arrayErrorsRdv) && isset($_POST['addRdv'])) { ?>

            <div class="text-center">
                <div class="fw-bold fs-3 pt-5"> Rendez-vous créé avec succès!</div>
                <img src="../assets/ok.jpg" alt=" logo ok vert" class="w-25">
            </div>
            <div class="text-center">
                <a href="home.php"><button class="btn btn-dark">Retour a l'accueil</button></a>
                <a href="ajout-rendezvous.php"><button class="btn btn-dark">Ajouter un Rendez-vous</button></a>
            </div>
        <?php } else { ?>

            <div class="text-center pt-5">
                <a href="home.php"><button class="btn btn-dark">Retour a l'accueil</button></a>
            </div>

            <h1 class="text-center fw-bold pb-5 pt-1">Formulaire de Rendez-vous</h1>
            <div class="text-center text-danger fw-bold"><?= $arrayErrorsRdv["unknown"] ?? "" ?></div>

            <div class="row text-center justify-content-center ">
                <form action="ajout-rendezvous.php" method="POST" class="col-lg-6 row container-fluid border border-dark justify-content-center">

                    <label for="lastnameRdv" class="pt-3 fw-bold">Nom :</label> <span class="fw-bold text-danger"><?= $arrayErrors["lastnameRdv"] ?? "" ?></span>
                    <input type="text" name="lastnameRdv" id="lastnameRdv" placeholder="Ex: Poutine" required value="<?= $_POST['lastnameRdv'] ?? "" ?>">

                    <label for="firstnameRdv" class="pt-3 fw-bold">Prénom :</label><span class="fw-bold text-danger"><?= $arrayErrors["firstnameRdv"] ?? "" ?></span>
                    <input type="text" name="firstnameRdv" id="firstnameRdv" placeholder="Ex: Vladimir" required value="<?= $_POST['firstnameRdv'] ?? "" ?>">

                    <label for="dateRdv" class="pt-3 fw-bold">Date du Rendez-vous :</label>
                    <input type="date" name="dateRdv" id="dateRdv" min="08-02-2022" max="31-12-2022" required value="<?= $_POST['dateRdv'] ?? "" ?>">

                    <label for="timeRdv" class="pt-3 fw-bold">Heure du Rendez-vous :</label>
                    <input type="time" name="timeRdv" id="timeRdv" step="2" min="08:00" max="18:00" required value="<?= $_POST['timeRdv'] ?? "" ?>">

                    <label for="emailRdv" class="pt-3 fw-bold">Adresse Email :</label><span class="fw-bold text-danger"><?= $arrayErrors["emailRdv"] ?? "" ?></span>
                    <input type="emailRdv" name="emailRdv" id="emailRdv" placeholder="Ex: vladimir.poutine@urss.ru" required value="<?= $_POST['emailRdv'] ?? "" ?>">

                    <div class="pt-3 pb-3">
                        <input type="submit" name="addRdv" value="Ajouter" class="col-lg-2 btn btn-outline-dark">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LfX4WIeAAAAAPRdoEK_zY_adUmkdscRNt-znykP"></div><span class="fw-bold text-danger"><?= $arrayErrors["captcha"] ?? "" ?></span>

                </form>
            </div>

        <?php } ?>





        <footer class="footer">
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>