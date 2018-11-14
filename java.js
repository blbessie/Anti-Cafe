var animate, left=0, imgObj=null;

function init(){

   imgObj = document.getElementById('logo');
   imgObj.style.position= 'absolute';
   imgObj.style.top = '250px';
   imgObj.style.left = '500px';
    moveLeft();
}

function moveLeft(){
    left = parseInt(imgObj.style.left, 10);

    if (200 <= left) {
        imgObj.style.left = (left - 5) + 'px';

        animate = setTimeout(function(){moveLeft();},20);

    } else {
        stop();
        unfade(description);
        unfade(location);
    }
}

function stop(){
   clearTimeout(animate);
}

window.onload = function() {init();};

function unfade(element) {
    var op = 0.1;  // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, 10);
}

function showLogIn() {
    $(".overlay").toggle();
    $(".popupLogIn").toggle();
    $(".toQuit").toggle();
    $("#anticafe").toggle();
}

function showSignUp() {
    $(".overlay2").toggle();
    $(".popupSignUp").toggle();
    $(".toQuit2").toggle();
    $("#anticafe2").toggle();
}

function validateForm() {
    var x = document.forms["signUp"]["email"].value;
    var y = document.forms["signUp"]["email2"].value;
    if (x != y) {
        alert("E-mails are not identical");
        return false;
    }

    var x = document.forms["signUp"]["psw"].value;
    var y = document.forms["signUp"]["psw2"].value;
    if (x != y) {
        alert("Password are not identical");
        return false;
    }
}