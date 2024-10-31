<?php
// [rsskingpro feedaddress="no feed" display=5 order="desc" dateformat="j F Y, g:i a" target="_self" titlelength="all" descriptionlength="all" contentlength="all" readmorelink=false readmoretext='Read More' renderhtml=false format="<div class='rsskp_itemhead'><span class='rsskp_date'>##PUBDATE##</span><h1 class='entry_title'>##LINK##</h1></div><div class='rsskp_content'>##DESCRIPTION##</div>" class="" timezone="UTC" paging=true pagingtype='paging' paginglocation='bottom' ajax=false nextpagetext="Next Page" prevpagetext="Previous Page" nextpageclass="rss_pagination_next" prevpageclass="rss_pagination_prev" activeclass="rss_pagination_active"]

function rsskingpro_func($atts) {
    extract(shortcode_atts( array(
    'feedaddress' => 'no feed',
    'display' => '5',
    'order' => 'desc',
    'dateformat' => 'j F Y, g:i a',
    'target' => '_self',
    'titlelength' => 'all',
    'descriptionlength' => 'all',
    'contentlength' => 'all',
    'readmorelink'=>false,
    'readmoretext'=>'Read more',
    'renderhtml' => false,
    'format' => '<div class="rsskp_itemhead"><span class="rsskp_date">##PUBDATE##</span><h1 class="entry_title">##LINK##</h1></div><div class="rsskp_content">##DESCRIPTION##</div>',
    'class' => '',
    'timezone' => 'UTC',
    'paging' => true,
    'pagingtype' => 'paging',
    'paginglocation' => 'bottom',
    'ajax' => false,
    'nextpagetext' => 'Next Page',
    'prevpagetext' => 'Previous Page',
    'nextpageclass' => 'rss_pagination_next',
    'prevpageclass' => 'rss_pagination_prev',
    'activeclass' => 'rss_pagination_active'
        ), $atts ) );
    
    $cachelocation = WP_CONTENT_DIR.'/cache'; 
    if (!file_exists($cachelocation)) {
        @mkdir($cachelocation, 0777);
    }
    
    if ($feedaddress != 'no feed') { 
        //$formatsplit = str_split($format);
        $formatsplit = explode('##', $format);
        $formatdef = array('FEEDTITLE','PUBDATE','TITLE','LINK','DESCRIPTION','CONTENT','CATEGORIES','CATEGORY','AUTHORS','AUTHOR','CONTRIBUTORS','CONTRIBUTOR','COPYRIGHT', 'ENCLOSURE','GUID','UNIQUEKEY');
        $feedarray = explode("|",$feedaddress);
        foreach ($feedarray as &$feedurl) {
            $feedurl = trim($feedurl);
            $rss_urlcheck = stripos($feedurl, 'http');
            if ($rss_urlcheck !== 0) { $feedurl = 'http://'.$feedurl; }
            $feedurls[] = html_entity_decode($feedurl); 
        }

        require_once (ABSPATH . WPINC . '/class-feed.php');
        
        date_default_timezone_set($timezone);
        
        $feed = new SimplePie();
        $feed->set_feed_url($feedurls);
        $feed->set_cache_location($cachelocation);
        $feed->set_cache_duration('60');
        if ($order == 'none') { $feed->enable_order_by_date(false); }
        $feed->init();
        $feed->handle_content_type();
        $rss = $feed;
        if ($rss->error()) {
            $error_output = '';
            foreach ($rss->error() as $err_num=>$error)
                $error_output .= "[".$err_num."] ".$error."<br />";
            return $error_output;
        }
        $totalitems = $rss->get_item_quantity();
        if (isset($_GET['rsskppage'])) {
            $page = $_GET['rsskppage'];
            $start = ($display * ($page - 1));
        } else {
            $page = 1;
            $start = 0;
        }
        $rss_items = $rss->get_items($start, $display);
        //print_r($rss_items);die;
        $maxitems = $rss->get_item_quantity($display);
        if ($maxitems > count($rss_items)) $maxitems = count($rss_items);
        if ($maxitems != 0) {
            if (isset($_GET['rsskppage'])) {
                $page = $_GET['rsskppage'];
                $start = ($display * ($page - 1));
            } else {
                $page = 1;
                $start = 0;
            }
            if ($display > $maxitems) $displayloop = $maxitems;
            else $displayloop = $display;
            $rss_items = $rss->get_items($start, $maxitems);
            if ($order == 'asc') $rss_items = array_reverse($rss_items);
            $i=0;
            while ($i < $displayloop) {
                
                // Feed Title
                $FEEDTITLE = $rss_items[$i]->get_feed()->get_title();
                
                // Date
                if ($rss_items[$i]->get_date() != '') $PUBDATE = $rss_items[$i]->get_date($dateformat);
                
                // Item Title
                $itemtitle = $rss_items[$i]->get_title();
                $linketitle = $itemtitle;
                if ($titlelength != 'all' && is_numeric($titlelength)) { 
                    if(strlen($itemtitle) > $titlelength) { $rsstitle = substr($itemtitle, 0, $titlelength).'... '; }
                }
                $TITLE = $rsstitle;
                
                // Link
                $rss_itemlink = NULL;
                if ($rss_items[$i]->get_link() != '') {
                    $rss_itemlink = $rss_items[$i]->get_link();
                    $rss_itemlinkstart = strrpos($rss_itemlink, "http://");
                    $rss_itemlink = substr($rss_itemlink, $rss_itemlinkstart);
                    $LINK = '<a href="'.$rss_itemlink.'" target="'.$target.'" title="'.$linketitle.'">'.$itemtitle.'</a>'; 
                } elseif ($rss_items[$i]->get_permalink() != '') {
                    $rss_itemlink = $rss_items[$i]->get_permalink();
                    $rss_itemlinkstart = strrpos($rss_itemlink, "http://");
                    $rss_itemlink = substr($rss_itemlink, $rss_itemlinkstart);
                    $LINK = '<a href="'.$rss_itemlink.'" target="'.$target.'" title="'.$linketitle.'">'.$itemtitle.'</a>'; 
                } else { $LINK = $itemtitle; }
                
                // Description
                if ($rss_items[$i]->get_description() != '') $DESCRIPTION = $rss_items[$i]->get_description();
                // Format data
                if ($renderhtml)
                    $DESCRIPTION = @html_entity_decode( $DESCRIPTION, ENT_QUOTES, get_option('blog_charset') );
                else
                    $DESCRIPTION = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $DESCRIPTION, ENT_QUOTES, get_option('blog_charset') ) ) ) );
                if ($descriptionlength !== 'all' && is_numeric($descriptionlength)) { 
                    if(strlen($DESCRIPTION) > $descriptionlength) { 
                        $DESCRIPTION = substr($DESCRIPTION, 0, $descriptionlength).'... '; 
                        if ($readmorelink && !is_null($rss_itemlink))
                            $DESCRIPTION .= '<a href="'.$rss_itemlink.'" target="'.$target.'" title="'.$linketitle.'">'.$readmoretext.'</a>';
                    }
                }
                
                // Content
                if ($rss_items[$i]->get_content() != '') $CONTENT = $rss_items[$i]->get_content();
                if ($renderhtml)
                    $CONTENT = @html_entity_decode( $CONTENT, ENT_QUOTES, get_option('blog_charset') );
                else
                    $CONTENT = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $CONTENT, ENT_QUOTES, get_option('blog_charset') ) ) ) );
                if ($contentlength !== 'all' && is_numeric($contentlength)) { 
                    if(strlen($CONTENT) > $contentlength) { 
                        $CONTENT = substr($CONTENT, 0, $contentlength).'... '; 
                        if ($readmorelink && !is_null($rss_itemlink))
                            $CONTENT .= '<a href="'.$rss_itemlink.'" target="'.$target.'" title="'.$linketitle.'">'.$readmoretext.'</a>';
                    }
                }
                
                // Categories
                $obj_categories = $rss_items[$i]->get_categories();
                if (!empty($obj_categories)) {
                    $rss_itemcategories = '';
                    $rss_itemcategory = '';
                    foreach ($obj_categories as $obj_category) {
                        if (empty($rss_itemcategory)) $rss_itemcategory = $obj_category->term;
                        $rss_itemcategories .= $obj_category->term.", ";
                    }
                    $CATEGORIES = $rss_itemcategories;
                    $CATEGORY = $rss_itemcategory;
                }
                
                // Author
                $obj_authors = $rss_items[$i]->get_authors();
                //print_r($obj_authors);
                if (!empty($obj_authors)) {
                    $rss_itemauthors = '';
                    $rss_itemauthor = '';
                    foreach ($obj_authors as $obj_author) {
                        if (empty($obj_author)) $rss_itemauthor = $obj_author->term;
                        $rss_itemauthors .= $obj_author->term.", ";
                    }
                    $AUTHORS = $rss_itemauthors;
                    $AUTHOR = $rss_itemauthor;
                }
                
                // Contributors
                $obj_contributors = $rss_items[$i]->get_contributors();
                if (!empty($obj_contributors)) {
                    $rss_itemcontributors = '';
                    $rss_itemcontributor = '';
                    foreach ($obj_contributors as $obj_contributor) {
                        if (empty($obj_contributor)) $rss_itemcontributor = $obj_contributor->term;
                        $rss_itemcontributors .= $obj_contributor->term.", ";
                    }
                    $CONTRIBUTORS = $rss_itemcontributors;
                    $CONTRIBUTOR = $rss_itemcontributor;
                }
                
                // Copyright
                $COPYRIGHT = $rss_items[$i]->get_copyright();
                
                // GuID
                if ($rss_items[$i]->get_id() != '') $GUID = $rss_items[$i]->get_id();
                
                // enclosure
                $obj_enclosure = $rss_items[$i]->get_enclosure();
                if (!empty($obj_enclosure)) {
                    $img_url = $obj_enclosure->link;
                    $img_alt = $obj_enclosure->description;
                    $img_title = $obj_enclosure->title;
                    $img_width = $obj_enclosure->width;
                    $img_height = $obj_enclosure->height;
                    
                    $ENCLOSURE = '<img src="'.$img_url.'" alt="'.$img_alt.'" title="'.$img_title.'" width="'.$img_width.'" height="'.$img_height.'" />';
                }
                
                // unique key
                $UNIQUEKEY = time().rand(1000, 9999);
                
                // Output
                foreach ($formatsplit as $v) { if (in_array($v, $formatdef)) { $v = ${$v}; }
                    $formatoutput = $formatoutput.$v;
                }
                $return = $return.'<li>'.html_entity_decode($formatoutput).'</li>';
                unset($formatoutput, $FEEDTITLE, $PUBDATE, $TITLE, $LINK, $DESCRIPTION, $CONTENT, $CATEGORIES, $CATEGORY, $AUTHORS, $AUTHOR, $CONTRIBUTORS, $CONTRIBUTOR, $COPYRIGHT, $ENCLOSURE, $GUID, $UNIQUEKEY);
                $i++;
            }	
            if (!empty($class)) { $rssipul = '<ul class="'.$class.'">'; } else { $rssipul = '<ul>'; }
            $pagination = '';
            if ($paging) {
                $pages = ceil($totalitems / $display);
                if ($ajax) {
                    // Button to load feed via ajax
                    if ($totalitems > ($page * $display))
                        $pagination .= "<a href='".(strstr($_SERVER['REQUEST_URI'], '?') ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?')."rsskppage=".($page+1)."' class='rsskpajax_pagination ".$nextpageclass."'>".$nextpagetext."</a>";
                } else {
                    // Button for next page
                    if ($pagingtype == 'numbers') {
                        for ($p = 1; $p <= $pages; $p++) {
                            $active = '';
                            if ($page == $p) $active = $activeclass;
                            $pagination .= "<a href='".(strstr($_SERVER['REQUEST_URI'], '?') ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?')."rsskppage=".($p)."' class='".$active."'>".$p."</a>";
                        }
                    } else if ($pagingtype == 'both') {
                        if ($page > 1)
                            $pagination .= "<a href='".(strstr($_SERVER['REQUEST_URI'], '?') ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?')."rsskppage=".($page-1)."' class='".$prevpageclass."'>".$prevpagetext."</a>";
                        for ($p = 1; $p <= $pages; $p++) {
                            $active = '';
                            if ($page == $p) $active = $activeclass;
                            $pagination .= "<a href='".(strstr($_SERVER['REQUEST_URI'], '?') ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?')."rsskppage=".($p)."' class='".$active."'>".$p."</a>";
                        }
                        if ($totalitems > ($page * $display))
                            $pagination .= "<a href='".(strstr($_SERVER['REQUEST_URI'], '?') ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?')."rsskppage=".($page+1)."' class='".$nextpageclass."'>".$nextpagetext."</a>";
                    } else {
                        if ($page > 1)
                            $pagination .= "<a href='".(strstr($_SERVER['REQUEST_URI'], '?') ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?')."rsskppage=".($page-1)."' class='".$prevpageclass."'>".$prevpagetext."</a>";
                        if ($totalitems > ($page * $display))
                            $pagination .= "<a href='".(strstr($_SERVER['REQUEST_URI'], '?') ? $_SERVER['REQUEST_URI'].'&' : $_SERVER['REQUEST_URI'].'?')."rsskppage=".($page+1)."' class='".$nextpageclass."'>".$nextpagetext."</a>";
                    }
                }
            }
            
            return "<div class='rsskp_container'>".(($paginglocation == 'top' || $paginglocation == 'both') ? $pagination : '')."<div class='rsskp_feeditems'>".$rssipul.$return.'</ul><div class="rsskp_pagination"></div></div>'.(($paginglocation == 'bottom' || $paginglocation == 'both') ? $pagination : '')."</div>";
        }
    }	
}

add_shortcode("rsskingpro", "rsskingpro_func");
?>
