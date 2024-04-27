import { log } from "console";
import express from "express";
import { createServer } from "http";
import { Server } from "socket.io";

const app = express();
const server = createServer(app);
const io = new Server(server, {
    cors: { origin: "*" },
});

server.listen(3000, () => {
    console.log("Server is running on port 3000");
});

io.on("connection", (socket) => {
    console.log("New client connected");

    socket.on("disconnect", () => {
        console.log("Client disconnected");
    });

    socket.on("sendChatToServer", () => {
        io.sockets.emit("sendChatToServer");
        // socket.broadcast.emit("sendChatToServer");
    });

    //

    // Emit Socket.io event when a task position is updated
    socket.on("updateTaskPosition", (taskIds) => {
        io.sockets.emit("taskPositionUpdated", taskIds); // Broadcast the event to all clients
    });

    // Emit Socket.io event when a task position is updated
    socket.on("updateCheckedTask", (taskId) => {
        io.sockets.emit("checkedTaskUpdated", taskId); // Broadcast the event to all clients
    });
    // // Emit Socket.io event when a task is updated
    // socket.on("updateTask", (taskId) => {
    //     io.sockets.emit("taskUpdated", taskId); // Broadcast the event to all clients
    // });
});
