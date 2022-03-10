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
                    <input type="hidden" name="idAssetApprove" id="idAssetApprove" required>
                    <input class="form-control" name="assetCodeApprove" type="text" id="assetCodeApprove" readonly required>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">asset name</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="assetNameApprove" type="text" id="assetNameApprove" required readonly>

            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">merk</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="merkApprove" type="text" id="merkApprove" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">type</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="tipeApprove" type="text" id="tipeApprove" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">serial number</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="serialNumberApprove" type="text" id="serialNumberApprove" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">room</label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="srcRoomIDApprove" id="srcRoomIDApprove">
                <input class="form-control" name="srcRoomNameApprove" type="text" id="srcRoomNameApprove" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">username</label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="formTypeApprove" value="edit">
                <input name="taskCode" type="hidden" value="MUT" />
                <input id="idProgressApprove" name="idProgressApprove" type="hidden" />
                <input id="idRelatedTaskApprove" name="idRelatedTaskApprove" type="hidden" />
                <input id="idScheduleApprove" name="idScheduleApprove" type="hidden" />
                <input id="idTaskApprove" name="idTaskApprove" type="hidden" />
                <input id="taskNameApprove" name="taskNameApprove" type="hidden" />
                <input id="taskDescApprove" name="taskDescApprove" type="hidden" />
                <input id="idTaskFile1Approve" name="idTaskFile1Approve" type="hidden" />
                <input id="idFile1Approve" name="idFile1Approve" type="hidden" />
                <input id="fileDesc1Approve" name="fileDesc1Approve" type="hidden" />
                <input id="idTaskFile2Approve" name="idTaskFile2Approve" type="hidden" />
                <input id="idFile2Approve" name="idFile2Approve" type="hidden" />
                <input id="fileDesc2Approve" name="fileDesc2Approve" type="hidden" />

                <input type="hidden" name="mutationStatusApprove" id="mutationStatusApprove">
                <input class="form-control" name="userNameApprove" type="text" id="userNameApprove" readonly required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">Informant<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="idInitByApprove" id="idInitByApprove">
                <input class="form-control" name="initByApprove" type="text" id="initByApprove" readonly required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">request date<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="scheduleStartApprove" type="text" id="scheduleStartApprove" required readonly>

            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">location destination<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="dstRoomIDApprove" id="dstRoomIDApprove">
                <input type="text" class="form-control" readonly name="dstRoomNameApprove" id="dstRoomNameApprove">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">mutation type<span>*</span></label>
            </div>
            <div class="col-xl-8 d-flex">
                <label class="mr-10 ml-10">
                    <input type="radio" class="mutationType" name="mutationTypeApprove" id="mutationTypeApprove1" value="Temporary">Temporary
                </label>
                <label class="mr-10 ml-10">
                    <input type="radio" class="mutationType" name="mutationTypeApprove" id="mutationTypeApprove2" value="Permanent">Permanent
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">finish estimation<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="timePendingApprove" type="date" id="timePendingApprove">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">description<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <textarea class="form-control" name="mutationDescApprove" id="mutationDescApprove" rows="3" required></textarea>
            </div>
        </div>
    </div>
</div>
</template>

<script>
// export default {
// }
</script>
