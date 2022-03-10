<template>
  <section>
    <div class="row">
      <div class="col-xl-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
            <p class="card-title text-capitalize">mutation by status</p>
          </div>
          <div class="card-body">
            <div id="mutationmedStatus" data-chart-size="B"></div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
            <p class="card-title text-capitalize">yearly mutation</p>
          </div>
          <div class="card-body">
            <div class="charts-wrapper">
              <div id="mutationmedYearly" data-chart-size="B"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
module.exports={
  mounted(){
    this.$nextTick(function() {
      //mutation
      axios.get(BASE_URL+'dashboard/med/charts_data/mutation')
      .then(result =>{
        let selectedYear = this.$parent.chartsYear;
        let resultData  = result.data.mutation;
        resultData.sort(function(a, b){
              return a.mutYear - b.mutYear || a.mutMonth - b.mutMonth;
        });
        let filterData = resultData.filter(function(obj) {
          return obj.mutYear === parseInt(selectedYear);
        });
        if (selectedYear === 'ALL') {
          //by Status
          let results = resultData.reduce(function(a,b) {
            return{
              mutDo: a.mutDo + b.mutDo,
              mutOnProcess: a.mutOnProcess + b.mutOnProcess,
              mutReject: a.mutReject + b.mutReject,
              mutTotal: a.mutTotal + b.mutTotal
            }
          });
          let statusTotal = [
            {value:results.mutTotal, name:'Total Mutation'}
          ];
          let statusYear = {name:selectedYear};
          let statusChild = [
            {value:results.mutDo, name:'Doing Mutation'},
            {value:results.mutOnProcess, name:'On Process'},
            {value:results.mutReject, name:'Rejected'},
          ];
          this.$parent.dougnutYearTypeCharts('Status','mutationmedStatus',statusYear, statusTotal, statusChild, this.$parent.colorcode.fourColorReverse);
          //By yearly
          let reduceMonth = resultData.reduce(function (r, a) {
              r[a.mutMonth+'_'+a.mutYear] = r[a.mutMonth+'_'+a.mutYear] || [];
              r[a.mutMonth+'_'+a.mutYear].push(a);
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
                    (hash[a.mutMonth] = hash[a.mutMonth] || r[r.push({ value: 0 }) - 1]).value += a.mutOnProcess + a.mutReject;
                    return r;
                };
              }(Object.create(null)), []);
              let implemented = sortedMonth[i].reduce(function (hash) {
                return function (r, a) {
                    (hash[a.mutMonth] = hash[a.mutMonth] || r[r.push({ value: 0 }) - 1]).value += a.mutDo;
                    return r;
                };
              }(Object.create(null)), []);
              plannedData.push(planned[0]);
              implementedData.push(implemented[0]);
            }else {
              plannedData.push({value:(sortedMonth[i][0].mutOnProcess + sortedMonth[i][0].mutReject) });
              implementedData.push({value:(sortedMonth[i][0].mutDo)});
            }
          }
          for (var i = 0; i < resultsMonth.length; i++) {
            monthName.push({value:this.$parent.monthIndex(parseInt(resultsMonth[i].split('_')[0]))+'_'+parseInt(resultsMonth[i].split('_')[1])})
          }
          let mutationYearlySeriesData = [
            {
                name: 'Request',
                type: 'line',
                smooth: true,
                data:plannedData
            },
            {
                name: 'Approval',
                type: 'line',
                smooth: true,
                data:implementedData
            }
          ];
          this.$parent.lineTypeCharts('mutationmedYearly', monthName ,mutationYearlySeriesData ,this.$parent.colorcode.triColorStatus);
        }else {
          if (filterData.length === 0) {
            console.log("Charts Unavailable");
          }else {
            //by Status
            let results = filterData.reduce(function(a,b) {
              return{
                mutDo: a.mutDo + b.mutDo,
                mutOnProcess: a.mutOnProcess + b.mutOnProcess,
                mutReject: a.mutReject + b.mutReject,
                mutTotal: a.mutTotal + b.mutTotal,
                mutYear: a.mutYear
              }
            });
            let statusTotal = [
              {value:results.mutTotal, name:'Total Mutation'}
            ];
            let statusYear = {name:results.mutYear};
            let statusChild = [
              {value:results.mutDo, name:'Doing Mutation'},
              {value:results.mutOnProcess, name:'On Process'},
              {value:results.mutReject, name:'Rejected'},
            ];
            this.$parent.dougnutYearTypeCharts('Status','mutationmedStatus',statusYear, statusTotal, statusChild, this.$parent.colorcode.fourColorReverse);
            //By yearly
            let reduceMonth = filterData.reduce(function (r, a) {
                r[a.mutMonth] = r[a.mutMonth] || [];
                r[a.mutMonth].push(a);
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
                      (hash[a.mutMonth] = hash[a.mutMonth] || r[r.push({ value: 0 }) - 1]).value += a.mutOnProcess + a.mutReject;
                      return r;
                  };
                }(Object.create(null)), []);
                let implemented = sortedMonth[i].reduce(function (hash) {
                  return function (r, a) {
                      (hash[a.mutMonth] = hash[a.mutMonth] || r[r.push({ value: 0 }) - 1]).value += a.mutDo;
                      return r;
                  };
                }(Object.create(null)), []);
                plannedData.push(planned[0]);
                implementedData.push(implemented[0]);
              }else {
                plannedData.push({value:(sortedMonth[i][0].mutOnProcess + sortedMonth[i][0].mutReject)});
                implementedData.push({value:(sortedMonth[i][0].mutDo)});
              }
            }
            for (var i = 0; i < resultsMonth.length; i++) {
              monthName.push({value:this.$parent.monthIndex(resultsMonth[i])});
            }
            let mutationYearlySeriesData = [
              {
                  name: 'Request',
                  type: 'line',
                  smooth: true,
                  data:plannedData
              },
              {
                  name: 'Approval',
                  type: 'line',
                  smooth: true,
                  data:implementedData
              }
            ];
            this.$parent.lineTypeCharts('mutationmedYearly', monthName ,mutationYearlySeriesData ,this.$parent.colorcode.triColorStatus);
          }
        }
      });
    });
  }
}
</script>
