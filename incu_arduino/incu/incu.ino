const byte interruptPin = 2;
volatile byte state = LOW;
int AC_LOAD = 3;   
int dimming = 60; 
int ADC1 = 0;
int ADC2 = 0;
double LM351 = 0.0;
double LM352 = 0.0;
double LM35T = 0.0;

void setup() {
  Serial.begin(9600);
  pinMode(AC_LOAD, OUTPUT);
  pinMode(interruptPin, INPUT);
  pinMode(LED_BUILTIN, OUTPUT);
  attachInterrupt(digitalPinToInterrupt(interruptPin), blink, RISING);
}

void loop() {
  ADC1 = 0;
  ADC2 = 0;
  for(int i=0; i<=10; i++){
    ADC1 += analogRead(A0); 
    ADC2 += analogRead(A1);
  }
  ADC1 = (ADC1/10);
  ADC2 = (ADC2/10);
  LM351 = ((double)ADC1/1023)*500;
  LM352 = ((double)ADC2/1023)*500;
  LM35T = ((LM351+LM352)/2);

  Serial.println(LM35T,1); //Imprime la variable double con 4 decimales

  if (Serial.available() > 0) {
        char d = Serial.read();
        if(d == 'P'){
          digitalWrite(LED_BUILTIN, HIGH);
        }
        if(d == 'A'){
          digitalWrite(LED_BUILTIN, LOW);
        }
  }
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
