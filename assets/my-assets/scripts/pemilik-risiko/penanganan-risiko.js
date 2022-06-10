function loadDataPenangananRisiko() {
    $.get('getPenangananRisiko', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>ID Risiko</th>
        <th>Opsi Penanganan Risiko SPBE</th>
        <th>Rencana Aksi Penanganan Risiko SPBE</th>
        <th>Keluaran</th>
        <th>Jadwal Implementasi</th>
        <th>Penanggungjawab</th>
        <th>Apakah Terdapat Risiko Residual? (Ya/Tidak)</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {
            if (d.periode_implementasi=="Tanggal") {
                jadwal = new Date(d.tanggal_mulai).getDate().toString() + ' ' + new Date(d.tanggal_mulai).toLocaleString('id-ID', { month: 'long' }) 
                        + ' ' + new Date(d.tanggal_mulai).getFullYear().toString() + ' - ' + new Date(d.tanggal_selesai).getDate().toString() + ' '
                        + new Date(d.tanggal_selesai).toLocaleString('id-ID', { month: 'long' }) + ' ' + new Date(d.tanggal_selesai).getFullYear().toString();
            } else {
                jadwal = d.periode_implementasi;
            }
            cell+=`
                <tr>
                    <td>
                        ${no++}
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
                        ${jadwal}
                    </td>
                    <td>
                        ${d.penanggungjawab}
                    </td>
                    <td>
                        ${d.risiko_residual}
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
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table17_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataPenangananRisiko()

    
})
