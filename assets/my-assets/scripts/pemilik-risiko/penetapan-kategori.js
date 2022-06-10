function loadDataPenetapanKategori() {
    $.get('getDaftarKategoriRisikoTerpilih/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Kategori Risiko SPBE</th>
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
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table6_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataPenetapanKategori()

})