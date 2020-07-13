$(document).ready(function(){
    $('input[type=password]').keyup(function() {
    var pswd = $(this).val();

    //validando o tamanho
    if ( pswd.length < 8 ) {
        $('#length').removeClass('valid').addClass('invalid');
    } else {
        $('#length').removeClass('invalid').addClass('valid');
    }

    //validando letras
    if ( pswd.match(/[A-z]/) ) {
        $('#letter').removeClass('invalid').addClass('valid');
    } else {
        $('#letter').removeClass('valid').addClass('invalid');
    }

    //validando letras maiúsculas
    if ( pswd.match(/[A-Z]/) ) {
        $('#capital').removeClass('invalid').addClass('valid');
    } else {
        $('#capital').removeClass('valid').addClass('invalid');
    }

    //validando números
    if ( pswd.match(/\d/) ) {
        $('#number').removeClass('invalid').addClass('valid');
    } else {
        $('#number').removeClass('valid').addClass('invalid');
    }

    //validando espaço
    if ( pswd.match(/[^a-zA-Z0-9\-\/]/) ) {
        $('#space').removeClass('invalid').addClass('valid');
    } else {
        $('#space').removeClass('valid').addClass('invalid');
    }

    }).focus(function() {
        $('#pswd_info').show();
    }).blur(function() {
        $('#pswd_info').hide();
    });

});