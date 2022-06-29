function loadDataDampak() {
    $.get('getDaftarDampak/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Area Dampak Risiko SPBE</th>
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
                        <a href="updateAreaDampak/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusAreaDampak/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table1" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-dampak').html(table)
        $("#table1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
    })
}

function loadDataKategori() {
    $.get('getDaftarKategori/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Kategori Risiko SPBE</th>
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
                        <a href="updateKategoriRisiko/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusKategoriRisiko/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table2" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-kategori').html(table)
        $("#table2").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
    })
}


function loadDataOpsiPenanganan() {
    $.get('getDaftarPenanganan/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Opsi Penanganan Risiko SPBE</th>
        <th>Jenis Risiko SPBE</th>
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
                        ${d.opsi_penanganan}
                    </td>
                    <td>
                        ${d.jenis_risiko}
                    </td>
                    <td>
                        <a href="updateOpsiPenanganan/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusOpsiPenanganan/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table3" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-penanganan').html(table)
        $("#table3").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table3_wrapper .col-md-6:eq(0)');
    })
}

function loadDataPengguna() {
    $.get('getDaftarPengguna/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Email</th>
        <th>NIP</th>
        <th>Password</th>
        <th>Role</th>
        <th>UPR</th>
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
                        ${d.nama_pengguna}
                    </td>
                    <td>
                        ${d.username}
                    </td>
                    <td>
                        ${d.email}
                    </td>
                    <td>
                        ${d.nip}
                    </td>
                    <td>
                        ${d.password}
                    </td>
                    <td>
                        ${d.nama_role}
                    </td>
                    <td>
                        ${d.upr_SPBE}
                    </td>
                    <td>
                        <a href="updateDataPengguna/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusDataPengguna/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table4" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-pengguna').html(table)
        $("#table4").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table4_wrapper .col-md-6:eq(0)');
    })
}

function loadDataUPR() {
    $.get('getDaftarUPR/', (data) => {
        
        th = ``
        th+= `
        <th>No</th>
        <th>Unit Pemilik Risiko (UPR) SPBE</th>
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
                        ${d.upr_SPBE}
                    </td>
                    <td>
                        <a href="updateUPR/${d.id}" type="button" class="badge badge-success" style="color: #fff; background-color:#8CBA08; border:none">Edit</a>
                        <a href="hapusUPR/${d.id}" type="button" class="badge badge-danger" style="border:none" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            `
        });
        tbody = `<tbody>${cell}</tbody>`
        table = `<table id="table5" class="table table-bordered">
        ${thead}
        ${tbody}
        </table>`

        $('#tabel-upr').html(table)
        $("#table5").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf"]
        }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
    })
}

$(document).ready( () => {
    loadDataDampak()
    loadDataKategori()
    loadDataOpsiPenanganan()
    loadDataPengguna()
    loadDataUPR()
})
