<template>
  <samrs-overlay overlay-id="advanced_search" title="Advanced Search">
    <template v-slot:overlay-content>
      <advanced-search-box-with-status v-if="withstatus() === 'yes' || withstatus() === 'Yes' || withstatus() === 'YES'"></advanced-search-box-with-status>
      <advanced-search-box v-else-if="withstatus() === 'no' || withstatus() === 'No' || withstatus() === 'NO'"></advanced-search-box>
    </template>
  </samrs-overlay>
</template>

<script>
module.exports= {
  props:{
    withStatus:{
      type:String,
      default:'no'
    },
    haveTaskPeriode:{
      type:String,
      default:'no'
    },
    radioName:{
      type:Array,
      required:false
    },
    radioValue:{
      type:Array,
      required:false
    },
    radioLabel:{
      type:Array,
      required:false
    }
  },
  components: {
    'samrs-overlay':httpVueLoader(BASE_URL+'vue-components/ui-components/main_component/samrs_overlay.vue?v=1.0'),
    'advanced-search-box':httpVueLoader(BASE_URL+'vue-components/ui-components/form_components/advanced_search_form2.vue?v=1.2'),
    'advanced-search-box-with-status':httpVueLoader(BASE_URL+'vue-components/ui-components/form_components/advanced_search_form_status.vue?v=1.2'),
  },
  data(){
    return{
      radio:{
        radioname:this.radioName,
        radiolabel:this.radioLabel,
        radiovalue:this.radioValue
      }
    }
  },
  methods:{
    withstatus(){
      return this.withStatus;
    }
  },
  computed:{
    pairs(){
      return this.radio.radiolabel.map((radiolabels, i) => {
        return {
          radioname:this.radioName.toString(),
          radiolabels:radiolabels,
          radiovalue:this.radioValue[i]
        }
      });
    }
  }
}
</script>
