<template>
  <section>
    <div class="samrs-flex wrapped is-row in-center">
      <div class="col-lg-2">
        <div class="card dashboard-glance" with-bg="primary">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-chart-line"></i></div>
              <div class="info">
                <span class="number">{{dashboardglance.achievement}}</span><br>
                <span class="title">achievement</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="card dashboard-glance" with-bg="warning">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-clipboard-check"></i></div>
              <div class="info">
                <span class="number" no-percent="true">{{dashboardglance.mtnDoTotalCount}}</span><br>
                <span class="title">total maintenance</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="card dashboard-glance" with-bg="success">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-check"></i></div>
              <div class="info">
                <span class="number" no-percent="true">{{dashboardglance.maintenance}}</span><br>
                <span class="title">maintenanced</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="card dashboard-glance" with-bg="danger">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-times"></i></div>
              <div class="info">
                <span class="number">{{dashboardglance.not_maintenance}}</span><br>
                <span class="title">not maintenanced</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="card dashboard-glance" with-bg="gray">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-question"></i></div>
              <div class="info">
                <span class="number" no-percent="true">{{dashboardglance.mtnDoUnknownCount}}</span><br>
                <span class="title">unknown</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
            <p class="card-title text-capitalize">maintenance by status</p>
          </div>
          <div class="card-body">
            <div id="maintenancennonStatus" data-chart-size="B"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
              <p class="card-title text-capitalize">yearly maintenance</p>
          </div>
          <div class="card-body">
            <div class="charts-wrapper-lg">
                <div id="maintenancenonYearly" data-chart-size="B"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
module.exports = {
  data(){
    return{
      dashboardglance:{}
    }
  },
  mounted(){
    this.$nextTick(function() {
      //maintenance
      axios.get(BASE_URL+'dashboard/non/charts_data/maintenance')
      .then(result =>{
        let selectedYear = this.$parent.chartsYear;
        let resultData  = result.data.maintenance;
        resultData.sort(function(a, b){
              return a.mtnYear - b.mtnYear || a.mtnMonth - b.mtnMonth;
        });
        let filterData = resultData.filter(function(obj) {
          return obj.mtnYear === parseInt(selectedYear);
        });
        if (selectedYear === 'ALL') {
          // by Status
          let results = resultData.reduce(function(a,b) {
            let achievementTotalData = (a.mtnDoGoodCount + b.mtnDoGoodCount) + (a.mtnDoBadCount + b.mtnDoBadCount)
            + (a.mtnDoVeryBadCount + b.mtnDoVeryBadCount) + (a.mtnDoVeryBadCount + b.mtnDoVeryBadCount)
            + (a.mtnDoUnknownCount + b.mtnDoUnknownCount) + (a.mtnDoPendingCount + b.mtnDoPendingCount);
            let achievement = Math.floor((a.mtnDoGoodCount + b.mtnDoGoodCount) * 100 );
            let totalAchievement = parseFloat(achievement).toFixed(2) / achievementTotalData;
            let percentageAchievement = totalAchievement.toFixed(2) + '%';
            return{
              mtnDoGoodCount: a.mtnDoGoodCount + b.mtnDoGoodCount,
              mtnDoBadCount: a.mtnDoBadCount + b.mtnDoBadCount,
              mtnDoVeryBadCount: a.mtnDoVeryBadCount + b.mtnDoVeryBadCount,
              mtnDoPendingCount: a.mtnDoPendingCount + b.mtnDoPendingCount,
              mtnDoUnknownCount: a.mtnDoUnknownCount + b.mtnDoUnknownCount,
              mtnDoTotalCount: a.mtnDoTotalCount + b.mtnDoTotalCount,
              achievement: percentageAchievement,
              maintenance: (a.mtnDoGoodCount + b.mtnDoGoodCount) + (a.mtnDoBadCount + b.mtnDoBadCount) + (a.mtnDoVeryBadCount + b.mtnDoVeryBadCount),
              not_maintenance: (a.mtnDoPendingCount + b.mtnDoPendingCount) + (a.mtnDoUnknownCount + b.mtnDoUnknownCount)
            }
          });
          this.dashboardglance = results;
          let statusTotal = [
            {value:results.mtnDoTotalCount, name:'Total Maintenance'}
          ];
          let statusYear = {name:selectedYear};
          let statusChild = [
            {value:results.mtnDoGoodCount, name:'Good Condition'},
            {value:results.mtnDoPendingCount, name:'Pending'},
            {value:results.mtnDoBadCount, name:'Bad Condition'},
            {value:results.mtnDoVeryBadCount, name:'Very Bad Condition'},
            {value:results.mtnDoUnknownCount, name:'Unknown'}
          ];
          dougnutTypeCharts('Status','maintenancennonStatus', statusYear, statusTotal, statusChild, this.$parent.colorcode.sixColorCondition);
          // By yearly
          let reduceMonth = resultData.reduce(function (r, a) {
              r[a.mtnMonth+'_'+a.mtnYear] = r[a.mtnMonth+'_'+a.mtnYear] || [];
              r[a.mtnMonth+'_'+a.mtnYear].push(a);
              return r;
          }, Object.create(null));
          let resultsMonth = [];
          let sortedMonth = [];
          let monthName = [];
          let plannedData = [];
          let implementedData = [];
          Object.getOwnPropertyNames(reduceMonth).forEach(
              function (val, idx, array) {
                resultsMonth.push(
                  val
                );
                sortedMonth.push(
                  reduceMonth[val]
                );
              }
          );
          for (var i = 0; i < sortedMonth.length; i++) {
            if (sortedMonth[i].length > 1) {
              let planned = sortedMonth[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.mtnMonth] = hash[a.mtnMonth] || r[r.push({ value: 0 }) - 1]).value += a.mtnPlanCount;
                    return r;
                };
              }(Object.create(null)), []);
              let implemented = sortedMonth[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.mtnMonth] = hash[a.mtnMonth] || r[r.push({ value: 0 }) - 1]).value += a.mtnDoTotalCount;
                    return r;
                };
              }(Object.create(null)), []);
              plannedData.push(planned[0]);
              implementedData.push(implemented[0]);
            }else {
              plannedData.push({value:sortedMonth[i][0].mtnPlanCount});
              implementedData.push({value:(sortedMonth[i][0].mtnDoTotalCount)});
            }
          }
          for (var i = 0; i < resultsMonth.length; i++) {
            monthName.push({value:this.$parent.monthIndex(parseInt(resultsMonth[i].split('_')[0]))+'_'+parseInt(resultsMonth[i].split('_')[1])})
          }
          let maintenanceSeriesData = [
            {
              name:'Planned',
              type:'bar',
              smooth:true,
              data:plannedData
            },
            {
              name:'Implementation',
              type:'bar',
              smooth:true,
              data:implementedData
            }
          ];
          barTypeCharts('maintenancenonYearly' ,monthName ,maintenanceSeriesData ,this.$parent.colorcode.twoColorInstallment);
        }else {
          if (filterData.length === 0) {
            console.log("Charts Unavailable");
          }else {
            // by Status
            let results = filterData.reduce(function(hash) {
              return function(r,a) {
                let sum = (hash[a.mtnYear] = hash[a.mtnYear] || r[r.push(
                  {mtnDoGoodCount:0, mtnDoBadCount:0, mtnDoVeryBadCount:0, mtnDoPendingCount:0, mtnDoUnknownCount:0,
                   mtnDoTotalCount: 0, achievement:0 , maintenance:0, not_maintenance:0, mtnYear:0}) - 1]);
                   sum.mtnDoGoodCount += a.mtnDoGoodCount;
                   sum.mtnDoBadCount += a.mtnDoBadCount;
                   sum.mtnDoVeryBadCount += a.mtnDoVeryBadCount;
                   sum.mtnDoPendingCount += a.mtnDoPendingCount;
                   sum.mtnDoUnknownCount += a.mtnDoUnknownCount;
                   sum.mtnDoTotalCount += a.mtnDoTotalCount;
                   let achievement = Math.floor((sum.mtnDoGoodCount)*100);
                   let totalAchievement = parseFloat(achievement).toFixed(2) / (sum.mtnDoGoodCount + sum.mtnDoBadCount +  sum.mtnDoVeryBadCount + sum.mtnDoUnknownCount + sum.mtnDoPendingCount);
                   sum.achievement = (totalAchievement.toFixed(2) === 'NaN') ? 0 + '%' : totalAchievement.toFixed(2) + '%';
                   sum.maintenance = sum.mtnDoGoodCount + sum.mtnDoBadCount + sum.mtnDoVeryBadCount;
                   sum.not_maintenance = sum.mtnDoPendingCount + sum.mtnDoUnknownCount;
                   sum.mtnYear = a.mtnYear;
                   return r;
              }
            }(Object.create(null)), []);
            this.dashboardglance = results[0];
            let statusTotal = [
              {value:results[0].mtnDoTotalCount, name:'Total Maintenance'}
            ];
            let statusYear = {name:results[0].mtnYear};
            let statusChild = [
              {value:results[0].mtnDoGoodCount, name:'Good Condition'},
              {value:results[0].mtnDoPendingCount, name:'Pending'},
              {value:results[0].mtnDoBadCount, name:'Bad Condition'},
              {value:results[0].mtnDoVeryBadCount, name:'Very Bad Condition'},
              {value:results[0].mtnDoUnknownCount, name:'Unknown'}
            ];
            dougnutTypeCharts('Status','maintenancennonStatus', statusYear, statusTotal, statusChild, this.$parent.colorcode.sixColorCondition);
            //By Yearly
            let reduceMonth = filterData.reduce(function (r, a) {
                r[a.mtnMonth] = r[a.mtnMonth] || [];
                r[a.mtnMonth].push(a);
                return r;
            }, Object.create(null));
            let resultsMonth = [];
            let sortedMonth = [];
            let monthName = [];
            let plannedData = [];
            let implementedData = [];
            Object.getOwnPropertyNames(reduceMonth).forEach(
                function (val, idx, array) {
                  resultsMonth.push(
                    parseInt(val)
                  );
                  sortedMonth.push(
                    reduceMonth[val]
                  );
                }
            );
            for (var i = 0; i < sortedMonth.length; i++) {
              if (sortedMonth[i].length > 1) {
                let planned = sortedMonth[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.mtnMonth] = hash[a.mtnMonth] || r[r.push({ value: 0 }) - 1]).value += a.mtnPlanCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let implemented = sortedMonth[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.mtnMonth] = hash[a.mtnMonth] || r[r.push({ value: 0 }) - 1]).value += a.mtnDoTotalCount;
                      return r;
                  };
                }(Object.create(null)), []);
                plannedData.push(planned[0]);
                implementedData.push(implemented[0]);
              }else {
                plannedData.push({value:sortedMonth[i][0].mtnPlanCount});
                implementedData.push({value:(sortedMonth[i][0].mtnDoTotalCount)});
              }
            }
            for (var i = 0; i < resultsMonth.length; i++) {
              monthName.push({value:this.$parent.monthIndex(resultsMonth[i])});
            }
            let maintenanceSeriesData = [
              {
                name:'Planned',
                type:'bar',
                smooth:true,
                data:plannedData
              },
              {
                name:'Implementation',
                type:'bar',
                smooth:true,
                data:implementedData
              }
            ];
            barTypeCharts('maintenancenonYearly' ,monthName ,maintenanceSeriesData ,this.$parent.colorcode.twoColorInstallment);
          }
        }
      });
    });
    function dougnutTypeCharts(seriesName ,elementId ,yearData ,totalData ,childData, colorCode){
      let drawCharts = echarts.init(document.getElementById(elementId));
      option = {
        tooltip:{
          trigger:'item'
        },
        legend:{
          top:'2%',
          left: '0%',
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
    }

    function barTypeCharts(elementId ,horizontalData ,seriesData ,colorCode) {
      let drawCharts = echarts.init(document.getElementById(elementId));
      option = {
        tooltip:{},
        grid: {
          left:0,
          right:10,
          containLabel: true
        },
        legend:{
          show:true
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
    }
  },
  updated(){
    this.$parent.glanceCount();
  }
}
</script>
