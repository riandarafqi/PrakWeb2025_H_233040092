<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Daftar Pengguna</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h1 class="text-3xl font-bold underline">
      Hello world!
    </h1>

    <h1>Daftar Pengguna</h1>
    <!-- Tabel untuk menampilkan daftar semua pengguna -->
    <table class="user-table table-auto ">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop untuk menampilkan setiap pengguna -->
        <?php foreach ($users as $user): ?>
        <tr>
          <!-- Menampilkan nama dengan sanitasi HTML untuk keamanan -->
          <td><?= htmlspecialchars($user['name']); ?></td>
          <!-- Menampilkan email dengan sanitasi HTML -->
          <td><?= htmlspecialchars($user['email']); ?></td>
          <!-- Link untuk melihat detail pengguna berdasarkan ID -->
          <td><a href="index.php?id=<?= $user['id']; ?>" class="btn-small">Detail</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>