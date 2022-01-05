<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users List</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#addModal">Add users</button>
            <div class="table-responsive">
                <table class="table data-table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($users) : ?>
                            <?php foreach ($users as $b) : ?>
                                <tr>
                                    <td><?= $b['id']; ?></td>
                                    <td><?= $b['firstname']; ?></td>
                                    <td><?= $b['lastname']; ?></td>
                                    <td><?= $b['email']; ?></td>
                                    <td><?= $b['username']; ?></td>
                                    <td style="text-align:center"><a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $b['id'] ?>" data-firstname="<?= $b['firstname']; ?>" data-lastname="<?= $b['lastname'] ?>" data-email="<?= $b['email']; ?>">Edit</a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $b['id'] ?>">Delete</a>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add users-->
<form action="<?= base_url() ?>/users/add" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="" required>
                    </div>
                    The default password is : 123456 <br>Please change your password later.
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
<form action="<?= base_url() ?>/users/edit" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control firstname" name="firstname" placeholder="">
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control lastname" name="lastname" placeholder="">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control email" name="email" placeholder="">
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
<form action="<?= base_url(); ?>/users/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Are you sure you'll delete the data?</h4>

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
            const firstname = $(this).data('firstname');
            const lastname = $(this).data('lastname');
            const email = $(this).data('email');

            // Set data to Form Edit
            $('.id').val(id);
            $('.firstname').val(firstname);
            $('.lastname').val(lastname);
            $('.email').val(email);
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