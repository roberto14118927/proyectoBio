var Router = require('router')
var finalhandler = require('finalhandler')
var http         = require('http')
var request = require("request");
 
var router = Router()
function ReadSerialData(data){
  	console.log(data);

  	request({
  uri: "/views/index.php",
  method: "GET",
  form: {
    name: "Bob"
  }
}, function(error, response, body) {
  console.log(body);
});

}


const express = require('express');
const app = express();
const SerialPort = require('serialport');
const parsers = SerialPort.parsers;

//server = app.listen(3000)
	router.get('/views/index', function(req,res) {
		console.log("ok")
	   var dataToSendObj = {'title': 'Your Website Title', 'message': 'Hello'};
	   res.render('index',dataToSendObj);
	});
//const io = require('socket.io')(server)

// Use a `\r\n` as a line terminator
const parser = new parsers.Readline({
  delimiter: '\r\n'
});

const port = new SerialPort('COM3', {
  baudRate: 9600
});

port.pipe(parser);

port.on('open', () => console.log('Port open'));

parser.on('data', ReadSerialData);



//port.write('ROBOT PLEASE RESPOND\n');