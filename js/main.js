// const btn = document.querySelector('#btn');
// const Form = document.querySelector("#myForm");
// const Username = document.querySelector('#username');
// const Password = document.querySelector('#password');
// const Msg = document.querySelector('#msg');

// btn.addEventListener("click", function(e){
//     e.preventDefault();

// if(Username.value.length === 0 || 
//     Password.value.length === 0){
//         console.log('False');
//         Msg.innerHTML = "<h4 class='error'>Please complete details.</h4>"

//         setTimeout(() => document.querySelector('.error').remove(), 3500);
//         }else {
//         console.log('True');
//         Form.submit();
//         }
// });

document.addEventListener('DOMContentLoaded', function() {
    var popup = document.querySelector('.popup-message');
    if (popup) {
        popup.style.display = 'block';
        setTimeout(function() {
            popup.style.display = 'none';
        }, 1000); // Hide after 5 seconds
    }
});


    let links = document.querySelectorAll('.page-numbers > a');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("actives");