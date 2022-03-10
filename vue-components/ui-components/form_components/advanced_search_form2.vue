<template>
<div class="samrs-flex wrapped is-row boxs">
    <div class="samrs-flex wrapped is-row fieldSearch">
        <div class="flex-box">
            <select class="form-control data_column_field" data-live-search="true" name="q1">
                <option value="">Select Field</option>
            </select>
        </div>
        <div class="flex-box">
            <input class="form-control input-advanced-search" type="text" name="v1" data-col-index="2" placeholder="Search keyword" />
        </div>
        <div class="flex-box">
            <select class="form-control data_column_field" data-live-search="true" name="q2">
                <option value="">Select Field</option>
            </select>
        </div>
        <div class="flex-box">
            <input class="form-control input-advanced-search" type="text" name="v2" data-col-index="3" placeholder="Search keyword" />
        </div>
        <div class="flex-box">
            <div class="dropdown dropleft">
                <button class="btn btn-block btn-sm samrs-success" data-toggle="dropdown" type="button">
                    <i class="fas fa-plus"></i> Add Field
                </button>
                <ul class="dropdown-menu samrs-selector-form">
                    <li>
                        <button class="btn samrs-primary textForm" type="button" name="button">
                            <i class="fas fa-edit"></i> Text form
                        </button>
                    </li>
                    <li>
                        <button class="btn samrs-primary dateForm" type="button" name="button">
                            <i class="fas fa-calendar"></i> Datetime form
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="boxs-action">
        <div class="samrs-flex">
            <!-- <div class="flex-box">
                <select class="form-control data-option-box" name="status">
                    <option value="Active">Active</option>
                    <option value="Non-Active">Non-Active</option>
                </select>
            </div> -->
            <div class="flex-box">
                <button class="btn btn-sm samrs-primary" type="submit">
                    <i class="fas fa-search"></i> Find
                </button>
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
    data() {
        return {
            textfield: 2,
        };
    },
    methods: {
        reset() {
            location.href = window.location.origin + window.location.pathname;
        },
    },
    mounted() {
        let ColumnData = this.$parent.$parent.$parent.$data.tabledata[0]
            .settings()
            .init().columns;
        let ColumnDataDefs = this.$parent.$parent.$parent.$data.tabledata[0]
            .settings()
            .init().columnDefs;

        if (ColumnDataDefs == undefined) {
            for (var i = 2; i < ColumnData.length; i++) {
                $(".data_column_field").append(
                    '<option value="' +
                    ColumnData[i].name +
                    '">' +
                    ColumnData[i].title +
                    "</option>"
                );
            }
            var numbertextfield = this.textfield;
            $(".textForm").click(function () {
                numbertextfield++;
                var FieldText =
                    `
          <div class="samrs-flex wrapped is-row fieldSearch">
            <div class="flex-box">
               <select class="form-control data_column_field" name="q` +
                    numbertextfield +
                    `">
                 <option value="">Select Field</option>
               </select>
             </div>
             <div class="flex-box">
               <input class="form-control" type="text" name="v` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
             </div>
             <div class="flex-box">
               <select class="form-control data_column_field" name="bq` +
                    numbertextfield +
                    `">
                 <option value="">Select Field</option>
               </select>
             </div>
             <div class="flex-box">
               <input class="form-control" type="text" name="bv` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
             </div>
              <div class="flex-box">
                <button class="btn btn-block btn-sm samrs-danger removeForm"
                type="button" name="button"><i class="fas fa-times"></i> Remove</button>
              </div>
            </div>`;
                $(".boxs").append(FieldText);
                for (var i = 2; i < ColumnData.length; i++) {
                    $("body")
                        .find(".data_column_field")
                        .append(
                            '<option value="' +
                            ColumnData[i].name +
                            '">' +
                            ColumnData[i].title +
                            "</option>"
                        );
                }
            });
            $(".dateForm").click(function () {
                numbertextfield++;
                var FieldDate =
                    `
      <div class="samrs-flex wrapped is-row fieldSearch">
        <div class="flex-box">
           <select class="form-control data_column_field" name="startDateq` +
                    numbertextfield +
                    `">
             <option value="">Select Field</option>
           </select>
         </div>
         <div class="flex-box">
           <input class="form-control" type="date" name="startDatev` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
         </div>
         <div class="flex-box">
           <select class="form-control data_column_field" name="startDatebq` +
                    numbertextfield +
                    `">
             <option value="">Select Field</option>
           </select>
         </div>
         <div class="flex-box">
           <input class="form-control" type="date" name="startDatebv` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
         </div>
          <div class="flex-box">
            <button class="btn btn-block btn-sm samrs-danger removeForm"
            type="button" name="button"><i class="fas fa-times"></i> Remove</button>
          </div>
        </div>`;
                $(".boxs").append(FieldDate);
                DatePicker();
                for (var i = 2; i < ColumnData.length; i++) {
                    $("body")
                        .find(".data_column_field")
                        .append(
                            '<option value="' +
                            ColumnData[i].name +
                            '">' +
                            ColumnData[i].title +
                            "</option>"
                        );
                }
            });
            $(document).ready(function () {
                $(".boxs").on("click", ".removeForm", function () {
                    $(this).parents(".fieldSearch").remove();
                });
            });
        } else {
            for (var i = 2; i < ColumnData.length; i++) {
                $(".data_column_field").append(
                    '<option value="' +
                    ColumnData[i].name +
                    '">' +
                    ColumnDataDefs[i].name +
                    "</option>"
                );
            }
            var numbertextfield = this.textfield;
            $(".textForm").click(function () {
                numbertextfield++;
                var FieldText =
                    `
          <div class="samrs-flex wrapped is-row fieldSearch">
            <div class="flex-box">
               <select class="form-control data_column_field" name="q` +
                    numbertextfield +
                    `">
                 <option value="">Select Field</option>
               </select>
             </div>
             <div class="flex-box">
               <input class="form-control" type="text" name="v` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
             </div>
             <div class="flex-box">
               <select class="form-control data_column_field" name="bq` +
                    numbertextfield +
                    `">
                 <option value="">Select Field</option>
               </select>
             </div>
             <div class="flex-box">
               <input class="form-control" type="text" name="bv` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
             </div>
              <div class="flex-box">
                <button class="btn btn-block btn-sm samrs-danger removeForm"
                type="button" name="button"><i class="fas fa-times"></i> Remove</button>
              </div>
            </div>`;
                $(".boxs").append(FieldText);
                for (var i = 2; i < ColumnData.length; i++) {
                    $("body")
                        .find(".data_column_field")
                        .append(
                            '<option value="' +
                            ColumnData[i].name +
                            '">' +
                            ColumnDataDefs[i].name +
                            "</option>"
                        );
                }
            });
            $(".dateForm").click(function () {
                numbertextfield++;
                var FieldDate =
                    `
      <div class="samrs-flex wrapped is-row fieldSearch">
        <div class="flex-box">
           <select class="form-control data_column_field" name="q` +
                    numbertextfield +
                    `">
             <option value="">Select Field</option>
           </select>
         </div>
         <div class="flex-box">
           <input class="form-control" type="date" name="v` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
         </div>
         <div class="flex-box">
           <select class="form-control data_column_field" name="bq` +
                    numbertextfield +
                    `">
             <option value="">Select Field</option>
           </select>
         </div>
         <div class="flex-box">
           <input class="form-control" type="date" name="bv` +
                    numbertextfield +
                    `" value="" placeholder="Search keyword">
         </div>
          <div class="flex-box">
            <button class="btn btn-block btn-sm samrs-danger removeForm"
            type="button" name="button"><i class="fas fa-times"></i> Remove</button>
          </div>
        </div>`;
                $(".boxs").append(FieldDate);
                DatePicker();
                for (var i = 2; i < ColumnData.length; i++) {
                    $("body")
                        .find(".data_column_field")
                        .append(
                            '<option value="' +
                            ColumnData[i].name +
                            '">' +
                            ColumnDataDefs[i].name +
                            "</option>"
                        );
                }
            });
            $(document).ready(function () {
                $(".boxs").on("click", ".removeForm", function () {
                    $(this).parents(".fieldSearch").remove();
                });
            });
        }
    },
};
</script>

<style scoped>
.boxs {
    margin-left: 1px;
}

.data-option-box {
    width: 100px !important;
}
</style>
