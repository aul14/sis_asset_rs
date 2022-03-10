<template>
  <div class="navs-content">
    <assets v-if="currentPage === 'dashboard=assets'"></assets>
    <calibration v-else-if="currentPage === 'dashboard=calibration'"></calibration>
    <inspection v-else-if="currentPage === 'dashboard=inspection'"></inspection>
    <maintenance v-else-if="currentPage === 'dashboard=maintenance'"></maintenance>
    <complain-repair v-else-if="currentPage === 'dashboard=complain_repair'"></complain-repair>
    <mutation v-else-if="currentPage === 'dashboard=mutation'"></mutation>
  </div>
</template>

<script>
module.exports={
  data(){
    return{
      colorcode:{
        twoColorInstallment:['#2cabe3','#47d147'],
        twoColorStatus:['#fad43b','#47d147'],
        triColorInformation:['#fad43b','#47d147','#787878'],
        triColorPrice:['#2cabe3','#feba37','#0e0586'],
        triColorPerson:['#2cabe3','#47d147','#0e0586'],
        triColorStatus:['#47d147','#ff3333','#787878'],
        triColorReverse:['#2cabe3','#47d147','#ff3333'],
        fourColorStatus:['#47d147','#fad43b','#ff3333','#787878'],
        fourColorReverse:['#2cabe3','#47d147','#ff3333','#787878'],
        fiveColorStatus:['#2cabe3','#47d147','#fad43b','#ff3333','#787878'],
        sixColorCondition:['#2cabe3','#47d147','#fad43b','#ff3333','#801f1f','#787878'],
        sixColorStatus:['#2cabe3','#fad43b','#47d147','#2c86e3', '#0e0586', '#787878'],
        sixColorInformation:['#2cabe3','#ff3333','#fad43b','#47d147','#1607df','#0e0586'],
        sevenColorStatus:['#2cabe3','#fad43b','#47d147','#2c86e3', '#0e0586', '#5b5a71' , '#787878'],
        eightColorInformation:['#2cabe3','#47d147','#264d26','#fad43b','#dba859','#ff3333','#801f1f','#787878'],
        sixteenColorInformation:['#2cabe3','#248f24','#82ff82','#47d147','#bdffbd', '#8bde8b' , '#bcf9bc','#fad43b','#ffe1b3', '#ff9900', '#f9ca84','#ff3333','#df8686','#90000b','#d1414b','#787878'],
      },
      monthname:[
        'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
      ]
    }
  },
  props:{
    currentPage:{
      type:String
    },
    chartsYear:{
      type:String,
    }
  },
  components:{
    'assets':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/med/assets.vue?v=1.4'),
    'calibration':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/med/calibration.vue?v=1.3'),
    'inspection':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/med/inspection.vue?v=1.3'),
    'maintenance':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/med/maintenance.vue?v=1.3'),
    'complain-repair':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/med/complain_repair.vue?v=1.3'),
    'mutation':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/med/mutation.vue?v=1.3')
  },
  methods:{
    monthIndex(m){
      return this.monthname[m - 1];
    },
    dougnutTypeCharts(seriesName, elementId, totalData, childData, colorCode) {
      let drawCharts = echarts.init(document.getElementById(elementId));
      option = {
        tooltip:{
          trigger:'item'
        },
        legend:{
          show:true,
          top:'2%',
          left: -5,
          orient: 'vertical'
        },
        textStyle : {
          fontSize:10
        },
        color: colorCode,
        series:[
          {
            type:'pie',
            radius: [0, '30%'],
            label: {
                formatter: '{c}',
                fontSize: '12',
                fontWeight: 'bold'
            },
            data: totalData
          },
          {
              name: seriesName,
              type: 'pie',
              radius: ['50%', '70%'],
              labelLine: {
                  length: 3,
              },
              label: {
                  formatter: '{c}',
                  fontSize: '12',
                  fontWeight: 'bold'

              },
              data: childData
          }
        ]
      };
      drawCharts.setOption(option);
      $(window).on('resize', function(){
          location.reload();
          if(drawCharts != null && drawCharts != undefined){
              drawCharts.resize();
          }
      });
    },
    dougnutYearTypeCharts(seriesName ,elementId ,yearData ,totalData ,childData, colorCode){
      let drawCharts = echarts.init(document.getElementById(elementId));
      option = {
        tooltip:{
          trigger:'item'
        },
        legend:{
          show:true,
          top:'2%',
          left: -5,
          orient: 'vertical'
        },
        textStyle : {
          fontSize:10
        },
        color: colorCode,
        series:[
          {
            type:'pie',
            radius: ['20%', '40%'],
            label: {
                formatter: '{c}',
                fontSize: '12',
                fontWeight: 'bold'
            },
            data:totalData
          },
          {
              name: seriesName,
              type: 'pie',
              radius: ['50%', '70%'],
              labelLine: {
                  length: 3,
              },
              markPoint: {
                  tooltip: { show: false },
                  label: {
                    show: true,
                    formatter: '{b}',
                    color: 'black',
                    fontSize: 18,
                  },
                  data: [{
                    name: yearData.name,
                    value: '-',
                    symbol: 'circle',
                    itemStyle: { color: 'transparent' },
                    x: '50%',
                    y: '50%',
                  }],
                },
              label: {
                  formatter: '{c}',
                  fontSize: '12',
                  fontWeight: 'bold'

              },
              data: childData
          }
        ]
      };
      drawCharts.setOption(option);
      $(window).on('resize', function(){
        location.reload();
          if(drawCharts != null && drawCharts != undefined){
              drawCharts.resize();
          }
      });
    },
    barTypeCharts(elementId ,horizontalData ,seriesData ,colorCode) {
      let drawCharts = echarts.init(document.getElementById(elementId));
      option = {
        tooltip:{},
        toolbox:{
          show:true,
          itemSize:10,
          itemGap:5,
          feature:{
            magicType: {
              show:true,
              type: ["line", "bar"]
            },
            restore: {
              show:true,
            }
          },
          emphasis:{
            iconStyle:{
              borderColor:'#2cabe3',
              textAlign:'right'
            }
          },
          top:28,
          right:10
        },
        grid: {
          left:10,
          containLabel: true
        },
        legend:{
          show:true,
          type:'scroll',
          top:10
        },
        color: colorCode,
        xAxis: {
            type: 'category',
            data: horizontalData
        },
        yAxis: {
            type: 'value'
        },
        dataZoom: [
          {
            show: true,
            start: 0,
            end: 100
          },
          {
            type: 'inside',
            start: 94,
          }
        ],
        series:seriesData
      };
      drawCharts.setOption(option);
      $(window).on('resize', function(){
          location.reload();
          if(drawCharts != null && drawCharts != undefined){
              drawCharts.resize();
          }
      });
    },
    lineTypeCharts(elementId ,horizontalData, seriesData, colorCode) {
      let drawCharts = echarts.init(document.getElementById(elementId));
      option = {
        tooltip:{},
        toolbox:{
          show:true,
          itemSize:10,
          itemGap:5,
          feature:{
            magicType: {
              show:true,
              type: ["line", "bar"]
            },
            restore: {
              show:true,
            }
          },
          emphasis:{
            iconStyle:{
              borderColor:'#2cabe3',
              textAlign:'right'
            }
          },
          top:28,
          right:10
        },
        grid: {
          left:10,
          containLabel: true
        },
        legend:{
          show:true
        },
        color: colorCode,
        xAxis: {
            type: 'category',
            boundaryGap: true,
            data: horizontalData
        },
        yAxis: {
            type: 'value'
        },
        series: seriesData
      };
      drawCharts.setOption(option);
      $(window).on('resize', function(){
          location.reload();
          if(drawCharts != null && drawCharts != undefined){
              drawCharts.resize();
          }
      });
    },
    glanceCount(){
      if ($('.number[no-percent="true"], .number').text() == "") {
        $('.number[no-percent="true"], .number').text('0');
      }else {
        $('.number[no-percent="true"]').each(function() {
          $(this).prop('Counter',0).animate({
              Counter: $(this).text()
          }, {
              duration: 2000,
              easing: 'swing',
              step: function (now) {
                  $(this).text(Math.ceil(now));
              }
          });
        });
      }
    }
  },
  updated(){
    this.$nextTick(function() {
      $('div[data-chart-size]').each(function() {
        if ($(this).children().children().length === 0) {
          $(this).append(`<div class="text-center" data-color-type="danger">Charts Unavailable</div>`);
        }
      });
    });
  }
}
</script>
