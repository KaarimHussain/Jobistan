import { GoogleGenerativeAI } from "https://esm.run/@google/generative-ai";

const genAI = new GoogleGenerativeAI("YOUR-API-KEY");
const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

$(document).ready(function () {
    var responseBox = $('#response-box');
    var chatHistory = [];
    var chat;
    // Initialize chat with an empty history
    function startChat() {
        chat = model.startChat({ history: [] });
    }
    // Function to send a message and handle the response
    async function sendMessage(prompt) {
        const result = await chat.sendMessage(prompt);
        const formatRes = formatResponse(result.response.text());

        // Save the bot's response in chat history
        chatHistory.push({
            chatAI: formatRes,
            response: 'chatResponse'
        });

        printChatHistory();
    }
    var Input = $('#ai-input-field');
    $(Input).on('keypress', function (event) {
        if (event.key === 'Enter') {
            const userPrompt = Input.val();

            // Save the user's input in chat history
            chatHistory.push({
                chatMY: userPrompt,
                response: 'myResponse'
            });

            // Send the message to the AI and handle the response
            sendMessage(userPrompt);
            printChatHistory();
            // Clear the input field
            Input.val('');
        }
    });
    var InputButton = $('#ai-input-button');
    $(InputButton).click(function (event) {
        const userPrompt = Input.val();
        // Save the user's input in chat history
        chatHistory.push({
            chatMY: userPrompt,
            response: 'myResponse'
        });
        // Send the message to the AI and handle the response
        sendMessage(userPrompt);
        printChatHistory();
        // Clear the input field
        Input.val('');
    })
    // Function to print chat history to the response box
    function printChatHistory() {
        $(responseBox).empty();
        chatHistory.forEach(function (item) {
            var div = document.createElement('div');
            if (item.response === 'myResponse') {
                div.classList.add('myResponse', 'mb-2');
                div.innerHTML = item.chatMY;
            } else if (item.response === 'chatResponse') {
                div.classList.add('chatResponse', 'mb-2');
                div.innerHTML = item.chatAI;
            }

            responseBox.append(div);
        });
    }
    // Function to format the AI response
    function formatResponse(response) {
        // Convert markdown-like bold and italic to HTML tags
        response = response
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')  // Bold
            .replace(/\*(.*?)\*/g, '<em>$1</em>');            // Italic

        // Convert headers (##) to <h3> tags
        response = response.replace(/##\s*(.*)/g, '<h5>$1</h5>');

        // Replace bullet points with a custom styled list
        response = response
            .replace(/^\*\s+(.*)$/gm, '<li><span style="color: #008ae6;">&#9679;</span> $1</li>')  // Bullet points with a colored icon
            .replace(/\n/g, '<br>');  // Line breaks

        // Wrap <li> elements in <ul> if not already wrapped
        response = response.replace(/(<li>.*<\/li>\s*)+/g, '<ul>$&</ul>');

        return response;
    }
    // Start the chat when the document is ready
    startChat();
});
