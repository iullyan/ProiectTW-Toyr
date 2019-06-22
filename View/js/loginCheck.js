function loginCheck(form) {
    function checkPassword(form) {
        var password = form.password.value;
        if (password == '') return false;
        else return true;
    }

    function checkUser(form) {

        var username = form.username.value;
        var url = 'http://localhost/ProiectTW-Toyr/WebServices/UsersManagement/Controller/User/isUser.php?username=' + username;

        var request = new XMLHttpRequest();
        request.open('GET', url, false);
        request.send();

        var response = JSON.parse(request.responseText);
        if (response.message == 'User exists.') return true;
        return false;
    }

    var pass = checkPassword(form);
    var user = checkUser(form);

    if(pass == false) {
        alert("Please enter Password");
        return false;
    }

    if(user == false) {
        alert("User does not exist");
        return false;
    }
}