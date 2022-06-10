function loadDataPilihRisiko() {
    $.get('getRisikoByKeputusan', (data) => {
        
        th = ``
        th+= `
                <th >No</th>
                <th >Aksi</th>
                <th >ID</th>
                <th >Kategori</th>
                <th >Dampak</th>
                <th >Area Dampak</th>
                <th >Prioritas Risiko</th>
        `

        thead = `<thead>
        <tr>${th}</tr>
        </thead>`

        cell = ``
        no = 1
        data.forEach(d => {

            cell+=`
                <tr class="text-wrap">
                    <td>
                        ${no++}
                    </td>
                    <td>
                        <a href="inputPenangananRisiko/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Pilih</a>
                    </td>
                    <td>
                        <a href="detailRisiko/${d.id}" class="font-weight-bold">${'ID_'+d.id}</a>
                    </td>
                    <td>
                        ${d.kategori_risiko}
                    </td>
                    <td>
                        ${d.dampak}
                    </td>
                     <td>
                        ${d.area_dampak}
                    </td>
                    <td>
                        ${d.prioritas}
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table18" class="table table-bordered" style="width:100%;">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-pilihRisiko').html(table)
        $("#table18").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false
        });
    })
}

$(document).ready( () => {
    
    loadDataPilihRisiko()
    
    
})