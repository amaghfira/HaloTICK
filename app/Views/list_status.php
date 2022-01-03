<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Statuses List</h1>
    <p></p>
    <?php if (session()->has('hapus_berhasil')) : ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('hapus_berhasil') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('pesan_edit')) : ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('pesan_edit') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('pesan_add')) : ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('pesan_add') ?>
        </div>
    <?php endif; ?>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Statuses</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#addModal">Add Status</button>
            <div class="table-responsive">
                <table class="table data-table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($status) : ?>
                            <?php foreach ($status as $b) : ?>
                                <tr>
                                    <td><?= $b['id']; ?></td>
                                    <td><?= $b['name']; ?></td>
                                    <td><?= $b['color']; ?></td>
                                    <td style="text-align:center"><a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $b['id'] ?>" data-nama="<?= $b['name']; ?>" data-color="<?= $b['color'] ?>">Edit</a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $b['id'] ?>">Delete</a>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Status-->
<form action="<?= base_url() ?>/status/add" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status Name</label>
                        <input type="text" class="form-control" name="nama" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Status Color</label>
                        <input type="text" class="form-control" name="color" placeholder="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add User-->

<!-- Modal edit data -->
<form action="<?= base_url() ?>/status/edit" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Status Name</label>
                        <input type="text" class="form-control nama" name="nama" placeholder="">
                    </div>

                    <div class="form-group">
                        <label>Status Color</label>
                        <input type="text" class="form-control color" name="color" placeholder="">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal edit data  -->

<!--modal delete data-->
<!-- Modal Delete Product-->
<form action="<?= base_url(); ?>/status/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus status Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah anda yakin akan menghapus data?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->
<!--end modal delete data -->

<!-- SCRIPT MODAL -->
<script>
    $(document).ready(function() {
        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const color = $(this).data('color');

            // Set data to Form Edit
            $('.id').val(id);
            $('.color').val(color);
            $('.nama').val(nama);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form delete
            $('.id').val(id);
            // Call Modal delete
            $('#deleteModal').modal('show');
        });
    });
</script>

<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        var tabel = $('#dataTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });
    });
</script>