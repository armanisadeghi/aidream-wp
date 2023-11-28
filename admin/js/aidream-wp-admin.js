(function($) {
    $(document).ready(function() {
        $('#select_post').on('change', function() {
            var val = $(this).val();
            $.get('/wp-json/aidream-wp/v1/meta?post_id=' + val, function(resp) {
                $('#meta_title').val(resp.title);
                $('#meta_desc').val(resp.description);
            });
        });
    });
})(jQuery);
