// A Jquery developed by Viswanadha Kushal Abhishek
// Version 1.0.0
// Release Date 19-12-2014
var months = [ "January", "February", "March", "April", "May", "June", 
               "July", "August", "September", "October", "November", "December" ];
var days = ["Su", "M", "T", "W", "T", "F", "S"];
var d = new Date();
var year = d.getFullYear();
var month = months[d.getMonth()];
var monthNumeric = d.getMonth()+1;
var monthDirect = d.getMonth();
var day = days[d.getDay()];
var date = d.getDate();
var monthYear = ((''+month).length<2 ? '0' : '') + month + '-' + d.getFullYear();
var dateNumber = ((''+date).length<2 ? '0' : '') + date;
$('.calendar-month-year').text(monthYear);
var numberOfDays = Math.round(((new Date(year, monthNumeric))-(new Date(year, monthNumeric-1)))/86400000);
var fd = Date.today().clearTime().moveToFirstDayOfMonth();
var firstday = fd.getDay();
for ( var i = 1 ; i <= numberOfDays ; i++ ) {
	if(i == date){
		  $('.calender-days-header').append("<th class='day-header block active'>"+days[d.getDay()]+"</th>");
		  $('.calender-date').append("<th class='day-header block date active'>"+i+"</th>");
		  firstday++;
	}
	else{	
			if (firstday == 7){
				 firstday = 0;
				 $('.calender-days-header').append("<th class='day-header block sunday'>"+days[firstday]+"</th>");
			 	 $('.calender-date').append("<th class='day-header block date sunday'>"+i+"</th>");
			}
			else{
			$('.calender-days-header').append("<th class='day-header block'>"+days[firstday]+"</th>");
			$('.calender-date').append("<th class='day-header block date'>"+i+"</th>");
			}
			firstday++;
	    }
}
var prevCounter = 1;
var nextCounter = 1;
var currentDay = Date.today();
var firstday = fd.getDay();
var firstDate = fd.getDate();
var currentMonth = fd.getMonth();
var currentYear = fd.getFullYear();
var emp_id;
//function employeeIndividualAttencdence(){
//	alert('hai');
//	emp_id = '#' + $(this).data('emp-id');
//	employeeAttendence(numberOfDays, firstDate, currentMonth, currentYear)
//	return empId(emp_id);	
//}
$('body').on('click','.prev',function(fd){
	    var emp_nav_id = $(this).data('emp-nav-id');
		newYear = d.getFullYear();
		fd = currentDay.add({months: -prevCounter}).clearTime().moveToFirstDayOfMonth();
		firstday = fd.getDay();
		firstDate = fd.getDate();
		currentMonth = fd.getMonth();
		currentYear = fd.getFullYear();
		var numberOfDays = Math.round(((new Date(currentYear, (currentMonth+1)))-(new Date(currentYear, [(currentMonth+1)]-1)))/86400000);
		employeeAttendence(numberOfDays, firstDate, currentMonth, currentYear, emp_nav_id);
		var monthYear =  months[currentMonth] + '-' + currentYear;
		$('.calendar-month-year').text(monthYear);
		$('.calender-days-header').html(" ");
		$('.calender-date').html(" ");
		for ( var i = 1 ; i <= numberOfDays ; i++ ) {	
			  if (firstday == 7){
				   firstday = 0;
				   $('.calender-days-header').append("<th class='day-header block sunday'>"+days[firstday]+"</th>");
				   $('.calender-date').append("<th class='day-header block date sunday'>"+i+"</th>");
			  }
			  else{
				  $('.calender-days-header').append("<th class='day-header block'>"+days[firstday]+"</th>");
				  $('.calender-date').append("<th class='day-header block date'>"+i+"</th>");
			  }
			  firstday++;
		  }
		 // counter++;
		  return fd;
});
$('body').on('click','.next',function(fd){
	var emp_nav_id = $(this).data('emp-nav-id');
	newYear = d.getFullYear();
	fd = currentDay.add({months: nextCounter}).clearTime().moveToFirstDayOfMonth();
	firstday = fd.getDay();
	firstDate = fd.getDate();
	currentMonth = fd.getMonth();
	currentYear = fd.getFullYear();
	var numberOfDays = Math.round(((new Date(currentYear, (currentMonth+1)))-(new Date(currentYear, [(currentMonth+1)]-1)))/86400000);
    employeeAttendence(numberOfDays, firstDate, currentMonth, currentYear, emp_nav_id);
	var monthYear =  months[currentMonth] + '-' + currentYear;
	$('.calendar-month-year').text(monthYear);
	$('.calender-days-header').html(" ");
	$('.calender-date').html(" ");
	for ( var i = 1 ; i <= numberOfDays ; i++ ) {	
		  if (firstday == 7){
			   firstday = 0;
			   $('.calender-days-header').append("<th class='day-header block sunday'>"+days[firstday]+"</th>");
			   $('.calender-date').append("<th class='day-header block date sunday'>"+i+"</th>");
		  }
		  else{
			  $('.calender-days-header').append("<th class='day-header block'>"+days[firstday]+"</th>");
			  $('.calender-date').append("<th class='day-header block date'>"+i+"</th>");
		  }
		  firstday++; 
	  }
	  //counter++;
	  return fd;
});

function employeeAttendence(numberOfDays, firstDate, currentMonth, currentYear, emp_nav_id){
	// ajax in jquery
	    var numberOfDays = Math.round(((new Date(currentYear, (currentMonth+1)))-(new Date(currentYear, [(currentMonth+1)]-1)))/86400000);
		$.ajax({
			type:'POST',
			url:"ajax-attendance.php",
			//dataType:'json',
			data:{day:firstDate,month:currentMonth+1,year:currentYear,noofDays:numberOfDays, empid:emp_nav_id},
			success:function(result){
			    console.log(result);
			$(".result").html(result);
		  }});
		  
		  //no of days calculaton purpose
		  $.ajax({
//alert('test');
			type:'POST',
			url:"ajax-attendance-cal.php",
			data:{day:firstDate,month:currentMonth+1,year:currentYear,noofDays:numberOfDays, empid:emp_nav_id},
			success:function(result1){
		       console.log(result);
			$(".working").html(result1);
		  }});
		  //no of days
   // ajax in jquery
}
		
$('.emp-name').click(function (){		
	 emp_id = $(this).data('emp-id');
	 disp_id = $('.modal-body').find('input');
	 $(disp_id).val(emp_id);
	 var nextBtn = $('.modal-title').find('.cal-arrow-right');
	 var prevBtn = $('.modal-title').find('.cal-arrow-left');
	 $(prevBtn).html('<i class="icon-angle-left prev" data-emp-nav-id="'+emp_id+'"></i>');
	 $(nextBtn).html('<i class="icon-angle-right next" data-emp-nav-id="'+emp_id+'"></i>');
});
