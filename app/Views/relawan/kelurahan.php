<?= $this->extend('template') ?>

<?= $this->section('style') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row pb-1">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h3 class="ff-secondary fw-semibold text-capitalize lh-base">Data <span class="text-danger">Kelurahan</span></h3>
          <div class="page-title-right">
              <ol class="breadcrumb m-0">
                  <li><a href="<?= site_url('relawan/wilayah')?>" class="btn btn-sm btn-danger"><i class="ri-arrow-left-line"></i> Kembali</a></li>
              </ol>
          </div>
      </div>
  </div>
</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
        <thead class="table-light text-center">
              <tr>
                <th rowspan="2">Kelurahan</th>
                <th colspan="2">Koordinator</th>
                <th colspan="3">Jumlah Jaringan</th>
              </tr>
              <tr>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Jumlah Target</th>
                <th>Jumlah Terisi</th>
                <th>Progres</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($kelurahan as $row) {?>
                    <tr>
                        <td><a href="<?= site_url('relawan/kelurahan/'.$row->id_wilayah)?>"><?= $row->nama_wilayah?></a></td>
                        <td>
                          <?php if($row->nama){ ?>
                            <a href="javascript:;" onclick="detail(<?= $row->id?>)"><?= $row->nama?></a>
                          <?php }else{ ?>
                            <button type="button" class="btn btn-sm btn-outline-success" alt="Klik untuk menambah Korkel" onclick="addKorkel('<?= $row->id_wilayah?>')"><i class="ri-user-add-line align-middle"></i></button>
                          <?php } ?>
                        </td>
                        <td><?php if($row->nama){ ?>
                          <?= $row->no_hp?>
                        <?php }else{ ?>
                          -
                        <?php } ?></td>
                        <td><?= $row->jumlah_target?></td>
                        <td><?= $row->jumlah?></td>
                        <td>%</td>
                    </tr>
                <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="addmodal" class="modal fade" data-bs-backdrop="static" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Tambah Koordinator Kelurahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" action="<?= site_url('relawan/add')?>" method="post" id="addform">
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="nik" class="form-label">NIK</label>
                    </div>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="NIK" aria-describedby="button-addon2" name="nik" id="nik">
                            <button class="btn btn-outline-success" type="button" id="button-addon2" onclick="searchnik()">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="nkk" class="col-sm-3 col-form-label">No KK</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nkk" id="nkk" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" id="nama" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-3 col-form-label">Kecamatan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="kecamatan" id="kecamatan" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-3 col-form-label">Kelurahan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="kelurahan" id="kelurahan" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-3 col-form-label">RT/RW</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="rt" placeholder="RT">
                  </div>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="rw" placeholder="RW">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="nama" class="col-sm-3 col-form-label">No. HP</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="no_hp" value="">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-9">
                  <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                    <input type="hidden" name="jenis" value="korkel">
                    <input type="hidden" name="wilayah" id="wilayah">
                    <input type="hidden" name="tps_id" id="tps_id">
                    <input type="hidden" name="tps" id="tps">
                    <input type="hidden" name="alamat" id="alamat">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="$('#addform').submit()">Kirim</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>assets/js/jquery.form.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
            dropdownParent: $('#addmodal')
    });
});

function searchnik() {
  axios.get('<?= site_url() ?>ajax/searchnik/'+$('#nik').val())
  .then(function (response) {
    // handle success
    $('#nkk').val(response.data.nkk);
    $('#nama').val(response.data.nama);
    $('#kecamatan').val(response.data.kecamatan);
    $('#kelurahan').val(response.data.kelurahan);
    $('#jenis_kelamin').val(response.data.jenis_kelamin);
    $('#tps_id').val(response.data.tps_id);
    $('#tps').val(response.data.tps);
    $('#alamat').val(response.data.alamat);
  })
  .catch(function (error) {
    alert('Data tidak ditemukan');
  })
  .finally(function () {
    // always executed
  });
}

function addKorkel(id)
{
    // Clear Form
    $('#wilayah').val(id);
    $('#addmodal').modal('show');
}

function detail(id) {
  $('#detailRelawan').load('<?= site_url('ajax/getrelawan')?>/'+id);
  $('#detail').modal('show');
}
</script>
<?= $this->endSection() ?>
