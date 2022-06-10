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
                        <a href="updateStrukturPelaksana/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusStrukturPelaksana/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                        <a href="detailPersetujuanStrukturPelaksana/${d.id}" type="button" class="badge badge-primary">Detail Persetujuan</a>
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
        }).buttons().container().appendTo('#table12_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    
    loadDataStrukturPelaksana()
   
    
})