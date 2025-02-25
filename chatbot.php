<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="chatbot.css">
</head>
<body>
    <div class="chat-container">
        <div class="chat-box" id="chat-box">
            <div class="chat-header">
                <h2>Chatbot</h2>
                <button id="close-chat">X</button>
            </div>
            <div class="chat-messages" id="chat-messages"></div>
            <input type="text" id="user-input" placeholder="Type your message..." />
            <button id="send-button">Send</button>
        </div>
        <button id="open-chat">Chat with us</button>
    </div>

    <script src="chatbot.js"></script>
</body>
</html>