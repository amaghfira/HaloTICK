<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Ticket</h6>
  </div>
  <div class="card-body">
    <form method="post" action="<?= base_url('tiket/edit/' . $ticket['id']); ?>">
      <div class="form-group">
        <label for="title">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $ticket['title']; ?>">
      </div>
      <div class="form-group">
        <label for="content">Deskripsi</label>
        <textarea class="form-control" id="content" name="content" rows="3" value="<?= $ticket['content']; ?>"><?= $ticket['content']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="created">Waktu Tiket Dibuat</label>
        <input type="datetime" class="form-control" id="created" name="created" value="<?= $ticket['created_at']; ?>" readonly>
      </div>
      <div class="form-group">
        <label for="status">Status Tiket</label>
        <?php if (in_array($_SESSION['role'], $admin)) : ?>
          <select class="form-control" id="status" name="status" value="<?= $ticket['status_id']; ?>">
            <option value="1">Open</option>
            <option value="2">Closed</option>
            <option value="3">Pending</option>
          </select>
        <?php endif;  ?>
        <?php if (!in_array($_SESSION['role'], $admin)) : ?>
          <input type="text" class="form-control" name="status" id="status" value="<?= $ticket['status_id'] ?>" readonly>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="author_name">Nama Pelapor</label>
        <input type="text" class="form-control" id="author_name" name="author_name" value="<?= $ticket['author_name']; ?>">
      </div>
      <div class="form-group">
        <label for="author_email">Email Pelapor</label>
        <input type="email" class="form-control" id="author_email" name="author_email" value="<?= $ticket['author_email']; ?>">
      </div>
      <div class="form-group">
        <label for="comment">Komentar</label>
        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Masukkan komentar atau solusi permasalahan disini"></textarea>
      </div>
      <?php if (in_array($_SESSION['role'], $admin)) : ?>
        <div class="form-group">
          <label for="solver_name">Nama yang Memperbaiki</label>
          <select class="form-control" id="solver_name" name="solver_name" required>
            <?php if ($orang) : ?>
              <?php foreach ($orang as $org) : ?>
                <option value="<?= $org['firstname'] . ' ' . $org['lastname']; ?>"><?= $org['firstname'] . ' ' . $org['lastname']; ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
      <?php endif; ?>
      <?php if (!in_array($_SESSION['role'], $admin)) : ?>
        <div class="form-group">
          <label for="solver_name">Nama yang Memperbaiki</label>
          <input type="text" class="form-control" id="solver_name" name="solver_name" placeholder="Masukkan nama yang memperbaiki disini" value="<?= $ticket['solver']; ?>" readonly>
        </div>
      <?php endif; ?>
      <button type="submit" class="w-100 btn btn-lg btn-primary">Update</button>

    </form>
  </div>
</div>