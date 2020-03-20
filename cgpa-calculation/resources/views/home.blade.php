
@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/all.css')}}">
@endsection('css')
@section('js')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="{{url('assets/js/all.js')}}"></script>
  <script type="text/javascript">
    function clickRef(name){
    $.ajax({url: "updateTrack?name="+name+"&id="+'{{$user_id}}', success: function(result){
        console.log(name);
    }});
}
    data = [
      { label: "1-1", y: 0 },
      { label: "1-2", y: 0 },
      { label: "2-1", y: 0 },
      { label: "2-2", y: 0 },
      { label: "3-1", y: 0 },
      { label: "3-2", y: 0 },
      { label: "4-1", y: 0 },
      { label: "4-2", y: 0 } 
    ];
window.onload = function () {
 updateChart(data);
}

function updateChart(data) {
    var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light1",
  title: {
    text: "{{$name}}'s Overall Performance"
  },
  axisY: {
    suffix: "%",
    maximum: 100
  },
  data: [{
    type: "column",
    yValueFormatString: "##00.00\"%\"",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontColor: "white",
    dataPoints: data
  }]
});
chart.render();
console.log(data);
}
console.log(data[0].label);
</script>
@endsection('js')
@section('content')
    <div class="container" style="padding-top: 20px;">
        <h2 class="d-flex justify-content-center">Calculate JNTUH B.Tech {{$course}} Grades</h2>
        <hr>
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">How to Calculate?</button>
  <div id="demo" class="collapse">
    <ol style="padding-top: 5px;">
            <li>select grades you have secured in <b>grade secured</b> column.</li>
            <li><b>SGPA</b>,<b>CGPA</b>,<b>Percentages</b> will be calculated automatically on any changes in grades.</li>
            <li>Any changes made in semester grades, percentage will be calculated till that semester.</li>            
        </ol>
  </div><br><br>
  <ol>
  <li><b>NOTE</b>: Enter Details in series wise else percentage will get calculated wrong</li>
      <li><em style="color:tomato;">IF ANY DETAILS FOUND INCORRECT PLEASE REPORT(SCREENSHOT WOULD BE HELPFULL) </em><mark><a href="mailto:omarmd2311@gmail.com?Subject=Error Report" target="_blank">HERE &#128512;</a></mark></li>
      </ol>
        <h6></h6>
          @if(count($all_sem_records['1-1'])==0)
              <h2 class="d-flex justify-content-center">No Data found for selected regulation</h2>
          @endif
        @foreach($all_sem_records as $sem => $value)
        <?php $c=0;?>
            <h2 class="d-flex justify-content-center">{{$sem}}</h2>
            <hr>
            <table class="table table-bordered table-responsive {{$sem}}" style="display: table;">
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
                <td id="{{$sem}}overall_percentage">overall(<b>from 1-1 to {{$sem}}</b>) %= </td>
                <td id="{{$sem}}percentage"> <b>{{$sem}}</b> % = </td>
                <td colspan="1" id="{{$sem}}sgpa">SGPA= 10</td>
                <td id="{{$sem}}total_credits">Total= 24</td>
                <td id="{{$sem}}total_points">Total= 240</td>
              </tr>
          </tbody>
        </table>
    @endforeach
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <div align="center" style="padding-bottom: 20px;"><button onclick="pdf();">Save AS PDF/Print</button></div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <footer class="footer-distributed">

            <div class="footer-right">
                <div style="color: wheat;"><p>Contact:</p>
                <span>Name: Mohammed Omar</span><br>
                <span>Mobile: <a href="tel:+917396331635">73963331635</a></span><br>                
              </div>
              <a href="https://wa.me/917396331635" target="_blank" onclick="clickRef('whatsapp');"><i class="fa fa-whatsapp"></i>
                <a href="https://www.facebook.com/omar.7396" target="_blank" onclick="clickRef('facebook');"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/Md_omar7" target="_blank" onclick="clickRef('twitter');"><i class="fa fa-twitter"></i></a>
                <a href="https://www.linkedin.com/in/omar739/" target="_blank" onclick="clickRef('linkedin');"><i class="fa fa-linkedin"></i></a>
                <a href="https://github.com/omar630" target="_blank" onclick="clickRef('github');"><i class="fa fa-github"></i></a>
                <!-- Button trigger modal -->
</div>
            </div>

            <div class="footer-left">
              <div class=""><span style="color: white;">Visitor's Count:&emsp;</span>
                @foreach($visitor_count as $count)
                  <span class="counter">{{$count}}</span>
                  @endforeach
              </div>
                <p class="footer-links">
                    <a href="mailto:omarmd2311@gmail.com?Subject=Suggestion" target="_top">Any Query? Contact Us</a><br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="margin-top: 15px;">
  Provide Feedback
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center"> <i class="far fa-file-alt fa-4x mb-3 animated rotateIn icon1"></i>
        <h3>Your opinion matters</h3>
                <h5><strong>Give us your feedback.</strong></h5>
                <hr>
                <h6>Your Rating</h6>
            </div> <!-- Radio Buttons for Rating-->            
            <div class="form-check mb-4"> <input name="feedback" type="radio" value="5"> <label class="ml-3">Very good</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio" value="4" checked=""> <label class="ml-3">Good</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio" value="3"> <label class="ml-3">Mediocre</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio" value="2"> <label class="ml-3">Bad</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio" value="1"> <label class="ml-3">Very Bad</label> </div>
            <!--Text Message-->
            <div class="text-center">
                <h4>What could we improve?</h4>
            </div> <textarea type="textarea" placeholder="Your Message" rows="3" id="message"></textarea> <!-- Modal Footer-->
      <div class="modal-footer">
        <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" data-dismiss="modal" id="feedback_form">Send <i class="fa fa-paper-plane"></i></button>
      </div>
    </div>
    </div>
  </div>
                </p>

                <p class="d-flex justify-content-center">omarsblog.gq&copy; 2020</p>
            </div>

        </footer>
@section('js')        
<script type="text/javascript">
      $("#feedback_form").click(function() {
        v = $("input[name='feedback']:checked").val();
      m = $('#message').val();
        $.ajax({
            type: "GET",
            dataType:'json',
            data: {value:v,name:'{{$name}}',message: m},
            url : "/submitFeedback",
            success : function (data) {
            }
        });
    });
</script>
@endsection('js')
@endsection