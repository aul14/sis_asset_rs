<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. assets information</label>
    <input type="hidden" name="idAsset">
    <input type="hidden" name="idFpEqdata">
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">assets code</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqCodeFormEqdata" type="text" id="eqCode" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">asset name</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqNameFormEqdata" type="text" id="eqName" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">brands</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqMerkFormEqdata" type="text" id="eqMerk" readonly>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">type</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqTypeFormEqdata" type="text" id="eqType" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">serial number</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqSNFormEqdata" type="text" id="eqSN" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">location room</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqLocationFormEqdata" type="text" id="eqLocation" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
}
</script>
