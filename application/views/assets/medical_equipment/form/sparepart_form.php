<div id="sparepart_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="ajax-stock-form">
      <div class="modal-content">
        <div class="modal-header">
          <p id="title-asset">add new medical equipment sparepart and disposable</p>
          <a href="<?= base_url('asset/me/sparepart_med'); ?>" class="btn btn-rounded btn-outline-danger" type="button" class="close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form">
          <input name="idAsset" type="hidden" id="ajax_idasset_edit" />
          <input name="subSysCat" id="subSysCat" type="hidden" value="-">
          <main-form class="modal-all-parts">
            <template v-slot:kategori-tab>
              <input name="catCode" id="ajax_catCode" type="hidden">
              <select class="form-control selectpicker-not-ajax with-ajax-kategori" data-live-search="true" name="catcode_kategori" id="catcode_kategori">
                <option value="">Tap to search</option>
                <?php foreach ($data_kategori as $data) : ?>
                  <option value="<?= $data['catCode']; ?>"><?= $data['assetCatName']; ?></option>
                <?php endforeach; ?>
              </select>
            </template>
          </main-form>
          <div class="samrs-tab red" id="ajax_page_tab" style="display: none;">
            <ul class="nav nav-tabs" role="tablist" id="ajax_tab_ul">
              <li class="nav-item" role="presentation" id="ajax_tab_li_general" style="display: none;">
                <a class="nav-link active" href="#general" data-toggle="tab" role="tab">general</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_code" style="display: none;">
                <a class="nav-link" href="#code" data-toggle="tab" role="tab">code</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_instrument" style="display: none;">
                <a class="nav-link" href="#instrument" data-toggle="tab" role="tab">instrument</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_building" style="display: none;">
                <a class="nav-link" href="#building" data-toggle="tab" role="tab">building</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_vehicle" style="display: none;">
                <a class="nav-link" href="#vehicle" data-toggle="tab" role="tab">vehicle</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_land" style="display: none;">
                <a class="nav-link" href="#land" data-toggle="tab" role="tab">land</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_stock" style="display: none;">
                <a class="nav-link" href="#stock" data-toggle="tab" role="tab">stock</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_file" style="display: none;">
                <a class="nav-link" href="#file" data-toggle="tab" role="tab">file</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_depre1" style="display: none;">
                <a class="nav-link" href="#depreciation_1" data-toggle="tab" role="tab">depreciation 1</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_depre2" style="display: none;">
                <a class="nav-link" href="#depreciation_2" data-toggle="tab" role="tab">depreciation 2</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_license" style="display: none;">
                <a class="nav-link" href="#license" data-toggle="tab" role="tab">license</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_aspak" style="display: none;">
                <a class="nav-link" href="#aspak" data-toggle="tab" role="tab">aspak</a>
              </li>
              <li class="nav-item" role="presentation" id="ajax_tab_li_simak" style="display: none;">
                <a class="nav-link" href="#simak" data-toggle="tab" role="tab">simak</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade" role="tabpanel" id="general">
                <form-general>
                  <template v-slot:funding-tab>
                    <select class="form-control selectpicker-not-ajax" data-live-search="true" name="propAssetPropadmin_idFund" id="propAssetPropadmin_idFund">
                      <!-- <option value="">Tap to search</option> -->
                      <?php foreach ($data_funding as $data) : ?>
                        <option value="<?= $data['idFund']; ?>"><?= $data['fundName']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </template>
                </form-general>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="code">
                <form-code></form-code>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="instrument">
                <form-instrument></form-instrument>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="building">
                <form-building></form-building>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="vehicle">
                <form-vehicle></form-vehicle>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="land">
                <form-land></form-land>
              </div>
              <div class="tab-pane fade show active" role="tabpanel" id="stock">
                <!-- <form-stock></form-stock> -->
                <div class="p-1">
                  <div class="row">
                    <div class="col-xl-6">
                      <div class="form-group row name-parts" style="display: none;">
                        <div class="col-4">
                          <label class="form-title">asset name</label>
                        </div>
                        <div class="col-8">
                          <input class="form-control" readonly type="text" id="ajax_assetname_stock">
                        </div>
                      </div>
                      <!-- <div class="form-group row">
                        <div class="col-4">
                          <label class="form-title">po. number</label>
                        </div>
                        <div class="col-8">
                          <input class="form-control" autocomplete="off" type="text" name="propAssetPropadmin_poNumb_stock" id="propAssetPropadmin_poNumb">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-4">
                          <label class="form-title">price buy</label>
                        </div>
                        <div class="col-8">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <label class="input-group-text">Rp.</label>
                            </div>
                            <input class="form-control" autocomplete="off" data-val="true" data-val-number="The field Cost must be a number." data-val-range="Cost Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Cost field is required." onkeypress="return hanyaAngka(event)" type="text" name="propAssetPropadmin_priceBuy_stock" id="propAssetPropadmin_priceBuy_stock">
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group row">
                        <div class="col-xl-4">
                          <label class="form-title">stock location</label>
                        </div>
                        <input class="form-control" name="propAssetPropadmin_idRoom_stock" type="hidden" />
                        <input class="form-control" name="idStockIn" type="hidden" />
                        <input class="form-control" name="idStockOut" type="hidden" />
                        <div class="col-xl-8">
                          <div class="input-group">
                            <input class="form-control" type="text" name="propAssetPropstock_idLocation" id="propAssetPropstock_idLocation" readonly>
                            <div class="input-group-prepend click-lokasi" style="display: none;">
                              <button class="btn samrs-primary" type="button" name="button" onclick="selectlocation2()">Pick</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xl-4">
                          <label class="form-title">stock name</label>
                        </div>
                        <div class="col-xl-8">
                          <input class="form-control" type="text" autocomplete="off" name="propAssetPropstock_stockName">
                          <input class="form-control" type="hidden" autocomplete="off" name="propAssetPropstock_stockName2">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xl-4">
                          <label class="form-title">quantity stock</label>
                        </div>
                        <div class="col-xl-8">
                          <input class="form-control" name="propAssetPropstock_qtyCurrent" onkeypress="return hanyaAngka(event)" type="text" autocomplete="off">
                          <input class="form-control" name="propAssetPropstock_qtyCurrent2" onkeypress="return hanyaAngka(event)" type="hidden" autocomplete="off">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xl-4">
                          <label class="form-title">quantity</label>
                        </div>
                        <div class="col-xl-8">
                          <div class="row">
                            <div class="col-xl-6">
                              <label class="form-title">quantity minimum stock</label>
                              <input class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event)" type="text" name="propAssetPropstock_qtyMin">
                              <input class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event)" type="hidden" name="propAssetPropstock_qtyMin2">
                            </div>
                            <div class="col-xl-6">
                              <label class="form-title">quantity available</label>
                              <input class="form-control" readonly type="number" style="display: none;" name="ajax_qty_in" id="ajax_qty_in">
                              <input class="form-control" readonly type="number" style="display: none;" name="ajax_qty_out" id="ajax_qty_out">
                              <input class="form-control" readonly type="number" name="ajax_qty_all" id="ajax_qty_all">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="form-group row">
                        <div class="col-xl-4">
                          <label class="form-title">description</label>
                        </div>
                        <div class="col-xl-8">
                          <textarea class="form-control" name="propAssetPropstock_stockDesc" id="propAssetPropstock_stockDesc" rows="8" cols="80"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xl-6">
                      <fieldset class="border-1 border-light field-roles">
                        <legend class="field-parent-name text-center w-25 ml-10">Stock In</legend>
                        <div class="float-right mr-20">
                          <button class="btn samrs-primary" type="submit" name="button" id="ajax_btn_stock_in"><i class="fas fa-plus"></i> Add Stock In</button>
                        </div>
                        <div class="table-responsive">
                          <table class="stockin_list table samrs-tableview capitalize samrs-table-striped table-hover">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </fieldset>
                    </div>
                    <div class="col-xl-6">
                      <fieldset class="border-1 border-light field-roles">
                        <legend class="field-parent-name text-center w-25 ml-10">Stock Out</legend>
                        <div class="float-right mr-20">
                          <button class="btn samrs-primary" type="submit" name="button" id="ajax_btn_stock_out"><i class="fas fa-plus"></i> Add Stock Out</button>
                        </div>
                        <div class="table-responsive">
                          <table class="stockout_list table samrs-tableview capitalize samrs-table-striped table-hover">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
                <!-- <form  method="post"> -->
                <!-- </form> -->
              </div>
              <div class="tab-pane fade" role="tabpanel" id="file">
                <form-file></form-file>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="depreciation_1">
                <form-depreciation-1></form-depreciation-1>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="depreciation_2">
                <form-depreciation-2></form-depreciation-2>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="license">
                <form-license></form-license>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="aspak">
                <form-aspak></form-aspak>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="simak">
                <form-simak></form-simak>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('asset/me/sparepart_med'); ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="select_print_qr" class="modal samrs-modal bounce fade w-100">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <p>choose print qr</p>
          <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body samrs-form">
          <div class="col-xl-12 text-center">
            <button class="btn samrs-primary print_qrku" type="submit" name="cetak_besar" value="cetak_besar">Print 70x24MM</button>
            <button class="btn samrs-success print_qrku" type="submit" name="cetak_kecil" value="cetak_kecil">Print 24x24MM</button>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <div class="mr-10 ml-10">
          <button class="btn samrs-primary btn-ajax-lokasi" type="button" name="button">Save & Exit</button>
        </div> -->
          <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal upload file -->
<div class="modal samrs-modal bounce fade" id="file_uploadModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="uploadForm" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload New File</h5>
          <button type="button" class="btn btn-rounded btn-outline-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body samrs-form">
          <div class="form-group row">
            <div class="col-5">
              <label class="form-title">file upload category</label>
            </div>
            <div class="col-7">
              <select class="form-control selectpicker-filecat with-ajax-filecat" data-live-search="true" id="idCat" name="idCat">
              </select>
            </div>
          </div>
          <div class="form-group">
            <input class="form-control" type="file" name="image">
          </div>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save_upload" id="save_upload">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal instrument -->
<div class="modal samrs-modal bounce fade" id="instrument_Modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <!-- <form id="instrumentForm" method="post"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Instrument Piece</h5>
        <button type="button" class="btn btn-rounded btn-outline-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body samrs-form">
        <div class="table-responsive">
          <table class="select_instrument_piece table samrs-tableview capitalize samrs-table-striped table-hover w-100">
            <thead>
              <tr>

                <th class="p-2 align-middle" style="width:50px !important">
                  <input type="checkbox" id="checkAll" class="customcheck">
                </th>
                <th class="p-2 text-center align-middle" style="width:50px !important">No</th>
                <th class="p-2 text-center align-middle">Instrument Piece Name</th>
                <th class="p-2 text-center align-middle">Alias Name</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" type="submit" name="save" id="selectAllIdAssetMaster">Save & Exit</button>
        </div>
        <!-- <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a> -->
      </div>
    </div>
    <!-- </form> -->
  </div>
</div>

<div id="select_location" class="modal samrs-modal bounce fade w-100">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <p>select location</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body samrs-form">
        <div class="table-responsive">
          <table class="select_location table samrs-tableview capitalize samrs-table-striped table-hover">
            <thead>
            </thead>
            <tbody class="tbody-list">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <div class="mr-10 ml-10">
          <button class="btn samrs-primary btn-ajax-lokasi" type="button" name="button">Save & Exit</button>
        </div> -->
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

<div class="modal samrs-modal bounce fade" id="brand_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="brandForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Brand</h5>
          <button type="button" class="btn btn-rounded btn-outline-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body samrs-form">

          <div class="form-group row">
            <div class="col-5">
              <label class="form-title">brand name</label>
            </div>
            <div class="col-7">
              <input type="text" class="form-control" autocomplete="off" name="brandName" id="ajax_brandName">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save_brand" id="save_brand">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
  function selectlocation2() {
    $('#select_location').modal('show');
    SelectLocation();
  }

  $(function() {
    StockIn();
    StockOut();

    //CEK BUTTON SAVE CLOSE ATAU SAVE
    var is_close = false;
    $("button[type='submit']").click(function() {
      var _name = $(this).val();
      is_close = (_name == "save") ? false : true;
    });

    // proses save
    $('#ajax-stock-form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: BASE_URL + 'asset/me/sparepart_med/store',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function(response) {
          if (response.queryResult == true) {
            if (!is_close) {
              Swal.fire({
                icon: 'success',
                title: 'Success..',
                text: "Success, data saved successfully"
              }).then(function() {
                $('.samrs-form input, .samrs-form textarea').val('');
                $('.samrs-table1').DataTable().ajax.reload();
              });
            } else {
              Swal.fire({
                icon: 'success',
                title: 'Success..',
                text: "Success, data saved successfully"
              }).then(function() {
                $('.samrs-table1').DataTable().ajax.reload();
                document.location.href = "<?php echo base_url(); ?>asset/me/sparepart_med";
              });

            }
          } else {
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: response.queryMessage,
            });

          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: thrownError,
          });
        }
      });
    });

    $("input[name=propAssetPropstock_qtyCurrent]").change(function() {
      var qty_current = $(this).val();
      $("input[name=propAssetPropstock_qtyCurrent2]").val(qty_current);
      // console.log(qty_current);
    });
    $("input[name=propAssetPropstock_stockName]").change(function() {
      var stock_name2 = $(this).val();
      $("input[name=propAssetPropstock_stockName2]").val(stock_name2);
      // console.log(qty_current);
    });
    $("input[name=propAssetPropstock_qtyMin]").change(function() {
      var qty_min2 = $(this).val();
      $("input[name=propAssetPropstock_qtyMin2]").val(qty_min2);
      // console.log(qty_current);
    });
    //////////////////////////////////////////////////////////
    $('#propAssetPropadmin_priceBuy_stock').keyup(function(event) {
      // skip for arrow keys
      if (event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
          .replace(/\D/g, "")
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      });
    });
    /////////////////////////////////////////////////
    ajaxRoomList();
    onChangeMasterAssetInstrument();
    /////////////////////////////////////////////////
    evtMasterAssetInstrument('init', null);
    evtBrandMasterInstrument('init', null);
    //////////////////////////////////////////////////////
    $(document).on('click', '#select-lokasi', function() {
      var name_room = $(this).data('name_room');
      var name_floor = $(this).data('name_floor');
      var name_building = $(this).data('name_building');
      var id_room = $(this).data('id_room');
      var id_floor = $(this).data('id_floor');
      var id_building = $(this).data('id_building');

      // console.log(name_room, name_floor, name_building, id_room, id_floor, id_building);
      $('input[name=propAssetPropadmin_idBuilding]').val(id_building);
      $('input[name=propAssetPropadmin_idFloor]').val(id_floor);
      $('input[name=propAssetPropadmin_idRoom]').val(id_room);
      $('input[name=propAssetPropadmin_idRoom_stock]').val(id_room);
      $('input[name=propAssetPropstock_idLocation]').val(name_building + " | " + name_floor + " | " + name_room);
      $('input[name=propAssetPropadmin_idRoom_not]').val(name_building + " | " + name_floor + " | " + name_room);
      $('#select_location').modal('hide');
    });

    //////////////////////////////////////////////////////
    $('.selectpicker-not-ajax').selectpicker();
    /////////////////////////////////////////////////////
    evtSelectFileCat('init', null);
    ///////////////////////////////////////////////

    /////////////////////////////////////////////////////////////
    $('form#uploadForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);

      // console.log(formData);
      $.ajax({
        type: "POST",
        url: BASE_URL + 'file/file_upload',
        data: formData,
        success: function(data) {
          // const response = JSON.parse(data)
          // console.log(response.data)

          $('.file_list').DataTable().ajax.reload();
          $('#file_uploadModal').modal('hide');
        },
        error: function(data) {
          console.log(data)
        },
        cache: false,
        contentType: false,
        processData: false
      });

    });
    /////////////////////////////////////////////////////////////////////////
    $('form#brandForm').submit(function(e) {
      e.preventDefault();
      // var brandName = $('input[name=brandName]').val();
      var formDataBrand = new FormData(this);
      $.ajax({
        type: "post",
        url: BASE_URL + "master/master_brand/ajax_add_brand",
        data: formDataBrand,
        dataType: "json",
        success: function(data) {
          // console.log(data);
          if (data == true) {
            Swal.fire({
              icon: 'success',
              title: 'Success...',
              text: 'Data Added Successfully',
            });
            $('#brand_modal').modal('hide');
          }


        },
        error: function(data) {
          console.log(data)
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });
    ////////////////////////////////////////////////////////////////////////////
    $('#ajax_btn_stock_in, #ajax_btn_stock_out').click(function(e) {
      e.preventDefault();
      if (this.id == 'ajax_btn_stock_in') {
        var formDataStock = new FormData(document.getElementById("ajax-stock-form"));
        var id_stock_in = $('input[name=ajax_idasset_stock]').val();

        if (id_stock_in == '') {
          var url_stock_in = BASE_URL + 'stock/add_stock_in_session';
        } else {
          var url_stock_in = BASE_URL + 'stock/add_stock_in_session/' + id_stock_in;
        }

        $.ajax({
          type: "post",
          url: url_stock_in,
          data: formDataStock,
          dataType: "json",
          success: function(data) {
            // console.log(data);
            $('.stockin_list').DataTable().ajax.reload();
            $('input[name=propAssetPropadmin_idRoom_stock]').val("");
            $('input[name=propAssetPropstock_idLocation]').val("");
            $('input[name=propAssetPropstock_qtyCurrent]').val("");
            // $('input[name=propAssetPropstock_qtyMin]').val("");
            $('input[name=propAssetPropstock_stockName]').val("");
            $('#propAssetPropstock_stockDesc').val("");

          },
          error: function(xhr, ajaxOptions, thrownError) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: thrownError,
            });
          },
          cache: false,
          contentType: false,
          processData: false
        });
      } else if (this.id == 'ajax_btn_stock_out') {
        var id_stock_out = $('input[name=ajax_idasset_stock]').val();

        if (id_stock_out == '') {
          var url_stock_out = BASE_URL + 'stock/add_stock_out_session';
        } else {
          var url_stock_out = BASE_URL + 'stock/add_stock_out_session/' + id_stock_out;
        }

        var formDataStockOut = new FormData(document.getElementById("ajax-stock-form"));
        $.ajax({
          type: "post",
          url: url_stock_out,
          data: formDataStockOut,
          dataType: "json",
          success: function(data) {
            // console.log(data);
            $('.stockout_list').DataTable().ajax.reload();
            $('input[name=propAssetPropadmin_idRoom_stock]').val("");
            $('input[name=propAssetPropstock_idLocation]').val("");
            $('input[name=propAssetPropstock_qtyCurrent]').val("");
            // $('input[name=propAssetPropstock_qtyMin]').val("");
            $('input[name=propAssetPropstock_stockName]').val("");
            $('#propAssetPropstock_stockDesc').val("");

          },
          error: function(data) {
            console.log(data)
          },
          cache: false,
          contentType: false,
          processData: false
        });
      }

    });
  });

  function ajaxRoomList() {
    $.ajax({
      type: "post",
      url: BASE_URL + "asset/me/sparepart_med/ajax_room_warehouse",
      // async: false,
      dataType: 'json',
      success: function(data) {
        var html = '';
        var i;
        if (data.length > 0) {
          for (i = 0; i < data.length; i++) {
            html += "<tr>";
            html += '<td>' + '<input type="radio" name="select_lokasi" class="btn btn-xs btn-info" id="select-lokasi" data-name_floor="' + data[i].floorName + '" data-name_building="' + data[i].buildingName + '" data-name_room="' + data[i].roomName + '" data-id_room="' + data[i].idRoom + '" data-id_floor="' + data[i].idFloor + '" data-id_building="' + data[i].idBuilding + '"></input>' + '</td>';
            html += '<td>' + data[i].buildingName + '</td>';
            html += '<td>' + data[i].floorName + '</td>';
            html += '<td>' + data[i].roomName + '</td>';
            html += "</tr>";
          }
          $('.tbody-list').html(html);
        }
      }
    });
  }


  function onChangeMasterAsset() {
    $('.with-ajax-masterAsset').change(function(e) {
      var idAssetMaster = this.value;

      // console.log(idAssetMaster)
      if (idAssetMaster != undefined) {
        $.ajax({
          type: "post",
          url: BASE_URL + "asset/me/sparepart_med/ajax_asset_master_by_id",
          data: {
            idAssetMaster: idAssetMaster
          },
          dataType: "json",
          success: function(res) {
            $('#ajax_assetDesc').val(res.assetMasterName);
            $('#ajax_aliasName').val(res.assetMasterName);
            $('#ajax_aspakCode').val(res.aspakCode);
            $('#ajax_aspakName').val(res.aspakItemName);
            $('#ajax_simakCode').val(res.simakCode);
            $('#ajax_simakName').val(res.simakUraian);
            $('#propAssetPropsimak_simakCode').val(res.propAssetSimakCode);
            $('#propAssetPropadmin_riskLevel').val(res.riskLevel).change();

            // $('#propAssetPropmedeq_calibrationMust').bootstrapSwitch('state', res.calibMust)
            if (res.calibMust == true) {
              $('#propAssetPropmedeq_calibrationMust').prop('checked', true).change();
            } else {
              $('#propAssetPropmedeq_calibrationMust').prop('checked', false).change();
            }
          }
        });
      }

    });
  }

  function onChangeMasterAssetInstrument() {
    $('.with-ajax-instrumentset').change(function(e) {
      var idAssetMasterInstrument = this.value;

      if (idAssetMasterInstrument != undefined) {
        $.ajax({
          type: "post",
          url: BASE_URL + "asset/me/sparepart_med/ajax_asset_master_by_id",
          data: {
            idAssetMaster: idAssetMasterInstrument
          },
          dataType: "json",
          success: function(res) {
            $('#ajax_assetName_instrument').val(res.assetMasterName);
          }
        });
      }

    });
  }

  function calcDepre1() {
    var propAssetProptax_cost = $('#propAssetProptax_cost').val();
    var propAssetProptax_expectedLifeTime = $('#propAssetProptax_expectedLifeTime').val();
    var propAssetProptax_presentDate = $('#propAssetProptax_presentDate').val();
    var propAssetProptax_calcStart = $('#propAssetProptax_calcStart').val();
    var propAssetProptax_residuVal = $('#propAssetProptax_residuVal').val();

    var propAssetProptax_yearlyDep = $('#propAssetProptax_yearlyDep').val();
    var propAssetProptax_accuVal = $('#propAssetProptax_accuVal').val();
    var propAssetProptax_bookVal = $('#propAssetProptax_bookVal').val();

    var values = {
      "expectedLifeTime": String(propAssetProptax_expectedLifeTime),
      "cost": String(propAssetProptax_cost),
      "residuVal": String(propAssetProptax_residuVal),
      "presentDate": propAssetProptax_presentDate,
      "calcStart": propAssetProptax_calcStart
    };

    $.ajax({
      type: 'post',
      url: BASE_URL + 'asset/me/sparepart_med/calc_depre',
      data: values,
      success: function(request) {
        var response = JSON.parse(request)
        console.log(response)

        $('#propAssetProptax_cost').val(convertToRupiah(response.cost));
        $('#propAssetProptax_residuVal').val(convertToRupiah(response.residuVal));
        $('#propAssetProptax_yearlyDep').val(convertToRupiah(response.yearlyDep));
        $('#propAssetProptax_accuVal').val(convertToRupiah(response.accuVal));
        $('#propAssetProptax_bookVal').val(convertToRupiah(response.bookVal));

      }
    });

  }

  function calcDepre2() {
    var propAssetProptaxother_cost = $('#propAssetProptaxother_cost').val();
    var propAssetProptaxother_expectedLifeTime = $('#propAssetProptaxother_expectedLifeTime').val();
    var propAssetProptaxother_presentDate = $('#propAssetProptaxother_presentDate').val();
    var propAssetProptaxother_calcStart = $('#propAssetProptaxother_calcStart').val();
    var propAssetProptaxother_residuVal = $('#propAssetProptaxother_residuVal').val();

    var propAssetProptaxother_yearlyDep = $('#propAssetProptaxother_yearlyDep').val();
    var propAssetProptaxother_accuVal = $('#propAssetProptaxother_accuVal').val();
    var propAssetProptaxother_bookVal = $('#propAssetProptaxother_bookVal').val();

    var values2 = {
      "expectedLifeTime": String(propAssetProptaxother_expectedLifeTime),
      "cost": String(propAssetProptaxother_cost),
      "residuVal": String(propAssetProptaxother_residuVal),
      "presentDate": propAssetProptaxother_presentDate,
      "calcStart": propAssetProptaxother_calcStart
    };

    $.ajax({
      type: 'post',
      url: BASE_URL + 'asset/me/sparepart_med/calc_depre',
      data: values2,
      success: function(request) {
        var response = JSON.parse(request)
        console.log(response)

        // $('#propAssetProptax_cost').val(convertToRupiah(response.cost));

        // $('#propAssetProptaxother_residuVal').text(convertToRupiah(response.residuVal));
        // $('#propAssetProptaxother_yearlyDep').val(response.yearlyDep);
        // $('#propAssetProptaxother_accuVal').text(convertToRupiah(response.accuVal));
        // $('#propAssetProptaxother_bookVal').text(convertToRupiah(response.bookVal));

        $('#propAssetProptaxother_residuVal').val(convertToRupiah(response.residuVal));
        $('#propAssetProptaxother_yearlyDep').val(convertToRupiah(response.yearlyDep));
        $('#propAssetProptaxother_accuVal').val(convertToRupiah(response.accuVal));
        $('#propAssetProptaxother_bookVal').val(convertToRupiah(response.bookVal));

        $("#propAssetProptaxother_cost").on("input", function() {
          // alert($(this).val());
          console.log($(this).val())
        });
        $("#propAssetProptaxother_yearlyDep").on("input", function() {
          // alert($(this).val());
          console.log($(this).val())
        });
        $("#propAssetProptaxother_accuVal").on("input", function() {
          // alert($(this).val());
          console.log($(this).val())
        });
        $("#propAssetProptaxother_bookVal").on("input", function() {
          // alert($(this).val());
          console.log($(this).val())
        });


      }
    });


  }

  function convertToRupiah(angka) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
      if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ',';
    return rupiah.split('', rupiah.length - 1).reverse().join('');
    // return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
  }

  function delete_confirmation_stock_out(e, id_stock_out) {

    var id_stock_out_hapus = $('input[name=ajax_idasset_stock]').val();

    if (id_stock_out_hapus == '') {
      var url_stockout_hapus = BASE_URL + "stock/delete_stock_out_session/" + id_stock_out;
    } else {
      var url_stockout_hapus = BASE_URL + "stock/delete_stock_out_data/" + id_stock_out;
    }

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
          action: function() {
            $.ajax({
              type: 'GET',
              url: url_stockout_hapus,
              dataType: 'json',
              success: function(response) {
                if (response) {
                  $('#ajax_qty_out').val("");
                  $('.stockout_list').DataTable().ajax.reload();
                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: response.message,
                  });
                }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError)
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: thrownError,
                });
              }
            });
          }
        },
        close: function() {}
      }
    });
  }

  function delete_confirmation_stock_in(e, id_stock_in) {
    var id_stock_in_hapus = $('input[name=ajax_idasset_stock]').val();

    if (id_stock_in_hapus == '') {
      var url_stockin_hapus = BASE_URL + "stock/delete_stock_in_session/" + id_stock_in;
    } else {
      var url_stockin_hapus = BASE_URL + "stock/delete_stock_in_data/" + id_stock_in;
    }

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
          action: function() {
            $.ajax({
              type: 'GET',
              url: url_stockin_hapus,
              dataType: 'json',
              success: function(response) {
                if (response) {
                  $('.stockin_list').DataTable().ajax.reload();
                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: response.message,
                  });
                }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError)
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: thrownError,
                });
              }
            });
          }
        },
        close: function() {}
      }
    });
  }

  function delete_confirmation(e, id_file) {

    // if ($('#type_form').val() == 'edit') {
    //   var url = `${base_url}asset_propfiles/asset_propfiles_delete_by_id_file/` + id_file;
    // } else {
    //   var url = `${base_url}file/delete_file_list_session/` + id_file;
    // }
    // Swal.fire({
    //   icon: 'warning',
    //   title: 'Oops...',
    //   text: 'testing',
    // });

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
          action: function() {
            $.ajax({
              type: 'POST',
              url: BASE_URL + "file/delete_file_list_session/" + id_file,
              dataType: 'json',
              success: function(response) {
                if (response) {
                  $('.file_list').DataTable().ajax.reload();
                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: response.message,
                  });
                }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError)
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: thrownError,
                });
              }
            });
          }
        },
        close: function() {}
      }
    });
  }

  function delete_confirmation_instrument(e, idAssetMaster) {

    // if ($('#type_form').val() == 'edit') {
    //   var url = `${base_url}asset_propfiles/asset_propfiles_delete_by_id_file/` + id_file;
    // } else {
    //   var url = `${base_url}file/delete_file_list_session/` + id_file;
    // }
    // Swal.fire({
    //   icon: 'warning',
    //   title: 'Oops...',
    //   text: 'testing',
    // });

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
          action: function() {
            $.ajax({
              type: 'GET',
              url: BASE_URL + "instrument/delete_instrument_list_session/" + idAssetMaster,
              dataType: 'json',
              success: function(response) {
                if (response) {
                  $('.instrument_list').DataTable().ajax.reload();
                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: response.message,
                  });
                }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError)
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: thrownError,
                });
              }
            });
          }
        },
        close: function() {}
      }
    });
  }


  function evtSelectFileCat(evt) {
    var options = {
      ajax: {
        // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
        emptyRequest: true,
        url: BASE_URL + "asset/me/sparepart_med/ajax_file_cat",
        type: 'POST',
        dataType: 'json',
        // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
        // automatically replace it with the value of the search query.
        data: {
          q: '{{{q}}}'
        }
      },
      locale: {
        emptyTitle: 'Tap to search'
      },
      log: 3,
      preprocessData: function(data) {
        var i, l = data.length,
          array = [];

        if (l) {
          for (i = 0; i < l; i++) {
            array.push($.extend(true, data[i], {
              text: data[i].fileCatDesc,
              value: data[i].idFileCat,
              data: {
                subtext: data[i].fileCatName
              }
            }));
          }
        }
        // You must always return a valid array when processing data. The
        // data argument passed is a clone and cannot be modified directly.
        return array;
      }
    };

    if (evt == 'init') {
      $('.selectpicker-filecat').selectpicker().filter('.with-ajax-filecat').ajaxSelectPicker(options);
    } else if (evt == 'render') {
      $('.selectpicker-filecat').selectpicker().filter('.with-ajax-filecat').ajaxSelectPicker('render');
    }
  }

  function evtMasterAssetInstrument(evt) {
    var options = {
      ajax: {
        // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
        emptyRequest: true,
        url: BASE_URL + "asset/me/sparepart_med/ajax_asset_master_instrument",
        type: 'POST',
        dataType: 'json',
        // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
        // automatically replace it with the value of the search query.
        data: {
          q: '{{{q}}}'
        }
      },
      locale: {
        emptyTitle: 'Tap to search'
      },
      log: 3,
      preprocessData: function(data) {
        var i, l = data.length,
          array = [];

        if (l) {
          for (i = 0; i < l; i++) {
            array.push($.extend(true, data[i], {
              text: data[i].assetMasterName,
              value: data[i].idAssetMaster
              // data: {
              //   subtext: data[i].idAssetMaster
              // }
            }));
          }
        }
        // You must always return a valid array when processing data. The
        // data argument passed is a clone and cannot be modified directly.
        return array;
      }
    };

    if (evt == 'init') {
      $('.selectpicker-instrumentset').selectpicker().filter('.with-ajax-instrumentset').ajaxSelectPicker(options);
    } else if (evt == 'render') {
      $('.selectpicker-instrumentset').selectpicker().filter('.with-ajax-instrumentset').ajaxSelectPicker('render');
    }
  }

  function evtBrandMasterInstrument(evt) {
    var options = {
      ajax: {
        // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
        emptyRequest: true,
        url: BASE_URL + "asset/me/sparepart_med/ajax_brand",
        type: 'POST',
        dataType: 'json',
        // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
        // automatically replace it with the value of the search query.
        data: {
          q: '{{{q}}}'
        }
      },
      locale: {
        emptyTitle: 'Tap to search'
      },
      log: 3,
      preprocessData: function(data) {
        var i, l = data.length,
          array = [];

        if (l) {
          for (i = 0; i < l; i++) {
            array.push($.extend(true, data[i], {
              text: data[i].brandName,
              value: data[i].idBrand,
              // data: {
              //     subtext: data[i].idBrand
              // }
            }));
          }
        }
        // You must always return a valid array when processing data. The
        // data argument passed is a clone and cannot be modified directly.
        return array;
      }
    };

    if (evt == 'init') {
      $('.selectpicker-instrumentmerk').selectpicker().filter('.with-ajax-instrumentmerk').ajaxSelectPicker(options);
    } else if (evt == 'render') {
      $('.selectpicker-instrumentmerk').selectpicker().filter('.with-ajax-instrumentmerk').ajaxSelectPicker('render');
    }
  }
</script>