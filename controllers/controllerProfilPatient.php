<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');

if(isset($_GET['id'])){

    $profileId = $_GET['id'];
    $patientObj = new Patients();
    $patientArray = $patientObj->patientProfil($profileId);

}


if (isset($_POST['modify'])) {

    //on insere les lignes avec les valeurs
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $mail = $_POST['email'];
    $id = $_GET['id'];
    $modifyObj = new Patients();
    $modifyObj->modifyProfile($lastname, $firstname,$birthdate,$phone,$mail,$id);
}

if (isset($_POST['delete'])) {

    $id = $_GET['id'];
    $deleteObj = new Patients();
    $deleteObj->deleteProfile($id);

}