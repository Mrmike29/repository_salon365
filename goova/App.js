var fs = require('fs');

var options = {
    key: fs.readFileSync('/home/goova/ssl/keys/ef328_b0a77_20c9aad927ab53301ab3b03cb045e9c0.key'),
    cert: fs.readFileSync('/home/goova/ssl/certs/goova_co_ef328_b0a77_1604879999_2ed4d04465ffd4da87b4e2d6ef92052a.crt'),
    requestCert: true,
    rejectUnauthorized: false,
};

var app = require('express')();
var cors = require('cors');
app.use(cors());
var server = require('https').createServer(options, app);
var io = require('socket.io')(server, {
    handlePreflightRequest: (req, res) => {
        const headers = {
            "Access-Control-Allow-Headers": "Content-Type, Authorization",
            "Access-Control-Allow-Origin": req.headers.origin, //or the specific origin you want to give access to,
            "Access-Control-Allow-Credentials": true
        };
        res.writeHead(200, headers);
        res.end();
    }
});


const PORT = process.env.PORT || 8009;
io.set('origins', '*:*');

io.on('connection', function(socket) {
    socket.on('new-message', function(data) {
        io.sockets.emit('messages', data);
    });
    socket.on('rooms_message',function(data){
        io.sockets.emit('room_message',data)
    })
});

server.listen(PORT, function() {
    console.log(`Servidor corriendo en ${PORT}`);
});