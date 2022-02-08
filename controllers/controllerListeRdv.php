<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../models/patients.php');

if(isset($_POST['showRdv'])){
    $rdvObj = new Patients();
    $rdvArray = $rdvObj->getRdv();

}