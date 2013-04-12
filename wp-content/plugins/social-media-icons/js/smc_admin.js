function toObject(arr) {
    var rv = {};
    for (var i = 0; i < arr.length; ++i)
    if (typeof arr[i] == 'object'){
        rv[i] = toObject(arr[i]);
    } else if (arr[i] !== undefined){ 
        rv[i] = arr[i];
    }
    return rv;
}

jQuery(document).ready(function(){
    /*Tooltip*/
    jQuery("A#more_info").tooltip({
        events: { def: "mouseenter,mouseleave" },
        position: 'center left', 
        offset: [0, 15]
    });
    jQuery("A#more_info").live("mouseenter", function(e){
        jQuery(this).tooltip({
            events: { def: "mouseenter,mouseleave" },
            position: 'center left', 
            offset: [0, 15]
        });
        jQuery(this).trigger('mouseenter');
    });

    jQuery("A#more_info").live("click", function(e){
        return false;
    });

    jQuery("#widget_icon_setup DIV.icon_container IMG:not(.icon_disabled), #widget_icon_setup DIV.icon_container IMG:not(.icon_disabled) + span").live('click', function(){
        var parentdivid = jQuery(this).parent('.icon_container').attr('id');
        var iconname = parentdivid.replace("icon_container", "");
        jQuery(this).closest("DIV#widget_icon_setup").find("P.icon_url_input:not('#" + iconname + "_icon_url_input')").hide();
        jQuery(this).closest("DIV#widget_icon_setup").find("P#" + iconname + "_icon_url_input").toggle();
    });

    jQuery('.smc_theme_select').live('change', function(){
        var widget = jQuery(this).closest('DIV.widget');
        wpWidgets.save(widget, 0, 1);
    });
});




var sOptions = {
    items : "> DIV.icon_container",
    cursor: "move",
    distance: 5,
    update: function(event, ui) {
        var $selected_iconset = jQuery(this).closest('.widget-content').find('.smc_theme_select').val();
        var sortDiv = jQuery(this);
        var sortedIDs = sortDiv.sortable( "toArray" );
        jQuery.each(sortedIDs, function(index, value){
            sortDiv.find('DIV#'+value+' .smc_sort').val(index);
        });
        var oSortedIDs = toObject(sortedIDs);
        var $smc_sortable_data_raw = unescape(sortDiv.find('.smc_sortable').val());
        if ($smc_sortable_data_raw.length > 2){
            var $smc_sortable_data = jQuery.parseJSON($smc_sortable_data_raw);
            $smc_sortable_data[''+$selected_iconset+''] = oSortedIDs;
            var $serialized = escape(JSON.stringify($smc_sortable_data));
        } else {
            var $serialized = escape(JSON.stringify({$selected_iconset : oSortedIDs}));
        }
        sortDiv.find('.smc_sortable').val($serialized);
    },
    create: function( event, ui ) {
        var $selected_iconset = jQuery(this).closest('.widget-content').find('.smc_theme_select').val();
        var sortDiv = jQuery(this);
        var $serialized = unescape(sortDiv.find('.smc_sortable').val(), 'ENT_QUOTES');
        if ($serialized.length > 1){
            var $unserialized_data = jQuery.parseJSON($serialized);
            if ($unserialized_data[''+$selected_iconset+''] !== undefined) {
                var $unserialized = $unserialized_data[''+$selected_iconset+''];
                jQuery('<div id="smc_sorted" class="iconset_container_bdr"></div>').insertAfter(sortDiv);
                jQuery.each($unserialized, function(index, value){
                    sortDiv.find('DIV#'+value+' .smc_sort').val(index)
                    .end()
                    .find('DIV#'+value)
                    .appendTo('#smc_sorted');
                });
                jQuery('#smc_sorted DIV.icon_container').appendTo(sortDiv);
                jQuery('#smc_sorted').remove();                   
            }
        }                                             
    },
    start: function( event, ui ) {
        var parentdivid = jQuery(ui.item).attr('id');
        var iconname = parentdivid.replace("icon_container", "");
        jQuery(ui.item).closest("DIV#widget_icon_setup").find("P.icon_url_input:not('#" + iconname + "_icon_url_input')").hide();
        jQuery(ui.item).closest("DIV#widget_icon_setup").find("P#" + iconname + "_icon_url_input").toggle();
    }
};
