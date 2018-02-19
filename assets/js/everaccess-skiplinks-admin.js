jQuery(document).ready(function ($) {
    $(".ea-toggler").sortable();
    $(".ea-toggler").disableSelection();
    $(".ea-toggler > .btn-toggler").click(function () {
        var target_id = $(this).data("id");

        $(".ea-side-show").each(function () {
            if( !$(this).hasClass("hidden") )   $(this).addClass("hidden");
        });
        $( target_id ).removeClass("hidden");
    });
    $("#easl-add-item").click(function () {
        var heading_label   = $("#ea-skiplinks-metalist > .cnr-field:first-child > h4").text().split(" ");
        var input1_label    = $("#ea-skiplinks-metalist > .cnr-field:first-child > .first > label").text();
        var input2_label    = $("#ea-skiplinks-metalist > .cnr-field:first-child > .last > label").text();
        var remove_label    = $("#ea-skiplinks-metalist > .cnr-field:first-child > .ea-btn > .ea-remove-item").attr("aria-label");
        var drag_label      = $("#ea-skiplinks-metalist > .cnr-field:first-child > .ea-btn > .ea-drag-item").attr("aria-label");
        var old_item_index  = $("#ea-skiplinks-metalist > .cnr-field:last-child").attr("data-index");
        var new_item_index  = parseInt( old_item_index ) + 1;
        var input1_id       = 'ea_skiplink-id-' + new_item_index;
        var input2_id       = 'ea_skiplink-txt-' + new_item_index;

        var object  = '<div class="cnr-field" data-index="' + new_item_index + '">';
            object += ' <h4>' + heading_label[0] + ' ' + new_item_index + '</h4>';
            object += ' <div class="first">';
            object += '     <label for="' + input1_id + '">' + input1_label + '</label>';
            object += '     <input type="text" id="' + input1_id + '" name="' + input1_id + '" value="">';
            object += ' </div>';
            object += ' <div class="last">';
            object += '     <label for="' + input2_id + '">' + input2_label + '</label>';
            object += '     <input type="text" id="' + input2_id + '" name="' + input2_id + '" value="">';
            object += ' </div>';
            object += ' <div class="ea-btn">';
            object += '     <button type="button" id="easl-remove-item-" class="ea-remove-item" aria-label="' + remove_label + '">X</button>';
            object += '     <button type="button" id="easl-drag-item-" class="ea-drag-item" aria-label="' + drag_label + '">Z</button>';
            object += ' </div>';
            object += '</div>';
        $("#ea-skiplinks-metalist").append( object );
    });

    $(".ea-add-skiplink").click(function () {

        var last_item = $(this).next("ul.menu").find("li:last-child");

        if( last_item.length != 0 )
            var last_id = parseInt( last_item.data("id") );
        else
            var last_id = 1;

        var item = '';

        item += '<li class="menu-item menu-item-depth-0 menu-item-page menu-item-edit-inactive ea-menu-item-' + last_id + '" data-id="' + last_id + '">';
            item += '<div class="menu-item-bar">';
                item += '<a class="menu-item-handle" style="display: block;" data-id="' + last_id + '">';
                    item += '<span class="item-title">';
                        item += '<span class="menu-item-title">Content</span>';
                    item += '</span>';
                    item += '<span class="item-controls">';
                        item += '<a class="item-edit"><span class="screen-reader-text">Edit</span></a>';
                    item += '</span>';
                item += '</a>';
            item += '</div>';
            item += '<div class="menu-item-settings wp-clearfix">';
                item += '<p class="description description-wide"><label>Navigation Label<br><input type="text" class="widefat edit-menu-item-title" name="" value=""></label></p>';
                item += '<div class="menu-item-actions description-wide submitbox">';
                    item += '<a class="item-delete submitdelete deletion" href="#">Remove</a>';
            item += '</div>';
        item += '</li>';


        $(this).next("ul.menu").append( item );
    });

    $("li.menu-item-edit-inactive .menu-item-handle").click(function () {
        var getID = $(this).data("id");
console.log(getID);
        $(".ea-menu-item-" + getID).removeClass("menu-item-edit-inactive").addClass("menu-item-edit-active");
    });
    $("li.menu-item-edit-active .menu-item-handle").click(function () {
        var getID = $(this).data("id");

        $(".ea-menu-item-" + getID).removeClass("menu-item-edit-active").addClass("menu-item-edit-inactive");
    });
});