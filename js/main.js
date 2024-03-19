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

    // Function to close the popup
    function closePopup() {
        document.getElementById("statusPopup").style.display = "none";
    }

    // Automatically close the popup after 5 seconds
    setTimeout(closePopup, 5000);

    function uploadFile() {
        // Retrieve the file input element
        var fileInput = document.getElementById('fileInput');
        
        // Check if a file has been selected
        if (fileInput.files.length > 0) {
          var file = fileInput.files[0]; // Get the first file
          
          // Here you can perform further actions such as sending the file to the server
          // Example: 
          // var formData = new FormData();
          // formData.append('file', file);
          // You can use fetch() or XMLHttpRequest to send the file to the server
          
          // For demonstration, alerting the file name
          alert('File selected: ' + file.name);
        } else {
          alert('Please select a file.');
        }
      }