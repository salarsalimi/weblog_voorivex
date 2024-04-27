 // Function to redirect with a message
function redirectWithMessage(url, delay, message) {
    // Display the message
    alert(message);
    
    // Set timeout to redirect after the delay
    setTimeout(function() {
        window.location.href = url;
    }, delay);
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";"); // Split cookies string into an array

    // Iterate over each cookie
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT"; // Set expiry date to a past date
    }
}