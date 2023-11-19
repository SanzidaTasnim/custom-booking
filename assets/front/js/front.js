jQuery(function($){

    $(document).ready(function () {

        $(".cbs-room").hide();

        $('#calendar').datepicker({
            inline:true,
            firstDay: 1,
            showOtherMonths:true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        });

        //This is for hour picker
        var maxActiveCount = 4;
        var activeCount = 0;

        $(".hour-picker").on( "click", ".cbs-hour", function () {
            var room = $(this).find('.cbs-room');
            room.toggle();
            //exclude disable element I mean previes booked
            if (!$(this).hasClass("disable")) {
                //if click on the same hour
                if($(this).attr("data") === "true") {
                    $(this).removeClass("active");
                    $(this).removeAttr('data');
                    activeCount--;
                }else if(activeCount < maxActiveCount){
                    $(this).attr("data", "true");
                    activeCount++;
                    $(this).addClass("active");
                }
            }
        });
        $('#btn').on('click', function() {
            
            // Retrieve the text or value of active children
            let activeChildren = $(".cbs-hour[data='true']");
            if (activeChildren.length > 0) {
                activeChildren.each(function () {
                    let value = $(this).text();
                    console.log(value);
                });
            }else{
                console.log("Please select a hour");
            }
            
            let date = $('#calendar').val();
            console.log(date);
        });
    });
    

});