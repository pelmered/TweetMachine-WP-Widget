<?php

/*
 * Admin page
 */

?>
<div id="tweetmachine-widget-admin" class="wrap">
    <h2><?php _e('Tweet Machine Widget Settings'); ?></h2>

    <form method="post" action=""><?php wp_nonce_field('update-options'); ?>
        
        
    <div id="tweetmachine-api-keys" class="postbox ">
        <h3 class="hndle"><span><?php _e('API Keys', TWEETMACHINE_TEXT_DOMAIN); ?></span></h3>
        <div class="inside">
            
<?php _e('<p>
Due to Twitters new API and the deprication of their old it is now required to authenticate all API calls. In order to do this automatically you need to create an app the you authenticate though. This is how to do it:
</p>
<ol>
    <li>Go to <a href="https://dev.twitter.com/apps">https://dev.twitter.com/apps</a> and create a new application.</li>
    <li>Choose your new app from the list.</li>
    <li>Under the Details tab you can see your Consumer key and Consumer secret. Copy these into the Consumer Key and Consumer Secret fields.</li>
    <li>At the bottom of the page, click "Create my access token" under the "Your access token" heading. This will generate and Access token and Access token secret. Copy these into the fields for Access Token and Access Token Secret.</li>
</ol>', TWEETMACHINE_TEXT_DOMAIN); ?>
            
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e('Consumer key:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-consumer-key" id="tweetMachine-consumer-key" size="70" value="<?php echo $tweetmachine_options['tweetMachine-consumer-key']; ?>" type="text" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Consumer secret:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-consumer-secret" id="tweetMachine-consumer-secret" size="70" value="<?php echo $tweetmachine_options['tweetMachine-consumer-secret']; ?>" type="text" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Access Token:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-access-token" id="tweetMachine-access-token" size="70" value="<?php echo $tweetmachine_options['tweetMachine-access-token']; ?>" type="text" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Access Token Secret:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-access-token-secret" id="tweetMachine-access-token-secret" size="70" value="<?php echo $tweetmachine_options['tweetMachine-access-token-secret']; ?>" type="text" />
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="submit"> 
                <input type="submit" name="tweetMachine-save-options" class="tweetMachine-button-save button" value="<?php _e('Save all settings', TWEETMACHINE_TEXT_DOMAIN); ?>">
            </p>
        </div>
    </div>
        
    <h2><?php _e('Options', TWEETMACHINE_TEXT_DOMAIN); ?></h2>
    
    <div id="tweetmachine-widget-settings" class="postbox ">
        <div class="handlediv" title="Click to toggle"><br></div>
        <h3 class="hndle"><span><?php _e('Settings', TWEETMACHINE_TEXT_DOMAIN); ?></span></h3><div class="inside">        
            <p></p>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e('Twitter search query:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-twitter-query" id="tweetMachine-twitter-query" size="70" value='<?php echo stripslashes($tweetmachine_options['tweetMachine-twitter-query']); ?>' type="text" />
                            <p class="description"><?php _e('The twitter serach query to display tweets from.'); ?> <a href="<?php echo TWEETMACHINE_BASE_URL; ?>css/tweetMachineWidget.css"><?php _e('Default file'); ?></a></p>
                            <p class="description">
                                <?php _e('Examples:', TWEETMACHINE_TEXT_DOMAIN); ?><br />
                                @pelmered OR pelmered OR from:pelmered AND -"unfollowed me"
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Filter tweets:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-tweet-filter" id="tweetMachine-tweet-filter" size="70" value='<?php echo stripslashes($tweetmachine_options['tweetMachine-tweet-filter']); ?>' type="text" />
                            <p class="description"><?php _e('Exclude tweets with the specified phrases. The format should be a comma separated list with quotes around the phrases', TWEETMACHINE_TEXT_DOMAIN); ?></p>
                            <p class="description">
                                <?php _e('Examples:', TWEETMACHINE_TEXT_DOMAIN); ?><br />
                                "frack", "darn", "gosh", "shucks", "shoot", "dang", "fudge", "mother trucker" (Filter out some nasty words)<br />
                                "unfollowed me", "Daily is out" (Filter out some automated trash tweets such as paper.li)
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Tweet count:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-tweet-count" id="tweetMachine-tweet-count" size="70" value="<?php echo $tweetmachine_options['tweetMachine-tweet-count']; ?>" type="text" />
                            <p class="description"><?php _e('Number of tweets to display in feed. Default: 5', TWEETMACHINE_TEXT_DOMAIN); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Refresh rate (ms):', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-refresh-rate" id="tweetMachine-refresh-rate" size="70" value="<?php echo $tweetmachine_options['tweetMachine-refresh-rate']; ?>" type="text" />
                            <p class="description"><?php _e('Default: 30000 (30 seconds)', TWEETMACHINE_TEXT_DOMAIN); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="submit"> 
                <input type="submit" name="tweetMachine-save-options" class="tweetMachine-button-save button-primary" value="<?php _e('Save all settings', TWEETMACHINE_TEXT_DOMAIN); ?>">
            </p>
        </div>
    </div>
    
    <div id="tweetmachine-widget-customize" class="postbox ">
        <div class="handlediv" title="Click to toggle"><br></div>
        <h3 class="hndle"><span><?php _e('Customize', TWEETMACHINE_TEXT_DOMAIN); ?></span></h3><div class="inside">        
            <p></p>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e('Use plugin CSS:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-use-css" id="tweetMachine-use-css" size="70" value="1" type="checkbox" <?php echo ($tweetmachine_options['tweetMachine-use-css'] == 1 ? 'CHECKED=CHECKED' : ''); ?> />
                            <p class="description"><?php _e('Use your the default CSS included in the plugin or load your own using <a href="http://codex.wordpress.org/Function_Reference/wp_enqueue_style">wp_enqueue_style()</a> in your themes functions.php.', TWEETMACHINE_TEXT_DOMAIN); ?> <a href="<?php echo TWEETMACHINE_BASE_URL; ?>css/tweetMachineWidget.css"><?php _e('Default file', TWEETMACHINE_TEXT_DOMAIN); ?></a></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Use plugin JS:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-use-js" id="tweetMachine-use-css" size="70" value="1" type="checkbox" <?php echo ($tweetmachine_options['tweetMachine-use-js'] == 1 ? 'CHECKED=CHECKED' : ''); ?> />
                            <p class="description"><?php _e('Use your the default JS included in the plugin or load your own using <a href="http://codex.wordpress.org/Function_Reference/wp_register_script">wp_register_script()</a> in your themes functions.php.', TWEETMACHINE_TEXT_DOMAIN); ?> <a href="<?php echo TWEETMACHINE_BASE_URL; ?>js/tweetMachineWidget.js"><?php _e('Default file', TWEETMACHINE_TEXT_DOMAIN); ?></a>. <a href="https://github.com/ryangiglio/jquery-tweetMachine"><?php _e('Some ducumentation', TWEETMACHINE_TEXT_DOMAIN); ?></a></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Custom JS:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <input name="tweetMachine-custom-js" id="tweetMachine-custom-js" size="70" value="<?php echo $tweetmachine_options['tweetMachine-custom-js']; ?>" type="text" />
                            <p class="description"><?php _e('URL for custom Javascript loader.', TWEETMACHINE_TEXT_DOMAIN); ?></p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Custom markup:', TWEETMACHINE_TEXT_DOMAIN); ?></th>
                        <td>
                            <textarea name="tweetMachine-custom-format" id="tweetMachine-custom-format" cols="70" rows="6" ><?php echo stripslashes($tweetmachine_options['tweetMachine-custom-format']); ?></textarea>

                            <p class="description"><?php _e('Customize the markup for the Tweet feed. Leave empty to use default.', TWEETMACHINE_TEXT_DOMAIN); ?></p>
                            <p class="description">
                                <?php _e('Default markup:', TWEETMACHINE_TEXT_DOMAIN); ?><br />
                                <pre>
<?php echo htmlspecialchars(
"<li class='tweet'>
    <img class='avatar' src=''/>
    <div class='tweet-container'>
        <div class='meta top'>
            <a href='' class='username'></a>
        </div>
        <p class='content'></p>
        <div class='meta bottom'>
            <a href='' class='time'></a>
        </div>
    </div>
</li>"); ?>
                                </pre>
                            </p>
                            <p class="description">
                                <?php _e('The content will be injected based on the classes the following way:<br />', TWEETMACHINE_TEXT_DOMAIN); ?>
                                
                            </p>
                            <ul>
                                <li><strong>class</strong>: description</li>
                                <li><strong>avatar</strong>: Tweeters profile picture / Avatar</li>
                                <li><strong>username</strong>: Tweeters username</li>
                                <li><strong>content</strong>: The tweet</li>
                                <li><strong>time</strong>: The tweets timestamp</li>
                            </ul>
                        </td>
                    </tr>
                    
                </tbody>
            </table>

            <p class="submit"> 
                <input type="submit" name="tweetMachine-save-options" class="tweetMachine-button-save button-primary" value="<?php _e('Save all settings', TWEETMACHINE_TEXT_DOMAIN); ?>">
            </p>
        </div>
    </div>
    
    </form>
</div>