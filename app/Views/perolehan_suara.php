<div class="container">
    <div class="row">
      <div class="col-md-12 mb-2 card">
        <div class="card-body">
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
              <div class="alert alert-success" role="alert">
                  <?php echo session()->getFlashdata('success'); ?>
              </div>
          <?php endif; ?>
          <h1>Perolehan Suara</h1>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Foto</th>
                <th>Jumlah Suara</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              usort($perolehan_suara, function($a, $b) {
                return $b['voting'] <=> $a['voting'];
              });
              foreach ($perolehan_suara as $suara){ ?>
                <tr>
                  <th><?=$no?></th>
                  <td><?=$suara['nik']?></td>
                  <td><?=$suara['nama']?></td>
                  <td><img src="<?=base_url();?>/uploads/foto/<?=$suara['foto']?>" class="img-fluid" style="max-height:50px"></td>
                  <td><?=$suara['voting']?></td>
                </tr>
              <?php
              $no++; 
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>