<?php
//$ob_category_utility = new dieaseUtility();


$ob_disease_risk_utility = new dieseaseRiskUtility();

/*Get All admin Detasils for display table*/
$a_disease_risk_list = $ob_disease_risk_utility->getdieseaseRiskData();

if (isset($_POST['submit'])) {

    if (isset($_POST['submit']) && $_POST['submit'] == 'ADD') {
        $result = $ob_disease_risk_utility->addDiseaseRiskData();
        //print_r($result["status"]);
        if ($result["status"] == 1) {
            echo "<script>
            alert('Add Disease Risk Factor Successfull');
            location.href='disease_risk_factor.php'
            </script>";
        } else if ($result["status"] == 2) {
            echo '<script>alert("Same Risk Factor already Exist")</script>';
        }
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
        $result = $ob_disease_risk_utility->updateDiseaseRiskData($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>alert('Update Disease Risk Factor Successfull');
                    location.href='disease_risk_factor.php'
                    </script>";
        } else if ($result["status"] == 2) {
            echo '<script>alert("Same Risk Factor already Exist")</script>';
        }

    }
}

if (isset($_REQUEST)) {
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
        $result = $ob_disease_risk_utility->removeDiseaseRiskData($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>location.href='disease_risk_factor.php'</script>";

        }
    }
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
        $data = $ob_disease_risk_utility->getdieseaseRiskDataByID($_REQUEST['id']);
        $data = $data["data"][0];

    }
}

?>

<div class="row">
    <!--Main Title Div Start -->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Add Disease Data</h5>
    </div>
    <!--Main Title Div End-->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="form_border">
            <div class="row">
                <form role="form" method="post" action="">

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Smoking</label>
                        <select class="form-control" name="smoking">
                            <option <?php if (isset($data["smoking"]) && $data["smoking"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["smoking"]) && $data["smoking"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Alcohol</label>
                        <select class="form-control" name="alcohol">
                            <option <?php if (isset($data["alcohol"]) && $data["alcohol"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["alcohol"]) && $data["alcohol"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Chewing</label>
                        <select class="form-control" name="chewing">
                            <option <?php if (isset($data["chewing"]) && $data["chewing"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["chewing"]) && $data["chewing"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Hot Beverages</label>
                        <select class="form-control" name="hot_beverages">
                            <option <?php if (isset($data["hot_beverages"]) && $data["hot_beverages"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["hot_beverages"]) && $data["hot_beverages"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Passive Smoking</label>
                        <select class="form-control" name="passive_smoking">
                            <option <?php if (isset($data["passive_smoking"]) && $data["passive_smoking"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["passive_smoking"]) && $data["passive_smoking"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Diet</label>
                        <select class="form-control" name="diet">
                            <option <?php if (isset($data["diet"]) && $data["diet"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["diet"]) && $data["diet"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Fast Food Addication</label>
                        <select class="form-control" name="ff_addication">
                            <option <?php if (isset($data["ff_addication"]) && $data["ff_addication"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["ff_addication"]) && $data["ff_addication"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Family History Of Cancer</label>
                        <select id="family_history_cancer" class="form-control" onclick="display_cancer_patient_div()"
                                name="family_history_of_cancer">
                            <option <?php if (isset($data["family_history_of_cancer"]) && $data["family_history_of_cancer"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["family_history_of_cancer"]) && $data["family_history_of_cancer"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div id="cancer_patient_div" class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Relation With Cancer Patient</label>
                        <select class="form-control" name="relation_with_cancer_patient">
                            <option <?php if (isset($data["relation_with_cancer_patient"]) && $data["relation_with_cancer_patient"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["relation_with_cancer_patient"]) && $data["relation_with_cancer_patient"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Weight LOss</label>
                        <select class="form-control" name="weight_loss">
                            <option <?php if (isset($data["weight_loss"]) && $data["weight_loss"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["weight_loss"]) && $data["weight_loss"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Anemia</label>
                        <select class="form-control" name="anemia">
                            <option <?php if (isset($data["anemia"]) && $data["anemia"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["anemia"]) && $data["anemia"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Are You Diagnosed With Cancer Earlier</label>
                        <select class="form-control" name="cancer_earlier">
                            <option <?php if (isset($data["cancer_earlier"]) && $data["cancer_earlier"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["cancer_earlier"]) && $data["cancer_earlier"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Breathlessness</label>
                        <select class="form-control" name="breathlessness">
                            <option <?php if (isset($data["breathlessness"]) && $data["breathlessness"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["breathlessness"]) && $data["breathlessness"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unexplained vaginal bleeding </label>
                        <select class="form-control" name="vaginal_bleeding">
                            <option <?php if (isset($data["vaginal_bleeding"]) && $data["vaginal_bleeding"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["vaginal_bleeding"]) && $data["vaginal_bleeding"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Persistent heartburn or indigestion</label>
                        <select class="form-control" name="persistent_heartburn_indigestion">
                            <option <?php if (isset($data["persistent_heartburn_indigestion"]) && $data["persistent_heartburn_indigestion"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["persistent_heartburn_indigestion"]) && $data["persistent_heartburn_indigestion"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Croaky voice or hoarseness </label>
                        <select class="form-control" name="croaky_voice_hoarseness">
                            <option <?php if (isset($data["croaky_voice_hoarseness"]) && $data["croaky_voice_hoarseness"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["croaky_voice_hoarseness"]) && $data["croaky_voice_hoarseness"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Looser poo or pooing more often</label>
                        <select class="form-control" name="looser_poo_pooing">
                            <option <?php if (isset($data["looser_poo_pooing"]) && $data["looser_poo_pooing"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["looser_poo_pooing"]) && $data["looser_poo_pooing"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Persistent bloating</label>
                        <select class="form-control" name="persistent_bloating">
                            <option <?php if (isset($data["persistent_bloating"]) && $data["persistent_bloating"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["persistent_bloating"]) && $data["persistent_bloating"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Difficulty swallowing </label>
                        <select class="form-control" name="difficulty_swallowing">
                            <option <?php if (isset($data["difficulty_swallowing"]) && $data["difficulty_swallowing"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["difficulty_swallowing"]) && $data["difficulty_swallowing"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Sore that won’t heal </label>
                        <select class="form-control" name="sore_heal">
                            <option <?php if (isset($data["sore_heal"]) && $data["sore_heal"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["sore_heal"]) && $data["sore_heal"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>


                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Mouth or tongue ulcer </label>
                        <select class="form-control" name="mounth_tongue_ulcer">
                            <option <?php if (isset($data["mounth_tongue_ulcer"]) && $data["mounth_tongue_ulcer"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["mounth_tongue_ulcer"]) && $data["mounth_tongue_ulcer"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Heavy night sweats </label>
                        <select class="form-control" name="night_sweats">
                            <option <?php if (isset($data["night_sweats"]) && $data["night_sweats"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["night_sweats"]) && $data["night_sweats"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unusual breast changes </label>
                        <select class="form-control" name="breast_changes">
                            <option <?php if (isset($data["breast_changes"]) && $data["breast_changes"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["breast_changes"]) && $data["breast_changes"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Blood in your poo </label>
                        <select class="form-control" name="poo_blood">
                            <option <?php if (isset($data["poo_blood"]) && $data["poo_blood"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["poo_blood"]) && $data["poo_blood"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Blood in your pee </label>
                        <select class="form-control" name="pee_blood">
                            <option <?php if (isset($data["pee_blood"]) && $data["pee_blood"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["pee_blood"]) && $data["pee_blood"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">New mole or changes to a mole</label>
                        <select class="form-control" name="mole">
                            <option <?php if (isset($data["mole"]) && $data["mole"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["mole"]) && $data["mole"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Coughing up blood</label>
                        <select class="form-control" name="coughing_up_blood">
                            <option <?php if (isset($data["coughing_up_blood"]) && $data["coughing_up_blood"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["coughing_up_blood"]) && $data["coughing_up_blood"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Persistent cough</label>
                        <select class="form-control" name="persistent_cough">
                            <option <?php if (isset($data["persistent_cough"]) && $data["persistent_cough"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["persistent_cough"]) && $data["persistent_cough"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Problems peeing</label>
                        <select class="form-control" name="problem_peeing">
                            <option <?php if (isset($data["problem_peeing"]) && $data["problem_peeing"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["problem_peeing"]) && $data["problem_peeing"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unexplained pain or ache</label>
                        <select class="form-control" name="pain_ache">
                            <option <?php if (isset($data["pain_ache"]) && $data["pain_ache"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["pain_ache"]) && $data["pain_ache"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unusual lump or swelling anywhere</label>
                        <select class="form-control" name="lump_swelling">
                            <option <?php if (isset($data["lump_swelling"]) && $data["lump_swelling"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["lump_swelling"]) && $data["lump_swelling"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Changes in Your Testicles</label>
                        <select class="form-control" name="testicles">
                            <option <?php if (isset($data["testicles"]) && $data["testicles"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["testicles"]) && $data["testicles"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Changes in Lymph Nodes</label>
                        <select class="form-control" name="lymph_nodes">
                            <option <?php if (isset($data["lymph_nodes"]) && $data["lymph_nodes"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["lymph_nodes"]) && $data["lymph_nodes"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Belly Pain and Depression</label>
                        <select class="form-control" name="belly_pain_and_depression">
                            <option <?php if (isset($data["belly_pain_and_depression"]) && $data["belly_pain_and_depression"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["belly_pain_and_depression"]) && $data["belly_pain_and_depression"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">pelvic pain</label>
                        <select class="form-control" name="pelvic_pain">
                            <option <?php if (isset($data["pelvic_pain"]) && $data["pelvic_pain"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["pelvic_pain"]) && $data["pelvic_pain"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Fever </label>
                        <select class="form-control" name="fever">
                            <option <?php if (isset($data["fever"]) && $data["fever"] == "No") {
                                echo "selected";
                            } ?> value="No">No
                            </option>
                            <option <?php if (isset($data["fever"]) && $data["fever"] == "Yes") {
                                echo "selected";
                            } ?> value="Yes">Yes
                            </option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Select Cancer</label>
                        <select class="form-control" name="value">
                            <option <?php if (isset($data["value"]) && $data["value"] == "Skin Cancer") {
                                echo "selected";
                            } ?> value="Skin Cancer">Skin Cancer
                            </option>
                            <option <?php if (isset($data["value"]) && $data["value"] == "Lung Cancer") {
                                echo "selected";
                            } ?> value="Lung Cancer">Lung Cancer
                            </option>
                            <option <?php if (isset($data["value"]) && $data["value"] == "Brain Cancer") {
                                echo "selected";
                            } ?> value="Brain Cancer">Brain Cancer
                            </option>
                            <option <?php if (isset($data["value"]) && $data["value"] == "Breast Cancer") {
                                echo "selected";
                            } ?> value="Breast Cancer">Breast Cancer
                            </option>
                            <option <?php if (isset($data["value"]) && $data["value"] == "Ovarian Cancer") {
                                echo "selected";
                            } ?> value="Ovarian Cancer">Ovarian Cancer
                            <option <?php if (isset($data["value"]) && $data["value"] == "Kidney Cancer") {
                                echo "selected";
                            } ?> value="Kidney Cancer">Kidney Cancer
                            <option <?php if (isset($data["value"]) && $data["value"] == "Thyroid Cancer") {
                                echo "selected";
                            } ?> value="Thyroid Cancer">Thyroid Cancer
                            <option <?php if (isset($data["value"]) && $data["value"] == "Leukemia") {
                                echo "selected";
                            } ?> value="Leukemia">Leukemia
                            </option>
                            <option <?php if (isset($data["value"]) && $data["value"] == "Uterine") {
                                echo "selected";
                            } ?> value="Uterine">Uterine
                            </option>
                            <option <?php if (isset($data["value"]) && $data["value"] == "Liver Cancer") {
                                echo "selected";
                            } ?> value="Liver Cancer">Liver Cancer
                            </option>
                        </select>
                    </div>


                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12" style="text-align: center">
                        <label for="email">Action</label>
                        <?php
                        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
                            ?>
                            <div class="uk-width-medium-1-1" style="text-align: center">
                                <input class="btn btn-info" type="submit" name="submit" value="UPDATE">
                            </div>

                            <?php
                        } else {
                            ?>
                            <div class="uk-width-medium-1-1" style="text-align: center">
                                <input class="btn btn-info" type="submit" name="submit" value="ADD">
                            </div>

                            <?php
                        }
                        ?>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Disease Data</h5>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                <tr>
                    <th>Cancer</th>
                    <th>Smoking</th>
                    <th>Alcohol</th>
                    <th>Chewing</th>
                    <th>Hot Beverages</th>
                    <th>Passive Smoking</th>
                    <th>Diet</th>
                    <th>ff add.</th>
                    <th>family HOC</th>
                    <th>Relation WCP</th>
                    <th>W. Loss</th>
                    <th>Anemia</th>
                    <th>Diagonsed WCE</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($a_disease_risk_list["data"] as $key => $value) {
                    echo '<tr>

                                <td>' . $value['value'] . ' </td>
                                <td>' . $value['smoking'] . '</td>
                                <td>' . $value['alcohol'] . '</td>
                                <td>' . $value['chewing'] . '</td>
                                <td>' . $value['hot_beverages'] . '</td>
                                <td>' . $value['passive_smoking'] . '</td>
                                <td>' . $value['diet'] . '</td>
                                <td>' . $value['ff_addication'] . '</td>
                                <td>' . $value['family_history_of_cancer'] . '</td>
                                <td>' . $value['relation_with_cancer_patient'] . '</td>
                                <td>' . $value['weight_loss'] . '</td>
                                <td>' . $value['anemia'] . '</td>
                                <td>' . $value['cancer_earlier'] . '</td>
                                <td>
                                    <a href="view_disease_risk_factor.php?id=' . $value["id"] . '" class="on-default remove-row"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                    <a href="disease_risk_factor.php?id=' . $value["id"] . '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="confirm_delete(\'' . $value["id"] . '\');"  class="on-default remove-row"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>';

                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirm_delete(id) {
        var con = confirm('Are you sure Want To Delete This Data?');
        if (con) {
            window.location.href = "disease_risk_factor.php?id=" + id + "&action=delete";
        } else {
            return false;
        }
    }

</script>