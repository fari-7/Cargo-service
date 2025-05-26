function data() {
    var phone = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (phone == "" || password == "") {
        alert("All the information is needed.");
        return false;
    }

  
    if (phone.length != 11) {
        alert("Invalid Number!");
        return false;
    }

    return true; 
}
