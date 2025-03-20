# WhatsApp Coronavirus Notifier Bot Running on Raspberry Pi
#
# Raspberry Pi 3 Model B+
#
# By Kutluhan Aktar
#
# Via WhatsApp, observe the daily coronavirus (COVID-19) case report of your country and get notified when there is a change.
# 
# For more information and explanation, visit the link below:
# https://www.theamplituhedron.com/projects/WhatsApp-Coronavirus-Notifier-Bot-Running-on-Raspberry-Pi/

from time import sleep
import requests

def activate_terminal(url):
    # Make an HTTP Post Request to the localhost.
    request = requests.get(url)
    # Print the response to check the localhost connection.
    print("\r\n" + request.text + "\r\n")

# Start the loop.
while True:
    activate_terminal("http://localhost/coronabot/terminal.php")
    sleep(15 * 60)