<template>
<div class="p-10">
    <p class="mandatory-info">
        Field marked <span>*</span> is required to fill or mandatory
    </p>
    <div class="col-xl-12">
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">group code <span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input id="formType" name="formType" type="hidden" value="add">
                <input id="idRs" name="idRs" type="hidden">

                <input class="form-control" required id="rsGroupCode" name="rsGroupCode">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">code <span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" id="rsCode" name="rsCode" required type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">name <span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control required" id="rsName" name="rsName" required="" type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">phone</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" id="rsPhone" onkeypress="return hanyaAngka(event)" name="rsPhone" type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">city</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" id="rsCity" name="rsCity" type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">address</label>
            </div>
            <div class="col-xl-8">
                <textarea class="form-control" name="rsAlamat" rows="8" cols="80"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">logo</label>
            </div>
            <div class="col-xl-8">
                <div class="samrs-detail-box mt-10" samrs-border="1px primary">
                    <label class="detail-title">Available Logos</label>
                    <div class="file-img-box">
                        <img with-state="logo-preview" src="" alt="">
                        <div class="float-right">
                            <a href="" class="btn samrs-primary is-outline is-small" name="button" download target="_blank" alt="hospital_logo"><i class="fas fa-download"></i> Download picture</a>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="idFileLogo">
                <div class="custom-file samrs-primary">
                    <input class="custom-file-input" type="file" name="rsLogoFileID">
                    <label class="custom-file-label label-shorts" data-color-type="primary">upload picture</label>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        InputFiles();
    },
};
</script>

<style scoped>
img[with-state*="logo-preview"] {
    width: auto;
    height: 90px;
}
</style>
