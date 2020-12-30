<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">
      <div class="col-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class='fa fa-detail'></i> Detail Barang Form</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="submitForm" >
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="col-form-label">Barang Name</label>
                    <input type="text" readonly class="form-control" name="barangName" id="barangName" value="<?=$dataBarang->barangName?>" placeholder="Barang Name">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">BarangCode</label>
                    <input type="text" readonly class="form-control" name="barangCode" id="barangCode" value="<?=$dataBarang->barangCode?>" placeholder="Barang Code">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">BarangType</label>
                    <input type="text" readonly class="form-control" name="barangType" id="barangType" value="<?=$dataBarang->barangType?>" placeholder="Barang Type">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Satuan</label>
                    <input type="text" readonly class="form-control" name="satuan" id="satuan" value="<?=$dataBarang->satuan?>" placeholder="Satuan">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="col-form-label">Description</label>
                    <input type="text" readonly class="form-control" name="description" id="description" value="<?=$dataBarang->description?>" placeholder="Description">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Mutu</label>
                    <input type="text" readonly class="form-control" name="mutu" id="mutu" value="<?=$dataBarang->mutu?>" placeholder="Mutu">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">angkaMutu</label>
                    <input type="text" readonly class="form-control" name="angkaMutu" id="angkaMutu" value="<?=$dataBarang->angkaMutu?>" placeholder="angkaMutu">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Slump</label>
                    <input type="text" readonly class="form-control" name="slump" id="slump" value="<?=$dataBarang->slump?>" placeholder="Slump">
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="<?=base_url('Setting/Barang')?>" type="button" class="btn btn-default">Back to List</a>
              
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!--/. container-fluid -->
</div>
<!-- /.content -->

<!-- jquery-validation -->
<script src="<?=base_url('assets/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jquery-validation/additional-methods.min.js')?>"></script>

<script>
  $(function () {
    $('#barangname').val("<?=$dataBarang->barangName?>");
    $('#accountnumber').val("<?=$dataBarang->accountNumber?>");
    $('#accountname').val("<?=$dataBarang->accountName?>");

    $('#btn-change').click(function(){
      $('#btn-change').attr('hidden', true);
      $('#btn-reset').attr('hidden', false);
    });

    $('#btn-reset').click(function(){
      $('#btn-change').attr('hidden', false);
      $('#btn-reset').attr('hidden', true);
    });

    $.validator.setDefaults({
      submitHandler: function () {
        var formData = new FormData(document.getElementById('submitForm'));
        $.ajax({
          type: "POST",
          url: "<?=base_url('Setting/Barang/DetailBarangProcess')?>",// where you wanna post
          data: formData,
          processData: false,
          contentType: false,
          error: function(jqXHR, textStatus, errorMessage) {
            alert(errorMessage); // Optional
          },
          success: function(data) { 
            if (data=="SUCCESS") {
              alert(data)
              window.location.replace("<?=base_url('Setting/Barang')?>");
            } else {
              if (data=="SESSION_OVER") {
                alert("Your Session is Over! Please Login first!")
                window.location.replace("<?=base_url()?>");
              } else {
                alert(data)
                return false;
              }
            }
          } 
        });
      }
    });
    $('#submitForm').validate({
      rules: {
        barangName: {
          required: true
        },
        accountNumber: {
          required: true
        },
        accountName: {
          required: true
        }
      },
      messages: {
        barangName: {
          required: "Please enter a barang name"
        },
        accountNumber: {
          required: "Please enter a account number"
        },
        accountName: {
          required: "Please enter a account name"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
  
