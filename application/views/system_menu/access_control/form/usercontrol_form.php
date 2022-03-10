<div id="usercontrol_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="<?= base_url('system_menu/access_control/store'); ?>" method="post" id="addform">
      <div class="modal-content">
        <div class="modal-header">
          <p id="title-roles">add roles</p>
          <a href="<?= base_url('system_menu/access_control'); ?>" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form">
          <input type="hidden" name="taskCode[]" id="taskCode">
          <input type="hidden" name="grpCode" value="<?= $grp_code; ?>">
          <input type="hidden" name="idrs_user" value="<?= $idrs_user; ?>">
          <form-usercontrol>
            <template v-slot:select-tipe>
              <?php if (count($role_group) > 1) : ?>
                <div class="col-xl-4">
                  <label class="form-title">roles group code <span>*</span></label>
                </div>
                <div class="col-xl-8">
                  <select name="roleGroup" required class="form-control selectpicker-rolestype" id="roles-tipe" data-live-search="true">
                    <option value="">Choose Group Code</option>
                    <?php foreach ($role_group as $u) : ?>
                      <option value="<?= $u['rsGroupCode']; ?>" data-group="<?= $u['rsGroupCode'] ?>"><?= $u['rsGroupName']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              <?php endif; ?>
            </template>
          </form-usercontrol>
          <div class="samrs-tab blue">
            <ul class="nav nav-tabs" role="tablist">
              <?php if ($result_role[6]['subMenu1'][2]['subMenu2'][4]['isAllow'] == true) : ?>
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" href="#features" data-toggle="tab" role="tab">features</a>
                </li>
              <?php endif; ?>
              <?php if ($result_role[6]['subMenu1'][2]['subMenu2'][3]['isAllow'] == true) : ?>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" href="#location_preferences" data-toggle="tab" role="tab">hospital preferences</a>
                </li>
              <?php endif; ?>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" role="tabpanel" id="features">
                <subform-feature>

                  <template v-slot:table-appmenu>
                    <fieldset class="field-roles" data-parent="allMenu">
                      <?php foreach ($result_role as $key => $data) : ?>
                        <?php if ($data['isAllow'] == true) : ?>
                          <div class="card" data-parent="<?= $data['menuCode']; ?>">
                            <div class="card-header p-2" data-color-type="primary">
                              <legend class="field-parent-name text-white">
                                <?= $data['menuEnglish']; ?>
                                <div class="legend-btn-group">
                                  <button class="btn samrs-success" type="button">
                                    <label class="form-check">
                                      <input class="form-check-input" type="checkbox" name="idMenu[]" value="<?= $data['idMenu']; ?>" toggle-for="<?= $data['menuCode']; ?>" id="toggle_<?= $data['idMenu']; ?>">
                                      <span>Enable menu</span>
                                    </label>
                                  </button>
                                </div>
                              </legend>
                            </div>
                            <div class="p-2 collapse" tag-name="<?= $data['menuCode']; ?>" data-border="primary">
                              <fieldset data-parent="<?= $data['menuCode']; ?>">
                                <legend>
                                  <div class="legend-btn-group">
                                    <button class="btn samrs-primary is-outline" type="button">
                                      <label class="form-check">
                                        <input class="form-check-input" type="checkbox" with-state="checked-all">
                                        <span>Check All</span>
                                      </label>
                                    </button>
                                    <span class="divider"></span>
                                    <button class="btn samrs-success is-outline" type="button" with-state="toggle-check">
                                      <label>
                                        <i class="fas fa-toggle-off"></i>
                                        <span>Toggle Check</span>
                                      </label>
                                    </button>
                                  </div>
                                </legend>
                                <?php if ($data['subMenu1'][0]['menuType'] == "MENU") : ?>
                                  <?php foreach ($data['subMenu1'] as $data_sub1) : ?>
                                    <?php
                                    $id_code = explode(".", strtolower($data_sub1['menuCode']));
                                    $id_code_im = implode("_", $id_code);
                                    ?>
                                    <?php if ($data_sub1['isAllow'] == true) : ?>
                                      <div class="card" data-parent="<?= $data_sub1['menuCode']; ?>" id="identity_card_<?= $id_code_im; ?>">

                                        <div class="card-header p-2" data-color-type="info">
                                          <legend class="field-child-name text-white">
                                            <?= $data_sub1['menuEnglish']; ?>
                                            <div class="legend-btn-group">
                                              <button class="btn samrs-primary is-outline" type="button">
                                                <label class="form-check">
                                                  <input class="form-check-input check-enable-menu" id="toggle_menu_<?= $data_sub1['idMenu']; ?>" type="checkbox" name="idMenu[]" value="<?= $data_sub1['idMenu']; ?>" data-menucode="<?= $data_sub1['menuCode']; ?>" toggle-for="<?= $data_sub1['menuCode']; ?>">
                                                  <span>Enable menu</span>
                                                </label>
                                              </button>
                                            </div>
                                          </legend>
                                        </div>
                                        <div class="p-2 collapse" tag-name="<?= $data_sub1['menuCode']; ?>" data-border="info">
                                          <legend>
                                            <div class="legend-btn-group">
                                              <button class="btn samrs-primary is-outline" type="button">
                                                <label class="form-check">
                                                  <input class="form-check-input" type="checkbox" with-state="checked-all-child">
                                                  <span>Check All</span>
                                                </label>
                                              </button>
                                              <span class="divider"></span>
                                              <button class="btn samrs-success is-outline" type="button" with-state="toggle-check-child">
                                                <label>
                                                  <i class="fas fa-toggle-off"></i>
                                                  <span>Toggle Check</span>
                                                </label>
                                              </button>
                                            </div>
                                          </legend>
                                          <div class="table-responsive">
                                            <table class="table samrs-tableview" data-color-type="gray">
                                              <tbody>

                                                <?php foreach ($data_sub1['subMenu2'] as $key2 => $data_sub2) :
                                                  $code = explode(".", $data_sub2['menuCode']);
                                                  $cc = current($code)
                                                ?>
                                                  <?php if ($data_sub2['subMenu3'] != []) : ?>
                                                    <?php if ($data_sub2['menuType'] == "MENU" && $data_sub2['subMenu3'][0]['menuType'] != "MENU") : ?>
                                                      <?php if ($data_sub2['isAllow'] == true) : ?>
                                                        <tr>
                                                          <td class="title-on-first"><?= $data_sub2['menuEnglish']; ?></td>
                                                          <td class="item-of-table">
                                                            <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub2['menuCode']; ?>" value="<?= $data_sub2['idMenu']; ?>" id="btn_<?= $data_sub2['idMenu']; ?>">
                                                            <label for="btn_<?= $data_sub2['idMenu']; ?>">Enable Menu</label>
                                                          </td>
                                                          <?php foreach ($data_sub2['subMenu3'] as $data_sub_btn_3) : ?>
                                                            <?php if ($data_sub_btn_3['isAllow'] == true) : ?>
                                                              <td class="item-of-table">
                                                                <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub_btn_3['menuCode']; ?>" value="<?= $data_sub_btn_3['idMenu']; ?>" id="btn_<?= $data_sub_btn_3['idMenu']; ?>">
                                                                <label for="btn_<?= $data_sub_btn_3['idMenu']; ?>"><?= $data_sub_btn_3['menuEnglish']; ?></label>
                                                              </td>
                                                            <?php endif; ?>
                                                          <?php endforeach; ?>
                                                        </tr>
                                                      <?php endif; ?>
                                                    <?php else : ?>
                                                      <?php if ($data_sub2['isAllow'] == true) : ?>
                                                        <tr>
                                                          <td class="title-on-first" rowspan="3"><?= $data_sub2['menuEnglish']; ?></td>
                                                          <td class="item-of-table">
                                                            <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub2['menuCode']; ?>" value="<?= $data_sub2['idMenu']; ?>" id="btn_<?= $data_sub2['idMenu']; ?>">
                                                            <label for="btn_<?= $data_sub2['idMenu']; ?>">Enable Menu</label>
                                                          </td>
                                                        <tr>
                                                          <td class="title-on-first"><?= $data_sub2['subMenu3'][0]['menuEnglish']; ?></td>
                                                          <td class="item-of-table">
                                                            <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub2['subMenu3'][0]['menuCode']; ?>" value="<?= $data_sub2['subMenu3'][0]['idMenu']; ?>" id="btn_<?= $data_sub2['subMenu3'][0]['idMenu']; ?>">
                                                            <label for="btn_<?= $data_sub2['subMenu3'][0]['idMenu']; ?>">Enable Menu</label>
                                                          </td>
                                                          <?php foreach ($data_sub2['subMenu3'][0]['subMenu4'] as $data_sub_btn_4_a) : ?>
                                                            <?php if ($data_sub_btn_4_a['isAllow'] == true) : ?>
                                                              <td class="item-of-table">
                                                                <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub_btn_4_a['menuCode']; ?>" value="<?= $data_sub_btn_4_a['idMenu']; ?>" id="btn_<?= $data_sub_btn_4_a['idMenu']; ?>">
                                                                <label for="btn_<?= $data_sub_btn_4_a['idMenu']; ?>"><?= $data_sub_btn_4_a['menuEnglish']; ?></label>
                                                              </td>
                                                            <?php endif; ?>
                                                          <?php endforeach; ?>
                                                        </tr>
                                                        <tr>
                                                          <td class="title-on-first"><?= $data_sub2['subMenu3'][1]['menuEnglish']; ?></td>
                                                          <td class="item-of-table">
                                                            <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub2['subMenu3'][1]['menuCode']; ?>" value="<?= $data_sub2['subMenu3'][1]['idMenu']; ?>" id="btn_<?= $data_sub2['subMenu3'][1]['idMenu']; ?>">
                                                            <label for="btn_<?= $data_sub2['subMenu3'][1]['idMenu']; ?>">Enable Menu</label>
                                                          </td>
                                                          <?php foreach ($data_sub2['subMenu3'][1]['subMenu4'] as $data_sub_btn_4_b) : ?>
                                                            <?php if ($data_sub_btn_4_b['isAllow'] == true) : ?>
                                                              <td class="item-of-table">
                                                                <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub_btn_4_b['menuCode']; ?>" value="<?= $data_sub_btn_4_b['idMenu']; ?>" id="btn_<?= $data_sub_btn_4_b['idMenu']; ?>">
                                                                <label for="btn_<?= $data_sub_btn_4_b['idMenu']; ?>"><?= $data_sub_btn_4_b['menuEnglish']; ?></label>
                                                              </td>
                                                            <?php endif; ?>
                                                          <?php endforeach; ?>
                                                        </tr>

                                                        </tr>
                                                      <?php endif; ?>
                                                    <?php endif; ?>

                                                  <?php else : ?>
                                                    <?php if ($cc == "D") : ?>
                                                      <?php if ($data_sub2['isAllow'] == true) : ?>
                                                        <tr>
                                                          <td class="title-on-first"><?= $data_sub2['menuEnglish']; ?></td>
                                                          <td class="item-of-table">
                                                            <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub2['menuCode']; ?>" value="<?= $data_sub2['idMenu']; ?>" id="btn_<?= $data_sub2['idMenu']; ?>">
                                                            <label for="btn_<?= $data_sub2['idMenu']; ?>">Enable Menu</label>
                                                          </td>

                                                        </tr>
                                                      <?php endif; ?>
                                                    <?php endif; ?>
                                                  <?php endif; ?>
                                                <?php endforeach; ?>
                                                <tr>

                                                  <?php foreach ($data_sub1['subMenu2'] as $data_sub_btn_opname) : ?>
                                                    <?php if ($data_sub_btn_opname['menuType'] == "BUTTON" || $data_sub_btn_opname['menuType'] == "FUNCTION") : ?>
                                                      <?php if ($data_sub_btn_opname['isAllow'] == true) : ?>
                                                        <td class="item-of-table">
                                                          <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub_btn_opname['menuCode']; ?>" value="<?= $data_sub_btn_opname['idMenu']; ?>" id="btn_<?= $data_sub_btn_opname['idMenu']; ?>">
                                                          <label for="btn_<?= $data_sub_btn_opname['idMenu']; ?>"><?= $data_sub_btn_opname['menuEnglish']; ?></label>
                                                        </td>
                                                      <?php endif; ?>
                                                    <?php endif; ?>
                                                  <?php endforeach; ?>
                                                </tr>

                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    <?php endif; ?>
                                  <?php endforeach; ?>
                                <?php else : ?>
                                  <div class="table-responsive">
                                    <table class="table samrs-tableview group" data-color-type="gray">
                                      <tbody>
                                        <!-- Contact -->
                                        <tr>
                                          <td class="title-on-first"> <?= $data['menuEnglish']; ?></td>
                                          <?php foreach ($data['subMenu1'] as $data_sub_btn1) : ?>
                                            <?php if ($data_sub_btn1['isAllow'] == true) : ?>
                                              <td class="item-of-table">
                                                <input type="checkbox" is-child name="idMenu[]" class="check-fitur" data-code="<?= $data_sub_btn1['menuCode']; ?>" value="<?= $data_sub_btn1['idMenu']; ?>" id="btn_<?= $data_sub_btn1['idMenu']; ?>">
                                                <label for="btn_<?= $data_sub_btn1['idMenu']; ?>"><?= $data_sub_btn1['menuEnglish']; ?></label>
                                              </td>
                                            <?php endif; ?>
                                          <?php endforeach; ?>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>

                                <?php endif; ?>
                              </fieldset>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </fieldset>
                  </template>
                </subform-feature>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="location_preferences">
                <!-- <subform-location>
                <template v-slot:table-detailhospital>

                </template>
              </subform-location> -->
                <div class="col-xl-12">
                  <div class="samrs-detail-box" with-state="location-list">
                    <label class="detail-title">Select Hospital</label>
                    <div class="table-responsive">
                      <table class="location-list table samrs-tableview capitalize">
                        <thead></thead>
                        <tbody>
                          <?php foreach ($hospital as $key_rs => $rs) : ?>

                            <?php if ($grp_code == "") : ?>
                              <tr style="display: none;" class="<?= $rs['rsGroupCode'] ?> hos_group">
                                <td><input type="checkbox" class="checkhos" name="idRs[]" id="cekhos_<?= $rs['idRs']; ?>" data-ptag="hos-<?= $rs['idRs']; ?>" value="<?= $rs['idRs']; ?>"></td>
                                <td><?= $rs['rsName']; ?></td>
                                <td><?= $rs['rsAlamat']; ?></td>
                              </tr>
                            <?php else : ?>
                              <tr>
                                <td><input type="checkbox" class="checkhos" name="idRs[]" id="cekhos_<?= $rs['idRs']; ?>" data-ptag="hos-<?= $rs['idRs']; ?>" value="<?= $rs['idRs']; ?>"></td>
                                <td><?= $rs['rsName']; ?></td>
                                <td><?= $rs['rsAlamat']; ?></td>
                              </tr>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- <div class="form-group ml-10">
                      <button class="btn samrs-primary" type="button" name="button">Add location</button>
                    </div> -->
                  </div>
                  <div with-state="location-select-list">
                    <?php foreach ($hospital as $kunci => $data) : ?>
                      <div class="mt-20 hospital-list p_element" id="hos-<?= $data['idRs']; ?>" style="display: none;">
                        <div class="card samrs-collapse" data-border="primary">
                          <div class="card-header" data-toggle="collapse" data-target="#hospital<?= $data['idRs']; ?>" aria-expanded="false">
                            <?= $data['rsName']; ?><i class="arrows fas fa-chevron-down"></i>
                          </div>
                          <div class="card-body p-10 collapse" id="hospital<?= $data['idRs']; ?>">
                            <div class="samrs-tab blue">
                              <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link active" href="#hospital_tab_<?= $data['idRs']; ?>" data-toggle="tab" role="tab">location preferences</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link" href="#assets_tab_<?= $data['idRs']; ?>" data-toggle="tab" role="tab">Assets categories preferences</a>
                                </li>
                              </ul>

                              <div class="tab-content">
                                <div class="tab-pane fade show active" role="tabpanel" id="hospital_tab_<?= $data['idRs']; ?>">
                                  <?php $data_id = 0; ?>
                                  <div class="hummingbird-treeview">
                                    <?php foreach ($data['buildingList'] as $value) : ?>
                                      <?php if ($value['idAsset'] != 0) : ?>
                                        <ul with-state="location_<?= $kunci + 1 ?>" class="hummingbird-base">
                                          <li data-id="0_loc_<?= $kunci + 1 ?>">
                                            <i class="fa fa-angle-right"></i>
                                            <label>
                                              <input type="checkbox" name="idBuilding[]" id="bld_<?= $value['idAsset'] . "_" . $data['idRs']; ?>" value="<?= $value['idAsset'] . "|" . $data['idRs']; ?>"><?= strtoupper($value['buildingName']); ?>
                                            </label>
                                            <?php if (sizeof($value['propAssetPropbuildingFloor']) > 0) : ?>
                                              <?php foreach ($value['propAssetPropbuildingFloor'] as $value2) : ?>
                                                <ul>
                                                  <li data-id="1_loc_<?= $kunci + 1 ?>">
                                                    <i class="fa fa-angle-right"></i>
                                                    <label>
                                                      <input type="checkbox" name="idFloor[]" id="floor_<?= $value2['idFloor'] . "_" . $value['idAsset'] . "_" . $data['idRs']; ?>" value="<?= $value2['idFloor'] . "|" . $value['idAsset'] . "|" . $data['idRs']; ?>"><?= strtoupper($value2['floorName']); ?>
                                                    </label>
                                                    <?php if (sizeof($value2['propAssetPropbuildingRoom']) > 0) : ?>
                                                      <?php foreach ($value2['propAssetPropbuildingRoom'] as $value3) : ?>
                                                        <ul>
                                                          <li data-id="2_loc_<?= $kunci + 1 ?>">
                                                            <label>
                                                              <input type="checkbox" name="idRoom[]" id="room_<?= $value3['idRoom'] . "_" . $value2['idFloor'] . "_" . $value['idAsset'] . "_" . $data['idRs']; ?>" value="<?= $value3['idRoom'] . "|" . $value2['idFloor'] . "|" . $value['idAsset'] . "|" . $data['idRs']; ?>"><?= strtoupper($value3['roomName']); ?>
                                                            </label>
                                                          </li>
                                                        </ul>
                                                      <?php endforeach; ?>
                                                    <?php endif; ?>
                                                  </li>
                                                </ul>
                                              <?php endforeach; ?>
                                            <?php endif; ?>
                                          </li>
                                        </ul>
                                    <?php
                                      endif;
                                    endforeach; ?>
                                  </div>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="assets_tab_<?= $data['idRs']; ?>">
                                  <div class="hummingbird-treeview">
                                    <ul with-state="asset_cat_<?= $kunci + 1 ?>" class="hummingbird-base">
                                      <?php foreach ($data['assetCatList'] as $val) : ?>
                                        <li data-id="0_assetCat_<?= $kunci + 1 ?>">
                                          <i class="fa fa-angle-right"></i>
                                          <label>
                                            <input type="checkbox" name="catCode[]" id="catcode_<?= $val['catCode'] . "_" . $data['idRs']; ?>" value="<?= $val['catCode'] . "|" . $data['idRs']; ?>"><?= strtoupper($val['assetCatName']); ?>
                                          </label>

                                        </li>
                                      <?php endforeach; ?>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('system_menu/access_control'); ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('.selectpicker-rolestype').selectpicker();

    $(document).on('click', '.checkhos', function() {
      if ($('.checkhos:checked').length == 0) {
        $('.p_element').hide(); //Show all,when nothing is checked
      } else {
        $('.p_element').hide();
        $('.checkhos:checked').each(function() {
          $('#' + $(this).attr('data-ptag')).show();
        });
      }

    });

    $(document).on('change', '#roles-tipe', function() {
      var val_group = $(this).val();

      $('.hos_group').hide();
      // $("#roles-tipe :selected").each(function() {
      //   var data_group = $(this).attr('data-group');
      $('.' + val_group).show();
      // });


    });

    var is_close = false;
    $("button[type='submit']").click(function() {
      var _name = $(this).val();
      is_close = (_name == "save") ? false : true;
    });
    $("#addform").validate({
      ignore: "input[type=hidden]",
      errorClass: "text-danger",
      successClass: "text-success",
      highlight: function(element, errorClass) {
        var elem = $(element);
        if (elem.hasClass('select2-offscreen')) {
          $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass);
          $('#s2id_' + elem.attr('id') + ' ul').addClass('is-invalid');
        } else {
          elem.removeClass(errorClass);
          elem.addClass('is-invalid');
        }

        $(element).removeClass(errorClass)
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass) {
        var elem = $(element);
        if (elem.hasClass('select2-offscreen')) {
          $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass);
          $('#s2id_' + elem.attr('id') + ' ul').removeClass('is-invalid');
        } else {
          elem.removeClass(errorClass);
          elem.removeClass('is-invalid');
        }

        $(element).removeClass(errorClass)
        $(element).removeClass('is-invalid');
      },
      errorPlacement: function(error, element) {
        error.insertAfter(element)
        error.addClass('invalid-feedback');
        element.closest('.col-8').append(error);
      },
      submitHandler: function(form) {
        // console.log(request_method);

        var post_url = $(form).attr("action");
        var request_method = $(form).attr("method");
        $.ajax({
          type: request_method,
          url: post_url,
          data: $(form).serialize(),
          dataType: 'json',
          success: function(response) {
            // console.log(response)
            if (response.queryResult == true) {
              if (!is_close) {
                Swal.fire({
                  icon: 'success',
                  title: 'Success..',
                  text: "Success, data saved successfully"
                }).then(function() {

                  $('.samrs-table1').DataTable().ajax.reload();
                  // window.location.reload();
                });

              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Success..',
                  text: "Success, data saved successfully"
                }).then(function() {
                  $('.samrs-table1').DataTable().ajax.reload();
                  document.location.href = "<?= base_url(); ?>system_menu/access_control";
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
      }
    });

    let chkBoxArray = [];
    $(document).on('click', '.check-fitur', function() {
      let code = $(this).data('code');
      if (code == "CAL" || code == "INP" || code == "MTN" || code == "MUT" || code == "CPL" || code == "RPR" || code == "NCAL" || code == "NINP" || code == "NMTN" || code == "NMUT" || code == "NCPL" || code == "NRPR" || code == "SOM") {
        if ($(this).prop('checked')) {
          chkBoxArray.push(code);
          let uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);
          // console.log(uniqueChkBoxArray);
          $("#taskCode").val(uniqueChkBoxArray);
          // break;
        } else {
          // chkBoxArray.push(code);
          let uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);

          for (let i = 0; i < chkBoxArray.length; i++) {
            if (chkBoxArray[i] == code) {
              var spliced = chkBoxArray.splice(i, 1);

              console.log(spliced);
              break;
            }
          }
        }
      }
    });

    $(document).on('click', '.check-enable-menu', function() {
      let menucode = $(this).data('menucode');
      if (menucode == "SOM") {
        if ($(this).prop('checked')) {
          chkBoxArray.push(menucode);
          let uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);
          // console.log(uniqueChkBoxArray);
          $("#taskCode").val(uniqueChkBoxArray);
          // break;
        } else {
          // chkBoxArray.push(code);
          let uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);

          for (let i = 0; i < chkBoxArray.length; i++) {
            if (chkBoxArray[i] == menucode) {
              var spliced = chkBoxArray.splice(i, 1);

              console.log(spliced);
              break;
            }
          }
        }
      }
    });
    locationList();
    $.fn.hummingbird.defaults.SymbolPrefix = "fa";
    $.fn.hummingbird.defaults.collapsedSymbol = "fa-angle-right";
    $.fn.hummingbird.defaults.expandedSymbol = "fa-angle-down";

    <?php foreach ($hospital as $kunci => $data) : ?>
      $('ul[with-state="location_<?= $kunci + 1; ?>"]').hummingbird();
      $('ul[with-state="asset_cat_<?= $kunci + 1; ?>"]').hummingbird();

      $("#navigation-<?= $kunci + 1 ?>").treeview({
        persist: "location",
        collapsed: true,
        unique: true
      });
      $("#navigation-cat-<?= $kunci + 1 ?>").treeview({
        persist: "location",
        collapsed: true,
        unique: true
      });
    <?php endforeach; ?>
  });

  function locationList() {
    $('.location-list').DataTable({
      columns: [{
          'title': '<input type="checkbox"/>',
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
      pageLength: 50,
      lengthMenu: [50, 100, 150, 200, 500, 1000],
    });
  }
</script>