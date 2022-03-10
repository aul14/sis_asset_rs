<template>
  <section>
    <div class="samrs-flex wrapped is-row in-center">
      <div class="col-lg-2">
        <div class="card dashboard-glance" with-bg="primary">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-chart-line"></i></div>
              <div class="info">
                <span class="number">{{ dashboardglance.achievement }}</span><br>
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
              <div class="icons"><i class="fas fa-drafting-compass"></i></div>
              <div class="info">
                <span class="number" no-percent="true">{{ dashboardglance.must_calibrated }}</span><br>
                <span class="title">must be calibrated</span>
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
                <span class="number" no-percent="true">{{ dashboardglance.calibPass }}</span><br>
                <span class="title">calibration passed</span>
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
                <span class="number" no-percent="true">{{ dashboardglance.calibFail }}</span><br>
                <span class="title">calibration failure</span>
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
                <span class="number" no-percent="true">{{ dashboardglance.calibUnknown }}</span><br>
                <span class="title small">calibration unknown result</span>
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
              <p class="card-title text-capitalize">calibration by status</p>
          </div>
          <div class="card-body">
            <div id="calibrationmedStatus" data-chart-size="B"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
              <p class="card-title text-capitalize">yearly calibration</p>
          </div>
          <div class="card-body">
            <div class="charts-wrapper">
                <div id="calibrationmedYearly" data-chart-size="B"></div>
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
      //Calibration
      axios.get(BASE_URL+'dashboard/med/charts_data/calibration')
      .then(result => {
        let selectedYear = this.$parent.chartsYear;
        let resultData  = result.data.calibration;
        resultData.sort(function(a, b){
              return a.calibYear - b.calibYear || a.calibMonth - b.calibMonth;
        });
        let filterData = resultData.filter(function(obj) {
          return obj.calibYear === parseInt(selectedYear);
        });
        if (selectedYear === 'ALL') {
          //By Status
          let results = resultData.reduce(function(a,b) {
            let achievementTotalData = a.calibTotal + b.calibTotal;
            let achievement = Math.floor((a.calibPass + b.calibPass) * 100 );
            let totalAchievement = parseFloat(achievement).toFixed(2) / achievementTotalData;
            let percentageAchievement = totalAchievement.toFixed(2) + '%';
            return{
              calibFail : a.calibFail + b.calibFail,
              calibPass : a.calibPass + b.calibPass,
              calibTotal : a.calibTotal + b.calibTotal,
              calibUnknown : a.calibUnknown + b.calibUnknown,
              achievement: percentageAchievement,
              must_calibrated: (a.calibUnknown + b.calibUnknown) + (a.calibFail + b.calibFail),
            }
          });
          this.dashboardglance = results;
          let statusTotal = [
            {value: results.calibTotal, name:'Total Calibration'}
          ];
          let statusYear = {name:selectedYear};
          let statusChild = [
            {value:results.calibPass, name:'Results with passed'},
            {value:results.calibFail, name:'Results with failure'},
            {value:results.calibUnknown, name:'Unknown results'}
          ];
          this.$parent.dougnutYearTypeCharts('Status', 'calibrationmedStatus' ,statusYear, statusTotal, statusChild, this.$parent.colorcode.fourColorReverse);

          let reduceMonth = resultData.reduce(function (r, a) {
              r[a.calibMonth+'_'+a.calibYear] = r[a.calibMonth+'_'+a.calibYear] || [];
              r[a.calibMonth+'_'+a.calibYear].push(a);
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
                    (hash[a.calibMonth] = hash[a.calibMonth] || r[r.push({ value: 0 }) - 1]).value += a.calibTotal;
                    return r;
                };
              }(Object.create(null)), []);
              let implemented = sortedMonth[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.calibMonth] = hash[a.calibMonth] || r[r.push({ value: 0 }) - 1]).value += a.calibPass + a.calibFail;
                    return r;
                };
              }(Object.create(null)), []);
              plannedData.push(planned[0]);
              implementedData.push(implemented[0]);
            }else {
              plannedData.push({value:sortedMonth[i][0].calibTotal});
              implementedData.push({value:(sortedMonth[i][0].calibPass +sortedMonth[i][0].calibFail)});
            }
          }
          for (var i = 0; i < resultsMonth.length; i++) {
            monthName.push({value:this.$parent.monthIndex(parseInt(resultsMonth[i].split('_')[0]))+'_'+parseInt(resultsMonth[i].split('_')[1])})
          }
          let calibrationYearlySeriesData = [
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
          ]
          this.$parent.barTypeCharts('calibrationmedYearly' ,monthName ,calibrationYearlySeriesData ,this.$parent.colorcode.twoColorInstallment);
        }else {
          if (filterData.length === 0) {
            console.log("Charts Unavailable");
          }else {
            //By Status
            let results = filterData.reduce(function(hash) {
              return function (r, a) {
                  let sum = (hash[a.calibYear] = hash[a.calibYear] || r[r.push(
                    {calibFail:0, calibPass:0, calibUnknown:0, calibTotal:0, achievement:0, must_calibrated:0, calibYear:0}) - 1]);
                  sum.calibPass += a.calibPass;
                  sum.calibFail += a.calibFail;
                  sum.calibUnknown += a.calibUnknown;
                  sum.calibTotal += a.calibTotal;
                  sum.calibYear = a.calibYear;
                  sum.must_calibrated = a.calibUnknown + a.calibFail;
                  let achievement = Math.floor((sum.calibPass)*100);
                  let totalAchievement = parseFloat(achievement).toFixed(2) / sum.calibTotal;
                  sum.achievement = totalAchievement.toFixed(2) + '%';
                  return r;
              };
            }(Object.create(null)),[]);
            this.dashboardglance = results[0];
            let statusTotal = [
              {value: results[0].calibTotal, name:'Total Calibration'}
            ];
            let statusYear = {name:results[0].calibYear};
            let statusChild = [
              {value:results[0].calibPass, name:'Results with passed'},
              {value:results[0].calibFail, name:'Results with failure'},
              {value:results[0].calibUnknown, name:'Unknown results'}
            ];
            this.$parent.dougnutYearTypeCharts('Status', 'calibrationmedStatus' ,statusYear, statusTotal, statusChild, this.$parent.colorcode.fourColorReverse);

            //Yearly
            let reduceMonth = filterData.reduce(function (r, a) {
                r[a.calibMonth] = r[a.calibMonth] || [];
                r[a.calibMonth].push(a);
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
                      (hash[a.calibMonth] = hash[a.calibMonth] || r[r.push({ value: 0 }) - 1]).value += a.calibTotal;
                      return r;
                  };
                }(Object.create(null)), []);
                let implemented = sortedMonth[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.calibMonth] = hash[a.calibMonth] || r[r.push({ value: 0 }) - 1]).value += a.calibPass + a.calibFail;
                      return r;
                  };
                }(Object.create(null)), []);
                plannedData.push(planned[0]);
                implementedData.push(implemented[0]);
              }else {
                plannedData.push({value:sortedMonth[i][0].calibTotal});
                implementedData.push({value:(sortedMonth[i][0].calibPass +sortedMonth[i][0].calibFail)});
              }
            }
            for (var i = 0; i < resultsMonth.length; i++) {
              monthName.push({value:this.$parent.monthIndex(resultsMonth[i])});
            }
            let calibrationYearlySeriesData = [
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
            ]
            this.$parent.barTypeCharts('calibrationmedYearly' ,monthName ,calibrationYearlySeriesData ,this.$parent.colorcode.twoColorInstallment);
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
