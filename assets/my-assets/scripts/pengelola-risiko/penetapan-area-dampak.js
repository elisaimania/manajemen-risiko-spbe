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
                        <a href="hapusAreaDampakRisikoTerpilih/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                        <a href="detailPersetujuanAreaDampakTerpilih/${d.id}" type="button" class="badge badge-primary">Detail Persetujuan</a>
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
            "buttons": [{
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            }, {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            }, {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            }]
        }).buttons().container().appendTo('#table5_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    
    loadDataPenetapanAreaDampak()
    
})

