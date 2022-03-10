<template>
  <section>
    <div class="row">
      <div class="col-xl-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
            <p class="card-title text-capitalize">assets by condition</p>
          </div>
          <div class="card-body">
            <div id="assetsnonStatus" data-chart-size="A"></div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
            <p class="card-title text-capitalize">assets by ownership</p>
          </div>
          <div class="card-body">
              <div id="assetsnonOwnership" data-chart-size="A"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
            <p class="card-title text-capitalize">annual investment of assets</p>
          </div>
          <div class="card-body">
            <div class="charts-wrapper">
              <div id="assetsnonInvestment" data-chart-size="B"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card with-shadow is-soft-rounded">
          <div class="card-header border-bottom-only-1 border-light" data-color-type="light">
              <p class="card-title text-capitalize">assets by lifetime</p>
          </div>
          <div class="card-body">
            <div id="assetsnonLifetime" data-chart-size="B"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
module.exports={
  mounted(){
    this.$nextTick(function(){

      axios.get(BASE_URL+'dashboard/non/charts_data/assets')
      .then(result => {
        let resultData = result.data.assets;
        let selectedYear = this.$parent.chartsYear;

        //Assets Condition
        let reducesAssetCondition = resultData.asset_condition.reduce(function (r, a) {
            r[a.assetCondition] = r[a.assetCondition] || [];
            r[a.assetCondition].push(a);
            return r;
        }, Object.create(null));
        let resultAssetConditions = [];
        let conditionChild = [];
        Object.getOwnPropertyNames(reducesAssetCondition).forEach(
            function (val, idx, array) {
              resultAssetConditions.push(
                reducesAssetCondition[val].reduce(function(a,b) {
                  return{
                    assetCount: a.assetCount + b.assetCount,
                    assetCondition: val
                  }
                })
              );
            }
        );
        for (var i = 0; i < resultAssetConditions.length; i++) {
          conditionChild.push({value: resultAssetConditions[i].assetCount, name:resultAssetConditions[i].assetCondition});
        }
        let totalCondition = resultAssetConditions.reduce(function(a,b){
          return {
            assetCount : a.assetCount + b.assetCount
          }
        });
        let conditionTotal = [
          {value:totalCondition.assetCount, name: 'Total Assets Condition'}
        ];
        this.$parent.dougnutTypeCharts('Status' ,'assetsnonStatus',conditionTotal, conditionChild, this.$parent.colorcode.fiveColorStatus);

        //Assets Ownership
        let reducesAssetOwnership = resultData.asset_ownership.reduce(function (r, a) {
            r[a.ownType] = r[a.ownType] || [];
            r[a.ownType].push(a);
            return r;
        }, Object.create(null));
        let resultAssetOwnership = [];
        let ownershipChild = [];
        Object.getOwnPropertyNames(reducesAssetOwnership).forEach(
            function (val, idx, array) {
              resultAssetOwnership.push(
                reducesAssetOwnership[val].reduce(function(a,b) {
                  return{
                    assetCount: a.assetCount + b.assetCount,
                    ownType: val
                  }
                })
              );
            }
        );
        for (var i = 0; i < resultAssetOwnership.length; i++) {
          ownershipChild.push({value: resultAssetOwnership[i].assetCount, name:resultAssetOwnership[i].ownType});
        }
        let totalOwnerhip = resultAssetOwnership.reduce(function(a,b){
          return {
            assetCount : a.assetCount + b.assetCount
          }
        });
        let ownershipTotal = [
          {value:totalOwnerhip.assetCount, name: 'Total Assets Ownership'}
        ];
        this.$parent.dougnutTypeCharts('Ownership By' ,'assetsnonOwnership' ,ownershipTotal, ownershipChild, this.$parent.colorcode.sevenColorStatus);

        //Assets Lifetime
        let reducesAssetLifetime = resultData.asset_lifetime.reduce(function (r, a) {
            r[a.assetLifeTime] = r[a.assetLifeTime] || [];
            r[a.assetLifeTime].push(a);
            return r;
        }, Object.create(null));
        let resultAssetLifetime = [];
        let lifetimeChild = [];
        Object.getOwnPropertyNames(reducesAssetLifetime).forEach(
            function (val, idx, array) {
              resultAssetLifetime.push(
                reducesAssetLifetime[val].reduce(function(a,b) {
                  return{
                    assetCount: a.assetCount + b.assetCount,
                    assetLifeTime: val
                  }
                })
              );
            }
        );
        for (var i = 0; i < resultAssetLifetime .length; i++) {
          lifetimeChild.push({value: resultAssetLifetime[i].assetCount, name:resultAssetLifetime[i].assetLifeTime});
        }
        let totalLifetime = resultAssetLifetime.reduce(function(a,b){
          return {
            assetCount : a.assetCount + b.assetCount
          }
        });
        let lifetimeTotal = [
          {value:totalLifetime.assetCount, name: 'Total Assets Lifetime'}
        ];
        this.$parent.dougnutTypeCharts('Assets Age' ,'assetsnonLifetime' ,lifetimeTotal, lifetimeChild, this.$parent.colorcode.sixColorInformation);

        //Assets investment
        let filterDataInvestment = resultData.asset_investment.filter(function(obj) {
          return obj.depreYear == selectedYear;
        });
        if (selectedYear === 'ALL') {
          let reducesAssetInvestment = resultData.asset_investment.reduce(function (r, a) {
              r[a.depreYear] = r[a.depreYear] || [];
              r[a.depreYear].push(a);
              return r;
          }, Object.create(null));
          let resultAssetInvestment = [];
          Object.getOwnPropertyNames(reducesAssetInvestment).forEach(
              function (val, idx, array) {
                resultAssetInvestment.push(
                  reducesAssetInvestment[val].reduce(function(a,b) {
                    return{
                      valBook: a.valBook + b.valBook,
                      valDepre: a.valDepre + b.valDepre,
                      valTotal: a.valTotal + b.valTotal,
                      year: val
                    }
                  })
                );
              }
          );
          let investYear = [];
          let investChild = {
            'valBook':[],
            'valDepre':[],
            'valTotal':[],
          };
          for (var i = 0; i < resultAssetInvestment.length; i++) {
            investChild.valBook.push({value:resultAssetInvestment[i].valBook});
            investChild.valDepre.push({value:resultAssetInvestment[i].valDepre});
            investChild.valTotal.push({value:resultAssetInvestment[i].valTotal});
            investYear.push({value:resultAssetInvestment[i].year});
          }
          let investmentSeriesData = [
              {
                  name: 'Book',
                  type: 'bar',
                  smooth: true,
                  data:investChild.valBook
              },
              {
                  name: ' Depreciation',
                  type: 'bar',
                  smooth: true,
                  data:investChild.valDepre
              },
              {
                  name: 'Total',
                  type: 'bar',
                  smooth: true,
                  data:investChild.valTotal
              }
          ];
          this.$parent.barTypeCharts('assetsnonInvestment' ,investYear ,investmentSeriesData ,this.$parent.colorcode.triColorPrice);
        }else {
          if (filterDataInvestment.length === 0) {
            console.log('Charts Unavailable');
          }else {
            let reducesAssetInvestment = filterDataInvestment.reduce(function (r, a) {
                r[a.depreYear] = r[a.depreYear] || [];
                r[a.depreYear].push(a);
                return r;
            }, Object.create(null));
            let resultAssetInvestment = [];
            Object.getOwnPropertyNames(reducesAssetInvestment).forEach(
                function (val, idx, array) {
                  resultAssetInvestment.push(
                    reducesAssetInvestment[val].reduce(function(a,b) {
                      return{
                        valBook: a.valBook + b.valBook,
                        valDepre: a.valDepre + b.valDepre,
                        valTotal: a.valTotal + b.valTotal,
                        year: val
                      }
                    })
                  );
                }
            );
            let investYear = [
              {value:selectedYear}
            ];
            let investChild = {
              'valBook':[],
              'valDepre':[],
              'valTotal':[],
            };
            for (var i = 0; i < resultAssetInvestment.length; i++) {
              investChild.valBook.push({value:resultAssetInvestment[i].valBook});
              investChild.valDepre.push({value:resultAssetInvestment[i].valDepre});
              investChild.valTotal.push({value:resultAssetInvestment[i].valTotal});
            };
            let investmentSeriesData = [
                {
                    name: 'Book',
                    type: 'bar',
                    smooth: true,
                    data:investChild.valBook
                },
                {
                    name: ' Depreciation',
                    type: 'bar',
                    smooth: true,
                    data:investChild.valDepre
                },
                {
                    name: 'Total',
                    type: 'bar',
                    smooth: true,
                    data:investChild.valTotal
                }
            ];
            this.$parent.barTypeCharts('assetsnonInvestment' ,investYear ,investmentSeriesData ,this.$parent.colorcode.triColorPrice);
          }
        }
      }).catch(error => {
        console.log('Charts Unavailable');
      })

    });

  },
  updated(){
    console.log(this.$parent.depreciationYear);
  }
}
</script>
