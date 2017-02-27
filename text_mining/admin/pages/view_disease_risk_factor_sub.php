<?php
//$ob_category_utility = new dieaseUtility();


$ob_disease_risk_utility = new dieseaseRiskUtility();

/*Get All admin Detasils for display table*/
$a_disease_risk_list = $ob_disease_risk_utility->getdieseaseRiskData();
$data = $ob_disease_risk_utility->getdieseaseRiskDataByID($_REQUEST['id']);
$data = $data["data"][0];
?>

<div class="row">
    <!--Main Title Div Start -->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

        <h5 class="form_title">Add Disease Data  <a style="float: right" href="disease_risk_factor.php">Back</a></h5>
    </div>
    <!--Main Title Div End-->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="form_border">
            <div class="row">

                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="lbl-color" style="color: red">Cancer :  <?php echo $data["value"] ?></label>
                </div>
                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Smoking : <?php echo $data["smoking"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Alcohol : <?php echo $data["alcohol"] ?></label>

                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Chewing : <?php echo $data["chewing"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Hot Beverages : <?php echo $data["hot_beverages"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Passive Smoking : <?php echo $data["passive_smoking"] ?></label>

                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Diet : <?php echo $data["diet"] ?></label>

                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Fast Food Addication : <?php echo $data["ff_addication"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Family History Of Cancer : <?php echo $data["family_history_of_cancer"] ?></label>
                    </div>

                    <div id="cancer_patient_div" class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Relation With Cancer Patient : <?php echo $data["relation_with_cancer_patient"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Weight Loss : <?php echo $data["weight_loss"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Anemia : <?php echo $data["anemia"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Are You Diagnosed With Cancer Earlier : <?php echo $data["cancer_earlier"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Breathlessness : <?php echo $data["breathlessness"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unexplained vaginal bleeding : <?php echo $data["vaginal_bleeding"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Persistent heartburn or indigestion : <?php echo $data["persistent_heartburn_indigestion"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Croaky voice or hoarseness : <?php echo $data["croaky_voice_hoarseness"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Looser poo or pooing more often : <?php echo $data["looser_poo_pooing"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Persistent bloating : <?php echo $data["persistent_bloating"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Difficulty swallowing : <?php echo $data["difficulty_swallowing"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Sore that won’t heal : <?php echo $data["sore_heal"] ?></label>
                    </div>


                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Mouth or tongue ulcer : <?php echo $data["mounth_tongue_ulcer"] ?> </label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Heavy night sweats : <?php echo $data["night_sweats"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unusual breast changes : <?php echo $data["breast_changes"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Blood in your poo : <?php echo $data["poo_blood"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Blood in your pee : <?php echo $data["pee_blood"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">New mole or changes to a mole : <?php echo $data["mole"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Coughing up blood : <?php echo $data["coughing_up_blood"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Persistent cough : <?php echo $data["persistent_cough"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Problems peeing : <?php echo $data["problem_peeing"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unexplained pain or ache  : <?php echo $data["pain_ache"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Unusual lump or swelling anywhere  : <?php echo $data["lump_swelling"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Changes in Your Testicles  : <?php echo $data["testicles"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Changes in Lymph Nodes : <?php echo $data["lymph_nodes"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Belly Pain and Depression : <?php echo $data["belly_pain_and_depression"] ?></label>

                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">pelvic pain : <?php echo $data["pelvic_pain"] ?></label>
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                        <label class="lbl-color">Fever : <?php echo $data["fever"] ?></label>
                    </div>





            </div>
        </div>
    </div>

</div>
