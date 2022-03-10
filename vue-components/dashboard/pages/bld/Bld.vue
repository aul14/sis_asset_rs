<template>
  <div class="navs-content">
    <assets v-if="currentPage === 'dashboard=assets'"></assets>
  </div>
</template>

<script>
module.exports={
  data(){
    return{
      colorcode:{
        twoColorInstallment:['#2cabe3','#47d147'],
        twoColorStatus:['#fad43b','#47d147'],
        triColorPrice:['#2cabe3','#feba37','#0e0586'],
        triColorStatus:['#47d147','#ff3333','#787878'],
        fourColorStatus:['#47d147','#fad43b','#ff3333','#787878'],
        fiveColorStatus:['#2cabe3','#47d147','#fad43b','#ff3333','#787878'],
        sixColorStatus:['#2cabe3','#fad43b','#47d147','#2c86e3', '#0e0586', '#787878'],
        sixColorInformation:['#2cabe3','#ff3333','#fad43b','#47d147','#1607df','#0e0586'],
        sevenColorStatus:['#2cabe3','#fad43b','#47d147','#2c86e3', '#0e0586', '#5b5a71' , '#787878'],
        eightColorInformation:['#2cabe3','#47d147','#264d26','#fad43b','#dba859','#ff3333','#a64949','#787878'],
        twelveColorInformation:['#2cabe3','#00119c','#3dab6c','#47d147','#264d26','#fad43b','#dba859','#ff3333','#a64949','#90000b','#460005','#787878'],
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
    'assets':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/bld/assets.vue?v=1.4')
  },
  methods:{
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
    }
  },
  updated(){
    this.$nextTick(function() {
      $('div[data-chart-size]').each(function() {
        if ($(this).children().children().length === 0) {
          $(this).append(`<div class="text-center" data-color-type="danger">Charts Unavailable</div>`);
        }
      });
    })
  }
}
</script>
