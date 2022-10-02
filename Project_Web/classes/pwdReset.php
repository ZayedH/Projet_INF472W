<?php
class pwdreset
{
    public $pwdResetId;
    public $pwdResetEmail;
    public $pwdResetSelector;
    public $pwdResetToken;
    public $pwdResetExpires;


    public static function verifylink($dbh, $Selector, $Token)
    {
        if (ctype_xdigit($Selector) && ctype_xdigit($Token)) {

            if (strlen($Token) % 2 == 0) {

                $quiry = "SELECT * FROM pwdreset where  pwdResetSelector =?";
                $sth = $dbh->prepare($quiry);
                $sth->SetFetchMode(PDO::FETCH_CLASS, 'pwdReset');
                $sth->execute(array($Selector));

                if ($row = $sth->fetch()) {

                    if ($row->pwdResetToken == sha1(hex2bin($Token))) {
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
        $query = "SELECT *FROM pwdReset WHERE pwdResetEmail=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($userEmail));
        return ($sth->rowCount() == 1);
    }

    public static function deletrow($dbh, $userEmail)
    {

        $query = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($userEmail));
    }
    public static function insertrow($dbh, $userEmail, $selector, $Token, $expires)
    {
        $query = "INSERT INTO pwdReset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?) ;";
        $sth = $dbh->prepare($query);
        $hashedToken = sha1($Token);
        $sth->execute(array($userEmail, $selector, $hashedToken, $expires));

        return $sth->rowCount() == 1;
    }
    public static function selectrelink($dbh)
    {

        $quiry = "SELECT * FROM pwdReset ";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'pwdReset');
        $sth->execute();


        return $sth;
    }
    public static function deletelink($dbh, $id)
    {

        $query = "DELETE FROM pwdReset WHERE pwdResetId=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));

        return ($sth->rowcount() == 1);
    }
}
