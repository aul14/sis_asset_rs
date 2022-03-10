function Tooltip() {
    $('[data-toggle="tooltip"]').tooltip();
}

function SwitchInital() {
    $('.samrs-switch').bootstrapToggle();
}
function InputFiles(){
  $('input.custom-file-input').each(function() {
    $(this).change(function(e) {
      if (e.target.files.length) {
        $(this).next('.custom-file-label').text(e.target.files[0].name);
      }
    });
  });
}
function FloatCard(){
  $('.float-toggle').click(function() {
    let findFloatCard = $(this).parent().find('.float-card.in');
    if (findFloatCard.length === 1) {
      $('.float-card').removeClass('in').addClass('out');
      $(this).find('a i').attr('rotate','hide');
    }else {
      $('.float-card').removeClass('out').addClass('in');
      $(this).find('a i').attr('rotate','active');
    }
  });
}

function DatePicker() {
    $('input[type="date"]').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
}
function SwitchToCollapse() {
  $('.samrs-switch').each(function(){
    var targetCollapse = $(this).attr('collapse-target')
    $(this).change(function(){
      if ($(this).prop('checked') === true) {
        $(targetCollapse).collapse('show');
      }else {
        $(targetCollapse).collapse('hide');
      }
    });
    if ($(this).prop('checked') === true) {
      $(targetCollapse).collapse('show');
    }else {
      $(targetCollapse).collapse('hide');
    }
  });
}

function SignatureDrawing(modalHide) {
    let wrapper = document.getElementById("signatureDrawpad");
    let clearButton = $("[data-action=clear]");
    let saveImages = $("[data-action=save-img]");
    let canvas = wrapper.querySelector("canvas");
    let signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });
    clearButton.on('click', function() {
        signaturePad.clear();
        $('#ImageDrawing').val("");
        $("#drawSignature").attr('src', BASE_URL + "assets/images/white.png");
    });
    saveImages.on('click', function() {
        var img_data = signaturePad.toDataURL();
        var img_val = img_data.substr(5);
        // console.log(signaturePad.toData());
        $('#drawSignature').prop('src', img_data);
        $('#ImageDrawing').val(img_val);
        $('#'+modalHide).modal('hide');
    });
}
function splitMulti(str, tokens){
    var tempChar = tokens[0]; // We can use the first token as a temporary join character
    for(var i = 1; i < tokens.length; i++){
        str = str.split(tokens[i]).join(tempChar);
    }
    str = str.split(tempChar);
    return str;
  }
