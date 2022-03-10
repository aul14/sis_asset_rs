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
              <div class="icons"><i class="fas fa-toolbox"></i></div>
              <div class="info">
                <span class="number" no-percent="true">{{dashboardglance.inspDoTotalCount}}</span><br>
                <span class="title">total inspection</span>
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
                <span class="number" no-percent="true">{{dashboardglance.inspected}}</span><br>
                <span class="title">inspected</span>
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
                <span class="number" no-percent="true">{{dashboardglance.not_inspected}}</span><br>
                <span class="title">not inspected</span>
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
                <span class="number" no-percent="true">{{dashboardglance.inspDoUnknownCount}}</span><br>
                <span class="title">unknown</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
            <p class="card-title text-capitalize">inspection by status</p>
          </div>
          <div class="card-body">
            <div id="inspectionnonStatus" data-chart-size="B"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
              <p class="card-title text-capitalize">yearly inspection</p>
          </div>
          <div class="card-body">
            <div class="charts-wrapper">
              <div id="inspectionnonYearly" data-chart-size="B"></div>
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
      //inspection
      axios.get(BASE_URL+'dashboard/non/charts_data/inspection')
      .then(result =>{
        let selectedYear = this.$parent.chartsYear;
        let resultData  = result.data.inspection;
        resultData.sort(function(a, b){
              return a.inspYear - b.inspYear || a.inspMonth - b.inspMonth;
        });
        let filterData = resultData.filter(function(obj) {
          return obj.inspYear === parseInt(selectedYear);
        });
        if (selectedYear === 'ALL') {
          //by Status
          let results = resultData.reduce(function(a,b) {
            let achievementTotalData = (a.inspDoGoodCount + b.inspDoGoodCount) + (a.inspDoBadCount + b.inspDoBadCount)
            + (a.inspDoVeryBadCount + b.inspDoVeryBadCount) + (a.inspDoUnknownCount + b.inspDoUnknownCount) + (a.inspDoPendingCount + b.inspDoPendingCount);
            let achievement = Math.floor((a.inspDoGoodCount + b.inspDoGoodCount) * 100 );
            let totalAchievement = parseFloat(achievement).toFixed(2) / achievementTotalData;
            let percentageAchievement = totalAchievement.toFixed(2) + '%';
            return{
              inspDoGoodCount: a.inspDoGoodCount + b.inspDoGoodCount,
              inspDoBadCount: a.inspDoBadCount + b.inspDoBadCount,
              inspDoVeryBadCount: a.inspDoVeryBadCount + b.inspDoVeryBadCount,
              inspDoPendingCount: a.inspDoPendingCount + b.inspDoPendingCount,
              inspDoUnknownCount: a.inspDoUnknownCount + b.inspDoUnknownCount,
              inspDoTotalCount: a.inspDoTotalCount + b.inspDoTotalCount,
              achievement: percentageAchievement,
              inspected: (a.inspDoGoodCount + b.inspDoGoodCount) + (a.inspDoBadCount + b.inspDoBadCount) + (a.inspDoVeryBadCount + b.inspDoVeryBadCount),
              not_inspected: (a.inspDoPendingCount + b.inspDoPendingCount) + (a.inspDoUnknownCount + b.inspDoUnknownCount)
            }
          });
          this.dashboardglance = results;
          let statusTotal = [
            {value:results.inspDoTotalCount, name:'Total Inspection'}
          ];
          let statusYear = {name:selectedYear};
          let statusChild = [
            {value:results.inspDoGoodCount, name:'Good Condition'},
            {value:results.inspDoPendingCount, name:'Pending'},
            {value:results.inspDoBadCount, name:'Bad Condition'},
            {value:results.inspDoVeryBadCount, name:'Very Bad Condition'},
            {value:results.inspDoUnknownCount, name:'Unknown'}
          ];
          this.$parent.dougnutYearTypeCharts('Status' ,'inspectionnonStatus' ,statusYear ,statusTotal, statusChild, this.$parent.colorcode.sixColorCondition);
          //By yearly
          let reduceMonth = resultData.reduce(function (r, a) {
              r[a.inspMonth+'_'+a.inspYear] = r[a.inspMonth+'_'+a.inspYear] || [];
              r[a.inspMonth+'_'+a.inspYear].push(a);
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
                    (hash[a.inspMonth] = hash[a.inspMonth] || r[r.push({ value: 0 }) - 1]).value += a.inspPlanCount;
                    return r;
                };
              }(Object.create(null)), []);
              let implemented = sortedMonth[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.inspMonth] = hash[a.inspMonth] || r[r.push({ value: 0 }) - 1]).value += a.inspDoTotalCount;
                    return r;
                };
              }(Object.create(null)), []);
              plannedData.push(planned[0]);
              implementedData.push(implemented[0]);
            }else {
              plannedData.push({value:sortedMonth[i][0].inspPlanCount});
              implementedData.push({value:(sortedMonth[i][0].inspDoTotalCount)});
            }
          }
          for (var i = 0; i < resultsMonth.length; i++) {
            monthName.push({value:this.$parent.monthIndex(parseInt(resultsMonth[i].split('_')[0]))+'_'+parseInt(resultsMonth[i].split('_')[1])})
          }
          let inspectionYearlySeriesData = [
            {
                name: 'Planned',
                type: 'bar',
                smooth: true,
                data:plannedData
            },
            {
                name: 'Implementation',
                type: 'bar',
                smooth: true,
                data:implementedData
            }
          ];
          this.$parent.barTypeCharts('inspectionnonYearly' ,monthName ,inspectionYearlySeriesData ,this.$parent.colorcode.twoColorInstallment);
        }else {
          if (filterData.length === 0) {
            console.log("Charts Unavailable");
          }else {
            //by Status
            let results = filterData.reduce(function(hash) {
              return function(r,a) {
                let sum = (hash[a.inspYear] = hash[a.inspYear] || r[r.push(
                  {inspDoGoodCount:0, inspDoBadCount:0, inspDoVeryBadCount:0, inspDoPendingCount:0, inspDoUnknownCount:0,
                   inspDoTotalCount: 0, achievement:0 , inspected:0, not_inspected:0, inspYear:0}) - 1]);
                   sum.inspDoGoodCount += a.inspDoGoodCount;
                   sum.inspDoBadCount += a.inspDoBadCount;
                   sum.inspDoVeryBadCount += a.inspDoVeryBadCount;
                   sum.inspDoPendingCount += a.inspDoPendingCount;
                   sum.inspDoUnknownCount += a.inspDoUnknownCount;
                   sum.inspDoTotalCount += a.inspDoTotalCount;
                   let achievement = Math.floor((sum.inspDoGoodCount)*100);
                   let totalAchievement = parseFloat(achievement).toFixed(2) / sum.inspDoGoodCount + sum.inspDoBadCount +  sum.inspDoVeryBadCount + sum.inspDoUnknownCount + sum.inspDoPendingCount;
                   sum.achievement = (totalAchievement.toFixed(2) === 'NaN') ? 0 + '%' : totalAchievement.toFixed(2) + '%';
                   sum.inspected = sum.inspDoGoodCount + sum.inspDoBadCount + sum.inspDoVeryBadCount;
                   sum.not_inspected = sum.inspDoPendingCount + sum.inspDoUnknownCount;
                   sum.inspYear = a.inspYear;
                   return r;
              }
            }(Object.create(null)),[]);
            this.dashboardglance = results[0];
            let statusTotal = [
              {value:results[0].inspDoTotalCount, name:'Total Inspection'}
            ];
            let statusYear = {name:results[0].inspYear};
            let statusChild = [
              {value:results[0].inspDoGoodCount, name:'Good Condition'},
              {value:results[0].inspDoPendingCount, name:'Pending'},
              {value:results[0].inspDoBadCount, name:'Bad Condition'},
              {value:results[0].inspDoVeryBadCount, name:'Very Bad Condition'},
              {value:results[0].inspDoUnknownCount, name:'Unknown'}
            ];
            this.$parent.dougnutYearTypeCharts('Status' ,'inspectionnonStatus' ,statusYear ,statusTotal, statusChild, this.$parent.colorcode.sixColorCondition);
            //By Yearly
            let reduceMonth = filterData.reduce(function (r, a) {
                r[a.inspMonth] = r[a.inspMonth] || [];
                r[a.inspMonth].push(a);
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
                      (hash[a.inspMonth] = hash[a.inspMonth] || r[r.push({ value: 0 }) - 1]).value += a.inspPlanCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let implemented = sortedMonth[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.inspMonth] = hash[a.inspMonth] || r[r.push({ value: 0 }) - 1]).value += a.inspDoTotalCount;
                      return r;
                  };
                }(Object.create(null)), []);
                plannedData.push(planned[0]);
                implementedData.push(implemented[0]);
              }else {
                plannedData.push({value:sortedMonth[i][0].inspPlanCount});
                implementedData.push({value:(sortedMonth[i][0].inspDoTotalCount)});
              }
            }
            for (var i = 0; i < resultsMonth.length; i++) {
              monthName.push({value:this.$parent.monthIndex(resultsMonth[i])});
            }
            let inspectionYearlySeriesData = [
              {
                  name: 'Planned',
                  type: 'bar',
                  smooth: true,
                  data:plannedData
              },
              {
                  name: 'Implementation',
                  type: 'bar',
                  smooth: true,
                  data:implementedData
              }
            ];
            this.$parent.barTypeCharts('inspectionnonYearly' ,monthName ,inspectionYearlySeriesData ,this.$parent.colorcode.twoColorInstallment);
          }
        }
      });
    });
  },
  updated(){
    this.$parent.glanceCount();
  }
}
</script>
