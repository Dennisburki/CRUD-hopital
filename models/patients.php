<?php


class Patients extends DataBase
{

    /**
     * fonction qui permet d'ajouter un patient
     * @param string $lastname: nom du patient
     * @param string $firstname: prénom du patient
     * @param string $birthdate: Date de naissance du patient Ex: 1992-05-15
     * @param string $phone: Numéro de téléphone du patient
     * @param string $mail: email du patient
     * 
     * @return void
     */
    public function addPatient(string $lastname, string $firstname,string $birthdate,string $phone,string $mail) : void
    {    

        $base = $this->connectDb(); // on fait appel a la BDD dans la class DataBase

        // $base->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        $query = "INSERT INTO `patients` (`lastname`,`firstname`,`birthdate`,`phone`,`mail`)
        VALUES (:lastname, :firstname, :birthdate, :phone, :mail)"; // les : devant sont des marqueurs nominatifs, auxquels on va attribuer des variables et donc une valeur
        //le ? est un marqueur, le : est un marqueur nominatif

        $stmt = $base->prepare($query); // on prepare la requete(sécurité) pour eviter les injections SQL

        //on définit les parametres/valeurs des marqueurs, ce sont les variables qu'on definit dans le controleur
        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR); // le param str veut dire qu'on attend un string ca evite les injections sql

        $stmt->execute();

    }

    public function getPatient()
    {
        $base = $this->connectDb();
        $query ="SELECT * FROM `patients`";

        $resultQuery = $base->prepare($query);
        $resultQuery->execute();
        return $resultQuery->fetchAll();
    }

    public function patientProfil($profileId)
    {
        $base = $this->connectDb();

        $query = "SELECT * FROM `patients` WHERE `id` = :profileId";

        $resultQuery = $base->prepare($query);
        $resultQuery->bindValue(':profileId', $profileId, PDO::PARAM_STR);
        $resultQuery->execute();
        return $resultQuery->fetchAll();
    }


    public function modifyProfile($lastname, $firstname,$birthdate,$phone,$mail,$id)
    {    

        $base = $this->connectDb(); // on fait appel a la BDD dans la class DataBase

        // $base->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        $query = "UPDATE `patients`
        SET `lastname` = :lastname, `firstname`= :firstname,`birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id";

        $stmt = $base->prepare($query); // on prepare la requete(sécurité)


        //on définit les parametres

        var_dump($lastname, $firstname,$birthdate,$phone,$mail,$id);

        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

    }

    public function deleteProfile($id)
    {

        $base = $this->connectDb();
        $query = "DELETE FROM `patients` WHERE `id`= :id";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

    }

    public function emailDuplicate($mailCheck)
    {
        $base = $this->connectDb();
        $query = "SELECT * FROM `patients` WHERE `mail` = :mailCheck";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':mailCheck', $mailCheck, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch();
    }


    public function addAppt(string $lastnameRdv, string $firstnameRdv,string $dateRdv,string $timeRdv ,string $mailRdv) : void
    {    

        $base = $this->connectDb(); // on fait appel a la BDD dans la class DataBase

        // $base->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        $query = "INSERT INTO `appointments` (`dateHour`,`idPatients`)
        SELECT group_concat(:dateRdv, ',', :timeRdv) as `test`, (select `id` FROM `patients` WHERE `lastname` = :lastname AND `firstname` = :firstname AND `mail` = :mail)"; // les : devant sont des marqueurs nominatifs, auxquels on va attribuer des variables et donc une valeur
        //le ? est un marqueur, le : est un marqueur nominatif

        $stmt = $base->prepare($query); // on prepare la requete(sécurité) pour eviter les injections SQL

        //on définit les parametres/valeurs des marqueurs, ce sont les variables qu'on definit dans le controleur
        $stmt->bindValue(':dateRdv', $dateRdv, PDO::PARAM_STR);
        $stmt->bindValue(':timeRdv', $timeRdv, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastnameRdv, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstnameRdv, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mailRdv, PDO::PARAM_STR); // le param str veut dire qu'on attend un string ca evite les injections sql

        $stmt->execute();

    }

    public function getRdv()
    {
        $base = $this->connectDb();
        $query ="SELECT * FROM `patients`
        INNER JOIN appointments ON patients.id = appointments.idPatients";

        $resultQuery = $base->prepare($query);
        $resultQuery->execute();
        return $resultQuery->fetchAll();
    }



}