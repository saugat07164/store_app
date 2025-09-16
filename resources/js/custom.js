$(function () {
  // Initialize elements - use either .hide() or .css(), not both
  $('#sidebar').hide();  // This is sufficient
  $('#showsidebar').show();  // Shows the hamburger button
  $('#hidemenu').hide();  // Hides the close button

  $('#hidemenu').click(function () {
      $('#sidebar').fadeOut();
      $('#showsidebar').show();
      $('#hidemenu').hide();
  });

  $('#showsidebar').click(function () {
      $('#sidebar').fadeIn();
      $('#showsidebar').hide();
      $('#hidemenu').show();
  });
});