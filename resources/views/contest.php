<link rel="stylesheet" href="<?= base_url()?>assets/plugins/datatables/dataTables.bootstrap4.css">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contest</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contest</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Contest List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#<?= trans('id') ?></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Caption</th>
                    <th>Author</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($all_contest as $row): ?>
                  <tr>
                    <td><?= ++$i; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['category']; ?></td>
                    <td><?= $row['caption']; ?></td>
                    <td><?= $row['author']; ?></td>
                    <td><?php echo date_time($row['created_at']); ?></td>
                    <td><input class="tgl_checkbox tgl-ios" data-id=<?= $row['id'] ?> id="cb_<?=$row['id'] ?>" type="checkbox" <?= ($row['status'] == 1)? 'checked': ''; ?>><label for="cb_<?= $row['id'] ?>"></label></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- DataTables -->
<script src="<?= base_url()?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  });

  $("body").on("change",".tgl_checkbox",function(){
    // console.log('checked');
    $.post('<?=base_url("admin/extras/change_status")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
      id : $(this).data('id'),
      status : $(this).is(':checked') == true?1:0
    },
    function(data){
      $.notify("Status Changed Successfully", "success");
    });
  });
</script>
</body>
</html>
