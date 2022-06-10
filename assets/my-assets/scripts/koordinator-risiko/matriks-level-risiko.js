function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function loadDataMatriks() {
    $.get('getMatriksRisiko' , (data) => {
        level_dampak = []
        id_level_dampak =[]
        level_kemungkinan = []
        id_level_kemungkinan = []
        besaran_risiko = []
        data.forEach(d => {
            level_dampak.push(d.level_dampak)
            level_kemungkinan.push(d.level_kemungkinan)
            id_level_dampak.push(d.id_level_dampak)
            id_level_kemungkinan.push(d.id_level_kemungkinan)
            besaran_risiko.push(d.besaran_risiko)

        });
        unique_dampak = (level_dampak.filter(onlyUnique))
        unique_kemungkinan = (level_kemungkinan.filter(onlyUnique))
        unique_id_dampak = (id_level_dampak.filter(onlyUnique))
        unique_id_kemungkinan = (id_level_kemungkinan.filter(onlyUnique))

        tr1= ``
        for (var i = 0; i < unique_dampak.length ; i++) {
            tr1+= `<th>${unique_dampak[i]}</th>`
        }

        
        th = `<th>Matriks Analisis Risiko 5 x 5 </th>`

        thead = `<thead>
        <tr>${th}${tr1}</tr>
        </thead>`

        cell = ``

        k = 0
        for (var i = 0; i < unique_id_kemungkinan.length ; i++){
            
            k += 5
            td =``
            for (var j = k-5; j < k; j++){

                if (besaran_risiko[j] >= 1 && besaran_risiko[j] <= 5 ) {
                    style = '"background-color:#039dfc;"'
                } else if (besaran_risiko[j] >= 6 && besaran_risiko[j] <= 10) {
                    style = '"background-color:#7ec96f;"'
                } else if (besaran_risiko[j] >= 11 && besaran_risiko[j] <= 15) {
                    style = '"background-color:#ecf547;"'
                } else if (besaran_risiko[j] >= 16 && besaran_risiko[j] <= 20) {
                    style = '"background-color:#fca949;"'
                } else if (besaran_risiko[j] >= 20 && besaran_risiko[j] <= 25) {
                    style = '"background-color:#f7693e;"'
                }


                td += `<td style=${style}>${besaran_risiko[j]}</td>`
            }
            
            cell += `<tr>
                        <th>${unique_kemungkinan[i]}</th>
                        ${td}
                    </tr>`
        }

        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table2" class="table table-bordered text-center">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-matriksRisiko').html(table)
        $("#table2").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
        

    })

}

function loadDataLevelRisiko() {
    $.get('getLevelRisiko', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Level Risiko</th>
        <th>Rentang</th>
        <th>Keterangan Warna</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            switch (d.ket_warna) {
              case 'Biru':
                  style = '"background-color:#039dfc;"'
                  break;
              case 'Hijau':
                  style = '"background-color:#7ec96f;"'
                  break;
              case 'Kuning':
                  style = '"background-color:#ecf547;"'
                  break;
              case 'Jingga':
                  style = '"background-color:#fca949;"'
                  break;
              case 'Merah':
                  style = '"background-color:#f7693e;"'
                  break;
              default:
                  break;
          }
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${d.level_risiko}
                    </td>
                    <td>
                        ${d.rentang_min + ' - ' + d.rentang_maks}
                    </td>
                    <td style=${style}>
                        ${d.ket_warna} 
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table3" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-levelRisiko').html(table)
        $("#table3").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table3_wrapper .col-md-6:eq(0)');
    })

}

$(document).ready( () => {
    loadDataLevelRisiko()
    loadDataMatriks()
    

    
})