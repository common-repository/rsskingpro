<?php
class RSSKingPro_Widget extends WP_Widget {

	public function __construct() {
            parent::__construct(
                    'rsskingpro_widget', // Base ID
                    'RSSKingPro', // Name
                    array( 'description' => __( 'Display an RSS feed(s) with pagination', 'text_domain' ), ) // Args
            );
	}

	public function widget( $args, $instance ) {
            
            extract( $args );
            extract($instance);
            $title = apply_filters( 'widget_title', $title );
            ?>
            <div class='rsskp_widget'>
                <?php if ($title !== '') : ?><h4><?= $title ?></h4><?php endif; ?>
                <?php
                if (function_exists('rsskingpro_func')){ 
                    echo do_shortcode('[rsskingpro feedaddress="'.$feedaddress.'" display='.$display.' groupby='.$groupby.' order="'.$order.'" dateformat="'.$dateformat.'" target="'.$target.'" titlelength="'.$titlelength.'" descriptionlength="'.$descriptionlength.'" contentlength="'.$contentlength.'" readmorelink='.$readmorelink.' readmoretext="'.$readmoretext.'" renderhtml='.$renderhtml.' format="'.$format.'" class="'.$class.'" timezone="'.$timezone.'" paging='.$paging.' pagingtype="'.$pagingtype.'" paginglocation="'.$paginglocation.'" ajax='.$ajax.' nextpagetext="'.$nextpagetext.'" prevpagetext="'.$prevpagetext.'" nextpageclass="'.$nextpageclass.'" prevpageclass="'.$prevpageclass.'" activeclass="'.$activeclass.'"]');
                }
                ?>
            </div>
            <?php
	}

 	public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];
            else $title = __( 'RSS Feed', 'text_domain' );
            
            if ( isset( $instance[ 'feedaddress' ] ) ) $feedaddress = $instance[ 'feedaddress' ];
            else $feedaddress = __( '', 'text_domain' );
            
            if ( isset( $instance[ 'display' ] ) ) $display = $instance[ 'display' ];
            else $display = __( '5', 'text_domain' );
            
            if ( isset( $instance[ 'order' ] ) ) $order = $instance[ 'order' ];
            else $order = __( 'desc', 'text_domain' );
            
            if ( isset( $instance[ 'dateformat' ] ) ) $dateformat = $instance[ 'dateformat' ];
            else $dateformat = __( 'j F Y, g:i a', 'text_domain' );
            
            if ( isset( $instance[ 'target' ] ) ) $target = $instance[ 'target' ];
            else $target = __( '_self', 'text_domain' );
            
            if ( isset( $instance[ 'titlelength' ] ) ) $titlelength = $instance[ 'titlelength' ];
            else $titlelength = __( 'all', 'text_domain' );
            
            if ( isset( $instance[ 'descriptionlength' ] ) ) $descriptionlength = $instance[ 'descriptionlength' ];
            else $descriptionlength = __( 'all', 'text_domain' );
            
            if ( isset( $instance[ 'contentlength' ] ) ) $contentlength = $instance[ 'contentlength' ];
            else $contentlength = __( 'all', 'text_domain' );
            
            if ( isset( $instance[ 'readmorelink' ] ) ) $readmorelink = $instance[ 'readmorelink' ];
            else $readmorelink = false;
            
            if ( isset( $instance[ 'readmoretext' ] ) ) $readmoretext = $instance[ 'readmoretext' ];
            else $readmoretext = 'Read more';
            
            if ( isset( $instance[ 'renderhtml' ] ) ) $renderhtml = $instance[ 'renderhtml' ];
            else $renderhtml = false;
            
            if ( isset( $instance[ 'format' ] ) ) $format = $instance[ 'format' ];
            else $format = __( '<div class="rsskp_itemhead"><span class="rsskp_date">##PUBDATE##</span><h1 class="entry_title">##LINK##</h1></div><div class="rsskp_content">##DESCRIPTION##</div>', 'text_domain' );
            
            if ( isset( $instance[ 'class' ] ) ) $class = $instance[ 'class' ];
            else $class = __( '', 'text_domain' );
            
            if ( isset( $instance[ 'timezone' ] ) ) $timezone = $instance[ 'timezone' ];
            else $timezone = __( 'UTC', 'text_domain' );
            
            if ( isset( $instance[ 'paging' ] ) ) $paging = $instance[ 'paging' ];
            else $paging = true;
            
            if ( isset( $instance[ 'pagingtype' ] ) ) $pagingtype = $instance[ 'pagingtype' ];
            else $pagingtype = 'paging';
            
            if ( isset( $instance[ 'paginglocation' ] ) ) $paginglocation = $instance[ 'paginglocation' ];
            else $paginglocation = 'bottom';
            
            if ( isset( $instance[ 'ajax' ] ) ) $ajax = $instance[ 'ajax' ];
            else $ajax = false;
            
            if ( isset( $instance[ 'nextpagetext' ] ) ) $nextpagetext = $instance[ 'nextpagetext' ];
            else $nextpagetext = __( 'Next Page', 'text_domain' );
            
            if ( isset( $instance[ 'prevpagetext' ] ) ) $prevpagetext = $instance[ 'prevpagetext' ];
            else $prevpagetext = __( 'Previous Page', 'text_domain' );
            
            if ( isset( $instance[ 'nextpageclass' ] ) ) $nextpageclass = $instance[ 'nextpageclass' ];
            else $nextpageclass = __( 'rss_pagination_next', 'text_domain' );
            
            if ( isset( $instance[ 'prevpageclass' ] ) ) $prevpageclass = $instance[ 'prevpageclass' ];
            else $prevpageclass = __( 'rss_pagination_prev', 'text_domain' );
            
            if ( isset( $instance[ 'activeclass' ] ) ) $activeclass = $instance[ 'activeclass' ];
            else $activeclass = __( 'rss_pagination_active', 'text_domain' );
            
            ?>
            <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'feedaddress' ); ?>"><?php _e( 'RSS Address(es):' ); ?></label><br />
            <span style="font-size: 10px;">Separate multiple addresses with commas</span>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'feedaddress' ); ?>" name="<?php echo $this->get_field_name( 'feedaddress' ); ?>"><?php echo esc_attr( $feedaddress ); ?></textarea>
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'display' ); ?>"><?php _e( 'Display Items per Page:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" type="text" value="<?php echo esc_attr( $display ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'order' ); ?>"><?php _e( 'Display Order (by date):' ); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
                <option value="desc"<?= (esc_attr( $order ) == 'desc') ? ' selected' : '' ?>>Descending</option>
                <option value="asc"<?= (esc_attr( $order ) == 'asc') ? ' selected' : '' ?>>Ascending</option>
                <option value="none"<?= (esc_attr( $order ) == 'none') ? ' selected' : '' ?>>None</option>
            </select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'dateformat' ); ?>"><?php _e( 'Date Format:' ); ?></label><br />
            <span style="font-size: 10px;">View <a href="http://php.net/manual/en/function.date.php" target="_blank">PHP date page</a> for options</span> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'dateformat' ); ?>" name="<?php echo $this->get_field_name( 'dateformat' ); ?>" type="text" value="<?php echo esc_attr( $dateformat ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'target' ); ?>"><?php _e( 'Links Target:' ); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>">
                <option value='_self'<?= (esc_attr( $target ) == '_self') ? ' selected' : '' ?>>_self</option>
                <option value='_blank'<?= (esc_attr( $target ) == '_blank') ? ' selected' : '' ?>>_blank</option>
                <option value='_parent'<?= (esc_attr( $target ) == '_parent') ? ' selected' : '' ?>>_parent</option>
                <option value='_top'<?= (esc_attr( $target ) == '_top') ? ' selected' : '' ?>>_top</option>
            </select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'titlelength' ); ?>"><?php _e( 'Title Length:' ); ?></label><br />
            <span style="font-size: 10px;">Specify a number or 'all'</span>
            <input class="widefat" id="<?php echo $this->get_field_id( 'titlelength' ); ?>" name="<?php echo $this->get_field_name( 'titlelength' ); ?>" type="text" value="<?php echo esc_attr( $titlelength ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'descriptionlength' ); ?>"><?php _e( 'Description Length:' ); ?></label><br />
            <span style="font-size: 10px;">Specify a number or 'all'</span>
            <input class="widefat" id="<?php echo $this->get_field_id( 'descriptionlength' ); ?>" name="<?php echo $this->get_field_name( 'descriptionlength' ); ?>" type="text" value="<?php echo esc_attr( $descriptionlength ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'contentlength' ); ?>"><?php _e( 'Content Length:' ); ?></label><br />
            <span style="font-size: 10px;">Specify a number or 'all'</span>
            <input class="widefat" id="<?php echo $this->get_field_id( 'contentlength' ); ?>" name="<?php echo $this->get_field_name( 'contentlength' ); ?>" type="text" value="<?php echo esc_attr( $contentlength ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'readmorelink' ); ?>"><?php _e( '"Read More" link:' ); ?></label> 
            <input type="hidden" name="<?php echo $this->get_field_name( 'readmorelink' ); ?>" value="0" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'readmorelink' ); ?>" name="<?php echo $this->get_field_name( 'readmorelink' ); ?>" type="checkbox" value="1"<?= ($readmorelink) ? ' checked' : '' ?> />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'readmoretext' ); ?>"><?php _e( '"Read More" text:' ); ?></label><br />
            <input class="widefat" id="<?php echo $this->get_field_id( 'readmoretext' ); ?>" name="<?php echo $this->get_field_name( 'readmoretext' ); ?>" type="text" value="<?php echo esc_attr( $readmoretext ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'renderhtml' ); ?>"><?php _e( 'Render HTML:' ); ?></label> 
            <input type="hidden" name="<?php echo $this->get_field_name( 'renderhtml' ); ?>" value="0" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'renderhtml' ); ?>" name="<?php echo $this->get_field_name( 'renderhtml' ); ?>" type="checkbox" value="1"<?= ($renderhtml) ? ' checked' : '' ?> />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'format' ); ?>"><?php _e( 'Item Format:' ); ?></label><br />
            <span style="font-size: 10px;">Takes full HTML, view <a href='<?= admin_url("/admin.php?page=rsskingpro") ?>'>RSSKingPro Settings page</a> for RSS variables</span>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'format' ); ?>" name="<?php echo $this->get_field_name( 'format' ); ?>" style="min-height: 200px;"><?php echo esc_attr( $format ); ?></textarea>
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'class' ); ?>"><?php _e( 'List Class:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'class' ); ?>" name="<?php echo $this->get_field_name( 'class' ); ?>" type="text" value="<?php echo esc_attr( $class ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'timezone' ); ?>"><?php _e( 'List Timezone:' ); ?></label><br />
            <span style="font-size: 10px;">View <a href='http://www.php.net/manual/en/timezones.php' target='_blank'>PHP timezones</a> for options</span>
            <input class="widefat" id="<?php echo $this->get_field_id( 'timezone' ); ?>" name="<?php echo $this->get_field_name( 'timezone' ); ?>" type="text" value="<?php echo esc_attr( $timezone ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'paging' ); ?>"><?php _e( 'Enable Paging:' ); ?></label> 
            <input type="hidden" name="<?php echo $this->get_field_name( 'paging' ); ?>" value="0" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'paging' ); ?>" name="<?php echo $this->get_field_name( 'paging' ); ?>" type="checkbox" value="1"<?= ($paging) ? ' checked' : '' ?> />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'pagingtype' ); ?>"><?php _e( 'Paging Type:' ); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'pagingtype' ); ?>" name="<?php echo $this->get_field_name( 'pagingtype' ); ?>">
                <option value='paging'<?= (esc_attr( $pagingtype ) == 'paging') ? ' selected' : '' ?>>Paging</option>
                <option value='numbers'<?= (esc_attr( $pagingtype ) == 'numbers') ? ' selected' : '' ?>>Numbers</option>
                <option value='both'<?= (esc_attr( $pagingtype ) == 'both') ? ' selected' : '' ?>>Both</option>
            </select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'paginglocation' ); ?>"><?php _e( 'Paging Location:' ); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'paginglocation' ); ?>" name="<?php echo $this->get_field_name( 'paginglocation' ); ?>">
                <option value='bottom'<?= (esc_attr( $paginglocation ) == 'bottom') ? ' selected' : '' ?>>Bottom</option>
                <option value='top'<?= (esc_attr( $paginglocation ) == 'top') ? ' selected' : '' ?>>Top</option>
                <option value='both'<?= (esc_attr( $paginglocation ) == 'both') ? ' selected' : '' ?>>Both</option>
            </select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'ajax' ); ?>"><?php _e( 'Enable Ajax:' ); ?></label> 
            <input type="hidden" name="<?php echo $this->get_field_name( 'ajax' ); ?>" value="0" />
            <input class="widefat" id="<?php echo $this->get_field_id( 'ajax' ); ?>" name="<?php echo $this->get_field_name( 'ajax' ); ?>" type="checkbox" value="1"<?= ($ajax) ? ' checked' : '' ?> />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'nextpagetext' ); ?>"><?php _e( '"Next Page" Text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'nextpagetext' ); ?>" name="<?php echo $this->get_field_name( 'nextpagetext' ); ?>" type="text" value="<?php echo esc_attr( $nextpagetext ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'prevpagetext' ); ?>"><?php _e( '"Previous Page" Text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'prevpagetext' ); ?>" name="<?php echo $this->get_field_name( 'prevpagetext' ); ?>" type="text" value="<?php echo esc_attr( $prevpagetext ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'nextpageclass' ); ?>"><?php _e( '"Next Page" Link Class:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'nextpageclass' ); ?>" name="<?php echo $this->get_field_name( 'nextpageclass' ); ?>" type="text" value="<?php echo esc_attr( $nextpageclass ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'prevpageclass' ); ?>"><?php _e( '"Next Page" Link Class:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'prevpageclass' ); ?>" name="<?php echo $this->get_field_name( 'prevpageclass' ); ?>" type="text" value="<?php echo esc_attr( $prevpageclass ); ?>" />
            </p>
            <p>
            <label for="<?php echo $this->get_field_name( 'activeclass' ); ?>"><?php _e( '"Active" Link Class:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'activeclass' ); ?>" name="<?php echo $this->get_field_name( 'activeclass' ); ?>" type="text" value="<?php echo esc_attr( $activeclass ); ?>" />
            </p>
            <?php 
	}

	public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['feedaddress'] = ( !empty( $new_instance['feedaddress'] ) ) ? strip_tags( $new_instance['feedaddress'] ) : '';
            $instance['display'] = ( !empty( $new_instance['display'] ) ) ? strip_tags( $new_instance['display'] ) : 5;
            $instance['order'] = ( !empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : 'desc';
            $instance['dateformat'] = ( !empty( $new_instance['dateformat'] ) ) ? strip_tags( $new_instance['dateformat'] ) : 'j F Y, g:i a';
            $instance['target'] = ( !empty( $new_instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : '_self';
            $instance['titlelength'] = ( !empty( $new_instance['titlelength'] ) ) ? strip_tags( $new_instance['titlelength'] ) : 'all';
            $instance['descriptionlength'] = ( !empty( $new_instance['descriptionlength'] ) ) ? strip_tags( $new_instance['descriptionlength'] ) : 'all';
            $instance['contentlength'] = ( !empty( $new_instance['contentlength'] ) ) ? strip_tags( $new_instance['contentlength'] ) : 'all';
            $instance['readmorelink'] = ( !empty( $new_instance['readmorelink'] ) || $new_instance['readmorelink'] == '1' ) ? true : false;
            $instance['readmoretext'] = ( !empty( $new_instance['readmoretext'] ) ) ? strip_tags( $new_instance['readmoretext'] ) : 'Read more';
            $instance['renderhtml'] = ( !empty( $new_instance['renderhtml'] ) || $new_instance['renderhtml'] == '1' ) ? true : false;
            $instance['format'] = ( !empty( $new_instance['format'] ) ) ? $new_instance['format'] : '<div class="rsskp_itemhead"><span class="rsskp_date">##PUBDATE##</span><h1 class="entry_title">##LINK##</h1></div><div class="rsskp_content">##DESCRIPTION##</div>';
            $instance['class'] = ( !empty( $new_instance['class'] ) ) ? strip_tags( $new_instance['class'] ) : '';
            $instance['timezone'] = ( !empty( $new_instance['timezone'] ) ) ? strip_tags( $new_instance['timezone'] ) : 'UTC';
            $instance['paging'] = ( !empty( $new_instance['paging'] ) || $new_instance['paging'] == '1' ) ? true : false;
            $instance['pagingtype'] = ( !empty( $new_instance['pagingtype'] ) ) ? strip_tags( $new_instance['pagingtype'] ) : 'paging';
            $instance['paginglocation'] = ( !empty( $new_instance['paginglocation'] ) ) ? strip_tags( $new_instance['paginglocation'] ) : 'bottom';
            $instance['ajax'] = ( !empty( $new_instance['ajax'] ) || $new_instance['ajax'] == '1' ) ? true : false;
            $instance['nextpagetext'] = ( !empty( $new_instance['nextpagetext'] ) ) ? strip_tags( $new_instance['nextpagetext'] ) : 'Next Page';
            $instance['prevpagetext'] = ( !empty( $new_instance['prevpagetext'] ) ) ? strip_tags( $new_instance['prevpagetext'] ) : 'Prev Page';
            $instance['nextpageclass'] = ( !empty( $new_instance['nextpageclass'] ) ) ? strip_tags( $new_instance['nextpageclass'] ) : 'rss_pagination_next';
            $instance['prevpageclass'] = ( !empty( $new_instance['prevpageclass'] ) ) ? strip_tags( $new_instance['prevpageclass'] ) : 'rss_pagination_prev';
            $instance['activeclass'] = ( !empty( $new_instance['activeclass'] ) ) ? strip_tags( $new_instance['activeclass'] ) : 'rss_pagination_active';

            return $instance;
	}

}

function rsskp_widget_registration() {
    register_widget( 'RSSKingPro_Widget' );
}

add_action( 'widgets_init', 'rsskp_widget_registration');
?>
