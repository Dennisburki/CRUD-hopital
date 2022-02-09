<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../controllers/controllerProfilPatient.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Client</title>
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

        <?php if (isset($_POST['modify'])) { ?>

            <div class="text-center">
                <div class="fw-bold fs-3 pt-5"> Les informations ont été mises à jour avec succès!</div>
                <img src="../assets/ok.jpg" alt=" logo ok vert" class="w-25">
            </div>

            <?php } else {


            if (isset($_POST['delete'])) { ?>

                <div class="text-center">
                    <div class="fw-bold fs-3 pt-5"> Les informations ont été supprimées avec succès!</div>
                    <img src="../assets/ok.jpg" alt=" logo ok vert" class="w-25">
                </div>

            <?php } else { ?>

                <?php foreach ($patientArray as $patient) { ?>
                    <div class="pt-5 text-center">
                        <div class="text-center fw-bold fs-3"><?= $patient['lastname'] ?></div>
                        <div class="text-center fw-bold fs-3"><?= $patient['firstname'] ?></div>
                        <div class="text-center fw-bold"><?= $patient['birthdate'] ?></div>
                        <div class="text-center fw-bold"><?= $patient['phone'] ?></div>
                        <div class="text-center fw-bold"><?= $patient['mail'] ?></div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Modifier le profil
                        </button>
                        <form action="#" method="POST" class="pt-3">
                            <input type="submit" name="delete" value="Supprimer le profil" class="btn btn-danger">
                        </form>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier le Profil de <?= $patient['firstname'] ?> <?= $patient['lastname'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row text-center justify-content-center ">
                                            <form action="profil-patient.php?id=<?= $patient['id'] ?>" method="POST" class="col-lg-6 row container-fluid border border-dark justify-content-center pb-2">

                                                <label for="lastname" class="pt-3 fw-bold">Nom :</label>
                                                <input type="text" name="lastname" id="lastname" placeholder="Ex: Poutine" value="<?= $patient['lastname'] ?>">

                                                <label for="firstname" class="pt-3 fw-bold">Prénom :</label>
                                                <input type="text" name="firstname" id="firstname" placeholder="Ex: Vladimir" value="<?= $patient['firstname'] ?>">

                                                <label for="birthdate" class="pt-3 fw-bold">Date de naissance :</label>
                                                <input type="date" name="birthdate" id="birthdate" min="01-01-1900" max="01-01-2030" value="<?= $patient['birthdate'] ?>">

                                                <label for="phone" class="pt-3 fw-bold">Numéro de téléphone :</label>
                                                <input type="number" name="phone" id="phone" placeholder="0606060606" value="<?= $patient['phone'] ?>">

                                                <label for="email" class="pt-3 fw-bold">Adresse Email :</label>
                                                <input type="email" name="email" id="email" placeholder="Ex: vladimir.poutine@urss.ru" value="<?= $patient['mail'] ?>">


                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="modify" value="Enregistrer les modifications">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
        <?php }
            }
        } ?>

        <div class="text-center pt-3 pb-3 h1">Rendez-vous à venir:</div>
        <div class="text-center" >
            <ul class="d-inline-block">
                <?php foreach ($profileRdvArray as $rdv) { ?>
                    <li><?= $rdv['dateHour'] ?></li>

                <?php } ?>
            </ul>
        </div>
        <footer class="footer">
        </footer>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>