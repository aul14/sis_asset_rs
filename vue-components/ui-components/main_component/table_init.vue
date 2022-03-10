<template>
<div style="display:none">
</div>
</template>

<script>
module.exports = {
    created() {
        var tableData = [];
        let table = new TableData();
        tableData.push(table);
        // resize the table
        function resizeTable() {
            if ($(window).height() >= 1920) {
                table.page.len(1000).draw();
            } else if ($(window).height() >= 1080) {
                table.page.len(300).draw();
            } else if ($(window).height() >= 820) {
                table.page.len(100).draw();
            } else if ($(window).height() >= 720) {
                table.page.len(50).draw();
            }
        }
        this.$parent.$data.tabledata = tableData;
        this.$nextTick(function () {
            paginationWidth();
            resizeTable();
            changetableHeight();
            $('.table-pagination').children().addClass('mr-10 pr-20');
        });

        function changetableHeight() {
            let newHeight = $('.page-content').height() - $('.actioncard').outerHeight() - 200;
            return $('.dataTables_scrollBody').css('max-height', newHeight + 'px');
        }

        function paginationWidth() {
            let contentWidth = $('.contentcard').width() - 150;
            return $('.table-pagination').css('max-width', +contentWidth + 'px');
        }
        $(window).resize(function () {
            paginationWidth();
            resizeTable();
            changetableHeight();
        });
    },
    mounted() {
        let table = this.$parent.$data.tabledata[0];
        $('.quick_search').on('keyup change clear', function () {
            table.search(this.value).draw();
        });
    }
}
</script>
