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
  socket.on('chat message', (msg) => {
    if(rooms[msg.userId]){
      console.log(msg.sentTo);
      io.to(rooms[msg.userId]).emit('chat message',{
        message:'Recu!',
        sentAt:new Date().getTime()});
    }else{
      rooms[msg.userId] = socket.id;
      console.log(msg.sentTo);
      io.to(rooms[msg.userId]).emit('chat message',{
        message:'Recu!',
        sentAt:new Date().getTime()});
    }
  });
});
http.listen(3000, () => {
  console.log('listening on *:3000');
});
