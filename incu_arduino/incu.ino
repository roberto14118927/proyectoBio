const byte ledPin = 13;
const byte interruptPin = 2;
volatile byte state = LOW;
int AC_LOAD = 3;   
int dimming = 60; 

void setup() {
  Serial.begin(9600);
  pinMode(AC_LOAD, OUTPUT);
  pinMode(interruptPin, INPUT);
  attachInterrupt(digitalPinToInterrupt(interruptPin), blink, RISING);
}

void loop() {
  //digitalWrite(ledPin, state);
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
