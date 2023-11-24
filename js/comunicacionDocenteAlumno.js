const chatbox = document.querySelector(".chatbox");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");
let userMessage = null; // Variable to store user's message
const inputInitHeight = chatInput.scrollHeight;
const handleChat = () => {
    var formulario = document.getElementsByClassName('chatbot')[0];
    formulario.submit();
    userMessage = chatInput.value.trim();
    if(!userMessage) return;
    chatInput.value = "";
    chatInput.style.height = `${inputInitHeight}px`;
    chatbox.scrollTo(0, chatbox.scrollHeight);
}
chatInput.addEventListener("input", () => {
    chatInput.style.height = `${inputInitHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
});
chatInput.addEventListener("keydown", (e) => {
    if(e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
        e.preventDefault();
        handleChat();
    }
});
sendChatBtn.addEventListener("click", handleChat);


const uno=document.getElementById('01');
const dos=document.getElementById('02');
const tres=document.getElementById('03');
const cuatro=document.getElementById('04');
const cinco=document.getElementById('05');
const seis=document.getElementById('06');

if(uno.checked && dos.checked && tres.checked && cuatro.checked && cinco.checked && seis.checked) {
    
}