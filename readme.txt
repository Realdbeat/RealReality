=== Rowling ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.5
Tested up to: 5.4.1
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Installation ==

1. Upload the theme
2. Activate the theme

All theme specific options are handled through the WordPress Customizer.


== Frequently Asked Questions ==

== Use the gallery post format 

1. Go to Admin > Posts > Add New.
2. Select the "Gallery" post format in the Post Attributes box.
3. Click "Add Media" and upload the images you wish to display in the gallery.
4. Close the Media window and publish/update the post.
5. The images you uploaded should now be displayed in the post gallery.


== Use the social menu in the header

1. Go to Admin > Appearance > Menus.
2. Create a new menu.
3. Click the "Links" dropdown in the left sidebar, and add the URL and title of the social link you wish to include. 
4. Click "Add to Menu" to add it to the menu. Repeat for each link you wish to include.
5. Scroll down to "Menu Settings", and next to "Theme locations", select "Social Menu". Click save.
6. The menu should now be displayed on the site.


== Licenses ==

Lato
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Lato

Merriweather
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Merriweather

FontAwesome font 
License: SIL Open Font License, 1.1 
Source: http://www.fontawesome.io

Included header image
License: CC0 Public Domain 
Source: http://www.unsplash.com

screenshot.png images
License: CC0 Public Domain 
Source: http://www.unsplash.com

Doubletaptogo.js
License: MIT License
Source: https://github.com/dachcom-digital/jquery-doubletaptogo

Flexslider.js
License: GNU GPL v2.0 
Source: http://flexslider.woothemes.com


== Changelog ==

Version 2.0.2 (2020-05-27)
-------------------------
- Removed bottom margin from post meta on archive pages.
- Readded `rowling_archive_navigation()`, now including the pagination.php template file, to prevent child themes breaking (thanks, @marjoriesdaughter).

Version 2.0.1 (2020-05-13)
-------------------------
- Fixed the blog title having excessive margins when it's set in the H1 element.
- Updated the logo output to use `rowling_logo` instead of `custom_logo`, if both are set, to keep behavior consistent (thanks, @jeroenrotty).

Version 2.0.0 (2020-05-13)
-------------------------
- Updated "Tested up to" to 5.4.1.
- Moved the archive pagination to pagination.php.
- Removed license.txt.
- Updated theme folder structure.
- Updated output of archive header, added output of archive description.
- Replaced clear elements with pseudo clearing.
- Removed all title attributes from links.
- Restructured adding of widgets.
- Removed unnecessary admin CSS.
- Renamed the "regular" block editor font size to "normal", matching expected block editor naming.
- Removed comments are closed message.
- Only output custom colors if the accent color is set to something else than the default value.
- Restructured `comments.php`.
- Improved accessibility of the search form.
- Changed elements to be more semantic.
- Widgets: Cleanup, better escaping, made pluggable.
- Removed the Flickr widget, since Yahoo is deprecating the Flickr badge API the widget was using.
- Overall CSS cleanup.
- Updated post content styles targeting to make them global, and updated other styles accordingly.
- Collected block styles in the new Blocks CSS section.
- Updated FontAwesome to 5.13.0, and added support for a bunch more icons.
- Updated menus to show dropdowns on focus.
- Added support for the core custom_logo setting, and updated the old rowling_logo setting to only be displayed if you already have a rowling_logo image set (kudos to @poena).
- Bumped "Requires at least" to 4.5, since Rowling is now using `custom_logo`.
- Added styling for more inputs and buttons, and improved button block styles.
- Changed screenshot image format to JPG, reducing file size by 250 KB.
- Updated block editor styles.
- Updated theme description.

Version 1.19 (2019-07-21)
-------------------------
- Updated "Tested up to"
- Added theme tags
- Added skip link
- Don't show the post thumbnail if the post is password protected
- Fixed font issues in the block editor styles

Version 1.18 (2019-04-07)
-------------------------
- Added the new wp_body_open() function, along with a function_exists check

Version 1.17 (2019-01-11)
-------------------------
- Fixed the wrong heading being used for site title on singular

Version 1.16 (2018-12-20)
-------------------------
- Combined index.php, archive.php, and search.php into index.php
- Combined content.php and content-gallery.php into content.php
- Combined single.php and page.php into singular.php
- Removed unneccessary title attributes
- Improved the post grid layout by changing it from inline-block to flex
- Removed meta tag setting a zoom limit
- Removed CSS removing all outlines from links
- Less aggressive letter-spacing on titles

Version 1.15 (2018-12-07)
-------------------------
- Fixed Gutenberg style changes required due to changes in the block editor CSS and classes
- Fixed the Classic Block TinyMCE buttons being set to the wrong font

Version 1.14 (2018-11-30)
-------------------------
- Fixed Gutenberg editor styles font being overwritten

Version 1.13 (2018-10-20)
-------------------------
- Updated with Gutenberg support
	- Gutenberg editor styles
	- Styling of Gutenberg blocks
	- Custom Rowling Gutenberg palette
	- Custom Rowling Gutenberg typography styles
- Added option to disable Google Fonts with a translateable string
- Improved compatibility with PHP < 5.5
- Updated theme description
- Removed the languages sub folder, since that is handled by WordPress.org
- Slight style tweaks

Version 1.12 (2018-05-24)
-------------------------
- Fixed output of cookie checkbox in comments

Version 1.11 (2017-12-12)
-------------------------
- Fixed recent posts issue with the current post

Version 1.10 (2017-12-03)
-------------------------
- Fixed the author description output being broken on single.php due to 4.9 wrapping the description field in a paragraph
- Removed link wrapper around title and post thumbnail on singular

Version 1.09 (2017-12-03)
-------------------------
- Fixed post-content intro paragraph (.intro) not being targeted by the customizer accent color setting

Version 1.08 (2017-12-03)
-------------------------
- Updated to the new readme.txt format, with changelog.txt incorporated into it
- Added a demo link to the stylesheet theme description
- Added a deliberate dependency order to the stylesheet enqueueing
- Same for scripts enqueues
- Made all functions in functions.php pluggable
- Replaced a new WP_Query in widgets/recent-posts.php with a get_posts()
- Fixed genericons path
- Fixed notice in comments.php
- Changed closing element comment structure
- General code cleanup, improvements in readability
- Fixed potential overflow issue on mobile for the blog title and logo
- Restructured the related posts query to be more lean

Version 1.07 (2017-11-30)
-------------------------
- Fixed warnings in comments.php

Version 1.06 (2017-11-24)
-------------------------
- Fixed notices in comments.php
- Made theme strings translateable in index.php and comments.php

Version 1.05 (2016-06-18)
-------------------------
- Added the new theme directory tags
– Tweaked footer style and structure

Version 1.04 (2015-08-11)
------------------------- 
- Added clearing divs after the post content on single posts/pages
- Changed the titles on single posts/pages to H1 elements for SEO benefits
- Fixed so that Jetpack Tiled Galleries plays nice with the related posts field
- Fixed so that img#wpstats is hidden
- Changed post title on 404 from h2 to h1 for SEO reasons
- Fixed so that widgets use __construct() in prep for WP 4.3

Version 1.03 (2015-04-07)
------------------------- 
- Added some missing PHP functions to the footer

Version 1.02 (2015-02-28)
------------------------- 
- Renamed lovecraft.pot to rowling.pot. This is why you don't do two themes at once, kids.

Version 1.01 (2015-02-23)
------------------------- 
- Replaced doubletaptogo.min.js with doubletaptogo.js (non-minified version)
- Replaced flexslider.min.js with flexslider.js (non-minified version)
- Replaced fontawesome.min.css with fontawesome.css (non-minified version)
- Renamed xx_XX.pot to rowling.pot
- Added theme text-domain to style.css
- Removed wp_is_mobile() from functions.php
- Added theme function prefix to html_js_class() in functions.php
- Changed home_url() to home_url('/') in header.php

Version 1.00 (2015-02-03)
------------------------- 