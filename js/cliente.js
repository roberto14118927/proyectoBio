var URL = 'http://172.16.56.117:5678';

var socket = io.connect(URL, {'forceNew': true});

socket.on('sensor', function(data){
    imprimeTemperatura(data.data);
});

function send(){
    var sendData = {
      'imei': '1'
    };
    socket.emit('send-data', sendData);
  }