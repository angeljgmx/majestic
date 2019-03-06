jQuery(document).ready(function($) {
    "use strict";
	
	/* PrettyPhoto Script
    ======================================================*/
    $('a[data-rel]').each(function () {
        $(this).attr('rel', $(this).data('rel'));
        $(".pretty-gallery a[rel^='prettyPhoto']").prettyPhoto();
    });
	
	/*SIDEBAR NAV
	======================================================*/
    if ($('#tl_side-menu-btn, #tl-close-btn').length) {
        $('#tl_side-menu-btn, #tl-close-btn').on('click', function(e) {
            var $navigacia = $('body, #tl_side-menu'),
                val = $navigacia.css('right') === '410px' ? '0px' : '410px';
            $navigacia.animate({
                right: val
            }, 410)
        });
    }



    /*STICKY HEADER
	======================================================*/
    if($('#cp_header-v1').length){
        // grab the initial top offset of the navigation 
        var stickyNavTop = $('#cp_header-v1').offset().top;
        // our function that decides weather the navigation bar should have "fixed" css position or not.
        var stickyNav = function(){
            var scrollTop = $(window).scrollTop(); // our current vertical position from the top
            // if we've scrolled more than the navigation, change its position to fixed to stick to top,
            // otherwise change it back to relative
            if (scrollTop > stickyNavTop) { 
                $('#cp_header-v1').addClass('cp_sticky');
            } else {
                $('#cp_header-v1').removeClass('cp_sticky'); 
            }
        };

        stickyNav();
        // and run it again every time you scroll
        $(window).scroll(function() {
            stickyNav();
        });
    }

    /*Home Banner
    ======================================================*/
    if ($('#home-slider').length) {
        $('#home-slider').owlCarousel({
            loop:true,
            dots: true,
            nav:true,
            navText:'',
            items:1,
            autoplay: false,
            smartSpeed:2000,

        });
    }

    


    /* Owl Slider For Featured Section
    ======================================================*/
    if ($('#cp-time-slider').length) {
        $('#cp-time-slider').owlCarousel({
            loop:true,
            dots: false,
            nav:false,
            navText:'',
            items:4,
            smartSpeed:500,
            margin:0,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                768:{
                    items:2,
                },
                1199:{
                    items:4,
                }
            }
        });
    }
	
	/* PrettyPhoto Script
    ======================================================*/
    $('a[data-rel]').each(function () {
        $(this).attr('rel', $(this).data('rel'));
        $(".pretty-gallery a[rel^='prettyPhoto']").prettyPhoto();
    });
	
    if ($('.gallery').length) {
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000,
            autoplay_slideshow: true
        });
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast',
            slideshow: 10000,
            hideflash: true
        });
    }
	

});

	
	/* Event Counter
    ======================================================*/
//    if ($(".defaultCountdown-event-1").length) {
//        var austDay = new Date();
//        austDay = new Date(2020, 10 - 10, 19);
//        jQuery('.defaultCountdown-event-1').countdown({
//            labels: ['Years', 'Months', 'Weeks', 'Days', 'Hrs', 'Min', 'Sec'],
//            until: austDay
//        });
//        jQuery('#year').text(austDay.getFullYear());
//    }
	

    /* Contact Map
    ======================================================*/
    if ($('#map_contact_1').length) {
        var map;
        var myLatLng = new google.maps.LatLng(40.712784, -74.005941);
        //Initialize MAP
        var myOptions = {
            zoom: 12,
            center: myLatLng,
            //disableDefaultUI: true,
            zoomControl: true,
			scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            styles: [{
                stylers: [{
                    hue: '#2b2b2b'
                }, {
                    saturation: -100,
                }, {
                    lightness: 10
                }]
            }],
        }
        map = new google.maps.Map(document.getElementById('map_contact_1'), myOptions);
        //End Initialize MAP
        //Set Marker
        var marker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            icon: 'images/map-icon-2.png'
        });
        marker.getPosition();
        //End marker

        //S// content: '',
        // position: myLatLng
        //});
        //infowindow.open(map);
    }	



