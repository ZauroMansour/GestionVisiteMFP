$(document).on('change', '#visite_region',
    function () {
        let $field = $(this);
        // let $regionField = $('#visite_region')
        let $form = $field.closest('form');
        let target = '#visite_departement';
        // Les données à envoyer en Ajax
        let data = {};
        // data[$regionField.attr('name')] = $regionField.val()
        data[$field.attr('name')] = $field.val();
        // On soumet les données
        $('#naissloader').show();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                // Replace current position field ...
                $(target).replaceWith(
                    // ... with the returned one from the AJAX response.
                    $(html).find(target)
                );
                // Position field now displays the appropriate positions.
                $('#naissloader').hide();
            }
        });
    }
);

$(document).on('change', '#visite_structure',
    function () {
        let $field = $(this);
        // let $regionField = $('#visite_region')
        let $form = $field.closest('form');
        let target = '#visite_service';
        // Les données à envoyer en Ajax
        let data = {};
        // data[$regionField.attr('name')] = $regionField.val()
        data[$field.attr('name')] = $field.val();
        // On soumet les données
        $('#naissloader').show();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                // Replace current position field ...
                $(target).replaceWith(
                    // ... with the returned one from the AJAX response.
                    $(html).find(target)
                );
                // Position field now displays the appropriate positions.
                $('#naissloader').hide();
            }
        });
    }
);

$(document).on('change', '#visite_service',
    function () {
        let $field = $(this);
        // let $regionField = $('#visite_region')
        let $form = $field.closest('form');
        let target = '#visite_motifDemande';
        // Les données à envoyer en Ajax
        let data = {};
        // data[$regionField.attr('name')] = $regionField.val()
        data[$field.attr('name')] = $field.val();
        // On soumet les données
        $('#naissloader').show();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                // Replace current position field ...
                $(target).replaceWith(
                    // ... with the returned one from the AJAX response.
                    $(html).find(target)
                );
                // Position field now displays the appropriate positions.
                $('#naissloader').hide();
            }
        });
    }
);

window.onload = function() {
    const repeat_email_input = document.getElementById('visite_email_second');
    if (repeat_email_input) {
        repeat_email_input.onpaste = function(e) {
            e.preventDefault();
            return false;
        }
    }
};