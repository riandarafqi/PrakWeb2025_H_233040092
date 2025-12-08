<h1>Daftar User</h1>
<p><a class="btn" href="<?= BASEURL; ?>/user/create">Tambah User</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <tr><th>ID</th><th>Nama</th><th>Email</th><th>Aksi</th></tr>
    <?php if (!empty($data['users'])): ?>
        <?php foreach ($data['users'] as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['id']); ?></td>
                <td><?= htmlspecialchars($u['name']); ?></td>
                <td><?= htmlspecialchars($u['email']); ?></td>
                <td>
                    <a href="<?= BASEURL; ?>/user/detail/<?= $u['id']; ?>">Detail</a> |
                    <a href="<?= BASEURL; ?>/user/edit/<?= $u['id']; ?>">Edit</a> |
                    <a href="<?= BASEURL; ?>/user/delete/<?= $u['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">Belum ada data.</td></tr>
    <?php endif; ?>
</table>
