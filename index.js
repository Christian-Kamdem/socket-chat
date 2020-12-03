const app = require('express')();
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const rooms = {};
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});
io.on('connection', (socket) => {
  socket.on('disconnect', (msg) => {
    for (const [key, value] of Object.entries(rooms)) {
      if(socket.id == value){
        delete rooms[key];
        break;
      }
    }
  });
  socket.on('chat message', (msg) => {
    if(!rooms[msg.userId]){
      rooms[msg.userId] = socket.id;
    }
    //We check if the recipient is connected
    if(rooms[msg.sendTo]){
      io.to(rooms[msg.sendTo]).emit('chat message',{
        message:msg.message,
        from:msg.userId,
        error:false
      });
    }else{
      io.to(rooms[msg.userId]).emit('chat message',{
        message:msg.sendTo+' is disconnected',
        from:msg.userId,
        error:true
      });
    }
    console.log('Room: '+rooms);
  });
});
http.listen(3000, () => {
  console.log('listening on :3000');
});
