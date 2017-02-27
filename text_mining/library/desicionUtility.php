<?php


class desicionUtility
{
  
    public function getDiseaseRiskColumnName()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name ='risk_factor_of_disease'");
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                if($row["COLUMN_NAME"] != 'id') {
                    $result[$row["COLUMN_NAME"]] = 1;
                }
            }
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getDiseaseRiskFactorList()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT  `smoking`, `alcohol`, `chewing`, `hot_beverages`, `passive_smoking`, `diet`,
                                        `ff_addication`, `family_history_of_cancer`, `relation_with_cancer_patient`, `weight_loss`, `anemia`,
                                         `cancer_earlier`,`breathlessness`, `vaginal_bleeding`, `persistent_heartburn_indigestion`,
                                         `croaky_voice_hoarseness`, `looser_poo_pooing`, `persistent_bloating`, `difficulty_swallowing`,
                                         `sore_heal`, `mounth_tongue_ulcer`, `night_sweats`, `breast_changes`, `poo_blood`, `pee_blood`,
                                         `mole`, `coughing_up_blood`, `persistent_cough`, `problem_peeing`, `pain_ache`, `lump_swelling`,
                                         `testicles`, `lymph_nodes`, `belly_pain_and_depression`, `pelvic_pain`, `fever`, `value`
                                         FROM `risk_factor_of_disease`");
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                $result[] = $row;

            }
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getDiseaseAnsList()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT  DISTINCT (`value`) FROM `risk_factor_of_disease` ");
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row["value"];
            }
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getUserColumnName(){
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name ='user_disease_list'");
            $sql->execute();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                if($row["COLUMN_NAME"] != 'id') {
                    $result[$row["COLUMN_NAME"]] = 1;
                }
            }
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getUserRiskFactorList()
    {
        $id  = $_REQUEST["id"];
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM `user_disease_list` WHERE user_id = :user_id");
            $sql->execute(array(':user_id' => $id));
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

   

}