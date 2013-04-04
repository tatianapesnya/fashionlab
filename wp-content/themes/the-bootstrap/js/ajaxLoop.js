// ajaxLoop.js  
jQuery(function($){  
    var page = 1;  
    var loading = true;  
    var $window = $(window);  
    var $content = $('body #content.ajax');  
    var load_posts = function(){  
            $.ajax({  
                type       : "GET",  
                data       : {numPosts : 3, pageNumber: page},  
                dataType   : "html",  
                url        : "http://localhost/fashionlab/wp-content/themes/the-bootstrap/loopHandler.php",  
                beforeSend : function(){  
                },  
                success    : function(data){  
                    $data = $(data);  
                    $data.hide();  
                    $content.append($data);  
                    $data.fadeIn(500,function(){
                    	loading = false;
                    	console.log('fini');
                    });  
                },  
                error     : function(jqXHR, textStatus, errorThrown) {  
                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);  
                }  
        });  
    }  
        $('#loadmore').click(function() {
         event.preventDefault(); 
        var content_offset = $content.offset();  
        console.log(content_offset.top);  
        if(!loading) {
                loading = true;  
                page++;  
                load_posts();  
        }  
    });  
    load_posts(); 
}); 