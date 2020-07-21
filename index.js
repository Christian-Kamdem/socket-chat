const app = require('express')();
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const rooms = {};
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});
io.on('connection', (socket) => {
  socket.on('disconnect', (msg) => {
    console.log(socket.id+' is disconnected!');
  });
  socket.on('chat message', (msg) => {console.log(msg);
    if(rooms[msg.userId]){
      io.to(rooms[msg.sendTo]).emit('chat message',{
        message:msg.message,
        from:msg.userId
      });
    }else{
      rooms[msg.userId] = socket.id;
      io.to(rooms[msg.sendTo]).emit('chat message',{
        message:msg.message,
        from:msg.userId
      });
    }
    console.log(rooms);
  });
});
http.listen(3000, () => {
  console.log('listening on *:3000');
});
