//TODO confirm на удалении DONE
//TODO по клику на тайтл показывать/скрывать дескрипшн DONE
//TODO валидация формы логина DONE
//TODO удалять книгу из админки аяксом DONE
$(document).ready(function(){

    $('.delete').click(function(e){
        e.preventDefault();
        if(!confirm('Are you sure?')){
            e.preventDefault();
            return;
        }
    var deleteData=$(this).parent().parent().parent().first().children('td.bookId').text();
        var hideElement=$(this).parent().parent().parent().first();

        $.get('/admin/books/delete/'+deleteData)
            .done(function () {
                hideElement.fadeOut(500);
            })
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
        e.preventDefault();
        if (!validateContactForm()) {
            $('.alert-box').html('<div class="alert alert-danger alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Invalid</div>');
            e.preventDefault();
            return;
        }

        //TODO спиннер добавить DONE
        var formData, postParameters = {};
        formData=$(this).serializeArray();
        console.log(formData);
        var obj;
        for (key in formData){
            obj=formData[key];
            postParameters[obj.name]=obj.value;
        }
        $('#spinner-load').show();
        $.post('/api/feedback', postParameters)
            .done(function () {
                //пропадает форма
            $('#contact-form').fadeOut(function () {
                $('#contact-form').after('Saved');
            });
            })
            .fail(function () {
                $('#contact-form').fadeOut(function () {
                    $('#contact-form').after('Error');
                });
            })
            .always(function (response) {
                //TODO убрать спиннер DONE
                $('#spinner-load').fadeOut(1000);
                
            })
        ;
        // console.log(postParameters);

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

