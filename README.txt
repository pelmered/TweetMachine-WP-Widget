=== Plugin Name ===
Contributors: pekz0r, ryangiglio
Tags: twitter, widget, live widget, live tweets, twitter feed, live feed
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a Live Twitter Widget using jQuery-tweetMachine

== Description ==
**Create a Twitter live feed widget that fits your style!**

**TweetMachine for WP is a simple but yet fully customizable Twitter live feed widget.**
WP Widget using [ryangiglio's](https://github.com/ryangiglio/) excellent [jquery-tweetMachine](https://github.com/ryangiglio/jquery-tweetMachine) which is a Twitter live feed jQuery plugin. This plugin uses this as a foundation and ads an easy to use but still very customizable Wordpress widget.

= So why is this widget better than Twitter's standard widget? =
*   **Add you own style.** You can style this widget how ever you want to make it fit info your design. 
*   **Fully customizable.** You have 100% control over the markup, the CSS and even some of the Javascript. You can disable the default styles and include you own CSS. You can even replace the loader script with your own. With a few simple steps and basic HTML+CSS knowledge you can make this widget look how ever you want.
*   **Server side cache for better performance.** All tweets are cached serverside for improved performance and to minimize the number of API calls(otherwise you may exceed your rate limit. 450 requests per 15 min window) **Not implemented yet, but it's coming soon**

= Features and functionality =
* Loads fast. Option to always load form cache first and then refresh.

== Installation ==
1. Install the plugin using the normal procedure, i.e. either uploading it to `/wp-content/plugins/` directory or by installing it directly from WP-Admin.
2. Activate the plugin.
3. You now need to add your API keys and save. See below for more information and detailed instructions. 
4. Add keywords or a twitter search to filter what tweets you want to display.
5. Go to Apperence and then Widgets in WP-Admin and add the widget to any of your sidebars.
6. That's it. The Twitter widget should now be visible.

Due to Twitters new API and the deprication of their old it is now required to authenticate all API calls. In order to do this automatically you need to create an app the you authenticate though. This is how to do it:
1. Go to https://dev.twitter.com/apps and create a new application.
2. Choose your new app from the list.
3. Under the Details tab you can see your Consumer key and Consumer secret. Copy these into the Consumer Key and Consumer Secret fields.
4. At the bottom of the page, click "Create my access token" under the "Your access token" heading. This will generate and Access token and Access token secret. Copy these into the fields for AccessToken and AccessTokenSecret.

== Frequently Asked Questions ==

= How do i use my own stylesheet/CSS? =

First go to the plugin configuration page(Settings->TweetMachine) and scroll down to the "Customization" section. Here you will find the "Use plugin CSS" option. Uncheck this.
Then I would recommend you to copy the the default CSS(you find it by clicking "Default file") to your theme. This will be a good starting point for your modifications in most cases. You can ether copy the CSS and paste it into your themes style.css or you can create a new file and include it with the following line somewhere in your theme's functions.php:
`wp_enqueue_style( 'TweetMachine-custom-style', get_template_directory_uri().'/path/to/tweet_machine.css' );`

= How do I change the markup/HTML that's being generated? =

Use the "Custom markup" field. Documentation for this is on the configuration page.

= How do I use my own loader script(Javascript)? =

The recommended way to do this is to add the URL to your replacement script on the configuration page. This actually makes it possible continue to use the configuration page as it is!
The plugin uses [wp_localize_script()](http://codex.wordpress.org/Function_Reference/wp_localize_script) to inject the options form the configuration page into the Javascript. All options are saved into the `tweetMachineData` object. See the default loader for more details. 
The other not recommended option is to disable the script loading in the plugin completely and load the script yourself. If you do this and want to access the options, use "tweetMachine-widget-script" as the script handle in the `wp_enqueue_script()` call.
For latest documentation, see the [jQuery Tweet Machine GitHub page](https://github.com/ryangiglio/jquery-tweetMachine).

== Screenshots ==

1. Default widget

== Changelog ==

= 1.0.2 =
* Bugfix release
* [Bugfix] Debugdata on top of the confuguration page
* [Bugfix] Various small bugfixes
* Updated Twitter OAuth client

= 1.0 =
* Initial version

== Upgrade Notice ==


