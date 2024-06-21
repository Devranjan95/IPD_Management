<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Moon Hospital </title>
    <!-- plugins:css -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.css') }}"/> -->
    <!-- ***************DATATABLES FILES****************************** -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap5.css')}}">
    <!-- *************************************************************** -->
    <link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    <!-- *******************************MULTISELECT CDN********************************** -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS CDN (optional, for styling) -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- ***************************************************************************** -->
    <!-- ******************************************************************** -->
<!-- *************DATATABLES CDNS************************ -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css"> -->
<!-- ************************************************************ -->
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- endinject -->
    <link rel="icon"  type="image/png" href="{{asset('assets/previous/Hospyllum.svg')}}">
   
    <style>
      #preloader {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: #fff; /* You can change the background color */
    display: flex;
    justify-content: center;
    align-items: center;
  }
      .breadcrumb {
    border: 1px solid #fff;
    padding-left:2px
}
      .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
    cursor: default;
    padding-left: 12px;
    padding-right: 12px;
    font-size:12px
}
      .table thead{
            /* background-color: green;  */
           
        }
        #fluid{
          padding:40px;
        }
        .tables-wrapper{
          padding:40px;
        }
      .sidebar{
        background:#f0fff0;
      }
      .navbar .navbar-menu-wrapper{
        /* background:#f0fff0; */
        background:#ace1af
      }
      .navbar.headerLight .navbar-menu-wrapper, .navbar.headerLight .navbar-brand-wrapper {
        /* background:#f0fff0; */
        background:#d0f0c0
      }
      .navbar .navbar-brand-wrapper {
        background:#f0fff0;
      }
      .sidebar .nav:not(.sub-menu) > .nav-item:hover > .nav-link, .sidebar .nav:not(.sub-menu) > .nav-item:hover[aria-expanded=true] {
          background:#ace1af;
          color: #ace1af;
      }
      .sidebar .nav .nav-item .nav-link i.menu-arrow {
          color: #484848;
      }
      .sidebar .nav .nav-item .nav-link .menu-title {
        /* font-size: 15px; */
        font-weight:600;
        padding-left:15px
      }
      .navbar .navbar-brand-wrapper .navbar-brand img {
        height: 90px;
      }
      .sidebar .nav.sub-menu {
        background: #ace1af;
      }
      .sidebar .nav.sub-menu .nav-item .nav-link {
          font-weight: 600;
      }
      .sidebar .nav .nav-item .nav-link {
        padding: 12px 20px 12px 35px;
        color: #800020;
        font-weight: 400;
      }
      .sidebar .nav:not(.sub-menu) > .nav-item {
          margin-top: 15px;
      }
      .sidebar .nav:not(.sub-menu) > .nav-item > .nav-link[aria-expanded=true] {
          background: #ace1af;
      }
      .sidebar .nav .nav-item.active > .nav-link {
          background: #ace1af;
      }
      .navbar .navbar-menu-wrapper .navbar-nav .nav-item .welcome-text {
        color:#0c8781;  
        font-weight:500
      }
      .sidebar .nav:not(.sub-menu) {
        margin-top: 48px;
      }
      .img-xs {
        width: 60px;
        height: 60px;
      }
      .modal-header{
        background: #ace1af;
      }
      .headingcolor{
        color:#800020;  
        font-size:19px;
        font-weight:700
      }
      .page-link.active, .active > .page-link {
        z-index: 3;
        color: var(--bs-pagination-active-color);
        background-color: #48d1cc ;
        border-color: #48d1cc ;
      }
      .form-control, .typeahead, .tt-query, .tt-hint, .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single, .form-select {
        height: 2.4rem;
      }
      @media (min-width: 992px) {
        .sidebar-icon-only .sidebar {
          
          background: #f0fff0;
        }
          .sidebar-icon-only .navbar .navbar-brand-wrapper {
          background: #f0fff0;
        }
        
      }
      @media (max-width: 991px) {
        .navbar .navbar-menu-wrapper {
            height:97px;
            z-index:-1;
        }
      }
      
    </style>
  </head>
  <body class="with-welcome-text">
  <!-- <div id="preloader">
    <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading...">
  </div> -->
    <div class="container-scroller">
      <!-- <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
            <div class="ps-lg-3">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 fw-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/star-admin-pro/"><i class="ti-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="ti-close text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div> -->
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
              <img src="{{asset('assets/previous/Hospyllum.svg')}}" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
              <img src="{{asset('assets/previous/Hospyllum.svg')}}" alt="logo" width="50px"/>
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              <h1 class="welcome-text">Welcome, <span class="text-warning fw-bold">Devranjan</span></h1>
              <!-- <h3 class="welcome-sub-text">Your performance summary this week </h3> -->
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                    </div>
                  </a>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="{{asset('assets/images/faces/face8.jpg')}}" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="{{asset('assets/images/faces/face8.jpg')}}" alt="Profile image">
                  <p class="mb-1 mt-3 fw-semibold">Allen Moreno</p>
                  <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                </div>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a> -->
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <!-- <i class="mdi mdi-grid-large menu-icon"></i> -->
                <img class="mdi mdi-grid-large menu-icon" src="{{asset('assets/sf/dashboard.svg')}}" alt="" width="30px" height="30px">
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('registration')}}">
                <!-- <i class="mdi mdi-grid-large menu-icon"></i> -->
                <img class="mdi mdi-grid-large menu-icon" src="{{asset('assets/sf/registration1.svg')}}" alt=""  width="30px" height="30px">
                <span class="menu-title">Registration</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#mybilling" aria-expanded="false" aria-controls="ui-basic">
                
                <img class="mdi mdi-grid-large menu-icon" src="{{asset('assets/previous/bill.png')}}"  alt=""  width="30px" height="30px">
                <span class="menu-title">My Billings</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="mybilling">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{url('ipdbilling')}}">IPD Billings</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('billings')}}">Pathology Billings</a></li>
                </ul>
              </div>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <!-- <i class="mdi mdi-grid-large menu-icon"></i> -->
                <img class="mdi mdi-grid-large menu-icon" src="{{asset('assets/sf/user.svg')}}" alt=""  width="30px" height="30px">
                <span class="menu-title">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('masters')}}">
                <!-- <i class="mdi mdi-grid-large menu-icon"></i> -->
                <img class="mdi mdi-grid-large menu-icon" src="{{asset('assets/sf/lock.svg')}}" alt=""  width="30px" height="30px">
                <span class="menu-title">Masters</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
                
                <img class="mdi mdi-grid-large menu-icon" src="{{asset('assets/sf/report.svg')}}" alt=""  width="30px" height="30px">
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="reports">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{url('patientreport')}}">Patient Report</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('ipdreports')}}">IPD BIll Reports</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('pathologyreports')}}">Pathology Bill Reports</a></li>
                </ul>
              </div>
            </li> -->
            
            <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#masters" aria-expanded="false" aria-controls="ui-basic">
                <img class="mdi mdi-grid-large menu-icon" src="{{asset('assets/sf/lock.svg')}}" alt=""  width="30px" height="30px">
                <span class="menu-title">Masters</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="masters">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{url('floors')}}">Floors</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('blocks')}}">Blocks</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('amenities')}}">Amenities</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('cabintypes')}}">Cabin-Types</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('wardtypes')}}">Ward-Types</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('icutypes')}}">ICU-Types</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('cabins')}}">Cabins</a></li>
                </ul>
              </div>
            </li> -->
          </ul>
        </nav>
<!-- ******************************DELETE MODAL***************************** -->
                  <!-- Delete Confirmation Modal -->
<!-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-fw btn-success btn-sm" data-bs-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-rounded btn-fw btn-danger btn-sm" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-fw btn-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-rounded btn-fw btn-danger btn-sm" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

                <!-- ****************************************************************** -->
        <div class="main-panel">
          @yield('content')
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All rights reserved.</span>
            </div>
          </footer>
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- *************DATATABLE CDNS***************** -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script> -->
    <!-- ************************************************************************************ -->
<!-- ***********DATATABLE FILES******************************* -->
    <script src="{{asset('assets/js/jquery-3.6.4.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap5.js')}}"></script>
<!--***************************************************************************  -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/template.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    @yield('scripts')
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->

  </body>
</html>
<script>
 window.addEventListener('load', function() {
    var preloader = document.getElementById('preloader');
    preloader.style.display = 'none';
  });

new DataTable('.table');

function openUrl(url){
  var Url = url;
  var target = '__blank';
  window.open(Url,target);
}

let deleteUrl = '';

function deleteData(delurl) {
    deleteUrl = delurl;
    let myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    myModal.show();
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    $.ajax({
        url: deleteUrl,
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        type: "GET",
        dataType: "json",
        success: function (data) {
            alert(data.message);
            console.log(data);
            location.reload();
        },
        error: function() {
            console.log('Error during deletion');
        }
    });
});


function reload(){
            window.location.reload();
        }
// function deleteData(delurl){
//     //if(confirm("Are you very sure you want to delete this")){
//       let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteModal'));
//       myModal.show();
      
//       $.ajax({
//           url: delurl,
//           headers: { '_token': '{{csrf_token()}}' },
//           type: "get",
//           dataType: "json",
//           success: function (data) {
//             console.log(data);
//             location.reload();
//           },
//           error: function() {
//               return false;
//           }
//       });
//     }
  //}

</script>