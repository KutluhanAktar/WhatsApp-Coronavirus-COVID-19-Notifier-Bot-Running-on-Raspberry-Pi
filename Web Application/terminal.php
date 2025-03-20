<?php
// Include the coronabot class and the Twilio's API autoload page.
include_once "class.php";
include_once "WhatsAppAPI/Twilio/autoload.php";
// Define the coronabot object the database (MariaDB) settings:
$corona_bot = new coronabot();
$corona_bot->connect_to_database("localhost", "root", "bot", "coronabot");
// Get the required variables from the database table (variables):
$previous_data = $corona_bot->get_previous_data("variables");
// Initiate the Twilio's API for WhatsApp:
use Twilio\Rest\Client;
// Define the path to gather information from the API created by Rodrigo Pombo (pomber).
$data_url = "https://pomber.github.io/covid19/timeseries.json";
// Using the file_get_contents() function, fetch the raw data from the API.
$raw_data = file_get_contents($data_url);
// Decode the raw data in JSON by using the json_decode() function.
$data = json_decode($raw_data);
// Get the last (recently updated) element in the selected country in the decoded data object.
$country = $previous_data["country"];
$current_entry = end($data->$country);
// Save the information in the current_entry object to the current_data array to call them easily.
$current_data = array(
    "date" => $current_entry->date,
	"confirmed" => $current_entry->confirmed,
	"deaths" => $current_entry->deaths,
	"recovered" => $current_entry->recovered
);
// Detect the data status:
$STATUS = "STABLE";
$header = "🔔🔔🔔🔔🔔🔔🔔🔔🔔";
if($current_data["date"] != $previous_data["date"] || $current_data["confirmed"] != $previous_data["confirmed"] || $current_data["recovered"] != $previous_data["recovered"]){
	$STATUS = "CHANGED";
	$header = "⚠⚠⚠⚠⚠⚠⚠⚠⚠";
}
// Save the current data to the database table (variables):
$corona_bot->save_new_report_data("variables", $current_data["date"], $current_data["confirmed"], $current_data["recovered"]);
// According to the data status (STABLE or CHANGED), send a notification message or a information message via WhatsApp.
echo "Working...<br><br>Test: ".$country." / ".$current_data["confirmed"]." / ".$STATUS; // TEST THE SERVER
// Create a new client to send text messages over WhatsApp. Get the Twilio application settings from the database table, entered in the bot interface.
$twilio = new Client($previous_data["sid"], $previous_data["token"]);
// Note: Enter phone numbers without adding '+'.
$message = $twilio->messages 
             ->create("whatsapp:+".$previous_data["to_number"], 
                 array( 
                       "from" => "whatsapp:+".$previous_data["from_number"],       
                       "body" => "$header\n\n🌍 $country\n\n📊 Status: $STATUS\n\n⌛ Date: ".$current_data["date"]."\n\n📌 Confirmed: ".$current_data["confirmed"]."\n\n📌 Deaths: ".$current_data["deaths"]."\n\n📌 Recovered: ".$current_data["recovered"]."\n\n$header"
                      ) 
                 );
echo '<br><br>Message Send...';	

?>