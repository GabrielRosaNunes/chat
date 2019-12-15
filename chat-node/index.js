const express = require('express')
const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server);


app.use('/',(req,res) => {
    res.send('foi');
});

let conectados = {}
io.on('connection',socket => {
    conectados[socket.id] = socket.handshake.query.name
    io.emit('userConnected',socket.handshake.query.name);

    socket.on('sendMessage',data => {
        console.log(data);
        
        io.emit('newMessage', data);
    });

    socket.on("disconnect", () => {
        io.emit('userDisconnected',conectados[socket.id]);
    });
});

server.listen(3000);