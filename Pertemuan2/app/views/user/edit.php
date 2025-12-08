<h1>Edit User</h1>
<form action="<?= BASEURL; ?>/user/update" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['user']['id']); ?>">
    <label>Nama</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($data['user']['nama']); ?>" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($data['user']['email']); ?>" required><br><br>

    <button type="submit">Update</button>
</form>
<p><a href="<?= BASEURL; ?>/user">Kembali</a></p>
