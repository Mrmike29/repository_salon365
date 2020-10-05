'use strict';

(function ( $ ){
    $.fn.mPassword = function (key = ''){
        $(this).bind('paste input',function(){
            let ms = '',
                errSta = false;

            $(this).siblings('span.error-m-password' + key).remove();

            if(!$(this).val().match(/[A-Z]/)) {
                errSta = true;
                ms += '* La contraseña debe contener por lo menos 1 mayúscula. <br>';
            }

            if(!$(this).val().match(/[0-9]/)) {
                errSta = true;
                ms += '* La contraseña debe contener por lo menos 1 número. <br>';
            }

            if(!$(this).val().match(/[àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝäëïöüÿÄËÏÖÜŸ!@%&`":´¨<>ºªçÇ;·~€¬/='¿¡[\]{}()*+?,\\^$|#\s-]/g)) {
                errSta = true;
                ms += '* La contraseña debe contener por lo menos 1 caracter especial. <br>';
            }

            if ($(this).val().length < 9){
                errSta = true;
                ms += '* La contraseña debe contener mínimo 9 caracteres. <br>';
            }

            if (errSta){ $(this).parent('div').append('<span class="error-m-password' + key + '" style="color: red">' + ms + '</span>') }

            return !errSta;
        })
    };
})( jQuery );
