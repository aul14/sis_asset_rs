<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <single-view-card title="Master Data - Company information" with-search="false">
      <template v-slot:content>
        <div with-state="company-list">

        </div>
      </template>
    </single-view-card>
  </main-app>
</main>
<script>
  function TableData() {
    axios.post(BASE_URL + 'master_data/company_information/data_information')
      .then(result => {
        for (var i = 0; i < [result.data].length; i++) {
          $('div[with-state="company-list"]').append(`
      <div class="card is-rounded hoverable  border-1 border-light mb-10">
        <div class="card-body p-10">
          <div class="hospital-list-box">
            <img class="hospital-logo" src="data:image/png;base64,` + [result.data][i].logo_rs + `" alt="hospital_logo">
            <div class="hospital-list-info">
              <p class="hospital-list-name">` + [result.data][i].rsName + `</p>
              <p class="hospital-list-phone">` + [result.data][i].rsPhone + `</p>
              <p class="hospital-list-location">` + [result.data][i].rsAlamat + ', ' + [result.data][i].rsCity + `</p>
            </div>
            <div class="hospital-list-action">
              <button with-state="modal-btn" modal-target="#companyinfo_form" data-code="` + [result.data][i].idRs + `" class="btn samrs-success" type="button" name="button"><i class="fas fa-edit"></i> Edit</button>
            </div>
          </div>
        </div>
      </div>
    `)
        }
        InputFiles();
        $('img').each(function() {
          $(this).on('error', function() {
            $(this).attr('src', BASE_URL + 'assets/images/action-img/no-image-samrs.png')
            $(this).css({
              'width': 'auto!important',
              'height': '90px!important',
            })
          })
        });
        $('.btn[with-state="modal-btn"]').each(function() {
          $(this).on('click', function() {
            let modalTarget = $(this).attr('modal-target');
            let idCode = $(this).attr('data-code');
            $(modalTarget).modal('show');
            $(modalTarget).find('.samrs-form').append(`
        <div class="loader">
          <div></div>
          <div></div>
        </div>
        `)
            $(modalTarget).on('shown.modal.bs', function() {
              $('input[name="idRs"]').val(idCode);
              let postData = new FormData();
              postData.append('idRs', idCode);
              axios.post(BASE_URL + 'master_data/company_information/check_by_id', postData)
                .then((response) => {
                  for (var i = 0; i < [response.data].length; i++) {
                    $('input[name="rsGroupCode"]').val([response.data][i].rsGroupCode);
                    $('input[name="rsGroupCode"]').prop('readonly', true);
                    $('input[name="rsCode"]').val([response.data][i].rsCode);
                    $('input[name="rsName"]').val([response.data][i].rsName);
                    $('input[name="rsPhone"]').val([response.data][i].rsPhone);
                    $('input[name="rsCity"]').val([response.data][i].rsCity);
                    $('input[name="idFileLogo"]').val([response.data][i].rsLogoFileID);
                    $('textarea[name="rsAlamat"]').val([response.data][i].rsAlamat);
                    $('img[with-state="logo-preview"]').attr('src', 'data:image/png;base64,' + [response.data][i].logo_rs);
                    $('a[download]').attr('href', 'data:image/png;base64,' + [response.data][i].logo_rs);
                    $(modalTarget).find('.loader').remove();
                  }
                })
            })
          })
        });
      })
      .catch(error => {
        console.log(error);
      });
  }
</script>