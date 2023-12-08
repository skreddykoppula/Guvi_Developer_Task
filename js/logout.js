$(document).ready(function() {
    $('#logout').on('click', function() {
      $.ajax({
        url: './php/logout.php', 
        type: 'POST',
        success: function(response) {
          alert(response);
        },
        error: function(xhr, status, error) {
          console.error('Logout error:', status, error);
        }
      });
    });
  });
  