<?php

use SRPWn\Literal;
use SRPWn\Definitions;

require_once __DIR__ . '/lib/Def.php';
require_once __DIR__ . '/lib/Literal.php';
var_dump($_POST);
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

<body>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <?php include_once "components/sidebar.php" ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <?php include_once "components/header.php" ?>
      <div class="container-fluid">
        <form method="post" action="search.php" onsubmit="return validateForm()">
          <div class="col-lg-8 offset-2 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="#">Wordnet</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Domeni</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Relacije</a>
                  </li>
                </ul>
              </div>
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
                <div class="row justify-content-center">
                  <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="input-group form-group mt-3">
                      <input type="text" class="form-control" name="literal" required placeholder=" Unesite željenu reč ili frazu">
                    </div>
                    <div class="py-6 px-6 text-left">
                      <h6 class="fw-semibold mb-0">Odaberite domen za pretragu: </h6>
                    </div>
                    <div>
                      <input id="ad_Checkbox1" class="ads_Checkbox" type="checkbox" value="1" checked />Literali
                      <input id="ad_Checkbox2" class="ads_Checkbox" type="checkbox" value="2" />Definicije
                      <input id="ad_Checkbox3" class="ads_Checkbox" type="checkbox" value="3" />Domeni
                      <input id="ad_Checkbox4" class="ads_Checkbox" type="checkbox" value="4" />Upotreba
                    </div>
                    <div class="form-group mt-3">
                      <input type="submit" id="save_value" name="save_value" class="btn bg-secondary float-end text-white w-100" value="Pretraga" name="search-btn">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Sinsetovi</h5>
              <?php
              $i = 0;
              foreach ($literals as $literal) {
                $lit = $literal['Literal'];
                $id = $literal['ID'];
                $def = $literal['Def'];
                $aut = $literal['Autor'];
                $dom = $literal['Domain'];
                $i += 1;
                echo "
              <div class='card overflow-hidden rounded-2'>
                <div class='card-body'>
                <div class='card-header'>
                <div class='table-responsive'>
                  <table class='table text-nowrap mb-0 align-middle'>
                    <thead class='text-dark fs-4'>
                      <tr>
                        <th class='border-bottom-0'>
                          <h6 class='fw-semibold mb-0'>ID:$id</h6>
                        </th>
                        <th class='border-bottom-0'>
                          <h6 class='fw-semibold mb-0'>POS: </h6>
                        </th>
                        <th class='border-bottom-0'>
                          <h6 class='fw-semibold mb-0'>BCS: </h6>
                        </th>
                        <th class='border-bottom-0'>
                          <h6 class='fw-semibold mb-0'>$aut</h6>
                        </th>
                        <th class='border-bottom-0'>
                          <h6 class='fw-semibold mb-0'>Datum</h6>
                        </th>
                      </tr>
                    </thead>
                  </table>
                </div>
                </div>
                <ul>
                  <li><h6 class='text-primary d-block fw-semibold'>$i. " . ucfirst($lit) . "</h6>
                    <ul>
                    <li>Definicija: $def</li>
                    </ul>
                  </li>
                </ul>
                </div>
              </div>";
              } ?>
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
    i = 0;
    $('#save_value').click(function() {
      var arr = [];
      $('.ads_Checkbox:checked').each(function() {
        arr[i++] = $(this).val();
      });
      const data = arr.serialize();
      $.post('/submit-form', data, function(response) {
        // Display success message and reset form
        alert('Form submitted successfully!');
        $('#my-form')[0].reset();
        validate();
      });
      alert("Your selected options are: " + arr.join(","));
      console.log(data);
    });
  </script>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>
<div class='col-lg-8 align-items-stretch'>
  <div class="table-responsive">

    </html>