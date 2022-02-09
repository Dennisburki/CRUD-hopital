<?php require_once('../controllers/controllerAjoutPatient.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <title>Ajout de patients</title>
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

        <?php if (empty($arrayErrors) && isset($_POST['addPatient'])) { ?>

            <div class="text-center">
                <div class="fw-bold fs-3 pt-5"> Patient Ajouté avec succès!</div>
                <img src="../assets/ok.jpg" alt=" logo ok vert" class="w-25">
            </div>
            <div class="text-center">
                <a href="home.php"><button class="btn btn-dark">Retour a l'accueil</button></a>
                <a href="ajout-patient.php"><button class="btn btn-dark">Ajouter un Patient</button></a>
            </div>
        <?php } else { ?>

            <div class="text-center pt-5">
                <a href="home.php"><button class="btn btn-dark">Retour a l'accueil</button></a>
            </div>

            <h1 class="text-center fw-bold pb-5 pt-1">Formulaire d'ajout de Clients</h1>

            <div class="row text-center justify-content-center ">
                <form action="ajout-patient.php" method="POST" class="col-lg-6 row container-fluid border border-dark justify-content-center">

                    <label for="lastname" class="pt-3 fw-bold">Nom :</label> <span class="fw-bold text-danger"><?= $arrayErrors["lastname"] ?? "" ?></span>
                    <input type="text" name="lastname" id="lastname" placeholder="Ex: Poutine" required value="<?= $_POST['lastname'] ?? "" ?>">

                    <label for="firstname" class="pt-3 fw-bold">Prénom :</label><span class="fw-bold text-danger"><?= $arrayErrors["firstname"] ?? "" ?></span>
                    <input type="text" name="firstname" id="firstname" placeholder="Ex: Vladimir" required value="<?= $_POST['firstname'] ?? "" ?>">

                    <label for="birthdate" class="pt-3 fw-bold">Date de naissance :</label>
                    <input type="date" name="birthdate" id="birthdate" min="01-01-1900" max="01-01-2030" required value="<?= $_POST['birthdate'] ?? "" ?>">

                    <label for="phone" class="pt-3 fw-bold">Numéro de téléphone :</label><span class="fw-bold text-danger"><?= $arrayErrors["phone"] ?? "" ?></span>
                    <input type="number" name="phone" id="phone" placeholder="0606060606" required value="<?= $_POST['phone'] ?? "" ?>">

                    <label for="email" class="pt-3 fw-bold">Adresse Email :</label><span class="fw-bold text-danger"><?= $arrayErrors["email"] ?? "" ?></span>
                    <input type="email" name="email" id="email" placeholder="Ex: vladimir.poutine@urss.ru" required value="<?= $_POST['email'] ?? "" ?>">

                    <div class="pt-3 pb-3">
                        <input type="submit" name="addPatient" value="Ajouter" class="col-lg-2 btn btn-outline-dark">
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