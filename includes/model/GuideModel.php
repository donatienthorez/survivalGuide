<?php

class GuideModel
{

    private $database;
    private $connexion;

    public function GuideModel($database)
    {
        $this->database = $database;
        $this->connexion = $database->connexion;
    }

    public function addGuide($guide)
    {
        try {
                $stmt = $this->connexion->prepare("INSERT INTO survival_guide_guide(code_section,status) VALUES(:code_section, :status)");
                $stmt->bindParam(':code_section',$guide->code_section);
                $stmt->bindParam(':status',$guide->status);
                $stmt->execute();

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function countGuide()
    {
        try {
            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_guide");
            $stmt->execute();
            return $stmt->rowcount();
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function updateGuide($guide)
    {
        try {
            $stmt = $this->connexion->prepare("UPDATE survival_guide_guide SET status=:status WHERE code_section=:code_section");
            $stmt->bindParam(':status', $guide->status);
            $stmt->bindParam(':code_section', $guide->code_section);
            $stmt->execute();
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getGuide($code_section)
    {
        try {
            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_guide WHERE code_section = :code_section");
            $stmt->bindParam(':code_section',$code_section);
            $stmt->execute();
            $data=$stmt->fetch(PDO::FETCH_OBJ);

            if($data) {
                return new Guide($data->code_section,$data->status);
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return null;
    }

    public function getSections()
    {
        try {
            $stmt = $this->connexion->prepare("SELECT * from survival_guide_guide");
            $stmt->execute();

            $sections = array();

            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($sections, $data->code_section);
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $sections;
    }

    public function isActivated($code_section)
    {
        try {
            $stmt = $this->connexion->prepare("SELECT * FROM survival_guide_guide WHERE code_section = :code_section");
            $stmt->bindParam(':code_section',$code_section);
            $stmt->execute();
            $data=$stmt->fetch(PDO::FETCH_OBJ);

            if($data) {
                return $data->status==Guide::STATUS_ON;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return false;
    }
}