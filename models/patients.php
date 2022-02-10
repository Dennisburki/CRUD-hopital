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

        $base = $this->connectDb(); // on fait appel a la BDD dans la class DataBase, this refere a l'objet actuel

        // $base->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        $query = "UPDATE `patients`
        SET `lastname` = :lastname, `firstname`= :firstname,`birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id";

        $stmt = $base->prepare($query); // on prepare la requete car il y a des marqueurs, donc il faudra parametrer, ca evite les injections sql(sécurité)


        //on définit les parametres

        var_dump($lastname, $firstname,$birthdate,$phone,$mail,$id);

        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR); // bindvalue securise la requete
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

    }

    /**
     * Permet de supprimer un profil
     * @param string id
     */
    public function deleteProfile($id)
    {

        $base = $this->connectDb();
        $query = "DELETE FROM `patients` WHERE `id`= :id";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

    }

    /**
     * Permet de verifier si l'email existe deja dans la bdd
     * @param string mail
     */
    public function emailDuplicate($mailCheck)
    {
        $base = $this->connectDb();
        $query = "SELECT * FROM `patients` WHERE `mail` = :mailCheck";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':mailCheck', $mailCheck, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch();
    }

    public function DuplicateRdv($lastname,$firstname)
    {
        $base = $this->connectDb();
        $query = "SELECT * FROM `patients` WHERE `lastname` = :lastname AND `firstname` = :firstname";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch();
    }


    /**
     * Permet de creer un rdv
     * @param string lastname
     * @param string firstname
     * @param string date
     * @param string time
     */
    public function addAppt(string $lastnameRdv, string $firstnameRdv,string $dateRdv,string $timeRdv) : void
    {    

        $base = $this->connectDb(); // on fait appel a la BDD dans la class DataBase

        // $base->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        $query = "INSERT INTO `appointments` (`dateHour`,`idPatients`)
        SELECT group_concat(:dateRdv, ',', :timeRdv) as `test`, (select `id` FROM `patients` WHERE `lastname` = :lastname AND `firstname` = :firstname)"; // les : devant sont des marqueurs nominatifs, auxquels on va attribuer des variables et donc une valeur
        //le ? est un marqueur, le : est un marqueur nominatif

        $stmt = $base->prepare($query); // on prepare la requete(sécurité) pour eviter les injections SQL

        //on définit les parametres/valeurs des marqueurs, ce sont les variables qu'on definit dans le controleur
        $stmt->bindValue(':dateRdv', $dateRdv, PDO::PARAM_STR);
        $stmt->bindValue(':timeRdv', $timeRdv, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastnameRdv, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstnameRdv, PDO::PARAM_STR);
       // le param str veut dire qu'on attend un string ca evite les injections sql

        $stmt->execute();
    }

    /**
     * Permet d'afficher tous les rdv
     */
    public function getRdv()
    {
        $base = $this->connectDb();
        $query ="SELECT * FROM `patients`
        INNER JOIN appointments ON patients.id = appointments.idPatients";

        $resultQuery = $base->prepare($query);
        $resultQuery->execute();
        return $resultQuery->fetchAll();
    }


    /**
     * Permet de separer l'heure et la date en deux colonnes
     */
    public function splitHour($id)
    {
        $base = $this->connectDb();
        $query ="SELECT (SELECT substr(dateHour,1,10)) as dateRdv, (SELECT substr(dateHour,11,18)) as timeRdv FROM appointments WHERE id=:id";

        $resultQuery = $base->prepare($query);
        $resultQuery->bindValue(':id', $id, PDO::PARAM_STR);
        $resultQuery->execute();
        return $resultQuery->fetchAll();
    }


    /**
     * Permet d'afficher tous les details d'un RDV
     */
    public function patientRdv($rendezVousId)
    {
        $base = $this->connectDb();

        $query = "SELECT * FROM `appointments`
        INNER JOIN `patients` ON patients.id = appointments.idPatients
        WHERE appointments.id = :rendezVousId";

        $resultQuery = $base->prepare($query);
        $resultQuery->bindValue(':rendezVousId', $rendezVousId, PDO::PARAM_STR);
        $resultQuery->execute();
        return $resultQuery->fetchAll();
    }

    /**
     * Permet de modifier les rendez-vous
     * @param string lastname
     * @param string firstame
     * @param string date
     * @param string time
     * @param string id
     */
    public function modifyRdv($lastname, $firstname,$date,$time,$id)
    {    

        $base = $this->connectDb(); // on fait appel a la BDD dans la class DataBase

        // $base->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        $query = "UPDATE `patients`
        INNER JOIN appointments ON patients.id = appointments.idPatients
        SET `lastname` = :lastname, `firstname` = :firstname, `dateHour` = (SELECT group_concat(:dateRdv,',', :timeRdv))
        WHERE appointments.id = :id";

        $stmt = $base->prepare($query); // on prepare la requete(sécurité)


        //on définit les parametres


        $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindValue(':dateRdv', $date, PDO::PARAM_STR);
        $stmt->bindValue(':timeRdv', $time, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

    }


    /**
     * Permet de supprimer les rendez_vous
     * @param string id
     */
    public function deleteRdv($id)
    {

        $base = $this->connectDb();
        $query = "DELETE FROM `appointments` WHERE `id`= :id";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

    }

    /**
     * Permet d'afficher tous les rdv d'un profil
     */
    public function getProfileRdv($id)
    {
        $base = $this->connectDb();
        $query ="SELECT dateHour FROM `patients`
        INNER JOIN appointments ON patients.id = appointments.idPatients WHERE idPatients = :id";

        $resultQuery = $base->prepare($query);
        $resultQuery->bindValue(':id', $id, PDO::PARAM_STR);
        $resultQuery->execute();
        return $resultQuery->fetchAll();
    }

    public function deleteRdvPatient($id)
    {

        $base = $this->connectDb();
        $query = "DELETE FROM `appointments` WHERE `idPatients`= :id";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

    }

    public function getSearch($search)
    {
        $base = $this->connectDb();
        $query = "SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search;";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':search', $search, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchall();
    }

    public function countPatient() 
    {
        $base = $this->connectDb();
        $query = "SELECT count(*) as total FROM `patients`";

        $stmt = $base->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPatientOffset(int $offset)
    {
        $base = $this->connectDb();

        $query = "SELECT * FROM `patients` LIMIT 10 OFFSET :offset";

        $stmt = $base->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}