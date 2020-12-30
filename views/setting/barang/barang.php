
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div> -->
          <!-- /.card-header -->
          <div class="card-body">
            <table id="barangTable" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>BarangID</th>
                  <th>BarangType</th>
                  <th>BarangName</th>
                  <th>BarangCode</th>
                  <th>Description</th>
                  <th>CreatedBy</th>
                  <th>CreatedAt</th>
                  <th>UpdatedBy</th>
                  <th>UpdatedAt</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($listBarang==null) { ?>
                  <tr>
                    <td colspan="6">Data Not Found</td>
                  </tr>
                <?php } else { 
                  foreach ($listBarang as $row) {
                    echo "<tr>
                            <td >".urlLink($row->barangId, base_url('Setting/Barang/DetailBarang/'.encrypt($row->barangId)))."</td>
                            <td >".$row->name."</td>
                            <td >".$row->detailName."</td>
                            <td >".$row->barangCode."</td>
                            <td >".$row->description."</td>
                            <td >".$row->createdBy."</td>
                            <td >".changeDateFormat("webview", $row->createdAt)."</td>
                            <td >".$row->updatedBy."</td>
                            <td >".changeDateFormat("webview", $row->updatedAt)."</td>
                            <td >
                              <div class='btn-group'>
                                <a type='button' class='btn btn-primary' href='".base_url('Setting/Barang/EditBarang/'.encrypt($row->barangId))."'><i class='fa fa-edit'></i> Edit</a>
                              </div'>
                            </td>
                          </tr>";
                  }
                }
                
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!--/. container-fluid -->
</div>
<!-- /.content -->
<!-- <form action="delete.php" method="POST">
<div class="modal fade" id="modal-danger">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Anda yakin akan menghapus data ini &hellip;</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-light btn-confirm" >Delete</button>
      </div>
    </div>
    <!- /.modal-content -->
  <!-- </div> -->
  <!-- /.modal-dialog -->
<!-- </div> -->
<!-- </form> -->


<script>
  jQuery(document).ready(function() {     
    $("#barangTable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [
        {
          text: "<i class='fa fa-plus'></i> Add Barang",
          action: function ( e, dt, node, config ) {
              window.location.replace("<?=base_url('Setting/Barang/AddBarang')?>");
          },
          className: 'btn-info' 
        },
        { text: "<i class='fa fa-file'></i> To Excel", extend: 'excel', className: 'btn-sm btn-success' },
        { text: "<i class='fa fa-file'></i> To PDF", extend: 'pdf', className: 'btn-sm btn-danger' }
      ]
    }).buttons().container().appendTo('#barangTable_wrapper .col-md-6:eq(0)');
  });


  $(document).on( "click",".btn-delete", function() {
    $(".btn-confirm").attr('id', this.id)
  });

  // $(document).on( "click",".btn-confirm", function() {
  //   var value = {
  //       barangId: this.id
  //   };  
  //   $.ajax({
  //       url: "<?=base_url('Setting/Barang/DeletebarangProcess')?>",
  //       type: "POST",
  //       data : value,
  //       success: function(data) {
  //         if (data=="SUCCESS") {
  //           alert(data)
  //           window.location.replace("<?=base_url('Setting/Barang')?>");
  //         } else {
  //           if (data=="SESSION_OVER") {
  //             alert("Your Session is Over! Please Login first!")
  //             window.location.replace("<?=base_url()?>");
  //           } else {
  //             alert(data)
  //             return false;
  //           }
  //         }
  //       }          
  //   });
  // });
</script>

