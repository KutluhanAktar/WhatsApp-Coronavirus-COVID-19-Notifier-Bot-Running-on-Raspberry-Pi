<?php

// Include the coronabot class:
include_once "class.php";
// Define the coronabot object:
$corona_bot = new coronabot();
// Connect to the database:
$corona_bot->connect_to_database("localhost", "root", "bot", "coronabot");
// Create the variables table with the default settings in the coronabot database to save information (unless created already):
$corona_bot->create_database_table("variables");
// If the user changed the bot settings using the bot interface, save new settings to the database table (variables):
if(isset($_POST["submit"])){
	$corona_bot->save_new_bot_settings("variables", $_POST["sid"], $_POST["token"], $_POST["to_number"], $_POST["from_number"], $_POST["country"]);
}
// Get the previous data in the database table, including the Twilio settings:
$previous_data = $corona_bot->get_previous_data("variables");

?>

<!DOCTYPE html>
<html>
<head>
 <title>WhatsApp Coronavirus Notifier Bot</title>
 
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="theme-color" content="#ff5c33">
 <meta name="apple-mobile-web-app-status-bar-style" content="#ff5c33">

 <!--link to favicon-->
 <link rel="icon" type="image/png" sizes="36x36" href="icon.png">
 <link rel="icon" type="image/png" sizes="48x48" href="icon.png">
 <link rel="icon" type="image/png" sizes="78x78" href="icon.png">

  <!-- link to font -->
 <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400&display=swap" rel="stylesheet">
 
 <!--link to index.css-->
 <link rel="stylesheet" type="text/css" href="index.css">
 
</head>
 <body>
<div id="controller">
<h2>WhatsApp Coronavirus Notifier Bot</h2>
<form action="" method="POST">
<label>Twilio App SID: </label><br><input type="text" name="sid" value="<?php echo $previous_data["sid"]; ?>" /><br><br>
<label>Twilio App AUTH_TOKEN: </label><br><input type="text" name="token" value="<?php echo $previous_data["token"]; ?>" /><br><br>
<label>Twilio App To_Phone_Number: </label><br><input type="text" name="to_number" value="<?php echo $previous_data["to_number"]; ?>" /><br><br>
<label>Twilio App From_Phone_Number: </label><br><input type="text" name="from_number" value="<?php echo $previous_data["from_number"]; ?>" /><br><br>
<label>Country (<?php echo $previous_data["country"]; ?>): </label><br>
<select name="country">
   <optgroup label="Accessible">
   <option value="Afghanistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua and Barbuda">Antigua and Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
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
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
   <option value="Brazil">Brazil</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cabo Verde">Cabo Verde</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo (Brazzaville)">Congo (Brazzaville)</option>
   <option value="Congo (Kinshasa)">Congo (Kinshasa)</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote d'Ivoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czechia">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Eswatini">Eswatini</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Honduras">Honduras</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="India">India</option>
   <option value="Indonesia">Indonesia</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Korea, South">Korea, South</option>
   <option value="Kosovo">Kosovo</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mexico">Mexico</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montenegro">Montenegro</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Namibia">Namibia</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherlands">Netherlands</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="North Macedonia">North Macedonia</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Qatar">Qatar</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="Saint Lucia">Saint Lucia</option>
   <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
   <option value="San Marino">San Marino</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Serbia">Serbia</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Syria">Syria</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Taiwan*">Taiwan*</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Trinidad and Tobago">Trinidad and Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Uganda">Uganda</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Emirates">United Arab Emirates</option>
   <option value="United Kingdom">United Kingdom</option>
   <option value="US">United States of America</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Yemen">Yemen</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
   </optgroup>
</select><br><br>
<button type="submit" name="submit" value="ok">Submit</button>

</form>
</div>

 </body>
 </html>