<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../controllers/controllerListeRdv.php');

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
</head>

<body>

    <div class="global">
    <div class="text-center fw-bold">
            <a href="home.php">
                <h1 class="text-center fw-bold title h1">Hôpital Velpo</h1>
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
        <div class="row pt-5 pb-5">
            <div class="col-lg-6 text-center">
                <a href="home.php"><button class="btn btn-dark">Retour a l'accueil</button></a>
            </div>

            <div class="col-lg-6 text-center">
                <a href="ajout-rendezvous.php"><button class="btn btn-dark">Ajouter des Rendez-vous</button></a>
            </div>
        </div>

        <?php if (isset($_POST['delete'])) { ?>

            <div class="text-center">
                <div class="fw-bold fs-3 pt-5"> Le rendez-vous a été supprimé avec succès!</div>
                <img src="../assets/bien.png" alt=" logo ok vert" class="w-25">

                <a class="menu nav-link active text-white" aria-current="page" href="liste-rendezvous.php"><span class="text-dark">
                        <form action="liste-rendezvous.php" method="POST">
                            <input type="submit" name="showRdv" class="btn btn-dark" value="Retour a la liste des Rendez-vous">
                        </form>
                    </span></a>
            </div>

        <?php } else {?>

            <h1 class="text-center fw-bold">Liste des Rendez-vous de l'Hôpital</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Date et heure du Rendez-vous</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($rdvArray as $rdv) { ?>
                    <tr>
                        <th scope="row"><?= $rdv['lastname'] ?></th>
                        <th scope="row"><?= $rdv['firstname'] ?></th>
                        <td><?= $rdv['dateHour'] ?></td>
                        <td><?= $rdv['mail'] ?></td>
                        <td><a href="rendezvous.php?id=<?= $rdv['id'] ?>"><button class="btn btn-dark">Détails</button></a></td>
                        <!-- Button trigger modal -->
                        <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-trash3"></i>
                            </button></td>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer le rendez-vous</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Etes-vous certain de vouloir supprimer le Rendez-vous?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="liste-rendezvous.php?id=<?= $rdv['id'] ?>" method="POST" class="pt-3">
                                            <input type="submit" name="delete" value="Supprimer le Rdv" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
<?php } ?>
        <footer class="footer">
        </footer>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>