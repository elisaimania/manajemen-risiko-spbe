function loadDataSasaranSPBE() {
    $.get('getDaftarSasaranSPBE/', (data) => {
        
        th = ``
        th+= `
        <th>Sasaran UPR SPBE</th>
        <th>Sasaran SPBE</th>
        <th>Indikator Kinerja SPBE</th>
        <th>Target Kinerja SPBE</th>
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
                        ${d.sasaran_UPR_SPBE}
                    </td>
                    <td>
                        ${d.sasaran_SPBE}
                    </td>
                    <td>
                        ${d.indikator_kinerja_SPBE}
                    </td>
                    <td>
                        ${d.target_kinerja}
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table10" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-sasaranSPBE').html(table)
        $("#table10").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"],
            "rowsGroup" : [0,1]
        }).buttons().container().appendTo('#table10_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataSasaranSPBE()
    
})