function loadDataSeleraRisiko() {
    $.get('getSeleraRisiko', (data) => {
        
        th = ``
        th+= `
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
            "buttons": ["csv", "excel", "pdf"],
            "rowsGroup": [0]
        }).buttons().container().appendTo('#table11_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataSeleraRisiko()
    
})