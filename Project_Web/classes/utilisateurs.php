<?php
$salleMDP = "445893gcffc"; ///sallé le mot de passe
class utilisateurs
{
    public $login;
    public $nom;
    public $prenom;
    public $mdp;
    public $promotion;
    public $naissance;
    public $email;
    public $sexe;
    public $profil;
    public $phone;
    public $nationality;
    public $address;
    public $localisation;
    public $aboutme;
    public $profileimage;
    public $skills;
    public $url;



    public function _tostring()
    {
        return "{$this->login} {$this->nom} {$this->prenom}";
    }
    public static function getutilisateur($dbh, $login)
    {
        $login = htmlspecialchars($login);
        $quiry = "SELECT * FROM utilisateurs where login=?";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'utilisateurs');
        $sth->execute(array($login));
        if ($user = $sth->fetch()) {
            return $user;
        } else {
            return null;
        }
    }

    public static function insertutilisateur($dbh, $login, $nom, $prenom, $mdp, $promotion, $naissance, $email, $sexe, $phone, $nationality, $address, $localisation, $aboutme, $skills, $url)
    {
        $login = htmlspecialchars($login);
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        $mdp = htmlspecialchars($mdp);
        $promotion = htmlspecialchars($promotion);
        $naissance = htmlspecialchars($naissance);
        $email = htmlspecialchars($email);
        $sexe = htmlspecialchars($sexe);
        $phone = htmlspecialchars($phone);
        $nationality = htmlspecialchars($nationality);
        $address = htmlspecialchars($address);
        $localisation = htmlspecialchars($localisation);
        $aboutme = htmlspecialchars($aboutme);
        $skills = htmlspecialchars($skills);
        $url = htmlspecialchars($url);
        global $salleMDP;
        if (utilisateurs::getutilisateur($dbh, $login) == null) {
            $quiry = " INSERT INTO utilisateurs ( login,nom,prenom,mdp,promotion,naissance,email,sexe,phone,nationality,address,localisation,aboutme,skills,url) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $sth = $dbh->prepare($quiry);
            $mdp = $mdp . $salleMDP;
            $sth->execute(array($login, $nom, $prenom, sha1($mdp), $promotion, $naissance, $email, $sexe, $phone, $nationality, $address, $localisation, $aboutme, $skills, $url));
            return ($sth->rowcount() == 1);
        }
        return false;
    }

    public  static function verifyutilisateurMDP($dbh, $login, $mdp)
    {
        $login = htmlspecialchars($login);
        $mdp = htmlspecialchars($mdp);
        global $salleMDP;
        $query = "SELECT * FROM utilisateurs  where login=? and mdp=?";
        $sth = $dbh->prepare($query);
        $mdp = $mdp . $salleMDP;
        $sth->execute(array($login, sha1($mdp)));
        return ($sth->rowcount() == 1);
    }
    public  static function updateMDP($dbh, $mdp, $email)
    {
        $mdp = htmlspecialchars($mdp);
        global $salleMDP;
        $query = "UPDATE utilisateurs SET mdp=? where email=?";
        $sth = $dbh->prepare($query);
        $mdp = $mdp . $salleMDP;
        $sth->execute(array(sha1($mdp), $email));
        return ($sth->rowcount() == 1);
    }
    public static function find_mail($dbh, $mail)
    {
        $mail = htmlspecialchars($mail);
        $quiry = "SELECT * FROM utilisateurs where email=?";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'utilisateurs');
        $sth->execute(array($mail));
        return ($sth->rowcount() == 1);
    }
    public  static function updateAddress($dbh, $address, $login)
    {
        $address = htmlspecialchars($address);
        $query = "UPDATE utilisateurs SET address=? where login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($address, $login));
        return ($sth->rowcount() == 1);
    }

    public  static function changemdp($dbh, $mdp, $login)
    {
        $mdp = htmlspecialchars($mdp);
        global $salleMDP;
        $query = "UPDATE utilisateurs SET mdp=? where login=?";
        $sth = $dbh->prepare($query);
        $mdp = $mdp . $salleMDP;
        $sth->execute(array(sha1($mdp), $login));
        return ($sth->rowcount() == 1);
    }

    public  static function updatephone($dbh, $phone, $login)
    {
        $phone = htmlspecialchars($phone);
        $query = "UPDATE utilisateurs SET phone=? where login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($phone, $login));
        return ($sth->rowcount() == 1);
    }
    public  static function updateaboutme($dbh, $aboutme, $login)
    {
        $aboutme = htmlspecialchars($aboutme);
        $query = "UPDATE utilisateurs SET aboutme=? where login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($aboutme, $login));
        return ($sth->rowcount() == 1);
    }
    public  static function updateprofileimage($dbh, $profileimage, $login)
    {
        $profileimage = htmlspecialchars($profileimage);
        $query = "UPDATE utilisateurs SET profileimage=? where login=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($profileimage, $login));
        return ($sth->rowcount() == 1);
    }
    public static function isAdmin($dbh, $login)
    {

        $query = "SELECT * FROM  utilisateurs WHERE login=? and profile='admin'";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login));
        return ($sth->rowcount() == 1);
    }
    public static function selectUsers($dbh)
    {

        $quiry = "SELECT * FROM utilisateurs ";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'utilisateurs');
        $sth->execute();


        return $sth;
    }
    public static function deletuser($dbh, $login)
    {

        $query = "DELETE FROM utilisateurs WHERE  login=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login));

        return ($sth->rowcount() == 1);
    }
    public static function selectnationality($dbh)
    {

        $quiry = "SELECT  DISTINCT nationality FROM utilisateurs ";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'utilisateurs');
        $sth->execute();


        return $sth;
    }
}
