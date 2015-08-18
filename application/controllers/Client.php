<?php
  require('twitteroauth/autoload.php');
  use Abraham\TwitterOAuth\TwitterOAuth;
  //require('twitteroauth/src/TwitterOAuth.php');

  class Client extends CI_Controller
  {
    var $config;
    function __construct()
    {
      parent::__construct();
    }
    function index()
    {
      //$this->get_localhost();
      $tokens = array(
        "consumer_key" => "nI5mbQJ90srwBDIPGBrAIUphJ",
        "consumer_key_secret" => "EMubqMnZNuIIy6echinNa7uXd3xM67jfyZ6SmPiiXkUUdcCApb",
        "access_token" => "38682087-3RjO1RdEQpAmnt5rzwhiFiWKsCACQKY1zHfPYpAkF",
        "access_token_secret" => "gl4WAIpTRSFnld6kJxaD68pcn9IyEEJzGQO4z7r3TR1zm",
      );

      $connection = new TwitterOAuth($tokens["consumer_key"],$tokens["consumer_key_secret"],$tokens["access_token"],$tokens["access_token_secret"]);
      $data = $connection->post("oauth2/token");
      $timeline = $connection->get("statuses/user_timeline",array("screen_name" => "aldouswright"));
      echo "<pre>";
      echo "<ul>";
      foreach ($timeline as $tweet)
      {
        echo "<li>".$tweet->text."</li>";
      }
      echo "</ul>";
      print_r($timeline);
      echo "</pre>";
      die();



    }

    function get_localhost()
    {
      /*
      $config = array(
        'server' => 'http://localhost:8888/restful_apis/index.php/api_sample/',
        'http_user' => 'admin',
        'http_pass' => '1234',
        'http_auth' => 'basic' ,
      );
      $this->load->library('rest',$config,'json');
      $user = $this->rest->get('api_sample/user',array('id'=>'27'),'application/json');
      var_dump($user);
      */

    }

    //consumer secret: EMubqMnZNuIIy6echinNa7uXd3xM67jfyZ6SmPiiXkUUdcCApb

    function get_twitter()
    {
      $this->load->library('rest');


      $config = array(
        "server" => 'https://api.twitter.com/',
        "http_user" => "aldouswright",
        "http_pass" => "091190",
      );


      $this->rest->initialize($config);
      //$this->rest->post('oauth/token',);


      $vars = array(
        "count" => "2",
        "screen_name" => "aldouswright",

        /*
        "count" => "2",
        "oauth_consumer_key" => "nI5mbQJ90srwBDIPGBrAIUphJ",
        "oauth_nonce" => "4f74d777e5a2e449578ac39340da514b",
        "oauth_signature" => "6Mj0hWAvTC0%2FaeuYe6tIXGKlRbg%3D",
        "oauth_signature_method" => "HMAC-SHA1",
        "oauth_timestamp" => "1439632692",
        "oauth_token" => "38682087-3RjO1RdEQpAmnt5rzwhiFiWKsCACQKY1zHfPYpAkF",
        "oauth_version" => "1.0",
        //"screen_name" => "twitterapi",*/
      );


      $header = 'OAuth oauth_consumer_key="nI5mbQJ90srwBDIPGBrAIUphJ", oauth_nonce="882c0dc47709ef4b484449a983254830", oauth_signature="%2B0%2FdC0%2FsMak6Cimqh8s2F0YPg%2FY%3D", oauth_signature_method="HMAC-SHA1", oauth_timestamp="1439645174", oauth_token="38682087-3RjO1RdEQpAmnt5rzwhiFiWKsCACQKY1zHfPYpAkF", oauth_version="1.0"';
      $this->rest->http_header($header);
      $user = $this->rest->get('statuses/user_timeline.json',$vars);
      echo $this->rest->debug();
      echo $this->rest->status();
      //print_r();
      //figure this out logic, patterns relationships.

    }

    function test()
    {
      if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
        // We've got everything we need
        // TwitterOAuth instance, with two new parameters we got in twitter_login.php
        $twitteroauth = new TwitterOAuth('YOUR_CONSUMER_KEY', 'YOUR_CONSUMER_SECRET', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
        // Let's request the access token
        $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
        // Save it in a session var
        $_SESSION['access_token'] = $access_token;
        // Let's get the user's info
        $user_info = $twitteroauth->get('account/verify_credentials');
        // Print user's info
        print_r($user_info);
      } else {
    // Something's missing, go back to square 1
    redirect("client/");
    echo "missing";
    die();
      //header('Location: twitter_login.php');
      }
    }

    // study and learn restful api's
  }
