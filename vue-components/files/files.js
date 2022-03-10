let forms = new Vue({
  el: '#app_form',
  components:{
    'form-main':httpVueLoader(BASE_URL + 'vue-components/files/form/form_main.vue?v=1.0'),
    'subform-assets':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_asset.vue?v=1.0'),
    'subform-technician':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_technician.vue?v=1.1'),
    'subform-measuringtools':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_measuringtools.vue?v=1.0'),
    'subform-toolset':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_toolset.vue?v=1.0'),
    'subform-rooms':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_roomconditions.vue?v=1.0'),
    'subform-electrical':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_electricalmeasurements.vue?v=1.0'),
    'subform-qualitative':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_qualitativetask.vue?v=1.0'),
    'subform-quantitative':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_quantitativetask.vue?v=1.0'),
    'subform-material':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_maintenancematerial.vue?v=1.0'),
    'subform-action-record':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_actionrecords.vue?v=1.0'),
    'subform-kpi':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_kpiservicefee.vue?v=1.0'),
    'subform-result':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_maintenanceresult.vue?v=1.0'),
    'subform-signature':httpVueLoader(BASE_URL + 'vue-components/files/form/subform_signature.vue?v=1.0'),
  },
  updated(){
    SwitchInital();
    SwitchToCollapse();
  }
});
