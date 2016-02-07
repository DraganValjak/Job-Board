jQuery.noConflict()(function($){
	$(document).ready(function() {
         
			// Create the dropdown bases
			$("<select />",{
                          "class": 'nav_mobile'})
                          .not(".category").appendTo(".navigation div");
				
			// Create default option "Go to..."
			$("<option />", {
                            "class": 'nav_mobile',
			   "selected": "selected",
			   "value"   : "",
			   "text"    : "Idi na..."
			}).appendTo("div select");
				
				
			// Populate dropdowns with the first menu items
			$(".navigation div li a").each(function() {
			 	var el = $(this);
			  $("<option />", {
                                    
                                "class": 'nav_mobile',
			     	"value"   : el.attr("href"),
			    	"text"    : el.text()
			 	}).appendTo("div select");
			});
                       
                       // brišemo objekt option iz kategorija, sve zbog menija 
                       // kod mobilnh uređaja
                        $('select.category').find('option.nav_mobile').remove();
			
			//make responsive dropdown menu actually work			
	      	$("div select").not('.category').change(function() {
	        	window.location = $(this).find("option:selected").val();
	      	});

		});
		});		
/***************************************************
			TOP TOGGLE PANEL
***************************************************/
jQuery.noConflict()(function($){
$(document).ready(function() {
$('.toggle').click(function () {
    $('.panel').slideToggle('5000',"swing", 
        // Animation complete.
         function(){
	        $('.toggle').toggleClass('hide-panel');
			      }   
		    );
		});
	});
});

/***************************************************
			SUPER FISH MENU
***************************************************/
jQuery.noConflict()(function($){
$(document).ready(function() {
   $("ul.sf-menu").superfish({ 
            pathClass:  'current',
			autoArrows	: false,
			delay:300,
			speed: 'normal',
			animation:   {opacity:'show'}
        }); 
    });
});


/***************************************************
					Flickr
***************************************************/
	
	
/* Major Colorbox */
jQuery.noConflict()(function($){
$(document).ready(function() {	
	$('a.zoom').colorbox();
	$('.mask a[data-rel="zoom-img"]').colorbox();
});
});	

/* Sidebar widget */
jQuery.noConflict()(function($){
$(document).ready(function() {	
	$('#cbox-sidebar').jflickrfeed({
		limit: 9,
		qstrings: {
			id: '47257185@N03'
		},
		itemTemplate: '<li>'+
						'<a rel="colorbox" href="{{image_b}}" title="{{title}}">' +
							'<img src="{{image_s}}" alt="{{title}}" />' +
						'</a>' +
					  '</li>'
	}, function(data) {
		$('#cbox-sidebar a').colorbox();
	});
});
});


/***************************************************
					Twitter
***************************************************/
jQuery.noConflict()(function($){
$(document).ready(function() {
	  /*---- Sidebar Twitter ----*/
	  $("#twitter-widget .tweet").tweet({
        	count: 3,
        	username: "envato",
        	loading_text: "loading twitter..."      
		});
});
});



/***************************************************
			jCarousel
***************************************************/
jQuery.noConflict()(function($){
var $zcarousel = $('#projects-carousel, #posts-carousel, #clients-carousel');

    if( $zcarousel.length ) {

        var scrollCount;
        var itemWidth;

        if( $(window).width() < 479 ) {
           		scrollCount = 1;
            	itemWidth = 300;
        	} else if( $(window).width() < 768 ) {
            	scrollCount = 2;
            	itemWidth = 200;
        	} else if( $(window).width() < 960 ) {
            	scrollCount = 3;
            	itemWidth = 172;
        	} else {
            	scrollCount = 4;
            	itemWidth = 230;
        }

        $zcarousel.jcarousel({
			   easing: 'easeInOutQuint',
        	   animation : 800,
               scroll    : scrollCount,
               setupCallback: function(carousel) {
               carousel.reload();
                },
                reloadCallback: function(carousel) {
                    var num = Math.floor(carousel.clipping() / itemWidth);
                    carousel.options.scroll = num;
                    carousel.options.visible = num;
                }
            });
        }
});           