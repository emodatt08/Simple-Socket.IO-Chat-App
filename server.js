var io = require('socket.io')(8881);
io.on('connection', function(socket){
    console.log('connected')
    socket.on('sendChatToServer', function(message){
        var d = new Date();
        console.log(message + " " + d);
        io.sockets.emit('serverChatToClient', message)
    });

    socket.on('disconnect', function(socket){
        console.log('Yawa');
    });
});