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
            "buttons": [{
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }]
        }).buttons().container().appendTo('#table9_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    
    loadDataPerundangan()
    

    
})

