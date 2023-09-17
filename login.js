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
    var currentURL = window.location.href;

    var signupError = "signuperror";
    var blankCredentialsError = "blankCredentials";
   
    //If error messages are present, load page on signup
    if (!(currentURL.indexOf(signupError) === -1 && currentURL.indexOf(blankCredentialsError) === -1))
    {
        //Hide log in form
        $('#loginForm').hide();
        $('#createAccountOption').hide();
        setTimeout(() => {
            //Show sign up form
            $('#signupForm').show();
            $('#loginOption').show();
        }, 450);
    }
}

function switchToSignup()
{
    //Hide login error if needed
    if ($("#loginError").is(":visible")) 
    {
        $("#loginError").hide();
    }

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
    if ($("#signupError").is(":visible")) 
    {
        $("#signupError").hide();
    }
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

