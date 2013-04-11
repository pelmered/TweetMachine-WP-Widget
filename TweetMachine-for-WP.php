<?php
/**
  Plugin Name: TweetMachine for WP
  Plugin URI: http://wordpress.org/extend/plugins/tweetmachine-wp-widget/
  Description: Adds a Live Twitter Widget usning jQuery-tweetMachine
  Version: 1.0.2
  Author: Peter Elmered
  Author URI: http://elmered.com
  Text Domain: tweetMachine-wp
  License: http://www.gnu.org/licenses/gpl.html GNU General Public License
 */
/*
  Copyright 2013 Peter Elmered (email: peter@elmered.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

define('TWEETMACHINE_BASE_PATH', __DIR__);
define('TWEETMACHINE_BASE_URL', plugin_dir_url(__FILE__));

define('TWEETMACHINE_TEXT_DOMAIN', 'tweetmachine-wp');

//echo TWEETMACHINE_BASE_URL;

// TODO: rename this class to a proper name for your plugin
class TweetMachineWidget
{

    var $_config = NULL;

    /* --------------------------------------------*
     * Constructor
     * -------------------------------------------- */

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    function __construct()
    {
        $this->load_config();

        if (!$this->_config)
        {
            add_action('admin_notices', array($this, 'configuration_needed'));
        }

        // Load plugin text domain
        add_action('init', array($this, 'load_text_domain'));


        // Register site styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'register_styles'));
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
        
        $this->register_backend();

        if (is_admin())
        {
            //Add configuration link to menu
            add_action('admin_menu', array($this, 'admin_pages'));

            // Register admin styles and scripts
            add_action('admin_print_styles', array($this, 'register_admin_styles'));
            add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));

            // Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
            register_activation_hook(__FILE__, array($this, 'activate'));
            register_deactivation_hook(__FILE__, array($this, 'deactivate'));
            register_uninstall_hook(__FILE__, array($this, 'uninstall'));
        }
        
        include_once 'TweetMachineWidget.php';
    }

// end constructor

    /**
     * Loads the plugin settings
     */
    function load_config()
    {
        if (empty($this->_config))
        {
            $this->_config = get_option('TweetMachineWidget_options', array());
        }
    }

    /**
     * Show notice when plugin is not configured
     */
    function configuration_needed()
    {
        ?>
        <div class="updated">
            <p><?php echo __('TweetMachine for WP is not configured.', 'tweetmachine-wp') . ' <a href="">' . __('Go to settings page', 'tweetmachine-wp') . '</a>.'; ?></p>
        </div>
        <?php
    }

    /**
     * Add admin settingspage
     */
    function admin_pages()
    {
        add_options_page('TweetMachine configuration page', 'TweetMachine', 'manage_options', 'tweetmachine', array($this, 'configuration_page'));
    }

    /**
     * Prints the content of the configuration page
     */
    function configuration_page()
    {

        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        
        $tweetmachine_options = $this->_config;

        $available_options = array(
            //Twitter API keys
            'tweetMachine-consumer-key',
            'tweetMachine-consumer-secret',
            'tweetMachine-access-token',
            'tweetMachine-access-token-secret',
            //Twitter search
            'tweetMachine-twitter-query',
            //Filter
            'tweetMachine-tweet-filter',
            //Display count
            'tweetMachine-tweet-count',
            //Refresh rate
            'tweetMachine-refresh-rate',
            //Consumization - Use CSS/JS
            'tweetMachine-use-css',
            'tweetMachine-use-js',
            'tweetMachine-custom-js',
            'tweetMachine-custom-format'
        );
        $plugin_option_array = array();

        foreach ($available_options AS $o)
        {
            if (!empty($_POST[$o]) || is_numeric($_POST[$o]))
            {
                $plugin_option_array[$o] = $_POST[$o];
            }
        }

        if (!empty($plugin_option_array))
        {
            update_option('TweetMachineWidget_options', $plugin_option_array);

            echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved!</strong></p></div>';

            $tweetmachine_options = array_merge($tweetmachine_options, $plugin_option_array);
        }

        if(empty($tweetmachine_options) || !$tweetmachine_options )
        {
            $tweetmachine_options = array(
            //Twitter API keys
            'tweetMachine-consumer-key' => '',
            'tweetMachine-consumer-secret' => '',
            'tweetMachine-access-token' => '',
            'tweetMachine-access-token-secret' => '',
            //Twitter search
            'tweetMachine-twitter-query' => '',
            //Filter
            'tweetMachine-tweet-filter' => '',
            //Display count
            'tweetMachine-tweet-count' => '5',
            //Refresh rate
            'tweetMachine-refresh-rate' => '30000',
            //Consumization - Use CSS/JS
            'tweetMachine-use-css' => '1',
            'tweetMachine-use-js' => '1',
            'tweetMachine-custom-format' => 
"<li class='tweet'>
    <img class='avatar' src=''/>
    <div class='meta top'>
        <a href='' class='username'></a>
    </div>
    <p class='content'></p>
    <div class='meta bottom'>
        <a href='' class='time'></a>
    </div>
</li>"
        );

        }
        //print_r($tweetmachine_options);

        include TWEETMACHINE_BASE_PATH . '/views/admin.php';
    }

    /**
     * Fired when the plugin is activated.
     *
     * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
     */
    public function activate($network_wide)
    {
        // TODO:	Define activation functionality here
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
     */
    public function deactivate($network_wide)
    {
        // TODO:	Define deactivation functionality here		
    }

    /**
     * Fired when the plugin is uninstalled.
     *
     * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
     */
    public function uninstall($network_wide)
    {
        // TODO:	Define uninstall functionality here		
    }

    /**
     * Loads the plugin text domain for translation
     */
    public function load_text_domain()
    {
        $locale = apply_filters('plugin_locale', get_locale(), TWEETMACHINE_TEXT_DOMAIN);
        load_textdomain(TWEETMACHINE_TEXT_DOMAIN, WP_LANG_DIR . '/' . TWEETMACHINE_TEXT_DOMAIN . '/' . TWEETMACHINE_TEXT_DOMAIN . '-' . $locale . '.mo');
        load_plugin_textdomain(TWEETMACHINE_TEXT_DOMAIN, FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');
    }

// end plugin_textdomain

    /**
     * Registers and enqueues admin-specific styles.
     */
    public function register_admin_styles()
    {

        // TODO:	Change 'plugin-name' to the name of your plugin
        wp_enqueue_style('tweetMachine-admin-styles', TWEETMACHINE_BASE_URL.'css/admin.css');
    }

// end register_admin_styles

    /**
     * Registers and enqueues admin-specific JavaScript.
     */
    public function register_admin_scripts()
    {

        // TODO:	Change 'plugin-name' to the name of your plugin
        wp_enqueue_script('tweetMachine-admin-script', TWEETMACHINE_BASE_URL.'js/admin.js');
    }

// end register_admin_scripts

    /**
     * Registers and enqueues plugin-specific styles.
     */
    public function register_styles()
    {
        wp_enqueue_style('tweetMachine-styles', TWEETMACHINE_BASE_URL.'css/tweetMachineWidget.css');
    }

    /**
     * Registers and enqueues plugin-specific scripts.
     */
    public function register_scripts()
    {
        
        if( $this->_config['tweetMachine-use-css'] == 1 )
        {
            wp_enqueue_script('tweetMachine', TWEETMACHINE_BASE_URL.'js/tweetMachine.js', array('jquery'));            
        }

        if( $this->_config['tweetMachine-use-js'] == 1 )
        {
            wp_enqueue_script('tweetMachine-widget-script', TWEETMACHINE_BASE_URL.'js/tweetMachineWidget.js', array('jquery','tweetMachine'));
        }
        
        $data = array(
            //'tmBackend' => TWEETMACHINE_BASE_URL.'TweetMachineBackend.php',
            'tmBackend' => admin_url( 'admin-ajax.php' ),
            'tmQuery'   => stripcslashes($this->_config['tweetMachine-twitter-query']),
            'tmFilter'   =>  stripcslashes($this->_config['tweetMachine-tweet-filter']),
            'tmCount'   =>  $this->_config['tweetMachine-tweet-count'],
            'tmRefresh'   =>  $this->_config['tweetMachine-refresh-rate'],
            'localization' => array(
                'seconds' => __('seconds ago', TWEETMACHINE_TEXT_DOMAIN),
                'minute' => __('a minute ago', TWEETMACHINE_TEXT_DOMAIN),
                'minutes' => __('minutes ago', TWEETMACHINE_TEXT_DOMAIN),
                'hour' => __('a hour ago', TWEETMACHINE_TEXT_DOMAIN),
                'hours' => __('hours ago', TWEETMACHINE_TEXT_DOMAIN),
                'day' => __('a day ago', TWEETMACHINE_TEXT_DOMAIN),
                'days' => __('days agoo', TWEETMACHINE_TEXT_DOMAIN),
            ),
            'tmFormat' => stripcslashes($this->_config['tweetMachine-custom-format']),
        );
        
        wp_localize_script('tweetMachine-widget-script', 'tweetMachineData', $data);  
            
    }
    
    
    /**
     * 
     */
    public function register_backend()
    {
        add_action('wp_ajax_tweetmachine_backend', array($this, 'ajax_backend'));
        add_action('wp_ajax_nopriv_tweetmachine_backend', array($this, 'ajax_backend'));
        
    }
    
    /**
     * 
     */
    public function ajax_backend()
    {    
        
        $config = $this->_config;
        require 'TweetMachineBackend.php';
        
        die();
    }

    
    
}

//Instansiate class
$TweetMachineWidget = new TweetMachineWidget();


