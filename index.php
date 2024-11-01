<?php
/*
Plugin Name: Skysa YouTube Videos App
Plugin URI: http://wordpress.org/extend/plugins/skysa-youtube-videos-app
Description: Displays the latest videos from any YouTube Channel in an app window.
Version: 1.4
Author: Skysa
Author URI: http://www.skysa.com
*/

/*
*************************************************************
*                 This app was made using the:              *
*                       Skysa App SDK                       *
*    http://wordpress.org/extend/plugins/skysa-app-sdk/     *
*************************************************************
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) exit;

// Skysa App plugins require the skysa-req subdirectory,
// and the index file in that directory to be included.
// Here is where we make sure it is included in the project.
include_once dirname( __FILE__ ) . '/skysa-required/index.php';


// YOUTUBE VIDEOS APP
$GLOBALS['SkysaApps']->RegisterApp(array( 
    'id' => '503045faeb434',
    'label' => 'YouTube Videos',
	'options' => array(
		'bar_label' => array( // key is the field name
            'label' => 'Button Label',
			'info' => 'What would you like the bar link label name to be?',
			'type' => 'text',
			'value' => 'YouTube',
			'size' => '30|1'
		),
        'icon' => array(
            'label' => 'Button Icon URL',
            'info' => 'Enter a URL for the an Icon Image. (You can leave this blank for none)',
			'type' => 'image',
			'value' => plugins_url( '/icons/youtube-icon.png', __FILE__ ),
			'size' => '50|1'
        ),
        'title' => array(
            'label' => 'App Title',
            'info' => 'What would you like to set as the title for the app window?',
			'type' => 'text',
			'value' => 'My YouTube Videos',
			'size' => '30|1'
        ),
        'option1' => array(
            'label' => 'YouTube Channel',
            'info' => 'What is your YouTube Channel Name?',
			'type' => 'text',
			'value' => '',
			'size' => '30|1'
        ),
        'option2' => array(
            'label' => 'Number of Items to Display',
            'info' => 'How many videos do you want to display in the app window?',
			'type' => 'selectbox',
			'value' => '3|4|5|6|8|10',
			'size' => '10|1'
        )
	),
    'window' => array(
        'width' => '450',
        'height' => '350',
        'position' => 'Page Center'
    ),
    'views' => array( // Each view can be an html string or a function which returns an html string. Link to other views using href="#view=view&queryparams"
        'main' => '<div class="SKYUI-feed" name="$app_option1" num="$app_option2" style="height: 100%;"><div style="text-align:center;"><img src="'.plugins_url( '/assets/Skysa-Loading.gif', __FILE__ ).'" style="width: 84px; height: 18px; margin: 50px auto;" /></div></div>'
    ), 
    'html' => '<div id="$button_id" class="bar-button" apptitle="$app_title" w="$app_width" h="$app_height" bar="$app_position">$app_icon<span class="label">$app_bar_label</span></div>',
    'js' => "
        S.on('click',function(){S.open('window','main','util.RSSFeed.youtube')});
        S.require('js',S.domain+'/js/modjs/rss.js');
        S.require('css',S.domain+'/css/apps/rss.css');
     "
));
?>