function loadDaftarRisiko() {
    $.get('getPenilaianRisiko', (data) => {
        
        th = ``
        th+= `
                <th>ID</th>
                <th >Kategori Risiko</th>
                <th >Besaran Risiko</th>
                <th >Level Risiko</th>
                <th >Prioritas</th>
        `

        thead = `<thead class="text-center">
        <tr>${th}</tr>
        </thead>`

        cell = ``
        data.forEach(d => {
            if (d.besaran_risiko >= 1 && d.besaran_risiko <= 5 ) {
                    style = '"background-color:#039dfc;"'
                } else if (d.besaran_risiko >= 6 && d.besaran_risiko <= 10) {
                    style = '"background-color:#7ec96f;"'
                } else if (d.besaran_risiko >= 11 && d.besaran_risiko <= 15) {
                    style = '"background-color:#ecf547;"'
                } else if (d.besaran_risiko >= 16 && d.besaran_risiko <= 20) {
                    style = '"background-color:#fca949;"'
                } else if (d.besaran_risiko >= 20 && d.besaran_risiko <= 25) {
                    style = '"background-color:#f7693e;"'
                }
            cell+=`
                <tr>
                    <td>
                        <a href="detailRisikoDashboard/${d.id}" class="font-weight-bold">${'ID_'+d.id}</a>
                    </td>
                    <td>
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.besaran_risiko}
                    </td>
                    <td style= ${style}>
                        ${d.level_risiko}
                    </td>
                    <td>
                        ${d.prioritas}
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table19" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-risikoDashboard').html(table)
        $("#table19").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "pageLength" : 3, "order": [[ 2, "desc" ]]
        }).buttons().container().appendTo('#table19_wrapper .col-md-6:eq(0)');
    })
}

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Roboto', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Nunito,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#000';

var barChartData = {
  labels  : [],
  datasets: [
    {
      label               : 'Jumlah',
      backgroundColor     : '#8CBA08',
      borderColor         : '#8CBA08',
      hoverBackgroundColor: "#A1D70A",
      data                : []
    },
  ]
}

var barChartData1 = {
  labels  : [],
  datasets: [
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    }
  ]
}

var barChartData2 = {
  labels  : [],
  datasets: [
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    },
    {
      label               : '',
      backgroundColor     : '',
      borderColor         : '',
      data                : []
    }
  ]
}

var barChartOptions = {
  maintainAspectRatio : false,
  responsive : true,
   indexAxis: 'y',
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      gridLines : {
        display : false,
      },
      ticks: {
          min: 0,
        }
    }],
    yAxes: [{
      gridLines : {
        color: "rgb(101, 101, 102)",
        zeroLineColor: "rgb(101, 101, 102)",
        drawBorder: false,
        borderDash: [5],
        zeroLineBorderDash: [5]
      },
      ticks: {
          min: 0,
          maxTicksLimit: 5
      }
    }]
  },
  tooltips: {
    titleMarginBottom: 10,
    titleFontColor: '#6e707e',
    titleFontSize: 14,
    backgroundColor: "rgb(255,255,255)",
    bodyFontColor: "#858796",
    borderColor: '#dddfeb',
    borderWidth: 1,
    xPadding: 15,
    yPadding: 15,
    displayColors: false,
    caretPadding: 10,
    
    }
}

var barChartOptions1 = {
  maintainAspectRatio : false,
  responsive : true,
  indexAxis: 'yAxes',
  scales: {
    xAxes: [{
      gridLines : {
        display : false,
      },
      stacked : true,
      ticks: {
          maxTicksLimit: 6
        }
    }],
    yAxes: [{
      gridLines : {
        color: "rgb(101, 101, 102)",
        zeroLineColor: "rgb(101, 101, 102)",
        drawBorder: false,
        borderDash: [5],
        zeroLineBorderDash: [5]
      },
      stacked : true,
      ticks: {
          min: 0,
          maxTicksLimit: 5,
          padding: 10
      }
    }]
  },
  tooltips: {
    titleMarginBottom: 10,
    titleFontColor: '#6e707e',
    titleFontSize: 14,
    backgroundColor: "rgb(255,255,255)",
    bodyFontColor: "#858796",
    borderColor: '#dddfeb',
    borderWidth: 1,
    xPadding: 15,
    yPadding: 15,
    displayColors: false,
    caretPadding: 10
    
    }
}

var barChartCanvas = $('#myBarChart').get(0).getContext('2d')
var barChartCanvas1 = $('#myBarChart1').get(0).getContext('2d')
var barChartCanvas2 = $('#myBarChart2').get(0).getContext('2d')
var barChartOptions = $.extend(true, {}, barChartOptions)
var barChartOptions1 = $.extend(true, {}, barChartOptions1)
var barChartData = $.extend(true, {}, barChartData)
var barChartData1 = $.extend(true, {}, barChartData1)
var barChartData2 = $.extend(true, {}, barChartData2)
  // barChartData.datasets[0].fill = true;
  // barChartOptions.datasetFill = false

var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })

var stackedBarChart = new Chart(barChartCanvas1, {
    type: 'bar',
    data: barChartData1,
    options: barChartOptions1
  })

var stackedBarChart1 = new Chart(barChartCanvas2, {
    type: 'bar',
    data: barChartData2,
    options: barChartOptions1
  })

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function loadBarChartLevelRisiko() {
    $.get('getPenilaianRisiko' , (data) => {
        level_risiko = []
        data.forEach( d => level_risiko.push(d.level_risiko) )
        level_risiko = level_risiko.filter(onlyUnique)
        jumlahPerlevel = []
        level_risiko.forEach( t => {
            jmlh = 0
            data.forEach( d => {
                if (d.level_risiko == t) {
                    jmlh = jmlh + 1
                } 
            })
            jumlahPerlevel.push(jmlh)
        })
        globalThis.barChart.data.labels = level_risiko
        globalThis.barChart.data.datasets[0].data = jumlahPerlevel
        globalThis.barChart.update()
    })
}

function loadBarChartKategoriRisiko() {
    $.get('getPenilaianRisiko' , (data) => {
        kategori_risiko = []
        level_risiko = []
        data.forEach( d => {
          kategori_risiko.push(d.kategori_risiko)
          level_risiko.push(d.level_risiko)
        })
        kategori_risiko = kategori_risiko.filter(onlyUnique)
        level_risiko = level_risiko.filter(onlyUnique)
        kategori_risiko = kategori_risiko.sort((a,b) => a.length - b.length);
        perKategori = []
        level_risiko.forEach( l => {
          perLevel = []
          kategori_risiko.forEach( k => {
            jmlh=0
            data.forEach(d => {
              if (d.kategori_risiko==k && d.level_risiko==l) {
                jmlh = jmlh + 1
              }
            })
            perLevel.push(jmlh)
          })
          perKategori.push(perLevel)
        })
        if (globalThis.stackedBarChart.data.datasets.length != level_risiko.length) {
          selisih = globalThis.stackedBarChart.data.datasets.length - level_risiko.length
          globalThis.stackedBarChart.data.datasets = globalThis.stackedBarChart.data.datasets.slice(selisih)
        } 
        globalThis.stackedBarChart.data.labels = kategori_risiko
        for (var i = 0; i < level_risiko.length; i++) {
          
          if (level_risiko[i] == 'Sangat Rendah' ) {
            color = '#039dfc'
            label = 'Sangat Rendah'
          } else if (level_risiko[i] == 'Rendah') {
            color = '#7ec96f'
            label = 'Rendah'
          } else if (level_risiko[i] == 'Sedang') {
            color = '#ecf547'
            label = 'Sedang'
          } else if (level_risiko[i] == 'Tinggi') {
            color = '#fca949'
            label = 'Tinggi'
          } else if (level_risiko[i] == 'Sangat Tinggi') {
            color = '#f7693e'
            label = 'Sangat Tinggi'
          }

          globalThis.stackedBarChart.data.datasets[i].data = perKategori[i]
          globalThis.stackedBarChart.data.datasets[i].backgroundColor = color
          globalThis.stackedBarChart.data.datasets[i].borderColor = color
          globalThis.stackedBarChart.data.datasets[i].label = label

        }
        globalThis.stackedBarChart.update()
    })
}

function loadBarChartDampakRisiko() {
    $.get('getPenilaianRisiko' , (data) => {
        area_dampak = []
        level_risiko = []
        data.forEach( d => {
          area_dampak.push(d.area_dampak)
          level_risiko.push(d.level_risiko)
        })
        area_dampak = area_dampak.filter(onlyUnique)
        level_risiko = level_risiko.filter(onlyUnique)
        area_dampak = area_dampak.sort((a,b) => a.length - b.length);
        perAreaDampak = []
        level_risiko.forEach( l => {
          perLevel = []
          area_dampak.forEach( k => {
            jmlh=0
            data.forEach(d => {
              if (d.area_dampak==k && d.level_risiko==l) {
                jmlh = jmlh + 1
              }
            })
            perLevel.push(jmlh)
            console.log(k)
          })
          perAreaDampak.push(perLevel)
        })
        if (globalThis.stackedBarChart1.data.datasets.length != level_risiko.length) {
          selisih = globalThis.stackedBarChart1.data.datasets.length - level_risiko.length
          globalThis.stackedBarChart1.data.datasets = globalThis.stackedBarChart1.data.datasets.slice(selisih)
        }
        globalThis.stackedBarChart1.data.labels = area_dampak
        for (var i = 0; i < level_risiko.length; i++) {
          
          if (level_risiko[i] == 'Sangat Rendah' ) {
            color = '#039dfc'
            label = 'Sangat Rendah'
          } else if (level_risiko[i] == 'Rendah') {
            color = '#7ec96f'
            label = 'Rendah'
          } else if (level_risiko[i] == 'Sedang') {
            color = '#ecf547'
            label = 'Sedang'
          } else if (level_risiko[i] == 'Tinggi') {
            color = '#fca949'
            label = 'Tinggi'
          } else if (level_risiko[i] == 'Sangat Tinggi') {
            color = '#f7693e'
            label = 'Sangat Tinggi'
          }

          globalThis.stackedBarChart1.data.datasets[i].data = perAreaDampak[i]
          globalThis.stackedBarChart1.data.datasets[i].backgroundColor = color
          globalThis.stackedBarChart1.data.datasets[i].borderColor = color
          globalThis.stackedBarChart1.data.datasets[i].label = label
        }
        globalThis.stackedBarChart1.update()
    })
}

$(document).ready( () => {
    loadDaftarRisiko()
    loadBarChartLevelRisiko()
    loadBarChartKategoriRisiko()
    loadBarChartDampakRisiko()
})