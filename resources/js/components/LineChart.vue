<template>
  <div class="hello" ref="lineChart"></div>
</template>

<script>
export default {
  name: "LineChart",

  props: ["dataSet"],

  data() {
    return {
      lineDataSet: this.dataSet
    };
  },

  watch: {
    dataSet() {
      this.lineDataSet = this.dataSet;
      console.log(this.dataSet);
    }
  },

  mounted() {
    console.log(this.dataSet, "aa");

    let chart = am4core.create(this.$refs.lineChart, am4charts.XYChart);

    chart.paddingRight = 20;

    let data = [];
    let visits = 10;

    for (let i = 1; i < 366; i++) {
      visits += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
      data.push({
        date: new Date(2018, 0, i),
        name: "name" + i,
        value: visits
      });
    }

    chart.data = data;

    let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.grid.template.location = 0;

    let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;
    valueAxis.renderer.minWidth = 35;

    let series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.dateX = "date";
    series.dataFields.valueY = "value";

    series.tooltipText = "{valueY.value}";
    chart.cursor = new am4charts.XYCursor();

    //let scrollbarX = new am4charts.XYChartScrollbar();
    //scrollbarX.series.push(series);
    //chart.scrollbarX = scrollbarX;

    this.chart = chart;
  },

  beforeDestroy() {
    if (this.chart) {
      this.chart.dispose();
    }
  }
};
</script>

<style scoped>
.hello {
  width: 100%;
  height: 500px;
}
</style>