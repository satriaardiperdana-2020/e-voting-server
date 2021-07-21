<div class="container">
    <div class="row">
      <div class="col-md-12 mb-2 card">
        <div class="card-body">
          <?php if (!empty(session()->getFlashdata('error'))) : ?>
              <div class="alert alert-danger" role="alert">
                  <?php echo session()->getFlashdata('error'); ?>
              </div>
          <?php endif; ?>
          <h1>Update Calon</h1>
          <form method="post" action="<?=base_url();?>/admin/calon/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$calon['id_calon']?>">
            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" value="<?=$calon['nik'];?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?=$calon['nama'];?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Motto</label>
                <input type="text" name="motto" class="form-control" value="<?=$calon['motto'];?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" id="" class="form-control" cols="10" rows="10"><?=$calon['alamat'];?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                  <option value="Laki-Laki" <?=($calon['jenis_kelamin']=='Laki-Laki'?'selected':'')?>>Laki-Laki</option>
                  <option value="Perempuan" <?=($calon['jenis_kelamin']=='Perempuan'?'selected':'')?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?=$calon['tempat_lahir'];?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?=$calon['tanggal_lahir'];?>">
            </div>
            <div class="mb-3">
                <img src="<?=base_url();?>/uploads/foto/<?=$calon['foto']?>" class="img-fluid" style="max-height:200px">
            </div>
            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>