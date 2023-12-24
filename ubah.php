<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}
require 'function.php';
$id_peserta = $_GET['id_peserta'];
$peserta = query("SELECT * FROM peserta WHERE id_peserta = $id_peserta")[0];
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data peserta berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data peserta gagal diubah!');
            </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <link rel="stylesheet" href="css/style.css">

     <title>Update Data</title>
</head>

<body background="img/bg/bck.jpg">
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
          <div class="container">
               <a class="navbar-brand" href="index.php">Sistem Admin Platform Course</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="index.php">Home</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="#about">About</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="logout.php">Logout</a>
                         </li>
                    </ul>
               </div>
          </div>
     </nav>
     <div class="container">
          <div class="row my-2 text-light">
               <div class="col-md">
                    <h3 class="fw-bold text-uppercase ubah_data"></h3>
               </div>
               <hr>
          </div>
          <div class="row my-2 text-light">
               <div class="col-md">
                    <form action="" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="gambarLama" value="<?= $peserta['gambar']; ?>">
                         <div class="mb-3">
                              <label for="id_peserta" class="form-label">ID Peserta</label>
                              <input type="number" class="form-control w-50" id="id_peserta" value="<?= $peserta['id_peserta']; ?>"
                                   name="id_peserta" readonly>
                         </div>
                         <div class="mb-3">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" class="form-control w-50" id="nama" value="<?= $peserta['nama']; ?>"
                                   name="nama" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tmpt_Lahir" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control w-50" id="tmpt_Lahir"
                                   value="<?= $peserta['tmpt_Lahir']; ?>" name="tmpt_Lahir" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tgl_Lahir" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control w-50" id="tgl_Lahir"
                                   value="<?= $peserta['tgl_Lahir']; ?>" name="tgl_Lahir" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label>Jenis Kelamin</label>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Laki - Laki"
                                        value="Laki - Laki" <?php if ($peserta['jekel'] == 'Laki - Laki') { ?> checked=''
                                        <?php } ?>>
                                   <label class="form-check-label" for="Laki - Laki">Laki - Laki</label>
                              </div>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Perempuan"
                                        value="Perempuan" <?php if ($peserta['jekel'] == 'Perempuan') { ?> checked=''
                                        <?php } ?>>
                                   <label class="form-check-label" for="Perempuan">Perempuan</label>
                              </div>
                         </div>
                         <div class="mb-3">
                              <label for="program" class="form-label">Program</label>
                              <select class="form-select w-50" id="program" name="program">
                                   'Data analyst','UX/IX','Front and','Back and','Full stack'
                                   <option disabled selected value>--------------------------------------------Pilih
                                        program--------------------------------------------</option>
                                   <option value="Data analyst" <?php if ($peserta['program'] == 'Data analyst') { ?>
                                        selected='' <?php } ?>>Data analyst</option>
                                   <option value="UX/IX"
                                        <?php if ($peserta['program'] == 'UX/IX') { ?> selected=''
                                        <?php } ?>>UX/IX</option>
                                   <option value="Front and" <?php if ($peserta['program'] == 'Front and') { ?>
                                        selected='' <?php } ?>>Front and</option>
                                   <option value="Back and"
                                        <?php if ($peserta['program'] == 'Back and') { ?> selected=''
                                        <?php } ?>>Back and</option>
                                   <option value="Full stack" <?php if ($peserta['program'] == 'Full stack') { ?>
                                        selected='' <?php } ?>>Full stack</option>
                                   
                              </select>
                         </div>
                         <div class="mb-3">
                              <label for="email" class="form-label">E-Mail</label>
                              <input type="email" class="form-control w-50" id="email" value="<?= $peserta['email']; ?>"
                                   name="email" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <textarea class="form-control w-50" id="alamat" rows="5" name="alamat"
                                   autocomplete="off"><?= $peserta['alamat']; ?></textarea>
                         </div>
                         <hr>
                         <a href="index.php" class="btn btn-secondary">Kembali</a>
                         <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                    </form>
               </div>
          </div>
     </div>
     <div class="container-fluid">
          <div class="row bg-dark text-white text-center">
               <div class="col my-2" id="about">
                    <br><br><br>
                    <h4 class="fw-bold text-uppercase">About</h4>

                    <p>
                         by:Lalu hirzani
                         
                    </p>
               </div>
          </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"> </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
     <script>
     gsap.registerPlugin(TextPlugin);
     gsap.to('.ubah_data', {
          duration: 2,
          delay: 1,
          text: '<i class="bi bi-pencil-square"></i>Ubah Data Peserta'
     })
     gsap.from('.navbar', {
          duration: 1,
          y: '-100%',
          opacity: 0,
          ease: 'bounce',
     })
     </script>
</body>

</html>