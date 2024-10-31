<div class="wrap">
    <?php screen_icon(); ?>
    <h2>RSS King Pro</h2>
    
    <div class="kpp_block filled">
        <h2>Connect</h2>
        <div id="kpp_social">
            <div class="kpp_social facebook"><a href="https://www.facebook.com/KingProPlugins" target="_blank"><i class="icon-facebook"></i> <span class="kpp_width"><span class="kpp_opacity">Facebook</span></span></a></div>
            <div class="kpp_social twitter"><a href="https://twitter.com/KingProPlugins" target="_blank"><i class="icon-twitter"></i> <span class="kpp_width"><span class="kpp_opacity">Twitter</span></span></a></div>
            <div class="kpp_social google"><a href="https://plus.google.com/b/101488033905569308183/101488033905569308183/about" target="_blank"><i class="icon-google-plus"></i> <span class="kpp_width"><span class="kpp_opacity">Google+</span></span></a></div>
        </div>
        <h4>Found an issue? Post your issue on the <a href="http://wordpress.org/support/plugin/rss-king-pro" target="_blank">support forums</a>. If you would prefer, please email your concern to <a href="mailto:plugins@kingpro.me">plugins@kingpro.me</a></h4>   
    </div>
    
    <div class="rsskp_tabs">
        <a class="rsskp_howto active">How-To</a>
        <a class="rsskp_faq">FAQ</a>
    </div>
    
    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'true') : ?>
    <div class="updated rsskp_notice">
        <p><?php _e( "Settings have been saved", 'rsskp_text' ); ?></p>
    </div>
    <?php elseif (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'false') : ?>
    <div class="error rsskp_notice">
        <p><?php _e( "Settings have <strong>NOT</strong> been saved. Please try again.", 'rsskp_text' ); ?></p>
    </div>
    <?php endif; ?>
    
    <div class="rsskp_sections">

        <div id="rsskp_howto" class="rsskp_section active">
            <h2>How To</h2>
            <h3>Use Shortcodes</h3>
            <p>Shortcodes can be used in any page or post on your site. By default:</p>
            <pre>[rsskingpro feedaddress="http://feedurl.com/feed/"]</pre>
            <p>There is alot of options you can modify using the shortcode, please see below for all the options. You can define your own settings by:</p>
            <pre>[rsskingpro feedaddress="http://feedurl.com/feed/" display="10"]</pre>
            <p>Multiple feeds can be pulled in at once:</p>
            <pre>[rsskingpro feedaddress="http://feedurl.com/feed/|http://feedurl2.com/feed/" display="10"]</pre>
            <p>To add this into a template, just use the "do_shortcode" function:</p>
            <pre>&lt;?php 
        if (function_exists('rsskingpro_func'))
            echo do_shortcode("[rsskingpro feedaddress='http://feedurl.com/feed/']");
    ?&gt;</pre>
            <h3>Shortcode Options</h3>
            <h4>feedaddress</h4>
            <p style='padding-left: 20px;'><strong>Default - 'no feed'</strong> | This field takes the external web address(es) of the feed you want to pull. To list multiple addresses, separate with '|'.</p>
            <h4>display</h4>
            <p style='padding-left: 20px;'><strong>Default - '5'</strong> | Number of items to list on output</p>
            <h4>order</h4>
            <p style='padding-left: 20px;'><strong>Default - 'desc'</strong> | List order of items. Options are 'desc', 'asc' and 'none'</p>
            <h4>dateformat</h4>
            <p style='padding-left: 20px;'><strong>Default - 'j F Y, g:i a'</strong> | Date string format. This can take text, some characters will need to be escaped (eg '\P\o\s\t\e\d o\n \t\h\e jS \of F \i\n Y'). View <a href="http://php.net/manual/en/function.date.php" target="_blank">PHP date page</a> for more information.</p>
            <h4>target</h4>
            <p style='padding-left: 20px;'><strong>Default - '_self'</strong> | Target of the links. Standard options are '_self', '_blank', '_parent' and '_top'.</p>
            <h4>titlelength</h4>
            <p style='padding-left: 20px;'><strong>Default - 'all'</strong> | Numeric length of the output title. If no limit, 'all' is the value.</p>
            <h4>descriptionlength</h4>
            <p style='padding-left: 20px;'><strong>Default - 'all'</strong> | Numeric length of the output title. If no limit, 'all' is the value.</p>
            <h4>contentlength</h4>
            <p style='padding-left: 20px;'><strong>Default - 'all'</strong> | Numeric length of the output title. If no limit, 'all' is the value.</p>
            <h4>readmorelink</h4>
            <p style='padding-left: 20px;'><strong>Default - false</strong> | Turns on the "ream more" link when shortening the description or content fields. Options are true or false</p>
            <h4>readmoretext</h4>
            <p style='padding-left: 20px;'><strong>Default - 'Read more'</strong> | The text you would like on the "Read more" link</p>
            <h4>renderhtml</h4>
            <p style='padding-left: 20px;'><strong>Default - false</strong> | Enable rendering of HTML from the description/content data. Options are true or false</p>
            <h4>format</h4>
            <p style='padding-left: 20px;'><strong>Default - '<?= htmlspecialchars('<div class="rsskp_itemhead"><span class="rsskp_date">##PUBDATE##</span><h1 class="entry_title">##LINK##</h1></div><div class="rsskp_content">##DESCRIPTION##</div>'); ?>'</strong> | Format of the output items. Available variable below</p>
            <h4>class</h4>
            <p style='padding-left: 20px;'><strong>Default - ''</strong> | Class attached to the list parent</p>
            <h4>timezone</h4>
            <p style='padding-left: 20px;'><strong>Default - 'UTC'</strong> | Set timezone for the output. View <a href='http://www.php.net/manual/en/timezones.php' target='_blank'>PHP timezones</a> for more information on options</p>
            <h4>paging</h4>
            <p style='padding-left: 20px;'><strong>Default = true</strong> | Enable paging of the RSS. The 'display' option then becomes how many items per page. Options are true or false</p>
            <h4>pagingtype</h4>
            <p style='padding-left: 20px;'><strong>Default = 'paging'</strong> | Choice of the type of paging output. Options are 'paging', 'numbers' or 'both'</p>
            <h4>paginglocation</h4>
            <p style='padding-left: 20px;'><strong>Default = 'bottom'</strong> | Choice of the location of the pagination output. Options are 'bottom', 'top' or 'both'</p>
            <h4>ajax</h4>
            <p style='padding-left: 20px;'><strong>Default - false</strong> | Enable AJAX loading. Instead of previous and next links for paging, this will display a 'view more posts' link which will allow the following page to load in underneath the existing list, and will continue to do so until the list is complete.
            <h4>nextpagetext</h4>
            <p style='padding-left: 20px;'><strong>Default - 'Next Page'</strong> | Text on the 'next page' link (only displays when paging is on and ajax is off).</p>
            <h4>prevpagetext</h4>
            <p style='padding-left: 20px;'><strong>Default - 'Previous Page'</strong> | Text on the 'previous page' link (only displays when paging is on and ajax is off).</p>
            <h4>nextpageclass</h4>
            <p style='padding-left: 20px;'><strong>Default - 'rss_pagination_next'</strong> | Class on the 'next page' link (only displays when paging is on and ajax is off).</p>
            <h4>prevpageclass</h4>
            <p style='padding-left: 20px;'><strong>Default - 'rss_pagination_prev'</strong> | Class on the 'previous page' link (only displays when paging is on and ajax is off).</p>
            <h4>activeclass</h4>
            <p style='padding-left: 20px;'><strong>Default - 'rss_pagination_active'</strong> | Class on the 'active page' link (only displays when paging is on, pagingtype is 'numbers' or 'both' and ajax is off).</p>
            <h3>Format Variables</h3>
            <p>You can control the output by defining what information is output in the format by using variables. These variables are defined by an uppercase word surrounded by hashes (2 hashes on either side). The available variables are:</p>
            <h4>##FEEDTITLE##</h4>
            <p style='padding-left: 20px;'>Outputs the title of the FEED the items are coming from.</p>
            <h4>##PUBDATE##</h4>
            <p style='padding-left: 20px;'>Outputs the date the item was posted. The date format controls the output of this.</p>
            <h4>##TITLE##</h4>
            <p style='padding-left: 20px;'>Outputs the TITLE of the item. There is no link to the original post on this (use ##LINK## for a title with link)</p>
            <h4>##LINK##</h4>
            <p style='padding-left: 20px;'>Outputs the TITLE of the item with a link to the original page.</p>
            <h4>##DESCRIPTION##</h4>
            <p style='padding-left: 20px;'>Outputs the excerpt of the item. This can be shortened further using the 'descriptionlength' option.</p>
            <h4>##CONTENT##</h4>
            <p style='padding-left: 20px;'>Outputs the content of the item. This can be shortened using the 'contentlength' option.</p>
            <h4>##CATEGORIES##</h4>
            <p style='padding-left: 20px;'>Outputs a list of attached categories of the item</p>
            <h4>##CATEGORY##</h4>
            <p style='padding-left: 20px;'>Outputs the first category of the item</p>
            <h4>##AUTHORS##</h4>
            <p style='padding-left: 20px;'>Outputs a list of attached authors of the item</p>
            <h4>##AUTHOR##</h4>
            <p style='padding-left: 20px;'>Outputs the first author of the item</p>
            <h4>##CONTRIBUTORS##</h4>
            <p style='padding-left: 20px;'>Outputs a list of attached contributors of the item</p>
            <h4>##CONTRIBUTOR##</h4>
            <p style='padding-left: 20px;'>Outputs the first contributor of the item</p>
            <h4>##COPYRIGHT##</h4>
            <p style='padding-left: 20px;'>Outputs any attached copyright text</p>
            <h4>##ENCLOSURE##</h4>
            <p style='padding-left: 20px;'>Outputs an attached image, if any</p>
            <h4>##GUID##</h4>
            <p style='padding-left: 20px;'>Outputs the unique ID for the item in the feed</p>
            <h4>##UNIQUEKEY##</h4>
            <p style='padding-left: 20px;'>Outputs the unique key for the item in the feed</p>
        </div>

        <div id="rsskp_faq" class="rsskp_section">
            <h2>FAQ</h2>
            <h4>Q. After activating this plugin, my site has broken! Why?</h4>
            <p>Nine times out of ten it will be due to your own scripts being added above the standard area where all the plugins are included. 
                If you move your javascript files below the function, "wp_head()" in the "header.php" file of your theme, it should fix your problem.</p>

            <h4>Found an issue? Post your issue on the <a href="http://wordpress.org/support/plugin/rss-king-pro" target="_blank">support forums</a>. If you would prefer, please email your concern to <a href="mailto:plugins@kingpro.me">plugins@kingpro.me</a></h4>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery('.rsskp_tabs a').click(function() {
        jQuery(this).parent().children('a.active').removeClass('active');
        jQuery('.rsskp_sections').find('div.rsskp_section.active').removeClass('active');
        
        var active = jQuery(this).attr('class');
        jQuery(this).addClass('active');
        jQuery("#"+active).addClass('active');
    });
</script>