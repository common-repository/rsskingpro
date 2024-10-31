=== RSS King Pro ===
Contributors: ashdurham
Donate link: http://durham.net.au/donate/
Tags: rss, feed, items, links, rss feed, ajax, paging
Requires at least: 3.0.1
Tested up to: 3.9.1
Stable tag: 1.0.9
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Output an external RSS feed onto your pages and posts, your way

== Description ==

--

Stay up-to-date with the latest by following [@kingproplugins on Twitter](http://twitter.com/kingproplugins), [KingProPlugins on Facebook](http://facebook.com/kingproplugins) or [King Pro Plugins on Google+](https://plus.google.com/b/101488033905569308183/101488033905569308183/about)

--

[RSS King Pro](http://kingpro.me/plugins/rss-king-pro/) gives you the freedom to display a RSS feed or feeds onto your pages and posts with ease. The numerous options
available provides choice in how your feed displays on your pages. You can choose how many items are returned onto the page, whether the feed paginates and whether you 
display those pages via AJAX giving your users a simple way to view the feed your providing.

You have control on the information from the feed that is returned on the page and how it is displayed by using variables within a HTML layout for each item.
Variables have been setup to give you choice in what details are shown for the items. 

You can use [RSS King Pro](http://kingpro.me/plugins/rss-king-pro/) in two ways, either shortcode or widget. Both have the same settings available.

--

If you have any suggestions or would like to see a feature in the plugin, please let me know in the support forum.

Any issues you are having, I'd also love to know, so again, please let me know using the support forum.

--

--

[Check out the King Pro Plugins range](http://kingpro.me/)


== Installation ==

1. Download and unzip the zip file onto your computer
2. Upload the 'relatedkingpro' folder into the `/wp-content/plugins/` directory (alternatively, install the plugin from the plugin directory within the admin)
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Drag the widget into your sidebar and modify the settings or insert the shortcode into a post or theme template.

--

Having Trouble? Get support either on the support forums here or at [@kingproplugins on Twitter](http://twitter.com/kingproplugins), [KingProPlugins on Facebook](http://facebook.com/kingproplugins) or [King Pro Plugins on Google+](https://plus.google.com/b/101488033905569308183/101488033905569308183/about)

--

== Options ==

= Shortcode Options =
* feedaddress
`Default - 'no feed'` | This field takes the external web address(es) of the feed you want to pull. To list multiple addresses, separate with '|'.
* display
`Default - '5'` | Number of items to list on output
* order
`Default - 'desc'` | List order of items. Options are 'desc', 'asc' and 'none'
* dateformat
`Default - 'j F Y, g:i a'` | Date string format. This can take text, some characters will need to be escaped (eg '\P\o\s\t\e\d o\n \t\h\e jS \of F \i\n Y'). View <a href="http://php.net/manual/en/function.date.php" target="_blank">PHP date page</a> for more information.
* target
`Default - '_self'` | Target of the links. Standard options are '_self', '_blank', '_parent' and '_top'.
* titlelength
`Default - 'all'` | Numeric length of the output title. If no limit, 'all' is the value.
* descriptionlength
`Default - 'all'` | Numeric length of the output description. If no limit, 'all' is the value.
* contentlength
`Default - 'all'` | Numeric length of the output content. If no limit, 'all' is the value.
* readmorelink
`Default - false` | Turns on the "ream more" link when shortening the description or content fields. Options are true or false
* readmoretext
`Default - 'Read more'` | The text you would like on the "Read more" link
* renderhtml
`Default - false` | Enable rendering of HTML from the description/content data. Options are true or false
* format
`Default - '<?= htmlspecialchars('<div class="rsskp_itemhead"><span class="rsskp_date">##PUBDATE##</span><h1 class="entry_title">##LINK##</h1></div><div class="rsskp_content">##DESCRIPTION##</div>'); ?>'` | Format of the output items. Available variable below
* class
`Default - ''` | Class attached to the list parent
* timezone
`Default - 'UTC'` | Set timezone for the output. View <a href='http://www.php.net/manual/en/timezones.php' target='_blank'>PHP timezones</a> for more information on options
* paging
`Default = true` | Enable paging of the RSS. The 'display' option then becomes how many items per page. Options are true or false
* pagingtype
`Default = 'paging'` | Choice of the type of paging output. Options are 'paging', 'numbers' or 'both'
* paginglocation
`Default = 'bottom'` | Choice of the location of the pagination output. Options are 'bottom', 'top' or 'both'
* ajax
`Default - false` | Enable AJAX loading. Instead of previous and next links for paging, this will display a 'view more posts' link which will allow the following page to load in underneath the existing list, and will continue to do so until the list is complete.
* nextpagetext
`Default - 'Next Page'` | Text on the 'next page' link (only displays when paging is on, pagingtype is 'paging' or 'both' and ajax is off).
* prevpagetext
`Default - 'Previous Page'` | Text on the 'previous page' link (only displays when paging is on, pagingtype is 'paging' or 'both' and ajax is off).
* nextpageclass
`Default - 'rss_pagination_next'` | Class on the 'next page' link (only displays when paging is on, pagingtype is 'paging' or 'both' and ajax is off).
* prevpageclass
`Default - 'rss_pagination_prev'` | Class on the 'previous page' link (only displays when paging is on, pagingtype is 'paging' or 'both' and ajax is off).
* activeclass
`Default - 'rss_pagination_active'` | Class on the 'active page' link (only displays when paging is on, pagingtype is 'numbers' or 'both' and ajax is off).
= Format Variables =
<p>You can control the output by defining what information is output in the format by using variables. These variables are defined by an uppercase word surrounded by hashes (2 hashes on either side). The available variables are:
* ##FEEDTITLE##
Outputs the title of the FEED the items are coming from.
* ##PUBDATE##
Outputs the date the item was posted. The date format controls the output of this.
* ##TITLE##
Outputs the TITLE of the item. There is no link to the original post on this (use ##LINK## for a title with link)
* ##LINK##
Outputs the TITLE of the item with a link to the original page.
* ##DESCRIPTION##
Outputs the excerpt of the item. This can be shortened further using the 'descriptionlength' option.
* ##CONTENT##
Outputs the content of the item. This can be shortened using the 'contentlength' option.
* ##CATEGORIES##
Outputs a list of attached categories of the item
* ##CATEGORY##
Outputs the first category of the item
* ##AUTHORS##
Outputs a list of attached authors of the item
* ##AUTHOR##
Outputs the first author of the item
* ##CONTRIBUTORS##
Outputs a list of attached contributors of the item
* ##CONTRIBUTOR##
Outputs the first contributor of the item
* ##COPYRIGHT##
Outputs any attached copyright text
* ##ENCLOSURE##
Outputs an attached image, if any
* ##GUID##
Outputs the unique ID for the item in the feed
* ##UNIQUEKEY##
Outputs the unique key for the item in the feed

== Frequently Asked Questions ==

= After activating this plugin, my site has broken! Why? =

Nine times out of ten it will be due to your own scripts being added above the standard area where all the plugins are included. If you move your javascript files below the function, "wp_head()" in the "header.php" file of your theme, it should fix your problem.

--

Have a question thats not listed? Get support either on the support forums here or at [@kingproplugins on Twitter](http://twitter.com/kingproplugins), [KingProPlugins on Facebook](http://facebook.com/kingproplugins) or [King Pro Plugins on Google+](https://plus.google.com/b/101488033905569308183/101488033905569308183/about)

--

== Changelog ==

= 1.0.9 =
* Additional field for ENCLOSURE that contains an image if it exists in the feed

= 1.0.8 =
* URL to ajax loader image fixed up
* KPP logo update

= 1.0.7 =
* Addition of paginglocation shortcode option to control the output location of the pagination.
* Addition of renderhtml shortcode option to control description output better
* Addition of readmorelink and readmoretext shortcode option to be utilised when shortening the description and content fields

= 1.0.6 =
* Addition of pagingtype and activeclass shortcode options to output numbers pages.

= 1.0.5 =
* Fix to URL output on pagination to handle existing GET variables

= 1.0.4 =
* Addition of error checking and reporting
* Fixed ability to add multiple feeds by changing the splitter from ',' to '|'

= 1.0.3 =
* Update to KPP section with release of new plugin
* Created local copy of Font Awesome as requested by Wordpress

= 1.0.2 =
* Quick fix to widget and saving addresses

= 1.0.1 =
* Major styling update to settings page
* Update to KPP Page styling and layout

= 1.0 =
* Initial

== Upgrade Notice ==

= 1.0.9 =
* Additional field for ENCLOSURE that contains an image if it exists in the feed

= 1.0.8 =
* URL to ajax loader image fixed up
* KPP logo update

= 1.0.7 =
* Addition of paginglocation shortcode option to control the output location of the pagination.
* Addition of renderhtml shortcode option to control description output better
* Addition of readmorelink and readmoretext shortcode option to be utilised when shortening the description and content fields

= 1.0.6 =
* Addition of pagingtype and activeclass shortcode options to output numbers pages.

= 1.0.5 =
* Fix to URL output on pagination to handle existing GET variables

= 1.0.4 =
* Addition of error checking and reporting
* Fixed ability to add multiple feeds by changing the splitter from ',' to '|'

= 1.0.3 =
* Update to KPP section with release of new plugin
* Created local copy of Font Awesome as requested by Wordpress

= 1.0.2 =
* Quick fix to widget and saving addresses

= 1.0.1 =
* Major styling update to settings page
* Update to KPP Page styling and layout

= 1.0 =
* Gotta start somewhere