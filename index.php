<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "sd inpres puar";
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("GAGAL TERHUBUNG");
}
$KODE = "";
$NIP = "";
$NAMA = "";
$GENDER = "";
$AGAMA = "";
$EMAIL = "";

$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'HAPUS'){
    $KODE   = $_GET['KODE'];
    $sql1   = "delete from guru where KODE = '$KODE'";
    $q1     = mysqli_query($koneksi, $sql1);
    if($q1){
        $sukses = "BERHASIL HAPUS";
    }else{
        $error = "GAGAL MENGHAPUS";
    }
}

if ($op == 'EDIT') {
    $KODE = $_GET['KODE'];
    $sql1 = "select*from guru where KODE = '$KODE'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $NIP = $r1['NIP'];
    $NAMA = $r1['NAMA'];
    $GENDER = $r1['GENDER'];
    $AGAMA = $r1['AGAMA'];
    $EMAIL = $r1['EMAIL'];

    if ($NIP == '') {
        $error = "DATA TIDAK DITEMUKAN";

    }
}


if (isset($_POST['submit'])) {
    $NIP = $_POST['NIP'];
    $NAMA = $_POST['NAMA'];
    $GENDER = $_POST['GENDER'];
    $AGAMA = $_POST['AGAMA'];
    $EMAIL = $_POST['EMAIL'];

    if ($NIP && $NAMA && $GENDER && $AGAMA && $EMAIL) {
        if ($op == 'EDIT') { //untuk update
            $sql1 = "update guru set NIP = '$NIP',NAMA='$NAMA',GENDER = '$GENDER',AGAMA='$AGAMA',EMAIL='$EMAIL' where KODE = '$KODE'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "DATA BERHASIL DIUPDATE";
            } else {
                $error = "DATA GAGAL DIUPDATE";
            }
        } else { //untuk insert
            $sql1 = "insert into guru(NIP,NAMA,GENDER,AGAMA,EMAIL) values('$NIP','$NAMA','$GENDER','$AGAMA','$EMAIL')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "BERHASIL INPUT DATA";
            } else {
                $error = "GAGAL INPUT DATA";
            }
        }

    } else {
        $error = " SILAHKAN INPUT KEMBALI";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA GURU SD INPRES PUAR 2024</title>
    <link rel="stylesheet" type="css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 900px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Input Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php
                        header("refresh:3;url=index.php");
                }
                ?>
                <?php
                if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                        header("refresh:3;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <form>
                        <div class="mb-3 row">
                            <label for="NIP" class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="bigint" class="form-control" id="NIP" name="NIP"
                                    value="<?php echo $NIP ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="NAMA" class="col-sm-2 col-form-label">NAMA</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="NAMA" name="NAMA"
                                    value="<?php echo $NAMA ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="GENDER" class="col-sm-2 col-form-label">GENDER</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="GENDER" id="GENDER">
                                    <option value="">-Pilih Gender-</option>
                                    <option value="LAKI-LAKI" <?php if ($GENDER == "LAKI-LAKI")
                                        echo "selected" ?>>LAKI-LAKI
                                        </option>
                                        <option value="PEREMPUAN" <?php if ($GENDER == "PEREMPUAN")
                                        echo "selected" ?>>PEREMPUAN
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="AGAMA" class="col-sm-2 col-form-label">AGAMA</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="AGAMA" id="AGAMA">
                                        <option value="">-Pilih Agama-</option>
                                        <option value="ISLAM" <?php if ($AGAMA == "ISLAM")
                                        echo "selected" ?>>ISLAM</option>
                                        <option value="KATHOLIK" <?php if ($AGAMA == "KATHOLIK")
                                        echo "selected" ?>>KATHOLIK
                                        </option>
                                        <option value="PROTESTAN" <?php if ($AGAMA == "PROTESTAN")
                                        echo "selected" ?>>PROTESTAN
                                        </option>
                                        <option value="HINDU" <?php if ($AGAMA == "HINDU")
                                        echo "selected" ?>>HINDU</option>
                                        <option value="BUDDHA" <?php if ($AGAMA == "BUDDHA")
                                        echo "selected" ?>>BUDDHA</option>
                                        <option value="KONGHUCU" <?php if ($AGAMA == "KONGHUCU")
                                        echo "selected" ?>>KONGHUCU
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="EMAIL" class="col-sm-2 col-form-label">EMAIL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="EMAIL" name="EMAIL"
                                        value="<?php echo $EMAIL ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="submit" value="SIMPAN" class="btn btn-primary">
                        </div>
                    </form>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Guru
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIP</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">GENDER</th>
                            <th scope="col">AGAMA</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2 = "select*from guru order by KODE desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $KODE = $r2['KODE'];
                            $NIP = $r2['NIP'];
                            $NAMA = $r2['NAMA'];
                            $GENDER = $r2['GENDER'];
                            $AGAMA = $r2['AGAMA'];
                            $EMAIL = $r2['EMAIL'];
                            ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <th scope="row"><?php echo $NIP ?></th>
                                <th scope="row"><?php echo $NAMA ?></th>
                                <th scope="row"><?php echo $GENDER ?></th>
                                <th scope="row"><?php echo $AGAMA ?></th>
                                <th scope="row"><?php echo $EMAIL ?></th>
                                <th scope="row">
                                    <a href="index.php?op=EDIT&KODE=<?php echo $KODE ?>"><button type="button" class="btn btn-warning">EDIT</button></a><br>
                                    <a href="index.php?op=HAPUS&KODE=<?php echo $KODE ?>" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA?')"><button type="button" class="btn btn-danger">HAPUS</button></a>
                                </th>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>