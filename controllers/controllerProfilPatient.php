<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');





//**********************************************CONTROLES DU FORMULAIRE AJOUT PATIENT************************************************************

$regexName = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,25}$/u";
$regexPhone = "/^0[6-7]([-. ]?[0-9]{2}){4}$/u";
$arrayErrors = [];

if (!empty($_POST)) {

    if(isset($_POST['lastname']) && isset($_POST['firstname'])){

    $lastNameChar = htmlspecialchars($_POST["lastname"]);
    $firstNameChar = htmlspecialchars($_POST["firstname"]);
    }

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
        // } elseif ($duplicateObj->emailDuplicate($_POST['email']) !== FALSE) {
            
        //     $arrayErrors["email"] = "Email deja existant";
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


if (isset($_GET['id'])) {

    $profileId = $_GET['id'];
    $patientObj = new Patients();
    $patientArray = $patientObj->patientProfil($profileId);

    $id = $_GET['id'];
    $profileRdvObj = new Patients();
    $profileRdvArray = $profileRdvObj->getProfileRdv($id);
}

if (isset($_POST['modify'])) {

    //on insere les lignes avec les valeurs
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $phone = htmlspecialchars($_POST['phone']);
    $mail = htmlspecialchars($_POST['email']);
    $id = $_GET['id'];
    $modifyObj = new Patients();
    $modifyObj->modifyProfile($lastname, $firstname, $birthdate, $phone, $mail, $id);
}

if (isset($_POST['delete'])) {

    $id = $_GET['id'];
    $deleteObj = new Patients();
    $deleteObj->deleteProfile($id);
}
