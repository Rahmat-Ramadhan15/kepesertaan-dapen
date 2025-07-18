// Color variables based on css variable.
// ----------------------------------------------
const _body           = getComputedStyle( document.body );
let primaryColor, headingsColor, mutedColorRGB, dangerColor, infoColor, warningColor, successColor, lineChart, gridColor, gridMainColor;



// Get all variable colors
// ----------------------------------------------
let updateColorVars = () => {

   // Update all variable colors
   primaryColor    = window.getComputedStyle(document.querySelector(".page-title")).color; // "red" //`rgba( ${_body.getPropertyValue( "--bs-primary-color-rgb" )}, .75)`;
   headingsColor    = window.getComputedStyle(document.querySelector(".text-body-emphasis")).color; //_body.getPropertyValue( "--bs-primary-color" );
   mutedColorRGB   = `rgba( ${_body.getPropertyValue( "--bs-secondary-color-rgb" )}, .5)`;
   dangerColor     = _body.getPropertyValue("--bs-danger");
   infoColor       = _body.getPropertyValue("--bs-info");
   warningColor    = _body.getPropertyValue("--bs-warning");
   successColor    = _body.getPropertyValue("--bs-success");
   gridColor       = mutedColorRGB.replace(/^(.*,)(.*)\)/g, "$1 .075)");
   gridMainColor   = mutedColorRGB.replace(/^(.*,)(.*)\)/g, "$1 .575)");
   return;
}

const getGridYColor = function( context ) {
   if (context.index > 0) {
      return gridColor;
   } else if (context.index == 0) {
      return gridMainColor;
   }
}

const getGridXColor = function( context ) {
   if (context.index > 0) {
      return "transparent";
   } else if (context.index == 0) {
      return gridMainColor;
   }
}

document.addEventListener( "DOMContentLoaded", () => {

   // Update color variables based on css variable.
   // ----------------------------------------------
   updateColorVars();



   // Line Chart
   // ----------------------------------------------
   

   lineChart = new Chart( document.getElementById('_dm-lineChart'), {
      type: 'line',
      data: {
         datasets: [
            {
               label: 'Recent PHDP',
               data: lineData,
               borderWidth: 1.75,
               borderColor: primaryColor,
               backgroundColor: primaryColor,
               parsing: {
                  xAxisKey: 'elapsed',
                  yAxisKey: 'value'
               }
            }
         ]
      },
      options: {
         plugins: {
            title: {
               display: true,
               color: headingsColor,
               text: 'Recent Pesertas Chart'
            },
            legend: {
               display: true,
               labels: {
                  color: headingsColor,
                  boxWidth: 10,
               }
            }
         },
         // Tooltip mode
         interaction: {
            intersect: false,
         },

         responsive: true,
         maintainAspectRatio: false,

         scales: {
            y: {
               grid: {
                  color: getGridYColor,
                  lineWidth: 2
               },
               suggestedMax: 30,
               ticks: {
                  font: { size: 11 },
                  color: headingsColor,
                  beginAtZero: false,
                  stepSize: 5
               }
            },
            x: {
               grid: {
                  color: getGridXColor,
                  lineWidth: 2
               },
               ticks: {
                  font: { size: 12 },
                  color: headingsColor,
                  autoSkip: true,
                  maxRotation: 0,
                  minRotation: 0,
                  maxTicksLimit: 9
               }
            }
         },

         elements: {
            // Dot width
            point: {
               radius: 1,
               hoverRadius: 5
            },
            // Smooth lines
            line: {
               tension: 0.4
            }
         }
      }
   });

      const ctxRataRata = document.getElementById('_dm-lineChartLaporan');

if (ctxRataRata && window.avgLineChartData) {
   lineChartLaporan = new Chart(ctxRataRata, {
      type: 'line',
      data: {
         labels: window.avgLineChartData.labels,
         datasets: window.avgLineChartData.datasets
      },
      options: {
         plugins: {
            title: {
               display: true,
               color: headingsColor,
               text: 'Grafik Rata-rata PhDP & Saldo per Bulan'
            },
            legend: {
               display: true,
               labels: {
                  color: headingsColor,
                  boxWidth: 10
               }
            }
         },
         interaction: { intersect: false },
         responsive: true,
         maintainAspectRatio: false,
         scales: {
            x: {
               grid: { color: getGridXColor },
               ticks: { color: headingsColor }
            },
            y: {
               grid: { color: getGridYColor },
               ticks: { color: headingsColor }
            }
         },
         elements: {
            point: { radius: 3, hoverRadius: 6 },
            line: { tension: 0.4 }
         }
      }
   });
}


   
   // Doughnut Chart
   // ----------------------------------------------
   const doughnutChart = new Chart(document.getElementById("_dm-doughnutChart"), {
   type: "doughnut",
   data: {
      labels: window.doughnutLabels || ["Default1", "Default2", "Default3"],
      datasets: [{
         data: window.doughnutData || [10, 20, 30],
         borderColor: "transparent",
         backgroundColor: [dangerColor, warningColor, successColor, infoColor, primaryColor, 
  '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'], // bisa diubah sesuai jumlah data
      }]
   },
   options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
         legend: {
            display: false
         },
      }
   }
});


});



// Update the chart"s colors when the color scheme changes.
// ----------------------------------------------
const updateDashboardChart = function() {

   // Update all color variables
   updateColorVars();

   // Update sales chart
   lineChart.data.datasets[0].borderColor = primaryColor;
   lineChart.data.datasets[0].backgroundColor = primaryColor;
   lineChart.options.plugins.title.color = headingsColor;
   lineChart.options.plugins.legend.labels.color = primaryColor;
   lineChart.options.scales.y.grid.color = getGridYColor;
   lineChart.options.scales.x.grid.color = getGridXColor;
   lineChart.options.scales.y.ticks.color = headingsColor;
   lineChart.options.scales.x.ticks.color = headingsColor;

   lineChart.update();

      // Update chart laporan
   lineChartLaporan.data.datasets[0].borderColor = primaryColor;
   lineChartLaporan.data.datasets[0].backgroundColor = primaryColor;
   lineChartLaporan.data.datasets[1].borderColor = warningColor;
   lineChartLaporan.data.datasets[1].backgroundColor = warningColor;
   lineChartLaporan.options.plugins.title.color = headingsColor;
   lineChartLaporan.options.plugins.legend.labels.color = primaryColor;
   lineChartLaporan.options.scales.y.grid.color = getGridYColor;
   lineChartLaporan.options.scales.x.grid.color = getGridXColor;
   lineChartLaporan.options.scales.y.ticks.color = headingsColor;
   lineChartLaporan.options.scales.x.ticks.color = headingsColor;

   lineChartLaporan.update();
   

};

[ "change.nf.colormode", "scheme-changed", "theme-changed" ].forEach( ev => document.addEventListener( ev, updateDashboardChart ))
