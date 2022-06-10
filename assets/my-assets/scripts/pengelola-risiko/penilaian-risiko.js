function ubahSimbol(simbol){
  switch (simbol) {
              case '&lt;': 
                  return '&gt;';
                  break;
              case '&gt;': 
                  return'&lt;';
                  break;
              case '&le;': 
                  return '&ge;';
                  break;
              case '&ge;': 
                  return '&le;';
                  break;
          }
}

function loadDataPenilaianRisiko() {
    $.get('getPenilaianRisiko', (data) => {
        
        th = ``
        th+= `
                <th>Aksi</th>
                <th>Status Persetujuan</th>
                <th>ID</th>
                <th>Sasaran SPBE</th>
                <th>Indikator Kinerja</th>
                <th>Jenis Risiko SPBE</th>
                <th >Kejadian</th>
                <th >Penyebab</th>
                <th >Kategori</th>
                <th >Dampak</th>
                <th >Area Dampak</th>
                <th >Sistem Pengendalian</th>
                <th >Level Kemungkinan Risiko</th>
                <th >Penjelasan Level Kemungkinan</th>
                <th >Level Dampak Risiko</th>
                <th >Penjelasan Level Dampak</th>
                <th >Besaran Risiko</th>
                <th >Level Risiko</th>
                <th >Keputusan Penanganan Risiko SPBE (Ya/Tidak)</th>
                <th >Prioritas Risiko</th>
        `

        thead = `<thead class="text-center">
        <tr>${th}</tr>
        </thead>`

        cell = ``
        data.forEach(d => {
            d.presentase_kemungkinan = d.presentase_kemungkinan.toLowerCase();
            if (d.presentase_kemungkinan.includes('x')){

                let result = d.presentase_kemungkinan.replace(/<=/g,"&le;").replace(/=</g,"&le;").replace(/≤/g,"&le;")
                .replace(/=>/g,"&ge;").replace(/>=/g,"&ge;").replace(/≥/g,"&ge;").replace(/</g, '&lt;')
                .replace(/>/g, '&gt;').replace(/ /g,'');

                if(result[0] == 'x'){
                    result = result.replace(/x/g,'');
                    d.presentase_kemungkinan = 'Presentase kemungkinan terjadi ' + result;
                } else {
                    simbol1 = result.substr(result.indexOf('x')-4, 4);
                    simbol1 = ubahSimbol(simbol1);
                    result = result.replace(result.substr(result.indexOf('x')-4, 4), ' dan ');
                    result = result.replace(/x/g,'');
                    d.presentase_kemungkinan = 'Presentase Kemungkinan terjadi ' + simbol1 + result ;
                } 
            } else{
                d.presentase_kemungkinan = 'Presentase Kemungkinan terjadi ' + d.presentase_kemungkinan;
            }

            cell+=`
                <tr>
                    <td>
                        <a href="updatePenilaianRisiko/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusPenilaianRisiko/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                        <a href="detailPersetujuanPenilaianRisiko/${d.id}" type="button" class="badge badge-primary">Detail Persetujuan</a>
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="detailRisiko/${d.id}" class="font-weight-bold">${'ID_'+d.id}</a>
                    </td>
                    <td>
                        ${d.sasaran_SPBE}
                    </td>
                    <td>
                        ${d.indikator_kinerja_SPBE}
                    </td>
                    <td>
                        ${d.jenis_risiko}
                    </td>
                    <td>
                        ${d.kejadian}
                    </td>
                    <td>
                        ${d.penyebab.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.dampak}
                    </td>
                    <td>
                        ${d.area_dampak}
                    </td>
                    <td>
                        ${d.sistem_pengendalian.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${d.id_level_kemungkinan }
                    </td>
                    <td>
                        ${d.presentase_kemungkinan}
                    </td>
                    <td>
                        ${d.id_level_dampak }
                    </td>
                    <td>
                        ${d.penjelasan}
                    </td>
                    <td>
                        ${d.besaran_risiko}
                    </td>
                    <td>
                        ${d.level_risiko}
                    </td>
                    <td>
                        ${d.keputusan}
                    </td>
                    <td>
                        ${d.prioritas}
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table13" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-penilaianRisiko').html(table)
        $("#table13").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "dom": 'lBfrtip',
            "buttons": [{
                extend: 'csv',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                }
            },  {
                extend: 'excel',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
                }
            }, {
                extend: 'colvisGroup',
                text: 'Identifikasi Risiko',
                show: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ],
                hide: [ 11, 12, 13, 14, 15, 16, 17, 18, 19 ]
            }, {
                extend: 'colvisGroup',
                text: 'Analisis Risiko',
                show: [ 0, 1, 2, 11, 12, 13, 14, 15, 16, 17 ],
                hide: [ 3, 4, 5, 6, 7, 8, 9, 10, 18, 19 ]
            }, {
                extend: 'colvisGroup',
                text: 'Evaluasi Risiko',
                show: [ 0, 1, 2, 18, 19 ],
                hide: [ 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]
            }, {
                extend: 'colvisGroup',
                text: 'All',
                show: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19 ],
                hide: []
            }],
            "order" :[[2,'DESC']], "pageLength" : 5
        }).buttons().container().appendTo('#table13_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {

    loadDataPenilaianRisiko()
    
    
})