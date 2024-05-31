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





