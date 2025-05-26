function data() {
   
    let firstName = document.getElementById("fn").value.trim();
    let lastName = document.getElementById("ln").value.trim();
    let email = document.getElementById("mail").value.trim();
    let phone = document.getElementById("ph").value.trim();
    let nid = document.getElementById("nid").value.trim();
    let dob = document.getElementById("dob").value.trim();
    let password = document.getElementById("pass").value.trim();
    let confirmPassword = document.getElementById("cpass").value.trim();

   
    if (!firstName || !lastName || !email || !phone || !nid || !dob || !password || !confirmPassword) {
        alert("All fields are required.");
        return false;
    }

    
    if (phone.length !== 11 || isNaN(phone)) {
        alert("Phone number must be exactly 11 digits.");
        return false;
    }

    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Invalid email address.");
        return false;
    }

    
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}
