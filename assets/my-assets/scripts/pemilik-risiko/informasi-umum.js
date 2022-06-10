function loadDataInformasiUmum() {
    $.get('getInformasiUmum/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Nama UPR SPBE</th>
        <th>Tugas UPR SPBE</th>
        <th>Fungsi UPR SPBE</th>
        <th>Periode Waktu</th>
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
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataInformasiUmum()

})