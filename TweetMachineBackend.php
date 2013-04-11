<?
    /*========================================================================
     * PHP Backend for jQuery TweetMachine. This allows you to interact with 
     * various endpoints of the Twitter API using the keys and access tokens 
     * from a Twitter app that you created.
     ========================================================================*/

    //echo $config['tweetMachine-refresh-rate']/1000 - 5;

     //$feed = get_transient( 'tweetmachine-wp-feed-cache' );
    //print_r($feed);
     
     //If transient is set and value is not a empty JSON - Outpit frpm cache and exit
/*
     if( $feed !== FALSE && $feed != '[]' )
     {
         //echo 'from cache';
         echo json_encode($feed);
         die();
     }
     */
    /*
     * First, include the TwitterOAuth library. v0.2.0-beta2 has been included 
     * but you can always download the latest version from:
     * https://github.com/abraham/twitteroauth
     */
    include  'includes/twitteroauth/twitteroauth.php';

    /*
    * Set up keys for Twitter API
    */
    $consumerKey = $config['tweetMachine-consumer-key'];
    $consumerSecret = $config['tweetMachine-consumer-secret'];
    $accessToken = $config['tweetMachine-access-token'];
    $accessTokenSecret = $config['tweetMachine-access-token-secret'];
    
    /*
     * Get the endpoint that you'd like to access.
     */
    $endpoint = $_REQUEST['endpoint'];
    
    /*
     * Get the query parameters passed by Javascript. This is passed as an 
     * array so we don't have to do any processing.
     */
    $queryParams = $_REQUEST['queryParams'];
    
    /*
     * Establish an authenticated connection to Twitter using TwitterOAuth and 
     * the keys you've provided above.
     */
    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

    /*
     * Get the tweets!
     */
    $tweets = $connection->get($endpoint, $queryParams);
	
    /*
     * If Twitter returned statuses, the request was successful
     */
    if ( isset($tweets->statuses) ) {
        
        $feed = $tweets->statuses;
        
        set_transient( 'tweetmachine-wp-feed-cache', $feed, ($config['tweetMachine-refresh-rate']/1000 - 5) );
        
        echo json_encode($feed);
        
    }
    else { // There was a problem somewhere
        // Return the error Twitter sent so Javascript can parse it and display the error
        echo json_encode($tweets->errors);
    }
