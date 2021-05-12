// início do script
$().ready(function(){
    $.get(filmes,null,function(response){
        $('#filmes').html(response);
    });
    $.get(video,null,function(response){
        $('#video').html(response);
    });
    $.get(conta,null,function(response){
        $('#conta').html(response);
    });
});    
