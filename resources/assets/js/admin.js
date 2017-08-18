$(document).ready(function () {

    $(document).on("click", "[data-generate-name]", function(e) {

        let $form = $(this).closest('form'),
            field = $(this).attr('data-generate-name'),
            $field = $form.find('[name="' + field + '"]');

        $.ajax({
            type: "POST",
            url :"/admin/generate-name",
            data: $form.serialize()
        }).done(function(response) {

            if(response.length) {

                $field.val(response);

            }

        });

    });

    $(document).on("click", "[data-generate]", function(e) {

        var from = $(this).attr('data-from').split(','),
            _val = [],
            $to = $(document).find('[name="' + $(this).attr('data-to') + '"]');

        for(let i = 0; i < from.length; i++) {

            _val.push($(document).find('[name="' + from[i] + '"]').val());

        }

        $.ajax({
            type: "GET",
            url :"/admin/slug-string",
            data: {
                value: _val
            }
        }).done(function(response) {

            if(response.length) {

                $to.val(response);

            }

        });

    });

    $('select[name="sizes[]"][multiple]').select2({
        maximumSelectionLength: 8
    });

    $('select[name="colors[]"][multiple]').select2({
        maximumSelectionLength: 7
    });

    $(document).find(".has-error").each(function() {

        var $tab = $(this).closest("div.tab-pane"),
            id = $tab.attr('id'),
            $href = $('a[href="#' + id + '"]').closest('li');

        $href.css('border-top-color', 'red');

    });

});

document.querySelectorAll('[data-status]').forEach(function(el, index) {

    var status = el.getAttribute('data-status'),
        new_class = "",
        row = el.closest("tr");

    if(status === "canceled") {

        new_class = "bg-danger";

    } else if(status === "done") {

        new_class = "bg-success";

    } else if(status === 'in_work') {

        new_class = 'bg-info';

    }

    try { row.classList.add(new_class); } catch(err) {}

});