import { createServer } from "http";
import { Server } from "socket.io";

const httpServer = createServer();
const io = new Server(httpServer, {

});

let usersList = [];

io.on("connection", (socket) => {
    console.log('New connection:', socket.id);
    socket.on('sendMessage', ({ from, to, message }) => {
        const socketId = usersList.find(item => item.userId === to)?.socketId;
        const receiverSocket = io.sockets.sockets.get(socketId);

        if (socketId) {
            receiverSocket.emit('receiveMessage', { from, to, message });
        }
    });

    socket.on('registerUser', (data) => {
        const user = usersList.find(item => item.userId === data.userId);
        if (user) {
            user.socketId = data.socketId;
        }
        else {
            usersList.push(data)
        }
    });
});

httpServer.listen(3000);