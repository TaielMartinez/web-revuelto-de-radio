var img64 = "";

function readFile(input) {
    if (input.files && input.files[0]) {
        if(input.files[0].size > 1000000){
            console.log('muy pesado')
            $('.img_error').css('display', 'block')
            return
        } else {
            $('.img_error').css('display', 'none')
        }
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('.imput_img_preview').attr('src', e.target.result);
            img64 = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

var fileUpload = document.getElementById('imput_img');
fileUpload.onchange = function (e) {
    readFile(e.srcElement);
}


$("#input_tipo_dinero")
.change(function() {
    $( "select option:selected" ).each(function() {
        console.log($( this ).val())
        if($(this).val() == 1){
            console.log($( this ).val())
            $('.input_valor .gratis').css('display', 'none')
            $('.input_valor .pesos').css('display', 'block')
        } else if($(this).val() == 1){
            console.log($( this ).val())
            $('.input_valor .gratis').css('display', 'block')
            $('.input_valor .pesos').css('display', 'none')
        } else {
            $('.input_valor .gratis').css('display', 'block')
            $('.input_valor .pesos').css('display', 'none')
        }
    });
})
.trigger("change");


$('.enviar').click(function(){
    
    comprobar_datos()
});

function comprobar_datos(){

    let costo = 0;
    let todo_correcto = true

    if($('#input_tipo_dinero option:selected').val() == 1){
        costo = $('.input_valor .pesos input').val();
        if(costo > 0){
            valido('input_precios', true)
        } else {
            valido('input_precios', false)
            todo_correcto = false
        }
    } else if($('#input_tipo_dinero option:selected').val() == 2){
        costo = 'Sobre';
        valido('input_precios', true)
        $('.input_precios').removeClass('is-invalid')
    } else if($('#input_tipo_dinero option:selected').val() == 3){
        costo = 'Gratis';
        valido('input_precios', true)
    }

    if($('.imput_img_preview').attr('src') && $('.custom-file-input').val()){
    //if($('.custom-file-input').attr('src')){
        valido('imput_img_preview', true)
        valido('custom-file-input', true)
        
    } else {
        valido('imput_img_preview', false)
        valido('custom-file-input', false)
        todo_correcto = false
    }
    
    validar_texto('input_nombre');
    validar_texto('input_ubicacion');
    validar_texto('input_fecha');
    validar_texto('input_hora');
    validar_texto('input_descripcion');
    validar_texto('input_artistas');
    validar_texto('input_direccion');

    console.log(todo_correcto)

    //todo_correcto = true            // DEBUG
    if(todo_correcto){

        let date = $('.input_fecha').val()
        let nombre = $('.input_nombre').val()
        let lugar = $('.input_ubicacion').val()
        let youtube = $('.input_youtube').val()
        let facebook = $('.input_facebook').val()
        let hora = $('.input_hora').val()
        let spotify = $('.input_spotify').val()
        let direccion = $('.input_direccion').val()
        let reserva = $('.input_reserva').val()
        let artista = $('.input_artista').val()
        let descripcion = $('.input_descripcion').val()

        let informacion = {
            date: date,
            nombre: nombre,
            lugar: lugar,
            facebook: facebook,
            youtube: youtube,
            hora: "0000-00-00 "+hora+":00",
            foto: img64,
            costo: costo,
            spotify: spotify,
            direccion: direccion,
            reserva: reserva,
            artista: artista,
            descripcion: descripcion

        }
        console.log(informacion)

/*
    date       2020-03-08
    url -        http://revueltoderadio.com/api/v1/ending.php
    nombre      varchar(255)
    lugar          https://www.google.com.ar/maps/place/Hierro+Celina/@-34.6938925,-58.4744191,15z
    costo         ej 1: 600 (osea 600 pesos) o ej 2: "sobre" o ej 3: "gratis"      (en el fomulario da 3 opciones, ingresar valor o las opciones de al "sobre" y "gratis" estos textos son harcodeados)
    foto            https://auth-db185.hostinger.com/themes/pmahomme/img/logo_left.png
    facebook    https://www.facebook.com/events/528701001383165/
    youtube      https://www.youtube.com/watch?v=nd3IKA3sBEk
    hora             2019-02-23 20:02:21 (es un timestamp, pero los unicos valores que usamos son hora y minuto, osea 20:02, los otros pueden ser todos 0 y no pasa nada)
*/

        $.ajax({
            data:  informacion,
            url:   '../api/v1/events/registro.php',
            type:  'post',
        }).done(function(data){
            window.location.href = "enviada"
            console.log(data)
        })
    }
}


function valido(clase, valido){
    if(valido){
        $('.'+clase).addClass('is-valid')
        $('.'+clase).removeClass('is-invalid')
    } else {
        $('.'+clase).addClass('is-invalid')
        $('.'+clase).removeClass('is-valid')
    }
    //console.log(clase+ ' ' +valido)
}

function validar_texto(clase){
    if($('.'+clase).val()){
        valido(clase, true)
    } else {
        valido(clase, false)
        todo_correcto = false
    }
}