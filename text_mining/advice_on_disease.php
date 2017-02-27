<div style="height: 300px;overflow-x: auto">
    <table class="table">
        <?php
        if ($data["smoking"] == "Yes") {
            echo '<tr><td>Quitting smoking is one of the most important things you can do to reduce your risk of cancer. Tobacco smoke contains more than 7000 chemicals, including over 70 carcinogens (chemicals known to cause cancer).
<br>
There are immediate health benefits as soon as you quit smoking, even if you already suffer health problems.</td></tr>';
        }

        if ($data["hot_beverages"] == "Yes") {
            echo '<tr><td>You can lower your risk of cancer by enjoying a healthy diet, being physically active every day and maintaining a healthy body weight. Studies show being overweight, physically inactive and not eating well cause nearly one third of all cancers.
Eat a variety of raw and cooked vegetables, fruit and legumes (eg. dried beans, lentils).
Eat plenty of cereals (including breads, rice, pasta and noodles), preferably wholegrain.
Eat red meat no more than three to four times a week. On the other days choose fish, poultry, dried or canned beans or lentils.
Choose foods low in salt.<br>
Don’t eat too much fat, especially saturated fat. Be aware of hidden fats in snack foods, cakes and takeaway foods.
Choose low fat yoghurt, cheese and milk.</td></tr>';
        }

        if ($data["weight_loss"] == "Yes") {
            echo '<tr><td>

Looking to bulk up? You can now add muscle and put on some weight easily with the help of these 10 simple tips.
<br>
1.  Eat 5 to 6 meals a day
<br>
In order to gain weight, you need to start eating 5-6 meals a day. However, it is important that you break these meals into parts, as eating a lot at once may result in indigestion and your body may not be able to absorb all the nutrients. It may be possible that you won’t find yourself hungry 3 hours after eating lunch, but eat anyway and notice how your appetite increases from day to day. Also, be sure to include healthy foods  in your diet for a healthy weight gain.
<br>
2.  Weight train at least 3 times a week
<br>
When you train with weights, your muscles grow. Also, it is important that you gradually keep increasing the weight with which you train. As you train, your strength will increase. For instance, if you are doing lateral pulldowns with 30 kilos of weight, try and increase it to 35 kilos the next time. Read more to find out how you can do weight training at home. Also read about strength training exercises for women.
<br>
3.  Consume 300-500 calories more
<br>
Eating 300-500 calories more than your normal intake may not be easy, but you must do it if you want to stop being skinny. Make sure you don’t do it just by overeating at once, but instead do it gradually over the whole day.
<br>
4.  Work out your entire body
<br>
There are some muscles you can clearly see and admire in the mirror and some muscles you cannot. A lot of gym goers usually train only the muscles on their arms, chest and shoulders and this is a grave error. Firstly, it will give you a disproportionate body that not many people like. Also, it will make you prone to injuries. Therefore, make sure you workout for entire body for a complete look. Here are some yoga poses for weight gain.
<br>
5.  Load up on protein
<br>
As informed earlier, you have to consume 300-500 more calories than your normal intake every day. You can do this by eating protein-rich foods like cheese, meat, eggs, etc. </td></tr>';
        }

        if ($data["alcohol"] == "Yes") {
            echo '<tr><td>Alcohol and cancer risk
The type of alcohol you drink doesn’t make any difference. Beer, wine and spirits all increase your risk of cancer. Even at low intake, alcohol contains a lot of energy (kilojoules or calories) so it can easily contribute to weight gain. Being overweight or obese also increases your cancer risk.
<br>
limit your intake – National Health and Medical Research Council recommends no more than two standard drinks a day.
avoid binge drinking. Do not “save” your drinks using alcohol-free days, only to consume them in one session.
have at least two alcohol-free days every week.
choose low alcohol drinks.
eat some food when you drink.</td></tr>';
        }


        if ($data["pain_ache"] == "Yes" || $data["belly_pain_and_depression"] == "Yes") {
            echo '<tr><td>If you\'re experiencing a bloated belly, pelvic pain, and an urgent need to urinate, see your doctor.</td></tr>';
        }

        /*if ($data == 'Skin cancer') {
            echo '<tr><td>Ultraviolet (UV) radiation from the sun is our main source of Vitamin D, but it is also the major cause of skin cancer. Skin can burn in just 15 minutes in the summer sun.
        <br>
        1. Slip on sun protective clothing
        Choose clothing that:
        <br>
        covers as much skin as possible eg. shirts with long sleeves and high necks/collars
        is made from close weave materials such as cotton, polyester/cotton and linen
        if used for swimming, is made from materials such as lycra, which stays sun protective when wet
        2. Slop on SPF 30+ sunscreen
        Make sure your sunscreen is broad spectrum and water-resistant. Don’t use sunscreen to increase the amount of time you spend in the sun and always use with other forms of protection too. Apply sunscreen liberally to clean, dry skin at least 20 minutes before you go outside and reapply every two hours.
        <br>
        3. Slap on a hat
        A broad-brimmed, legionnaire or bucket style hat provides good protection for the face, nose, neck and ears, which are common sites for skin cancers. Caps and visors do not provide enough protection. Choose a hat made with closely woven fabric – if you can see through it, UV radiation will get through. Hats may not protect you from reflected UV radiation, so also wear sunglasses and sunscreen.
        <br>
        4. Seek shade
        Staying in the shade is an effective way to reduce sun exposure. Use trees or built shade structures, or bring your own! Whatever you use for shade, make sure it casts a dark shadow and use other protection (such as clothing, hats, sunglasses and sunscreen) to avoid reflected UV radiation from nearby surfaces.
        <br>
        5. Slide on some sunglasses
        Sunglasses and a broad-brimmed hat worn together can reduce UV radiation exposure to the eyes by up to 98 per cent. Sunglasses should be worn outside during daylight hours. Choose close-fitting wrap-around sunglasses that meet the Australian Standard AS 1067. Sunglasses are as important for children as they are for adults.</td></tr>';
        }*/

        if ($data["breast_changes"] == "Yes") {
            echo '<tr><td>Have a Pap smear every two years from the age of 18, or within one to two years of becoming sexually active. Pap smears can detect early changes in the cells of the cervix, so that they can be treated before cancer develops. Up to 90 per cent of cervical cancers can be prevented through regular Pap smears.</td></tr>';
        }

        /*if ($data == 'Carvical cancer') {
            echo '<tr><td>Practice safe sex. Limit your number of sexual partners, and use a condom when you have sex. The more sexual partners you have in your lifetime, the more likely you are to contract a sexually transmitted infection — such as HIV or HPV. People who have HIV or AIDS have a higher risk of cancer of the anus, liver and lung. HPV is most often associated with cervical cancer, but it might also increase the risk of cancer of the anus, penis, throat, vulva and vagina.
        Don\'t share needles. Sharing needles with an infected drug user can lead to HIV, as well as hepatitis B and hepatitis C — which can increase the risk of liver cancer. If you\'re concerned about drug abuse or addiction, seek professional help.</td></tr>';
        }


        if ($data == 'Sugary drinks') {
            echo '<tr><td>Not only do sugary drinks contribute to obesity and diabetes, they may also increase your risk of endometrial cancer.</td></tr>';
        }

        if ($data == 'Marinate your meat') {
            echo '<tr><td>The high temperature required to grill meat (and broil and fry, for that matter) creates compounds called heterocyclic amines that are linked to cancer. These compounds may damage DNA enough to spur the growth of tumors in the colon, breast, prostate, and lymph cells.</td></tr>';
        }*/

        ?>
    </table>
</div>