var fs = require('fs');

var options = {
    key: 'ASD12345',
    cert: 'ASDG12345',
    requestCert: false,
    rejectUnauthorized: false,
};

var express = require('express');
var app = express();
var server = require('http').Server(options, app);
var io = require('socket.io')(server);
io.set('origins', '*:*');

io.on('connection', function(socket) {
    console.log('akdl');
    socket.on('new-message', function(data) {
        io.sockets.emit('messages', data);
    });
});

server.listen(2083, function() {
    console.log("Servidor corriendo en http://localhost:8080");
});
