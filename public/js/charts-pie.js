/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */

let tepatWaktu = window.chartData.tepatWaktu;
let tidakTepatWaktu = window.chartData.tidakTepatWaktu;

const pieConfig = {
    type: "doughnut",
    data: {
        datasets: [
            {
                data: [tepatWaktu, tidakTepatWaktu],
                backgroundColor: ["#10b981", "#fb7185"],
                borderWidth: 0,
                hoverOffset: 4,
            },
        ],
        labels: ["Tepat waktu", "Tidak tepat waktu"],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: "75%",
        plugins: {
            legend: {
                display: false,
            },
            tooltip: {
                backgroundColor: "#1f2937",
                titleFont: { family: "Inter", size: 13 },
                bodyFont: { family: "Inter", size: 13 },
                padding: 12,
                cornerRadius: 8,
                displayColors: false,
            },
        },
    },
};

// change this to the id of your chart element in HMTL
const pieCtx = document.getElementById("pie");
window.myPie = new Chart(pieCtx, pieConfig);
