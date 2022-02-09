<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');

if(isset($_POST['showRdv'])){
    $rdvObj = new Patients();
    $rdvArray = $rdvObj->getRdv();

}

if(isset($_POST['modify'])){
    $rdvObj = new Patients();
    $rdvArray = $rdvObj->getRdv();

}

if (isset($_POST['delete'])) {

    $id = $_GET['id'];
    $deleteObj = new Patients();
    $deleteObj->deleteRdv($id);
}