<template>
<div class="p-10">
    <div class="samrs-detail-box">
        <label class="detail-title">Mutation Return</label>
        <div class="p-10">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">finish date<span>*</span></label>
                </div>
                <div class="col-xl-8">
                  <slot name="finishdate-return-mut"></slot>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">finish by<span>*</span></label>
                </div>
                <div class="col-xl-8">
                     <slot name="finishby-return-mut"></slot>
                </div>
            </div>
        </div>
    </div>
</div>
</template>


