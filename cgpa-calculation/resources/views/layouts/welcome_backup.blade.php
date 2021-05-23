<!DOCTYPE html>
<html>
<head>
    <title>Calculate B.Tech Percentage</title>
        <!-- Required meta tags -->
    <meta charset="utf-8">
<link rel="apple-touch-icon" sizes="180x180" href="{{url('assets/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('assets/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/img/favicon-16x16.png')}}">
    <link rel="mask-icon" href="{{url('assets/img/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/all.css')}}">
    <script data-ad-client="ca-pub-2758895778992235" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
    <!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button>
-->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: initial;padding: 10px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Enter Details</h5>
      </div>
      <form class="form-group has-error" id="myForm" action="{{url('submitDetails')}}" method="get">
      <div class="modal-body">        
            <div class="form-group">
                <label class="control-label" for="firstname">Name</label>
                <input type="text" class="form-control required" id="firstname" name="name" required="true" autocomplete="off" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
            </div>
      <div class="form-group col-md-3 mb-3">
        <label>Regulation</label>
          <select class="custom-select" name="regulation">          
            <option value="R16">R16</option>
              <option value="R17">R17</option>
              <option value="R18">R18</option>
            </select>
        </div>
        <div class="form-group col-md-5 mb-3">
            <label>Stream</label>
          <select class="custom-select" name="branch"> 
            <option value="CSE">CSE</option>
	    <option value="ECE">ECE</option>
            <option value="IT">IT</option>
            <option value="MECH">MECH</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-secondary">    
      </div>
  </form>
    </div>
  </div>
</div>
    <div class="container" style="padding-top: 20px;">
        <h2 class="d-flex justify-content-center">Calculate B.Tech Grades</h2>
        <hr>
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">How to Calculate?</button>
  <div id="demo" class="collapse">
    <ol style="padding-top: 5px;">
            <li>select grades you have secured in <b>grade secured</b> column.</li>
            <li><b>SGPA</b>,<b>CGPA</b>,<b>Percentages</b> will be calculated automatically on any changes in grades.</li>
            <li>Any changes made in semester grades, percentage will be calculated till that semester.</li>
        </ol>
  </div>
        <h6></h6>
        
        @foreach($all_sem_records as $sem => $value)
        <?php $c=0;?>
            <h2 align="center">{{$sem}}</h2>
            <hr>
            <table class="table table-responsive">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Subject</th>
              <th scope="col">Grades Secured</th>
              <th scope="col">Grade Point<sub>G<sub>i</sub></sub></th>
              <th scope="col">Credits<sub>C<sub>i</sub></sub></th>
              <th scope="col">Points<sub>(G<sub>i</sub>xC<sub>i</sub>)</sub></th>
            </tr>
          </thead>
          <tbody>
            @foreach($value as $key => $subject)
                <tr>
                  <th scope="row">{{++$c}}</th>
                  <td id='{{$c}}_{{$sem}}subject'>{{$subject->name}}</td>
                  <td>          
                    <select id="{{$c}}_{{$sem}}gs" onchange="changeGradePoint(this.id);">
                      <option value="10">O</option>
                      <option value="9">A<sup>+</sup></option>
                      <option value="8">A</option>
                      <option value="7">B<sup>+</sup></option>
                      <option value="6">B</option>
                      <option value="5">C</option>
                      <option value="0">F</option>
                    </select>
                  </td>
                  <td id="{{$c}}_{{$sem}}gp">10</td>      
                  <td id="{{$c}}_{{$sem}}credit">{{$subject->credit}}</td>
                  <td id="{{$c}}_{{$sem}}points">{{$subject->credit*10}}</td>
                </tr>              
            @endforeach
            <tr>
                <td id="{{$sem}}cgpa">CGPA= 100</td>                
                <td id="{{$sem}}overall_percentage">overall %= </td>
                <td id="{{$sem}}percentage"> % = </td>
                <td colspan="1" id="{{$sem}}sgpa">SGPA= 10</td>
                <td id="{{$sem}}total_credits">Total= 24</td>
                <td id="{{$sem}}total_points">Total= 240</td>
              </tr>
          </tbody>
        </table>
    @endforeach
    <div align="center" style="padding-bottom: 20px;"><button onclick="pdf();">Save AS PDF/Print</button></div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <footer class="footer-distributed">

            <div class="footer-right">

                <a href="https://www.facebook.com/omar.7396" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/Md_omar7" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://www.linkedin.com/in/omar739/" target="_blank"><i class="fa fa-linkedin"></i></a>
                <a href="https://github.com/omar630" target="_blank"><i class="fa fa-github"></i></a>

            </div>

            <div class="footer-left">

                <p class="footer-links">
                    <a href="mailto:omarmd2311@gmail.com?Subject=Suggestion" target="_top">contact</a>
                </p>

                <p class="d-flex justify-content-center">omarsblog.gq&copy; 2020</p>
            </div>

        </footer>


Resources

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('assets/js/all.js')}}"></script>
</body>
</html>