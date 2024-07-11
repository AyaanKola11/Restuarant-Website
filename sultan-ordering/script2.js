document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var sessionMessage = document.getElementById('session-message-orderMsg');
        if (sessionMessage) {
            sessionMessage.style.display = 'none';
        }
    }, 3000); 
});