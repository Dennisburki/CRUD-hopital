<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');


if(isset($_POST['showPatients'])){
    $patientsObj = new Patients();
    $patientsArray = $patientsObj->getPatient();

}

if(isset($_POST['modify'])){
    $patientsObj = new Patients();
    $patientsArray = $patientsObj->getPatient();

}

if(isset($_POST['delete'])){
    $patientsObj = new Patients();
    $patientsArray = $patientsObj->getPatient();

}