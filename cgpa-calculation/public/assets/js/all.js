//below code is for calculation
var semesters = ['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2'];
    decimal=3;
    function changeGradePoint(element){
        console.log("****changeGradePoint()****");
        var grade = $('#'+element).find(":selected").val();
        var common_id = element.substring(0,5);
        $('#'+common_id+'gp').text(grade);
        var points = $('#'+common_id+'credit').text();
        //console.log(points);
        $('#'+common_id+'points').text(grade*points);
        console.log("****changeGradePoint() end****");
        calculateTotal(common_id);
    }

    function changeResult(element){
        console.log("****changeResult()****");
        var p_f = $('#'+element).find(":selected").val();
        var common_id = element.substring(0,5);
        //console.log(p_f);
        console.log("****changeResult() end****");
    }

    function calculateTotal(common_id){
        console.log("****calculateTotal()****");
        sum_of_credit_secured=0;
        common_id = common_id.substring(2,5);
        console.log('common_id='+common_id)        
        console.log('length for '+common_id+'='+$('.'+common_id+' tr').length)
        for(i=1;i<=$('.'+common_id+' tr').length-2;i++){           
            console.log($('#'+i+'_'+common_id+'points').text());
            sum_of_credit_secured+=parseInt($('#'+i+'_'+common_id+'points').text());
            //console.log("sum_of_credit_secured="+sum_of_credit_secured+"for i="+i);
            //console.log($('#'+i+'_'+common_id+'points').text());
        }
        $('#'+common_id+'total_points').text('Total= '+sum_of_credit_secured);
        total_credits = 0;
        for(i=1;i<=$('.'+common_id+' tr').length-2;i++){
            total_credits+=parseInt($('#'+i+'_'+common_id+'credit').text());
        }
        sgpa = sum_of_credit_secured/total_credits;
        console.log('total_credits='+total_credits);
        $('#'+common_id+'sgpa').text('SGPA= '+sgpa.toFixed(decimal));
        console.log('sgpa='+sgpa);
        percent = ((sgpa-0.5)*10).toFixed(2);
        console.log(percent);
        $('#'+common_id+'percentage').html('<b>'+common_id+'%</b>= '+((sgpa-0.5)*10).toFixed(decimal));
        indx = semesters.indexOf(common_id);
        data[indx].y=parseFloat(percent);
        updateChart(data);       
        console.log("****calculateTotal() end****");
        calculateCgpa();
    }
    function calculateCgpa(){
        console.log("****calculateCgpa()****");                
        total_credits=0;
        total_secured_points=0;
        for(i=0;i<8;i++){
            console.log("======"+semesters[i]+"=======")
            sgpa= parseFloat($('#'+semesters[i]+'sgpa').text().substring(6));
            total_credits+=parseInt($('#'+semesters[i]+'total_credits').text().substring(6));
            total_secured_points+=parseInt($('#'+semesters[i]+'total_points').text().substring(6));
            cgpa = (total_secured_points/total_credits).toFixed(decimal)
            console.log("sgpa="+sgpa)
            console.log("total_credits="+total_credits)
            console.log("total_secured_points="+total_secured_points)
            console.log("cgpa="+cgpa)
            $('#'+semesters[i]+'cgpa').text('CGPA= '+cgpa);
            percentage = (cgpa-0.5)*10;
            $('#'+semesters[i]+'overall_percentage').html('overall (<b>from 1-1 to '+semesters[i]+'</b>) %= '+percentage.toFixed(decimal));
            console.log("======"+semesters[i]+" end=======")
        }        
        console.log("****calculateCgpa() end****");
    }    
    function pdf() {
      window.print();
    }
$(document).ready(function() {
    $('#staticBackdrop').modal('show');
});
