<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: School Education
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>School Education</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="{{ asset('/template/css/styles.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('/frontend/layout/styles/layout.css')}}" type="text/css" />
<script type="text/javascript" src="{{asset('/frontend/layout/scripts/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/frontend/layout/scripts/jquery.slidepanel.setup.js')}}"></script>
<!-- Homepage Only Scripts -->
<script type="text/javascript" src="{{asset('/frontend/layout/scripts/jquery.cycle.min.js')}}"></script>
<script type="text/javascript">
$(function() {
    $('#featured_slide').after('<div id="fsn"><ul id="fs_pagination">').cycle({
        timeout: 5000,
        fx: 'fade',
        pager: '#fs_pagination',
        pause: 1,
        pauseOnPagerHover: 0
    });
});
</script>
<!-- End Homepage Only Scripts -->
</head>
<body>
<div class="wrapper col0">

</div>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><a href="index.html">School Education</a></h1>
      <p>Free Website Template</p>
    </div>
    <div id="topnav">
      <ul>
        <li class="active"><a href="/">Home</a></li>
        <li><a href="{{route("home.timetable")}}">Timetable</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="featured_slide">
    <div class="featured_box"><a href="#"><img src="{{asset('/template/assets/img/high-school3.jpg')}}" alt="" /></a>
      <div class="floater">
        <h2>1. Aliquatjusto quisque nam</h2>
        <p>Orcimagna rhoncus et a nec antesque sed temportor pellus nibh conseque. Accumstsemper wisi pretium feugiat non ut eleifendrerisque at et condisse sce. Iaculumorci congue nam mollis odio id cras orci vestique euisquet at. Donecconsectetus lacilis ac pellus nam nibh curabitur sed anterdum nectetus adipis. Pretiummagnisse antes nunc pretium convallis tincidunt non at rutrumt.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
    </div>
    <div class="featured_box"><a href="#"><img src="{{asset('/template/assets/img/high-school3.jpg')}}" alt="" /></a>
      <div class="floater">
        <h2>2. Aliquatjusto quisque nam</h2>
        <p>Duisvest lacus pellus purus temper maurisus et sodalesuada loreet sapiente et. Quissociis magnisl orci dui nulla ut antesque malesuada sed pede et. Idlacus ridiculisi nec cursus enim ac tur urnar nunc pellus pellenterdum. Necelisi aliquat curabiturpiscing semportortor sed et velit convallis quat adipiscing cursus. Rutrumeget id ipsum et sed maurisuspendimentum auctor siti.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
    </div>
    <div class="featured_box"><a href="#"><img src="{{asset('/template/assets/img/high-school3.jpg')}}" alt="" /></a>
      <div class="floater">
        <h2>3. Dapiensociis temper donec</h2>
        <p>Pharetiumurna habitur et enim pellentesque phasellus aliquam nunc quis justo nam. Lobortororci dapibulum ac intesquet ut id sed intesque nec alique congue. Liberoaenec vest maurisus libero pede nisl ligula cursus vitae dis metus. Aeneanaccumsan orci nasce ac pulvinare enim tor quis antesque cumsan in. Justomontesque sem ac dolor iaculum dolor orci elit lacus et vestibulum.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
    </div>
    <div class="featured_box"><a href="#"><img src="{{asset('/template/assets/img/high-school3.jpg')}}" alt="" /></a>
      <div class="floater">
        <h2>4. Dapiensociis temper donec</h2>
        <p>Pharetiumurna habitur et enim pellentesque phasellus aliquam nunc quis justo nam. Lobortororci dapibulum ac intesquet ut id sed intesque nec alique congue. Liberoaenec vest maurisus libero pede nisl ligula cursus vitae dis metus. Aeneanaccumsan orci nasce ac pulvinare enim tor quis antesque cumsan in. Justomontesque sem ac dolor iaculum dolor orci elit lacus et vestibulum.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
    </div>
    <div class="featured_box"><a href="#"><img src="{{asset('/template/assets/img/high-school3.jpg')}}" alt="" /></a>
      <div class="floater">
        <h2>5. Nullain convallis ris elis</h2>
        <p>Nullamcorpervivamus nisl in sed adipit donec feugiat lor vel velit volutpat. Wisihabitur diculisi ac curabitur cursuspendreris sociis sed eger ipsum condisse laculis. Curabiturid non eu curabitae nibh por nullamcorper at nibh elis fring. Vestnibh congue praesenenatis justo et maecenasceleifend senterdum malesuada at dolor amet. Turisristibulum curabitae eros leo at interd.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="homecontent">
    <!--Section-->
    <section>
        <h3>Section</h3>
        <div class="">
            <form method="POST" >
                @csrf
                <div class="row mb-3">
                    <div class="col-3">
                        <div class=" mb-3 ">
                            <select class="form-control @error('section_id') is-invalid @enderror" name="section_id" id="section-search">
                                <option selected>Choose...</option>
                                @foreach ($sections as $s)
                                    <option value="{{$s->id}}">{{$s->grade->name}}-Section-{{$s->name}}  {{$s->grade->academic_year->yearOne}} </option>
                                @endforeach
                            </select>
                            @error('section_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="mt-4 mb-0">
                    <div class="d-grid">  </div>
                </div>
            </form>
        </div>
        <div class="section-table row" id="section-table" >

        </div>  
    </section>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="footer">
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <div class="footbox last">
      <h2>Lacus interdum</h2>
      <ul>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li><a href="#">Praesent et eros</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
        <li><a href="#">Suspendisse in neque</a></li>
        <li class="last"><a href="#">Praesent et eros</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2014 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <br class="clear" />
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src=" {{ asset("/template/js/datatables-simple-demo.js") }} "></script>
<script>
  $("#section-search").on("change", function() {
      console.log($(this).val());

      let id = $(this).val();
      if(id != "Choose...")
      {
          $.get("{{route('searchsection')}}", {section_id:id}, function(res) {
              //console.log(res);
              $("#section-table").html(res);
          }).fail(function(err) {
              console.log(err);
          });
      }
      else
      {
          $("#section-table").html('');
      }

  });
</script>
</body>
</html>