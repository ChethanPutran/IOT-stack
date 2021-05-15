#include <WiFi.h>
const char hostAdd[] = "";
char ssid[]= "TP-Link_0A48";
char password[] = "Homewifi222";
int count = 0;

void setup() {
  Serial.begin(9600);
  delay(100);

  pinMode(D1, OUTPUT);
  pinMode(D2, OUTPUT);
  pinMode(D3, OUTPUT);

  digitalWrite(D1, 0);
  digitalWrite(D2, 0);
  digitalWrite(D3, 0);


  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("WIFI Connected!");
  Serial.print("IP Address : ");
  Serial.println(WiFi.localIP());
  Serial.print("Gateway :");
  Serial.println(WiFi.gatewayIP());
}


void loop() {

    String url = "";

    
    WiFiClient client;

    const int port = 80;

    if(!client.connect(hostAdd,port)){
      Serial.println("Connection Failed!");
      return NULL;
      }

    if(count==0){
      url = "appliances/light/control.php?id=1";
      count = count + 1;
      Serial.println("Checking light1...");

    
    }else if(count ==1){
        url = "appliances/light/control.php?id=2";
      count = count + 1;
      Serial.println("Checking light2...");
    }
    else if(count ==2){
        url = "appliances/light/control.php?id=3";
      count = count + 1;
      Serial.println("Checking light3...");
    }

    Serial.print("Requesting URL :");
    Serial.println(hostAdd+url);

    client.print(String("GET ")+url+"HTTP/1.1\r\n"+"Host: "+hostAdd+"\r\n"+"Connection: close\r\n");

    delay(500);

    String section = "header";
  
    while(client.available()){

        String line = client.readStringUntil('\r');
        Serial.println(line);

        //Parsing the HTML body

        if(section == "header"){
            if(line=="\n"){
                section = "json";
            }
        }
        else if(section == "json"){
            section = "ignore";
            String result = line.substring(1);


            //Parsing JSON data
            int size = result.length() + 1;
            char json[size];

            result.toCharArray(json, size);
            StaticJsonBuffer<200> jsonBuffer;
            JsonObject& jsonParsed = jsonBuffer.parseObject(json);

            if(!jsonParsed.success()){
                Serial.println("parseObject failed!");
                return NULL;
            }

            String staus = jsonParsed["led"][0]["status"];

            if (count == 1)
            {
                if (status = "on")
                {
                    digitalWrite(D1, 1);
                    delay(100);
                    Serial.println("LED1 is On...!");
                }
                else if (status == "off")
                {
                    digitalWrite(D1, 0);
                    delay(100);
                    Serial.println("LED1 is Off...!");
                }
            }
            else if(count == 2){
                if(status = "on"){
                digitalWrite(D2, 1);
                delay(100);
                Serial.println("LED2 is On...!");
                }else if(status == "off"){
                    digitalWrite(D2, 0);
                    delay(100);
                    Serial.println("LED2 is Off...!");
                }
            }
            else if(count == 3){
                if(status = "on"){
                digitalWrite(D3, 1);
                delay(100);
                Serial.println("LED3 is On...!");
                }else if(status == "off"){
                    digitalWrite(D3, 0);
                    delay(100);
                    Serial.println("LED3 is Off...!");
                }
            }
        }
    }    
      
  

}
