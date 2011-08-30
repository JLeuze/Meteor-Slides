=== Plugin Name ===
Contributors: jleuze
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mail%40jleuze%2ecom&item_name=Meteor%20Slides%20Donation&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: slide, slides, slider, slideshow, image, custom post types, jquery
Requires at least: 3.2.1
Tested up to: 3.2.1
Stable tag: 1.4

Meteor Slides makes it simple to create slideshows with WordPress by adding a custom post type for slides.

== Description ==

Easily create slideshows and publish them with a shortcode or widget. The slideshows are powered by [jQuery Cycle](http://jquery.malsup.com/cycle/) and have over twenty transition styles to choose from.

= Meteor Slides Homepage =

[Visit this plugin's homepage](http://www.jleuze.com/plugins/meteor-slides/ "Meteor Slides Homepage") for documentation, tutorials, and additional videos.

= Video Overview =

This screencast shows some of the plugin's features, such as different transition and navigation options, multiple slideshows, plugin settings, and metadata. [Watch more Meteor Slides videos.](http://vimeo.com/album/930565 "Meteor Slides Videos")

[vimeo http://vimeo.com/16270730]

= Features =

* **Easy integration:** Add the slideshow to your site using a template tag, shortcode, or widget.
* **Multiple Slideshows:** Organize your slides into multiple slideshows.
* **Slideshow settings page:** Control the slide height and width, the number of slides, the slideshow speed and transition style, and the type of navigation.
* **Slideshow metadata:** Customize individual slideshows or configure more [jQuery Cycle options](http://jquery.malsup.com/cycle/options.html "jQuery Cycle Plugin") with the [MetaData jQuery Plugin](http://plugins.jquery.com/project/metadata "MetaData jQuery Plugin").
* **Slideshow transition styles:** blindX, blindY, blindZ, cover, curtainX, curtainY, fade, fadeZoom, growX, growY, none, scrollUp, scrollDown, scrollLeft, scrollRight, scrollHorz, scrollVert, slideX, slideY, turnUp, turnDown, turnLeft, turnRight, uncover, wipe, zoom.
* **Slideshow navigation:** Optional previous/next and/or paged slide navigation.
* **Multiple languages:** Chinese, English, French, Hebrew, Indonesian, Italian, Japanese, Polish, Portuguese, Portuguese (Brazilian), Romanian, Russian, Spanish, Swedish, Turkish.

*[Got a question about Meteor Slides?](http://wordpress.org/tags/meteor-slides?forum_id=10#postform "Post a question in the forums")*

== Installation ==

1. Upload the **meteor-slides** folder to your **/wp-content/plugins/** directory or go to Plugins -> Add New from your Dashboard in WordPress.
2. Activate the plugin through the Plugins menu in WordPress
3. Use the Settings link or go to Slides -> Settings to access the Meteor Slides settings.

= Configure Slideshow =
*Before adding any slides, enter the slide height and width in the settings so the slides are the correct dimensions.*

= Add Slideshow =

Use `<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>` to add this slideshow to your theme, use `[meteor_slideshow]` to add it to your Post or Page content, or use the Meteor Slides Widget to add it to a sidebar.

= Meteor Slides Documentation =

Check out the [Meteor Slides Documentation](http://www.jleuze.com/plugins/meteor-slides/installation/ "Meteor Slides Documentation") for more information on using Meteor Slides, adding slideshows, using metadata, and advanced customization.

*Please [post any questions or problems](http://wordpress.org/tags/meteor-slides?forum_id=10#postform "Post a question or problem in the forums") in the WordPress.org support forums.*

== Frequently Asked Questions ==

= I add a slide, save or publish it, and then it's missing or not found, what gives? =

Every post needs a title, make sure to give your slide a title where is says "Enter title here". This title is mostly used just to label them in the backend, but it will also be used as the title of your link if you add a link.

= I added an image to my post, why isn't it showing up in the slide? =

Make sure to click "Use as featured image" after uploading your image. If the image is added correctly to the slide, you should see a thumbnail of that image in the Slide Image metabox. 

= How can I switch the order of the slides? =

The slides load in the order they were published, you can change the publish date of a slide post to switch the order. If you'd like drap-and-drop slide sorting, try a plugin like [Post Types Order](http://wordpress.org/extend/plugins/post-types-order/ "Post Types Order plugin").

= Why is the slideshow covering up my dropdown menus? =

The `z-index` on the slideshow is higher than the dropdowns, causing them to be layered below the slides. Lower the `z-index` of `.meteor-slides` or raise the `z-index` of your dropdowns until the dropdowns are above the slideshow.

= How do I customize the slideshow's CSS stylesheet? =

Copy **meteor-slides.css** from **/meteor-slides/css/** to your theme's directory to replace the plugin's default stylesheet. If you have navigation enabled, be sure to copy the **buttons.png**, **next.png**, and **prev.png** files to your theme's images folder and update the image paths, or create new graphics to replace them. Learn more about [customizing the stylesheet](http://www.jleuze.com/plugins/meteor-slides/customizing-the-stylesheet/ "Meteor Slides Documentation") for Meteor Slides.

= How do I customize the slideshow's loop template? =

Copy **meteor-slideshow.php** from **/meteor-slides/** to your theme's directory to replace the plugin's default slideshow loop. Learn more about [customizing the slideshow template](http://www.jleuze.com/plugins/meteor-slides/customizing-the-slideshow-template/ "Meteor Slides Documentation") for Meteor Slides.

= I installed Meteor Slides, and now my theme or plugin's jQuery goodies are broken! =

Your theme or plugin is probably loading an extra copy of jQuery from the theme or plugin, or a third party server. This is unnecessary because WordPress already uses jQuery and it is included in the WordPress install. Meteor Slides loads the version that is within WordPress, to fix this, change your theme or plugin to use the copy of jQuery that comes with WordPress, like this `<?php wp_enqueue_script("jquery"); ?>`.

= Meteor Slides is awesome, what can I do to help? =

You can help right on this page by rating the plugin or voting for its compatibility with the latest version of WordPress. Blog about Meteor Slides to get the word out, or [visit my blog](http://www.jleuze.com/ "JLeuze.com") to post feedback or just say hi. You could also [translate Meteor Slides](http://www.jleuze.com/plugins/meteor-slides/languages/ "Meteor Slides Languages") into another language or [make a donation](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mail%40jleuze%2ecom&item_name=Meteor%20Slides%20Donation&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8 "Donate").

*Please [post any questions or problems](http://wordpress.org/tags/meteor-slides?forum_id=10#postform "Post a question or problem in the forums") in the WordPress.org support forums.*

== Screenshots ==

1. Slideshow Preview
2. New Slide Page
3. Edit Slide Page
4. Slides Column View
5. Manage Slideshows
6. Meteor Slides Settings

== Changelog ==

= 1.4 =
* Replaced slideshow skin with new navigation graphics and layout
* Added support for custom slideshow script
* Added support for Members plugin
* Added uninstall functionality
* Moved admin functions to separate file and reorganized some files
* Updated JQuery Cycle to 2.99, switch to minimized version
* Updated Swedish translation
* Added Hebrew, Japanese, Polish, Portuguese, and Russian translations

= 1.3.3 =
* Updated generic function with prefix.

= 1.3.2 =
* Improved support for multiple slideshows of different sizes
* Fixed transparent PNG bug
* Updated functions for WordPress 3.1 compatibility
* Updated screenshots for WordPress 3.1
* Updated JQuery Cycle to 2.94
* Added message filters for slides
* Added contextual help
* Added Chinese translation

= 1.3.1 =
* Fixed post thumbnail registration conflicts
* Added support for custom slideshow loop
* Fixed navigation for multiple slideshows
* Improved support for transparent images
* Fixed slideshow layout issues
* Updated French translation

= 1.3 =
* Added custom slideshows taxonomy for multiple slideshows
* Optional slideshow and metadata parameters for template tag and shortcode
* Optional title, slideshow, and metadata parameters for the widget
* Added settings link to plugins page
* Added Slide image and link to slides column
* Removed slides from menu editor and search
* Expanded navigation options
* Added Metadata jQuery plugin

= 1.2.3 =
* Centered slides, fixed navigation bugs, added slideshow navigation buttons, updated translation files.

= 1.2.2 =
* Added slideshow navigation, added Italian, Portuguese, and Spanish translations.

= 1.2.1 =
* Added French and Romanian translations.

= 1.2 =
* Added localization functionality, added Indonesian and Turkish translations.

= 1.1.1 =
* Fixed featured image array conflict with some themes, hide slides from revealing on load, added unique id to each slide.

= 1.1 =
* Added slideshow widget, added stylesheet, updated JQuery Cycle to 2.88.

= 1.0.2 =
* Fixed shortcode bugs, positioning of slideshow and loop within loop.

= 1.0.1 =
* Removed "menu_position" to prevent conflicts with other plugins.

= 1.0 =
* Initial release of Meteor Slides.

== Upgrade Notice ==

= 1.4 =
Meteor Slides 1.4 replaces the navigation graphics, adds support for custom scripts and the Members plugin, updates jQuery Cycle and adds new and updated translations.

= 1.3.3 =
Meteor Slides 1.3.3 improves support for multiple slideshows and adds updates for WordPress 3.1 compatability. Any custom stylesheets or templates will need to be updated for use with this release.(Updated function)

= 1.3.2 =
Meteor Slides 1.3.2 improves support for multiple slideshows and adds updates for WordPress 3.1 compatability. Any custom stylesheets or templates will need to be updated for use with this release.

= 1.3.1 =
Meteor Slides 1.3.1 fixes thumbnail registration conflicts, transparent images issues, and navigation for multiple slideshows.

= 1.3 =
Meteor Slides 1.3 adds support for multiple slideshows, the Metadata jQuery plugin for advanced customization, more navigation options, and other small improvements and bug fixes.

= 1.2.3 =
Meteor Slides 1.2.3 centers slides, fixes navigation bugs, adds slideshow navigation buttons, and updates translation files.

= 1.2.2 =
Meteor Slides 1.2.2 adds slideshow navigation and Italian, Portuguese, and Spanish translations.

= 1.2.1 =
Meteor Slides 1.2.1 adds French and Romanian translations.

= 1.2 =
Meteor Slides 1.2 adds localization support and includes Indonesian and Turkish translations.

= 1.1.1 =
This version of Meteor Slides fixes a bug that was causing some themes to disable the featured images.

= 1.1 =
This version of Meteor Slides adds a stylesheet for the slideshow which aids theme compatibility.