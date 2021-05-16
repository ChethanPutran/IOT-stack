
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "TP-Link_0A48";
const char* password = "Homewifi222";
const char hostAdd[] = "http://caarts.tech";
int count = 0;

void setup () {

  Serial.begin(115200);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  pinMode(D1, OUTPUT);
  pinMode(D2, OUTPUT);
  pinMode(D3, OUTPUT);

  digitalWrite(D1, 0);
  digitalWrite(D2, 0);
  digitalWrite(D3, 0);

}

void loop() {

  String url = "";
  if (count == 0) {
    url = "/appliances/lights/control.php?id=1";
    count = count + 1;
    Serial.println("Checking light1...");
  } else if (count == 1) {
    url = "/appliances/lights/control.php?id=2";
    count = count + 1;
    Serial.println("Checking light2...");
    delay(3000);
  }
  else if (count == 2) {
    url = "/appliances/lights/control.php?id=3";
    count = 0;
    Serial.println("Checking light3...");
    delay(3000);
  }

  Serial.print("Requesting URL :");
  Serial.println( String(hostAdd) + url);

  HTTPClient http; //Declare an object of class HTTPClient
  WiFiClient client1;

  String reqURL = String(hostAdd) + url;
  http.begin(client1, reqURL);

  int httpCode = http.GET(); //Send the request

  String payload = http.getString(); //Get the request response payload
  Serial.println("Response is"); //Print the response payload
  Serial.println(payload);
  delay(3000);

  StaticJsonBuffer<200> jsonBuffer;
  JsonObject& jsonParsed = jsonBuffer.parseObject(payload);

  if (!jsonParsed.success()) {
    Serial.println("parseObject failed!");
      Serial.println("Makesure that thr internet connection is stable!");
//     delay(30000);
    return;
  }

  String status = jsonParsed["status"];

  if (count == 1)
  {
    if (status == "on")
    {
      digitalWrite(D1, 1);
      delay(1000);
      Serial.println("LED1 is turned On...!");
//      delay(3000);
    }
    else if (status == "off")
    {
      digitalWrite(D1, 0);
      delay(100);
      Serial.println("LED1 is turned Off...!");
//      delay(3000);
    }
  }
  else if (count == 2) {
    if (status == "on") {
      digitalWrite(D2, 1);
      delay(100);
      Serial.println("LED2 is turned On...!");
    } else if (status == "off") {
      digitalWrite(D2, 0);
      delay(100);
      Serial.println("LED2 is turned Off...!");
//      delay(3000);
    }
  }
  else if (count == 0) {
    if (status == "on") {
      digitalWrite(D3, 1);
      delay(100);
      Serial.println("LED3 is turned On...!");
//            delay(30000);
    } else if (status == "off") {
      digitalWrite(D3, 0);
      delay(100);
 
      Serial.println("LED3 is turned Off...!");
//      delay(30000);
    }
  }
  

}
