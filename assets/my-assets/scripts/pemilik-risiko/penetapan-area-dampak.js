function loadDataPenetapanAreaDampak() {
    $.get('getDaftarAreaDampakRisikoTerpilih/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Area Dampak Risiko SPBE</th>
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
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table5_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    
    loadDataPenetapanAreaDampak()
    
})
