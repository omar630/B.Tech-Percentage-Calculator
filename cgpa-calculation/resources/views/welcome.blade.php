<!DOCTYPE html>
<html>
<head>
    <title>Calculate B.Tech Percentage</title>
        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/all.css')}}">
</head>
<body>
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