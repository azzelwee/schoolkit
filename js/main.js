
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

var rowsPerPage = 10;
var totalRows = document.getElementById("myTable").rows.length - 1; // Subtract 1 for header row
var totalPages = Math.ceil(totalRows / rowsPerPage);
var currentPage = 1;

function navigateTable(page) {
  var startIndex = (page - 1) * rowsPerPage + 1;
  var endIndex = Math.min(startIndex + rowsPerPage - 1, totalRows);

  for (var i = 1; i <= totalRows; i++) {
    if (i >= startIndex && i <= endIndex) {
      document.getElementById("myTable").rows[i].style.display = "";
    } else {
      document.getElementById("myTable").rows[i].style.display = "none";
    }
  }
}

function navigatePrevious() {
  if (currentPage > 1) {
    currentPage--;
    navigateTable(currentPage);
    updatePageIndicator();
  }
}

function navigateNext() {
  if (currentPage < totalPages) {
    currentPage++;
    navigateTable(currentPage);
    updatePageIndicator();
  }
}

function updatePageIndicator() {
  document.getElementById("pageIndicator").textContent = "Page " + currentPage;
}

navigateTable(currentPage);
updatePageIndicator();
