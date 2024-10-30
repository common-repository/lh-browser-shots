=== LH Browser Shots ===
Contributors:      shawfactor
Donate link: 	   https://lhero.org/portfolio/lh-browser-shots/
Tags:              post, attachment, media, download, bookmarklet, attachment, url, javascript, direct upload, remote upload, media manager, upload, files, images, backup , screenshot
Requires at least: 4.0
Tested up to:      6.0
Stable tag: 	   2.0
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Add screenshots of remote wesbites directly to the wordpress media library, either enter the site url in an onsite input box or click a bookmarklet.

== Description ==

This plugin allow you to grab a screenshot of a remote url and save into your own word press media library. 

= Features =

* Uses the wordpress.com 'mshots' functionality to automatically take screenshots of websites..
* Automatically adds the screenshot to the WordPress media library
* Redirects you to the edit screen once the screenshot is in the media library.
* Once the bookmarklet is installed you don't even need to copy and paste a url (just navigate to the site you wish to screenshot and select the bookmark). 


== Frequently Asked Questions ==

**Why does this plugin sometimes capture a pending GIF?**

The WordPress MShots api takes a little time to generate a browser screenshot.As an interim it will return a pending image. IUf the image has not been generated the pending image will be downloaded by this plugin. To get the real screen shot try again and the screenshot should be ready.

== Installation ==

1. Upload the entire `lh-browser-shots` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to Media->Add Browser Shot to add screenshot or use the bookmarklet.


== Changelog ==

**1.00 May 06, 2016**  
Initial release.

**1.01 June 22, 2016**  
Translation ready.

**1.02 May 01, 2017**  
Code improvement.

**1.03 August 01, 2017**  
Moved download to separate class.

**1.04 August 05, 2017**  
Upgraded copy file class.

**1.05 October 08, 2017** 
Updated remote upload class

**2.00 July 28, 2022** 
Major overhaul