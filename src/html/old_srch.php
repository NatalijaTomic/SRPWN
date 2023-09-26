<?php

use SRPWn\Literal;
use SRPWn\Definitions;

require_once __DIR__ . '/lib/Def.php';
require_once __DIR__ . '/lib/Literal.php';
$literal = new Literal();
$definition = new Definitions();
if (isset($_POST["searchtype"])) {
  $selectedButton = $_POST["searchtype"];
  switch ($selectedButton) {
    case '1':
      $literals = $literal->literalsSearch();
      break;
    case '2':
      $literals = $literal->definitionContains();
      break;
    case '3':
      $literals = $literal->definitionsSearch();
      break;
  }
} else $literals = $literal->Search();
/*if (!empty($_POST["search-btn"])) {
  $literals = $literal->definitionsSearch();
}else $literals = $definition->getDefinitions();*/
?>
<?php include_once "components/sidebar.php" ?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!--  Sidebar End -->
<!--  Main wrapper -->
<div class="body-wrapper">
  <!--  Header Start -->
  <header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
          <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)">
            <i class="ti ti-bell-ringing"></i>
            <div class="notification bg-primary rounded-circle"></div>
          </a>
        </li>
      </ul>
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <div class="message-body">
                <a href="./account_settings.php" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">Profil</p>
                </a>
                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-mail fs-6"></i>
                  <p class="mb-0 fs-3">Nalog</p>
                </a>
                <a href="./login.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Odjavite se</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!--  Header End -->
  <div class="container-fluid">
    <!--  Row 1 -->
    <!-- Yearly Breakup -->
    <div class="card overflow-hidden">
      <div class="container">
        <div class="section">
          <div class="container">
            <div class="row">
              <form method="post" action="search.php" onsubmit="return validateForm()">
                <div class="col-lg-8 d-flex align-items-strech">
                  <div class="card w-100">
                    <div class="card-body">
                      <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                          <h5 class="card-title fw-semibold">Pretraga</h5>
                        </div>
                        <div>
                          <select class="form-select">
                            <option value="1" checked>Srp WordNet</option>
                          </select>
                        </div>
                        <div class="col-lg-6 btn-group btn-group-toggle" id="tippretrage" data-toggle="buttons">
                          <label class="btn btn-secondary active">
                            <input type="radio" name="searchtype" id="rec" value="1" autocomplete="off"> Tačna fraza
                            <input type="radio" name="searchtype" id="pocinje" value="2" autocomplete="off"> Počinje sa
                            <input type="radio" name="searchtype" id="sadrzi" value="3" autocomplete="off"> Sadrži
                          </label>
                        </div></br>
                      </div>
                      <h6 class="fw-semibold mb-0">Odaberite domen za pretragu:</h6>
                      <div class="searchDom">
                        <input type="Checkbox" class="searchDom" id="literal" value="1" autocomplete="off" Checked> Literali
                        <input type="Checkbox" class="searchDom" id="def" value="2" autocomplete="off"> Definicije
                        <input type="Checkbox" class="searchDom" id="domain" value="3" autocomplete="off"> Domeni
                        <input type="Checkbox" class="searchDom" id="usage" value="4" autocomplete="off"> Upotreba
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                          <div class="input-group form-group mt-3">
                            <div class="bg-secondary rounded-start">
                              <span class="m-3"><i class="fas fa-key mt-2"></i></span>
                            </div>
                            <input type="text" class="form-control" name="literal" required placeholder=" Unesite željenu reč ili frazu">
                          </div>
                          <div class="form-group mt-3">
                            <input type="submit" class="btn bg-secondary float-end text-white w-100" value="Pretraga" name="search-btn">
                          </div>
                        </div>
                      </div>
              </form>
            </div>
          </div>
        </div>
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
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Autor</h6>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($literals as $literal) {
                $id = $literal['Literal'];
                $def = $literal['Def'];
                $aut = $literal['Autor'];
                $dom = $literal['Domain'];
                echo "
                      <tr>
                        <td class='border-bottom-0' class='has-children'>
                        <h6 class='fw-semibold mb-0'><div class='Literal'>$id</div></h6>
                        <table>
                        <tr>
                        <td class='border-bottom-0'>
                          <p class='mb-0 fw-normal'>Domen</p>
                        </td>
                        </tr>
                        </table>
                        </td>
                        <td class='border-bottom-0' class='has-children'>
                          <p class='mb-0 fw-normal'>$def</p>
                        <table>
                        <tr>
                        <td class='border-bottom-0'>
                          <p class='mb-0 fw-normal'>$dom</p>
                        </td>
                        </tr>
                        </table>
                        <td class='border-bottom-0'>
                          <p class='mb-0 fw-normal'>$aut</p>
                        </td>
                      </td>";
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
  </div>
</div>
</div>
</div>
<script>
  function validateForm() {
    var radioButtonChecked = false;
    var radioButtons = document.getElementsByName("searchtype");

    for (var i = 0; i < radioButtons.length; i++) {
      if (radioButtons[i].checked) {
        radioButtonChecked = true;
        break;
      }
    }

    if (!radioButtonChecked) {
      alert("Niste odabrali vrstu pretrage!");
      return false;
    }
  }
</script>
<script>
jQuery(function () {
    // Whenever any of these checkboxes is clicked
    $("input.searchDom").click(function () {
        // Loop all these checkboxes which are checked
        $("input.searchDom:checked").each(function(){
          $(this).val();
            // Use $(this).val() to get the Bike, Car etc.. value
        });
    })
});

</script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/dashboard.js"></script>
</body>

</html>