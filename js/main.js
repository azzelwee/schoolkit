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
  // Show the popup
  document.querySelector('.status-delete').style.display = 'block';

  // After 3 seconds, hide the popup
  setTimeout(function() {
    document.querySelector('.status-delete').style.display = 'none';
  }, 3000); // 3000 milliseconds = 3 seconds
}

function handlePositionChange() {
  const positionSelect = document.getElementById('position');
  const teachingInputDiv = document.getElementById('teachingInputDiv');
  const nonTeachingInputDiv = document.getElementById('nonTeachingInputDiv');
  const selectedValue = positionSelect.value;

  // Hide both divs initially
  teachingInputDiv.classList.add('hidden');
  nonTeachingInputDiv.classList.add('hidden');

  if (selectedValue === 'Teaching') {
      // Show teaching input div
      teachingInputDiv.classList.remove('hidden');
  } else if (selectedValue === 'Non-Teaching') {
      // Show non-teaching input div
      nonTeachingInputDiv.classList.remove('hidden');
  }
}

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