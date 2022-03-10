<main dir="ltr" class="page-wrapper single-card-full" id="App">
  <main-app>
    <user-config-app>
      <template v-slot:form-profile>
        <form id="changeprofile">
          <div class="p-10">
            <div class="fixed-box samrs-form">
              <div class="form-group">
                <label class="form-title">email</label>
                <input class="form-control" type="email" disabled value="<?= $this->session->userdata('email'); ?>">
              </div>
              <div class="form-group">
                <label class="form-title">full name</label>
                <input class="form-control" type="text" name="userFullName" value="<?= $user['userFullName']; ?>">
              </div>
              <div class="form-group">
                <label class="form-title">username</label>
                <input class="form-control" type="text" name="userName" value="<?= $user['userName']; ?>">
              </div>
              <div class="form-group">
                <label class="form-title">phone</label>
                <input type="hidden" name="idFilePict" value="<?= $user['idFilePict']; ?>">
                <input type="hidden" name="idRole" value="<?= $user['idRole']; ?>">
                <input type="hidden" name="idHospital" value="<?= $user['idHospital']; ?>">
                <input class="form-control" type="text" name="userPhone" value="<?= $user['userPhone']; ?>">
              </div>
              <div class="form-group">
                <label class="form-title">picture</label>
                <div class="custom-file">
                  <input class="custom-file-input" type="file" name="userPict" id="userPict">
                  <label class="custom-file-label">Select files</label>
                </div>
              </div>
              <div class="form-group">
                <div class="samrs-detail-box mt-10" data-border="primary">
                  <label class="detail-title">Available picture</label>
                  <div class="col-xl-12 file-img-box">
                    <img src="<?= $picture; ?>" alt="" style="width: 100px;" class="img img-responsive img-thumbnail">
                    <div class="float-right">
                      <a href="<?= base_url(); ?>file/file_download/<?= $user['idFilePict']; ?>" class="btn samrs-primary is-outline is-small" name="button"><i class="fas fa-download"></i> Download picture</a>
                    </div>

                  </div>
                  <!-- <div class="float-left"> -->
                  <!-- </div> -->
                  <!-- <div class="col-xl-6 float-right">
                </div> -->
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn samrs-primary" type="submit" name="button" value="save2">Save</button>
            </div>
          </div>
        </form>
      </template>
      <template v-slot:form-pasword>
        <form action="<?= base_url('settings/change_pwd'); ?>" method="post" id="changepwd">
          <div class="p-10">
            <div class="fixed-box samrs-form">
              <div class="form-group">
                <label class="form-title">your current password</label>
                <input class="form-control" type="password" name="passOld">
              </div>
              <div class="form-group">
                <label class="form-title">your new password</label>
                <input class="form-control" type="password" name="passNew">
              </div>
              <div class="form-group">
                <label class="form-title">repeat password</label>
                <input class="form-control" type="password" name="passNewConfirm">
              </div>
            </div>
            <div class="form-group">
              <button class="btn samrs-primary" type="submit" name="button" value="save">Save</button>
            </div>
          </div>
        </form>
      </template>
    </user-config-app>
  </main-app>
</main>
<div id="add_signature" class="modal samrs-modal slide fade">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <p>Add signature</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body samrs-flex wrapped is-row in-around">
        <div class="flex-box">
          <label>Draw here</label>
          <div class="drawing-box m-none" id="signatureDrawpad">
            <canvas width="300" height="290"></canvas>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" data-action="save-img" type="button" name="button">Save & Exit</button>
          <button class="btn samrs-danger" data-action="clear" type="button" name="button">Clear</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>