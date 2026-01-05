<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Pengguna</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h1>Tambah Pengguna Baru</h1>

    <!-- Form Tambah User -->
    <form action="index.php?action=tambah" method="POST" class="form-user">
      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email" required>
      </div>

      <button type="submit" class="btn-submit">Simpan</button>
      <a href="index.php" class="btn-back">Kembali ke Daftar</a>
    </form>
  </div>
</body>

</html>