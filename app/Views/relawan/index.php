<?= $this->extend('template') ?>

<?= $this->section('style') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row pb-1">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h3 class="ff-secondary fw-semibold text-capitalize lh-base">Data <span class="text-danger">Relawan</span></h3>
          <div class="page-title-right">
              <ol class="breadcrumb m-0">
                
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
        <table id="pemilih" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
            <thead class="table-light">
              <tr>
                <th>NIK</th>
                <th>NKK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Relawan</th>
                <th>Alamat</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
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

    var table = new DataTable('#pemilih', {
                processing: true,
                serverSide: true,
                ajax: {
                url: '<?= site_url('relawan/getdata')?>',
                method: 'POST'
                },
                columns: [
                {data: 'nik'},
                {data: 'nkk'},
                {data: 'nama'},
                {data: 'jenis_kelamin'},
                {data: 'jenis'},
                {data: 'id_wilayah'},
                {data: 'action', orderable: false},
                ]
            });

    $('#addform').submit(function() {
        $(this).ajaxSubmit({
          success: function(responseText, statusText, xhr, $form){
            alert(responseText.message);
            if(responseText.status == 'success'){
                table.ajax.reload(null, false);
                $('#addmodal').modal('hide');
            }
          }
        });
        return false;
    });
});

function add()
{
    // Clear Form
    $('#addmodal').modal('show');
}
</script>
<?= $this->endSection() ?>
