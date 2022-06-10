function loadDataPerundangan() {
    $.get('getDaftarPeraturanPerundangan/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Nama Peraturan</th>
        <th>Amanat</th>
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
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table9_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataPerundangan()
    
})