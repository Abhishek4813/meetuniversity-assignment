<script src="https://ajax.googleapis.com/ajax/libs/d3js/5.7.0/d3.min.js"></script>
<script src="./assets/js/jquery.min-1.72.js"></script>
<script>
$(function(){

  var totalHeight = 0;

  $('.message>div').each(function(index,ele){

    totalHeight += $(ele).outerHeight(true);
  });
  console.log(totalHeight);
  $('.message').scrollTop(totalHeight);
});

</script>

    <h2> 
      <?php
        if(isset($_GET['wid']) && isset($_GET['cid'])) {
          $wid = $_GET['wid'];
          $cid = $_GET['cid'];
          $channelNameQuery = mysqli_query($con, "SELECT channelname FROM Channel WHERE cid = '$cid'");
          echo mysqli_fetch_array($channelNameQuery)['channelname'];
        }else{
          echo "";
        }
      ?>
   </h2>
  <div id="message">
    <?php
      if(isset($_GET['wid']) && isset($_GET['cid'])) {
          $messageQuery = mysqli_query($con, "select nickname, username, content, messageTime from Message NATURAL JOIN User natural join Channel WHERE cid =".$cid ." and fromId = uId  order by messageTime asc");
          while($row = mysqli_fetch_array($messageQuery)) {
            if($row['username'] != $userLoggedIn) {
              echo "
              <div id='messageHead'>
                <p>not from me: ".$row['content']."</P>
              </div>
              ";
            } else{
              echo "<p>from me: ".$row['content']."</p>";
            }
          }
      }else{
        echo "";
      }   
    ?>
  </div>
  
  

</html>
