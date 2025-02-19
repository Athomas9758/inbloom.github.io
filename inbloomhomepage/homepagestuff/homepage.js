function toggleMenu() {
    var menu = document.getElementById('menu');
    menu.classList.toggle('active');
  }
  
  // Hide the menu when clicking outside of it
  document.addEventListener('click', function(event) {
    var menu = document.getElementById('menu');
    var menuIcon = document.querySelector('.menu-icon');
    
    // Check if the click is outside the menu and menu icon
    if (!menu.contains(event.target) && !menuIcon.contains(event.target)) {
      menu.classList.remove('active');
    }
  });