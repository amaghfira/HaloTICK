<h1 class="h3 mb-2 text-gray-800">Tickets List</h1>
<br>
<?php
// Display Response
if (session()->has('pesan')) {
?>
    <div class="alert <?= session()->getFlashdata('alert-class') ?>">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php
}
?>
<?php
// Display Response
if (session()->has('pesan_add_tiket')) {
?>
    <div class="alert <?= session()->getFlashdata('alert-class') ?>">
        <?= session()->getFlashdata('pesan_add_tiket'); ?>
    </div>
<?php
}
?>
<!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">My Tickets</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table table-bordered" id="ticket-lists">
                <thead>
                    <tr style="text-align: center;">
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tickets) : ?>
                        <?php foreach ($tickets as $ticket) : ?>
                            <tr>
                                <td><?php echo $ticket['title']; ?></td>
                                <td><?php echo $ticket['content']; ?></td>
                                <td><?php echo $ticket['author_name']; ?></td>
                                <td><?php echo $ticket['created_at']; ?></td>
                                <td><?php echo $ticket['updated_at']; ?></td>
                                <td><?php echo $ticket['nama_status']; ?></td>
                                <td style="text-align: center;"><a href="<?= base_url('tiket/view/' . $ticket['id']); ?>" class="btn btn-info btn-sm btn-view">View</a> <a href="<?= base_url('tiket/show/' . $ticket['id']); ?>" class="btn btn-success btn-sm btn-edit">Edit</a> <a href="<?= base_url('tiket/delete/' . $ticket['id']); ?>" class="btn btn-danger btn-sm btn-delete" data-id="">Hapus</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#ticket-lists').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });
    });
</script>
</body>

</html>