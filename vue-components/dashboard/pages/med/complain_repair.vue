<template>
  <section>
    <div class="samrs-flex wrapped is-row">
      <div class="col-lg-6">
        <div class="card dashboard-glance" with-bg="success">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-check"></i></div>
              <div class="info">
                <span class="number" no-percent="true">{{ dashboardglance.completed }}</span><br>
                <span class="title">completed response</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card dashboard-glance" with-bg="danger">
          <div class="card-body">
            <div class="glance-box">
              <div class="icons"><i class="fas fa-times"></i></div>
              <div class="info">
                <span class="number" no-percent="true">{{ dashboardglance.rprPendingCount }}</span><br>
                <span class="title">uncompleted response</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card with-shadow is-soft-rounded">
        <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
          <p class="card-title text-capitalize">yearly complain and repair</p>
        </div>
        <div class="card-body">
          <div class="charts-wrapper-lg">
            <div id="complanrepairmedYearly" data-chart-size="B"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="samrs-flex wrapped is-row">
        <div class="col-lg-6 pl-0">
          <div class="card with-shadow is-soft-rounded">
            <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
              <p class="card-title text-capitalize">repair by results</p>
            </div>
            <div class="card-body">
              <div class="charts-wrapper">
                <div id="repairByResults" data-chart-size="B"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 pr-0">
          <div class="card with-shadow is-soft-rounded">
            <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
              <p class="card-title text-capitalize">repair by person in charges</p>
            </div>
            <div class="card-body">
              <div class="charts-wrapper">
                <div id="repairByPIC" data-chart-size="B"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 pl-0 pr-0">
          <div class="card with-shadow is-soft-rounded">
            <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
              <p class="card-title text-capitalize">summary data for results and person in charges</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table samrs-tableview capitalize">
                  <thead>
                    <tr>
                      <th rowspan="2">no</th>
                      <th rowspan="2">years</th>
                      <th colspan="4" class="text-center">results</th>
                      <th colspan="3" class="text-center">PIC</th>
                    </tr>
                    <tr>
                      <th>good</th>
                      <th>bad</th>
                      <th>pending</th>
                      <th>total result</th>
                      <th>in house</th>
                      <th>by vendor</th>
                      <th>total PIC</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in summaryResultPIC">
                      <td>{{ index+1 }}</td>
                      <td>{{ item.years }}</td>
                      <td>{{ item.goodResult }}</td>
                      <td>{{ item.badResult }}</td>
                      <td>{{ item.pendingResult }}</td>
                      <td>{{ item.totalResults }}</td>
                      <td>{{ item.InHouse }}</td>
                      <td>{{ item.byVendor }}</td>
                      <td>{{ item.totalPIC }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card with-shadow is-soft-rounded">
        <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
          <p class="card-title text-capitalize">quality objective for handling response</p>
        </div>
        <div class="card-body">
            <div class="charts-wrapper-lg">
              <div id="complainrepairmedrepairResponseTime" data-chart-size="B"></div>
            </div>
            <p class="text-capitalize text-center mb-10 mt-10">summary data for handling response</p>
            <div class="table-responsive">
              <table class="table samrs-tableview capitalize">
                <thead>
                  <tr>
                    <th rowspan="2">no</th>
                    <th rowspan="2">year</th>
                    <th colspan="15" class="text-center">completed time</th>
                    <th rowspan="2">uncompleted</th>
                    <th rowspan="2">total</th>
                  </tr>
                  <tr>
                    <th>15 minutes</th>
                    <th>very fast (%)</th>
                    <th>15 minutes - 1 hour</th>
                    <th>medium fast (%)</th>
                    <th>1 - 3 hour</th>
                    <th>fast (%)</th>
                    <th>3 - 12 hour</th>
                    <th>normal (%)</th>
                    <th>12 - 24 hour</th>
                    <th>slow (%)</th>
                    <th>1 - 3 day</th>
                    <th>medium slow (%)</th>
                    <th>> 3 day</th>
                    <th>very slow (%)</th>
                    <th>total completed</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in summaryResponseTime">
                    <td>{{ index+1 }}</td>
                    <td>{{item.years}}</td>
                    <td>{{item.t15m }}</td>
                    <td>{{item.percentageFast}}</td>
                    <td>{{item.t1H}}</td>
                    <td>{{item.percentageMediumFast}}</td>
                    <td>{{item.t3H}}</td>
                    <td>{{item.percentageFast}}</td>
                    <td>{{item.t12H}}</td>
                    <td>{{item.percentageNormal}}</td>
                    <td>{{item.t24H}}</td>
                    <td>{{item.percentageSlow}}</td>
                    <td>{{item.t3D}}</td>
                    <td>{{item.percentageMediumSlow}}</td>
                    <td>{{item.More3}}</td>
                    <td>{{item.percentageVerySlow}}</td>
                    <td>{{item.totalComplete}}</td>
                    <td>{{item.totalUncompleted}}</td>
                    <td>{{item.totalResults}}</td>
                  </tr>
                </tbody>
              </table>
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
      dashboardglance:{
        'completed':0,
        'uncompleted':0
      },
      summaryResultPIC:[],
      summaryResponseTime:[]
    }
  },
  mounted(){
    this.$nextTick(function() {
      axios.get(BASE_URL+'dashboard/med/charts_data/complain_repair')
      .then(result=>{
        let selectedYear = this.$parent.chartsYear;
        let resultData  = result.data.complain_repair;
        resultData.sort(function(a, b){
              return a.cplYear - b.cplYear || a.cplMonth - b.cplMonth;
        });
        let filterData = resultData.filter(function(obj) {
          return obj.cplYear === parseInt(selectedYear);
        });
        if (selectedYear === 'ALL') {
          let complainData = {
            'monthlyTotalComplain':[]
          };
          let repairData = {
            'yearData':[],
            'monthlyTotalRepair':[],
            'yearlyTotalRepair':[],
            'yearlyTotalResponse':[],
            'yearlyCompleted':[],
            'yearlyUncompleted':[],
            'response15m':[],
            'percentageVeryFast':[],
            'response1H':[],
            'percentageMediumFast':[],
            'response3H':[],
            'percentageFast':[],
            'response12H':[],
            'percentageNormal':[],
            'response24H':[],
            'percentageSlow':[],
            'response3D':[],
            'percentageMediumSlow':[],
            'responseMore':[],
            'percentageVerySlow':[],
            'summaryResultPIC':[],
            'summaryResponseTime':[]
          };
          let reduceYear = resultData.reduce(function(r,a) {
            r[a.cplYear] = r[a.cplYear] || [];
            r[a.cplYear].push(a);
            return r;
          }, Object.create(null));
          //by Yearly
          let reduceMonth = resultData.reduce(function (r, a) {
              r[a.cplMonth+'_'+a.cplYear] = r[a.cplMonth+'_'+a.cplYear] || [];
              r[a.cplMonth+'_'+a.cplYear].push(a);
              return r;
          }, Object.create(null));
          let resultsMonth = [];
          let sortedMonth = [];
          let monthName = [];
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
              let complain = sortedMonth[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplMonth] = hash[a.cplMonth] || r[r.push({ value: 0 }) - 1]).value += a.cplTotalCount;
                    return r;
                };
              }(Object.create(null)), []);
              let repair = sortedMonth[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplMonth] = hash[a.cplMonth] || r[r.push({ value: 0 }) - 1]).value += a.rprTotalCount;
                    return r;
                };
              }(Object.create(null)), []);
              complainData.monthlyTotalComplain.push(complain[0]);
              repairData.monthlyTotalRepair.push(repair[0]);
            }else {
              complainData.monthlyTotalComplain.push({value:sortedMonth[i][0].cplTotalCount});
              repairData.monthlyTotalRepair.push({value:sortedMonth[i][0].rprTotalCount});
            }
          }
          for (var i = 0; i < resultsMonth.length; i++) {
            monthName.push({value:this.$parent.monthIndex(parseInt(resultsMonth[i].split('_')[0]))+'_'+parseInt(resultsMonth[i].split('_')[1])})
          }
          let complainYearlySeriesData= [
            {
                name: 'Complain',
                type: 'line',
                smooth: true,
                data: complainData.monthlyTotalComplain
            },
            {
                name: 'Repair',
                type: 'line',
                smooth: true,
                data:repairData.monthlyTotalRepair
            }
          ];
          this.$parent.lineTypeCharts('complanrepairmedYearly',monthName ,complainYearlySeriesData , this.$parent.colorcode.twoColorStatus);

          let allResult = resultData.reduce(function(a,b) {
            return {
              rprFinishBadCount : a.rprFinishBadCount + b.rprFinishBadCount,
              rprFinishGoodCount : a.rprFinishGoodCount + b.rprFinishGoodCount,
              rprPendingCount : a.rprPendingCount + b.rprPendingCount,
              rprInhouseCount : a.rprInhouseCount + b.rprInhouseCount,
              rprVendorCount: a.rprVendorCount + b.rprVendorCount,
              completed : (a.rprFinishGoodCount + b.rprFinishGoodCount) + (a.rprFinishBadCount + b.rprFinishBadCount)
            };
          });
          this.dashboardglance = allResult;
          let yearsName ={name:selectedYear}
          let resultTotal = [
            {value:allResult.rprFinishBadCount + allResult.rprFinishGoodCount + allResult.rprPendingCount, name:'Total result'}
          ];
          let resultChild = [
            {value:allResult.rprFinishGoodCount, name:'Good'},
            {value:allResult.rprFinishBadCount, name:'Bad'},
            {value:allResult.rprFinishBadCount, name:'Pending'}
          ];
          this.$parent.dougnutYearTypeCharts('Status' ,'repairByResults' ,yearsName.name ,resultTotal, resultChild, this.$parent.colorcode.fourColorReverse);

          let personTotal = [{value:allResult.rprInhouseCount + allResult.rprVendorCount, name:'Total result'}];
          let personChild = [
            {value:allResult.rprInhouseCount, name:'InHouse'},
            {value:allResult.rprVendorCount, name:'Vendor'}
          ];
          this.$parent.dougnutYearTypeCharts('Status','repairByPIC' ,yearsName.name, personTotal, personChild, this.$parent.colorcode.triColorPerson);

          let sortedYear = [];
          Object.getOwnPropertyNames(reduceYear).forEach(
              function (val, idx, array) {
                repairData.yearData.push(
                  {value:parseInt(val)}
                );
                sortedYear.push(
                  reduceYear[val]
                )
              }
          );
          for (var i = 0; i < sortedYear.length; i++) {
            if (sortedYear[i].length > 1) {
              let timeYear =  sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value = a.cplYear;
                    return r;
                };
              }(Object.create(null)), []);

              let responseTimeInTotal = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr15MinCount + a.rpr1HCount + a.rpr3HCount + a.rpr12HCount + a.rpr24HCount + a.rpr3DCount + a.rprMoreCount;
                    return r;
                };
              }(Object.create(null)), []);

              //15m
              let time_15m = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr15MinCount;
                    return r;
                };
              }(Object.create(null)), []);
              let veryFast15 = Math.floor(time_15m[0].value * 100);
              let totalveryFast15 = parseFloat(veryFast15).toFixed(2) / responseTimeInTotal[0].value;
              let percentageveryFast15 = totalveryFast15.toFixed(2);

              //1H
              let time_1H = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr1HCount;
                    return r;
                };
              }(Object.create(null)), []);
              let mediumFast1 = Math.floor(time_1H[0].value * 100);
              let totalmediumFast1= parseFloat(mediumFast1).toFixed(2) / responseTimeInTotal[0].value;
              let percentagemediumFast1 = totalmediumFast1.toFixed(2);

              //3H
              let time_3H = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr3HCount;
                    return r;
                };
              }(Object.create(null)), []);
              let fast3 = Math.floor(time_3H[0].value * 100);
              let totalFast3= parseFloat(fast3).toFixed(2) / responseTimeInTotal[0].value;
              let percentageFast3= totalFast3.toFixed(2);

              //12H
              let time_12H = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr12HCount;
                    return r;
                };
              }(Object.create(null)), []);
              let normal12 = Math.floor(time_12H[0].value * 100);
              let totalNormal12 = parseFloat(normal12).toFixed(2) / responseTimeInTotal[0].value;
              let percentageNormal12 = totalNormal12.toFixed(2);

              //24H
              let time_24H = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr24HCount;
                    return r;
                };
              }(Object.create(null)), []);
              let slow24 = Math.floor(time_24H[0].value * 100);
              let totalSlow24 = parseFloat(slow24).toFixed(2) / responseTimeInTotal[0].value;
              let percentageSlow24 = totalSlow24.toFixed(2);

              //3D
              let time_3D = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr3DCount;
                    return r;
                };
              }(Object.create(null)), []);
              let mediumSlow3 = Math.floor(time_3D[0].value * 100);
              let totalmediumSlow3 = parseFloat(mediumSlow3).toFixed(2) / responseTimeInTotal[0].value;
              let percentagemediumSlow3 = totalmediumSlow3.toFixed(2);

              //More
              let time_More = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprMoreCount;
                    return r;
                };
              }(Object.create(null)), []);
              let verySlowMore = Math.floor(time_More[0].value * 100);
              let totalverySlowMore = parseFloat(verySlowMore).toFixed(2) / responseTimeInTotal[0].value;
              let percentageverySlowMore = totalverySlowMore.toFixed(2);

              let totalInHouse = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprInhouseCount;
                    return r;
                };
              }(Object.create(null)), []);

              let totalVendor = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprInhouseCount;
                    return r;
                };
              }(Object.create(null)), []);

              let totalPIC = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprInhouseCount + a.rprVendorCount;
                    return r;
                };
              }(Object.create(null)), []);

              let totalYearly = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprTotalCount;
                    return r;
                };
              }(Object.create(null)), []);

              let goodResult = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishGoodCount;
                    return r;
                };
              }(Object.create(null)), []);

              let badResult = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishBadCount;
                    return r;
                };
              }(Object.create(null)), []);

              let pendingResult = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprPendingCount;
                    return r;
                };
              }(Object.create(null)), []);

              let totalResults = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishBadCount + a.rprFinishGoodCount + a.rprPendingCount;
                    return r;
                };
              }(Object.create(null)), []);

              let totalComplete = sortedYear[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishBadCount + a.rprFinishGoodCount;
                    return r;
                };
              }(Object.create(null)), []);

              repairData.summaryResultPIC.push({
                'years': timeYear[0].value,
                'goodResult':goodResult[0].value,
                'badResult':badResult[0].value,
                'pendingResult':pendingResult[0].value,
                'totalResults':totalResults[0].value,
                'InHouse':totalInHouse[0].value,
                'byVendor':totalVendor[0].value,
                'totalPIC':totalPIC[0].value
              });
              repairData.summaryResponseTime.push({
                'years': timeYear[0].value,
                't15m':time_15m[0].value,
                'percentageFast':percentageveryFast15,
                't1H':time_1H[0].value,
                'percentageMediumFast':percentagemediumFast1,
                't3H':time_3H[0].value,
                'percentageFast':percentageFast3,
                't12H':time_12H[0].value,
                'percentageNormal':percentageNormal12,
                't24H':time_24H[0].value,
                'percentageSlow':percentageSlow24,
                't3D':time_3D[0].value,
                'percentageMediumSlow':percentagemediumSlow3,
                'More3':time_More[0].value,
                'percentageVerySlow':percentageverySlowMore,
                'totalComplete': totalComplete[0].value,
                'totalUncompleted':pendingResult[0].value,
                'totalResults':totalResults[0].value
              });

              repairData.response15m.push(time_15m[0]);
              repairData.percentageVeryFast.push({value:percentageveryFast15});
              repairData.response1H.push(time_1H[0]);
              repairData.percentageMediumFast.push({value:percentagemediumFast1});
              repairData.response3H.push(time_3H[0]);
              repairData.percentageFast.push({value:percentageFast3});
              repairData.response12H.push(time_12H[0]);
              repairData.percentageNormal.push({value:percentageNormal12});
              repairData.response24H.push(time_24H[0]);
              repairData.percentageSlow.push({value:percentageSlow24});
              repairData.response3D.push(time_3D[0]);
              repairData.percentageMediumSlow.push({value:percentagemediumSlow3});
              repairData.responseMore.push(time_More[0]);
              repairData.percentageVerySlow.push({value:percentageverySlowMore});
              repairData.yearlyTotalResponse.push(responseTimeInTotal[0]);
              repairData.yearlyTotalRepair.push(totalYearly[0]);
              repairData.yearlyCompleted.push(totalComplete[0]);
              repairData.yearlyUncompleted.push(pendingResult[0]);
            }else {
              let responseTimeInTotal = sortedMonth[i][0].rpr15MinCount + sortedMonth[i][0].rpr1HCount + sortedMonth[i][0].rpr3HCount + sortedMonth[i][0].rpr12HCount + sortedMonth[i][0].rpr24HCount + sortedMonth[i][0].rpr3DCount + sortedMonth[i][0].rprMoreCount;
              //15m
              repairData.response15m.push({value:sortedMonth[i][0].rpr15MinCount});
              let veryFast15 = Math.floor(sortedMonth[i][0].rpr15MinCount * 100);
              let totalveryFast15 = parseFloat(veryFast15).toFixed(2) / responseTimeInTotal;
              let percentageveryFast15 = totalveryFast15.toFixed(2);
              repairData.percentageVeryFast.push({value:percentageveryFast15});

              //1h
              repairData.response1H.push({value:sortedMonth[i][0].rpr1HCount});
              let mediumFast1 = Math.floor(sortedMonth[i][0].rpr1HCount * 100);
              let totalmediumFast1= parseFloat(mediumFast1).toFixed(2) / responseTimeInTotal;
              let percentagemediumFast1 = totalmediumFast1.toFixed(2);
              repairData.percentageMediumFast.push({value:percentagemediumFast1});

              //3H
              repairData.response3H.push({value:sortedMonth[i][0].rpr3HCount});
              let fast3 = Math.floor(sortedMonth[i][0].rpr3HCount * 100);
              let totalFast3= parseFloat(fast3).toFixed(2) / responseTimeInTotal;
              let percentageFast3= totalFast3.toFixed(2);
              repairData.percentageFast.push({value:percentageFast3});

              //12H
              repairData.response12H.push({value:sortedMonth[i][0].rpr12HCount});
              let normal12 = Math.floor(sortedMonth[i][0].rpr12HCount * 100);
              let totalNormal12 = parseFloat(normal12).toFixed(2) / responseTimeInTotal;
              let percentageNormal12 = totalNormal12.toFixed(2);
              repairData.percentageNormal.push({value:percentageNormal12});

              //24H
              repairData.response24H.push({value:sortedMonth[i][0].rpr24HCount});
              let slow24 = Math.floor(sortedMonth[i][0].rpr24HCount * 100);
              let totalSlow24 = parseFloat(slow24).toFixed(2) / responseTimeInTotal;
              let percentageSlow24 = totalSlow24.toFixed(2);
              repairData.percentageSlow.push({value:percentageSlow24});

              //3D
              repairData.response3D.push({value:sortedMonth[i][0].rpr3DCount});
              let mediumSlow3 = Math.floor(sortedMonth[i][0].rpr3DCount * 100);
              let totalmediumSlow3 = parseFloat(mediumSlow3).toFixed(2) / responseTimeInTotal;
              let percentagemediumSlow3 = totalmediumSlow3.toFixed(2);
              repairData.percentageMediumSlow.push({value:percentagemediumSlow3});

              //More
              repairData.responseMore.push({value:sortedMonth[i][0].rprMoreCount});
              let verySlowMore = Math.floor(sortedMonth[i][0].rprMoreCount * 100);
              let totalverySlowMore = parseFloat(verySlowMore).toFixed(2) / responseTimeInTotal;
              let percentageverySlowMore = totalverySlowMore.toFixed(2);
              repairData.percentageVerySlow.push({value:percentageverySlowMore});

              repairData.yearlyTotalResponse.push({value:responseTimeInTotal});
              repairData.yearlyTotalRepair.push({value:sortedMonth[i][0].rprTotalCount});
              repairData.yearlyCompleted.push({value:sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount});
              repairData.yearlyUncompleted.push({value:sortedMonth[i][0].rprPendingCount});


              repairData.summaryResultPIC.push({
                'years': sortedMonth[i][0].cplYear,
                'goodResult':sortedMonth[i][0].rprFinishGoodCount,
                'badResult':sortedMonth[i][0].rprFinishBadCount,
                'pendingResult':sortedMonth[i][0].rprPendingCount,
                'totalResults':sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount + sortedMonth[i][0].rprPendingCount,
                'InHouse':sortedMonth[i][0].rprInhouseCount,
                'byVendor':sortedMonth[i][0].rprVendorCount,
                'totalPIC':sortedMonth[i][0].rprInhouseCount + sortedMonth[i][0].rprVendorCount
              });
              repairData.summaryResponseTime.push({
                'years': sortedMonth[i][0].cplYear,
                't15m':sortedMonth[i][0].rpr15MinCount,
                'percentageFast':percentageveryFast15,
                't1H':sortedMonth[i][0].rpr1HCount,
                'percentageMediumFast':percentagemediumFast1,
                't3H':sortedMonth[i][0].rpr3HCount,
                'percentageFast':percentageFast3,
                't12H':sortedMonth[i][0].rpr12HCount,
                'percentageNormal':percentageNormal12,
                't24H':sortedMonth[i][0].rpr24HCount,
                'percentageSlow':percentageSlow24,
                't3D':sortedMonth[i][0].rpr3DCount,
                'percentageMediumSlow':percentagemediumSlow3,
                'More3':sortedMonth[i][0].rprMoreCount,
                'percentageVerySlow':percentageverySlowMore,
                'totalComplete': sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount,
                'totalUncompleted':sortedMonth[i][0].rprPendingCount,
                'totalResults':sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount + sortedMonth[i][0].rprPendingCount
              });
            }
          }
          this.summaryResultPIC = repairData.summaryResultPIC;
          this.summaryResponseTime = repairData.summaryResponseTime;
          let repairResponseSeriesData = [
            {
                name: 'Total',
                type: 'bar',
                smooth: true,
                data:repairData.yearlyTotalResponse
            },
            {
                name: '15 Minutes',
                type: 'bar',
                smooth: true,
                data:repairData.response15m
            },
            {
                name: 'Very fast percentage',
                type: 'bar',
                smooth: true,
                data:repairData.percentageVeryFast
            },
            {
                name: '15 Minutes - 1 Hour',
                type: 'bar',
                smooth: true,
                data:repairData.response1H
            },
            {
                name: 'Medium fast percentage',
                type: 'bar',
                smooth: true,
                data:repairData.percentageMediumFast
            },
            {
                name: '1 - 3 Hour',
                type: 'bar',
                smooth: true,
                data:repairData.response3H
            },
            {
                name: 'Fast percentage',
                type: 'bar',
                smooth: true,
                data:repairData.percentageFast
            },
            {
                name: '3 - 12 Hour',
                type: 'bar',
                smooth: true,
                data:repairData.response12H
            },
            {
                name: 'Normal percentage',
                type: 'bar',
                smooth: true,
                data:repairData.percentageNormal
            },
            {
                name: '12 - 24 Hour',
                type: 'bar',
                smooth: true,
                data:repairData.response24H
            },
            {
                name: 'Slow percentage',
                type: 'bar',
                smooth: true,
                data:repairData.percentageSlow
            },
            {
                name: '1 - 3 Days',
                type: 'bar',
                smooth: true,
                data:repairData.response3D
            },
            {
                name: 'Medium slow percentage',
                type: 'bar',
                smooth: true,
                data:repairData.percentageMediumSlow
            },
            {
                name: 'More 3 Days',
                type: 'bar',
                smooth: true,
                data:repairData.responseMore
            },
            {
                name: 'Very slow percentage',
                type: 'bar',
                smooth: true,
                data:repairData.percentageVerySlow
            },
            {
                name: 'Not finished',
                type: 'bar',
                smooth: true,
                data:repairData.yearlyUncompleted
            }
          ];
          this.$parent.barTypeCharts('complainrepairmedrepairResponseTime' ,repairData.yearData ,repairResponseSeriesData ,this.$parent.colorcode.sixteenColorInformation);
        }else {
          if (filterData.length === 0) {
            console.log("Charts Unavailable");
          }else {
            let complainData = {
              'monthlyTotalComplain':[]
            };
            let repairData = {
              'yearData':[],
              'monthlyTotalRepair':[],
              'yearlyTotalRepair':[],
              'yearlyTotalResponse':[],
              'yearlyCompleted':[],
              'yearlyUncompleted':[],
              'response15m':[],
              'percentageVeryFast':[],
              'response1H':[],
              'percentageMediumFast':[],
              'response3H':[],
              'percentageFast':[],
              'response12H':[],
              'percentageNormal':[],
              'response24H':[],
              'percentageSlow':[],
              'response3D':[],
              'percentageMediumSlow':[],
              'responseMore':[],
              'percentageVerySlow':[],
              'summaryResultPIC':[],
              'summaryResponseTime':[]
            };
            let reduceYear = filterData.reduce(function(r,a) {
              r[a.cplYear] = r[a.cplYear] || [];
              r[a.cplYear].push(a);
              return r;
            }, Object.create(null));
            //by Yearly
            let reduceMonth = filterData.reduce(function (r, a) {
                r[a.cplMonth+'_'+a.cplYear] = r[a.cplMonth+'_'+a.cplYear] || [];
                r[a.cplMonth+'_'+a.cplYear].push(a);
                return r;
            }, Object.create(null));
            let resultsMonth = [];
            let sortedMonth = [];
            let monthName = [];
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
                let complain = sortedMonth[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplMonth] = hash[a.cplMonth] || r[r.push({ value: 0 }) - 1]).value += a.cplTotalCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let repair = sortedMonth[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplMonth] = hash[a.cplMonth] || r[r.push({ value: 0 }) - 1]).value += a.rprTotalCount;
                      return r;
                  };
                }(Object.create(null)), []);
                complainData.monthlyTotalComplain.push(complain[0]);
                repairData.monthlyTotalRepair.push(repair[0]);
              }else {
                complainData.monthlyTotalComplain.push({value:sortedMonth[i][0].cplTotalCount});
                repairData.monthlyTotalRepair.push({value:sortedMonth[i][0].rprTotalCount});
              }
            }
            for (var i = 0; i < resultsMonth.length; i++) {
              monthName.push({value:this.$parent.monthIndex(parseInt(resultsMonth[i].split('_')[0]))+'_'+parseInt(resultsMonth[i].split('_')[1])})
            }
            let complainYearlySeriesData= [
              {
                  name: 'Complain',
                  type: 'line',
                  smooth: true,
                  data: complainData.monthlyTotalComplain
              },
              {
                  name: 'Repair',
                  type: 'line',
                  smooth: true,
                  data:repairData.monthlyTotalRepair
              }
            ];
            this.$parent.lineTypeCharts('complanrepairmedYearly',monthName ,complainYearlySeriesData , this.$parent.colorcode.twoColorStatus);

            let allResult = filterData.reduce(function(a,b) {
              return {
                rprFinishBadCount : a.rprFinishBadCount + b.rprFinishBadCount,
                rprFinishGoodCount : a.rprFinishGoodCount + b.rprFinishGoodCount,
                rprPendingCount : a.rprPendingCount + b.rprPendingCount,
                rprInhouseCount : a.rprInhouseCount + b.rprInhouseCount,
                rprVendorCount: a.rprVendorCount + b.rprVendorCount,
                completed : (a.rprFinishGoodCount + b.rprFinishGoodCount) + (a.rprFinishBadCount + b.rprFinishBadCount)
              };
            });
            this.dashboardglance = allResult;
            let yearsName ={name:selectedYear}
            let resultTotal = [
              {value:allResult.rprFinishBadCount + allResult.rprFinishGoodCount + allResult.rprPendingCount, name:'Total result'}
            ];
            let resultChild = [
              {value:allResult.rprFinishGoodCount, name:'Good'},
              {value:allResult.rprFinishBadCount, name:'Bad'},
              {value:allResult.rprFinishBadCount, name:'Pending'}
            ];
            this.$parent.dougnutYearTypeCharts('Status' ,'repairByResults' ,yearsName.name ,resultTotal, resultChild, this.$parent.colorcode.fourColorReverse);

            let personTotal = [{value:allResult.rprInhouseCount + allResult.rprVendorCount, name:'Total result'}];
            let personChild = [
              {value:allResult.rprInhouseCount, name:'InHouse'},
              {value:allResult.rprVendorCount, name:'Vendor'}
            ];
            this.$parent.dougnutYearTypeCharts('Status','repairByPIC' ,yearsName.name, personTotal, personChild, this.$parent.colorcode.triColorPerson);

            let sortedYear = [];
            Object.getOwnPropertyNames(reduceYear).forEach(
                function (val, idx, array) {
                  repairData.yearData.push(
                    {value:parseInt(val)}
                  );
                  sortedYear.push(
                    reduceYear[val]
                  )
                }
            );
            for (var i = 0; i < sortedYear.length; i++) {
              if (sortedYear[i].length > 1) {
                let timeYear =  sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value = a.cplYear;
                      return r;
                  };
                }(Object.create(null)), []);

                let responseTimeInTotal = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr15MinCount + a.rpr1HCount + a.rpr3HCount + a.rpr12HCount + a.rpr24HCount + a.rpr3DCount + a.rprMoreCount;
                      return r;
                  };
                }(Object.create(null)), []);

                //15m
                let time_15m = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr15MinCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let veryFast15 = Math.floor(time_15m[0].value * 100);
                let totalveryFast15 = parseFloat(veryFast15).toFixed(2) / responseTimeInTotal[0].value;
                let percentageveryFast15 = totalveryFast15.toFixed(2);

                //1H
                let time_1H = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr1HCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let mediumFast1 = Math.floor(time_1H[0].value * 100);
                let totalmediumFast1= parseFloat(mediumFast1).toFixed(2) / responseTimeInTotal[0].value;
                let percentagemediumFast1 = totalmediumFast1.toFixed(2);

                //3H
                let time_3H = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr3HCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let fast3 = Math.floor(time_3H[0].value * 100);
                let totalFast3= parseFloat(fast3).toFixed(2) / responseTimeInTotal[0].value;
                let percentageFast3= totalFast3.toFixed(2);

                //12H
                let time_12H = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr12HCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let normal12 = Math.floor(time_12H[0].value * 100);
                let totalNormal12 = parseFloat(normal12).toFixed(2) / responseTimeInTotal[0].value;
                let percentageNormal12 = totalNormal12.toFixed(2);

                //24H
                let time_24H = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr24HCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let slow24 = Math.floor(time_24H[0].value * 100);
                let totalSlow24 = parseFloat(slow24).toFixed(2) / responseTimeInTotal[0].value;
                let percentageSlow24 = totalSlow24.toFixed(2);

                //3D
                let time_3D = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rpr3DCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let mediumSlow3 = Math.floor(time_3D[0].value * 100);
                let totalmediumSlow3 = parseFloat(mediumSlow3).toFixed(2) / responseTimeInTotal[0].value;
                let percentagemediumSlow3 = totalmediumSlow3.toFixed(2);

                //More
                let time_More = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprMoreCount;
                      return r;
                  };
                }(Object.create(null)), []);
                let verySlowMore = Math.floor(time_More[0].value * 100);
                let totalverySlowMore = parseFloat(verySlowMore).toFixed(2) / responseTimeInTotal[0].value;
                let percentageverySlowMore = totalverySlowMore.toFixed(2);

                let totalInHouse = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprInhouseCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let totalVendor = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprInhouseCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let totalPIC = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprInhouseCount + a.rprVendorCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let totalYearly = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprTotalCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let goodResult = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishGoodCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let badResult = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishBadCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let pendingResult = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprPendingCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let totalResults = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishBadCount + a.rprFinishGoodCount + a.rprPendingCount;
                      return r;
                  };
                }(Object.create(null)), []);

                let totalComplete = sortedYear[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.cplYear] = hash[a.cplYear] || r[r.push({ value: 0 }) - 1]).value += a.rprFinishBadCount + a.rprFinishGoodCount;
                      return r;
                  };
                }(Object.create(null)), []);

                repairData.summaryResultPIC.push({
                  'years': timeYear[0].value,
                  'goodResult':goodResult[0].value,
                  'badResult':badResult[0].value,
                  'pendingResult':pendingResult[0].value,
                  'totalResults':totalResults[0].value,
                  'InHouse':totalInHouse[0].value,
                  'byVendor':totalVendor[0].value,
                  'totalPIC':totalPIC[0].value
                });
                repairData.summaryResponseTime.push({
                  'years': timeYear[0].value,
                  't15m':time_15m[0].value,
                  'percentageFast':percentageveryFast15,
                  't1H':time_1H[0].value,
                  'percentageMediumFast':percentagemediumFast1,
                  't3H':time_3H[0].value,
                  'percentageFast':percentageFast3,
                  't12H':time_12H[0].value,
                  'percentageNormal':percentageNormal12,
                  't24H':time_24H[0].value,
                  'percentageSlow':percentageSlow24,
                  't3D':time_3D[0].value,
                  'percentageMediumSlow':percentagemediumSlow3,
                  'More3':time_More[0].value,
                  'percentageVerySlow':percentageverySlowMore,
                  'totalComplete': totalComplete[0].value,
                  'totalUncompleted':pendingResult[0].value,
                  'totalResults':totalResults[0].value
                });

                repairData.response15m.push(time_15m[0]);
                repairData.percentageVeryFast.push({value:percentageveryFast15});
                repairData.response1H.push(time_1H[0]);
                repairData.percentageMediumFast.push({value:percentagemediumFast1});
                repairData.response3H.push(time_3H[0]);
                repairData.percentageFast.push({value:percentageFast3});
                repairData.response12H.push(time_12H[0]);
                repairData.percentageNormal.push({value:percentageNormal12});
                repairData.response24H.push(time_24H[0]);
                repairData.percentageSlow.push({value:percentageSlow24});
                repairData.response3D.push(time_3D[0]);
                repairData.percentageMediumSlow.push({value:percentagemediumSlow3});
                repairData.responseMore.push(time_More[0]);
                repairData.percentageVerySlow.push({value:percentageverySlowMore});
                repairData.yearlyTotalResponse.push(responseTimeInTotal[0]);
                repairData.yearlyTotalRepair.push(totalYearly[0]);
                repairData.yearlyCompleted.push(totalComplete[0]);
                repairData.yearlyUncompleted.push(pendingResult[0]);
              }else {
                let responseTimeInTotal = sortedMonth[i][0].rpr15MinCount + sortedMonth[i][0].rpr1HCount + sortedMonth[i][0].rpr3HCount + sortedMonth[i][0].rpr12HCount + sortedMonth[i][0].rpr24HCount + sortedMonth[i][0].rpr3DCount + sortedMonth[i][0].rprMoreCount;
                //15m
                repairData.response15m.push({value:sortedMonth[i][0].rpr15MinCount});
                let veryFast15 = Math.floor(sortedMonth[i][0].rpr15MinCount * 100);
                let totalveryFast15 = parseFloat(veryFast15).toFixed(2) / responseTimeInTotal;
                let percentageveryFast15 = totalveryFast15.toFixed(2);
                repairData.percentageVeryFast.push({value:percentageveryFast15});

                //1h
                repairData.response1H.push({value:sortedMonth[i][0].rpr1HCount});
                let mediumFast1 = Math.floor(sortedMonth[i][0].rpr1HCount * 100);
                let totalmediumFast1= parseFloat(mediumFast1).toFixed(2) / responseTimeInTotal;
                let percentagemediumFast1 = totalmediumFast1.toFixed(2);
                repairData.percentageMediumFast.push({value:percentagemediumFast1});

                //3H
                repairData.response3H.push({value:sortedMonth[i][0].rpr3HCount});
                let fast3 = Math.floor(sortedMonth[i][0].rpr3HCount * 100);
                let totalFast3= parseFloat(fast3).toFixed(2) / responseTimeInTotal;
                let percentageFast3= totalFast3.toFixed(2);
                repairData.percentageFast.push({value:percentageFast3});

                //12H
                repairData.response12H.push({value:sortedMonth[i][0].rpr12HCount});
                let normal12 = Math.floor(sortedMonth[i][0].rpr12HCount * 100);
                let totalNormal12 = parseFloat(normal12).toFixed(2) / responseTimeInTotal;
                let percentageNormal12 = totalNormal12.toFixed(2);
                repairData.percentageNormal.push({value:percentageNormal12});

                //24H
                repairData.response24H.push({value:sortedMonth[i][0].rpr24HCount});
                let slow24 = Math.floor(sortedMonth[i][0].rpr24HCount * 100);
                let totalSlow24 = parseFloat(slow24).toFixed(2) / responseTimeInTotal;
                let percentageSlow24 = totalSlow24.toFixed(2);
                repairData.percentageSlow.push({value:percentageSlow24});

                //3D
                repairData.response3D.push({value:sortedMonth[i][0].rpr3DCount});
                let mediumSlow3 = Math.floor(sortedMonth[i][0].rpr3DCount * 100);
                let totalmediumSlow3 = parseFloat(mediumSlow3).toFixed(2) / responseTimeInTotal;
                let percentagemediumSlow3 = totalmediumSlow3.toFixed(2);
                repairData.percentageMediumSlow.push({value:percentagemediumSlow3});

                //More
                repairData.responseMore.push({value:sortedMonth[i][0].rprMoreCount});
                let verySlowMore = Math.floor(sortedMonth[i][0].rprMoreCount * 100);
                let totalverySlowMore = parseFloat(verySlowMore).toFixed(2) / responseTimeInTotal;
                let percentageverySlowMore = totalverySlowMore.toFixed(2);
                repairData.percentageVerySlow.push({value:percentageverySlowMore});

                repairData.yearlyTotalResponse.push({value:responseTimeInTotal});
                repairData.yearlyTotalRepair.push({value:sortedMonth[i][0].rprTotalCount});
                repairData.yearlyCompleted.push({value:sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount});
                repairData.yearlyUncompleted.push({value:sortedMonth[i][0].rprPendingCount});


                repairData.summaryResultPIC.push({
                  'years': sortedMonth[i][0].cplYear,
                  'goodResult':sortedMonth[i][0].rprFinishGoodCount,
                  'badResult':sortedMonth[i][0].rprFinishBadCount,
                  'pendingResult':sortedMonth[i][0].rprPendingCount,
                  'totalResults':sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount + sortedMonth[i][0].rprPendingCount,
                  'InHouse':sortedMonth[i][0].rprInhouseCount,
                  'byVendor':sortedMonth[i][0].rprVendorCount,
                  'totalPIC':sortedMonth[i][0].rprInhouseCount + sortedMonth[i][0].rprVendorCount
                });
                repairData.summaryResponseTime.push({
                  'years': sortedMonth[i][0].cplYear,
                  't15m':sortedMonth[i][0].rpr15MinCount,
                  'percentageFast':percentageveryFast15,
                  't1H':sortedMonth[i][0].rpr1HCount,
                  'percentageMediumFast':percentagemediumFast1,
                  't3H':sortedMonth[i][0].rpr3HCount,
                  'percentageFast':percentageFast3,
                  't12H':sortedMonth[i][0].rpr12HCount,
                  'percentageNormal':percentageNormal12,
                  't24H':sortedMonth[i][0].rpr24HCount,
                  'percentageSlow':percentageSlow24,
                  't3D':sortedMonth[i][0].rpr3DCount,
                  'percentageMediumSlow':percentagemediumSlow3,
                  'More3':sortedMonth[i][0].rprMoreCount,
                  'percentageVerySlow':percentageverySlowMore,
                  'totalComplete': sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount,
                  'totalUncompleted':sortedMonth[i][0].rprPendingCount,
                  'totalResults':sortedMonth[i][0].rprFinishBadCount + sortedMonth[i][0].rprFinishGoodCount + sortedMonth[i][0].rprPendingCount
                });
              }
            }
            this.summaryResultPIC = repairData.summaryResultPIC;
            this.summaryResponseTime = repairData.summaryResponseTime;
            let repairResponseSeriesData = [
              {
                  name: 'Total',
                  type: 'bar',
                  smooth: true,
                  data:repairData.yearlyTotalResponse
              },
              {
                  name: '15 Minutes',
                  type: 'bar',
                  smooth: true,
                  data:repairData.response15m
              },
              {
                  name: 'Very fast percentage',
                  type: 'bar',
                  smooth: true,
                  data:repairData.percentageVeryFast
              },
              {
                  name: '15 Minutes - 1 Hour',
                  type: 'bar',
                  smooth: true,
                  data:repairData.response1H
              },
              {
                  name: 'Medium fast percentage',
                  type: 'bar',
                  smooth: true,
                  data:repairData.percentageMediumFast
              },
              {
                  name: '1 - 3 Hour',
                  type: 'bar',
                  smooth: true,
                  data:repairData.response3H
              },
              {
                  name: 'Fast percentage',
                  type: 'bar',
                  smooth: true,
                  data:repairData.percentageFast
              },
              {
                  name: '3 - 12 Hour',
                  type: 'bar',
                  smooth: true,
                  data:repairData.response12H
              },
              {
                  name: 'Normal percentage',
                  type: 'bar',
                  smooth: true,
                  data:repairData.percentageNormal
              },
              {
                  name: '12 - 24 Hour',
                  type: 'bar',
                  smooth: true,
                  data:repairData.response24H
              },
              {
                  name: 'Slow percentage',
                  type: 'bar',
                  smooth: true,
                  data:repairData.percentageSlow
              },
              {
                  name: '1 - 3 Days',
                  type: 'bar',
                  smooth: true,
                  data:repairData.response3D
              },
              {
                  name: 'Medium slow percentage',
                  type: 'bar',
                  smooth: true,
                  data:repairData.percentageMediumSlow
              },
              {
                  name: 'More 3 Days',
                  type: 'bar',
                  smooth: true,
                  data:repairData.responseMore
              },
              {
                  name: 'Very slow percentage',
                  type: 'bar',
                  smooth: true,
                  data:repairData.percentageVerySlow
              },
              {
                  name: 'Not finished',
                  type: 'bar',
                  smooth: true,
                  data:repairData.yearlyUncompleted
              }
            ];
            this.$parent.barTypeCharts('complainrepairmedrepairResponseTime' ,repairData.yearData ,repairResponseSeriesData ,this.$parent.colorcode.sixteenColorInformation);
          }
        }
      });
    })
  },
  updated(){
    this.$parent.glanceCount();
  }
}
</script>
