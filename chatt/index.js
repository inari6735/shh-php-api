import { createServer } from "http";
import { Server } from "socket.io";
import {buildUrl, buildUrlWithParams} from "./lib/api.js";
import { fetchPost } from "./lib/request.js"

const httpServer = createServer();
const io = new Server(httpServer, {

});

let usersList = [];

io.on("connection", (socket) => {
    console.log('New connection:', socket.id);
    console.log(usersList)
    socket.on('sendMessage', (data) => {
        const socketId = usersList.find(item => item.userId === data.msg.to)?.socketId;
        const receiverSocket = io.sockets.sockets.get(socketId);

        if (socketId) {
            receiverSocket.emit('receiveMessage', data.msg);
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