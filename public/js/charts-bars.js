/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
const barConfig = {
    type: 'bar',
    data: {
        labels: [
            'Pendidikan',
            'Penelitian',
            'Pengabdian',
            'Penunjang',
        ],
        datasets: [
            {
                label: 'Standar',
                backgroundColor: '#e0e7ff',
                hoverBackgroundColor: '#c7d2fe',
                borderWidth: 0,
                borderRadius: 6,
                data: [100, 100, 100, 100],
            },
            {
                label: 'Ketercapaian',
                backgroundColor: '#6366f1',
                hoverBackgroundColor: '#4f46e5',
                borderWidth: 0,
                borderRadius: 6,
                data: categoryPercentages,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            },
            tooltip: {
                backgroundColor: '#1f2937',
                titleFont: { family: 'Inter', size: 13 },
                bodyFont: { family: 'Inter', size: 13 },
                padding: 12,
                cornerRadius: 8,
            },
        },
        scales: {
            x: {
                grid: {
                    display: false,
                },
                ticks: {
                    font: { family: 'Inter', size: 11 },
                    color: '#6b7280',
                },
            },
            y: {
                grid: {
                    color: '#f3f4f6',
                },
                ticks: {
                    font: { family: 'Inter', size: 11 },
                    color: '#6b7280',
                    callback: function(value) {
                        return value + '%';
                    },
                },
                border: {
                    display: false,
                },
            },
        },
    },
}

const barsCtx = document.getElementById('bars')
window.myBar = new Chart(barsCtx, barConfig)
