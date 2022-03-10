<template>
<div class="p-10">
    <p class="mandatory-info">Field marked <span>*</span> is required to fill or mandatory</p>
    <div class="samrs-detail-box">
        <label class="detail-title">mutation request</label>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">asset code<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <div class="input-group">
                    <input type="hidden" name="idAssetConfirm" id="idAssetConfirm" required>
                    <input class="form-control" name="assetCodeConfirm" type="text" id="assetCodeConfirm" readonly required>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">asset name</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="assetNameConfirm" type="text" id="assetNameConfirm" required readonly>

            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">merk</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="merkConfirm" type="text" id="merkConfirm" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">type</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="tipeConfirm" type="text" id="tipeConfirm" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">serial number</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="serialNumberConfirm" type="text" id="serialNumberConfirm" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">room</label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="srcRoomIDConfirm" id="srcRoomIDConfirm">
                <input class="form-control" name="srcRoomNameConfirm" type="text" id="srcRoomNameConfirm" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">username</label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="formTypeConfirm" value="edit">
                <input name="taskCode" type="hidden" value="MUT" />
                <input id="idProgressConfirm" name="idProgressConfirm" type="hidden" />
                <input id="idRelatedTaskConfirm" name="idRelatedTaskConfirm" type="hidden" />
                <input id="idScheduleConfirm" name="idScheduleConfirm" type="hidden" />
                <input id="idTaskConfirm" name="idTaskConfirm" type="hidden" />
                <input id="taskNameConfirm" name="taskNameConfirm" type="hidden" />
                <input id="taskDescConfirm" name="taskDescConfirm" type="hidden" />
                <input id="idTaskFile1Confirm" name="idTaskFile1Confirm" type="hidden" />
                <input id="idFile1Confirm" name="idFile1Confirm" type="hidden" />
                <input id="fileDesc1Confirm" name="fileDesc1Confirm" type="hidden" />
                <input id="idTaskFile2Confirm" name="idTaskFile2Confirm" type="hidden" />
                <input id="idFile2Confirm" name="idFile2Confirm" type="hidden" />
                <input id="fileDesc2Confirm" name="fileDesc2Confirm" type="hidden" />

                <input type="hidden" name="mutationStatusConfirm" id="mutationStatusConfirm">
                <input class="form-control" name="userNameConfirm" type="text" id="userNameConfirm" readonly required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">Informant<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="idInitByConfirm" id="idInitByConfirm">
                <input class="form-control" name="initByConfirm" type="text" id="initByConfirm" readonly required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">request date<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="scheduleStartConfirm" type="text" id="scheduleStartConfirm" required readonly>

            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">location destination<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="dstRoomIDConfirm" id="dstRoomIDConfirm">
                <input type="text" class="form-control" readonly name="dstRoomNameConfirm" id="dstRoomNameConfirm">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">mutation type<span>*</span></label>
            </div>
            <div class="col-xl-8 d-flex">
                <label class="mr-10 ml-10">
                    <input type="radio" class="mutationType" name="mutationTypeConfirm" id="mutationTypeConfirm1" value="Temporary">Temporary
                </label>
                <label class="mr-10 ml-10">
                    <input type="radio" class="mutationType" name="mutationTypeConfirm" id="mutationTypeConfirm2" value="Permanent">Permanent
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">finish estimation<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="timePendingConfirm" type="date" id="timePendingConfirm">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">description<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <textarea class="form-control" name="mutationDescConfirm" id="mutationDescConfirm" rows="3" required></textarea>
            </div>
        </div>
    </div>
</div>
</template>

<script>
// export default {
// }
</script>
