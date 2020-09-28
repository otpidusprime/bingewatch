<!DOCTYPE html>
<?php require_once('connectvars.php'); ?>
<?php
if ( empty($_GET['q'])  && strlen($_GET['q']) == 0 )
{
    header('Location: index.php');
    exit;
}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#212333">

    <title>bingewatch</title>
    <link rel="stylesheet" href="fonts/font-awesome-4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>

<!--SIDEBAR-->
<div id="sidebar">
  <div class="nav-elements">

    <a href="index.php" class="link">
      <h1 class="logo">
        <span style="color:#25CDEA;">binge</span><span style="color:#15EBCD;font-weight:300;">watch</span>
      </h1>
    </a>

    <!--SIDEBAR LINKS-->
    <div class="links_wrap">
      <a class="sb_link" href="javascript:void(0);" id="search"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Search</a>
      <a class="sb_link filter" href="javascript:void(0);" id="all" data-filter="all"><i class="fa fa-th-large" aria-hidden="true"></i> &nbsp;All</a>
      <a class="sb_link filter" href="javascript:void(0);" id="movies" data-filter=".category-2"><i class="fa fa-film" aria-hidden="true"></i> &nbsp;Movies</a>
      <a class="sb_link filter" href="javascript:void(0);" id="series" data-filter=".category-1"><i class="fa fa-tv" aria-hidden="true"></i> &nbsp;TV Shows</a>
      <!--<a class="sb_link" href="javascript:void(0);"><i class="fa fa-play" aria-hidden="true"></i> &nbsp;Web Series</a>
      <a class="sb_link" href="javascript:void(0);"><i class="fa fa-film" aria-hidden="true"></i> &nbsp;Short Films</a>-->
    </div>
    <!--END SIDEBAR LINKS-->

  </div>
</div>
<!--END SIDEBAR-->

<!--MOBILE HEADER-->
<header id="header">
  <div class="mobile_logo">
    <h1>
        <span style="color:#25CDEA;">binge</span><span style="color:#15EBCD;font-weight:300;">watch</span>
    </h1>
  </div>

  <input type="checkbox" name="toggle" id="toggle" onchange='handleChange(this)' unchecked>
  <label for="toggle"></label>
</header>
<!--END MOBILE HEADER-->

<!--SORT CONTROLS-->
<div class="sort_controls_wrapper">
  <div class="sort_title">
    SORT BY
  </div>
  <button class="sorting_controls sort" id="recent" data-sort="bytime:asc">
  <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;
  <span class="bytime newest">NEWEST</span>
  <span class="bytime oldest" style="padding-right: 5px;">OLDEST</span>
  </button>
  <button class="sorting_controls" id="random" onClick="$('#content').mixItUp('sort', 'random');"><i class="fa fa-random" aria-hidden="true"></i> &nbsp;RANDOM</button>
  <button class="sorting_controls sort" id="name" data-sort="byname:asc"><i class="fa fa-arrow-up togglethis" aria-hidden="true"></i> &nbsp;NAME</button>
  <div class="break_on_mobile"></div>
  <button class="sorting_controls sort" id="type" data-sort="bytype:desc"><i class="fa fa-arrow-down togglethis" aria-hidden="true"></i> &nbsp;TYPE</button>
  <button class="sorting_controls sort" id="rating" data-sort="byrating:asc"><i class="fa fa-arrow-up togglethis" aria-hidden="true"></i> &nbsp;RATING</button>
  <button class="sorting_controls sort" id="year" data-sort="byyear:asc"><i class="fa fa-arrow-up togglethis" aria-hidden="true"></i> &nbsp;YEAR</button>
  <div class="break_on_mobile"></div>
  <button class="sort_puller"><i class="fa fa-chevron-down togglepuller" aria-hidden="true"></i></button>
</div>
<!--END SORT CONTROLS-->

<!--CONTENT WRAPPER-->
<div id="content">

          <!--GRID LOOP ADD DATA-->
  <?php
              $search_query=$_GET["q"];
              $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

              $query = "SELECT * FROM `media` WHERE Concat(md_name, md_rating, md_year) LIKE '%$search_query%' ORDER BY md_name ASC";

              /*if ($_GET['type'] == 'null')
              {
                  $query .= " ORDER BY md_name ASC";
              }
              elseif ($_GET['type'] == '1')
              {
                  $query .= " WHERE md_type=1 ORDER BY md_name ASC";
              }
              elseif ($_GET['type'] == '2')
              {
                  $query .= " WHERE md_type=2 ORDER BY md_name ASC";
              }*/

              $result = mysqli_query($dbc, $query);
              $counter = mysqli_num_rows($result);
              $name_id = 1;

              if ($counter != 0) {
                echo '<div class="search_message">'.$counter.' result(s) found for "<span class="bolded">'.$search_query.'</span>"</div>';
              }
              else {
                echo '<div class="search_message">No results found for "<span class="bolded">'.$search_query.'</span>"</div>';
              }

              echo '            <div class="media_grid">
                    <div class="section group">
                    ';
                while($row = mysqli_fetch_array($result))
                {
                  echo '
                        <div class="col span_1_of_6 mix category-'.$row['md_type'].'" data-byname="'.$name_id.'" data-bytype="'.$row['md_type'].'" data-byrating="'.$row['md_rating'].'" data-bytime="'.$row['mid'].'" data-byyear="'.$row['md_year'].'">

                        <div class="media_container">
                        <div class="media_poster md-trigger" data-modal="modal-'.$row['mid'].'">
                          <img src="'.$row['md_poster'].'" title="'.$row['md_name'].'">
                        </div>
                        <div class="media_info">
                          <div class="media_name" title="'.$row['md_name'].'">'.$row['md_name'].'</div>
                          <div class="media_rating">
                            <div class="rating">IMDb<br/>'.$row['md_rating'].'/10</div>
                            <div class="rating">'.$row['md_seasons'].'</div>
                          </div>
                        </div>
                        </div>

                        </div>

                        ';
                        $name_id++;
                }
              echo '</div>
                    </div>
                    ';
              mysqli_close($dbc);
  ?>
<!--GRID LOOP ADD DATA-->

</div>
<!--END CONTENT WRAPPER-->
            <!--GRID LOOP ADD DATA-->
<?php
            $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            $query = "SELECT * FROM `media` order by md_rating DESC";
            $result = mysqli_query($dbc, $query);
            $counter = mysqli_num_rows($result);
            $player_id = 1;

            echo '                ';
              while($row = mysqli_fetch_array($result))
              {
                echo '<div class="md-modal md-effect-3" id="modal-'.$row['mid'].'">
                        <div class="md-content">
                        <div class="media_modal_wrap">
                        <div class="section group">
                        <div class="col remove_margin span_2point5">
                          <div class="media_modal_poster"><img src="'.$row['md_poster'].'"></div>
                        </div>
                        <div class="col remove_margin span_3point5">
                        <div id="media_trailer">
                          <iframe class="trailers" id="trailer_video'.$player_id.'" width="560" height="349" src="'.$row['md_trailer'].'?enablejsapi=1&html5=1&rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="media_modal_info">
                          <div class="info_title">DESCRIPTION</div>
                          <div class="info_text">'.$row['md_desc'].'</div>
                          <div class="buttons_area">
                          <button href="#" class="media_button green_bg" id="media_icon_play">
                            <i class="fa fa-play" aria-hidden="true"></i>
                            <span class="hide_on_mobile"> &nbsp;WATCH NOW</span>
                          </button>
                          <span class="show_on_mobile">WATCH NOW</span>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                  </div>

                  ';
                $player_id++;
              }
            mysqli_close($dbc);
?>
<!--GRID LOOP ADD DATA-->

<div class="md-overlay" id="md-overlay"><button class="md-close" id="md-close">×</button></div>

<!--SEARCH-->
<div class="search-container">
<div class="overlay"></div>
    <button class="search-close" id="search-close">×</button>
<div class="search-area">
<div class="site-search">
    <input type="text" class="search" id="searchid" placeholder="Search Movies &amp; TV Shows" autocomplete="off" />
    <div id="result"></div>
</div>
</div>
</div>
<!--END SEARCH-->

<!--ERROR MESSAGE-->
<div id="error_msg">
  Sorry <i class="fa fa-frown-o" aria-hidden="true"></i>
  <br/> Your screen resolution is too low!
  <br/>

  <div class="error_logo">
    <span style="color:#25CDEA;">binge</span><span style="color:#15EBCD;font-weight:300;">watch</span>
  </div>
</div>
<!--END ERROR MESSAGE-->

<!--SCRIPTS-->
<script src='js/jquery-2.2.2.min.js'></script>
<script src='js/modernizr.min.js'></script>
<script src='js/classie.js'></script>
<script src='js/modalEffects.js'></script>
<script src="js/jquery.mixitup.min.js"></script>
<script src="js/site.js"></script>
<script>
  $(function(){
    $('#content').mixItUp({
      animation: {
    		enable: false
    	},
    	callbacks: {
    		onMixLoad: function(){
    			$(this).mixItUp('setOptions', {
            animation: {
              enable: true,
          		effects: 'fade translateX(100%)',
          		reverseOut: true,
              easing: 'cubic-bezier(0.655, 0.000, 0.415, 1.000)'
          	},
    			});
    		}
    	}
    });
  });
</script>
<script type="text/javascript">
    $(function(){
    $(".search").keyup(function()
    {
    var searchid = $(this).val();
    var dataString = 'search='+ searchid;
    if(searchid!='')
    {
        $.ajax({
        type: "POST",
        url: "search.php",
        data: dataString,
        cache: false,
        success: function(html)
        {
          $("#result").html(html).show();
        }
        });
    }else
    {
      $("#result").css('display','none');
    }return false;
    });
    jQuery("#result").live("click",function(e){
        var $clicked = $(e.target);
        var $name = $clicked.find('.name').html();
        var decoded = $("<div/>").html($name).text();
        $('#searchid').val(decoded);
    });
    jQuery(document).live("click", function(e) {
        var $clicked = $(e.target);
        if (! $clicked.hasClass("search")){
        jQuery("#result").fadeOut();
        }
    });
  });
</script>
<!--END SCRIPTS-->

  </body>
</html>
