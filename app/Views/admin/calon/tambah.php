<div class="container">
    <div class="row">
      <div class="col-md-12 mb-2 card">
        <div class="card-body">
          <?php if (!empty(session()->getFlashdata('error'))) : ?>
              <div class="alert alert-danger" role="alert">
                  <?php echo session()->getFlashdata('error'); ?>
              </div>
          <?php endif; ?>
          <h1>Tambah Calon</h1>
          <form method="post" action="<?=base_url();?>/admin/calon/save" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" value="<?=old('nik');?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?=old('nama');?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Motto</label>
                <input type="text" name="motto" class="form-control" value="<?=old('motto');?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" id="" class="form-control" cols="10" rows="10"><?=old('alamat');?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                  <option value="Laki-Laki" <?=(old('jenis_kelamin')=='Laki-Laki'?'selected':'')?>>Laki-Laki</option>
                  <option value="Perempuan" <?=(old('jenis_kelamin')=='Perempuan'?'selected':'')?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?=old('tempat_lahir');?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?=old('tanggal_lahir');?>">
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