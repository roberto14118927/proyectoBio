const SerialPort = require('serialport');
const parsers = SerialPort.parsers;
var Router = require('router')
var finalhandler = require('finalhandler')
var http = require('http')
var request = require("request");
var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var os = require('os');

var interfaces = os.networkInterfaces();
var addresses = [];
for (var k in interfaces) {
  for (var k2 in interfaces[k]) {
    var address = interfaces[k][k2];
    if (address.family === 'IPv4' && !address.internal) {
      addresses.push(address.address);
    }
  }
}

var router = Router()
var HOST = addresses[2];
var PORT = 3333;
server.listen(5678);

io.on('connection', function (socket) {
  //web_sockets.push(socket)

  socket.on('disconnect', function () {
    console.log('desconectado')
  });

  socket.on('end', function () {
    console.log('end')
  });

  socket.on('error', function () {
    console.log('error')
  });

  socket.on('timeout', function () {
    console.log('timeout')
  });

  socket.on('close', function () {
    console.log('close')
  });

  socket.on('send-on', function(data) {
    // console.log(data.imei);
    port.write('P\n');
  });

  socket.on('send-off', function(data) {
    // console.log(data.imei);
    port.write('A\n');
  });

});

io.on('error', function (err) {
  console.error(err)
});


function ReadSerialData(data) {
  console.log(data);
  io.emit('sensor', {
    data: data,
  });
}

const parser = new parsers.Readline({
  delimiter: '\r\n'
});

const port = new SerialPort('/dev/cu.usbmodem141401', {
  baudRate: 9600
});

port.pipe(parser);

port.on('open', () => console.log('Puerto Abierto'));

parser.on('data', ReadSerialData);



//port.write('ROBOT PLEASE RESPOND\n');