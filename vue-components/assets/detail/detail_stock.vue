<template>
<div class="p-10">
    <div class="samrs-detail-box">
        <label class="detail-title">stock in</label>
        <div class="table-responsive">
            <table class="detail_tab_stock_in table samrs-tableview capitalize">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">stock out</label>
        <div class="table-responsive">
            <table class="detail_tab_stock_out table samrs-tableview capitalize">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        function DetailTabStockIn() {
            $('.detail_tab_stock_in').DataTable({
                columns: [{
                        title: 'no',
                        data: null,
                        name: 'no'
                    },
                    {
                        title: 'location',
                        data: 'propLocation.roomName',
                        name: 'location'
                    },
                    {
                        title: 'quantity',
                        data: 'inQty',
                        name: 'qty'
                    },
                    {
                        title: 'stock name',
                        data: 'inName',
                        name: 'stock_name'
                    },
                    {
                        title: 'last updated',
                        data: 'lastUpdated',
                        name: 'last_updated'
                    },
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                    var index = iDisplayIndex + 1;
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var page = pageInfo.page;
                    var length = pageInfo.length;
                    var number = (page * length) + index;

                    $('td:eq(0)', nRow).html(number);
                    return nRow;

                },
                retrieve: true,
                dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
                searching: true,
                pageLength: 15,
                lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
            });
        }

        function DetailTabStockOut() {
            $('.detail_tab_stock_out').DataTable({
                columns: [{
                        title: 'no',
                        data: null,
                        name: 'no'
                    },
                    {
                        title: 'location',
                        data: 'propLocation.roomName',
                        name: 'location'
                    },
                    {
                        title: 'quantity',
                        data: 'outQty',
                        name: 'qty'
                    },
                    {
                        title: 'stock name',
                        data: 'outName',
                        name: 'stock_name'
                    },
                    {
                        title: 'description',
                        data: 'outDesc',
                        name: 'description'
                    },
                    {
                        title: 'last updated',
                        data: 'lastUpdated',
                        name: 'last_updated'
                    },
            
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                    var index = iDisplayIndex + 1;
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var page = pageInfo.page;
                    var length = pageInfo.length;
                    var number = (page * length) + index;

                    $('td:eq(0)', nRow).html(number);

                    return nRow;
                },
                retrieve: true,
                dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
                searching: true,
                pageLength: 15,
                lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
            });
        }
        DetailTabStockIn();
        DetailTabStockOut();
    }
}
</script>
