<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');



$countObj = new Patients();
$countArray = $countObj->countPatient();

$nbPatients = $countObj->countPatient();
$nbPages = ceil($nbPatients[0][0] / 10);


if (isset($_POST['content'])) {

    $search = $_POST['content'] . "%";
    $searchObj = new Patients();
    $searchArray = $searchObj->getSearch($search);
}


if (isset($_POST['showPatients']) || isset($_GET['page'])) {


    $pages = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = ($pages * 10) - 10;
    $patientsObj = new Patients();
    $patientsArray = $patientsObj->getPatientOffset($offset);
} else {

    $patientsObj = new Patients();
    $patientsArray = $patientsObj->getPatientOffset($offset);
}

if (isset($_POST['modify'])) {
    $patientsObj = new Patients();
    $patientsArray = $patientsObj->getPatient();
}

if (isset($_POST['deleteAll'])) {

    $id = $_POST['deleteAll'];

    $patientsObj = new Patients();
    $patientsArray = $patientsObj->deleteRdvPatient($id);


    $patientsObj = new Patients();
    $patientsArray = $patientsObj->deleteProfile($id);

    $patientsArray = $patientsObj->getPatient();
}
