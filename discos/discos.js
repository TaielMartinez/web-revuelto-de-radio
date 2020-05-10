document.addEventListener('DOMContentLoaded', function() {

    $.ajax({
        url: "../api/v1/discos",
        method: "GET",
    }).done(function(data) {
        data = JSON.parse(data)
        console.log(data)

        htmlPropia = "";
        hemltRemoendados = "";

        for (let index = 0; index < data.length; index++) {
            let html = `
            <div class="card ml-5 mr-5 mt-5 mb-5" style="width: 13rem;">
            <a href="../disco/?e=`+data[index].id+`" style="color: black">
            <img src="`+data[index].foto+`" alt="" style="width:100%">
            <div class="container_card text-center">
              <p>`+data[index].titulo+`</p>
            </div>
            </a>
          </div>
            `;

            if(data[index].producionPropia){
                htmlPropia += html;
            } else {
                hemltRemoendados += html;
            }
            
        }
        console.log(hemltRemoendados)
        $('.disco_propia').html(htmlPropia);
        $('.disco_recomendada').html(hemltRemoendados);

        function click(id){
            console.log(id)
        }

    }).fail(function(){
    });
});