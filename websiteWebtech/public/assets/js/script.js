function subscribe() {

    var emailInput = document.getElementById('email');
    var email = emailInput.value;


    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    var thankYouMessage = 'Thank you for subscribing!';
    window.alert(thankYouMessage);

    emailInput.value = '';
}

function validateEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}