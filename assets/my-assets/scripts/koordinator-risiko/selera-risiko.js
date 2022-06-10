function loadDataSeleraRisiko() {
    $.get('getSeleraRisiko', (data) => {
        
        th = ``
        th+= `
        <th>Aksi</th>
        <th>Status Persetujuan</th>
        <th>Kategori Risiko SPBE</th>
        <th>Jenis Risiko</th>
        <th>Besaran Risiko Minimun yang Ditangani</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        <a href="beriPersetujuanSeleraRisiko/${d.id_kategori_risiko}/${d.tag}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Beri Persetujuan</a>
                    </td>
                    <td>
                        ${d.status}
                    </td>
                    <td>
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.jenis_risiko}
                    </td>
                    <td>
                        ${d.besaran_risiko_min}
                    </td>
                </tr>
            `
        })
   
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table11" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-seleraRisiko').html(table)
        $("#table11").DataTable({
            "responsive": false, "lengthChange": false, "autoWidth": false,
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
            }],
            "rowsGroup": [0,1,2]
        }).buttons().container().appendTo('#table11_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    
    loadDataSeleraRisiko()
    
})