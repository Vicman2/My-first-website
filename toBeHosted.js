$(function(){
	$(".head").hide().slideDown(900);
	$(".months").hide();
	$date = new Date;
	$month = $date.getMonth();
	$monthId = "#" +$month;
	$($monthId).fadeIn(1500);
	$(".description").addClass("list-group-item");
	
});