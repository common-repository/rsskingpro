jQuery(document).ready(function($) {
   $('body').on('click', '.rsskpajax_pagination',function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        var pos = $(this).offset().top;
        var btn = $(this);
        btn.html('<img src="'+RsskpAjax.pluginurl+'/images/ajax-loader.gif" />');

        $('.rsskp_pagination').append($("<div style='display: none;'>").load(link + ' .rsskp_feeditems ul', function() {
            $('html, body').animate({
                scrollTop: pos - 30
            }, 2000);
            $(this).fadeIn(2000);
            btn.fadeOut(function() {
                $(this).remove();
            });
            $('.rsskp_pagination').append($("<div>").load(link + ' .rsskpajax_pagination', function() {}, 500));
        }, 500));
    }); 
});