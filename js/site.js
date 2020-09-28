
function handleChange(cb) {
  if (cb.checked == true) {
    document.getElementById("sidebar").style.left = "0em";
  } else {
    document.getElementById("sidebar").style.left = "-19em";
  }
}

window.onresize = function rs() {
  var cb = document.getElementById("toggle");
  if (window.matchMedia("(max-width: 1000px)").matches && cb.checked == false) {
    document.getElementById("sidebar").style.left = "-20em";
  }
  if (window.matchMedia("(min-width:1000px)").matches && cb.checked == true) {
    document.getElementById("sidebar").style.left = "0em";
    cb.checked = false;
  }
  if (window.matchMedia("(min-width:1000px)").matches && cb.checked == false) {
    document.getElementById("sidebar").style.left = "0em";
  }
  if(window.matchMedia("(max-width:1000px)").matches) {
    $(".sort_controls_wrapper").css('transform',"translateY(-135px)");
  }
  if(window.matchMedia("(min-width:1000px)").matches) {
    $(".sort_controls_wrapper").css('transform',"none");
  }
}

/*$("#all").click( function() {
  $(".type-1").show();
  $(".type-2").show();
});
$("#movies").click( function() {
  $(".type-1").hide();
  $(".type-2").show();
});
$("#series").click( function() {
  $(".type-2").hide();
  $(".type-1").show();
});*/

$('#sidebar, .md-overlay, .md-modal, .sort_controls_wrapper, .search-container').bind('mousewheel DOMMouseScroll', function(e) {
    var scrollTo = null;

    if (e.type == 'mousewheel') {
        scrollTo = (e.originalEvent.wheelDelta * -1);
    }
    else if (e.type == 'DOMMouseScroll') {
        scrollTo = e.originalEvent.detail * 0;
    }

    if (scrollTo) {
        e.preventDefault();
        $(this).scrollTop(scrollTo + $(this).scrollTop());
    }
});

$('.sort').click(function() {
    var attrval = $(this).attr('data-sort');
    var sep = $(this).attr('data-sort').indexOf(':');

    if ( $(this).attr('data-sort').indexOf('asc') > -1 ) {
        attrval = attrval.substring(0,sep+1);
        var newattrval = [attrval.slice(0, sep), ":desc"].join('');
        $(this).attr('data-sort', newattrval);
        $(this).removeClass('active');
        $('.togglethis', this).toggleClass('fa-arrow-up');
        $('.togglethis', this).toggleClass('fa-arrow-down');
    } else if ($(this).attr('data-sort').indexOf('desc') > -1) {
        attrval = attrval.substring(0,sep+1);
        var newattrval = [attrval.slice(0, sep), ":asc"].join('');
        $(this).attr('data-sort', newattrval);
        $(this).removeClass('active');
        $('.togglethis', this).toggleClass('fa-arrow-up');
        $('.togglethis', this).toggleClass('fa-arrow-down');
    }
});

$('.sort').click(function() {
    $('.bytime', this).toggleClass('newest');
    $('.bytime', this).toggleClass('oldest');
});

$('.sort_puller').click(function() {
  $(".sort_controls_wrapper").toggleClass('pulled');
  $('.togglepuller', this).toggleClass('fa-chevron-up');
  $('.togglepuller', this).toggleClass('fa-chevron-down');
});

$('#search').click(function() {
  if ( $('.search-container').css('display') == 'none' )
    $('.search-container').show();
  else
    $('.search-container').css('display','none');
});

$('.overlay').click(function() {
  if ( $('.search-container').css('display') == 'block' )
    $('.search-container').hide();
});

$('.search-close').click(function() {
  if ( $('.search-container').css('display') == 'block' )
    $('.search-container').hide();
});

var count_media=$('.media_container').length;

if (count_media < 4) {
  $('#content').css('width','82%');
}

if (count_media < 7) {
  $('.search_message').css('text-align','left');
}