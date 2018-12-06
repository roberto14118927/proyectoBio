const SerialPort = require('serialport');
const parsers = SerialPort.parsers;
var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var os = require('os');
var mysql = require('mysql');

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


var connection = mysql.createConnection({
  host: 'localhost',
  user: 'me',
  password: 'secret',
  database: 'my_db'
});

connection.connect();

server.listen(5678);

io.on('connection', function (socket) {

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

  socket.on('send-on', function (data) {
    port.write('P\n');
  });

  socket.on('send-off', function (data) {
    port.write('A\n');
  });

});

io.on('error', function (err) {
  console.error(err)
});


function ReadSerialData(data) {
  io.emit('sensor', {
    data: data,
  });
  var post = {
    id: 1,
    title: 'Hello MySQL'
  };
  var query = connection.query('INSERT INTO posts SET ?', post, function (error, results, fields) {
    if (error) throw error;
    // Neat!
  });
  console.log(query.sql);
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