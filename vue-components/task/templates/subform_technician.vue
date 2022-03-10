<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. technincian engineer / vendor in-charges</label>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">technician in-charges</label>
        </div>
        <div class="col-xl-8">
            <div class="p-10 border-1 border-light">
                <input type="text" class="form-control" readonly name="startBy" id="startBy">
                <input type="hidden" name="idStartBy" id="idStartBy">
            </div>
        </div>
    </div>
    <div class="form-group row" id="row-teknisi">
        <div class="col-xl-4">
            <label class="form-title">technician assistant</label>
        </div>
        <div class="col-xl-8">
            <div class="p-10 border-1 border-light">
                <div class="p-10 collapse border-1 border-light" id="assistantField">
                    <form id="uploadForm" method="post">
                        <div class="form-group">
                            <select name="idUserPic[]" id="idUserPic" data-live-search="true" multiple class="form-control selectpicker-asstech with-ajax-asstech">
                                <option id="option-ajax-asstech">Select</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm samrs-primary btn-block" type="submit" name="button"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </form>
                </div>
                <button class="btn btn-sm samrs-primary mb-10 mr-10 mt-10 float-right" id="btn-addteknisi" type="button" data-toggle="collapse" data-target="#assistantField">
                    <i class="fas fa-plus"></i> Add New</button>
                <div class="table-responsive">
                    <table class="techassistant_list table samrs-tableview capitalize w-100">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>name</th>
                                <th id="th-option-teknisi">option</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row" id="row-vendor">
        <div class="col-xl-4">
            <label class="form-title">vendor technician</label>
        </div>
        <div class="col-xl-8">
            <div class="p-10 border-1 border-light">
                <input type="hidden" name="vendorName" id="vendorName">
                <select name="idVendor" id="idVendor" class="form-control">
                    <option value="" id="option-vendor"></option>
                </select>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            number: 0
        }
    },
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
    mounted() {
        $("[data-toggle=collapse]").on("click", function () {
            let target = $(this).attr("data-target");
            let that = $(this);
            $("" + target + "").on("show.bs.collapse", function () {
                that.removeClass("samrs-primary").addClass("samrs-danger");
                that.html('<i class="fas fa-times"></i> Cancel');
            });
            $("" + target + "").on("hide.bs.collapse", function () {
                that.removeClass("samrs-danger").addClass("samrs-primary");
                that.html('<i class="fas fa-plus"></i> Add new');
            });
        });

        $('form#uploadForm').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var ajax_idform = $("input[name=idForm]").val();

            if (ajax_idform != '') {
                var url = BASE_URL + 'task/med/task_datatable/session_add_asstech/' + ajax_idform;
            } else {
                var url = BASE_URL + 'task/med/task_datatable/session_add_asstech/';
            }
            // console.log(formData);
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (data) {
                    // const response = JSON.parse(data)
                    // console.log(data)
                    // if (ajax_idasset_edit === '') {
                    $('.techassistant_list').DataTable().ajax.reload();
                    // } else {
                    //   $('.file_list').DataTable().ajax.url(BASE_URL + "asset_propfiles/asset_propfiles_by_id_asset/" + ajax_idasset_edit).load();
                    // }

                },
                error: function (data) {
                    console.log(data)
                },
                cache: false,
                contentType: false,
                processData: false
            });

        });

        evtAsstech('init');

        TechAssistantList();

        function evtAsstech(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/building/room_bld/ajax_user",
                    type: "POST",
                    dataType: "json",
                    // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
                    // automatically replace it with the value of the search query.
                    data: {
                        q: "{{{q}}}",
                    },
                },
                locale: {
                    emptyTitle: "Tap to search",
                },
                log: 3,
                preprocessData: function (data) {
                    var i,
                        l = data.length,
                        array = [];

                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push(
                                $.extend(true, data[i], {
                                    text: data[i].userFullName,
                                    value: data[i].idUser,
                                    // data: {
                                    //     subtext: data[i].catCode + "-" + data[i].idAsset
                                    // }
                                })
                            );
                        }
                    }
                    // You must always return a valid array when processing data. The
                    // data argument passed is a clone and cannot be modified directly.
                    return array;
                },
            };

            if (evt == "init") {
                $(".selectpicker-asstech")
                    .selectpicker()
                    .filter(".with-ajax-asstech")
                    .ajaxSelectPicker(options);
            } else if (evt == "render") {
                $(".selectpicker-asstech")
                    .selectpicker()
                    .filter(".with-ajax-asstech")
                    .ajaxSelectPicker("render");
            }
        }

        function TechAssistantList() {
            $(".techassistant_list").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_asstech",
                columns: [{
                        // title: "no",
                        // name: "no",
                        data: null,
                    },
                    {
                        // title: "name",
                        // name: "name",
                        data: "picName",
                    },
                    {
                        // title: "option",
                        // name: "option",
                        data: null,
                        render: function (data, type, row) {
                            return `<a onClick="return delete_confirmation_asstech_repair(event, ${(data.idFPic == null ? data.idUserPic : data.idFPic)})" href="javascript:void(0);"  class="btn-deletefile  btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

                        }
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
                serverSide: true,
                dom: "tr",
                pageLength: 15,
                lengthMenu: [
                    15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
                    100,
                ],
            });
        }

        var vendorName;
        $('#idVendor').focus(function () {
            $('#idVendor').select2({
                width: '100%',
                ajax: {
                    url: BASE_URL + 'contact/contact_query',
                    dataType: 'json',
                    type: 'GET',
                    processResults: function (data) {
                        vendorName = data;
                        return {
                            results: $.map(data['data'], function (item) {
                                return {
                                    text: item.contactCompany,
                                    id: item.idContact
                                }
                            })
                        };
                    },
                }
            });
        });

        $('#idVendor').change(function () {
            if (vendorName) {
                vendorName.data.map(function (item) {
                    // console.log(item)
                    if (item.idContact == $('#idVendor').val()) {
                        $('#vendorName').val(item.contactCompany)
                    }
                })
            }
        });

    }
}
</script>

<style scoped>
.is-soft-rounded {
    border-radius: 2px !important;
}
</style>
