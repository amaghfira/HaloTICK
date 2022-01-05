<div class="row">
  <h2>Dashboard</h2>
</div>
<hr>
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?= $total_ticket->tot; ?></h3>

        <p>Total Tickets</p>
      </div>
      <div class="icon">
        <i class="fa fa-globe"></i>
      </div>
      <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?= $opened_ticket->tot; ?><sup style="font-size: 20px"></sup></h3>

        <p>Opened Tickets</p>
      </div>
      <div class="icon">
        <i class="fas fa-folder-open"></i>
      </div>
      <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?= $pending_ticket->tot; ?></h3>

        <p>Pending Tickets</p>
      </div>
      <div class="icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?= $closed_ticket->tot; ?></h3>

        <p>Closed Tickets</p>
      </div>
      <div class="icon">
        <i class="fas fa-door-closed"></i>
      </div>
      <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <!-- ./col -->