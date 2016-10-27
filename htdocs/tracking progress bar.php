<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="C:\Users\Alan\Desktop\PBTest.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>

<div class="container">
  <h2>Package Status</h2>
  <p>Track the status of your package. Green indicates current package status.</p>
  <div class="progress">
    <div class="progress-bar progress-bar-1" role="progressbar" style="width:25%;background:silver" id="step-1">
      Order Processed
    </div>
    <div class="progress-bar progress-bar-2" role="progressbar" style="width:25%;background:silver" id="step-2">
      Preparing for Delivery
    </div>
    <div class="progress-bar progress-bar-3" role="progressbar" style="width:25%;background:silver" id="step-3">
      Out for Delivery
    </div>
    <div class="progress-bar progress-bar-4" role="progressbar" style="width:25%;background:silver" id="step-4">
      Delivered
    </div>
  </div>
</div>
</body>

<script type="text/javascript">
    
    // Get current time
    var a = new Date().getTime();
    
    // Basic function for updating progress bar
    // Should pass variable(compare order time with current time?) into this function to change the progress bar status
    // Possibly use calculated time from Google Map API to increment progress bar
    function progress() {

        var b = new Date().getTime();

        // Changes progress bar depending on difference in milliseconds
        // Currently hard-coded times for testing
        if ((b - a < 10000) && ((b-a) >= 0)) {
          document.getElementsByClassName('progress-bar-1')[0].style.backgroundColor="green";
        } 
        else if ((b - a > 10000) && (b - a < 20000)) {
          document.getElementsByClassName('progress-bar-2')[0].style.backgroundColor="green";
        } 
        else if ((b - a > 20000) && (b - a < 30000)) {
          document.getElementsByClassName('progress-bar-3')[0].style.backgroundColor="green";
        }
        else if ((b - a > 30000) && ((b - a) < 40000)) {
          document.getElementsByClassName('progress-bar-4')[0].style.backgroundColor="green";
        } 
        else {
          // Change them all back / reset
          document.getElementsByClassName('progress-bar-1')[0].style.backgroundColor="silver";
          document.getElementsByClassName('progress-bar-2')[0].style.backgroundColor="silver";
          document.getElementsByClassName('progress-bar-3')[0].style.backgroundColor="silver";
          document.getElementsByClassName('progress-bar-4')[0].style.backgroundColor="silver";
          return;
        }

    }
    
    
    // Testing the progress() function
    // Calls progress() every 5 seconds to update progress bar
    setInterval(function() {
      progress();
    }, 5000);


/* BLINKING EFFECT <INCOMPLETE>
    if(document.getElementsByClassName('progress-bar-4')[0].style.backgroundColor=="blue") {
      changeColors(document.getElementsByClassName('progress-bar-4'));
    }
    else if(document.getElementsByClassName('progress-bar-3')[0].style.backgroundColor=="green") {
      changeColors(document.getElementsByClassName('progress-bar-3'));
    }
    else if(document.getElementsByClassName('progress-bar-2')[0].style.backgroundColor=="green") {
      changeColors(document.getElementsByClassName('progress-bar-2'));
    }
    else {
      changeColors(document.getElementsByClassName('progress-bar-1'));
    }

    var x, y, z;

    function changeColors(y) {
      x = 1;
      setInterval(change(y), 1000);
    }

    function change(z) {
      if (x === 1) {
        z[0].style.backgroundColor = "white";
        x = 2;
      } else {
        z[0].backgroundColor = "green";
        x = 1;
      }
      z[0].style.backgroundColor = "green";
    }
*/
</script>
</html>

