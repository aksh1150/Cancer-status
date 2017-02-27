<?php

class commonUtility
{
    public function getCountryListByDieases()
    {
        $result = array();
        $result["data"] = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT code_no FROM  	disease_master_tbl WHERE item LIKE :item GROUP BY code_no");
            $sql->execute(array(":item" => '%' . $_POST["keyword"] . '%'));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    function getAllDieaseData()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%Alcohol use disorders%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%cancer%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%Life expectancy%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%Drug use%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%HIV/AIDS%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%Hepatitis%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%Malaria%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%road traffic deaths%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%traffic death rate%' LIMIT 100 ");
            //$sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE category LIKE '%suicide%' LIMIT 100 ");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    function getCountryShortName($country)
    {
        try {
            $sql_1 = DB_CONN::getInstance()->prepare("SELECT short_name FROM country_list WHERE long_name = :long_name LIMIT 1");
            $sql_1->execute(array(":long_name" => $country));
            $result_1["data"] = $sql_1->fetch(PDO::FETCH_ASSOC);
            return $result_1["data"]["short_name"];
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;

        }
    }

    function getCountryLongName($country)
    {
        try {
            $sql_1 = DB_CONN::getInstance()->prepare("SELECT long_name FROM country_list WHERE short_name = :short_name LIMIT 1");
            $sql_1->execute(array(":short_name" => $country));
            $result_1["data"] = $sql_1->fetch(PDO::FETCH_ASSOC);
            return $result_1["data"]["long_name"];
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;

        }
    }

    function getCountryWiseData($country)
    {
        $result = array();
        try {

            $sql_1 = DB_CONN::getInstance()->prepare("SELECT long_name FROM country_list WHERE short_name = :short_name LIMIT 1");
            $sql_1->execute(array(":short_name" => $country));
            $result_1["data"] = $sql_1->fetch(PDO::FETCH_ASSOC);
            if (!empty($result_1["data"]["long_name"])) {
                $sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_data_by_diease WHERE country = :country");
                $sql->execute(array(":country" => $result_1["data"]["long_name"]));
                $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
                $result["status"] = 1;
            }
            return $result;


        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }


    function getDieaseWiseData($country, $disease)
    {
        $result = array();
        $result["data"] = array();
        try {
            if ($country != "ALL") {
                if (!empty($country)) {
                    $sql = DB_CONN::getInstance()->prepare("SELECT * FROM disease_master_tbl WHERE code_no = :code_no
                            AND item LIKE :item GROUP BY code_no");
                    $sql->execute(array(":code_no" => $country, ":item" => '%' . $disease . '%'));
                    $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
                    $result["status"] = 1;
                }
            } else {
                $sql = DB_CONN::getInstance()->prepare("SELECT * FROM disease_master_tbl WHERE
                            item LIKE :item GROUP BY code_no");
                $sql->execute(array(":item" => '%' . $disease . '%'));
                $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
                $result["status"] = 1;
            }
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }


    function getCountryData()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM country_list ");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    function getChartArrayString($info)
    {
        $str = '';
        $arr = $info;
        $len = sizeof($arr);
        $limit_last_prev = $len - 1;
        if ($len > 0) {
            for ($i = 0; $i < $len; $i++) {
                $str .= '["' . $arr[$i]['year'] . '",' . $arr[$i]['value'] . ',"gold"]';
                if ($i != $limit_last_prev) {
                    $str .= ',';
                }
            }
        }
        if ($len == 0) {
            $str = '[0,  0 , ""]';
        }

        return $str;
    }


    function getChartArrayStringDiease($info)
    {
        $str = '';
        $arr = $info;
        $len = sizeof($arr);
        $limit_last_prev = $len - 1;
        if ($len > 0) {
            for ($i = 0; $i < $len; $i++) {
                $str .= '["' . $arr[$i]['country'] . '",' . $arr[$i]['value'] . ',"gold"]';
                if ($i != $limit_last_prev) {
                    $str .= ',';
                }
            }
        }
        if ($len == 0) {
            $str = '[0,  0 , ""]';
        }

        return $str;
    }

    public function getQuestionDataF()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM question_master_tbl WHERE status = :status");
            $sql->execute(array(":status" => '1'));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getUserDieaseData($id)
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM user_disease_list WHERE user_id = :user_id");
            $sql->execute(array(":user_id" => $id));
            //$result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["data"] = array();
            $string_classify = '';
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                //$row["navie_diesase_result"]  = $this->getNaiveAlgoResult($row["habit_str"]);
                /*echo '<pre>';
                print_r($row);
                echo '</pre>';*/
                $nativeAlgoData = $this->getNaiveAlgoResult($row["habit_str"]);
                $row["navie_diesase_result"] = $nativeAlgoData["result"];
                $row["navie_diesase_data"] = $nativeAlgoData["data"];
                $result["data"] = $row;

            }
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }


    public function getAllUserDieaseData()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM user_disease_list");
            $sql->execute();
            //$result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["data"] = array();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $question_arr = json_decode($row["questions"]);
                foreach ($question_arr AS $key => $value) {
                    $data["que"] = $this->getQuestionDataById($key);
                    $data["ans"] = $value;
                    $row["question_list"][] = $data;
                }
                $result["data"][] = $row;
            }
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }


    function getQuestionDataById($id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT question FROM question_master_tbl WHERE question_id = :question_id ");
            $stmt->execute(array
                (':question_id' => $id)
            );
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["question"];
        } catch (PDOException $e) {
            $result = '';
            return $result;
        }
    }

    public function addUserDieaseData($user_id)
    {
        try {
            if (isset($_POST["diease_symptomas"]) && is_array($_POST["diease_symptomas"])) {
                $_POST["diease_symptomas"] = json_encode($_POST["diease_symptomas"]);
            } else {
                $_POST["diease_symptomas"] = [];
            }
            if (!isset($_POST["relation_with_cancer_patient"])) {
                $_POST["relation_with_cancer_patient"] = '';
            }
            $disease_str = $this->getDiseaseStr();
            $_POST["diease_symptomas"] = '';
            $sql = " INSERT INTO user_disease_list
                                (name, age, gender, marital_status, no_of_childern, living_area, education, occupational_hazards, 
                                  smoking, alcohol, chewing, hot_beverages, passive_smoking, diet, ff_addication, family_history_of_cancer, 
                                  relation_with_cancer_patient, weight_loss, anemia, cancer_earlier,
                                  breathlessness, vaginal_bleeding, persistent_heartburn_indigestion, croaky_voice_hoarseness, looser_poo_pooing, persistent_bloating, difficulty_swallowing, sore_heal,
                                   mounth_tongue_ulcer, night_sweats, breast_changes, poo_blood, pee_blood, mole, coughing_up_blood, persistent_cough, problem_peeing, pain_ache, lump_swelling, testicles,
                                   lymph_nodes, belly_pain_and_depression, pelvic_pain, fever,
                                  diease_id, diease_symptomas , habit_str , login_user_id )
                                 VALUES
                                 ( :name, :age, :gender, :marital_status, :no_of_childern, :living_area, :education, :occupational_hazards, 
                                  :smoking, :alcohol, :chewing, :hot_beverages, :passive_smoking, :diet, :ff_addication, :family_history_of_cancer, 
                                  :relation_with_cancer_patient, :weight_loss, :anemia, :cancer_earlier,
                                   :breathlessness, :vaginal_bleeding, :persistent_heartburn_indigestion, :croaky_voice_hoarseness, :looser_poo_pooing,
                                   :persistent_bloating, :difficulty_swallowing, :sore_heal, :mounth_tongue_ulcer, :night_sweats, :breast_changes, :poo_blood, :pee_blood, :mole,
                                    :coughing_up_blood, :persistent_cough, :problem_peeing, :pain_ache, :lump_swelling, :testicles, :lymph_nodes, :belly_pain_and_depression, :pelvic_pain, :fever,
                                   :diease_id, :diease_symptomas , :habit_str , :login_user_id);
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':name' => $_POST["name"],
                    ':age' => $_POST["age"],
                    ':gender' => $_POST["gender"],
                    ':marital_status' => $_POST["marital_status"],
                    ':no_of_childern' => $_POST["no_of_childern"],
                    ':living_area' => $_POST["living_area"],
                    ':education' => $_POST["education"],
                    ':occupational_hazards' => $_POST["occupational_hazards"],
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
                    ':diease_id' => '',
                    ':diease_symptomas' => '',
                    ':habit_str' => $disease_str,
                    ':login_user_id' => $user_id
                )
            );

            /*':diease_id' => $_POST["diease_id"],*/
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1', 'last_id' => $last_id);
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function updateUserDieaseData($user_id){
        try {
            if (isset($_POST["diease_symptomas"]) && is_array($_POST["diease_symptomas"])) {
                $_POST["diease_symptomas"] = json_encode($_POST["diease_symptomas"]);
            } else {
                $_POST["diease_symptomas"] = [];
            }
            if (!isset($_POST["relation_with_cancer_patient"])) {
                $_POST["relation_with_cancer_patient"] = '';
            }
            $disease_str = $this->getDiseaseStr();
            $_POST["diease_symptomas"] = '';
            $sql = " UPDATE user_disease_list
                           set
                              name = :name,
                              age = :age,
                              gender = :gender,
                              marital_status = :marital_status,
                              no_of_childern = :no_of_childern,
                              living_area = :living_area,
                              education = :education,
                              occupational_hazards = :occupational_hazards,
                              smoking = :smoking,
                              alcohol = :alcohol,
                              chewing = :chewing,
                              hot_beverages = :hot_beverages,
                              passive_smoking = :passive_smoking,
                              diet = :diet,
                              ff_addication = :ff_addication,
                              family_history_of_cancer = :family_history_of_cancer,
                              relation_with_cancer_patient = :relation_with_cancer_patient,
                              weight_loss = :weight_loss,
                              anemia = :anemia,
                              cancer_earlier = :cancer_earlier,
                              breathlessness = :breathlessness,
                              vaginal_bleeding = :vaginal_bleeding,
                              persistent_heartburn_indigestion = :persistent_heartburn_indigestion,
                              croaky_voice_hoarseness = :croaky_voice_hoarseness,
                              looser_poo_pooing = :looser_poo_pooing,
                              persistent_bloating = :persistent_bloating,
                              difficulty_swallowing = :difficulty_swallowing,
                              sore_heal = :sore_heal,
                              mounth_tongue_ulcer = :mounth_tongue_ulcer,
                              night_sweats = :night_sweats,
                              breast_changes = :breast_changes,
                              poo_blood = :poo_blood,
                              pee_blood = :pee_blood,
                              mole = :mole,
                              coughing_up_blood = :coughing_up_blood,
                              persistent_cough = :persistent_cough,
                              problem_peeing = :problem_peeing,
                              pain_ache = :pain_ache,
                              lump_swelling = :lump_swelling,
                              testicles = :testicles,
                              lymph_nodes = :lymph_nodes,
                              belly_pain_and_depression = :belly_pain_and_depression,
                              pelvic_pain = :pelvic_pain,
                              fever = :fever,
                              diease_id = :diease_id,
                              diease_symptomas = :diease_symptomas,
                              habit_str = :habit_str,
                              login_user_id = :login_user_id
                           WHERE
                           user_id = :user_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':name' => $_POST["name"],
                    ':age' => $_POST["age"],
                    ':gender' => $_POST["gender"],
                    ':marital_status' => $_POST["marital_status"],
                    ':no_of_childern' => $_POST["no_of_childern"],
                    ':living_area' => $_POST["living_area"],
                    ':education' => $_POST["education"],
                    ':occupational_hazards' => $_POST["occupational_hazards"],
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
                    ':diease_id' => '',
                    ':diease_symptomas' => '',
                    ':habit_str' => $disease_str,
                    ':login_user_id' => $user_id,
                    ':user_id' => $_POST["user_id"]
                )
            );

            /*':diease_id' => $_POST["diease_id"],*/
            $last_id = $_POST["user_id"] ;
            $result = array("status" => '1', 'last_id' => $last_id);
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    private function getDiseaseStr()
    {
        $str = '';
        if ($_POST["smoking"] == 'Yes') {
            $str .= 'smoking , ';
        }
        if ($_POST["alcohol"] == 'Yes') {
            $str .= 'alcohol , ';
        }
        if ($_POST["chewing"] == 'Yes') {
            $str .= 'chewing , ';
        }
        if ($_POST["hot_beverages"] == 'Yes') {
            $str .= 'hot_beverages , ';
        }
        if ($_POST["passive_smoking"] == 'Yes') {
            $str .= 'passive_smoking , ';
        }
        if ($_POST["diet"] == 'Yes') {
            $str .= 'diet , ';
        }
        if ($_POST["ff_addication"] == 'Yes') {
            $str .= 'ff_addication , ';
        }
        if ($_POST["family_history_of_cancer"] == 'Yes') {
            $str .= 'family_history_of_cancer , ';
        }
        if ($_POST["relation_with_cancer_patient"] == 'Yes') {
            $str .= 'relation_with_cancer_patient , ';
        }
        if ($_POST["weight_loss"] == 'Yes') {
            $str .= 'weight_loss , ';
        }
        if ($_POST["anemia"] == 'Yes') {
            $str .= 'anemia , ';
        }
        if ($_POST["cancer_earlier"] == 'Yes') {
            $str .= 'cancer_earlier ,';
        }
        //New Data
        if ($_POST["breathlessness"] == 'Yes') {
            $str .= 'breathlessness ,';
        }
        if ($_POST["vaginal_bleeding"] == 'Yes') {
            $str .= 'vaginal_bleeding ,';
        }
        if ($_POST["persistent_heartburn_indigestion"] == 'Yes') {
            $str .= 'persistent_heartburn_indigestion ,';
        }
        if ($_POST["croaky_voice_hoarseness"] == 'Yes') {
            $str .= 'croaky_voice_hoarseness ,';
        }
        if ($_POST["looser_poo_pooing"] == 'Yes') {
            $str .= 'looser_poo_pooing ,';
        }
        if ($_POST["persistent_bloating"] == 'Yes') {
            $str .= 'persistent_bloating ,';
        }
        if ($_POST["difficulty_swallowing"] == 'Yes') {
            $str .= 'difficulty_swallowing ,';
        }
        if ($_POST["sore_heal"] == 'Yes') {
            $str .= 'sore_heal ,';
        }
        if ($_POST["mounth_tongue_ulcer"] == 'Yes') {
            $str .= 'mounth_tongue_ulcer ,';
        }
        if ($_POST["night_sweats"] == 'Yes') {
            $str .= 'night_sweats ,';
        }
        if ($_POST["breast_changes"] == 'Yes') {
            $str .= 'breast_changes ,';
        }
        if ($_POST["poo_blood"] == 'Yes') {
            $str .= 'poo_blood ,';
        }
        if ($_POST["pee_blood"] == 'Yes') {
            $str .= 'pee_blood ,';
        }
        if ($_POST["mole"] == 'Yes') {
            $str .= 'mole ,';
        }
        if ($_POST["coughing_up_blood"] == 'Yes') {
            $str .= 'coughing_up_blood ,';
        }
        if ($_POST["persistent_cough"] == 'Yes') {
            $str .= 'persistent_cough ,';
        }
        if ($_POST["problem_peeing"] == 'Yes') {
            $str .= 'problem_peeing ,';
        }
        if ($_POST["pain_ache"] == 'Yes') {
            $str .= 'pain_ache ,';
        }
        if ($_POST["lump_swelling"] == 'Yes') {
            $str .= 'lump_swelling ,';
        }
        if ($_POST["testicles"] == 'Yes') {
            $str .= 'testicles ,';
        }
        if ($_POST["lymph_nodes"] == 'Yes') {
            $str .= 'lymph_nodes ,';
        }
        if ($_POST["belly_pain_and_depression"] == 'Yes') {
            $str .= 'belly_pain_and_depression ,';
        }
        if ($_POST["pelvic_pain"] == 'Yes') {
            $str .= 'pelvic_pain ,';
        }
        if ($_POST["fever"] == 'Yes') {
            $str .= 'fever ,';
        }
        return $str;
    }

    function getDieaseAndSymptomasData()
    {

        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM diease_master_list");
            $sql->execute();
            $result["data"] = array();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                $row["symptomas"] = $this->getSymptomasDataById($row["diease_id"]);

                $result["data"][] = $row;
            }
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }

    }

    function getNaiveAlgoResult($string)
    {
        require 'naive_bayes_algorithm/autoload.php';
        $tokenizer = new HybridLogic\Classifier\Basic;
        $classifier = new HybridLogic\Classifier($tokenizer);

        $tokenizer = new HybridLogic\Classifier\Basic;
        $classifier = new HybridLogic\Classifier($tokenizer);

        $disease_risk_list = $this->diseaseRisklist();

        foreach ($disease_risk_list["data"] AS $key => $value) {
            foreach($value AS $key_sub => $value_sub) {
                $classifier->train($key, $value_sub);
                /*echo '<pre>';
                print_r($key);
                print_r($value_sub);
                echo '</pre>';*/
            }
        }

        /*$classifier->train('Stomac Cancer', 'Smoking');
        $classifier->train('Stomac Cancer', 'Alcohol');
        $classifier->train('Stomac Cancer', 'Chewing');
        $classifier->train('Stomac Cancer', 'Diet');
        $classifier->train('Stomac Cancer', 'Family History Of Cancer');
        $classifier->train('Stomac Cancer', 'Relation With Cancer Patient');
        $classifier->train('Stomac Cancer', 'Are You Diagnosed With Cancer Earlier');

        $classifier->train('Head & Neck Cancer', 'Smoking');
        $classifier->train('Head & Neck Cancer', 'Alcohol');
        $classifier->train('Head & Neck Cancer', 'Chewing');
        $classifier->train('Head & Neck Cancer', 'Passive Smoking');
        $classifier->train('Head & Neck Cancer', 'Weight Loss');
        $classifier->train('Head & Neck Cancer', 'Are You Diagnosed With Cancer Earlier');

        $classifier->train('Breast Cancer', 'Smoking');
        $classifier->train('Breast Cancer', 'Alcohol');
        $classifier->train('Breast Cancer', 'Family History Of Cancer');
        $classifier->train('Breast Cancer', 'Relation With Cancer Patient');
        $classifier->train('Breast Cancer', 'Weight Loss');
        $classifier->train('Breast Cancer', 'Anemia');
        $classifier->train('Breast Cancer', 'Are You Diagnosed With Cancer Earlier');

        $classifier->train('Chest Cancer', 'Smoking');
        $classifier->train('Chest Cancer', 'Alcohol');
        $classifier->train('Chest Cancer', 'Diet');

        $classifier->train('Pelvis Cancer', 'Smoking');
        $classifier->train('Pelvis Cancer', 'Smoking');
        $classifier->train('Pelvis Cancer', 'Smoking');*/

        $groups["result"] = $classifier->classify($string);
        $groups["data"] = $disease_risk_list;
        return $groups;
    }

    function diseaseRisklist()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM risk_factor_of_disease ");
            $sql->execute();
            $result["data"] = array();
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $info = array();
                foreach ($row AS $key => $value) {
                    if ($value == 'Yes') {
                        $info[] = $key;
                    }
                }
                $result["data"][$row["value"]][] = $info;
            }

            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    function getSymptomasDataById($id)
    {
        $result = array();
        try {
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM diease_symptoms WHERE diease_id = :diease_id ");
            $stmt->execute(array
                (':diease_id' => $id)
            );
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return $result;
        }
    }

    function getStateWiseData($state)
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM disease_master_tbl WHERE code_no = :code_no");
            $sql->execute(array(":code_no" => $state));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    function dieaseAutoCompleteData()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT DISTINCT(item) FROM disease_master_tbl ");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function UserLogin()
    {
        $username = $_POST['login_email'];
        $password = $_POST['login_password'];
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM user_registration WHERE email = :email AND password = :password  ");
            $stmt->execute(array
                (
                    ':email' => $username,
                    ':password' => $password,
                )
            );
            $rows = $stmt->rowCount();
            if ($rows > 0) {
                $results_login = $stmt->fetch(PDO::FETCH_ASSOC);
                $result['login_id'] = $results_login['id'];
                $result["status"] = 1;
                return $result;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function addUserData()
    {
        try {
            $conn = DB_CONN::getInstance();
            /*$stmt = $conn->prepare("SELECT * FROM user_login WHERE mobile_no = :mobile_no ");*/
            $stmt = $conn->prepare("SELECT * FROM user_registration WHERE email = :email");

            $stmt->execute(array
                (':email' => $_POST["email"])
            );
            $data["count"] = $stmt->rowCount();
            if ($data["count"] == 0) {
                $sql = " INSERT INTO user_registration
                                ( name, age, gender, country, mobile_no, email , password )
                                 VALUES
                                 (:name, :age, :gender, :country, :mobile_no, :email,  :password);
                                 ";
                $conn = DB_CONN::getInstance();
                $stmt = $conn->prepare($sql);
                $stmt->execute(array
                    (
                        ':name' => $_POST["name"],
                        ':age' => $_POST["age"],
                        ':gender' => $_POST["gender"],
                        ':country' => $_POST["country"],
                        ':mobile_no' => $_POST["mobile_no"],
                        ':email' => $_POST["email"],
                        ':password' => $_POST["rpassword"]
                    )
                );
                $last_id = $conn->lastInsertId();
                $result = array("status" => '1', 'last_id' => $last_id);
            } else {
                $result = array("status" => '2', 'message' => 'Email Id Already Exist');
            }
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function getUserDataBYId($user_id)
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM user_disease_list WHERE login_user_id = :user_id ");
            $sql->execute(array(':user_id' => $user_id));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

}