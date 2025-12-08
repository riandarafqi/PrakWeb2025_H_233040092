<h1>Tambah User</h1>
<form action="<?= BASEURL; ?>/user/store" method="post">
    <label>Nama</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Simpan</button>
</form>
<p><a href="<?= BASEURL; ?>/user">Kembali</a></p>
