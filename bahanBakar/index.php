<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css">
    <title>Bahan Bakar</title>
</head>

<body>
    <div class="container">
        <h2>Pembelian Bahan Bakar</h2>
        <form action="logic.php" method="POST">
            <label for="jenisBahanBakar">Pilih Jenis Bahan Bakar:</label>
            <select name="jenisBahanBakar" id="jenisBahanBakar" required>
                <option value="" disabled hidden selected>Pilih Jenis Bahan Bakar</option>
                <option value="Shell Super">Shell Super</option>
                <option value="Shell V-Power">Shell V-Power</option>
                <option value="Shell V-Power Diesel">Shell V-Power Diesel</option>
                <option value="Shell V-Power Nitro">Shell V-Power Nitro</option>
            </select>

            <label for="inputJumlah">Jumlah Liter:</label>
            <input type="number" name="inputJumlah" id="inputJumlah" required>

            <button type="submit">Hitung</button>
        </form>

    </div>
</body>

</html>