let url = $(location).attr('href');
let id = url.split("?e=")[1];

console.log(id)


$.ajax({
    url: "../api/v1/events/get_one.php",
    method: "POST",
    data: {id : id}
}).done(function(data) {
    console.log(data)
    $('.nuevo_img_discos').attr("src", data);
});