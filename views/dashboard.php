<?php 
  include '../common/header.php';
 ?>

<body>
    <div class="main-wrapper">
    <?php include('../common/topbar.php');?>

  <div class="content-container">
    <div class="content-wrapper">
    <?php 
      include "../common/sidenav.php"
    ?>
    <div class="main-page">
      <div class="container-fluid bg-light pt-3">
      <div class="mt-2 pb-2 mb-3 border-bottom">
        <span class="fs-5 mt-2"><strong>Dashboard</strong></span><span class="small ms-3">Statistics Overview</span>
      </div>
      <div class="p-2 card bg-muted text-secondary">
        <span><i class="fa-solid fa-gauge-high"></i> Dashboard</span>
      </div>
      <div class="alert alert-primary alert-dismissable fade show mt-3 d-flex justify-content-between" role="alert">
        <div>
          <strong><i class="fa-solid fa-info-circle"></i> Child Abuse System</strong> For Keeping records of children and thier abuse
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="Close"></button>
      </div>
    
    <div class="row mt-2">
        <div class="col-md-3">
          <div class="pane card bg-primary text-light">
            <div class="row p-2">
            <div class="col">
                <i class="fa-solid fa-comments bg-icon"></i>
            </div>
            <div class="col">
              <div class="counter d-flex justify-content-end" id="children_count">0</div>
              <div class="d-flex justify-content-end">Children</div>
          </div>
          </div>
          <div class="view-details pt-1">
            <div class="tab-bottom px-2">
              <small class="text-primary mt-2">View Details</small>
              <small class="text-primary justify-content-end"><i class="fa-solid fa-circle-arrow-right"></i></small>
            </div>
          </div>
          </div>
        </div>


        <div class="col-md-3">
          <div class="pane card bg-success text-light">
            <div class="row p-2">
            <div class="col">
                <i class="fa-solid fa-server bg-icon"></i>
            </div>
            <div class="col">
              <div class="counter d-flex justify-content-end" id="abuse_count">0</div>
              <div class="d-flex justify-content-end">Abuses</div>
          </div>
          </div>
          <div class="view-details pt-1">
            <div class="tab-bottom px-2">
              <small class="text-success mt-2">View Details</small>
              <small class="text-success justify-content-end"><i class="fa-solid fa-circle-arrow-right"></i></small>
            </div>
          </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="pane card bg-warning text-light">
            <div class="row p-2">
            <div class="col">
                <i class="fa-solid fa-cart-shopping bg-icon"></i>
            </div>
            <div class="col">
              <div class="counter d-flex justify-content-end" id="pending_cases">0</div>
              <div class="d-flex justify-content-end">Cases</div>
          </div>
          </div>
          <div class="view-details pt-1">
            <div class="tab-bottom px-2">
              <small class="text-warning mt-2">View Details</small>
              <small class="text-warning justify-content-end"><i class="fa-solid fa-circle-arrow-right"></i></small>
            </div>
          </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="pane card bg-danger text-light">
            <div class="row p-2">
            <div class="col">
                <i class="fa-solid fa-hands-holding-child bg-icon"></i>
            </div>
            <div class="col">
              <div class="counter d-flex justify-content-end" id="resolved_cases">0</div>
              <div class="d-flex justify-content-end">Resolved</div>
          </div>
          </div>
          <div class="view-details pt-1">
            <div class="tab-bottom px-2">
              <small class="text-danger mt-2">View Details</small>
              <small class="text-danger justify-content-end"><i class="fa-solid fa-circle-arrow-right"></i></small>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="mt-3 bg-muted px-2 d-flex justify-content-center fs-5 mb-2">
        List of Cases
      </div>
      <div class="form-control pt-2">
        <table id="abuses-table" class="small table table-striped table-bordered mb-3" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Date</th>
          <th>Abuse ID</th>
          <th>Type of Abuse</th>
          <th>Abuser Name</th>
          <th>Reporter</th>
          <th>Reported to</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
      </div>
      </div>
      </div>
    </div>
  </div>
<?php 
  include "../common/footer.php"
 ?>

 <script type="text/javascript">
   countChildren();
   countAbuses();
   const data = {'request_id': 'get_abuse_records', 'flag':1};
        loadAbuses($("#abuses-table"), data);
</script>
 </script>