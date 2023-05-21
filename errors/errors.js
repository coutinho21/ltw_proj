// error 1
function passwordDifferentFromConfirmPassword(){
    alert('Password and Confirm Password are different!');
}

// error 2
function userAlreadyExists(){
    alert('User already exists!');
}

// error 3
function userDoesNotExist(){
    alert('User does not exist!');
}

// error 4
function wrongPassword(){
    alert('Wrong password!');
}

// error 5
function weakPassword(){
    alert('Password is too weak!');
}

// error 6
function cantReply(){
    alerr('You can\'t reply to this ticket!');
}

const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');
switch(error){
    case '1':
        passwordDifferentFromConfirmPassword();
        break;
    case '2':
        userAlreadyExists();
        break;
    case '3':
        userDoesNotExist();
        break;
    case '4':
        wrongPassword();
        break;
    case '5':
        weakPassword();
        break;
    case '6':
        cantReply();
        break;
    default:
        break;
}