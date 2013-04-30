// ajaxLoop.js  
jQuery(function($){  
    var page = 1;  
    var loading = true;  
    var $window = $(window);  
    var $content = $('body #content.ajax');  
    var load_posts = function(){  
            $.ajax({  
                type       : "GET",  
                data       : {numPosts : 8, pageNumber: page},  
                dataType   : "html",  
                url        : templateDir+"/loopHandler.php?lang="+currLang,  
                beforeSend : function(){  
                },  
                success    : function(data){  
                    //console.log('data :'+data );
                    /*var $data = $(data);                      
                    $data.hide(); 
                    $content.append($data);  
                    $data.fadeIn(500,function(){
                        loading = false;
                    });  */
                    $content.append(data);  
                    data.fadeIn(500,function(){
                        loading = false;
                    });  
                },  
                error     : function(jqXHR, textStatus, errorThrown) {  
                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);  
                }  
        });  
    }  
    $('#loadmore').click(function() { 
        var content_offset = $content.offset();  
        if(!loading) {
                loading = true;  
                page++;  
                load_posts();  
        }  
        return false;
    });  
    load_posts(); 
}); 