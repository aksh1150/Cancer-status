<?php
$obj_common_utility = new commonUtility();


if (isset($_POST["risk_score"]) && $_POST["risk_score"]) {
    $result = $obj_common_utility->addUserDieaseData($_SESSION['text_mining_current_login_user']);
    if ($result["status"] == 1) {
        //echo "<script>alert('your data has been add successfully');</script>";
        echo "<script>location.href='user-report.php?id=" . $result["last_id"] . "'</script>";
    }
}
$a_diease_list = $obj_common_utility->getDieaseAndSymptomasData();
?>

<div class="container" style="background-color: rgb(212, 234, 254);">
    <hr style="border: 1px solid grey">
    <div class="row">
        <div class="col-md-12">
            <p class="cancer-page">Check Cancer Status</p>
        </div>
    </div>
    <hr style="border: 1px solid grey">

    <form method="post">
        <!--Basic Question Start-->
        <div class="row">
            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Name</label>
                <input class="form-control" name="name" type="text"/>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Age</label>
                <input class="form-control" name="age" type="text"/>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Gender</label>
                <select class="form-control" name="gender">
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Marital Status</label>
                <select class="form-control" name="marital_status">
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">No Of Children</label>
                <select class="form-control" name="no_of_childern">
                    <option value="None">None</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3-5">3-5</option>
                    <option value="5-10">5-10</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Living Area</label>
                <select class="form-control" name="living_area">

                    <option value="">Country...</option>
                    <option value="Afganistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire">Bonaire</option>
                    <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Canary Islands">Canary Islands</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Channel Islands">Channel Islands</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos Island">Cocos Island</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote DIvoire">Cote D'Ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curaco">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor">East Timor</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Ter">French Southern Ter</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Great Britain">Great Britain</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea North">Korea North</option>
                    <option value="Korea Sout">Korea South</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Midway Islands">Midway Islands</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Nambia">Nambia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherland Antilles">Netherland Antilles</option>
                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                    <option value="Nevis">Nevis</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau Island">Palau Island</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Phillipines">Philippines</option>
                    <option value="Pitcairn Island">Pitcairn Island</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                    <option value="Republic of Serbia">Republic of Serbia</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="St Barthelemy">St Barthelemy</option>
                    <option value="St Eustatius">St Eustatius</option>
                    <option value="St Helena">St Helena</option>
                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                    <option value="St Lucia">St Lucia</option>
                    <option value="St Maarten">St Maarten</option>
                    <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                    <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                    <option value="Saipan">Saipan</option>
                    <option value="Samoa">Samoa</option>
                    <option value="Samoa American">Samoa American</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Tahiti">Tahiti</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Erimates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States of America">United States of America</option>
                    <option value="Uraguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City State">Vatican City State</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                    <option value="Wake Island">Wake Island</option>
                    <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zaire">Zaire</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Education</label>
                <select class="form-control" name="education">
                    <option value="Educated">Educated</option>
                    <option value="Uneducated">Uneducated</option>
                    <option value="College">College</option>
                    <option value="Professional">Professional</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Occupational Hazards</label>
                <select class="form-control" name="occupational_hazards">
                    <option value="Radiation Exposure">Radiation Exposure</option>
                    <option value="Chemical Exposure">Chemical Exposure</option>
                    <option value="Sunlight Exposure">Sunlight Exposure</option>
                    <option value="Thermal Exposure">Thermal Exposure</option>
                    <option value="None">None</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Smoking</label>
                <select class="form-control" name="smoking">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Alcohol</label>
                <select class="form-control" name="alcohol">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Chewing</label>
                <select class="form-control" name="chewing">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Hot Beverages</label>
                <select class="form-control" name="hot_beverages">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Passive Smoking</label>
                <select class="form-control" name="passive_smoking">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Diet</label>
                <select class="form-control" name="diet">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Fast Food Addication</label>
                <select class="form-control" name="ff_addication">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Family History Of Cancer</label>
                <select id="family_history_cancer" class="form-control" onclick="display_cancer_patient_div()"
                        name="family_history_of_cancer">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div id="cancer_patient_div" class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Relation With Cancer Patient</label>
                <select class="form-control" name="relation_with_cancer_patient">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Weight LOss</label>
                <select class="form-control" name="weight_loss">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Anemia</label>
                <select class="form-control" name="anemia">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Are You Diagnosed With Cancer Earlier</label>
                <select class="form-control" name="cancer_earlier">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Breathlessness</label>
                <select class="form-control" name="breathlessness">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Unexplained vaginal bleeding </label>
                <select class="form-control" name="vaginal_bleeding">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Persistent heartburn or indigestion</label>
                <select class="form-control" name="persistent_heartburn_indigestion">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Croaky voice or hoarseness </label>
                <select class="form-control" name="croaky_voice_hoarseness">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Looser poo or pooing more often</label>
                <select class="form-control" name="looser_poo_pooing">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Persistent bloating</label>
                <select class="form-control" name="persistent_bloating">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Difficulty swallowing </label>
                <select class="form-control" name="difficulty_swallowing">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Sore that won’t heal </label>
                <select class="form-control" name="sore_heal">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>


            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Mouth or tongue ulcer </label>
                <select class="form-control" name="mounth_tongue_ulcer">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Heavy night sweats    </label>
                <select class="form-control" name="night_sweats">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Unusual breast changes  </label>
                <select class="form-control" name="breast_changes">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Blood in your poo  </label>
                <select class="form-control" name="poo_blood">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Blood in your pee </label>
                <select class="form-control" name="pee_blood">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">New mole or changes to a mole</label>
                <select class="form-control" name="mole">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Coughing up blood</label>
                <select class="form-control" name="coughing_up_blood">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Persistent cough</label>
                <select class="form-control" name="persistent_cough">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Problems peeing</label>
                <select class="form-control" name="problem_peeing">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Unexplained pain or ache</label>
                <select class="form-control" name="pain_ache">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Unusual lump or swelling anywhere</label>
                <select class="form-control" name="lump_swelling">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Changes in Your Testicles</label>
                <select class="form-control" name="testicles">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Changes in Lymph Nodes</label>
                <select class="form-control" name="lymph_nodes">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Belly Pain and Depression</label>
                <select class="form-control" name="belly_pain_and_depression">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">pelvic pain</label>
                <select class="form-control" name="pelvic_pain">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group">
                <label class="lbl-color">Fever </label>
                <select class="form-control" name="fever">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-4 col-sm-12 form-group hidden">
                <label class="lbl-color">Action</label><br>
                <button class="btn btn-info" onclick="dsiplay_disease_and_syptomas_div();" type="button">SUBMIT</button>
            </div>

            <div id="diease_and_symptomas_div" style="display: none">
            <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                <label class="lbl-color">Choose Organ Of The Symptomas</label>
                <select id="user_diease"  onchange="display_syptomas();" class="form-control" name="diease_id">

                    <option value="0">SELECT DIEASE</option>
                    <?php
                    $arr = array();
                    $temp_array = array();
                    foreach ($a_diease_list["data"] AS $key => $value) {
                        echo '<option value="' . $value["diease_id"] . '">' . $value["diease_name"] . '</option>';
                        $temp_array[$value["diease_id"]] = $value;
                    }
                    $arr = $temp_array;
                    ?>
                    <script>
                        var disease_symptomas_data = <?php echo json_encode($arr); ?>;
                    </script>
                </select>
            </div>

            <div class="col-xs-12 col-md-12 col-sm-12 form-group" id="symptomas_div"
                 style="padding: 10px;background-color: white;color: black">

            </div>
            </div>

        </div>

        <hr style="border: 1px solid grey">
        <div class="row">
            <div class="col-xs-12 col-md-2 col-sm-12 form-group">
            </div>
            <div class="col-xs-12 col-md-2 col-sm-12 form-group">
                <button type="submit" class="btn btn-info btnn-width" value="risk_score" name="risk_score">Risk Score
                </button>
            </div>
            <div class="col-xs-12 col-md-2 col-sm-12 form-group">
                <button type="reset" name="" class="btn btn-info btnn-width">Reset</button>
            </div>
            <div class="col-xs-12 col-md-2 col-sm-12 form-group">
                <button disabled type="button" name="" class="btn btn-info btnn-width">Cluster</button>
            </div>
            <div class="col-xs-12 col-md-2 col-sm-12 form-group">
                <button disabled type="button" name="" class="btn btn-info btnn-width">Decision Tree</button>
            </div>

        </div>
    </form>
</div>

<script>
    function display_cancer_patient_div() {
        var temp = $('#family_history_cancer').val();
        if (temp == 'Yes') {
            $('#cancer_patient_div').css("display", "inline");
        } else {
            $('#cancer_patient_div').css("display", "none");
        }
    }

    function display_syptomas() {
        var diease_id = $('#user_diease').val();
        if(diease_id != 0) {
            var data = disease_symptomas_data[diease_id];
            console.log(JSON.stringify(data));
            var UI = '';
            $.each(data["symptomas"], function (index, value) {
                UI += '<input type="checkbox" name="diease_symptomas[]" value="' + value["ds_id"] + '">' + value["ds_text"] + '<br>';
            });
        }else{
            var UI = '';
        }
        $('#symptomas_div').html(UI);
    }

    function dsiplay_disease_and_syptomas_div() {
        $('#diease_and_symptomas_div').css("display","block");
    }

</script>