<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Laporan Voting</title>
</head>

<body>
  <div class="container">

    <h2>Laporan Voting</h2>

    <table border="1" width="100%" style="text-align:center;border-collapse: collapse;">
      <thead>
        <tr>
            <th style="min-width:250px">#</th>
            <th style="min-width:250px">NIK</th>
            <th style="min-width:250px">Nama</th>
            <th style="min-width:250px">Jenis Kelamin</th>
            <th style="min-width:250px">Tempat/Tanggal Lahir</th>
            <th style="min-width:250px">Foto</th>
            <th style="min-width:250px">Jumlah Suara</th>
        </tr>
      </thead>
      <tbody>
            <?php 
            $no = 1;
            usort($laporan, function($a, $b) {
            return $b['voting'] <=> $a['voting'];
            });
            foreach ($laporan as $lap){ ?>
            <tr>
                <th><?=$no?></th>
                <td><?=$lap['nik']?></td>
                <td><?=$lap['nama']?></td>
                <td><?=$lap['jenis_kelamin']?></td>
                <td><?=$lap['tempat_lahir']?>/<?=$lap['tanggal_lahir']?></td>
                <td><img src="<?=$lap['base64']?>" class="img-fluid" style="max-height:100px"></td>
                <td><?=$lap['voting']?></td>
            </tr>
            <?php
            $no++; 
            } ?>
      </tbody>
    </table>
  </div>
</body>

</html>