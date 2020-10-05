var fs = require('fs');

var options = {
    key: fs.readFileSync('/home/ingrid/ssl/keys/c5be3_f4f47_70ae58b0b9d4e3a72854c27715045424.key'),
    cert: fs.readFileSync('/home/ingrid/ssl/certs/teatrodelpresagio_com_c5be3_f4f47_1600127999_659b48d0537cab338cda4aa3e2eb523b.crt'),
    requestCert: true,
    rejectUnauthorized: false,
};


var app = require('express')();
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

const { addUser, getUser, removeUser } = require('../public_html/assets/js/users');

io.on('connection', (socket) => {
    socket.on('inicializer', (email) => {
        io.sockets.emit('verifyLogged', email);
    })

    socket.on('joinIn', ({ code }, callback) => {

        const { error, user } = addUser({ id: socket.id, code: code });
        console.log(error)

        if(error) return callback(error);
        
        callback();
    });

    socket.on('show-user', () => {
        const user = getUser(socket.id);
        io.sockets.emit('showMeUser', user);
    })

    socket.on('hi', (r) => {
        console.log(r);
        io.sockets.emit('logOut', r);
    })

    socket.on('disconnect', function(){
        const user = getUser(socket.id);
        if(user != null){
            console.log(user.code);
            const rUser = removeUser(socket.id);
            io.sockets.emit('logOut', rUser.code);
            console.log(`${user.code} se ha desconectado.`);
        }
    });
});

server.listen(PORT, function() {
    console.log(`Servidor corriendo en ${PORT}`);
});