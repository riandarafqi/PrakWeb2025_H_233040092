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
  <div class="container p-10">
    <div class="row">
      <div class="col-lg-6">
        <?php Flasher::flash(); ?>
      </div>
    </div>

    <h1 class="text-xl">Daftar Pengguna</h1>

    <div class="w-full h-auto flex justify-between">
      <form action="index.php?action=cari" method="post">
        <div class="flex w-full gap-5">
          <input type="text" class="border-2 border-gray-500 rounded-md px-2" placeholder="cari user.." name="keyword"
            id="keyword" autocomplete="off">
          <div class="">
            <button
              class=" btn-small text-white w-auto h-auto border-blue-800 border-2 rounded-md py-1 px-4 bg-blue-500"
              type="submit" id="tombolCari">Cari</button>
          </div>
        </div>
      </form>

      <button onclick="openModal()"
        class=" btn-small text-white w-auto h-auto border-green-800 border-2 rounded-md py-1 px-4 bg-[#6bc685]">
        Add New
      </button>
    </div>

    <!-- Tabel untuk menampilkan daftar semua pengguna -->
    <table class="border-collapse border-gray-400 w-full min-h-80">
      <thead>
        <tr>
          <th class="border-b border-gray-300 px-4 py-2">Nama</th>
          <th class="border-b border-gray-300 px-4 py-2">Email</th>
          <th class="border-b border-gray-300 px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody class="">
        <!-- Loop untuk menampilkan setiap pengguna -->
        <?php foreach ($users as $user): ?>
        <tr class="<?php echo $user['id'] % 2 == 0 ? 'bg-gray-100' : 'white'; ?>">
          <!-- Menampilkan nama dengan sanitasi HTML untuk keamanan -->
          <td class="text-center min-w-50"><?= htmlspecialchars($user['name']); ?></td>
          <!-- Menampilkan email dengan sanitasi HTML -->
          <td class="text-center min-w-50"><?= htmlspecialchars($user['email']); ?></td>
          <!-- Link untuk melihat detail pengguna berdasarkan ID -->
          <td class="text-center min-w-70">
            <a href="index.php?id=<?= $user['id']; ?>"
              class="btn-small text-white w-auto h-auto border-blue-800 border-2 rounded-md py-1 px-4 bg-blue-500">Detail</a>
            <button
              onclick="openEditModal(<?= $user['id']; ?>, '<?= htmlspecialchars($user['name']); ?>', '<?= htmlspecialchars($user['email']); ?>')"
              class="btn-small text-white w-auto h-auto border-green-800 border-2 rounded-md py-1 px-4 bg-[#6bc685]">
              Update
            </button>
            <a href=" index.php?action=hapus&id=<?= $user['id']; ?>"
              class="btn-small text-white w-auto h-auto border-red-800 border-2 rounded-md py-1 px-4 bg-red-500">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div id="addUserModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-8 rounded-lg w-full max-w-md shadow-lg">
      <h2 class="text-xl font-semibold mb-4 text-center">Tambah Pengguna Baru</h2>
      <form action="index.php?action=tambah" method="POST" class="flex flex-col gap-4">
        <div>
          <label for="name" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
          <input type="text" id="name" name="name" required
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>

        <div>
          <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
          <input type="email" id="email" name="email" required
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>

        <div class="flex justify-end gap-4 mt-4">
          <button type="button" onclick="closeModal()"
            class="border-2 border-red-800 rounded-md py-2 px-4 bg-red-500 text-white hover:bg-red-400">Batal</button>
          <button type="submit"
            class="text-white border-green-800 border-2 rounded-md py-2 px-4 bg-[#6bc685] hover:bg-green-600 transition">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

  <div id="editUserModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-8 rounded-lg w-full max-w-md shadow-lg">
      <h2 class="text-xl font-semibold mb-4 text-center">Edit Pengguna</h2>
      <form action="index.php?action=ubah" method="POST" class="flex flex-col gap-4">
        <input type="hidden" id="edit_id" name="id">

        <div>
          <label for="edit_name" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
          <input type="text" id="edit_name" name="name" required
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>

        <div>
          <label for="edit_email" class="block text-gray-700 font-medium mb-1">Email</label>
          <input type="email" id="edit_email" name="email" required
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400" />
        </div>

        <div class="flex justify-end gap-4 mt-4">
          <button type="button" onclick="closeEditModal()"
            class="border-2 border-red-800 rounded-md py-2 px-4 bg-red-500 text-white hover:bg-red-400">Batal</button>
          <button type="submit"
            class="text-white border-green-800 border-2 rounded-md py-2 px-4 bg-[#6bc685] hover:bg-green-600 transition">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>


  <script>
  function openModal() {
    document.getElementById('addUserModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('addUserModal').classList.add('hidden');
  }

  function openEditModal(id, name, email) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('editUserModal').classList.remove('hidden');
  }

  function closeEditModal() {
    document.getElementById('editUserModal').classList.add('hidden');
  }
  </script>
</body>

</html>