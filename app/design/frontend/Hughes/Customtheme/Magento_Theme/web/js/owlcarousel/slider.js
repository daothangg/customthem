require(['jquery', 'owlcarousel'], function($) {
    $(document).ready(function() {
        $('.block-recent-posts').owlCarousel({
              loop:true,
            autoplay:true,
            margin:15,
            nav:false,
            responsiveClass:true,
            navText:['',''],
            responsive: {
                0: {
                  items: 1
                },
                600: {
                  items: 2
                },
                1000: {
                  items: 3
                }
            }
        });
    });
});
 $(document).ready(function(){
  $(".nav-sections").click(function(){
    $(".navigation").show();
  });
});