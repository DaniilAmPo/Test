////////////////////////////////////////////////////////////////////////start register
var Error = "";
function Register(){
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;
    var re_pass = document.getElementById('re_pass').value;
    var checkbox = document.getElementById('agree-term');


    if(name.length > 40){
        Error += "Name is too long. ";
    } else if(name.length < 3){
        Error += "Name is too short. ";
    }

    if(email.length > 100){
        Error += "Email is too long. ";
    } else if(email.length < 9){
        Error += "Name is too short. ";
    }

    var CheckEmailValidate = validateEmail(email);
    if(CheckEmailValidate === false){
        Error += "Wrong email. "
    }

    if(pass.length < 8){
        Error += "Passwords is too short. ";
    }

    if(pass !== re_pass){
        Error += "Passwords do not match. ";
    }

    if (checkbox.checked === false) {
        Error += "Confirm terms of use. ";
    }

    if(Error === ""){
        document.getElementById('Errors').textContent = "";
        $.ajax({
            url: 'php/core.php',
            type: 'POST',
            dataType: 'json',
            data: {
                func: 'register',
                Email: email,
                Name: name,
                pass: pass

            },
            success: function (data) {
            }, error: function (data) {
                emailcheck(data);

            }
        })



    }else {
        document.getElementById('Errors').textContent = Error;
        Error = "";
    }
}

function validateEmail(email)
{
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function emailcheck(data){


    if(data.responseText.indexOf("false") !== -1){
        Error += "Use another email. ";
        document.getElementById('Errors').textContent = Error;
        Error = "";
    } else {
        window.location.href = 'confirmemail.html';
    }

}

////////////////////////////////////////////////////////////////////////end register





////////////////////////////////////////////////////////////////////////start login

function login(){
    var email = document.getElementById('email').value;
    var pass = document.getElementById('your_pass').value;
    $.ajax({
        url: 'php/core.php',
        type: 'POST',
        dataType: 'json',
        data: {
            func: 'login',
            Email: email,
            pass: pass

        },
        success: function (data) {
        }, error: function (data) {
            console.log(data);
            checkdata(data);
        }
    })
}

function checkdata(data){
    if(data.responseText.indexOf("false") !== -1){

        Error += "Incorrect data. ";
        document.getElementById('Errors').textContent = Error;
        Error = "";
    } else {
        var idsize = data.responseText.indexOf(`\"`);
        var id = data.responseText.slice(0,idsize);

        document.cookie = "id=" + id;
        window.location.href = 'profile.php';
    }
}


////////////////////////////////////////////////////////////////////////end login




////////////////////////////////////////////////////////////////////////start Updata


function Updata(){
    var name = document.getElementById('name').value;
    var pass = document.getElementById('pass').value;
    var re_pass = document.getElementById('re_pass').value;
    var id = get_cookie("id");

    if(name.length > 40){
        Error += "Name is too long. ";
    } else if(name.length < 3){
        Error += "Name is too short. ";
    }

    if(pass.length < 8){
        Error += "Passwords is too short. ";
    }

    if(pass !== re_pass){
        Error += "Passwords do not match. ";
    }


    if(Error === ""){

        document.getElementById('Errors').textContent = "";
        $.ajax({
            url: 'php/core.php',
            type: 'POST',
            dataType: 'json',
            data: {
                func: 'updata',
                Name: name,
                id: id,
                pass: pass

            },
            success: function (data) {
            }, error: function (data) {
                console.log(data);

            }
        })



    }else {
        document.getElementById('Errors').textContent = Error;
        Error = "";
    }




}

function get_cookie ( cookie_name )
{
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

    if ( results )
        return ( unescape ( results[2] ) );
    else
        return null;
}






