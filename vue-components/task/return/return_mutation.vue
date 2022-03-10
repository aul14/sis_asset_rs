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
                    <input type="hidden" name="idAssetReturn" id="idAssetReturn" required>
                    <input class="form-control" name="assetCodeReturn" type="text" id="assetCodeReturn" readonly required>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">asset name</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="assetNameReturn" type="text" id="assetNameReturn" required readonly>

            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">merk</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="merkReturn" type="text" id="merkReturn" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">type</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="tipeReturn" type="text" id="tipeReturn" required readonly>
            </div>
        </div>

      
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">serial number</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="serialNumberReturn" type="text" id="serialNumberReturn" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">room</label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="srcRoomIDReturn" id="srcRoomIDReturn">
                <input class="form-control" name="srcRoomNameReturn" type="text" id="srcRoomNameReturn" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">username</label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="formTypeReturn" value="edit">
                <input name="taskCode" type="hidden" value="MUT" />
                <input id="idProgressReturn" name="idProgressReturn" type="hidden" />
                <input id="idRelatedTaskReturn" name="idRelatedTaskReturn" type="hidden" />
                <input id="idScheduleReturn" name="idScheduleReturn" type="hidden" />
                <input id="idTaskReturn" name="idTaskReturn" type="hidden" />
                <input id="taskNameReturn" name="taskNameReturn" type="hidden" />
                <input id="taskDescReturn" name="taskDescReturn" type="hidden" />
                <input id="idTaskFile1Return" name="idTaskFile1Return" type="hidden" />
                <input id="idFile1Return" name="idFile1Return" type="hidden" />
                <input id="fileDesc1Return" name="fileDesc1Return" type="hidden" />
                <input id="idTaskFile2Return" name="idTaskFile2Return" type="hidden" />
                <input id="idFile2Return" name="idFile2Return" type="hidden" />
                <input id="fileDesc2Return" name="fileDesc2Return" type="hidden" />

                <input type="hidden" name="mutationStatusReturn" id="mutationStatusReturn">
                <input class="form-control" name="userNameReturn" type="text" id="userNameReturn" readonly required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">Informant<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="idInitByReturn" id="idInitByReturn">
                <input class="form-control" name="initByReturn" type="text" id="initByReturn" readonly required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">request date<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="scheduleStartReturn" type="text" id="scheduleStartReturn" required readonly>

            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">location destination<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="dstRoomIDReturn" id="dstRoomIDReturn">
                <input type="text" class="form-control" readonly name="dstRoomNameReturn" id="dstRoomNameReturn">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">mutation type<span>*</span></label>
            </div>
            <div class="col-xl-8 d-flex">
                <label class="mr-10 ml-10">
                    <input type="radio" class="mutationType" name="mutationTypeReturn" id="mutationTypeReturn1" value="Temporary">Temporary
                </label>
                <label class="mr-10 ml-10">
                    <input type="radio" class="mutationType" name="mutationTypeReturn" id="mutationTypeReturn2" value="Permanent">Permanent
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">finish estimation<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="timePendingReturn" type="date" id="timePendingReturn">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">description<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <textarea class="form-control" name="mutationDescReturn" id="mutationDescReturn" rows="3" required></textarea>
            </div>
        </div>
    </div>
</div>
</template>

<script>
// export default {
// }
</script>
