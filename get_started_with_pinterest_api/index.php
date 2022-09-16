<?php


/// Register your url on https://developers.pinterest.com

define('REDIRECT_URL', ''); ///// Redirect link
define('APP_ID', ''); ///// App id
define('SECRET', ''); ///// App secret key


/////////////
// you can choose scopes you need below
// possible scopes :
// ads:read,boards:read,boards:read_secret,boards:write,boards:write_secret,pins:read,pins:read_secret,pins:write,pins:write_secret,user_accounts:read

$selected_scopes = 'pins:read,pins:write';

///////////

$url = 'https://www.pinterest.com/oauth/?client_id='.APP_ID.'&redirect_uri='.REDIRECT_URL.'&response_type=code&scope=' . $selected_scopes;
$empty_example = array('code' => '...........');

///// First step :
///// get the auth code with scopes


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Get started with Pinterest API v5 Oauth Flow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-4 border-bottom">
    <h1>Get started with Pinterest API v5 Oauth Flow</h1>
  </header>

  <main>

    <div class="row mb-0">
      
        <h2>Step 1</h2>
        <p>Register url on <a target="_blank" href="https://developers.pinterest.com">https://developers.pinterest.com</a></p>
        <p>Don't forget to fill the config variables at the top of the file : </p>

        <pre class="mb-0">
            
        define('REDIRECT_URL', '');
        define('APP_ID', '');
        define('SECRET', '');

        </pre>

    </div>

    <hr class="mb-5">

    <div class="row mb-4">
      
        <h2>Step 2</h2>
        <p>Call this url in your browser : <br/><br/> <a href="<?php echo $url; ?>" target="_BLANK" ><?php echo $url; ?></a></p>
        <p>You should get a response code in return</p>

        <pre class="mb-4"><?php print_r($empty_example); ?></pre>

        <form class="mb-4" action="#" method="get">
          <div>
            <label for="code">Then submit the code here : </label>
            <input name="code" id="code" value="" placeholder="code">
          <input type="submit" value="Submit">
          </div>
        </form>


    </div>

    <hr class="mb-5">

    <div class="row ">
      
        <h2>Step 3</h2>
        <p>Response : </p>

        <?php

          $auth = base64_encode(APP_ID . ':' . SECRET);

          if(isset($_GET['code'])){

            $payload = [
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'redirect_uri'   => REDIRECT_URL
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.pinterest.com/v5/oauth/token");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = [
                'Authorization: Basic {'.$auth.'}',
                'Content-Type: application/x-www-form-urlencoded',
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

            $server_output = curl_exec ($ch);

            curl_close ($ch);

            echo '<pre>';
            print_r(json_decode($server_output, true));
            echo '</pre>';

          }

        ?>

    </div>
  </main>
</div>
  </body>
</html>
