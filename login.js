// Prevent using browser control to enter without loging in
window.onpageshow = function(event) {
    if (event.persisted) {
        window.location.reload(); 
    }
};

function loginOnload()
{
    $('#cd1').addClass('rotate-center');
    $('#cd2').addClass('rotate-center-reverse');
    $('#cd3').addClass('rotate-center-fast');

    //Get current URL
    var currentURL = window.location.href;

    var accountCreatedString = "accountCreated";
    var loginErrorString = "loginerror";
   
    //If error/success messages are not present, animate
    if (currentURL.indexOf(accountCreatedString) === -1 && currentURL.indexOf(loginErrorString) === -1)
    {
        $('#user').addClass('slide-in-left');
        $('#pass').addClass('slide-in-right');
        $('#loginButton').addClass('slide-in-left');
        $('#createAccountOpion').addClass('slide-in-right');
        
        setTimeout(() => {
            $('#user').removeClass('slide-in-left');
            $('#pass').removeClass('slide-in-right');
            $('#loginButton').removeClass('slide-in-left');
            $('#createAccountOpion').removeClass('slide-in-right');
        }, "500");
    }
}

function signupOnload()
{
    $('#cd1').addClass('rotate-center');
    $('#cd2').addClass('rotate-center-reverse');
    $('#cd3').addClass('rotate-center-fast');

    //Get current URL
    var currentURL = window.location.href;

    var emptyCredentialsError = "signuperror";
    var dupUsernameError = "signuperror2";
    var passwordsDoNotMatchError = "signuperror3";
   
    //If error/success messages are not present, animate
    if (currentURL.indexOf(emptyCredentialsError) === -1 && currentURL.indexOf(dupUsernameError) === -1 && currentURL.indexOf(passwordsDoNotMatchError) === -1)
    {
        $('#user').addClass('slide-in-left');
        $('#pass').addClass('slide-in-right');
        $('#passConfirm').addClass('slide-in-left');
        $('#signUpButton').addClass('slide-in-right');
        $('#createAccountOpion').addClass('slide-in-left');
        
        setTimeout(() => {
            $('#user').removeClass('slide-in-left');
            $('#pass').removeClass('slide-in-right');
            $('#passConfirm').removeClass('slide-in-left');
            $('#signUpButton').removeClass('slide-in-right');
            $('#createAccountOpion').removeClass('slide-in-left');
        }, "500");
    }
}


function moveToSignUp()
{
    $('#user').addClass('slide-out-right');
    $('#pass').addClass('slide-out-left');
    $('#loginButton').addClass('slide-out-right');
    $('#createAccountOpion').addClass('slide-out-left');
    setTimeout(() => {
        window.location.href = 'signupPages/signup.php'
    }, "500");
}

function moveToLogin()
{
    $('#user').addClass('slide-out-right');
    $('#pass').addClass('slide-out-left');
    $('#passConfirm').addClass('slide-out-right');
    $('#signUpButton').addClass('slide-out-left');
    $('#loginOption').addClass('slide-out-right');
    setTimeout(() => {
        window.location.href = '../login.php'
    }, "500");
}