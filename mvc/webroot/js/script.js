//TODO confirm на удалении DONE
//TODO по клику на тайтл показывать/скрывать дескрипшн DONE
//TODO валидация формы логина DONE
$(document).ready(function(){

    $('.delete').click(function(e){
    if(!confirm('Are you sure?')){
        e.preventDefault();
    }
});
    $('.title').on('click', function (){

        // $('.description').toggle(500);
        $(this).parent().next().children().toggle(500);
    });

    function validateContactForm() {
        var username = $('#username').val();
        var email = $('#email').val();
        var message = $('#message').val();

        var res = username != '' && email != '' && message != '';

        return res;
    }

    $(document).on('click', '.alert', function() {
        $(this).fadeOut();
    });

    $('#contact-form').submit(function(e) {
        if (!validateContactForm()) {
            $('.alert-box').html('<div class="alert alert-danger">Invalid</div>');
            e.preventDefault();
        }
    });

    function validateLoginForm() {
        var inputEmail = $('#inputEmail').val();
        var inputPassword = $('#inputPassword').val();
        var res = inputEmail != '' && inputPassword != '';

        return res;
    }

    $('#login-form').submit(function(e) {
        if (!validateLoginForm()) {
            $('.alert-box').html('<div class="alert alert-danger">Invalid</div>');
            e.preventDefault();
        }
    });

});

