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
                        <a href="updatePemangkuKepentingan/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusPemangkuKepentingan/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                        <a href="detailPersetujuanPemangkuKepentingan/${d.id}" type="button" class="badge badge-primary">Detail Persetujuan</a>
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
            "buttons": [{
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            }]
        }).buttons().container().appendTo('#table4_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {

    loadDataPemangkuKepentingan()
    
    
})