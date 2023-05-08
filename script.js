$(document).ready(function() {
    $('#submit').click(function(e) {
      e.preventDefault();
  
      var name = $('#name').val();
      var surname = $('#surname').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var confirmPassword = $('#confirmPassword').val();
  
      if (email.indexOf('@') === -1) {
        alert('Please enter a valid email address.');
        return false;
      }
  
      if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
      }
  
      $.ajax({
        url: 'register.php',
        type: 'post',
        data: {
          name: name,
          surname: surname,
          email: email,
          password: password,
          confirmPassword: confirmPassword
        },
        success: function(response) {
          console.log(response);
          if (response === 'success') {
            $('#registerForm').hide();
            $('#successMessage').show();
          }else{
            $('#errorMessage').show();
          }
        }
      });
    });
  });