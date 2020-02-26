//below code is for calculation
var semesters = ['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2'];
    decimal=3;
    function changeGradePoint(element){
        var grade = $('#'+element).find(":selected").val();
        var common_id = element.substring(0,5);
        $('#'+common_id+'gp').text(grade);
        var points = $('#'+common_id+'credit').text();
        //console.log(points);
        $('#'+common_id+'points').text(grade*points);
        calculateTotal(common_id);
    }

    function changeResult(element){
        var p_f = $('#'+element).find(":selected").val();
        var common_id = element.substring(0,5);
        //console.log(p_f);
    }

    function calculateTotal(common_id){
        sum=0;
        common_id = common_id.substring(2,5);
        console.log('common_id='+common_id)
        for(i=1;i<=8;i++){
            console.log(common_id.localeCompare("4-2")==0);
            if(common_id.localeCompare("4-1")==0 && i==8){
                sum+=parseInt($('#'+9+'_'+common_id+'points').text());
                console.log('sum='+sum+' for i=9')
            }
            if(common_id.localeCompare("4-2")==0 && i==5){
                break;
            }
            sum+=parseInt($('#'+i+'_'+common_id+'points').text());
            console.log("sum="+sum+"for i="+i);
            //console.log($('#'+i+'_'+common_id+'points').text());
        }
        $('#'+common_id+'total_points').text('Total= '+sum);
        total_credits = 0;
        for(i=1;i<=8;i++){
            if(common_id.localeCompare("4-1")==0 && i==8){
                total_credits+=parseInt($('#'+9+'_'+common_id+'credit').text());
            }
            if(common_id.localeCompare("4-2")==0 && i==5){
                break;
            }
            total_credits+=parseInt($('#'+i+'_'+common_id+'credit').text());
        }
        sgpa = sum/total_credits;
        console.log('total_credits='+total_credits);
        $('#'+common_id+'sgpa').text('SGPA= '+sgpa.toFixed(decimal));
        //console.log('sgpa='+sgpa);
        percent = ((sgpa-0.5)*10).toFixed(2);
        console.log(percent);
        $('#'+common_id+'percentage').html('<b>'+common_id+'%</b>= '+((sgpa-0.5)*10).toFixed(decimal));
        indx = semesters.indexOf(common_id);
        data[indx].y=parseFloat(percent);
        updateChart(data);
        calculateCgpa(common_id);
    }
    function calculateCgpa(sem){
        indx = semesters.indexOf(sem);
        console.log(indx);
        cixsi=0;
        no_of_sem=0;
        sgpa=0;
        for(i=indx;i>=0;i--){
            sgpa+= parseFloat($('#'+semesters[i]+'sgpa').text().substring(6));            
            //console.log(parseFloat($('#'+semesters[i]+'sgpa').text().substring(6))+'='+sgpa);
            no_of_sem+=1;
        }
        cixsi = sgpa/no_of_sem;
        $('#'+sem+'cgpa').text('CGPA= '+cixsi.toFixed(decimal));
        percentage = (cixsi-0.5)*10;
        //console.log(sgpa+'/'+no_of_sem+'='+cixsi);
        $('#'+sem+'overall_percentage').html('overall (<b>from 1-1 to '+sem+'</b>) %= '+percentage.toFixed(decimal));

    }
    function pdf() {
      window.print();
    }
$(document).ready(function() {
    $('#staticBackdrop').modal('show');
});
