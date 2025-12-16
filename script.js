document.addEventListener("DOMContentLoaded", function() {
    // Auto-hide messages after 5 seconds
    setTimeout(function() {
        var messages = document.querySelectorAll('.form-message, .message-box');
        messages.forEach(function(msg) {
            msg.style.opacity = '0';
            msg.style.transition = 'opacity 0.5s ease';
            setTimeout(function() {
                if (msg.parentNode) {
                    msg.parentNode.removeChild(msg);
                }
            }, 500);
        });
    }, 5000);
    
    // Form validation
    var forms = document.querySelectorAll("form");
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            var inputs = form.querySelectorAll('input[required], textarea[required]');
            var allFilled = true;
            
            inputs.forEach(function(input) {
                if (!input.value.trim()) {
                    allFilled = false;
                    input.style.borderColor = '#e74c3c';
                } else {
                    input.style.borderColor = '#ddd';
                }
            });
            
            if (!allFilled) {
                e.preventDefault();
                alert('⚠️ Please fill in all required fields.');
            }
        });
    });
});