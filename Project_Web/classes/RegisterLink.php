<?php
class registerlink
{
    public $registerId;
    public $registerEmail;
    public $registerLogin;
    public $registerSelector;
    public $registerToken;
    public $registerExpires;
    public $profileimage;



    public static function verifylink($dbh, $Selector, $Token)
    {
        if (ctype_xdigit($Selector) && ctype_xdigit($Token)) {

            if (strlen($Token) % 2 == 0) {

                $quiry = "SELECT * FROM registerlink where  registerSelector =?";
                $sth = $dbh->prepare($quiry);
                $sth->SetFetchMode(PDO::FETCH_CLASS, 'registerlink');
                $sth->execute(array($Selector));

                if ($row = $sth->fetch()) {

                    if ($row->registerToken == sha1(hex2bin($Token))) {
                        return $row;
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }
        }
        return null;
    }



    public static function findrow($dbh, $userEmail)
    {
        $query = "SELECT *FROM registerlink WHERE registerEmail=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($userEmail));
        return ($sth->rowCount() == 1);
    }

    public static function deletrow($dbh, $userEmail)
    {

        $query = "DELETE FROM registerlink WHERE registerEmail=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($userEmail));
    }

    public static function insertrow($dbh, $userEmail, $userLogin, $selector, $Token, $expires)
    {
        $query = "INSERT INTO registerlink (registerEmail,registerLogin,registerSelector,registerToken,registerExpires) VALUES (?,?,?,?,?) ;";
        $sth = $dbh->prepare($query);
        $hashedToken = sha1($Token);
        $sth->execute(array($userEmail, $userLogin, $selector, $hashedToken, $expires));

        return $sth->rowCount() == 1;
    }
    public  static function updateprofileimage($dbh, $profileimage, $email)
    {
        $profileimage = htmlspecialchars($profileimage);
        $query = "UPDATE registerlink SET profileimage=? where registeremail=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($profileimage, $email));
        return ($sth->rowcount() == 1);
    }
    public static function findimageProfile($dbh, $userEmail)
    {
        $query = "SELECT profileimage FROM registerlink WHERE registerEmail=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($userEmail));
        if ($sth->rowCount() == 1) {
            return $sth->fetch();
        } else {
            return null;
        }
    }
    public static function selectlinks($dbh)
    {

        $quiry = "SELECT * FROM registerlink ";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'registerlink');
        $sth->execute();


        return $sth;
    }
    public static function deleteregister($dbh, $id)
    {

        $query = "DELETE FROM registerlink WHERE registerId=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));

        return ($sth->rowcount() == 1);
    }
}
