/* 
 * 
 */

/*
jQuery(document).ready(function($) {
    console.log(tweetMachineData);
    $('.tweets').tweetMachine('#test',
        {
            endpoint: 'search/tweets',
            backendScript: '/wp-content/plugins/TweetMachineWidget/TweetMachineBackend.php'
        }
    );
});
*/

    ///console.log(tweetMachineData);
//(function ($) {
    
jQuery(document).ready(function($) {
    
    //console.log(tweetMachineData);
    
    $('.tweetmachine-feed').tweetMachine(
        tweetMachineData.tmQuery,  {
            endpoint: 'search/tweets',
            backendScript: tweetMachineData.tmBackend,
            //backendScript: ajax_url,
            rate: tweetMachineData.tmRate, //Refresh intervall
            limit: tweetMachineData.tmCount, //Number of tweet to show in feed
            localization: { //Localization for timestamp texts
                seconds:    tweetMachineData.localization.seconds,
                minute:      tweetMachineData.localization.minute,
                minutes:    tweetMachineData.localization.minutes,
                hour:         tweetMachineData.localization.hour,
                hours:       tweetMachineData.localization.hours,
                day:          tweetMachineData.localization.day,
                days:        tweetMachineData.localization.days
            },
            tweetFormat: tweetMachineData.tmFormat,
            filter: function(tweet) {
                var phrase, i, len;
                len = [tweetMachineData.tmFilter].length
                // Loop through the phrases in the list
                for ( i = 0; i < len; i++ ) 
                {
                    phrase = tweetMachineData.tmFilter[i];
                    // If the tweet's has the phrase
                    if (tweet.text.indexOf(phrase) !== -1) 
                    {
                        // Don't show it
                        return false;
                    }
                }
                // If it doesn't match any of the filter phrases, show it
                return true;
            }
        },
        function(tweets, tweetsDisplayed) {

                $('.twitter-placeholder').fadeOut();

                console.log('tweets2');
                console.log(tweets);
    /*        
                if(tweetsDisplayed <= 0)
                {
                    $('.tweetmachine-feed').html('<p class="no-tweets-notice">No tweets found</p>')
                }
    */
            });
});

/*
    
    
    
    
    
    
    console.log(tweetMachineData);


    $('.tweetmachine-feed').tweetMachine(
        tweetMachineData.tmQuery,
        {
            endpoint: 'search/tweets',
            backendScript: tweetMachineData.tmBackend,
            rate: tweetMachineData.tmRate, //Set refresh intervall to 30s (we do not want to exhaust Twitter's rate limit)
            limit: tweetMachineData.tmCount, //Get 5 Tweets
    
            localization: { //Localization for timestamp texts
                seconds:    tweetMachineData.localization.seconds,
                minute:      tweetMachineData.localization.minute,
                minutes:    tweetMachineData.localization.minutes,
                hour:         tweetMachineData.localization.hour,
                hours:       tweetMachineData.localization.hours,
                day:          tweetMachineData.localization.day,
                days:        tweetMachineData.localization.days
            },
            tweetFormat: tweetMachineData.tmFormat
            
            
            /*,
            filter: function(tweet) {
                var phrase, i, len;
                len = [tweetMachineData.tmFilter].length
                // Loop through the phrases in the list
                for ( i = 0; i < len; i++ ) {
                    phrase = tweetMachineData.tmFilter[i];
                    // If the tweet's has the phrase
                    if (tweet.text.indexOf(phrase) !== -1) {
                        // Don't show it
                        return false;
                    }
                }
                // If it doesn't have the phrase, show it
                return true;
            }
            * /
    
        },
        function(tweets, tweetsDisplayed) {

            $('.twitter-placeholder').fadeOut();
            
            console.log('tweets2');
            console.log(tweets);
/*        
            if(tweetsDisplayed <= 0)
            {
                $('.tweetmachine-feed').html('<p class="no-tweets-notice">No tweets found</p>')
            }
* /
        }
    );
});
*/
