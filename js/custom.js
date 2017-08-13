    $(document).ready(function(){
         $('select').material_select();
  
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

function downloadfunc(title,link) {
 var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        }
    };
   
    xmlhttp.open("GET", "download.php?type=audio&title="+title+"&q=" + link, true);
    xmlhttp.send();
    
}