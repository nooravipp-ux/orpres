<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('css\style.css') }}" media="all" /> -->
    <style>
        @page {
            size: 7in 9.25in;
            margin: 27mm 16mm 27mm 16mm;
        }

        hr {
            margin-bottom: 1rem;
            border: 1;
            border-top: 2px solid black;
        }

        * {
            box-sizing: border-box;
            font-size: 20px;
            padding-left: 10px;
            padding-right: 10px;
        }

        /* Create three equal columns that floats next to each other */
        .col {
            float: left;
            padding-left: 50px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* table#data,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        } */

        table.center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <title>CETAK BAST</title>
</head>

<body>
    <div class="container-fluid">
        <div class="header">
            <div style="text-align: center;">
                <h4>PEMERINTAH KABUPATEN BANDUNG</h4>
                <h4>DINAS PEMUDA DAN OLAHRAGA</h4>
                <p>SOR Jalak Harupat Jl. Raya Soreang Cipatik Km. 4 Kutawaringin Soreang 40911</p>
                <p>Telp. (022) 5895643 e-mail: disporakabb@gmail.com</p>
            </div>
        </div>
        <hr>
        <div style="text-align: center;">
            <div>
                <h5>BERITA ACARA SERAH TERIMA </h5>
            </div>
            <div>
                <p> NOMOR:......../......../......../......../........ </p>
            </div>
        </div>
        <div class="row ml-2 mr-2">
            <div class="col-md-12">
                <p>Pada Hari ini ................Tanggal ..........Bulan ...........Tahun........... , kami yang bertanda tangan dibawah ini:</p>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>DR. H. MARLAN NIRSYAMSU</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>19660413 199512 1 001</td>
                    </tr>
                    <tr>
                        <td>Pangkat / Golongan</td>
                        <td>:</td>
                        <td>Pembina Utama Muda, IV/c</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>Kepala Dinas Pemuda dan Olahraga</td>
                    </tr>
                </table>
                <p>Untuk selanjutnya disebut <strong>PIHAK PERATAMA</strong>.</p>
                <table>
                    <tr>
                        <td>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
                <p>Untuk selanjutnya disebut <strong>PIHAK KEDUA</strong>.</p>
                <p>PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA berupa Alat - alat Olahraga dengan kondisi layak dipakai, dengan rincian sebagai berikut : </p>
                <table style="border: 1px solid black;border-collapse: collapse;width: 100%;">
                    <thead>
                        <tr style="border: 1px solid black;border-collapse: collapse;">
                            <th style="border: 1px solid black;border-collapse: collapse;">No</th>
                            <th style="border: 1px solid black;border-collapse: collapse;">NAMA ALAT OLAHRAGA</th>
                            <th style="border: 1px solid black;border-collapse: collapse;">PENERIMA</th>
                            <th style="border: 1px solid black;border-collapse: collapse;">JUMLAH (BUAH)</th>
                        </tr>
                    </thead>
                    <tbod>
                        <?php $i = 1; ?>
                        @foreach($details as $item)
                        <tr style="border: 1px solid black;border-collapse: collapse;">
                            <td style="border: 1px solid black;border-collapse: collapse; text-align: center;"><?php echo $i++ ?></td>
                            <td style="border: 1px solid black;border-collapse: collapse;">{{$item->nama_prasarana}}</td>
                            <td style="border: 1px solid black;border-collapse: collapse;">{{$item->lembaga_penerima}}</td>
                            <td style="border: 1px solid black;border-collapse: collapse;text-align: center;">{{$item->jumlah}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="">Demikian berita acara ini dibuat untuk dipergunakan sebagaimana mestinya</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table style="border-collapse: collapse;width: 100%;">
                    <tr>
                        <td><strong>PIHAK PERTAMA</strong></td>
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>PIHAK KEDUA</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><strong>Ketua Kecamatan</strong></td>
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><strong>DR.H.MARLAN NIRSYAMSU</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
