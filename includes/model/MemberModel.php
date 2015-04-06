<?php

class MemberModel
{

    private $database;
    private $connexion;

    public function MemberModel($database)
    {
        $this->database = $database;
        $this->connexion = $database->connexion;
    }

    public function addMember($member)
    {
        try {


            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_members WHERE username = :username");
            $stmt->bindParam(':username',$member->username);
            $stmt->execute();
            $data=$stmt->fetch(PDO::FETCH_OBJ);

            if($data) {
                return;
            } else {
                $stmt = $this->connexion->prepare("INSERT INTO survival_guide_members(username,mail,code_section,role) VALUES(:username, :mail, :code_section, :role)");
                $stmt->bindParam(':username',$member->username);
                $stmt->bindParam(':mail',$member->mail);
                $stmt->bindParam(':code_section',$member->code_section);
                $stmt->bindParam(':role',$member->role);
                $stmt->execute();
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getRole($username)
    {
        try {
            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_members WHERE username = :username");
            $stmt->bindParam(':username',$username);
            $stmt->execute();
            $data=$stmt->fetch(PDO::FETCH_OBJ);

            if($data) {
                return $data->role;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}