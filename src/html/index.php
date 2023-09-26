<?php

use SRPWn\DataSource;
use SRPWn\Definitions;

require_once __DIR__ . '/lib/Def.php';
$definition = new Definitions();
$definitions = $definition->getDefinitions();
?>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
<?php include_once "components/sidebar.php" ?>
<!--  Sidebar End -->
<!--  Main wrapper -->
<div class="body-wrapper">
  <!--  Header Start -->
  <?php include_once "components/header.php" ?>
  <div class="container-fluid">
    <!--  Row 1 -->
    <!-- Yearly Breakup -->
    <div class="card overflow-hidden">
      <div class="container">
        <div class="section">
          <div class="container">
            <div class="row">
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12">
  <!-- Monthly Earnings -->
  <div class="card">
    <div class="card-body">
      <div class="row alig n-items-start">
        <div class="col-8">
          <h5 class="card-title mb-9 fw-semibold"> SrpWN </h5>
          <h4 class="fw-semibold mb-3">$6,820</h4>
          <div class="d-flex align-items-center pb-1">
            <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
              <i class="ti ti-arrow-down-right text-danger"></i>
            </span>
            <p class="text-dark me-1 fs-3 mb-0">+9%</p>
            <p class="fs-3 mb-0">last year</p>
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex justify-content-end">
            <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
              <i class="ti ti-currency-dollar fs-6"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="earning"></div>
  </div>
</div>
</div>
</div>
</div>
<div class="row">
  <div class="col-lg-4 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <div class="mb-4">
          <h5 class="card-title fw-semibold">Sinsetovi</h5>
        </div>
        <ul class="timeline-widget mb-0 position-relative mb-n5">
          <li class='timeline-item d-flex position-relative overflow-hidden'>
            <div class='timeline-time text-dark flex-shrink-0 text-end'>09:30</div>
            <div class='timeline-badge-wrap d-flex flex-column align-items-center'>
              <span class='timeline-badge border-2 border border-primary flex-shrink-0 my-8'></span>
              <span class='timeline-badge-border d-block flex-shrink-0'></span>
            </div>
            <div class='timeline-desc fs-3 text-dark mt-n1'></div>
          </li>
          <li class='timeline-item d-flex position-relative overflow-hidden'>
            <div class='timeline-time text-dark flex-shrink-0 text-end'></div>
            <div class='timeline-badge-wrap d-flex flex-column align-items-center'>
              <span class='timeline-badge border-2 border border-info flex-shrink-0 my-8'></span>
              <span class='timeline-badge-border d-block flex-shrink-0'></span>
            </div>
            <div class='timeline-desc fs-3 text-dark mt-n1 fw-semibold'>New sale recorded <a href='javascript:void(0)'
                class='text-primary d-block fw-normal'>#ML-3467</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-8 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Sinsetovi</h5>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Literal</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Definicija</h6>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                  foreach ($definitions as $definition) {
                    $literal = $definition['Literal'];
                    $def = $definition['Def'];
                    echo "
                      <tr>
                        <td class='border-bottom-0'><h6 class='fw-semibold mb-0'><div class='Literal'>".$literal."</div></h6></td>
                        <td class='border-bottom-0'>
                          <p class='mb-0 fw-normal'>".$def."</p>
                        </td>
                      </tr>";
                  } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
        class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a
        href="https://themewagon.com">ThemeWagon</a></p>
  </div>
</div>
</div>
</div>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/dashboard.js"></script>
</body>

</html>