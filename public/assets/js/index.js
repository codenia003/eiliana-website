// skills sliders
$(document).ready(function() {
    new WOW().init();
    $('#myStat3').circliful();
    $('#myStat4').circliful();
    $('#myStat5').circliful();
    $('#myStat6').circliful();
    //accordians tab panels toggle buttons
    $('.collapse').on('shown.bs.collapse', function() {
        $(this)
            .parent()
            .find('.fa-plus')
            .removeClass('fa-plus')
            .addClass('fa-minus');
    })
    .on('hidden.bs.collapse', function() {
        $(this)
            .parent()
            .find('.fa-minus')
            .removeClass('fa-minus')
            .addClass('fa-plus');
    });
    var slide = Math.floor(Math.random() * 5) + 1
    // console.log(slide);
    $('.slick-carousel').slick({
        "slidesToShow": 1,
        "slidesToScroll": 1,
        "nextArrow": "<span class=\"fa fa-angle-right slick-arrow slick-arrow-soft-white slick-arrow-right slick-arrow-centered-y rounded-circle mr-sm-2 mr-xl-4\"></span>",
        "prevArrow": "<span class=\"fa fa-angle-left slick-arrow slick-arrow-soft-white slick-arrow-left slick-arrow-centered-y rounded-circle ml-sm-2 ml-xl-4\"></span>",
        "dots": false,
        "draggable": true,
        "autoplay": true,
        "autoplaySpeed": 5000,
        "arrows": true,
        "speed": 500,
        "fade": true,
        "infinite": true,
        "cssEase": 'ease-in-out',
        "initialSlide": slide,
        "responsive": [{
            "breakpoint": 768,
            "settings": {
                "slidesToShow": 1,
                "arrows": false
            }
        }]
    });

    $('.multiple-carousel').slick({
        "slidesToShow": 4,
        "slidesToScroll": 4,
        "nextArrow": "<span class=\"fa fa-angle-right slick-arrow slick-arrow-soft-white slick-arrow-right slick-arrow-centered-y rounded-circle mr-sm-2 mr-xl-4\"></span>",
        "prevArrow": "<span class=\"fa fa-angle-left slick-arrow slick-arrow-soft-white slick-arrow-left slick-arrow-centered-y rounded-circle ml-sm-2 ml-xl-4\"></span>",
        "dots": false,
        "infinite": true,
        "responsive": [{
            "breakpoint": 768,
            "settings": {
                "slidesToShow": 1,
                "slidesToScroll": 1,
                "arrows": false
             }
        }]
    });
    $('.multiple-three-carousel').slick({
        "slidesToShow": 2,
        "slidesToScroll": 2,
        "nextArrow": "<span class=\"fa fa-angle-right slick-arrow slick-arrow-soft-white slick-arrow-right slick-arrow-centered-y rounded-circle mr-sm-2 mr-xl-4\"></span>",
        "prevArrow": "<span class=\"fa fa-angle-left slick-arrow slick-arrow-soft-white slick-arrow-left slick-arrow-centered-y rounded-circle ml-sm-2 ml-xl-4\"></span>",
        "dots": false,
        "infinite": true,
        "responsive": [{
            "breakpoint": 768,
            "settings": {
                "slidesToShow": 1,
                "slidesToScroll": 1,
                "arrows": false
             }
        }]
    });
});
var win = window,
    doc = document,
    docElem = doc.documentElement,
    body = doc.getElementsByTagName('body')[0],
    x = win.innerWidth || docElem.clientWidth || body.clientWidth,
    y = win.innerHeight|| docElem.clientHeight|| body.clientHeight;
console.log(x + ' × ' + y);
