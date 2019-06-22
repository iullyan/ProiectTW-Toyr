function registerCheck(form) {
    function checkPassword(form) {
        password1 = form.password.value;
        password2 = form.repeat.value;
        if (password1 == '') {
            alert("Please enter Password");
            return false;
        }
        else if (password2 == '') {
            alert("Please enter confirm password");
            return false;
        }
        else if (password1 != password2) {
            alert ("\nPassword did not match: Please try again...")
            return false;
        }
        return true;
    }

    function checkUser(form) {

        var username = form.username.value;
        var url = 'http://localhost/ProiectTW-Toyr/WebServices/UsersManagement/Controller/User/isUser.php?username=' + username;

        var request = new XMLHttpRequest();
        request.open('GET', url, false);
        request.send();

        var response = JSON.parse(request.responseText);
        if (response.message == 'User exists.') return false;
        return true;
    }

    var pass = checkPassword(form);
    var user = checkUser(form);

    if(pass == false) {
        return false;
    }

    if(user == false) {
        alert("User already exists");
        return false;
    }
}