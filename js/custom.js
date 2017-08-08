    $(document).ready(function(){
       $("#searchlink").hide();

        $("#search").click(function(){
            $("#searchlink").hide();
            $("#searchvideo").show();
        });

        $("#download").click(function(){
            $("#searchvideo").hide();
            $("#searchlink").show();
        });

    });