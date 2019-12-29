<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
    .message {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      
      color: black;
      padding: 8px;
      
      text-decoration: none;
      //display: inline-block;
      font-size: 11px;
      margin: 2px 2px;
      
    }
.you{
  border-left: 4px solid blue;
  background-color: #f0f0f0;
}
.him{
  border-left: 4px solid red;
  background-color:  #f0f0f0;
}
.youx {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      
      color: lightblue;
      padding: 1px;
      
      //text-decoration: bold;
      //display: inline-block;
      font-size: 8px;
      
      font-weight: bold;
    }
  .himx {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      
      color: pink;
      padding: 1px;
      
      //text-decoration: bold;
      //display: inline-block;
      font-size: 8px;
      
      font-weight: bold;
    }
    .media {
  display: inline-block;
  border-radius: 10px;
  background-color: light-gray;
  border: none;
  color:gray;
  text-align: center;
  font-size: 11px;
  padding: 2px;
  width: 170px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
.likem {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      
      color: gray;
      padding: 8px;
      
      font-size: 8px;
      margin: 2px 2px;
      
    }
  </style>
  </head>
  <body>

    <div id="people"></div>

    <script>
      var link = "<?php echo $_GET['link']; ?>"
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(xhttp.responseText);
            var myname = "<?php echo $_GET['name']; ?>"
            var output = '';
            var i = "<?php echo $_GET['c']; ?>";
            output = output.concat(returnconvID(i));
            
            //console.log(i);

            //output =+ ''+response.length+'';
             
            document.getElementById('alt').innerHTML = getcoresponder(i);

            document.getElementById('people').innerHTML = output;

            function returnconvID(cid) {
              var ret = ' '; 
              var conversation = response[cid].conversation;
              var lastn = " ";
              for(var x = conversation.length - 1; x >= 0; x--){
                var descris = " ";

                if(response[cid].conversation[x].text) descris =response[cid].conversation[x].text;
                if(response[cid].conversation[x].story_share) descris += " <i>("+response[cid].conversation[x].story_share+")</i>";
                if(response[cid].conversation[x].heart) descris += response[cid].conversation[x].heart;
                if(response[cid].conversation[x].media) descris += " <a href='"+response[cid].conversation[x].media+"' target='_blank'><button class='media'>Media (May be expired if is old)</button></a>";
                if(response[cid].conversation[x].media_owner) descris += " <a href='"+response[cid].conversation[x].media_share_url+"' target='_blank'><button class='media'>Shared post (May be expired)</button></a>";
                if(response[cid].conversation[x].voice_media) descris += "<i>(Voice message) - Unavailable</i>";
                if(response[cid].conversation[x].likes){ 
                    descris += " <span class='likem'>❤";
                    for(var laik = 0; laik < response[cid].conversation[x].likes.length; laik++) descris += response[cid].conversation[x].likes[laik].username + " ";
                    descris += "</span>";

                }
                if(lastn != response[cid].conversation[x].sender) ret = ret.concat('</div><br>'); 
                if(response[cid].conversation[x].sender == myname){ 
                  if(lastn != response[cid].conversation[x].sender) ret = ret.concat('<div class="message you"><div class ="youx">'+response[cid].conversation[x].sender+'</div>'+descris);
                  else ret = ret.concat('<br>'+descris);
                }
                else{
                  if(lastn != response[cid].conversation[x].sender) ret = ret.concat('<div class="message him"><div class ="himx">'+response[cid].conversation[x].sender+'</div>'+descris);
                  else ret = ret.concat('<br>'+descris);
                }
                lastn = response[cid].conversation[x].sender;
              }
              ret = ret.concat(' ');
              return ret;
            }
            function getcoresponder(i){
              if(response[i].participants[0] == myname) return response[i].participants[1];
              else return response[i].participants[0];
            }

          }
      };
      
      xhttp.open("GET", link, true);
      xhttp.send();

    </script>
<title id='alt'></title>
  </body>
</html>
