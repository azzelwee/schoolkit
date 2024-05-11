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



