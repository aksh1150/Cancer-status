<?php

class dieseaseRiskUtility
{
    public function addDiseaseRiskData()
    {
        try {
            $check_status = $this->checkDiseaseRiskDataExist("INSERT");
            if ($check_status["status"] == 1) {
                $sql = " INSERT INTO risk_factor_of_disease
                                    ( smoking, alcohol, chewing, hot_beverages, passive_smoking, diet, ff_addication, family_history_of_cancer,
                                      relation_with_cancer_patient, weight_loss, anemia, cancer_earlier,
                                       breathlessness, vaginal_bleeding, persistent_heartburn_indigestion, croaky_voice_hoarseness, looser_poo_pooing, persistent_bloating, difficulty_swallowing, sore_heal,
                                   mounth_tongue_ulcer, night_sweats, breast_changes, poo_blood, pee_blood, mole, coughing_up_blood, persistent_cough, problem_peeing, pain_ache, lump_swelling, testicles,
                                   lymph_nodes, belly_pain_and_depression, pelvic_pain, fever,
                                       value )
                                 VALUES
                                 ( :smoking, :alcohol, :chewing, :hot_beverages, :passive_smoking, :diet, :ff_addication, :family_history_of_cancer,
                                      :relation_with_cancer_patient, :weight_loss, :anemia, :cancer_earlier,
                                      :breathlessness, :vaginal_bleeding, :persistent_heartburn_indigestion, :croaky_voice_hoarseness, :looser_poo_pooing,
                                   :persistent_bloating, :difficulty_swallowing, :sore_heal, :mounth_tongue_ulcer, :night_sweats, :breast_changes, :poo_blood, :pee_blood, :mole,
                                    :coughing_up_blood, :persistent_cough, :problem_peeing, :pain_ache, :lump_swelling, :testicles, :lymph_nodes, :belly_pain_and_depression, :pelvic_pain, :fever,
                                      :value );
                                 ";
                $conn = DB_CONN::getInstance();
                $stmt = $conn->prepare($sql);
                $stmt->execute(array
                    (
                        ':smoking' => $_POST["smoking"],
                        ':alcohol' => $_POST["alcohol"],
                        ':chewing' => $_POST["chewing"],
                        ':hot_beverages' => $_POST["hot_beverages"],
                        ':passive_smoking' => $_POST["passive_smoking"],
                        ':diet' => $_POST["diet"],
                        ':ff_addication' => $_POST["ff_addication"],
                        ':family_history_of_cancer' => $_POST["family_history_of_cancer"],
                        ':relation_with_cancer_patient' => $_POST["relation_with_cancer_patient"],
                        ':weight_loss' => $_POST["weight_loss"],
                        ':anemia' => $_POST["anemia"],
                        ':cancer_earlier' => $_POST["cancer_earlier"],
                        ':breathlessness' => $_POST["breathlessness"],
                        ':vaginal_bleeding'=> $_POST["vaginal_bleeding"],
                        ':persistent_heartburn_indigestion'=> $_POST["persistent_heartburn_indigestion"],
                        ':croaky_voice_hoarseness'=> $_POST["croaky_voice_hoarseness"],
                        ':looser_poo_pooing'=> $_POST["looser_poo_pooing"],
                        ':persistent_bloating'=> $_POST["persistent_bloating"],
                        ':difficulty_swallowing'=> $_POST["difficulty_swallowing"],
                        ':sore_heal'=> $_POST["sore_heal"],
                        ':mounth_tongue_ulcer'=> $_POST["mounth_tongue_ulcer"],
                        ':night_sweats'=> $_POST["night_sweats"],
                        ':breast_changes'=> $_POST["breast_changes"],
                        ':poo_blood'=> $_POST["poo_blood"],
                        ':pee_blood'=> $_POST["pee_blood"],
                        ':mole'=> $_POST["mole"],
                        ':coughing_up_blood'=> $_POST["coughing_up_blood"],
                        ':persistent_cough'=> $_POST["persistent_cough"],
                        ':problem_peeing'=> $_POST["problem_peeing"],
                        ':pain_ache'=> $_POST["pain_ache"],
                        ':lump_swelling'=> $_POST["lump_swelling"],
                        ':testicles'=> $_POST["testicles"],
                        ':lymph_nodes'=> $_POST["lymph_nodes"],
                        ':belly_pain_and_depression'=> $_POST["belly_pain_and_depression"],
                        ':pelvic_pain'=> $_POST["pelvic_pain"],
                        ':fever'=> $_POST["fever"],
                        ':value' => $_POST["value"]
                    )
                );
                $last_id = $conn->lastInsertId();
                $result = array("status" => '1', 'last_id' => $last_id);
            } else {
                $result = array("status" => '2', 'message' => 'Same Risk Factor already Exist');
            }
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function checkDiseaseRiskDataExist($type)
    {
        $result = array();
        try {
            if ($type == "INSERT") {
                $sql = DB_CONN::getInstance()->prepare("SELECT * FROM risk_factor_of_disease WHERE smoking = :smoking AND
                              alcohol = :alcohol AND
                              chewing = :chewing AND
                              hot_beverages     = :hot_beverages AND
                              passive_smoking =:passive_smoking AND
                              diet =:diet AND
                              ff_addication =:ff_addication AND
                              family_history_of_cancer =:family_history_of_cancer AND
                              relation_with_cancer_patient =:relation_with_cancer_patient AND
                              weight_loss =:weight_loss AND
                              anemia =:anemia AND
                              cancer_earlier =:cancer_earlier AND
                              breathlessness =:breathlessness AND
                              vaginal_bleeding =:vaginal_bleeding AND
                              persistent_heartburn_indigestion =:persistent_heartburn_indigestion AND
                              croaky_voice_hoarseness =:croaky_voice_hoarseness AND
                              looser_poo_pooing =:looser_poo_pooing AND
                              persistent_bloating =:persistent_bloating AND
                              difficulty_swallowing =:difficulty_swallowing AND
                              sore_heal =:sore_heal AND
                              mounth_tongue_ulcer =:mounth_tongue_ulcer AND
                              night_sweats =:night_sweats AND
                              breast_changes =:breast_changes AND
                              poo_blood =:poo_blood AND
                              pee_blood =:pee_blood AND
                              mole =:mole AND
                              coughing_up_blood =:coughing_up_blood AND
                              persistent_cough =:persistent_cough AND
                              problem_peeing =:problem_peeing AND
                              pain_ache =:pain_ache AND
                              lump_swelling =:lump_swelling AND
                              testicles =:testicles AND
                              lymph_nodes =:lymph_nodes AND
                              belly_pain_and_depression =:belly_pain_and_depression AND
                              pelvic_pain =:pelvic_pain AND
                              fever =:fever
                              ");
                $sql->execute(array
                (
                    ':smoking' => $_POST["smoking"],
                    ':alcohol' => $_POST["alcohol"],
                    ':chewing' => $_POST["chewing"],
                    ':hot_beverages' => $_POST["hot_beverages"],
                    ':passive_smoking' => $_POST["passive_smoking"],
                    ':diet' => $_POST["diet"],
                    ':ff_addication' => $_POST["ff_addication"],
                    ':family_history_of_cancer' => $_POST["family_history_of_cancer"],
                    ':relation_with_cancer_patient' => $_POST["relation_with_cancer_patient"],
                    ':weight_loss' => $_POST["weight_loss"],
                    ':anemia' => $_POST["anemia"],
                    ':cancer_earlier' => $_POST["cancer_earlier"],
                    ':breathlessness' => $_POST["breathlessness"],
                    ':vaginal_bleeding'=> $_POST["vaginal_bleeding"],
                    ':persistent_heartburn_indigestion'=> $_POST["persistent_heartburn_indigestion"],
                    ':croaky_voice_hoarseness'=> $_POST["croaky_voice_hoarseness"],
                    ':looser_poo_pooing'=> $_POST["looser_poo_pooing"],
                    ':persistent_bloating'=> $_POST["persistent_bloating"],
                    ':difficulty_swallowing'=> $_POST["difficulty_swallowing"],
                    ':sore_heal'=> $_POST["sore_heal"],
                    ':mounth_tongue_ulcer'=> $_POST["mounth_tongue_ulcer"],
                    ':night_sweats'=> $_POST["night_sweats"],
                    ':breast_changes'=> $_POST["breast_changes"],
                    ':poo_blood'=> $_POST["poo_blood"],
                    ':pee_blood'=> $_POST["pee_blood"],
                    ':mole'=> $_POST["mole"],
                    ':coughing_up_blood'=> $_POST["coughing_up_blood"],
                    ':persistent_cough'=> $_POST["persistent_cough"],
                    ':problem_peeing'=> $_POST["problem_peeing"],
                    ':pain_ache'=> $_POST["pain_ache"],
                    ':lump_swelling'=> $_POST["lump_swelling"],
                    ':testicles'=> $_POST["testicles"],
                    ':lymph_nodes'=> $_POST["lymph_nodes"],
                    ':belly_pain_and_depression'=> $_POST["belly_pain_and_depression"],
                    ':pelvic_pain'=> $_POST["pelvic_pain"],
                    ':fever'=> $_POST["fever"]

                ));
            } else {

                $sql = DB_CONN::getInstance()->prepare("SELECT * FROM risk_factor_of_disease WHERE smoking = :smoking AND
                              alcohol = :alcohol AND
                              chewing = :chewing AND
                              hot_beverages     = :hot_beverages AND
                              passive_smoking =:passive_smoking AND
                              diet =:diet AND
                              ff_addication =:ff_addication AND
                              family_history_of_cancer =:family_history_of_cancer AND
                              relation_with_cancer_patient =:relation_with_cancer_patient AND
                              weight_loss =:weight_loss AND
                              anemia =:anemia AND
                              cancer_earlier =:cancer_earlier AND
                              breathlessness =:breathlessness AND
                              vaginal_bleeding =:vaginal_bleeding AND
                              persistent_heartburn_indigestion =:persistent_heartburn_indigestion AND
                              croaky_voice_hoarseness =:croaky_voice_hoarseness AND
                              looser_poo_pooing =:looser_poo_pooing AND
                              persistent_bloating =:persistent_bloating AND
                              difficulty_swallowing =:difficulty_swallowing AND
                              sore_heal =:sore_heal AND
                              mounth_tongue_ulcer =:mounth_tongue_ulcer AND
                              night_sweats =:night_sweats AND
                              breast_changes =:breast_changes AND
                              poo_blood =:poo_blood AND
                              pee_blood =:pee_blood AND
                              mole =:mole AND
                              coughing_up_blood =:coughing_up_blood AND
                              persistent_cough =:persistent_cough AND
                              problem_peeing =:problem_peeing AND
                              pain_ache =:pain_ache AND
                              lump_swelling =:lump_swelling AND
                              testicles =:testicles AND
                              lymph_nodes =:lymph_nodes AND
                              belly_pain_and_depression =:belly_pain_and_depression AND
                              pelvic_pain =:pelvic_pain AND
                              fever =:fever
                              AND id <> :id ");
                $sql->execute(array
                (
                    ':smoking' => $_POST["smoking"],
                    ':alcohol' => $_POST["alcohol"],
                    ':chewing' => $_POST["chewing"],
                    ':hot_beverages' => $_POST["hot_beverages"],
                    ':passive_smoking' => $_POST["passive_smoking"],
                    ':diet' => $_POST["diet"],
                    ':ff_addication' => $_POST["ff_addication"],
                    ':family_history_of_cancer' => $_POST["family_history_of_cancer"],
                    ':relation_with_cancer_patient' => $_POST["relation_with_cancer_patient"],
                    ':weight_loss' => $_POST["weight_loss"],
                    ':anemia' => $_POST["anemia"],
                    ':cancer_earlier' => $_POST["cancer_earlier"],
                    ':breathlessness' => $_POST["breathlessness"],
                    ':vaginal_bleeding'=> $_POST["vaginal_bleeding"],
                    ':persistent_heartburn_indigestion'=> $_POST["persistent_heartburn_indigestion"],
                    ':croaky_voice_hoarseness'=> $_POST["croaky_voice_hoarseness"],
                    ':looser_poo_pooing'=> $_POST["looser_poo_pooing"],
                    ':persistent_bloating'=> $_POST["persistent_bloating"],
                    ':difficulty_swallowing'=> $_POST["difficulty_swallowing"],
                    ':sore_heal'=> $_POST["sore_heal"],
                    ':mounth_tongue_ulcer'=> $_POST["mounth_tongue_ulcer"],
                    ':night_sweats'=> $_POST["night_sweats"],
                    ':breast_changes'=> $_POST["breast_changes"],
                    ':poo_blood'=> $_POST["poo_blood"],
                    ':pee_blood'=> $_POST["pee_blood"],
                    ':mole'=> $_POST["mole"],
                    ':coughing_up_blood'=> $_POST["coughing_up_blood"],
                    ':persistent_cough'=> $_POST["persistent_cough"],
                    ':problem_peeing'=> $_POST["problem_peeing"],
                    ':pain_ache'=> $_POST["pain_ache"],
                    ':lump_swelling'=> $_POST["lump_swelling"],
                    ':testicles'=> $_POST["testicles"],
                    ':lymph_nodes'=> $_POST["lymph_nodes"],
                    ':belly_pain_and_depression'=> $_POST["belly_pain_and_depression"],
                    ':pelvic_pain'=> $_POST["pelvic_pain"],
                    ':fever'=> $_POST["fever"],
                    ':id' => $type));
            }
            if ($sql->rowCount() > 0) {
                $result["status"] = 2;
                $result["count"] =  $sql->rowCount();
            } else {
                $result["status"] = 1;
                $result["count"] =  $sql->rowCount();
            }

            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function updateDiseaseRiskData($id)
    {
        try {
            $check_status = $this->checkDiseaseRiskDataExist($id);
            if ($check_status["status"] == "1") {
                $sql = " UPDATE risk_factor_of_disease
                           SET
                              smoking = :smoking,
                              alcohol = :alcohol,
                              chewing = :chewing,
                              hot_beverages     = :hot_beverages,
                              passive_smoking =:passive_smoking,
                              diet =:diet,
                              ff_addication =:ff_addication,
                              family_history_of_cancer =:family_history_of_cancer,
                              relation_with_cancer_patient =:relation_with_cancer_patient,
                              weight_loss =:weight_loss,
                              anemia =:anemia,
                              cancer_earlier =:cancer_earlier,
                              breathlessness =:breathlessness,
                              vaginal_bleeding =:vaginal_bleeding,
                              persistent_heartburn_indigestion =:persistent_heartburn_indigestion,
                              croaky_voice_hoarseness =:croaky_voice_hoarseness,
                              looser_poo_pooing =:looser_poo_pooing,
                              persistent_bloating =:persistent_bloating,
                              difficulty_swallowing =:difficulty_swallowing,
                              sore_heal =:sore_heal,
                              mounth_tongue_ulcer =:mounth_tongue_ulcer,
                              night_sweats =:night_sweats,
                              breast_changes =:breast_changes,
                              poo_blood =:poo_blood,
                              pee_blood =:pee_blood,
                              mole =:mole,
                              coughing_up_blood =:coughing_up_blood,
                              persistent_cough =:persistent_cough,
                              problem_peeing =:problem_peeing,
                              pain_ache =:pain_ache,
                              lump_swelling =:lump_swelling,
                              testicles =:testicles,
                              lymph_nodes =:lymph_nodes,
                              belly_pain_and_depression =:belly_pain_and_depression,
                              pelvic_pain =:pelvic_pain,
                              fever =:fever,
                              value =:value
                           WHERE
                              id = :id";
                $conn = DB_CONN::getInstance();
                $stmt = $conn->prepare($sql);
                $stmt->execute(array
                    (
                        ':smoking' => $_POST["smoking"],
                        ':alcohol' => $_POST["alcohol"],
                        ':chewing' => $_POST["chewing"],
                        ':hot_beverages' => $_POST["hot_beverages"],
                        ':passive_smoking' => $_POST["passive_smoking"],
                        ':diet' => $_POST["diet"],
                        ':ff_addication' => $_POST["ff_addication"],
                        ':family_history_of_cancer' => $_POST["family_history_of_cancer"],
                        ':relation_with_cancer_patient' => $_POST["relation_with_cancer_patient"],
                        ':weight_loss' => $_POST["weight_loss"],
                        ':anemia' => $_POST["anemia"],
                        ':cancer_earlier' => $_POST["cancer_earlier"],
                        ':breathlessness' => $_POST["breathlessness"],
                        ':vaginal_bleeding'=> $_POST["vaginal_bleeding"],
                        ':persistent_heartburn_indigestion'=> $_POST["persistent_heartburn_indigestion"],
                        ':croaky_voice_hoarseness'=> $_POST["croaky_voice_hoarseness"],
                        ':looser_poo_pooing'=> $_POST["looser_poo_pooing"],
                        ':persistent_bloating'=> $_POST["persistent_bloating"],
                        ':difficulty_swallowing'=> $_POST["difficulty_swallowing"],
                        ':sore_heal'=> $_POST["sore_heal"],
                        ':mounth_tongue_ulcer'=> $_POST["mounth_tongue_ulcer"],
                        ':night_sweats'=> $_POST["night_sweats"],
                        ':breast_changes'=> $_POST["breast_changes"],
                        ':poo_blood'=> $_POST["poo_blood"],
                        ':pee_blood'=> $_POST["pee_blood"],
                        ':mole'=> $_POST["mole"],
                        ':coughing_up_blood'=> $_POST["coughing_up_blood"],
                        ':persistent_cough'=> $_POST["persistent_cough"],
                        ':problem_peeing'=> $_POST["problem_peeing"],
                        ':pain_ache'=> $_POST["pain_ache"],
                        ':lump_swelling'=> $_POST["lump_swelling"],
                        ':testicles'=> $_POST["testicles"],
                        ':lymph_nodes'=> $_POST["lymph_nodes"],
                        ':belly_pain_and_depression'=> $_POST["belly_pain_and_depression"],
                        ':pelvic_pain'=> $_POST["pelvic_pain"],
                        ':fever'=> $_POST["fever"],
                        ':value' => $_POST["value"],
                        ':id' => $id
                    )
                );
                $a_id = $id;
                $result = array("status" => '1', 'new_id' => $a_id);
            } else {
                $result = array("status" => '2', 'message' => 'Same Risk Factor already Exist' , 'exist_data'=>$check_status);
            }
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function getdieseaseRiskData()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM risk_factor_of_disease");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getdieseaseRiskDataByID($id)
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM risk_factor_of_disease WHERE id = :id");
            $sql->execute(array(':id' => $id));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function removeDiseaseRiskData($id)
    {
        $result = array();
        try {
            $result = array();
            $sql = " DELETE FROM risk_factor_of_disease WHERE
                            id =  :id
                     ";
            $q = DB_CONN::getInstance()->prepare($sql);
            $q->execute(array
                (':id' => $id)
            );

            $result = array("status" => '1');
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

}