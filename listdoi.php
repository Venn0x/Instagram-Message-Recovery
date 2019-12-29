<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JSON Sandbox</title>

    <style>
      .bambuu {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        text-align: left;
        line-height: 1.2;
        letter-spacing: 0.7px;
        padding-right: 50px;
        padding-left: 30px;
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: #fff;
        border: none;
        width: 100%;
      }
      .bambuu:hover{
        background-color: #ccc;
      }
      img {
        border-radius: 50%;
        width: 70px;
      }
      div {   
        line-height: 0;
      }
    </style>
  </head>
  <body>
<div id="salut">
<p>Loading bruhhhh</p>

</div>
    
    <div id="people"></div>
    <script>
      var link = "<?php echo $_GET['link']; ?>"
var myname = "<?php echo $_GET['name']; ?>";
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(xhttp.responseText);
console.log("parse");
            
            var output = '';
document.getElementById('salut').style.display = "block";
            for(var i = 0; i < response.length; i++){

              var conversation = response[i].conversation;
              output = output.concat('<a href=http://localhost/readskema/read/view.php?c='+i+'&name='+myname+'&link='+link+'><button id="but" class=bambuu><img src="http://www.smo.edu.mx/wp-content/uploads/2019/01/person_1058425-1.png" align=left>&nbsp;&nbsp;<font size=3 color=black>');
              output = output.concat(getcoresponder(i));
              
              output = output.concat("</font><br>");
              output = output.concat("<font size=2 color=gray>&nbsp;&nbsp;Messages: ");
              output = output.concat(conversation.length);

              output = output.concat("<br>&nbsp;&nbsp;Last Message: ");
              try {
                output = output.concat(formatdate(response[i].conversation[0].created_at));
              }
              catch(err){
                output = output.concat("Could not read date.");
              }
              output = output.concat("<br>");
              output = output.concat("&nbsp;&nbsp;First Message: ");
              try {
                output = output.concat(formatdate(response[i].conversation[conversation.length - 1].created_at));
              }
              catch(err){
                output = output.concat("Could not read date.");
              }
              
              output = output.concat("</font></button></a><br><br>");
              
              //console.log(getcoresponder(i));
            }            
            //console.log(output);

            //output =+ ''+response.length+'';
             document.getElementById('salut').style.display = "none";
            document.getElementById('people').innerHTML = output;
            function formatdate(hatz){
              //2019-06-23T16:31:29.988713+00:00
              var date = hatz.substring(0, 10);
              var time = hatz.substring(11, 16);
              var secs = hatz.substring(17, 19);
              var ret = '';
              ret = ret.concat(date);
              ret = ret.concat("&nbsp;&nbsp;");
              ret = ret.concat(time);
              ret = ret.concat('<font size=1>:')
              ret = ret.concat(secs);
              ret = ret.concat('</font>');
              return ret;
            }
            /*
            function returnconvFirst(cid) {
              var conversation = response[cid].conversation;
                 
              return response[cid].conversation[conversation.length-1].created_at;
            }
            function returnconvLast(cid) {
              var conversation = response[cid].conversation;
                 
              return response[cid].conversation[0].created_at;
            }
            */
function getcoresponder(i){
                var hm = '';
                for(var x = 0; x < response[i].participants.length; x++){
                  if(response[i].participants[x] != myname){
                      hm = hm.concat(response[i].participants[x]);
                      hm = hm.concat(", ");
                  }
                }
                return hm;
                
              
            }
          }
      };

      xhttp.open("GET",link, true);
      xhttp.send();

    


    </script>
  </body>
</html>
