#include <WiFi.h>
const char hostAdd[] = "";
char ssid[]= "TP-Link_0A48";
char password[] = "Homewifi222";

void setup() {
  Serial.begin(9600);
  delay(100);
  Serial.println();
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
//  float humidity = dht.readHumidity();
//  float temperature = dht.readTemperature();
 float temperature = 25;
 float humidity = 102;

  if(isnan(humidity) || isnan(temperature)){
    Serial.println("Faild to read data from the sensors!");
    return NULL;
    
    }

    Serial.print("Connecting to :");
    Serial.println(hostAdd);

    WiFiClient client;

    const int port = 80;

    if(!client.connect(hostAdd,port)){
      Serial.println("Connection Failed!");
      return NULL;
      }

   String path = "/store/data/insert.php?temp="+String(temperature)+"&hum="+String(humidity);

      Serial.print("Uploading data to :");
      Serial.println(hostAdd+path);

      client.print(String("GET ")+path+"HTTP/1.1\r\n"+"Host: "+hostAdd+"\r\n"+"Connection: close\r\n");

      delay(500);

      while(client.available()){
        String line = client.readStringUntil('\r');
        Serial.println(line);
        }

      Serial.println();
      Serial.println("Closing connection...");
      client.stop();
      delay(10000);  
      
  

}
