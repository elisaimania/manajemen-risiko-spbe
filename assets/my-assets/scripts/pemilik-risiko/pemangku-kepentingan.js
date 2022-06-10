function loadDataPemangkuKepentingan() {
    $.get('getDaftarPemangkuKepentingan/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Nama Unit</th>
        <th>Hubungan</th>
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
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table4_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataPemangkuKepentingan()
    
})