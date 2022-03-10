function PasswordToggle(){
  $('.password-toggle').on('click',function(){
    if ($('.password-field').attr('type') === 'password') {
      $('.password-field').attr('type','text');
      $('.input-group-text').find('i').removeClass('fa-lock');
      $('.input-group-text').find('i').addClass('fa-lock-open');
      $(this).find('i').removeClass('fa-eye');
      $(this).find('i').addClass('fa-eye-slash');
    }else if ($('.password-field').attr('type') === 'text') {
      $('.password-field').attr('type','password');
      $('.input-group-text').find('i').removeClass('fa-lock-open');
      $('.input-group-text').find('i').addClass('fa-lock');
      $(this).find('i').removeClass('fa-eye-slash');
      $(this).find('i').addClass('fa-eye');
    }
  });
}
