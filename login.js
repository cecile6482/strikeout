function loginOnload()
{
    $('#menuCircle').addClass('rotate-center');
    $('#star1').addClass('rotate-scale-up');
    $('#star2').addClass('rotate-scale-up3');
    $('#star3').addClass('rotate-scale-up2');

    //Hide sign up form
    $('#signupForm').hide();
    $('#loginOption').hide();

    //Get current URL
    //var currentURL = window.location.href;

    //var accountCreatedString = "accountCreated";
    //var loginErrorString = "loginerror";
   
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

function switchToSignup()
{
    //Hide log in form
    $('#loginForm').addClass('flip-out-hor-top');
    $('#createAccountOption').addClass('flip-out-hor-top');
    setTimeout(() => {
        $('#loginForm').hide();
        $('#createAccountOption').hide();
        //Show sign up form
        $('#signupForm').addClass('flip-in-hor-bottom').show();
        $('#loginOption').addClass('flip-in-hor-bottom').show();
    }, 450);
    //Remove classes after animation ends
    setTimeout(() => {
        $('#signupForm').removeClass('flip-in-hor-bottom');
        $('#loginOption').removeClass('flip-in-hor-bottom');
        $('#loginForm').removeClass('flip-out-hor-top');
        $('#createAccountOption').removeClass('flip-out-hor-top');
    }, 900);
}

function switchToLogin() {
    //Hide sign up form
    $('#signupForm').addClass('flip-out-hor-top');
    $('#loginOption').addClass('flip-out-hor-top');
    setTimeout(() => {
        $('#signupForm').hide();
        $('#loginOption').hide();
        //Show sign up form
        $('#loginForm').addClass('flip-in-hor-bottom').show();
        $('#createAccountOption').addClass('flip-in-hor-bottom').show();
    }, 450);
    //Remove classes after animation ends
    setTimeout(() => {
        $('#loginForm').removeClass('flip-in-hor-bottom');
        $('#createAccountOption').removeClass('flip-in-hor-bottom');
        $('#signupForm').removeClass('flip-out-hor-top');
        $('#loginOption').removeClass('flip-out-hor-top');
    }, 900);
}

