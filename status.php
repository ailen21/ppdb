<?php
session_start();
include 'config.php';
include 'partials/header.php';
include 'partials/sidebar.php';

// Cek apakah session user ada
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$uid = $_SESSION['user']['id'];
// Query untuk ambil data biodata dan status pendaftaran
$cek = $conn->query("SELECT biodata.status, biodata.nama, biodata.NISN, biodata.jurusan, biodata.jalur_pendaftaran FROM biodata WHERE biodata.user_id = $uid");

if ($cek->num_rows > 0) {
    $data = $cek->fetch_assoc();
} else {
    $data = ['status' => 'Tidak ada data', 'nama' => 'Tidak diketahui', 'NISN' => 'Tidak diketahui', 'jurusan' => 'Tidak diketahui', 'jalur_pendaftaran' => 'Tidak diketahui'];
}
?>

<div class="content">
    <div class="status-box">
        <div class="card" style="max-width: 600px; margin: 0 auto; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 10px;">
            <h3 style="text-align: center; font-weight: bold; margin-bottom: 30px;">Informasi Pendaftaran</h3>

            <div style="display: grid; grid-template-columns: 180px auto; row-gap: 10px;">
                <div><strong>Nama</strong></div>
                <div>: <?= htmlspecialchars($data['nama']) ?></div>

                <div><strong>NISN</strong></div>
                <div>: <?= htmlspecialchars($data['NISN']) ?></div>

                <div><strong>Jurusan</strong></div>
                <div>: <?= htmlspecialchars($data['jurusan']) ?></div>

                <div><strong>Jalur Pendaftaran</strong></div>
                <div>: <?= htmlspecialchars($data['jalur_pendaftaran']) ?></div>

                <div><strong>Status</strong></div>
                <div>:
                    <span class="status <?= ($data['status'] == 'diterima' ? 'diterima' : ($data['status'] == 'ditolak' ? 'ditolak' : 'belum-diverifikasi')) ?>">
                        <?= ucfirst($data['status'] ?? 'belum-diverifikasi') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
