const app = require('express')();
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const axios = require('axios');
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
      //
		    let authOptions = {
		      method: 'post',
		      url: 'http://127.0.0.1/socket-chat/php/entryPoint.php',
		      data: JSON.stringify({
		            requestName:"load_discussion_list",
		            data:{
		              user_from:20
		            }
		          }),
		      headers: {
		       'Content-Type': 'application/json'
		      },
		      json: true
		     };
		     axios(authOptions)
		        .then((response) => {
		            //console.log(response.data.message);
		            io.to(rooms[msg.userId]).emit('chat message',{
				        message:response.data.message,
				        from:msg.userId,
				        type:'private',
				        command:'discussion_list',
				        error:false
				      });
		             })
		        .catch((error) => {
		             //console.log(error.response);
		             /*io.to(rooms[msg.userId]).emit('chat message',{
				        message:error.response,
				        from:msg.userId,
				        type:'private',
				        error:false
				      });*/
		           });
		//
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
        message:'disconnected',
        type:'private',
        from:msg.userId,
        command:'disconnected',
        error:true
      });
    }
  });
});
http.listen(3000, () => {
  console.log('listening on :3000');
});
