<?php

class Query
{
    protected $base ;

    public function __construct($database)
    {
        $this->base = $database ;
    }

    public function addUser($id,$email)
    {
        $req = $this->base->prepare("INSERT INTO user(id, idFacebook, email, dateAjout) VALUES (NULL, :idFacebook, :email, NOW())");
        $req->bindValue(":idFacebook",$id, PDO::PARAM_INT);
        $req->bindValue(":email",$email,PDO::PARAM_STR);
        $req->execute();
    }
    public function getLastSurvey()
    {
        $req = $this->base->query("SELECT * FROM sondage WHERE id = 1 ");
        $data = $req->fetch();
        return $data ;
    }
    public function addVote($sender,$surveyId,$vote)
    {
        $req = $this->base->prepare("INSERT INTO vote(id,idFacebook,idSurvey,vote,date_vote) VALUES(NULL,:idFacebook,:idSurvey,:vote,NOW())");
        $req->bindValue(":idFacebook",$sender,PDO::PARAM_INT);
        $req->bindValue(":idSurvey",$surveyId,PDO::PARAM_INT);
        $req->bindValue(":vote",$vote,PDO::PARAM_STR);
        $req->execute();
    }
    public function haveVote($idFacebook,$idSurvey)
    {
        $req = $this->base->prepare("SELECT * FROM vote WHERE idFacebook = :idFacebook AND idSurvey = :idSurvey ");
        $req->bindValue(":idFacebook",$idFacebook,PDO::PARAM_INT);
        $req->bindValue(":idSurvey",$idSurvey,PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        if(empty($data))
        {
          return false;
        }
        else
        {
          return true;
        }

    }

}
