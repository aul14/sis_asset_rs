<template>
<div class="p-10">
    <slot name="table-detailhospital"></slot>

</div>
</template>

<script>
module.exports = {
    // data(){
    //   return {
    //     location:[
    //       {"input":"<input type='checkbox'/>","name":"hospital 1","address":"Depok"},
    //       {"input":"<input type='checkbox'/>","name":"hospital 2","address":"Bogor"},
    //       {"input":"<input type='checkbox'/>","name":"hospital 3","address":"Tangerang"},
    //       {"input":"<input type='checkbox'/>","name":"hospital 4","address":"Bekasi"},
    //       {"input":"<input type='checkbox'/>","name":"hospital 5","address":"Jakarta"}
    //     ]
    //   }
    // },//this for example data fetch
    mounted() {
        function locationList() {
            $('.location-list').DataTable({
                columns: [{
                        'title': '#',
                        'name': null
                    },
                    {
                        'title': 'hospital name',
                        'name': 'hospital_name'
                    },
                    {
                        'title': 'address',
                        'name': 'address'
                    },
                ],
                retrieve: true,
                dom: 'Rtr',
                pageLength: 15,
                lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
            });
        }
        locationList();

        // second example
        $("#navigation").treeview({
            persist: "location",
            collapsed: true,
            unique: true
        });
    }
}
</script>
