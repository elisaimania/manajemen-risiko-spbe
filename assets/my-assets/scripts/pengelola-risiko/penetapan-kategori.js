function loadDataPenetapanKategori() {
    $.get('getDaftarKategoriRisikoTerpilih/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Kategori Risiko SPBE</th>
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
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        <a href="hapusKategoriRisikoTerpilih/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                        <a href="detailPersetujuanKategoriRisikoTerpilih/${d.id}" type="button" class="badge badge-primary">Detail Persetujuan</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table6" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-kategoriTerpilih').html(table)
        $("#table6").DataTable({
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
                    columns: [ 0, 1, 2 ]
                }
            }]
        }).buttons().container().appendTo('#table6_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    
    loadDataPenetapanKategori()
    
    
})