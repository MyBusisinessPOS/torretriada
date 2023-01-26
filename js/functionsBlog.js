
$(document).ready(function(){
    if($('.contenido-general').length > 0){
        listarBlog(1);
    }
});

$(document).on('click','.paginador li',function(){
    var page = $(this).data('page');
    busqueda = '';
    listarBlog(page);
});
    ///// CATEGORIA /////
$(document).on('click','.categoria',function(){
    $('.categoria').removeClass('active');
    var idCat = $(this).data('id');
    console.log(idCat);
    $(this).addClass('active');
    idCategoria = idCat;
    busqueda = '';
    listarBlog(1);
});
$(document).on('change','#filtroSort',function(){
    order = $('#filtroSort').val();
    console.log(order);
    listarBlog(1);
});
$(document).on('change','#filtroAnos',function(){
    anos = $('#filtroAnos').val();
    console.log(anos);
    listarBlog(1);
});
    ///// BUSCADOR /////
$(document).on('keyup','#busqueda',function(){
    busqueda = $('#busqueda').val();
    idCategoria=0;
    $('.categoria').removeClass('active');
    listarBlog(1);
});
function listarBlog(_pagina){
    $.ajax({
        async : true,
        type : "POST",
        dataType : "html",
        contentType : "application/x-www-form-urlencoded",
        url : PATH+"controller/controller.php",
            data : {
            "idCategoria" : idCategoria,
            "order" : order,
            "anos"  : anos,
            "busqueda": busqueda,
            "operaciones" : 'listarBlogs',
            "pagina" : _pagina,
            "lang" : LANG
        },
        success : getInformationBlog,
        beforeSend : SendInformationBlog,
        cache : false
    });
}
function getInformationBlog(data) {
    console.log(data);
    var _response = JSON.parse(data);
    $(".listaBlog").empty();
    $(".listaBlog").append(_response[0]._html).fadeIn(1000);
    $(".paginador").html(_response[0]._paginador);

    setTimeout(function(){
        $('.listaBlog .item').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });
    },200);
}

function SendInformationBlog() {
    $(".listaBlog").html("<center><i class='fa fa-spinner fa-pulse'></i>");
}
