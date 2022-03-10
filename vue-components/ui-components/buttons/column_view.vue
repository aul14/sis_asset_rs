<template>
<div class="grid-box">
    <div class="dropdown">
        <a href="#" class="btn btn-block samrs-brown-dark dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-columns"></i> Column
        </a>
        <ul class="dropdown-menu limit-height data_column">
        </ul>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        let table = this.$parent.$data.tabledata[0];
        let ColumnData = this.$parent.$data.tabledata[0].settings().init().columns;
        let ColumnDataDefs = this.$parent.$data.tabledata[0].settings().init().columnDefs;

        if (ColumnDataDefs == undefined) {
            for (var i = 2; i < ColumnData.length; i++) {
                $('.data_column').append('<li class="mb-1">' +
                    '<div>' +
                    '<div class="custom-control custom-switch">' +
                    '<input class="custom-control-input" data-toggle="column-list" checked type="checkbox" id="toggle_' + [i] + '" data-column="' + ColumnData[i].name + '">' +
                    '<label class="custom-control-label" for="toggle_' + [i] + '">' + ColumnData[i].title + '</label>' +
                    '</div>' +
                    '</div>' +
                    '</li>');
                $('#toggle_' + [i]).on('change', function (e) {
                    e.preventDefault();
                    var columns = table.column($(this).attr('data-column') + ':name');
                    if (this.checked) {
                        columns.visible(true);
                    } else {
                        columns.visible(false);
                    }
                });
                $(".data_column").sortable({
                    start: function (event, ui) {
                        var start_pos = ui.item.index();
                        ui.item.data('start_pos', start_pos);
                    },
                    change: function (event, ui) {
                        var start_pos = ui.item.data('start_pos');
                        var index = ui.placeholder.index();
                    }
                });
                $(".data_column").disableSelection();
            }
        } else {
            for (var i = 2; i < ColumnDataDefs.length; i++) {
                $('.data_column').append('<li class="mb-1">' +
                    '<div>' +
                    '<div class="custom-control custom-switch">' +
                    '<input class="custom-control-input" data-toggle="column-list" checked type="checkbox" id="toggle_' + [i] + '" data-column="' + ColumnData[i].name + '">' +
                    '<label class="custom-control-label" for="toggle_' + [i] + '">' + ColumnDataDefs[i].name + '</label>' +
                    '</div>' +
                    '</div>' +
                    '</li>');
                $('#toggle_' + [i]).on('change', function (e) {
                    e.preventDefault();
                    var columns = table.column($(this).attr('data-column') + ':name');
                    if (this.checked) {
                        columns.visible(true);
                    } else {
                        columns.visible(false);
                    }
                });
                $(".data_column").sortable({
                    start: function (event, ui) {
                        var start_pos = ui.item.index();
                        ui.item.data('start_pos', start_pos);
                    },
                    change: function (event, ui) {
                        var start_pos = ui.item.data('start_pos');
                        var index = ui.placeholder.index();
                    }
                });
                $(".data_column").disableSelection();
            }
        }

    }
}
</script>
