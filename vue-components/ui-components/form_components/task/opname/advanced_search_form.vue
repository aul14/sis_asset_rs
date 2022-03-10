<template>
<div class="row boxs">
    <div class="samrs-flex wrapped is-row fieldSearch">
        <div class="flex-box">
            <select class="form-control data_column_field w-100" data-live-search="true" name="q1">
                <option value="">Select Field</option>
                <option value="taskName">Task Name</option>
                <option value="taskDesc">Task Desc</option>
                <option value="scheduleStart">Schedule Start</option>
                <option value="scheduleEnd">Schedule End</option>
                <option value="taskKpi">Task Kpi</option>
                <option value="taskAmount">Task Amount</option>

            </select>
        </div>
        <div class="flex-box">
            <input class="form-control input-advanced-search" type="text" name="v1" data-col-index="2" placeholder="Search keyword">
        </div>
        <div class="flex-box">
            <select class="form-control data_column_field w-100" data-live-search="true" name="q2">
                <option value="">Select Field</option>
                <option value="taskName">Task Name</option>
                <option value="taskDesc">Task Desc</option>
                <option value="scheduleStart">Schedule Start</option>
                <option value="scheduleEnd">Schedule End</option>
                <option value="taskKpi">Task Kpi</option>
                <option value="taskAmount">Task Amount</option>
            </select>
        </div>
        <div class="flex-box">
            <input class="form-control input-advanced-search" type="text" name="v2" data-col-index="3" placeholder="Search keyword">
        </div>
        <div class="flex-box">
            <div class="dropdown dropleft">
                <button class="btn btn-block btn-sm samrs-success" data-toggle="dropdown" type="button"><i class="fas fa-plus"></i> Add Field</button>
                <ul class="dropdown-menu samrs-selector-form">
                    <li>
                        <button class="btn samrs-primary textForm" type="button" name="button"><i class="fas fa-edit"></i> Text form</button>
                    </li>
                    <li>
                        <button class="btn samrs-primary dateForm" type="button" name="button"><i class="fas fa-calendar"></i> Datetime form</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="boxs-action">
        <div class="samrs-flex">
            <div class="flex-box">
                <select class="form-control" name="status">
                    <option value="Active">Active</option>
                    <option value="Non-Active">Non-Active</option>
                </select>
            </div>
            <div class="flex-box">
                <button class="btn btn-sm samrs-primary" type="submit" name="button"><i class="fas fa-search"></i> Find</button>
            </div>
            <div class="flex-box">
                <a href="javascript:void(0)" class="btn btn-sm samrs-warning" type="button" name="button" v-on:click="reset()"><i class="fas fa-sync"></i> Reset Filter</a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        reset() {
            location.href = window.location.origin + window.location.pathname;
        }
    },
    beforeCreate() {
        // $(document).ready(function () {

        //     //         var FieldDate = `
        //     //   <div class="fieldSearchDate" style="display:none">
        //     //     <div class="samrs-flex wrapped is-row">
        //     //       <div class="flex-box">
        //     //          <select class="form-control data_column_field" name="procureDateStartq1">
        //     //            <option value="">Select Column</option>
        //     //            <option value="procureDate">Procure Date Start</option>
        //     //          </select>
        //     //        </div>
        //     //        <div class="flex-box">
        //     //          <input class="form-control" type="date" name="procureDateStart"  placeholder="Search keyword">
        //     //        </div>
        //     //       <div class="flex-box">
        //     //          <select class="form-control data_column_field" name="procureDateEndq2">
        //     //            <option value="">Select Column</option>
        //     //            <option value="procureDate">Procure Date End</option>
        //     //          </select>
        //     //        </div>
        //     //        <div class="flex-box">
        //     //          <input class="form-control" type="date" name="procureDateEnd"  placeholder="Search keyword">
        //     //        </div>
        //     //         <div class="flex-box">
        //     //           <button class="btn btn-block btn-sm samrs-danger removeForm"
        //     //           type="button" name="button"><i class="fas fa-times"></i> Remove</button>
        //     //         </div>
        //     //       </div>
        //     //     </div>`;

        //     //         $('body').find('.fieldSearch').after(FieldDate);

        // TableColumn();
        // });
    },
    mounted: function () {
        let thisNumber = 2,
            thisNumber2 = 2 + 1;
        $(document).ready(function () {

            $('.textForm').click(function () {
                thisNumber++;
                //     var FieldText = `
                // <div class="fieldSearchText" style="display:none">
                //   <div class="samrs-flex wrapped is-row">
                //     <div class="flex-box">
                //       <select class="form-control data_column_field" name="q` + thisNumber + `">
                //          <option value="">Select Field</option>
                //             <option value="idAsset">CODE</option>
                //             <option value="simakCode">Simak Code</option>
                //             <option value="assetName">ASSET NAME</option>
                //             <option value="merk">MERK</option>
                //             <option value="tipe">TYPE</option>
                //             <option value="serialNumber">SN</option>
                //             <option value="roomName">
                //                 Room Name</option>
                //             <option value="buildingName">
                //                 Building Name</option>
                //             <option value="yearProcurement">Year Procurement
                //             </option>
                //             <option value="condition">Condition</option>
                //             <option value="contactCompany">
                //                 VENDOR/ Company</option>
                //             <option value="lastUpdated">LAST CALIBRATED
                //             </option>
                //             <option value="calibrationMust">CAL. Required
                //             </option>
                //             <option value="ownershipType">Ownership Type
                //             </option>
                //             <option value="riskLevel">Risk Level</option>
                //       </select>
                //     </div>
                //     <div class="flex-box">
                //         <input class="form-control input-advanced-search" type="text" name="v` + thisNumber + `" data-col-index="` + thisNumber + `"  placeholder="Search keyword">
                //     </div>

                //       <div class="flex-box">
                //         <button class="btn btn-block btn-sm samrs-danger removeForm"
                //         type="button" name="button"><i class="fas fa-times"></i> Remove</button>
                //       </div>
                //     </div>
                //   </div>`;
                //     $('body').find('.fieldSearch').after(FieldText);
                var addfieldText = '<div class="fieldSearch">' + $(`<div class="fieldSearchText" style="display:none">
              <div class="samrs-flex wrapped is-row">
                <div class="flex-box">
                  <select class="form-control data_column_field" name="q` + thisNumber + `">
                     <option value="">Select Field</option>
              <option value="taskName">Task Name</option>
                <option value="taskDesc">Task Desc</option>
                <option value="scheduleStart">Schedule Start</option>
                <option value="scheduleEnd">Schedule End</option>
                <option value="taskKpi">Task Kpi</option>
                <option value="taskAmount">Task Amount</option>
                  </select>
                </div>
                <div class="flex-box">
                    <input class="form-control input-advanced-search" type="text" name="v` + thisNumber + `" data-col-index="` + thisNumber + `"  placeholder="Search keyword">
                </div>
                <div class="flex-box">
                  <select class="form-control data_column_field" name="bq` + thisNumber + `">
                  <option value="">Select Field</option>
                <option value="taskName">Task Name</option>
                <option value="taskDesc">Task Desc</option>
                <option value="scheduleStart">Schedule Start</option>
                <option value="scheduleEnd">Schedule End</option>
                <option value="taskKpi">Task Kpi</option>
                <option value="taskAmount">Task Amount</option>
                  </select>
                </div>
                <div class="flex-box">
                    <input class="form-control input-advanced-search" type="text" name="bv` + thisNumber + `" data-col-index="` + thisNumber + `"  placeholder="Search keyword">
                </div>
                  <div class="flex-box">
                    <button class="btn btn-block btn-sm samrs-danger removeForm"
                    type="button" name="button"><i class="fas fa-times"></i> Remove</button>
                  </div>
                </div>
              </div>`).html() + '</div>';
                $('body').find('.fieldSearch:last').after(addfieldText);
            });
            $('.dateForm').click(function () {
                var addfieldDate = '<div class="fieldSearch">' + $(` <div class="fieldSearchDate" style="display:none">
        <div class="samrs-flex wrapped is-row">
          <div class="flex-box">
             <select class="form-control data_column_field" name="start_dateq1">
               <option value="">Select Column</option>
               <option value="timeInit">Start Date</option>
               <option value="scheduleStart">Schedule Start</option>
               <option value="scheduleEnd">Schedule End</option>
             </select>
           </div>
           <div class="flex-box">
             <input class="form-control" type="date" name="start_date"  placeholder="Search keyword">
           </div>
          <div class="flex-box">
             <select class="form-control data_column_field" name="start_dateq2">
               <option value="">Select Column</option>
              <option value="timeInit">Start Date</option>
               <option value="scheduleStart">Schedule Start</option>
               <option value="scheduleEnd">Schedule End</option>
             </select>
           </div>
           <div class="flex-box">
             <input class="form-control" type="date" name="end_date"  placeholder="Search keyword">
           </div>
            <div class="flex-box">
              <button class="btn btn-block btn-sm samrs-danger removeForm"
              type="button" name="button"><i class="fas fa-times"></i> Remove</button>
            </div>
          </div>
        </div>`).html() + '</div>';
                $('body').find('.fieldSearch:last').after(addfieldDate);
                DatePicker();
            });
            $('.boxs').on('click', '.removeForm', function () {
                $(this).parents(".fieldSearch").remove();
            });
        });
    }
}
</script>

<style scoped>
.boxs {
    margin-left: 1px;
}

.data-option-box {
    width: 100px !important;
}
</style>
