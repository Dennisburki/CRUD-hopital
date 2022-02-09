<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');

if(isset($_GET['id'])){

    $rendezVousId = $_GET['id'];
    $rendezVousObj = new Patients();
    $rendezVousArray = $rendezVousObj->patientRdv($rendezVousId);

    $id = $_GET['id'];
    $splitObj = new Patients();
    $splitArray = $splitObj->splitHour($id);


}


if (isset($_POST['modify'])) {

    //on insere les lignes avec les valeurs
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $date = $_POST['dateRdv'];
    $time = $_POST['timeRdv'];
    
    $id = $_GET['id'];
    $modifyObj = new Patients();
    $modifyObj->modifyRdv($lastname, $firstname,$date,$time,$id);
}

if (isset($_POST['delete'])) {

    $id = $_GET['id'];
    $deleteObj = new Patients();
    $deleteObj->deleteRdv($id);
}