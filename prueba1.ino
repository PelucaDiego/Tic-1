/* How to use the DHT-22 sensor with Arduino uno
   Temperature and humidity sensor
*/

//Libraries
#include <DHTesp.h>

//Constants
DHTesp dht;
int smoke=4;
int a;
float b;

//Variables
int chk;
void setup()
{
  pinMode (smoke, INPUT);
  dht.setup(5, DHTesp::DHT11);
  Serial.begin(9600);
}
void loop()
{
  delay(1000);
  a=analogRead(A0);
  b= a * (5.0/1023.0);
  float d=(6*b);
  int sval = digitalRead(smoke);
  float h = dht.getHumidity();
  float t = dht.getTemperature();
  if (sval == HIGH){
    Serial.print("Warning!");
    }
  Serial.print(dht.getStatusString());
  Serial.print(" \tHumidity %: ");
  Serial.print(h, 1);
  Serial.print("\t\tTemperature (C): ");
  Serial.print(t, 1);
  Serial.print("Velocidad del aire:");
  Serial.println(d);
  delay(1000);
}
