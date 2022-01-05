<h1 class="h3 mb-2 text-gray-800">Create Ticket</h1>
<br>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Input Ticket Information Here</h6>
  </div>
  <div class="card-body">
    <form method="post" action="<?= base_url('tiket/add_new/'); ?>">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="" required>
      </div>
      <div class="form-group">
        <label for="content">Description</label>
        <textarea class="form-control" id="content" name="content" rows="3" value="" required></textarea>
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" id="category" name="category" required>
          <?php foreach ($categories as $cat) : ?>
            <option value=<?= $cat['id']; ?>><?= $cat['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="author_name">Name</label>
        <input type="text" class="form-control" id="author_name" name="author_name" value="<?= $nama; ?>" required>
      </div>
      <div class="form-group">
        <label for="author_email">Email</label>
        <input type="email" class="form-control" id="author_email" name="author_email" value="<?= $mail['email']; ?>" required>
      </div>
      <?php if (in_array($_SESSION['role'], $admin)) : ?>
        <div class="form-group">
          <label for="solver_name">Solver Name</label>
          <!-- <input type="text" class="form-control" id="solver_name" name="solver_name" placeholder="Masukkan nama yang memperbaiki disini" required> -->
          <select class="form-control" id="solver_name" name="solver_name" required>
            <?php if ($orang) : ?>
              <?php foreach ($orang as $org) : ?>
                <option value="<?= $org['firstname'] . ' ' . $org['lastname']; ?>"><?= $org['firstname'] . ' ' . $org['lastname']; ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
        </div>
      <?php else : ?>
        <input type="hidden" name="solver_name" id="solver_name" value="">
      <?php endif; ?>

      <button type="submit" class="btn btn-md btn-primary">Add Ticket</button>

    </form>

  </div>
</div>