$('.carousel').carousel({
  interval: 3000
})

  $.ajax({
    url: "/api/v1/discos/ultimo.php",
    method: "GET",
  }).done(function(data) {
    console.log(data)
    $('.nuevo_img_discos').attr("src", data);
  });

  $.ajax({
    url: "/api/v1/events/ultimo_img.php",
    method: "GET",
  }).done(function(data) {
    console.log(data)
    $('.nuevo_img_agenda').attr("src", data);
  });