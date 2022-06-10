function loadDataPemantauanRisiko() {
    $.get('getPemantauanRisiko', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>ID Laporan Pemantauan</th>
        <th>ID Risiko</th>
        <th>Kejadian Risiko</th>
        <th>ID Penanganan Risiko</th>
        <th>Opsi Penanganan Risiko</th>
        <th>Jenis Laporan</th>
        <th>Level Kemungkinan Risiko Saat Pemantauan</th>
        <th>Level Dampak Risiko Saat Pemantauan</th>
        <th>Besaran/Level Risiko SPBE Saat ini dan Proyeksi Risiko SPBE</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        console.log(data);
        data.forEach(d => {
            tahun = new Date();
            jenisLaporan = d.jenis_laporan.split(' ');
            if (jenisLaporan[0]=="tahunan") {
                jenis_laporan = "Laporan Pemantauan Risiko SPBE " + d.jenis_laporan ;
            } else  {
                jenis_laporan = "Laporan Pemantauan Risiko SPBE " + d.periode_laporan ;
            } 
            cell+=`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        <a href="detailLaporanPemantauan/${d.id}" class="font-weight-bold" id="id_risiko">${'ID_'+d.id}</a>
                    </td>
                    <td>
                        <a href="detailRisikoPemantauan/${d.id_risiko}" class="font-weight-bold" id="id_risiko">${'ID_'+d.id_risiko}</a>
                    </td>
                    <td>
                        ${d.kejadian}
                    </td>
                    <td>
                        <a href="detailRencanaPenanganan/${d.id_penanganan_risiko}" class="font-weight-bold" id="id_risiko">${'ID_'+d.id_risiko}</a>
                    </td>
                    <td>
                        ${d.opsi_penanganan}
                    </td>
                    <td>
                        ${jenis_laporan}
                    </td>
                    <td>
                        ${d.level_kemungkinan}
                    </td>
                    <td>
                        ${d.level_dampak}
                    </td>
                    <td>
                        ${d.deskripsi_risiko_saat_ini.replace(/\n/g, "<br>")}
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table19" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-pemantauanRisiko').html(table)
        $("#table19").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table19_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    
    loadDataPemantauanRisiko()
    
})
