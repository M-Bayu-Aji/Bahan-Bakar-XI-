<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pembayar Bahan bakar</title>
    <link rel="stylesheet" href="s.css">
    <style>
        @media print {
            /* Sembunyikan elemen dengan class 'no-print' saat dicetak */
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

</body>

</html>

<?php

class Shell
{
    protected $harga = [
        'Shell Super' => 15420,
        'Shell V-Power' => 16130,
        'Shell V-Power Diesel' => 18310,
        'Shell V-Power Nitro' => 16510
    ];
    protected $jenis;
    protected $jumlah;
    protected $ppn = 0.1;

    public function __construct($jenis, $jumlah)
    {
        $this->jenis = $jenis;
        $this->jumlah = $jumlah;
    }

    public function hitungTotal()
    {
        if (array_key_exists($this->jenis, $this->harga)) {
            $total = $this->harga[$this->jenis] * $this->jumlah;
            $total += $total * $this->ppn; // PPN ditambahkan setelah menghitung total harga
            return $total;
        } else {
            return "Jenis bahan bakar tidak valid.";
        }
    }

    public function hargaPerLiter()
    {
        if (array_key_exists($this->jenis, $this->harga)) {
            return $this->harga[$this->jenis];
        } else {
            return "Jenis bahan bakar tidak valid.";
        }
    }

    public function hargaDasar()
    {
        if (array_key_exists($this->jenis, $this->harga)) {
            return $this->harga[$this->jenis] * $this->jumlah; // Harga tanpa PPN
        } else {
            return "Jenis bahan bakar tidak valid.";
        }
    }

    public function PPN()
    {
        $hargaDasar = $this->hargaDasar();
        if (is_numeric($hargaDasar)) {
            return $hargaDasar * $this->ppn; // Menghitung PPN dari harga dasar
        } else {
            return "Jenis bahan bakar tidak valid.";
        }
    }
}

class Pembelian extends Shell
{
    public function buktiTransaksi()
    {
        $totalHarga = $this->hitungTotal();
        $hargaPerLiter = $this->hargaPerLiter();
        $hargaDasar = $this->hargaDasar();
        $ppn = $this->PPN();

        if (is_numeric($totalHarga)) {
            return "<div class='c-l'><div class='container-logic'><h2>Bukti Transaksi Pembelian</h2>
            <p>Jenis Bahan Bakar :" . $this->jenis . "</p>
            <p>Jumlah Liter : " . number_format($this->jumlah, 0, ',', '.') . "</p>
            <p>Harga per liter: Rp. " . number_format($hargaPerLiter, 0, ',', '.') . "</p>
            <p>Harga dasar (sebelum PPN): Rp. " . number_format($hargaDasar, 0, ',', '.') . " </p>
            <p>PPN (10%): Rp. " . number_format($ppn, 0, ',', '.') . " </p>
            <div class='result'>Total yang harus dibayarkan: Rp. " . number_format($totalHarga, 0, ',', '.') . " </div>
            <a href='index.php' class='no-print '><button>Kembali</button></a>
            <a href='#' class='no-print'><button onclick='window.print()'>Cetak To Pdf</button></a>
            </div></div>";
        } else {
            return $totalHarga;
        }
    }
}    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenisBahanBakar = $_POST['jenisBahanBakar'];
    $jumlah = $_POST['inputJumlah'];

    $pembelian = new Pembelian($jenisBahanBakar, $jumlah);
    $transaksi = $pembelian->buktiTransaksi();
    echo $transaksi;
}

?>