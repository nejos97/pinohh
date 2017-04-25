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
    public function desinscrire($sender)
    {
        $req = $this->base->prepare("DELETE FROM user WHERE idFacebook = :idFacebook ");
        $req->bindValue(":idFacebook",$sender,PDO::PARAM_INT);
        $req->execute();
    }
    public function addNewBirthday($sender,$friendName,$year,$mail,$image,$message,$senderName)
    {
        $req = $this->base->prepare("INSERT INTO birthday VALUES(NULL,:idFacebook,:friendName,:year,:mail,:image,:message,:senderName,1,NOW())");
        $req->bindValue(":idFacebook", $sender, PDO::PARAM_INT);
        $req->bindValue(":friendName", $friendName, PDO::PARAM_STR);
        $req->bindValue(":year",$year, PDO::PARAM_STR);
        $req->bindValue(":mail",$mail, PDO::PARAM_STR);
        $req->bindValue(":image",$image, PDO::PARAM_STR);
        $req->bindValue(":message",$message, PDO::PARAM_STR);
        $req->bindValue(":senderName",$senderName, PDO::PARAM_STR);
        $req->execute();
    }
    public function getNumberUser()
    {
      $req = $this->base->query("SELECT COUNT(*) FROM user");
      return $req->fetchColumn();
    }

    public function getNumberBirthday()
    {
      $req = $this->base->query("SELECT COUNT(*) FROM birthday");
      return $req->fetchColumn();
    }
    public function getNumberVoteSurvey()
    {
      $req = $this->base->query("SELECT COUNT(*) FROM vote");
      return $req->fetchColumn();
    }
    public function getAllBirthday()
    {
      $req = $this->base->query("SELECT * FROM birthday WHERE alreadySend != 0 ");
      return $req->fetchAll() ;
    }
    public function executeBirthday($id)
    {
      $req = $this->base->prepare("UPDATE birthday SET alreadySend = 0 WHERE id=:id ");
      $req->bindValue(":id",$id,PDO::PARAM_INT);
      $req->execute();
    }

    public function addNewSurvey($nom,$prenom,$email,$survey,$image)
    {
        $req = $this->base->prepare("INSERT INTO sondage VALUES(NULL,:nom, :prenom, :email, :texte, :image, NOW())");
        $req->bindValue(":nom",$nom,PDO::PARAM_STR);
        $req->bindValue(":prenom",$prenom,PDO::PARAM_STR);
        $req->bindValue(":email",$email,PDO::PARAM_STR);
        $req->bindValue(":texte",$survey,PDO::PARAM_STR);
        $req->bindValue(":image",$image,PDO::PARAM_STR);
        $req->execute();
    }

    public function getAllUsers()
    {
      $req = $this->base->query("SELECT * FROM user");
      return $req->fetchAll() ;
    }
}
