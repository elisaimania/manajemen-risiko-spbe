-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2022 pada 20.13
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manrisk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `area_dampak_risiko_spbe`
--

CREATE TABLE `area_dampak_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `area_dampak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `area_dampak_risiko_spbe`
--

INSERT INTO `area_dampak_risiko_spbe` (`id`, `area_dampak`) VALUES
(2, 'Finansial'),
(3, 'Reputasi'),
(4, 'Kinerja'),
(5, 'Layanan Organisasi'),
(6, 'Operasional dan Aset TIK'),
(7, 'Hukum dan Regulasi'),
(8, 'Sumber Daya Manusia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `area_dampak_risiko_spbe_terpilih`
--

CREATE TABLE `area_dampak_risiko_spbe_terpilih` (
  `id` int(4) UNSIGNED NOT NULL,
  `id_area_dampak` int(4) UNSIGNED NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_umum`
--

CREATE TABLE `informasi_umum` (
  `id` int(4) UNSIGNED NOT NULL,
  `tugas_UPR` varchar(255) NOT NULL,
  `fungsi_UPR` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_risiko`
--

CREATE TABLE `jenis_risiko` (
  `id` int(1) NOT NULL,
  `jenis_risiko` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis_risiko`
--

INSERT INTO `jenis_risiko` (`id`, `jenis_risiko`) VALUES
(1, 'Positif'),
(2, 'Negatif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_risiko_spbe`
--

CREATE TABLE `kategori_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `kategori_risiko` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori_risiko_spbe`
--

INSERT INTO `kategori_risiko_spbe` (`id`, `kategori_risiko`) VALUES
(3, 'Rencana Induk SPBE Nasional'),
(4, 'Arsitektur SPBE'),
(5, 'Peta Rencana SPBE'),
(6, 'Proses Bisnis'),
(7, 'Rencana dan Anggaran'),
(8, 'Inovasi'),
(9, 'Kepatuhan terhadap Peraturan'),
(10, 'Pengadaan Barang dan Jasa'),
(11, 'Proyek Pembangunan/Pengembangan Sistem'),
(12, 'Data dan Informasi'),
(14, 'Infrastruktur SPBE'),
(15, 'Keamanan SPBE'),
(16, 'Layanan SPBE'),
(17, 'Sumber Daya Manusia SPBE'),
(18, 'Bencana Alam'),
(19, 'Aplikasi SPBE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_risiko_spbe_terpilih`
--

CREATE TABLE `kategori_risiko_spbe_terpilih` (
  `id` int(4) UNSIGNED NOT NULL,
  `id_kategori_risiko` int(4) UNSIGNED NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan`
--

CREATE TABLE `keputusan` (
  `id` int(1) NOT NULL,
  `keputusan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keputusan`
--

INSERT INTO `keputusan` (`id`, `keputusan`) VALUES
(1, 'TIDAK'),
(2, 'YA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_dampak_risiko_spbe`
--

CREATE TABLE `kriteria_dampak_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `tag` varchar(50) NOT NULL,
  `id_area_dampak` int(4) UNSIGNED NOT NULL,
  `id_jenis_risiko` int(1) NOT NULL,
  `id_level_dampak` int(4) NOT NULL,
  `penjelasan` varchar(255) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_kemungkinan_risiko_spbe`
--

CREATE TABLE `kriteria_kemungkinan_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `tag` varchar(50) NOT NULL,
  `id_kategori_risiko` int(4) UNSIGNED NOT NULL,
  `id_level_kemungkinan` int(1) NOT NULL,
  `presentase_kemungkinan` varchar(50) NOT NULL,
  `jumlah_frekuensi` varchar(30) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_dampak_risiko_spbe`
--

CREATE TABLE `level_dampak_risiko_spbe` (
  `id` int(1) NOT NULL,
  `level_dampak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `level_dampak_risiko_spbe`
--

INSERT INTO `level_dampak_risiko_spbe` (`id`, `level_dampak`) VALUES
(1, 'Tidak Signifikan'),
(2, 'Kurang Signifikan'),
(3, 'Cukup Signifikan'),
(4, 'Signifikan'),
(5, 'Sangat Signifikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_kemungkinan_risiko_spbe`
--

CREATE TABLE `level_kemungkinan_risiko_spbe` (
  `id` int(1) NOT NULL,
  `level_kemungkinan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `level_kemungkinan_risiko_spbe`
--

INSERT INTO `level_kemungkinan_risiko_spbe` (`id`, `level_kemungkinan`) VALUES
(1, 'Hampir Tidak Terjadi'),
(2, 'Jarang Terjadi'),
(3, 'Kadang-Kadang Terjadi'),
(4, 'Sering Terjadi'),
(5, 'Hampir Pasti Terjadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_risiko_spbe`
--

CREATE TABLE `level_risiko_spbe` (
  `id` int(1) UNSIGNED NOT NULL,
  `level_risiko` varchar(50) NOT NULL,
  `rentang_min` int(3) NOT NULL,
  `rentang_maks` int(3) NOT NULL,
  `ket_warna` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `level_risiko_spbe`
--

INSERT INTO `level_risiko_spbe` (`id`, `level_risiko`, `rentang_min`, `rentang_maks`, `ket_warna`) VALUES
(1, 'Sangat Rendah', 1, 5, 'Biru'),
(2, 'Rendah', 6, 10, 'Hijau'),
(3, 'Sedang', 11, 15, 'Kuning'),
(4, 'Tinggi', 16, 20, 'Jingga'),
(5, 'Sangat Tinggi', 21, 25, 'Merah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matriks_analisi_risiko`
--

CREATE TABLE `matriks_analisi_risiko` (
  `id_level_kemungkinan` int(1) NOT NULL,
  `id_level_dampak` int(1) NOT NULL,
  `besaran_risiko` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `matriks_analisi_risiko`
--

INSERT INTO `matriks_analisi_risiko` (`id_level_kemungkinan`, `id_level_dampak`, `besaran_risiko`) VALUES
(5, 1, 9),
(5, 2, 15),
(5, 3, 18),
(5, 4, 23),
(5, 5, 25),
(4, 1, 6),
(4, 2, 12),
(4, 3, 16),
(4, 4, 19),
(4, 5, 24),
(3, 1, 4),
(3, 2, 10),
(3, 3, 14),
(3, 4, 17),
(3, 5, 22),
(2, 1, 2),
(2, 2, 7),
(2, 3, 11),
(2, 4, 13),
(2, 5, 21),
(1, 1, 1),
(1, 2, 3),
(1, 3, 5),
(1, 4, 8),
(1, 5, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(8, '2022-03-03-214845', 'App\\Database\\Migrations\\RolePengguna', 'default', 'App', 1646345620, 1),
(9, '2022-03-03-215042', 'App\\Database\\Migrations\\Pengguna', 'default', 'App', 1646345621, 1),
(37, '2022-03-08-092838', 'App\\Database\\Migrations\\KategoriRisikoSpbe', 'default', 'App', 1647235461, 2),
(38, '2022-03-08-093425', 'App\\Database\\Migrations\\AreaDampakRisikoSPBE', 'default', 'App', 1647235462, 2),
(40, '2022-03-11-191321', 'App\\Database\\Migrations\\StatusPersetujuan', 'default', 'App', 1647235463, 2),
(41, '2022-03-12-164147', 'App\\Database\\Migrations\\Pengguna', 'default', 'App', 1647235464, 2),
(42, '2022-03-13-124204', 'App\\Database\\Migrations\\SasaranSPBE', 'default', 'App', 1647235464, 2),
(43, '2022-03-13-124358', 'App\\Database\\Migrations\\StrukturPelaksana', 'default', 'App', 1647235465, 2),
(44, '2022-03-13-174956', 'App\\Database\\Migrations\\PemangkuKepentingan', 'default', 'App', 1647235465, 2),
(45, '2022-03-13-175307', 'App\\Database\\Migrations\\PeraturanPerundangan', 'default', 'App', 1647235466, 2),
(46, '2022-03-13-195947', 'App\\Database\\Migrations\\KategoriRisikoTerpilih', 'default', 'App', 1647235466, 2),
(47, '2022-03-13-200904', 'App\\Database\\Migrations\\AreaDampakSPBETerpilih', 'default', 'App', 1647235467, 2),
(48, '2022-03-13-202259', 'App\\Database\\Migrations\\JenisRisiko', 'default', 'App', 1647235467, 2),
(49, '2022-03-13-202426', 'App\\Database\\Migrations\\LevelKemungkinanRisikoSPBE', 'default', 'App', 1647235468, 2),
(50, '2022-03-13-202621', 'App\\Database\\Migrations\\LevelDampakRisikoSPBE', 'default', 'App', 1647235468, 2),
(51, '2022-03-13-202808', 'App\\Database\\Migrations\\MatriksAnalisisRisiko', 'default', 'App', 1647235916, 3),
(53, '2022-03-13-204831', 'App\\Database\\Migrations\\SeleraRisikoSPBE', 'default', 'App', 1647235917, 3),
(54, '2022-03-14-044653', 'App\\Database\\Migrations\\KriteriaDampakRisikoSPBE', 'default', 'App', 1647235918, 3),
(57, '2022-03-14-053813', 'App\\Database\\Migrations\\MatriksAnalisisRisiko', 'default', 'App', 1647236350, 4),
(58, '2022-03-14-054034', 'App\\Database\\Migrations\\Keputusan', 'default', 'App', 1647236529, 5),
(61, '2022-03-13-201250', 'App\\Database\\Migrations\\KriteriaDampakRisikoSPBE', 'default', 'App', 1647238636, 7),
(62, '2022-03-13-201856', 'App\\Database\\Migrations\\JenisRisiko', 'default', 'App', 1647238636, 7),
(64, '2022-03-14-053555', 'App\\Database\\Migrations\\MatriksAnalisisRisiko', 'default', 'App', 1647239009, 8),
(66, '2022-03-15-102534', 'App\\Database\\Migrations\\KriteriaKemungkinanRisikoSPBE', 'default', 'App', 1647340088, 9),
(67, '2022-03-15-134129', 'App\\Database\\Migrations\\KriteriaKemungkinanRisikoSPBE', 'default', 'App', 1647351848, 10),
(68, '2022-03-16-175601', 'App\\Database\\Migrations\\LevelRisikoSPBE', 'default', 'App', 1647453383, 11),
(69, '2022-03-16-180040', 'App\\Database\\Migrations\\LevelRisikoSPBE', 'default', 'App', 1647453676, 12),
(70, '2022-03-16-234313', 'App\\Database\\Migrations\\PenilaianRisikoSPBE', 'default', 'App', 1647474494, 13),
(71, '2022-03-16-234925', 'App\\Database\\Migrations\\SeleraRisikoSPBE', 'default', 'App', 1647474585, 14),
(72, '2022-03-21-230707', 'App\\Database\\Migrations\\PenilaianRisikoSPBE', 'default', 'App', 1647904077, 15),
(73, '2022-03-14-054344', 'App\\Database\\Migrations\\PenilaianRisikoSPBE', 'default', 'App', 1647904168, 16),
(74, '2022-03-21-231410', 'App\\Database\\Migrations\\PenilaianRisikoSPBE', 'default', 'App', 1647904525, 17),
(75, '2022-03-22-000746', 'App\\Database\\Migrations\\RencanaPenangananRisikoSPBE', 'default', 'App', 1647907818, 18),
(76, '2022-03-22-005557', 'App\\Database\\Migrations\\AlterPenilaianRisikoSPBE', 'default', 'App', 1647910612, 19),
(77, '2022-03-22-005557', 'App\\Database\\Migrations\\PenilaianRisikoSPBE', 'default', 'App', 1647910753, 20),
(78, '2022-03-22-010130', 'App\\Database\\Migrations\\PenilaianRisikoSPBE', 'default', 'App', 1647910916, 21),
(79, '2022-03-22-010330', 'App\\Database\\Migrations\\RencanaPenangananRisikoSPBE', 'default', 'App', 1647911032, 22),
(80, '2022-03-22-010501', 'App\\Database\\Migrations\\RencanaPenangananRisikoSPBE', 'default', 'App', 1647911124, 23),
(81, '2022-03-24-095748', 'App\\Database\\Migrations\\OpsiPenangananRisikoSPBE', 'default', 'App', 1648116007, 24),
(82, '2022-03-08-094241', 'App\\Database\\Migrations\\OpsiPenangananRisikoSPBE', 'default', 'App', 1648116176, 25),
(83, '2022-03-24-100423', 'App\\Database\\Migrations\\OpsiPenangananRisikoSPBE', 'default', 'App', 1648116292, 26),
(84, '2022-03-24-100610', 'App\\Database\\Migrations\\RencanaPenangananRisikoSPBE', 'default', 'App', 1648116424, 27),
(85, '2022-03-29-101855', 'App\\Database\\Migrations\\UPRSPBE', 'default', 'App', 1648549260, 28),
(86, '2022-03-29-102146', 'App\\Database\\Migrations\\Pengguna', 'default', 'App', 1648549392, 29),
(87, '2022-03-29-102415', 'App\\Database\\Migrations\\InformasiUmum', 'default', 'App', 1648549549, 30),
(88, '2022-03-29-102650', 'App\\Database\\Migrations\\SasaranSPBE', 'default', 'App', 1648549668, 31),
(89, '2022-03-29-102834', 'App\\Database\\Migrations\\StrukturPelaksana', 'default', 'App', 1648549898, 32),
(90, '2022-03-29-103353', 'App\\Database\\Migrations\\PemangkuKepentingan', 'default', 'App', 1648550097, 33),
(91, '2022-03-29-103632', 'App\\Database\\Migrations\\PeraturanPerundangan', 'default', 'App', 1648550242, 34),
(92, '2022-03-29-103853', 'App\\Database\\Migrations\\KategoriRisikoTerpilih', 'default', 'App', 1648550400, 35),
(93, '2022-03-29-104121', 'App\\Database\\Migrations\\AreaDampakRisikoSPBETerpilih', 'default', 'App', 1648550567, 36),
(94, '2022-03-29-104448', 'App\\Database\\Migrations\\KriteriaDampakRisikoSPBE', 'default', 'App', 1648550748, 37),
(95, '2022-03-29-104638', 'App\\Database\\Migrations\\KriteriaKemungkinanRisikoSPBE', 'default', 'App', 1648550931, 38),
(96, '2022-03-29-104933', 'App\\Database\\Migrations\\SeleraRisikoSpbe', 'default', 'App', 1648551057, 39),
(97, '2022-03-29-105137', 'App\\Database\\Migrations\\PenilaianRisikoSpbe', 'default', 'App', 1648551130, 40),
(98, '2022-03-29-105315', 'App\\Database\\Migrations\\RencanaPenangananRisikoSpbe', 'default', 'App', 1648551216, 41),
(99, '2022-03-29-124232', 'App\\Database\\Migrations\\InformasiUmum', 'default', 'App', 1648557798, 42),
(100, '2022-03-29-125254', 'App\\Database\\Migrations\\KategoriRisikoTerpilih', 'default', 'App', 1648558461, 43),
(101, '2022-03-29-125451', 'App\\Database\\Migrations\\AreaDampakRisikoSPBETerpilih', 'default', 'App', 1648558556, 44),
(102, '2022-03-29-160822', 'App\\Database\\Migrations\\PenilaianRisikoSpbe', 'default', 'App', 1648570240, 45),
(103, '2022-03-29-161555', 'App\\Database\\Migrations\\RencanaPenangananRisikoSpbe', 'default', 'App', 1648570731, 46),
(104, '2022-03-29-161927', 'App\\Database\\Migrations\\PenilaianRisikoSpbe', 'default', 'App', 1648570916, 47),
(105, '2022-03-29-162539', 'App\\Database\\Migrations\\PenilaianRisikoSpbe', 'default', 'App', 1648571179, 48),
(106, '2022-03-29-162655', 'App\\Database\\Migrations\\RencanaPenangananRisikoSpbe', 'default', 'App', 1648571229, 49),
(107, '2022-03-29-162823', 'App\\Database\\Migrations\\RencanaPenangananRisikoSpbe', 'default', 'App', 1648571316, 50),
(108, '2022-03-29-193053', 'App\\Database\\Migrations\\SeleraRisikoSpbe', 'default', 'App', 1648582295, 51),
(109, '2022-03-29-193213', 'App\\Database\\Migrations\\PenilaianRisikoSpbe', 'default', 'App', 1648582374, 52),
(110, '2022-03-29-193315', 'App\\Database\\Migrations\\RencanaPenangananRisikoSpbe', 'default', 'App', 1648582429, 53),
(111, '2022-03-29-193642', 'App\\Database\\Migrations\\PenilaianRisikoSpbe', 'default', 'App', 1648582685, 54),
(112, '2022-03-29-193740', 'App\\Database\\Migrations\\RencanaPenangananRisikoSpbe', 'default', 'App', 1648582686, 54),
(115, '2022-06-02-080538', 'App\\Database\\Migrations\\PemantauanRisikoSPBE', 'default', 'App', 1654317225, 55);

-- --------------------------------------------------------

--
-- Struktur dari tabel `opsi_penanganan_risiko_spbe`
--

CREATE TABLE `opsi_penanganan_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `opsi_penanganan` varchar(255) NOT NULL,
  `id_jenis_risiko` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `opsi_penanganan_risiko_spbe`
--

INSERT INTO `opsi_penanganan_risiko_spbe` (`id`, `opsi_penanganan`, `id_jenis_risiko`) VALUES
(4, 'Ekskalasi Risiko', 1),
(5, 'Ekspoitasi Risiko', 1),
(6, 'Peningkatan Risiko', 1),
(7, 'Pembagian Risiko', 1),
(8, 'Penerimaan Risiko', 1),
(9, 'Ekskalasi Risiko', 2),
(10, 'Mitigasi Risiko', 2),
(11, 'Transfer Risiko', 2),
(12, 'Penghindaran Risiko', 2),
(13, 'Penerimaan Risiko', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemangku_kepentingan`
--

CREATE TABLE `pemangku_kepentingan` (
  `id` int(4) UNSIGNED NOT NULL,
  `nama_unit` varchar(100) NOT NULL,
  `hubungan` varchar(255) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemantauan_risiko_spbe`
--

CREATE TABLE `pemantauan_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `id_risiko` int(4) UNSIGNED NOT NULL,
  `id_penanganan_risiko` int(4) UNSIGNED NOT NULL,
  `jenis_laporan` varchar(20) NOT NULL,
  `periode_laporan` varchar(20) DEFAULT NULL,
  `id_level_kemungkinan_pemantauan` int(1) NOT NULL,
  `id_level_dampak_pemantauan` int(1) NOT NULL,
  `deskripsi_risiko_saat_ini` mediumtext NOT NULL,
  `rekomendasi` varchar(255) DEFAULT NULL,
  `rencana_penanganan` varchar(255) DEFAULT NULL,
  `penanggungjawab` varchar(255) DEFAULT NULL,
  `waktu_pelaksanaan_rencana` varchar(25) DEFAULT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(4) UNSIGNED NOT NULL,
  `id_role` int(2) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nip` char(18) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `id_role`, `nama_pengguna`, `username`, `password`, `email`, `nip`, `id_upr`) VALUES
(15, 1, 'Pengelola Risiko', 'pengelola_risiko', '$2y$10$/ahUmrFE3.uj2dHTON6KmO8NGYlqHEiF2FZ5P.AkkKghrteGG1caW', 'pengelola_risiko@gmail.com', '', 1),
(16, 2, 'Koordinator Risiko', 'koordinator_risiko', '$2y$10$uNLkd9W3s/QWRLwtbBD.aeP3ENh4fsamuJisTfQSmqLatLCfHE.Ta', 'koordinator_risiko@gmail.com', '', 1),
(17, 3, 'Pemilik Risiko', 'pemilik_risiko', '$2y$10$CppSxiWha5HNi6CnlsnXRetUE6rPhj.ai.O2Aum5ScKnTHJdfjqkC', 'pemilik_risiko@gmail.com', '', 1),
(18, 4, 'Admin', 'admin', '$2y$10$AeKa0gfNIUJJTK6KVwS.eeR1kRJzdyOiIdO8nswdQ4.RvpjkZMKee', 'admin@gmail.com', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_risiko_spbe`
--

CREATE TABLE `penilaian_risiko_spbe` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_sasaran_SPBE` int(4) UNSIGNED NOT NULL,
  `id_jenis_risiko` int(1) NOT NULL,
  `kejadian` varchar(255) NOT NULL,
  `penyebab` varchar(255) NOT NULL,
  `id_kategori_risiko` int(4) UNSIGNED NOT NULL,
  `dampak` varchar(255) NOT NULL,
  `id_area_dampak` int(4) UNSIGNED NOT NULL,
  `sistem_pengendalian` varchar(255) NOT NULL,
  `id_level_kemungkinan` int(1) NOT NULL,
  `id_level_dampak` int(1) NOT NULL,
  `id_level_risiko` int(1) UNSIGNED NOT NULL,
  `id_keputusan` int(1) NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peraturan_perundangan`
--

CREATE TABLE `peraturan_perundangan` (
  `id` int(4) UNSIGNED NOT NULL,
  `nama_peraturan` varchar(255) NOT NULL,
  `amanat` varchar(255) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rencana_penanganan_risiko_spbe`
--

CREATE TABLE `rencana_penanganan_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `id_risiko` int(4) UNSIGNED NOT NULL,
  `id_opsi_penanganan` int(4) UNSIGNED NOT NULL,
  `rencana_aksi` varchar(255) NOT NULL,
  `keluaran` varchar(255) NOT NULL,
  `jenis_periode_implementasi` varchar(50) NOT NULL,
  `periode_implementasi` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `penanggungjawab` varchar(100) NOT NULL,
  `risiko_residual` varchar(10) NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_pengguna`
--

CREATE TABLE `role_pengguna` (
  `id` int(2) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `role_pengguna`
--

INSERT INTO `role_pengguna` (`id`, `nama_role`) VALUES
(1, 'Pengelola Risiko SPBE'),
(2, 'Koordinator Risiko SPBE'),
(3, 'Pemilik Risiko SPBE'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sasaran_spbe`
--

CREATE TABLE `sasaran_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `sasaran_UPR_SPBE` varchar(255) NOT NULL,
  `sasaran_SPBE` varchar(255) NOT NULL,
  `indikator_kinerja_SPBE` varchar(255) NOT NULL,
  `target_kinerja` char(10) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `selera_risiko_spbe`
--

CREATE TABLE `selera_risiko_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `tag` varchar(50) NOT NULL,
  `id_kategori_risiko` int(4) UNSIGNED NOT NULL,
  `id_jenis_risiko` int(1) NOT NULL,
  `besaran_risiko_min` int(3) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_persetujuan`
--

CREATE TABLE `status_persetujuan` (
  `id` int(1) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `status_persetujuan`
--

INSERT INTO `status_persetujuan` (`id`, `status`) VALUES
(1, 'Belum Disetujui'),
(2, 'Setuju'),
(3, 'Tidak Setuju');

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur_pelaksana`
--

CREATE TABLE `struktur_pelaksana` (
  `id` int(4) UNSIGNED NOT NULL,
  `id_role` int(2) NOT NULL,
  `pelaksana` varchar(100) NOT NULL,
  `id_upr` int(4) UNSIGNED NOT NULL,
  `id_status_persetujuan` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `upr_spbe`
--

CREATE TABLE `upr_spbe` (
  `id` int(4) UNSIGNED NOT NULL,
  `upr_SPBE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `upr_spbe`
--

INSERT INTO `upr_spbe` (`id`, `upr_SPBE`) VALUES
(1, 'Direktorat Sistem Informasi'),
(2, 'Deputi Bidang Metodologi dan Informasi Statistik');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `area_dampak_risiko_spbe`
--
ALTER TABLE `area_dampak_risiko_spbe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `area_dampak_risiko_spbe_terpilih`
--
ALTER TABLE `area_dampak_risiko_spbe_terpilih`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_dampak_risiko_SPBE_terpilih_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `area_dampak_risiko_SPBE_terpilih_id_upr_foreign` (`id_upr`),
  ADD KEY `area_dampak_risiko_SPBE_terpilih_id_area_dampak_foreign` (`id_area_dampak`) USING BTREE;

--
-- Indeks untuk tabel `informasi_umum`
--
ALTER TABLE `informasi_umum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informasi_umum_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `informasi_umum_id_upr_foreign` (`id_upr`);

--
-- Indeks untuk tabel `jenis_risiko`
--
ALTER TABLE `jenis_risiko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_risiko_spbe`
--
ALTER TABLE `kategori_risiko_spbe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_risiko_spbe_terpilih`
--
ALTER TABLE `kategori_risiko_spbe_terpilih`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_risiko_SPBE_terpilih_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `kategori_risiko_SPBE_terpilih_id_upr_foreign` (`id_upr`),
  ADD KEY `area_dampak_risiko_SPBE_terpilih_id_kategori_risiko_foreign` (`id_kategori_risiko`) USING BTREE;

--
-- Indeks untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria_dampak_risiko_spbe`
--
ALTER TABLE `kriteria_dampak_risiko_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_dampak_risiko_SPBE_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `kriteria_dampak_risiko_SPBE_id_level_dampak_foreign` (`id_level_dampak`),
  ADD KEY `kriteria_dampak_risiko_SPBE_id_jenis_risiko_foreign` (`id_jenis_risiko`),
  ADD KEY `kriteria_dampak_risiko_SPBE_id_upr_foreign` (`id_upr`),
  ADD KEY `kriteria_dampak_risiko_SPBE_id_area_dampak_foreign` (`id_area_dampak`);

--
-- Indeks untuk tabel `kriteria_kemungkinan_risiko_spbe`
--
ALTER TABLE `kriteria_kemungkinan_risiko_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_kemungkinan_risiko_SPBE_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `kriteria_kemungkinan_risiko_SPBE_id_level_kemungkinan_foreign` (`id_level_kemungkinan`),
  ADD KEY `kriteria_kemungkinan_risiko_SPBE_id_upr_foreign` (`id_upr`),
  ADD KEY `kriteria_kemungkinan_risiko_SPBE_id_kategori_risiko_foreign` (`id_kategori_risiko`);

--
-- Indeks untuk tabel `level_dampak_risiko_spbe`
--
ALTER TABLE `level_dampak_risiko_spbe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_kemungkinan_risiko_spbe`
--
ALTER TABLE `level_kemungkinan_risiko_spbe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_risiko_spbe`
--
ALTER TABLE `level_risiko_spbe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `matriks_analisi_risiko`
--
ALTER TABLE `matriks_analisi_risiko`
  ADD KEY `matriks_analisi_risiko_id_level_dampak_foreign` (`id_level_dampak`),
  ADD KEY `id_level_kemungkinan_id_level_dampak` (`id_level_kemungkinan`,`id_level_dampak`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `opsi_penanganan_risiko_spbe`
--
ALTER TABLE `opsi_penanganan_risiko_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opsi_penanganan_risiko_SPBE_id_jenis_risiko_foreign` (`id_jenis_risiko`);

--
-- Indeks untuk tabel `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemangku_kepentingan_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `pemangku_kepentingan_id_upr_foreign` (`id_upr`);

--
-- Indeks untuk tabel `pemantauan_risiko_spbe`
--
ALTER TABLE `pemantauan_risiko_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemantauan_risiko_SPBE_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `pemantauan_risiko_SPBE_id_risiko_foreign` (`id_risiko`),
  ADD KEY `pemantauan_risiko_SPBE_id_penanganan_risiko_foreign` (`id_penanganan_risiko`),
  ADD KEY `pemantauan_risiko_SPBE_id_level_kemungkinan_pemantauan_foreign` (`id_level_kemungkinan_pemantauan`),
  ADD KEY `pemantauan_risiko_SPBE_id_level_dampak_pemantauan_foreign` (`id_level_dampak_pemantauan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengguna_id_role_foreign` (`id_role`),
  ADD KEY `pengguna_id_upr_foreign` (`id_upr`);

--
-- Indeks untuk tabel `penilaian_risiko_spbe`
--
ALTER TABLE `penilaian_risiko_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_risiko_SPBE_id_level_kemungkinan_foreign` (`id_level_kemungkinan`),
  ADD KEY `penilaian_risiko_SPBE_id_level_dampak_foreign` (`id_level_dampak`),
  ADD KEY `penilaian_risiko_SPBE_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `penilaian_risiko_SPBE_id_sasaran_SPBE_foreign` (`id_sasaran_SPBE`),
  ADD KEY `penilaian_risiko_SPBE_id_jenis_risiko_foreign` (`id_jenis_risiko`),
  ADD KEY `penilaian_risiko_SPBE_id_level_risiko_foreign` (`id_level_risiko`),
  ADD KEY `penilaian_risiko_SPBE_id_keputusan_foreign` (`id_keputusan`),
  ADD KEY `penilaian_risiko_SPBE_id_upr_foreign` (`id_upr`),
  ADD KEY `penilaian_risiko_SPBE_id_area_dampak_foreign` (`id_area_dampak`),
  ADD KEY `penilaian_risiko_SPBE_id_kategori_risiko_foreign` (`id_kategori_risiko`);

--
-- Indeks untuk tabel `peraturan_perundangan`
--
ALTER TABLE `peraturan_perundangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peraturan_perundangan_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `peraturan_perundangan_id_upr_foreign` (`id_upr`);

--
-- Indeks untuk tabel `rencana_penanganan_risiko_spbe`
--
ALTER TABLE `rencana_penanganan_risiko_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rencana_penanganan_risiko_SPBE_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `rencana_penanganan_risiko_SPBE_id_risiko_foreign` (`id_risiko`),
  ADD KEY `rencana_penanganan_risiko_SPBE_id_opsi_penanganan_foreign` (`id_opsi_penanganan`);

--
-- Indeks untuk tabel `role_pengguna`
--
ALTER TABLE `role_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sasaran_spbe`
--
ALTER TABLE `sasaran_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sasaran_SPBE_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `sasaran_SPBE_id_upr_foreign` (`id_upr`);

--
-- Indeks untuk tabel `selera_risiko_spbe`
--
ALTER TABLE `selera_risiko_spbe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selera_risiko_SPBE_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `selera_risiko_SPBE_id_upr_foreign` (`id_upr`),
  ADD KEY `selera_risiko_SPBE_id_kategori_risiko_foreign` (`id_kategori_risiko`);

--
-- Indeks untuk tabel `status_persetujuan`
--
ALTER TABLE `status_persetujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `struktur_pelaksana`
--
ALTER TABLE `struktur_pelaksana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `struktur_pelaksana_id_status_persetujuan_foreign` (`id_status_persetujuan`),
  ADD KEY `struktur_pelaksana_id_role_foreign` (`id_role`),
  ADD KEY `struktur_pelaksana_id_upr_foreign` (`id_upr`);

--
-- Indeks untuk tabel `upr_spbe`
--
ALTER TABLE `upr_spbe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `area_dampak_risiko_spbe`
--
ALTER TABLE `area_dampak_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `area_dampak_risiko_spbe_terpilih`
--
ALTER TABLE `area_dampak_risiko_spbe_terpilih`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `informasi_umum`
--
ALTER TABLE `informasi_umum`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_risiko_spbe`
--
ALTER TABLE `kategori_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kategori_risiko_spbe_terpilih`
--
ALTER TABLE `kategori_risiko_spbe_terpilih`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kriteria_dampak_risiko_spbe`
--
ALTER TABLE `kriteria_dampak_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kriteria_kemungkinan_risiko_spbe`
--
ALTER TABLE `kriteria_kemungkinan_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `level_risiko_spbe`
--
ALTER TABLE `level_risiko_spbe`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `opsi_penanganan_risiko_spbe`
--
ALTER TABLE `opsi_penanganan_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemantauan_risiko_spbe`
--
ALTER TABLE `pemantauan_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `penilaian_risiko_spbe`
--
ALTER TABLE `penilaian_risiko_spbe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peraturan_perundangan`
--
ALTER TABLE `peraturan_perundangan`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rencana_penanganan_risiko_spbe`
--
ALTER TABLE `rencana_penanganan_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sasaran_spbe`
--
ALTER TABLE `sasaran_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `selera_risiko_spbe`
--
ALTER TABLE `selera_risiko_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `struktur_pelaksana`
--
ALTER TABLE `struktur_pelaksana`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `upr_spbe`
--
ALTER TABLE `upr_spbe`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `area_dampak_risiko_spbe_terpilih`
--
ALTER TABLE `area_dampak_risiko_spbe_terpilih`
  ADD CONSTRAINT `area_dampak_risiko_SPBE_terpilih_id_foreign` FOREIGN KEY (`id_area_dampak`) REFERENCES `area_dampak_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `area_dampak_risiko_SPBE_terpilih_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `area_dampak_risiko_SPBE_terpilih_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `informasi_umum`
--
ALTER TABLE `informasi_umum`
  ADD CONSTRAINT `informasi_umum_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `informasi_umum_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kategori_risiko_spbe_terpilih`
--
ALTER TABLE `kategori_risiko_spbe_terpilih`
  ADD CONSTRAINT `kategori_risiko_SPBE_terpilih_id_foreign` FOREIGN KEY (`id_kategori_risiko`) REFERENCES `kategori_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_risiko_SPBE_terpilih_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_risiko_SPBE_terpilih_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria_dampak_risiko_spbe`
--
ALTER TABLE `kriteria_dampak_risiko_spbe`
  ADD CONSTRAINT `kriteria_dampak_risiko_SPBE_id_area_dampak_foreign` FOREIGN KEY (`id_area_dampak`) REFERENCES `area_dampak_risiko_spbe_terpilih` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_dampak_risiko_SPBE_id_jenis_risiko_foreign` FOREIGN KEY (`id_jenis_risiko`) REFERENCES `jenis_risiko` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_dampak_risiko_SPBE_id_level_dampak_foreign` FOREIGN KEY (`id_level_dampak`) REFERENCES `level_dampak_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_dampak_risiko_SPBE_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_dampak_risiko_SPBE_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria_kemungkinan_risiko_spbe`
--
ALTER TABLE `kriteria_kemungkinan_risiko_spbe`
  ADD CONSTRAINT `kriteria_kemungkinan_risiko_SPBE_id_kategori_risiko_foreign` FOREIGN KEY (`id_kategori_risiko`) REFERENCES `kategori_risiko_spbe_terpilih` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_kemungkinan_risiko_SPBE_id_level_kemungkinan_foreign` FOREIGN KEY (`id_level_kemungkinan`) REFERENCES `level_kemungkinan_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_kemungkinan_risiko_SPBE_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_kemungkinan_risiko_SPBE_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `matriks_analisi_risiko`
--
ALTER TABLE `matriks_analisi_risiko`
  ADD CONSTRAINT `matriks_analisi_risiko_id_level_dampak_foreign` FOREIGN KEY (`id_level_dampak`) REFERENCES `level_dampak_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matriks_analisi_risiko_id_level_kemungkinan_foreign` FOREIGN KEY (`id_level_kemungkinan`) REFERENCES `level_kemungkinan_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `opsi_penanganan_risiko_spbe`
--
ALTER TABLE `opsi_penanganan_risiko_spbe`
  ADD CONSTRAINT `opsi_penanganan_risiko_SPBE_id_jenis_risiko_foreign` FOREIGN KEY (`id_jenis_risiko`) REFERENCES `jenis_risiko` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  ADD CONSTRAINT `pemangku_kepentingan_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemangku_kepentingan_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemantauan_risiko_spbe`
--
ALTER TABLE `pemantauan_risiko_spbe`
  ADD CONSTRAINT `pemantauan_risiko_SPBE_id_level_dampak_pemantauan_foreign` FOREIGN KEY (`id_level_dampak_pemantauan`) REFERENCES `level_dampak_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemantauan_risiko_SPBE_id_level_kemungkinan_pemantauan_foreign` FOREIGN KEY (`id_level_kemungkinan_pemantauan`) REFERENCES `level_kemungkinan_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemantauan_risiko_SPBE_id_penanganan_risiko_foreign` FOREIGN KEY (`id_penanganan_risiko`) REFERENCES `rencana_penanganan_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemantauan_risiko_SPBE_id_risiko_foreign` FOREIGN KEY (`id_risiko`) REFERENCES `penilaian_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemantauan_risiko_SPBE_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role_pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengguna_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian_risiko_spbe`
--
ALTER TABLE `penilaian_risiko_spbe`
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_area_dampak_foreign` FOREIGN KEY (`id_area_dampak`) REFERENCES `area_dampak_risiko_spbe_terpilih` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_jenis_risiko_foreign` FOREIGN KEY (`id_jenis_risiko`) REFERENCES `jenis_risiko` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_kategori_risiko_foreign` FOREIGN KEY (`id_kategori_risiko`) REFERENCES `kategori_risiko_spbe_terpilih` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_keputusan_foreign` FOREIGN KEY (`id_keputusan`) REFERENCES `keputusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_level_dampak_foreign` FOREIGN KEY (`id_level_dampak`) REFERENCES `level_dampak_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_level_kemungkinan_foreign` FOREIGN KEY (`id_level_kemungkinan`) REFERENCES `level_kemungkinan_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_level_risiko_foreign` FOREIGN KEY (`id_level_risiko`) REFERENCES `level_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_sasaran_SPBE_foreign` FOREIGN KEY (`id_sasaran_SPBE`) REFERENCES `sasaran_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_risiko_SPBE_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peraturan_perundangan`
--
ALTER TABLE `peraturan_perundangan`
  ADD CONSTRAINT `peraturan_perundangan_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peraturan_perundangan_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rencana_penanganan_risiko_spbe`
--
ALTER TABLE `rencana_penanganan_risiko_spbe`
  ADD CONSTRAINT `rencana_penanganan_risiko_SPBE_id_opsi_penanganan_foreign` FOREIGN KEY (`id_opsi_penanganan`) REFERENCES `opsi_penanganan_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rencana_penanganan_risiko_SPBE_id_risiko_foreign` FOREIGN KEY (`id_risiko`) REFERENCES `penilaian_risiko_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rencana_penanganan_risiko_SPBE_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sasaran_spbe`
--
ALTER TABLE `sasaran_spbe`
  ADD CONSTRAINT `sasaran_SPBE_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sasaran_SPBE_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `selera_risiko_spbe`
--
ALTER TABLE `selera_risiko_spbe`
  ADD CONSTRAINT `selera_risiko_SPBE_id_kategori_risiko_foreign` FOREIGN KEY (`id_kategori_risiko`) REFERENCES `kategori_risiko_spbe_terpilih` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selera_risiko_SPBE_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selera_risiko_SPBE_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `struktur_pelaksana`
--
ALTER TABLE `struktur_pelaksana`
  ADD CONSTRAINT `struktur_pelaksana_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role_pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `struktur_pelaksana_id_status_persetujuan_foreign` FOREIGN KEY (`id_status_persetujuan`) REFERENCES `status_persetujuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `struktur_pelaksana_id_upr_foreign` FOREIGN KEY (`id_upr`) REFERENCES `upr_spbe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
