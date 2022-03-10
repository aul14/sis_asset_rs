<div id="mutation_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="<?= base_url('task/med/mutation/store'); ?>" id="addform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <p>add new mutation</p>
          <a href="<?= base_url('task/med/mutation'); ?>" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form">
          <input type="hidden" name="sysCatName" value="MED">
          <form-mutation>
            <template v-slot:username-mut>
              <input class="form-control" name="userName" type="text" id="userName" value="<?= $this->session->userdata('username'); ?>" readonly required>
            </template>
            <template v-slot:informant-mut>
              <input type="hidden" name="idInitBy" id="idInitBy" value="<?= $this->session->userdata('id_user'); ?>">
              <input class="form-control" name="initBy" type="text" id="initBy" value="<?= $this->session->userdata('username'); ?>" required>
            </template>
            <template v-slot:request-mut>
              <input class="form-control" name="scheduleStart" type="text" id="scheduleStart" value="<?= date('Y-m-d H:i:s'); ?>" required readonly>
            </template>
          </form-mutation>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('task/med/mutation'); ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="select_assets" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>select assets</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body fixed-height samrs-form">
        <div class="table-responsive">
          <table class="select_assets table samrs-tableview capitalize samrs-table-striped table-hover w-100">
            <thead>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" type="button" data-dismiss="modal" name="button">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
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