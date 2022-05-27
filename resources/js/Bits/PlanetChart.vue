<template>
  <div>
    <canvas id="planet-chart"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js";
export default {
  name: "PlanetChart",
  props: ["total_closed", "total_open"],
  data() {
    return {
      planetChartData: {
        type: "pie",
        data: {
          labels: ["Closed Tickets", "Open Tickets"],
          datasets: [
            {
              label: "Tickets",
              data: [this.total_closed, this.total_open],
              // backgroundColor: "rgba(54,73,93,.5)",
              borderColor: "#36495d",
              borderWidth: 1,
              backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)"],
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
      },
    };
  },
  mounted() {
    const ctx = document.getElementById("planet-chart");
    new Chart(ctx, this.planetChartData);
  },
};
</script>
