
require(['jquery'],function($){
    $(document).ready(function(){
        $('.product-attachment-container .section-title').click(function(){
            $(this).toggleClass('up');
            $(this).next().slideToggle();
        })
    })
})