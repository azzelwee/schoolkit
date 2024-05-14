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

  let currentContentIndex = 0;
const contents = document.querySelectorAll('.content');

function navigate(direction) {
    contents[currentContentIndex].style.display = 'none';
    currentContentIndex += direction;

    if (currentContentIndex < 0) {
        currentContentIndex = 0;
    } else if (currentContentIndex >= contents.length) {
        currentContentIndex = contents.length - 1;
    }

    contents[currentContentIndex].style.display = 'block';

    document.getElementById('back-button').disabled = currentContentIndex === 0;
    document.getElementById('next-button').disabled = currentContentIndex === contents.length - 1;
}

// Initialize the navigation buttons state
document.getElementById('back-button').disabled = true;


