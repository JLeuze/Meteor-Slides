Meteor Slides
==========================

Meteor Slides makes it simple to create slideshows and publish them with a shortcode, widget, or template tag. The slideshows scale with responsive and fluid themes to fit any device and have touch support. Powered by [jQuery Cycle](http://jquery.malsup.com/cycle/) with over twenty transition styles to choose from.

####Meteor Slides Homepage

[Visit this plugin's homepage](http://www.jleuze.com/plugins/meteor-slides/) for documentation, tutorials, and video screencasts.

####Features

* **Easy integration:** Add the slideshow to your site using a template tag, shortcode, or widget.
* **Mobile Friendly:** Scales to fit any device, supports touch navigation for mobiles and tablets.
* **Multiple Slideshows:** Organize your slides into multiple slideshows.
* **Slideshow settings page:** Control the slide height and width, the number of slides, the slideshow speed and transition style, and the type of navigation.
* **Slideshow metadata:** Customize individual slideshows or configure more [jQuery Cycle options](http://jquery.malsup.com/cycle/options.html) with the [MetaData jQuery Plugin](http://plugins.jquery.com/project/metadata).
* **Slideshow transition styles:** blindX, blindY, blindZ, cover, curtainX, curtainY, fade, fadeZoom, growX, growY, none, scrollUp, scrollDown, scrollLeft, scrollRight, scrollHorz, scrollVert, slideX, slideY, turnUp, turnDown, turnLeft, turnRight, uncover, wipe, zoom.
* **Slideshow navigation:** Optional previous/next and/or paged slide navigation.
* **Multiple languages:** Belarusian, Chinese (Simplified), Chinese (Traditional), Czech, Danish, Dutch, English, French, German, Hebrew, Indonesian, Italian, Japanese, Persian, Polish, Portuguese, Portuguese (Brazilian), Romanian, Russian, Spanish, Swedish, Turkish, Vietnamese.
* **Multisite Compatible:** Add Meteor Slides to any site on your network.

####Installation

1. Upload the **meteor-slides** folder to your **/wp-content/plugins/** directory or go to Plugins -> Add New from your Dashboard in WordPress.
2. Activate the plugin through the Plugins menu in WordPress
3. Use the Settings link or go to Slides -> Settings to access the Meteor Slides settings.

####Configure Slideshow

_Before adding any slides, enter the slide height and width in the settings so the slides are the correct dimensions._

####Add Slideshow

Use ```<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>``` to add this slideshow to your theme, use ```[meteor_slideshow]``` to add it to your Post or Page content, or use the Meteor Slides Widget to add it to a sidebar.

####Meteor Slides Documentation

Check out the [Meteor Slides Documentation](http://www.jleuze.com/plugins/meteor-slides/installation/) for more information on using Meteor Slides, adding slideshows, using metadata, and advanced customization.