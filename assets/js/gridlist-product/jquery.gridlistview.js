// The toggle
jQuery(document).ready(function() {

    jQuery("#view-mode-switcher a").click(function(e) {
        e.preventDefault();
    })
    
    jQuery("#grid").click(function() {
        jQuery(this).addClass("active");
        jQuery("#list").removeClass("active");
        jQuery.cookie("gridcookie", "grid", {
            path: "/"
        });
        jQuery(".products.row").fadeOut(300, function() {
            jQuery('.product-small').removeClass('box-vertical');
            // jQuery('.product-small .box-text-products').addClass('text-center');
            jQuery(this).removeClass('columns-list').fadeIn(300);
        });
        return false;
    });

    jQuery("#list").click(function() {
        jQuery(this).addClass("active");
        jQuery("#grid").removeClass("active");
        jQuery.cookie("gridcookie", "list", {
            path: "/"
        });
        jQuery(".products.row").fadeOut(300, function() {
            jQuery('.product-small').addClass('box-vertical');
            // jQuery('.product-small .box-text-products').removeClass('text-center');
            jQuery(this).addClass('columns-list').fadeIn(300);
        });
        return false;
    });

    if ( jQuery.cookie("gridcookie") == null ) {
        jQuery(".view-mode-switcher #grid").addClass("active");
    }
    else if ( jQuery.cookie("gridcookie") == "grid") {
        jQuery(".view-mode-switcher #grid").addClass("active");
        jQuery(".view-mode-switcher #list").removeClass("active");

        jQuery('.product-small').removeClass('box-vertical');
        // jQuery('.product-small .box-text-products').addClass('text-center');
        jQuery('.products.row').remove('columns-list').fadeIn(300);
    }
    else if (jQuery.cookie("gridcookie") == "list") {
        jQuery(".view-mode-switcher #list").addClass("active");
        jQuery(".view-mode-switcher #grid").removeClass("active");

        jQuery('.product-small').addClass('box-vertical');
        // jQuery('.product-small .box-text-products').removeClass('text-center');
        jQuery('.products.row').addClass('columns-list').fadeIn(300);
    }

});
