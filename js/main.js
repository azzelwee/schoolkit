function validateForm() {
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;
  const passwordError = document.getElementById('passwordError');
  
  if (password !== confirmPassword) {
      passwordError.style.display = 'block';
      return false;
  } else {
      passwordError.style.display = 'none';
      return true;
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const submenuParent = document.querySelector('.has-submenu');
  submenuParent.addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('open');
  });
});



function nextSection(currentSection, nextSection) {
  document.getElementById(currentSection).style.display = "none";
  document.getElementById(nextSection).style.display = "block";
}

function prevSection(currentSection, prevSection) {
  document.getElementById(currentSection).style.display = "none";
  document.getElementById(prevSection).style.display = "block";
}

function closePopup() {
  const popup = document.getElementById('statusPopup');
  if (popup) {
      popup.style.display = 'none';
  }
}

// Optionally, add a timeout to auto-close the popup after a few seconds
window.addEventListener('load', () => {
  setTimeout(() => {
      closePopup();
  }, 5000); // Closes the popup after 3 seconds
});


document.addEventListener("DOMContentLoaded", function() {
  handlePositionChange(); // Call the function when the page loads to set the initial state
});

function handlePositionChange() {
  var position = document.getElementById('position').value;
  var teachingInputDiv = document.getElementById('teachingInputDiv');
  var nonTeachingInputDiv = document.getElementById('nonTeachingInputDiv');
  var teachingInput = document.getElementById('teachingInput');
  var nonTeachingInput = document.getElementById('nonTeachingInput');
  
  if (position === 'Teaching') {
      teachingInputDiv.classList.remove('hidden');
      nonTeachingInputDiv.classList.add('hidden');
      teachingInput.disabled = false;
      nonTeachingInput.disabled = true;
  } else if (position === 'Non-Teaching') {
      teachingInputDiv.classList.add('hidden');
      nonTeachingInputDiv.classList.remove('hidden');
      teachingInput.disabled = true;
      nonTeachingInput.disabled = false;
  } else {
      teachingInputDiv.classList.add('hidden');
      nonTeachingInputDiv.classList.add('hidden');
      teachingInput.disabled = true;
      nonTeachingInput.disabled = true;
  }
  // document.getElementById('position').addEventListener('change', handlePositionChange);
}

// // Initialize the form inputs to be disabled
// document.addEventListener('DOMContentLoaded', function() {
//   document.getElementById('teachingInput').disabled = true;
//   document.getElementById('nonTeachingInput').disabled = true;
// });

function showSection(sectionId) {
  var sections = document.querySelectorAll('.custom-form-section');
  sections.forEach(function(section) {
      if (section.id === sectionId) {
          section.classList.add('current');
      } else {
          section.classList.remove('current');
      }
  });
  
  var gaugeLine = document.querySelector('.gauge-line');
  var navItems = document.querySelectorAll('.custom-top-nav li a');
  var currentNavItem = document.querySelector('.custom-top-nav li a[href="#' + sectionId + '"]');
  
  var index = Array.from(navItems).indexOf(currentNavItem);
  var width = (index + 1) * (100 / navItems.length);
  
  function updateGaugeLine(index) {
    var gaugeLine = document.querySelector('.gauge-line');
    var navItems = document.querySelectorAll('.custom-top-nav li');
    var totalWidth = 0;
    for (var i = 0; i < index; i++) {
        totalWidth += navItems[i].offsetWidth;
    }
    gaugeLine.style.left = totalWidth + 'px';
}
}

function updateEmployeeName() {
  // Get the selected option text
  var selectElement = document.getElementById("employee_name");
  var selectedName = selectElement.options[selectElement.selectedIndex].text;
  
  // Set the text in the employee name field
  if (selectElement.value === "") {
      document.getElementById("employee_full_name").innerText = "";
  } else {
      document.getElementById("employee_full_name").innerText = selectedName;
  }
}

// test employeeDetails2

function showSection(sectionId) {
  const sections = document.querySelectorAll('.section');
  sections.forEach(section => {
      section.style.display = 'none';
  });

  const activeSection = document.getElementById(sectionId);
  activeSection.style.display = 'block';
}

// // Initially display the profile section
// document.getElementById('profile').style.display = 'block';

// next button for employeeDetails2.php
function showNextSection(sectionId) {
  const sections = document.querySelectorAll('section');
  sections.forEach(section => {
      section.style.display = 'none';
  });
  document.getElementById(sectionId).style.display = 'block';
}

function showPreviousSection(sectionId) {
  const sections = document.querySelectorAll('section');
  sections.forEach(section => {
      section.style.display = 'none';
  });
  document.getElementById(sectionId).style.display = 'block';
}

function confirmDeletion() {
  return confirm('Are you sure you want to delete this user?');
}

document.getElementById('togglePassword').addEventListener('click', function () {
  const passwordField = document.getElementById('password');
  const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField.setAttribute('type', type);
  
  // Toggle the eye icon
  this.textContent = type === 'password' ? '\uD83D\uDC41' : '\uD83D\uDC41\u200D\uD83D\uDDE8'; // Unicode for eye and eye with slash
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
  const confirmPasswordField = document.getElementById('confirm-password');
  const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
  confirmPasswordField.setAttribute('type', type);
  
  // Toggle the eye icon
  this.textContent = type === 'password' ? '\uD83D\uDC41' : '\uD83D\uDC41\u200D\uD83D\uDDE8'; // Unicode for eye and eye with slash
});
