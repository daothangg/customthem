 require(['jquery'],function($){
        $(document).ready(function(){
            var $window = $(window);

            function checkWidth() {

                var windowsize = $window.width();
                if (windowsize < 992) {
                   
                $('.col-title.col-1').click(function(){
                        $('.col-title.col-1').toggleClass('up');
                        $('.col-title.col-1').next().slideToggle();
                    })
                    $('.title-ft').click(function(){
                        $(this).toggleClass('up');
                        $(this).next().slideToggle();
                    })
                }
            }
            
            checkWidth();
           
        })

    })