const byte interruptPin = 2;
volatile byte state = LOW;
int AC_LOAD = 3;   
int dimming = 60; 
int ADC1 = 0;
int ADC2 = 0;
double LM351 = 0.0;
double LM352 = 0.0;

void setup() {
  Serial.begin(9600);
  pinMode(AC_LOAD, OUTPUT);
  pinMode(interruptPin, INPUT);
  attachInterrupt(digitalPinToInterrupt(interruptPin), blink, RISING);
}

void loop() {
  //digitalWrite(ledPin, state);
   ADC1 = analogRead(A0); 
   ADC2 = analogRead(A1);
   LM351 = ((double)ADC1/1023)*5;
   LM352 = ((double)ADC2/1023)*5;

   Serial.println(LM351,4); //Imprime la variable double con 4 decimales
   Serial.println(LM352,4); //Imprime la variable double con 4 decimales

   dimming = dimming + 1;
  if (dimming>=60){
    dimming=0;
  }
  delay(50);
}

void blink() {
  int dimtime = (113*dimming);      
  delayMicroseconds(dimtime);    
  digitalWrite(AC_LOAD, HIGH);   
  delayMicroseconds(10);         
  digitalWrite(AC_LOAD, LOW); 

}
