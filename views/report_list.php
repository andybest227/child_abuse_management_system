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
      <div class="container-fluid bg-light px-4 pb-5 pt-3">
      <div class="mt-2 pb-2 mb-3 border-bottom">
        <span class="fs-5 me-2"><b>Case Reports</b></span>| <span class="ms-2">List of cases reported</span>
      </div>
      <div class="p-2 mb-3 bg-light">
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addAbuseModal" data-bs-whatever="@mdo"><i class="fa fa-file-circle-plus"></i> Add Report</button>
      </div> 
    
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
        <th>Action</th>
      </tr>
    </thead>
  <tbody>
  </tbody>
</table>

<!-- VIEW ABUSE MODAL -->
<div class="modal fade" id="childAbuseModal" tabindex="-1" aria-labelledby="childAbuseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Abuse Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
        <tr>
          <th>Abuse ID:</th><td id="_abuse_id"></td>
        </tr>
        <tr>
          <th>Abuse Type:</th><td id="_abuse_type"></td>
        </tr>
        <tr>
          <th>Abuse:</th><td id="_abuse"></td>
        </tr>
        <tr>
          <th>Abuser' Name:</th><td id="_abuser"></td>
        </tr>
        <tr>
          <th>Abuser Address:</th><td id="_abuser_address"></td>
        </tr>
        <tr>
          <th>Abuser Phone:</th><td id="_abuser_phone"></td>
        </tr>
        <tr>
          <th>Abuser Email</th><td id="_abuser_email"></td>
        </tr>
        <tr>
          <th>Abuser State</th><td id="_abuser_state"></td>
        </tr>
        <tr>
          <th>Abuser Country</th><td id="_abuser_country"></td>
        </tr>
        <tr>
          <th>Reporter</th><td id="_reporter"></td>
        </tr>
        <tr>
          <th>Reported to</th><td id="_reported_to"></td>
        </tr>
        <tr>
          <th>Status</th><td id="_status"></td>
        </tr>
        <tr>
          <th>Date Recorded</th><td id="_created_at"></td>
        </tr>
      </table>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
  <!-- END OF VIEW ABUSE MODAL -->

</div>
</div>
</div>
</div>
<?php 
  include "../common/footer.php"
 ?>
 <script type="text/javascript">
  loadAbusesTypes();
  const data = {'request_id': 'get_abuse_records', 'flag':2};
        loadAbuses($("#abuses-table"), data);
</script>