function loadDataInformasiUmum() {
    $.get('getInformasiUmum/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Nama UPR SPBE</th>
        <th>Tugas UPR SPBE</th>
        <th>Fungsi UPR SPBE</th>
        <th>Periode Waktu</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${d.upr_SPBE}
                    </td>
                    <td>
                        ${d.tugas_UPR.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${d.fungsi_UPR.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${new Date(d.tanggal_mulai).getDate().toString() + ' ' + new Date(d.tanggal_mulai).toLocaleString('id-ID', { month: 'long' }) 
                        + ' ' + new Date(d.tanggal_mulai).getFullYear().toString() + ' - ' + new Date(d.tanggal_selesai).getDate().toString() + ' '
                        + new Date(d.tanggal_selesai).toLocaleString('id-ID', { month: 'long' }) + ' ' + new Date(d.tanggal_selesai).getFullYear().toString()}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanInformasiUmum/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table1" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-informasiUmum').html(table)
        $("#table1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
    })
}

function insertInto(specialChar,id) {
    const textarea = document.getElementById(id);
    const insertStartPoint = textarea.selectionStart;
    const insertEndPoint = textarea.selectionEnd;
    let value = textarea.value;
 
    // text before cursor/highlighted text + special character + text after cursor/highlighted text
    value = value.slice(0, insertStartPoint) + specialChar + value.slice(insertEndPoint);
    textarea.value = value;
}

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
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
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
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table3_wrapper .col-md-6:eq(0)');
    })

}

function loadDataPemangkuKepentingan() {
    $.get('getDaftarPemangkuKepentingan/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Nama Unit</th>
        <th>Hubungan</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${d.nama_unit}
                    </td>
                    <td>
                        ${d.hubungan.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanPemangkuKepentingan/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table4" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-pemangkuKepentingan').html(table)
        $("#table4").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table4_wrapper .col-md-6:eq(0)');
    })
}

function loadDataPenetapanAreaDampak() {
    $.get('getDaftarAreaDampakRisikoTerpilih/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Area Dampak Risiko SPBE</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${d.area_dampak}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanareaDampakTerpilih/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table5" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-areaDampakTerpilih').html(table)
        $("#table5").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table5_wrapper .col-md-6:eq(0)');
    })
}

function loadDataPenetapanKategori() {
    $.get('getDaftarKategoriRisikoTerpilih/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Kategori Risiko SPBE</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanKategoriRisikoTerpilih/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table6" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-kategoriTerpilih').html(table)
        $("#table6").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table6_wrapper .col-md-6:eq(0)');
    })
}

function loadDataKriteriaKemungkinan() {
    $.get('getDaftarKriteriaKemungkinan/', (data) => {
        
        th = ``
        th+= `
        <th>Kategori Risiko SPBE</th>
        <th>Level Kemungkinan</th>
        <th>Presentase Kemungkinan</th>
        <th>Jumlah Frekuensi Kemungkinan Terjadinya dalam Satu Tahun</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.level_kemungkinan}
                    </td>
                    <td>
                        ${d.presentase_kemungkinan}
                    </td>
                    <td>
                        ${d.jumlah_frekuensi}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                     <td>
                        <a href="beriPersetujuanKriteriaKemungkinan/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                    
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table7" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-kriteriaKemungkinan').html(table)
        $("#table7").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"],
            "rowsGroup": [0,1]
        }).buttons().container().appendTo('#table7_wrapper .col-md-6:eq(0)');
    })
}

function loadDataKriteriaDampak() {
    $.get('getDaftarKriteriaDampak/', (data) => {
        
        th = ``
        th+= `
        <th>Area Dampak Risiko SPBE</th>
        <th>Jenis Risiko</th>
        <th>Level Dampak</th>
        <th>Penjelasan</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${d.area_dampak}
                    </td>
                    <td>
                        ${d.jenis_risiko}
                    </td>
                    <td>
                        ${d.level_dampak}
                    </td>
                    <td>
                        ${d.penjelasan}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanKriteriaDampak/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table8" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-kriteriaDampak').html(table)
        $("#table8").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"],
            "rowsGroup": [0,1]
        }).buttons().container().appendTo('#table8_wrapper .col-md-6:eq(0)');
    })
}

function loadDataPerundangan() {
    $.get('getDaftarPeraturanPerundangan/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Nama Peraturan</th>
        <th>Amanat</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${d.nama_peraturan}
                    </td>
                    <td>
                        ${d.amanat.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanPeraturanPerundangan/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table9" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-peraturanPerundangan').html(table)
        $("#table9").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table9_wrapper .col-md-6:eq(0)');
    })
}

function loadDataSasaranSPBE() {
    $.get('getDaftarSasaranSPBE/', (data) => {
        
        th = ``
        th+= `
        <th>Sasaran UPR SPBE</th>
        <th>Sasaran SPBE</th>
        <th>Indikator Kinerja SPBE</th>
        <th>Target Kinerja SPBE</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${d.sasaran_UPR_SPBE}
                    </td>
                    <td>
                        ${d.sasaran_SPBE}
                    </td>
                    <td>
                        ${d.indikator_kinerja_SPBE}
                    </td>
                    <td>
                        ${d.target_kinerja}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanSasaranSpbe/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table10" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-sasaranSPBE').html(table)
        $("#table10").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"],
            "rowsGroup" : [0,1]
        }).buttons().container().appendTo('#table10_wrapper .col-md-6:eq(0)');
    })
}

function loadDataSeleraRisiko() {
    $.get('getSeleraRisiko', (data) => {
        
        th = ``
        th+= `
        <th>Kategori Risiko SPBE</th>
        <th>Jenis Risiko</th>
        <th>Besaran Risiko Minimun yang Ditangani</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.jenis_risiko}
                    </td>
                    <td>
                        ${d.besaran_risiko_min}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanSeleraRisiko/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>

                </tr>
            `
        })
   
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table11" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-seleraRisiko').html(table)
        $("#table11").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"],
            "rowsGroup": [0]
        }).buttons().container().appendTo('#table11_wrapper .col-md-6:eq(0)');
    })
}

function loadDataStrukturPelaksana() {
    $.get('getDaftarStrukturPelaksana/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Role</th>
        <th>Pelaksana</th>
        <th>Status Persetujuan</th>
        <th>Aksi</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${d.nama_role}
                    </td>
                    <td>
                        ${d.pelaksana}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="beriPersetujuanStrukturPelaksana/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table12" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-strukturPelaksana').html(table)
        $("#table12").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table12_wrapper .col-md-6:eq(0)');
    })
}


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

function loadDataIdentifikasiRisiko() {
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
        `

        thead = `<thead class="text-center">
        <tr>${th}</tr>
        </thead>`

        cell = ``
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        <a href="beriPersetujuanPenilaianRisiko/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
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
                        ${d.penyebab}
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
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table13" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-identifikasiRisiko').html(table)
        $("#table13").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"],
            "rowsGroup": [2,3]
        }).buttons().container().appendTo('#table13_wrapper .col-md-6:eq(0)');
    })
}


function loadDataAnalisisRisiko() {
    $.get('getPenilaianRisiko', (data) => {
        
        th = ``
        th+= `
                <th >No</th>
                <th >ID</th>
                <th >Sistem Pengendalian</th>
                <th >Level Kemungkinan Risiko</th>
                <th >Penjelasan Level Kemungkinan</th>
                <th >Level Dampak Risiko</th>
                <th >Penjelasan Level Dampak</th>
                <th >Besaran Risiko</th>
                <th >Level Risiko</th>
        `



        thead = `<thead class="text-center">
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
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
                        ${no++}
                    </td>
                    <td>
                        <a href="detailRisiko/${d.id}" class="font-weight-bold">${'ID_'+d.id}</a>
                    </td>
                     <td>
                        ${d.sistem_pengendalian}
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
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table15" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-analisisRisiko').html(table)
        $("#table15").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table15_wrapper .col-md-6:eq(0)');
    })
}


function loadDataEvaluasiRisiko() {
    $.get('getPenilaianRisiko', (data) => {
        
        th = ``
        th+= `
                <th >No</th>
                <th >ID</th>
                <th >Keputusan Penanganan Risiko SPBE (Ya/Tidak)</th>
                <th >Prioritas Risiko</th>
        `

        thead = `<thead class="text-center">
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {

            cell+=`
                <tr class="text-wrap">
                    <td>
                        ${no++}
                    </td>
                    <td>
                        <a href="detailRisiko/${d.id}" class="font-weight-bold">${'ID_'+d.id}</a>
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
        table = `<table id="table16" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-evaluasiRisiko').html(table)
        $("#table16").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table16_wrapper .col-md-6:eq(0)');
    })
}


function loadDataPenangananRisiko() {
    $.get('getPenangananRisiko', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Aksi</th>
        <th>ID Risiko</th>
        <th>Opsi Penanganan Risiko SPBE</th>
        <th>Rencana Aksi Penanganan Risiko SPBE</th>
        <th>Keluaran</th>
        <th>Jadwal Implementasi</th>
        <th>Penanggungjawab</th>
        <th>Apakah Terdapat Risiko Residual? (Ya/Tidak)</th>
        <th>Status Persetujuan</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        <a href="beriPersetujuanPenangananRisiko/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                    <td>
                        <a href="detailRisikoPenanganan/${d.id_risiko}" class="font-weight-bold" id="id_risiko">${'ID_'+d.id_risiko}</a>
                    </td>
                    <td>
                        ${d.opsi_penanganan}
                    </td>
                    <td>
                        ${d.rencana_aksi.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${d.keluaran.replace(/\n/g, "<br>")}
                    </td>
                    <td>
                        ${new Date(d.jadwal_mulai).getDate().toString() + ' ' + new Date(d.jadwal_mulai).toLocaleString('id-ID', { month: 'long' }) 
                        + ' ' + new Date(d.jadwal_mulai).getFullYear().toString() + ' - ' + new Date(d.jadwal_selesai).getDate().toString() + ' '
                        + new Date(d.jadwal_selesai).toLocaleString('id-ID', { month: 'long' }) + ' ' + new Date(d.jadwal_selesai).getFullYear().toString()}
                    </td>
                    <td>
                        ${d.penanggungjawab}
                    </td>
                    <td>
                        ${d.risiko_residual}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table17" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-penangananRisiko').html(table)
        $("#table17").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table17_wrapper .col-md-6:eq(0)');
    })
}


$(document).ready( () => {
    loadDataInformasiUmum()
    loadDataLevelRisiko()
    loadDataMatriks()
    loadDataPemangkuKepentingan()
    loadDataPenetapanAreaDampak()
    loadDataPenetapanKategori()
    loadDataKriteriaKemungkinan()
    loadDataKriteriaDampak()
    loadDataPerundangan()
    loadDataSasaranSPBE()
    loadDataSeleraRisiko()
    loadDataStrukturPelaksana()
    loadDataIdentifikasiRisiko()
    loadDataAnalisisRisiko()
    loadDataEvaluasiRisiko()
    loadDataPenangananRisiko()

    
})

