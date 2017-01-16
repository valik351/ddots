(
    function($, window, document) {
        $(document).ready(function() {
            $('[data-language-selector]').click(function() {
                $('input[name=programming_language]').val($(this).data('id'));
                $('[data-language-selector-button]').text($(this).text());
            });

            $(".dropdown-button").dropdown({
                belowOrigin: true
            });
        });
    })(jQuery, window, document);
