<template>
<div class="p-2">
    <slot name="table-appmenu"></slot>

</div>
</template>

<script>
module.exports = {
    mounted() {
        $('input[toggle-for]').each(function () {
            let toggleFor = $(this).attr('toggle-for');
            $(this).click(function () {
                if (this.checked === true) {
                    $('.collapse[tag-name="' + toggleFor + '"]').collapse('show');
                } else {
                    $('.collapse[tag-name="' + toggleFor + '"]').collapse('hide');
                }
            });
            if (this.checked === true) {
                $('.collapse[tag-name="' + toggleFor + '"]').collapse('show');
            } else {
                $('.collapse[tag-name="' + toggleFor + '"]').collapse('hide');
            }
        });
        let chkBoxArray = [];
        $('input[with-state="checked-all-child"], button[with-state="checked-all-child"]').click(function () {
            let fieldSet = $(this).parents('div[data-parent]').attr('data-parent');
            $('div[data-parent="' + fieldSet + '"] input[is-child]:checkbox').not(this).not('input[with-state="toggle-check-child"], button[with-state="toggle-check-child"]').prop('checked', this.checked);

            $('input:checkbox[class=check-fitur]:checked').each(function () {
                let code = $(this).data('code');
                if (code == "CAL" || code == "INP" || code == "MTN" || code == "MUT" || code == "CPL" || code == "RPR" || code == "NCAL" || code == "NINP" || code == "NMTN" || code == "NMUT" || code == "NCPL" || code == "NRPR" || code == "SOM") {
                    if ($(this).prop('checked')) {
                        chkBoxArray.push(code);
                        let uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);
                        $("#taskCode").val(uniqueChkBoxArray);
                        // console.log(uniqueChkBoxArray);
                    } else {
                        let uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);
                        uniqueChkBoxArray.splice(0, uniqueChkBoxArray.length);
                        // console.log(uniqueChkBoxArray);
                    }
                }
            });

            if (this.checked === true) {
                $(this).parents('button').removeClass('samrs-primary').addClass('samrs-danger');
                $(this).next('span').text("Uncheck All");
            } else {
                $(this).parents('button').removeClass('samrs-danger').addClass('samrs-primary');
                $(this).next('span').text("Check All");
            }
        });
        $('input[with-state="toggle-check-child"], button[with-state="toggle-check-child"]').click(function () {
            let fieldSet = $(this).parents('div[data-parent]').attr('data-parent');
            $('div[data-parent="' + fieldSet + '"] input[is-child]:checkbox').each(function () {
                $(this).not('input[with-state="checked-all"], button[with-state="checked-all"]').prop('checked', !$(this)[0].checked);
            });
            if ($('div[data-parent="' + fieldSet + '"] input[is-child]:checkbox').is(':checked') === true) {
                $(this).find('i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
            } else {
                $(this).find('i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
            }
        });
        $('input[with-state="checked-all"], button[with-state="checked-all"]').click(function () {
            let fieldSet = $(this).parents('fieldset').attr('data-parent');
            $('fieldset[data-parent="' + fieldSet + '"] input[toggle-for]:checkbox').not(this).not('input[with-state="toggle-check"], button[with-state="toggle-check"]').prop('checked', this.checked);
            $('fieldset[data-parent="' + fieldSet + '"] input[toggle-for]:checkbox').each(function () {
                if (this.checked == true) {
                    $('.collapse[tag-name="' + $(this).attr('toggle-for') + '"]').collapse('show');
                } else {
                    $('.collapse[tag-name="' + $(this).attr('toggle-for') + '"]').collapse('hide');
                }
            })
            if (this.checked === true) {
                $(this).parents('button').removeClass('samrs-primary').addClass('samrs-danger');
                $(this).next('span').text("Uncheck All");
            } else {
                $(this).parents('button').removeClass('samrs-danger').addClass('samrs-primary');
                $(this).next('span').text("Check All");
            }
        });
        $('input[with-state="toggle-check"], button[with-state="toggle-check"]').click(function () {
            let fieldSet = $(this).parents('fieldset').attr('data-parent');
            $('fieldset[data-parent="' + fieldSet + '"] input[toggle-for]:checkbox').each(function () {
                $(this).not('input[with-state="checked-all"], button[with-state="checked-all"]').prop('checked', !$(this)[0].checked);
                if (this.checked === true) {
                    $('.collapse[tag-name="' + $(this).attr('toggle-for') + '"]').collapse('show');
                } else {
                    $('.collapse[tag-name="' + $(this).attr('toggle-for') + '"]').collapse('hide');
                }
            });
            if ($('fieldset[data-parent="' + fieldSet + '"] input[toggle-for]:checkbox').is(':checked') === true) {
                $(this).find('i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
            } else {
                $(this).find('i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
            }
        });
    }
}
</script>
