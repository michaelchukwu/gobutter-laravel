<template>
  <div>
    <canvas id="pageview-chart"></canvas>
    <!--<div class="footer__address">
        <img src="https://www.devsnews.com/wp/volport/wp-content/uploads/2021/10/pin-icon.png" alt="">
        <span>Address: 68 Kings Street, CA 236500</span>
    </div>-->
  </div>
</template>

<script>
import Chart from "chart.js";
export default {
  name: "PageViewChart",
  props: ["pageviews"],
  data() {
    return {};
  },
  methods: {
    random_rgba() {
      var o = Math.round,
        r = Math.random,
        s = 255;
      return (
        "rgba(" +
        o(r() * s) +
        "," +
        o(r() * s) +
        "," +
        o(r() * s) +
        "," +
        r().toFixed(1) +
        ")"
      );
    },
    makeChart() {
      let Years = new Array();
      let Colors = new Array();
      let SmallColors = new Array();
      let Views = new Array();
      this.pageviews.forEach((element) => {
        Years.push(element.date);
        //   Labels.push(element.name);
        Colors.push("rgb(255, 99, 132)");
        SmallColors.push("rgb(56, 6, 165)");
        Views.push(element.views);
      });
      let planetChartData = {
        type: "bar",
        data: {
          labels: Years,
          datasets: [
            {
              label: "Total Page Views",
              data: Views,
              borderColor: "#36495d",
              borderWidth: 1,
              backgroundColor: Colors,
              hoverOffset: 4,
            },
            {
              label: "Unique Page Views",
              data: Views,
              // backgroundColor: "rgba(54,73,93,.5)",
              borderColor: "#36495d",
              borderWidth: 1,
              backgroundColor: SmallColors,
              hoverOffset: 4,
            },
          ],
        },
        options: {
          responsive: true,
          lineTension: 1,
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  padding: 25,
                },
              },
            ],
          },
        },
      };
      const ctx = document.getElementById("pageview-chart");
      new Chart(ctx, planetChartData);
    },
  },
  //create a method to hold the creation of charts and all
  //   call the method when mounted
  // listen on the filters and call the method when changes have been made
  mounted() {
    this.makeChart();
  },
};
</script>
