<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit dan Simpan Data Tabel</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Custom styles for loading spinner and notification */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top-color: #3498db;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .table-input {
            width: 100px;
        }


        .navbar {
            background: rgba(0, 0, 0, 0.8);
            border-bottom: 1px solid #444;
        }

        .navbar-brand,
        .nav-link {
            color: #f0f0f0 !important;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">Unique Die</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../CheckSheet/index.php">Check Sheet</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->


    <div class="container mt-5">
        <h2 class="text-center mb-4">Monitoring Unique Die</h2>
        <div id="tablesContainer" class="row"></div> <!-- Menambahkan class row untuk grid layout -->
        <button id="saveBtn" class="btn btn-primary mt-4 mb-4" onclick="saveAllTables()">Simpan Semua Data</button>
    </div>

    <!-- Tambahkan Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Ambil data dari API get_data.php
        async function fetchData() {
            try {
                Swal.fire({
                    title: 'Mengambil data...',
                    text: 'Harap tunggu sejenak',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                });

                const response = await fetch('get_data.php');
                const data = await response.json();

                const tablesContainer = document.getElementById('tablesContainer');
                tablesContainer.innerHTML = ''; // Kosongkan container sebelum menambah tabel

                data.forEach((item, index) => {
                    const tableHTML = `
                        <div class="col-md-4 mb-4"> <!-- Menggunakan grid Bootstrap, 3 kolom per baris -->
                            <div class="card h-100"> <!-- h-100 untuk membuat tinggi kartu konsisten -->
                                <div class="card-header bg-info text-white">Unique Die N${index + 1}</div>
                                <div class="card-body">
                                    <table class="table table-bordered uniqueTable" data-id="${item.id}">
                                        <tr>
                                            <th>A1N</th>
                                            <td><input type="number" class="form-control table-input" value="${item.A1N}"></td>
                                        </tr>
                                        <tr>
                                            <th>B1N</th>
                                            <td><input type="number" class="form-control table-input" value="${item.B1N}"></td>
                                        </tr>
                                        <tr>
                                            <th>C1N</th>
                                            <td><input type="number" class="form-control table-input" value="${item.C1N}"></td>
                                        </tr>
                                        <tr>
                                            <th>C2N</th>
                                            <td><input type="number" class="form-control table-input" value="${item.C2N}"></td>
                                        </tr>
                                        <tr>
                                            <th>C3N</th>
                                            <td><input type="number" class="form-control table-input" value="${item.C3N}"></td>
                                        </tr>
                                        <tr>
                                            <th>C4N</th>
                                            <td><input type="number" class="form-control table-input" value="${item.C4N}"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;
                    tablesContainer.innerHTML += tableHTML;
                });

                Swal.close();
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengambil data',
                    text: 'Terjadi kesalahan saat mengambil data dari server.',
                });
            }
        }

        // Simpan semua tabel
        async function saveAllTables() {
            try {
                const tables = document.querySelectorAll(".uniqueTable");
                let allSuccess = true;

                Swal.fire({
                    title: 'Menyimpan data...',
                    text: 'Harap tunggu sejenak',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                });

                for (const table of tables) {
                    const id = table.getAttribute('data-id');
                    const rows = table.rows;

                    // Ambil nilai dari setiap baris
                    const updatedData = {
                        id: id,
                        A1N: rows[0].cells[1].querySelector("input").value,
                        B1N: rows[1].cells[1].querySelector("input").value,
                        C1N: rows[2].cells[1].querySelector("input").value,
                        C2N: rows[3].cells[1].querySelector("input").value,
                        C3N: rows[4].cells[1].querySelector("input").value,
                        C4N: rows[5].cells[1].querySelector("input").value
                    };

                    // Kirim data ke server untuk disimpan
                    const response = await fetch('update_data.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(updatedData)
                    });

                    const result = await response.json();
                    if (result.status !== "success") {
                        allSuccess = false;
                    }
                }

                if (allSuccess) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Semua data berhasil disimpan!',
                        text: 'Anda akan diarahkan ke halaman utama.',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '../index.html'; // Redirect ke halaman index setelah beberapa detik
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Terjadi kesalahan!',
                        text: 'Terjadi kesalahan pada beberapa data.',
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan!',
                    text: 'Terjadi kesalahan saat menyimpan data.',
                });
            }
        }

        // Panggil fetchData saat halaman pertama kali dibuka
        fetchData();
    </script>
</body>

</html>