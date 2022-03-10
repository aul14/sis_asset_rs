<template>
<div style="display:none">
</div>
</template>

<script>
module.exports = {
    created() {
      $(document).ready(function(){
      ScheduleTable();
      paginationWidth();
    });
    function paginationWidth(){
      let contentWidth = $('.schedulecard').width() - 200;
      return $('.table-pagination').css('max-width',+contentWidth+'px');
    }
    $(window).resize(function () {
        paginationWidth();
      });
    },
    beforeMount() {
        currentMonth = moment().months();
        currentYears = moment().years();

        startOfMonth = moment().startOf(currentMonth).format('YYYY-MM-DD');
        endOfMonth = moment().endOf(currentMonth).format('YYYY-MM-DD');

        console.log(startOfMonth, endOfMonth);
        $('table.samrs-table2').attr('data-start', startOfMonth);
        $('table.samrs-table2').attr('data-end', endOfMonth);
        $('table.samrs-table2').attr('data-month', currentMonth);
        $('table.samrs-table2').attr('data-year', currentYears);
    },
    mounted() {
        var monthname = [
            "january",
            "february",
            "march",
            "april",
            "may",
            "june",
            "july",
            "august",
            "september",
            "october",
            "november",
            "december"
        ];
        let month = parseInt($('table.samrs-table2').attr('data-month'));
        var years = parseInt($('table.samrs-table2').attr('data-year'));
        var dayofmonth = moment([years, month]).daysInMonth();
        $('.samrs-table2 .month').attr('colspan', dayofmonth);
        $('.samrs-table2 .month-name').text(monthname[month]);
        $('.samrs-table2 .month-name').attr('colspan', dayofmonth);
        for (var i = 1; i <= dayofmonth; i++) {
            $('.samrs-table2 .days').append('<td>' + i + '</td>');
        }

        function incrementMonth(e) {
            e.preventDefault();
            let maxMonth = 11;
            let thismonth = parseInt($('table.samrs-table2').attr('data-month'));
             $('table.samrs-table2').attr('data-start');
            $('table.samrs-table2').attr('data-end');
            if (thismonth >= maxMonth) {
                $('.nextMonth').attr('disabled', true);
            } else {
                $('.nextMonth').attr('disabled', false);
                $('.prevMonth').attr('disabled', false);
                $('table.samrs-table2').attr('data-month', ++thismonth);
            }
            let dayofmonthchange = moment([years, thismonth]).daysInMonth();
            $('.samrs-table2 .days td').remove();
            for (var i = 1; i <= dayofmonthchange; i++) {
                $('.samrs-table2 .days').append('<td>' + i + '</td>');
            }
            $('.samrs-table2 .month').attr('colspan', dayofmonthchange);
            $('.samrs-table2 .month-name').text(monthname[thismonth]);
            $('.samrs-table2 .month-name').attr('colspan', dayofmonthchange);
        }

        function decrementMonth(e) {
            e.preventDefault();
            var minMonth = 0;
            let thismonth = parseInt($('table.samrs-table2').attr('data-month'));
            $('table.samrs-table2').attr('data-start');
            $('table.samrs-table2').attr('data-end');
            if (thismonth <= minMonth) {
                $('.prevMonth').attr('disabled', true);
            } else {
                $('.nextMonth').attr('disabled', false);
                $('.prevMonth').attr('disabled', false);
                $('table.samrs-table2').attr('data-month', --thismonth);
            }
            let dayofmonthchange = moment([years, thismonth]).daysInMonth();
            $('.samrs-table2 .days td').remove();
            for (var i = 1; i <= dayofmonthchange; i++) {
                $('.samrs-table2 .days').append('<td>' + i + '</td>');
            }
            $('.samrs-table2 .month').attr('colspan', dayofmonthchange);
            $('.samrs-table2 .month-name').text(monthname[thismonth]);
            $('.samrs-table2 .month-name').attr('colspan', dayofmonthchange);
        }
        $('.nextMonth').click(function (e) {
            incrementMonth(e)
        });
        $('.prevMonth').click(function (e) {
            decrementMonth(e);
        });
    }
}
</script>
