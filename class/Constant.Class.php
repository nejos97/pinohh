<?php

class Constant
{
    //datebase information
    const DB_HOST = 'localhost';
    const DB_USERNAME = 'id1456936_pinohhbot';
    const DB_NAME = 'id1456936_pinohhbot';
    const DB_PASSWORD = 'pinohh1234567890';


    //faceboot token
    const FB_MESSENGER_CALLBACK_TOKEN= "pinohh1234567890";
    const FB_PAGE_TOKEN= "EAAakFXJZA2ogBAFyUZBzK4OOnMRqZADtrpqVffZALBx0EvajzQ7cwGvVG5Bo0Oo2KmnceqHdXv98oumuyiVnoTdKPuwl0CcXH2yYcrv6yZBQv9InBzzSh1TuKOz4e2ZB9XG4PETtZBwXZBMiXmSlJcw8h16wUcE309cMPL9CGfMuDAZDZD" ;

    public function getFacebookToken()
    {
        return self::FB_PAGE_TOKEN;
    }

    public function getVerifyToken()
    {
        return self::FB_MESSENGER_CALLBACK_TOKEN ;
    }

    public function getDatabase()
    {
        $localhost = self::DB_HOST ;
        $dbname = self::DB_NAME ;
        $username = self::DB_USERNAME ;
        $password = self::DB_PASSWORD ;
        try
        {
            $base = new PDO("mysql:host=$localhost;dbname=$dbname", $username, $password);
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $base ;
        }
        catch(Exception $e)
        {
            die("ERREUR : ".$e->getMessage());
        }

    }

}
