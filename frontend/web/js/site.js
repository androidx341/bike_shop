$("document").ready(function(){
    $("#form_pjax").on("pjax:end", function() {
        $.pjax.reload({container:"#update_pjax"});  //Reload GridView
    });
});

/**
 * Update product list on change
 */
function updateResults() {
    $('#filter-form').submit();
}


