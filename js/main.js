function nextSection(currentSection, nextSection) {
  document.getElementById(currentSection).style.display = "none";
  document.getElementById(nextSection).style.display = "block";
}

function prevSection(currentSection, prevSection) {
  document.getElementById(currentSection).style.display = "none";
  document.getElementById(prevSection).style.display = "block";
}