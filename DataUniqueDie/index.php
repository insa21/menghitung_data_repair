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
    .navbar {
      background: rgba(0, 0, 0, 0.8);
      border-bottom: 1px solid #444;
    }

    .navbar-brand,
    .nav-link {
      color: #f0f0f0 !important;
    }

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
    <h2 class="text-center mb-4">Data Unique Die</h2>
    <div id="tablesContainer" class="row"></div> <!-- Menambahkan class row untuk grid layout -->
    <!-- <button id="saveBtn" class="btn btn-primary mt-4 mb-4" onclick="saveAllTables()">Simpan Semua Data</button> -->
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

        // Step 1: Group data by unique_die
        const groupedData = data.reduce((acc, curr) => {
          if (!acc[curr.unique_die]) {
            acc[curr.unique_die] = [];
          }
          acc[curr.unique_die].push(curr);
          return acc;
        }, {});

        const sortedUniqueDies = Object.keys(groupedData).sort((a, b) => {
          const numA = parseInt(a.replace('UDN', ''));
          const numB = parseInt(b.replace('UDN', ''));
          return numA - numB;
        });

        // Step 2: Create HTML for each group
        sortedUniqueDies.forEach((uniqueDie, index) => {
          const group = groupedData[uniqueDie];
          let tableRows = '';
          let hasNonZero = false;

          // Check if there is any non-zero total_shot
          group.forEach(item => {
            if (item.total_shot > 0) {
              hasNonZero = true;
            }
          });

          // Sort the data within the group by the key names
          group.sort((a, b) => {
            const order = ['A1N', 'B1N', 'C1N', 'C2N', 'C3N', 'C4N'];
            return order.indexOf(a.value_die) - order.indexOf(b.value_die);
          }).forEach(item => {
            if (item.total_shot > 0 || !hasNonZero) { // Tambahkan pengecekan di sini
              tableRows += `
                <tr>
                  <td><input type="text" class="form-control table-input" value="${item.value_die}" readonly></td>
                  <td><input type="number" class="form-control table-input" value="${item.total_shot}" readonly></td>
                </tr>
              `;
            }
          });

          if (tableRows) {
            const tableHTML = `
              <div class="col-md-4 mb-4"> <!-- Menggunakan grid Bootstrap, 3 kolom per baris -->
                <div class="card h-100"> <!-- h-100 untuk membuat tinggi kartu konsisten -->
                  <div class="card-header bg-info text-white">Unique Die: ${uniqueDie}</div>
                  <div class="card-body">
                    <table class="table table-bordered uniqueTable">
                      <thead>
                        <tr>
                          <th>Value Die</th>
                          <th>Total Shot</th>
                        </tr>
                      </thead>
                      <tbody>
                        ${tableRows}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            `;

            tablesContainer.innerHTML += tableHTML;
          }
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
          const rows = table.querySelectorAll('tbody tr');
          const uniqueDie = table.previousElementSibling.querySelector('.card-header').textContent.replace('Unique Die: ', '');

          for (const row of rows) {
            const updatedData = {
              unique_die: uniqueDie,
              value_die: row.cells[0].querySelector("input").value,
              total_shot: row.cells[1].querySelector("input").value
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