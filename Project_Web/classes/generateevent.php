<?php

class generateevent
{

    public $idEvent;
    public $title;
    public $text;
    public $link;
    public $timeFrame;
    public $imagename;



    public static function insertEvent($dbh,  $title, $text, $link, $timeFrame, $image)
    {
        $title = htmlspecialchars($title);
        $text = htmlspecialchars($text);
        $link = htmlspecialchars($link);
        $timeFrame = htmlspecialchars($timeFrame);
        //$image = htmlspecialchars($image);


        $quiry = " INSERT INTO generateevent (title,text,link,timeFrame,imagename) VALUES (?,?,?,?,?)";
        $sth = $dbh->prepare($quiry);
        $sth->execute(array($title, $text, $link, $timeFrame, $image));
        return ($sth->rowcount() == 1);
    }

    public static function selectEvent($dbh)
    {

        $quiry = "SELECT * FROM generateevent ORDER BY idEvent DESC";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'generateevent');
        $sth->execute();
        return $sth;
    }
    public static function deleteEvent($dbh, $id)
    {

        $query = "DELETE FROM generateevent WHERE  idEvent=?;";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));

        return ($sth->rowcount() == 1);
    }
    public static function selectlast($dbh)
    {

        $quiry = "SELECT AUTO_INCREMENT
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = 'Inter'
        AND TABLE_NAME = 'generateevent' ";
        $sth = $dbh->prepare($quiry);
        $sth->SetFetchMode(PDO::FETCH_CLASS, 'generateevent');
        $sth->execute();


        return $sth->fetch();
    }
}
