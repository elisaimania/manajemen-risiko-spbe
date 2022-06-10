function loadDataStrukturPelaksana() {
    $.get('getDaftarStrukturPelaksana/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Role</th>
        <th>Pelaksana</th>
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
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table12_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataStrukturPelaksana()
    
    
})