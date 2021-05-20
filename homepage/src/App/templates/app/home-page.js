// início do script
$().ready(function(){
    $.get(filmes,null,function(response){
        $('#filmes').html(response);
    });
    $.get(video,null,function(response){
        $('#video').html(response);
    });
    $.get(conta,null,function(response){
        $('#conta').html(response.html);
        var linkPrivacidade = response.links.privacidadeLink;
        var linkPagamento = response.links.pagamentoLink;
        var linkPreferencias = response.links.preferenciasLink;
        $('#privacidade_button').click(function(){
        	$.get(linkPrivacidade,null,function(response){
                $('#conta').html(response);
            });        	
        });
        $('#pagamento_button').click(function(){
        	$.get(linkPagamento,null,function(response){
                $('#conta').html(response);
            });        	
        });
        $('#preferencias_button').click(function(){
        	$.get(linkPreferencias,null,function(response){
                $('#conta').html(response);
            });        	
        });        
    });
});    
