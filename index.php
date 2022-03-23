<?php

//$url = "https://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid=e75a63304f3c48c0c0cd698ca4621951";

$search = '';
if(!empty($_REQUEST['city'])) {
  if (isset($_REQUEST['btn']) ){ 
        
        $search = urlencode($_REQUEST['city']);
        $city = $_REQUEST['city'];

        $url = "http://api.openweathermap.org/data/2.5/weather?q=$search&appid=e75a63304f3c48c0c0cd698ca4621951";

        $data = file_get_contents($url);

        $weatherArray = json_decode($data, true);

        if ($weatherArray['cod'] == 200) {
        
            $weather = "The weather in ".$city." is currently '".$weatherArray['weather'][0]['description']."'. ";

            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

            $weather .= " The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";
            
        } else {
            
            $error = "Could not find city - please try again.";
            
        }

        //$description = $response_data['weather'][0]['description'];

        //print_r($response_data);
    //}
    }
} else if (empty($_REQUEST['city']) && isset($_REQUEST['btn'])){

        $error = 'Invalid! You cannot submit an empty form. Kinldy enter a valid city name';
        
    }

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer/">

    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">

    <title>Weather App</title>

    <style type="text/css">
    html {
        background: url(./Images/scape.jpg) no-repeat center center fixed;
        background-size: cover;
        position: relative;
        min-height: 100%;
    }

    body {
        background: none;
        color: white;
        margin-bottom: 60px;
        /* Margin bottom by footer height */
    }

    .container {
        text-align: center;
        margin-top: 200px;
        width: 450px;
    }

    .containerr {
        width: auto;
        text-align: center;
        /* max-width: 680px; */
        padding: 0 15px;
    }

    input {
        margin: 20px 0;
    }

    .alert {
        margin: 20px 0;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        /* Set the fixed height of the footer here */
        line-height: 60px;
        /* Vertically center the text there */
        background-color: #f5f5f5;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>What's the Weather?</h1>

        <!-- Form -->
        <form>
            <div class="mb-3">
                <label for="city" class="form-label">Enter the name of a city</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="E.g. London, Tokyo">
            </div>
            <button type="submit" class="btn btn-primary" name="btn">Submit</button>
        </form>

        <div id="weather">
            <?php 
              
              if ($weather) {
                  
                  echo '<div class="alert alert-success" role="alert"> '.$weather.'</div>';
                  
              } else if ($error) {
                  
                  echo '<div class="alert alert-danger" role="alert"> '.$error.'</div>';
                  
              }
              
              ?>
        </div>
    </div>

    <footer class="footer">
        <div class="containerr">
            <span class="text-muted">Weather app built by Semeton Balogun &copy; 2022</span>
        </div>
    </footer>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>