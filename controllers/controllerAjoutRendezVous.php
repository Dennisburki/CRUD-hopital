<?php
require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');


//**********************************************CONTROLES DU FORMULAIRE AJOUT PATIENT************************************************************

$regexName = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,25}$/u";
$regexPhone = "/^0[6-7]([-. ]?[0-9]{2}){4}$/u";
$arrayErrorsRdv = [];
$checkMail= [];

if (!empty($_POST)) {

    $lastNameChar = htmlspecialchars($_POST["lastnameRdv"]);
    $firstNameChar = htmlspecialchars($_POST["firstnameRdv"]);

    //*************************************************POUR LE NOM************************************************************************

    if (isset($_POST["lastnameRdv"])) {

        // a l'aide de la fonction empty je verifie que l'input nom n'est pas vide 
        if (empty($_POST["lastnameRdv"])) {

            // je crée une clef nom dans tableau d'erreur avec un message 
            $arrayErrorsRdv["lastnameRdv"] = "Veuillez indiquer votre nom";

            // je verifie a l'aide de la fonction !preg_match() si l'input ne correspond pas
        } elseif (!preg_match($regexName, $lastNameChar)) {

            // je crée une clef nom dans tableau d'erreur avec un message
            $arrayErrorsRdv["lastnameRdv"] = "Format invalide";
        }
    }

    //*************************************************POUR LE PRENOM************************************************************************


    if (isset($_POST["firstnameRdv"])) {

        if (empty($_POST["firstnameRdv"])) {

            $arrayErrorsRdv["firstnameRdv"] = "Veuillez indiquer votre prénom";
        } elseif (!preg_match($regexName, $firstNameChar)) {

            $arrayErrorsRdv["firstnameRdv"] = "Format invalide";
        }
    }
    //*************************************************POUR LE MAIL************************************************************************

    $duplicateObj = new Patients();
    if (isset($_POST["emailRdv"])) {
        if (empty($_POST["emailRdv"])) {
            $arrayErrorsRdv["emailRdv"] = "Veuillez indiquer votre mail";
        } elseif (!filter_var($_POST['emailRdv'], FILTER_VALIDATE_EMAIL)) {
            $arrayErrorsRdv["emailRdv"] = "Format invalide";
        } elseif ($duplicateObj->emailDuplicate($_POST['emailRdv']) !== FALSE) {

            $checkMail["emailRdv"] = "Email existant";
        }
    }
    //*************************************************POUR LE TELEPHONE************************************************************************

    if (isset($_POST["phoneRdv"])) {
        if (empty($_POST["phoneRdv"])) {
            $arrayErrorsRdv["phoneRdv"] = "Veuillez indiquer votre numéro de téléphone.";
        } elseif (!preg_match($regexPhone, $_POST["phoneRdv"])) {
            $arrayErrorsRdv["phoneRdv"] = "Format invalide";
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
    $arrayErrorsRdv['captcha'] = "Veuillez prouver que vous n'êtes pas un robot";
}

//***************************************LANCEMENT DE LA FONCTION POUR INSERER DANS LA BDD************************************************
if (empty($arrayErrorsRdv) && isset($_POST['addRdv'])) {

    //on insere les lignes avec les valeurs
    $lastnameRdv = htmlspecialchars(ucwords(trim($_POST['lastnameRdv']))); // speciialchars pour eviter l'injection de script, et trim pour enlever les espaces de debut et fin
    $firstnameRdv = htmlspecialchars(ucwords(trim($_POST['firstnameRdv']))); // ucwords pour mettre la 1ere lettre en majuscule
    $dateRdv =trim($_POST['dateRdv']);
    $timeRdv = trim($_POST['timeRdv']);
    $mailRdv = htmlspecialchars(trim($_POST['emailRdv']));
    $rdvObj = new Patients();
    $rdvObj->addAppt($lastnameRdv,$firstnameRdv,$dateRdv,$timeRdv ,$mailRdv);

    
}

