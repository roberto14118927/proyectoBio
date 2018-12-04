var URL = 'http://172.16.56.117:5678';

var socket = io.connect(URL, {'forceNew': true});

socket.on('sensor', function(data){
    imprimeTemperatura(data.data);
});

function on(){
    var sendData = {
      'imei': '1'
    };
    socket.emit('send-on', sendData);
  }

  function off(){
    var sendData = {
      'imei': '1'
    };
    socket.emit('send-off', sendData);
  }