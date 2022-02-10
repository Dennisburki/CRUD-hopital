<?php
require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');


//**********************************************CONTROLES DU FORMULAIRE AJOUT PATIENT************************************************************

$regexName = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,25}$/u";
$regexPhone = "/^0[6-7]([-. ]?[0-9]{2}){4}$/u";
$arrayErrors = [];

if (!empty($_POST)) {

    $lastNameChar = htmlspecialchars($_POST["lastname"]);
    $firstNameChar = htmlspecialchars($_POST["firstname"]);

    //*************************************************POUR LE NOM************************************************************************

    if (isset($_POST["lastname"])) {

        // a l'aide de la fonction empty je verifie que l'input nom n'est pas vide 
        if (empty($_POST["lastname"])) {

            // je crée une clef nom dans tableau d'erreur avec un message 
            $arrayErrors["lastname"] = "Veuillez indiquer votre nom";

            // je verifie a l'aide de la fonction !preg_match() si l'input ne correspond pas
        } elseif (!preg_match($regexName, $lastNameChar)) {

            // je crée une clef nom dans tableau d'erreur avec un message
            $arrayErrors["lastname"] = "Format invalide";
        }
    }

    //*************************************************POUR LE PRENOM************************************************************************


    if (isset($_POST["firstname"])) {

        if (empty($_POST["firstname"])) {

            $arrayErrors["firstname"] = "Veuillez indiquer votre prénom";
        } elseif (!preg_match($regexName, $firstNameChar)) {

            $arrayErrors["firstname"] = "Format invalide";
        }
    }
    //*************************************************POUR LE MAIL************************************************************************

    $duplicateObj = new Patients();
    if (isset($_POST["email"])) {
        if (empty($_POST["email"])) {
            $arrayErrors["email"] = "Veuillez indiquer votre mail";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $arrayErrors["email"] = "Format invalide";
        } elseif ($duplicateObj->emailDuplicate($_POST['email']) !== FALSE) {

            $arrayErrors["email"] = "Email deja existant";
        }
    }
    //*************************************************POUR LE TELEPHONE************************************************************************

    if (isset($_POST["phone"])) {
        if (empty($_POST["phone"])) {
            $arrayErrors["phone"] = "Veuillez indiquer votre numéro de téléphone.";
        } elseif (!preg_match($regexPhone, $_POST["phone"])) {
            $arrayErrors["phone"] = "Format invalide";
        }
    }
}
//**********************************************FIN DES CONTROLES DU FORMULAIRE AJOUT PATIENT**********************************************




//*********************************************VERIF DU CAPTCHA ********************************************************************

if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];

    if(isset($_POST['g-recaptcha-response']) && empty($_POST['g-recaptcha-response'])) {

    $arrayErrors['captcha'] = "Veuillez prouver que vous n'êtes pas un robot";
}
  
}

$secretKey = "6LfX4WIeAAAAAAMNiI2CYDCjdkEnRKQenPSoo9Fo";
$ip = $_SERVER['REMOTE_ADDR'];
// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha??"");
$response = file_get_contents($url);
$responseKeys = json_decode($response, true);
// should return JSON with success as true
if ($responseKeys["success"]) {

} elseif(isset($_POST['g-recaptcha-response']) && empty($_POST['g-recaptcha-response'])) {
    $arrayErrors['captcha'] = "Veuillez prouver que vous n'êtes pas un robot";
}


//***************************************LANCEMENT DE LA FONCTION POUR INSERER DANS LA BDD************************************************
if (empty($arrayErrors) && isset($_POST['addPatient'])) {

    //on insere les lignes avec les valeurs
    $lastname = htmlspecialchars(ucwords(trim($_POST['lastname']))); // speciialchars pour eviter l'injection de script, et trim pour enlever les espaces de debut et fin
    $firstname = htmlspecialchars(ucwords(trim($_POST['firstname']))); // ucwords pour mettre la 1ere lettre en majuscule
    $birthdate = htmlspecialchars(trim($_POST['birthdate']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $mail = htmlspecialchars(trim($_POST['email']));
    $patientsObj = new Patients();
    $patientsObj->addPatient($lastname, $firstname, $birthdate, $phone, $mail);
}