<!doctype html>
<html lang="en">
  <head>
    <style>
      body {
        background-color : LemonChiffon;
      }

      .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
        border-radius: 5px;
      }

      .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      }

      img {
        border-radius: 5px 5px 0 0;
      }

      .container {
        padding: 2px 16px;
      }
    </style>
  </head>

  <body>

    
    <p style="text-align:center">&nbsp;</p>

    <p style="text-align:center"><strong><span style="font-size:48px">Corporate Town Hall Event</span></strong></p>

    <p style="text-align:center"><span style="font-size:36px">{{ $location->name }}</span></p>

    <p style="text-align:center">&nbsp;</p>

    <p style="text-align:center"><span style="font-size:20px">Scan QR berikut</span></p>

    <p style="text-align:center"><img alt="" src="https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;chl={{ $url }}&amp;choe=UTF-8" style="height:300px; width:300px" /></p>

  </body>

</html>
