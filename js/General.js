document.getElementById("registform").addEventListener("submit", function(e) {
    let password = document.getElementById("password").value;
    let password_repeat = document.getElementById("password_repeat").value;
    if (password != password_repeat) {
        let messagespace = document.getElementById("error");
        messagespace.innerText = "Passwords do not match";
        messagespace.style.color = "red";
        
        e.preventDefault();
    }
});