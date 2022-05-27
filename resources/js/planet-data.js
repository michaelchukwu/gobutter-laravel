// export const planetChartData = {
//     type: "bar",
//     data: {
//         labels: ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune"],
//         datasets: [
//             {
//                 type: "line",
//                 label: "Number of Moons",
//                 data: [0, 0, 1, 2, 79, 82, 27, 14],
//                 backgroundColor: "rgba(54,73,93,.5)",
//                 borderColor: "#36495d",
//                 borderWidth: 3
//             },
//             {
//                 type: "bar",
//                 label: "Planetary Mass (relative to the Sun x 10^-6)",
//                 data: [0.166, 2.081, 3.003, 0.323, 954.792, 285.886, 43.662, 51.514],
//                 backgroundColor: "rgba(71, 183,132,.5)",
//                 borderColor: "#47b784",
//                 borderWidth: 3
//             }
//         ]
//     },
//     options: {
//         responsive: true,
//         lineTension: 1,
//         scales: {
//             yAxes: [
//                 {
//                     ticks: {
//                         beginAtZero: true,
//                         padding: 25
//                     }
//                 }
//             ]
//         }
//     }
// };

// export default planetChartData;
export const planetChartData = {
    type: "pie",
    data: {
        labels: ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune"],
        datasets: [

            {
                label: "Number of Moons",
                data: [0, 0, 1, 2, 79, 82, 27, 14],
                // backgroundColor: "rgba(54,73,93,.5)",
                borderColor: "#36495d",
                borderWidth: 3,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 9, 86)',
                    'rgb(255, 78, 86)',
                    'rgb(255, 45, 86)',
                    'rgb(255, 98, 86)',
                    'rgb(255, 34, 86)',
                ],
                hoverOffset: 4
            }
        ]
    },
    options: {
        responsive: true,
        lineTension: 1,
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        padding: 25
                    }
                }
            ]
        }
    }
};

export default planetChartData;
