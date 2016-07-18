$(document).ready(function(){
	
	$(".connect").click(function(){
		if($(".hubstaff-form").css("display") == "none")
			$(".hubstaff-form").show();
		else
			$(".hubstaff-form").hide();
	});	
	$(document).mouseup(function (e)
	{
	    var container = $(".hubstaff-form");
	
	    if (!container.is(e.target) && container.has(e.target).length === 0)
	    {
	        container.hide();
	    }
	});

        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });

});
