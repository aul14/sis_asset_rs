<template>
<div class="col-xl-8">
    <div class="card samrs-card more-space">
        <div class="card-header m-0" data-color-type="info">
            <p class="text-bold">Contact list</p>
        </div>
        <div class="card-body contactlist-scrollable">
            <ul class="list-view list-data">
                <li v-if="this.$parent.$data.contactList.length === 0">
                    <p class="text-center text-capitalize">there's no contact available</p>
                </li>
                <li v-else v-for="data in sortedData" :key="data.idContact">
                    <div class="card is-rounded with-shadow hoverable border-1 border-light mb-10" :data-left-border="borderType(data.contactType)" title="Click for details">
                        <div class="card-body p-10">
                            <div class="samrs-contact-box">
                                <div class="contact-action">
                                    <button class="btn samrs-success is-outline" type="button" id="btn-contact-edit" :data-idedit="data.idContact"><i class="fas fa-edit" id="btn-icon"></i> </button>
                                    <button class="btn samrs-danger is-outline" type="button" id="btn-contact-hapus" :data-idhapus="data.idContact"><i class="fas fa-trash" id="btn-icon"></i> </button>
                                </div>
                                <div class="contact-icon" with-state="preview-contact" :contact="data.idContact">
                                    <div class="avatar-circle" v-if="data.contactPerson != ''" :style="'background-color:'+AvatarBackground(data.contactPerson.substring(0,3).toUpperCase())+'!important'">
                                        <span class="char_name">{{ data.contactPerson.substring(0,1)}}</span>
                                    </div>
                                    <div class="avatar-circle" v-else :style="'background-color:'+AvatarBackground(data.contactCompany.substring(0,3).toUpperCase())+'!important'">
                                        <span class="char_name">{{ data.contactCompany.substring(0,1)}}</span>
                                    </div>
                                </div>
                                <div class="contact-info" with-state="preview-contact" :contact="data.idContact">
                                    <p class="contact-name" v-if="data.contactPerson !=''">{{ data.contactPerson }}</p>
                                    <p class="contact-name" v-else>{{ data.contactCompany }}</p>
                                    <p class="contact-phone" v-if="data.contactMobile !='' || data.contactPhone !=''"><i class="fas fa-phone-square-alt"></i> {{ data.contactMobile }} <span v-if="data.contactPhone !=''">/</span> {{ data.contactPhone }}</p>
                                    <p class="contact-company" v-if="data.contactEmail ==''">{{ data.contactCompany }}</p>
                                    <p class="contact-company" v-else>{{ data.contactEmail }}</p>
                                    <p class="contact-type" :data-color-type="colorType(data.contactType)">{{ contactTypetext(data.contactType) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div with-state="previewModal" class="modal samrs-modal slide fade">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <p>contact info</p>
                    <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="card-body">
                    <input type="hidden" with-state="process-id" name="" value="">
                    <div class="samrs-detail-box">
                        <label class="detail-title">General info</label>
                        <table class="samrs-tableview td-first-title">
                            <tr data-state="contactPerson">
                                <td>Name</td>
                            </tr>
                            <tr data-state="contactCompany">
                                <td>company / vendor</td>
                            </tr>
                            <tr data-state="contactEmail">
                                <td>email</td>
                            </tr>
                            <tr data-state="contactMobile">
                                <td>mobile</td>

                            </tr>
                            <tr data-state="contactPhone">
                                <td>phone</td>
                            </tr>
                            <tr data-state="contactType">
                                <td>contact type</td>
                            </tr>
                        </table>
                    </div>
                    <div class="samrs-detail-box mt-20">
                        <label class="detail-title">addtional info</label>
                        <table class="samrs-tableview td-first-title">
                            <tr data-state="contactWeb">
                                <td>websites</td>
                            </tr>
                            <tr data-state="contactAddress1">
                                <td>address 1</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    computed: {
        sortedData() {
            return this.$parent.$data.contactList.map(data => data).sort((a, b) => {
                if (a.contactPerson != "" && b.contactPerson != "") {
                    let pa = a.contactPerson.substring(0, 1).toUpperCase(),
                        pb = b.contactPerson.substring(0, 1).toUpperCase();
                    if (pa < pb) {
                        return -1
                    }
                    if (pa > pb) {
                        return 1
                    }
                    return 0
                } else {
                    let ca = a.contactCompany.substring(0, 1).toUpperCase(),
                        cb = b.contactCompany.substring(0, 1).toUpperCase();
                    if (ca < cb) {
                        return -1
                    }
                    if (ca > cb) {
                        return 1
                    }
                    return 0
                }
            });
        }
    },
    methods: {
        Alerts() {
            alert("Clickable");
        },
        calculateColor(text) {
            var sum = 0;
            for (index in text) {
                sum += text.charCodeAt(index);
            }
            return sum % this.$parent.$data.colors.length;
        },
        borderType(type) {
            if (type === 'SUPPLIER') {
                return 'dark';
            } else if (type === 'CALIBRATION_INSTITUTION') {
                return 'success';
            } else if (type === 'CUSTOMER') {
                return 'danger';
            } else {
                return 'primary';
            }
        },
        colorType(type) {
            if (type === 'SUPPLIER') {
                return 'dark';
            } else if (type === 'CALIBRATION_INSTITUTION') {
                return 'success';
            } else if (type === 'CUSTOMER') {
                return 'danger';
            } else {
                return 'primary';
            }
        },
        contactTypetext(type) {
            if (type === 'SUPPLIER') {
                return 'Supplier';
            } else if (type === 'CALIBRATION_INSTITUTION') {
                return 'Calibration Institution';
            } else if (type === 'CUSTOMER') {
                return 'Customer';
            } else {
                return 'People';
            }
        },
        AvatarBackground(word) {
            let colorId = this.calculateColor(word);
            return this.$parent.$data.colors[colorId];
        }
    },
    mounted: function () {
        $(document).ready(function () {
            SamrsModal();
        });

        //create fun delete contact
        $(document).on('click', '#btn-contact-hapus', function () {
            var idContact = $(this).data('idhapus');
            $.confirm({
                title: "Confirmation",
                content: "Are You Sure You Will Delete Data ?",
                theme: 'bootstrap',
                columnClass: 'medium',
                typeAnimated: true,
                buttons: {
                    hapus: {
                        text: 'Submit',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                type: 'POST',
                                url: BASE_URL + "contact/delete",
                                data: {
                                    'idContact': idContact,
                                },
                                dataType: 'json',
                                success: function (response) {
                                    // console.log(response.queryResult)
                                    if (response.queryResult === true) {
                                        document.location.href = BASE_URL + "contact";
                                    } else {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Oops...',
                                            text: response.queryMessage,
                                        });
                                    }
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: thrownError,
                                    });
                                }
                            });
                        }
                    },
                    close: function () {}
                }
            });
        });

        //create fun edit contact
        $(document).on('click', '#btn-contact-edit', function () {
            var idContact = $(this).data('idedit');
            $('#contact_form').modal('show');
            $('#contact_form').find('.samrs-form').append(`
              <div class="loader">
                <div></div>
                <div></div>
                <div></div>
              </div>
              `);
            $.ajax({
                type: "POST",
                url: BASE_URL + "contact/contact_by_id",
                data: {
                    'idContact': idContact
                },
                dataType: "json",
                success: function (res) {
                    $("#title-contact").html("edit contact");
                    $("#formType").val("edit");
                    $("input[name=idContact]").val(res.idContact);
                    $("input[name=contactPerson]").val(res.contactPerson);
                    $("input[name=contactCompany]").val(res.contactCompany);
                    $("input[name=contactEmail]").val(res.contactEmail);
                    $("input[name=contactPhone]").val(res.contactPhone);
                    $("input[name=contactMobile]").val(res.contactMobile);
                    $("input[name=contactAddress2]").val(res.contactAddress2);
                    $("textarea[name=contactAddress1]").val(res.contactAddress1);

                    if (res.contactType == "PERSON") {
                        $("#contactType1").prop("checked", true);
                    } else if (res.contactType == "CALIBRATION_INSTITUTION") {
                        $("#contactType2").prop("checked", true);
                    } else if (res.contactType == "SUPPLIER") {
                        $("#contactType3").prop("checked", true);
                    } else if (res.contactType == "CUSTOMER") {
                        $("#contactType4").prop("checked", true);
                    }
                    $('#contact_form').find('.loader').remove();
                }
            });
        });
        //
        // function sort(selector, children) {
        //     $(selector).children(children).sort(function (a, b) {
        //         var A = $(a).text().toUpperCase();
        //         var B = $(b).text().toUpperCase();
        //         return (A < B) ? -1 : (A > B) ? 1 : 0;
        //     }).appendTo(selector);
        // }
    },
    updated() {
      $('div[with-state="preview-contact"]').each(function() {
        $(this).click(function() {
          $('div[with-state="previewModal"]').modal('show');
          $('div[with-state="previewModal"]').find('input[with-state="process-id"]').val($(this).attr('contact'))
        });
      });
      $('div[with-state="previewModal"]').on('shown.modal.bs', function () {
        $('div[with-state="previewModal"]').find('.samrs-detail-box').append(`
          <div class="loader">
            <div></div>
            <div></div>
            <div></div>
          </div>
          `);
        let contactId = $('div[with-state="previewModal"]').find('input[with-state="process-id"]').val();
        let postData = new FormData();
        postData.append('idContact',contactId);
        axios.post(BASE_URL+'contact/contact_by_id', postData)
        .then((response) => {
          let printOut = response.data;
          $('tr[data-state="contactPerson"]').append('<td>'+printOut.contactPerson+'</td>');
          $('tr[data-state="contactCompany"]').append('<td>'+printOut.contactCompany+'</td>');
          $('tr[data-state="contactEmail"]').append('<td samrs-typography="clear-transform">'+printOut.contactEmail+'</td>');
          $('tr[data-state="contactMobile"]').append('<td>'+printOut.contactMobile+'</td>');
          $('tr[data-state="contactPhone"]').append('<td>'+printOut.contactPhone+'</td>');

          if (printOut.contactType === 'SUPPLIER') {
            $('tr[data-state="contactType"]').append('<td samrs-typography="uppercase center" data-color-type="dark"><p class="mb-0">supplier</p></td>');
          } else if (printOut.contactType === 'CALIBRATION_INSTITUTION') {
            $('tr[data-state="contactType"]').append('<td samrs-typography="uppercase center" data-color-type="success"><p class="mb-0">calibration institution</p></td>');
          } else if (printOut.contactType === 'CUSTOMER') {
            $('tr[data-state="contactType"]').append('<td samrs-typography="uppercase center" data-color-type="danger"><p class="mb-0">customer</p></td>');
          } else {
            $('tr[data-state="contactType"]').append('<td samrs-typography="uppercase center" data-color-type="primary"><p class="mb-0">people</p></td>');
          }
          $('tr[data-state="contactWeb"]').append('<td samrs-typography="clear-transform"><a href="'+printOut.contactAddress2+'" target="_blank">'+printOut.contactAddress2+'</a></td>');
          $('tr[data-state="contactAddress1"]').append('<td>'+printOut.contactAddress1+'</td>');

          $('div[with-state="previewModal"]').find('.loader').remove();
        });
      })
      $('div[with-state="previewModal"]').on('hidden.modal.bs', function() {
        $('tr[data-state]').each(function() {
          $(this).find('td:last').remove();
        })
      });

        $(document).ready(function () {
            SamrsModal();
        });
    },
}
</script>
