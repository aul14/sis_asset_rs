<div id="repair_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p>add new inspection</p>
                <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body fixed-height samrs-form" id="app_form">
              <form-main></form-main>
              <subform-institution list-alphabet="A"></subform-institution>
              <subform-measuringtools list-alphabet="B"></subform-measuringtools>
              <subform-toolset list-alphabet="C"></subform-toolset>
              <subform-rooms list-alphabet="D"></subform-rooms>
              <subform-electrical list-alphabet="E"></subform-electrical>
              <subform-qualitative list-alphabet="F"></subform-qualitative>
              <subform-quantitative list-alphabet="G"></subform-quantitative>
              <subform-result></subform-result>
            </div>
            <div class="modal-footer">
                <div class="mr-10 ml-10">
                  <button class="btn samrs-primary" type="button" name="button">Save</button>
                  <button class="btn samrs-success" type="button" name="button">Save & Exit</button>
                </div>
                <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
            </div>
        </div>
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
                <table class="select_assets table samrs-tableview capitalize samrs-table-striped table-hover">
                  <thead>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
                <div class="mr-10 ml-10">
                  <button class="btn samrs-primary" type="button" name="button">Select</button>
                </div>
                <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>
