function acceptCookies() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/api/cookie_consent.php', true);
    xhr.send();

    // Remove the cookie consent banner
    document.getElementsByClassName('cookie-consent')[0].style.display = 'none';
}