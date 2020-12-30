<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">
      <div class="col-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class='fa fa-plus'></i> Add Barang Form</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="submitForm" >
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label class="col-form-label">BarangType</label>
                    <select class="form-control" name="barangType" id="barangType">
                    <option value="">Pilih Type Barang</option>
                    <?php foreach ($datajenisbarang as $key): ?> 
                      <option value="<?php echo $key->jenisId ?>"><?php echo $key->name ?></option>
                    <?php endforeach ?>
                    </select>
                  </div>   
                  <div class="form-group">
                    <label class="col-form-label">Barang Name</label>
                    <select class="form-control" name="barangName" id="barangName"> 
                    <option value="">Pilih Nama Barang</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">BarangCode</label>
                    <input readonly type="text" class="form-control" name="barangCode" id="barangCode" value="" placeholder="Kode Barang">
                    
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Satuan</label>
                    <select class="form-control" name="satuan" id="satuan">
                    <?php foreach ($datasatuan as $key): ?> 
                      <option value="<?php echo $key->satuanId ?>"><?php echo $key->satuanName ?></option>
                    <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label class="col-form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description" require>
                  </div>
                  <div class="form-group row">
                    <label id="lebelmutu" class="col-sm-12 col-form-label">Mutu</label>
                    <select class="col-sm-3 form-control" name="mutu1" id="mutu1" onChange="tesajax()">
                      <option value="">Pilih Mutu</option>
                      <option value="K">K</option>
                      <option value="FC">FC</option>
                      <option value="FS">FS</option>
                      <option value="CLASS">CLASS</option>
                    </select>
                    <input type="text" class="col-sm-9 form-control" id="mutu2" name="mutu2" placeholder="Mutu">
                  </div>
                  <div class="form-group">
                    <label id="lebelangkaMutu" class="col-form-label">angkaMutu</label>
                    <input onkeypress="return hanyaAngka(event)" type="text" class="form-control" name="angkaMutu" id="angkaMutu" placeholder="Inputkan angka">
                  </div>
                  <div class="form-group">
                    <label id="labelslump" class="col-form-label">Slump</label>
                    <input type="text" class="form-control" name="slump" id="slump" placeholder="Slump">
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="<?=base_url('Setting/Barang')?>" type="button" class="btn btn-default">Back to List</a>
              <button type="submit" class="btn btn-success float-right">Submit</button>
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
    $.validator.setDefaults({
      submitHandler: function () {
        var formData = new FormData(document.getElementById('submitForm'));
        $.ajax({
          type: "POST",
          url: "<?=base_url('Setting/Barang/AddBarangProcess')?>",// where you wanna post
          data: formData,
          processData: false,
          contentType: false,
          error: function(jqXHR, textStatus, errorMessage) {
            alert(errorMessage); // Optional
          },
          success: function(data) { 
            if (data=="TAMBAH DATA SUCCESS") {
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
        password: {
          required: true,
          minlength: 5
        }
      },
      messages: {
        barangName: {
          required: "Please enter a barangname"
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

  $('#barangType').change(function(){
        var tampil = document.getElementById("barangType").value;
        if(tampil!="6"){
          document.getElementById("mutu1").style.visibility='hidden';
          document.getElementById("mutu2").style.visibility='hidden';
          document.getElementById("lebelmutu").style.visibility='hidden';
          document.getElementById("angkaMutu").style.visibility='hidden';
          document.getElementById("lebelangkaMutu").style.visibility='hidden';
          document.getElementById("slump").style.visibility='hidden';
          document.getElementById("labelslump").style.visibility='hidden';
        }else{
          document.getElementById("mutu1").style.visibility='visible';
          document.getElementById("mutu2").style.visibility='visible';
          document.getElementById("lebelmutu").style.visibility='visible';
          document.getElementById("angkaMutu").style.visibility='visible';
          document.getElementById("lebelangkaMutu").style.visibility='visible';
          document.getElementById("slump").style.visibility='visible';
          document.getElementById("labelslump").style.visibility='visible';
        }
        var jenis = $(this).val();
        //alert(jenis)
        $.ajax({
          type: "GET",
          url: "<?=base_url('Setting/Barang/GetDetailBarang')?>",// where you wanna post
          data: "jenisId="+jenis,
          processData: false,
          error: function(jqXHR, textStatus, errorMessage) {
            alert(errorMessage); // Optional
          },
          success: function(data) { 
            $("#barangName").html(data);
          } 
        });
   });

   $('#barangName').change(function(){
        
        var barang = $(this).val();
        //alert(detail)
        $.ajax({
          type: "GET",
          url: "<?=base_url('Setting/Barang/GetCodeBarang')?>",// where you wanna post
          data: "barangName="+barang,
          processData: false,
          error: function(jqXHR, textStatus, errorMessage) {
            alert(errorMessage); // Optional
          },
          success: function(data) { 
            $("#barangCode").val(data);
          } 
        });
   });

  function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
          return false;
        return true;
  };

  
</script>
  
