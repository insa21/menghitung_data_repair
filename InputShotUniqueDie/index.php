<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>DIE CASTING</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      margin-bottom: 30px;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.8);
      border-bottom: 1px solid #444;
    }

    .navbar-brand,
    .nav-link {
      color: #f0f0f0 !important;
    }


    .form-wrap {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .form-label {
      font-weight: bold;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .container {
      max-width: 800px;
    }
  </style>
</head>

<body>
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

  <!-- Form Layout -->
  <div class="container mt-5">
    <div class="form-wrap">
      <h3 class="mb-4">Input Shot Unique Die</h3>
      <form action="submit_data.php" method="post">
        <!-- Text Inputs -->
        <div class="mb-3">
          <label for="shift" class="form-label">Shift:</label>
          <input type="text" id="shift" name="shift" class="form-control" placeholder="Shift (e.g., Red)">
        </div>

        <div class="mb-3">
          <label for="mesin_dc" class="form-label">Mesin DC:</label>
          <input type="text" id="mesin_dc" name="mesin_dc" class="form-control" placeholder="Mesin DC (e.g., 1)">
        </div>

        <div class="mb-3">
          <label for="general_die" class="form-label">General Die:</label>
          <input type="text" id="general_die" name="general_die" class="form-control" placeholder="General Die (e.g., 1)">
        </div>

        <!-- Date Input -->
        <div class="mb-3">
          <label for="tanggal" class="form-label">Pilih Tanggal:</label>
          <input type="date" id="tanggal" name="tanggal" class="form-control">
        </div>

        <!-- Unique Die Dropdown -->
        <div class="mb-3">
          <label for="unique_die" class="form-label">Unique Die N:</label>
          <select id="unique_die" name="unique_die" class="form-select">
            <option value="UDN1">Unique Die N1</option>
            <option value="UDN2">Unique Die N2</option>
            <option value="UDN3">Unique Die N3</option>
            <option value="UDN4">Unique Die N4</option>
            <option value="UDN5">Unique Die N5</option>
            <option value="UDN6">Unique Die N6</option>
            <option value="UDN7">Unique Die N7</option>
            <option value="UDN8">Unique Die N8</option>
            <option value="UDN9">Unique Die N9</option>
            <option value="UDN10">Unique Die N10</option>
            <option value="UDNH1">Unique Die NH1</option>
            <option value="UDNH2">Unique Die NH2</option>
            <option value="UDNH3">Unique Die NH3</option>
          </select>
        </div>

        <!-- Value Selection Dropdown -->
        <!-- <div class="mb-3">
          <label for="value_die" class="form-label">Select Die Value:</label>
          <select id="value_die" name="value_die" class="form-select">
            <option value="A1N">A1N</option>
            <option value="B1N">B1N</option>
            <option value="C1N">C1N</option>
            <option value="C2N">C2N</option>
            <option value="C3N">C3N</option>
            <option value="C4N">C4N</option>
          </select>
        </div> -->


        <!-- Number Input -->
        <div class="mb-3">
          <label for="total_shot" class="form-label">Total Shot:</label>
          <input type="number" id="total_shot" name="total_shot" class="form-control" placeholder="Masukkan angka">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Kirim</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>