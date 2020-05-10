let url = window.location.href 
let id = url.split("?e=")[1];

console.log(id)


$.ajax({
    url: "../api/v1/discos/",
    method: "POST",
    data: {id : id}
}).done(function(data) {
    data = JSON.parse(data)
    console.log(data)
    //$('.nuevo_img_discos').attr("src", data);

    $('.titulo').text(data[0].titulo)
    $('.subtitulo').text(data[0].subtitulo)
    $('.fecha').text(data[0].fecha)
    $('.parrafo').text(data[0].parrafo)
    $('.titulo').text(data[0].titulo)
    $('.youtube').attr("href", data[0].youtube)
    $('.spotify').attr("href", data[0].spotify)
    $('.foto').attr("src", data[0].foto);

    if(!data[0].youtube) $('.youtube').hide()
    if(!data[0].spotify) $('.spotify').hide()
});