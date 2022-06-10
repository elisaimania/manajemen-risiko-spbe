function loadDataKriteriaKemungkinan() {
    $.get('getDaftarKriteriaKemungkinan/', (data) => {
        
        th = ``
        th+= `
        <th>Kategori Risiko SPBE</th>
        <th>Level Kemungkinan</th>
        <th>Presentase Kemungkinan</th>
        <th>Jumlah Frekuensi Kemungkinan Terjadinya dalam Satu Tahun</th>
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
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.level_kemungkinan}
                    </td>
                    <td>
                        ${d.presentase_kemungkinan}
                    </td>
                    <td>
                        ${d.jumlah_frekuensi}
                    </td>
                    
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table7" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-kriteriaKemungkinan').html(table)
        $("#table7").DataTable({
            "responsive": false, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"],
            "rowsGroup": [0]
        }).buttons().container().appendTo('#table7_wrapper .col-md-6:eq(0)');
    })
}

function loadDataKriteriaDampak() {
    $.get('getDaftarKriteriaDampak/', (data) => {
        
        th = ``
        th+= `
        <th>Area Dampak Risiko SPBE</th>
        <th>Jenis Risiko</th>
        <th>Level Dampak</th>
        <th>Penjelasan</th>
        `
        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        data.forEach(d => {
            cell+=`
                <tr>
                    <td>
                        ${d.area_dampak}
                    </td>
                    <td>
                        ${d.jenis_risiko}
                    </td>
                    <td>
                        ${d.level_dampak}
                    </td>
                    <td>
                        ${d.penjelasan}
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table8" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-kriteriaDampak').html(table)
        $("#table8").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"],
            "rowsGroup": [0,1]
        }).buttons().container().appendTo('#table8_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataKriteriaKemungkinan()
    loadDataKriteriaDampak()
    
})
