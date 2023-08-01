<?php
include_once 'include/dbconfig.php';
require_once 'include/db_operations.php';

session_start();
if (! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location: login.php");
    exit;
}


$clients = getClients();
$stats = getStats();
$options='<option value="" style="background-color: white;color: black">N/A</option>
        <option value="Y" style="background-color: white;color: black">Y</option>
        <option value="N" style="background-color: white;color: black">N</option>
        <option value="P" style="background-color: white;color: black">P</option>
        <option value="R" style="background-color: white;color: black">R</option>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>New Client Onboarding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="AdvisorsTech - New Client Onboarding" name="description"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="include/images/favicon.ico">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="include/css/daterangepicker.css">

    <!-- Vector Map css -->
    <link rel="stylesheet" href="include/css/jquery-jvectormap-1.2.2.css">

    <!-- Theme Config Js -->
    <script src="include/js/config.js"></script>

    <!-- App css -->
    <link href="include/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

    <!-- Icons css -->
    <link href="include/css/icons.min.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<!-- Begin page -->
<div id="wrapper">


    <!-- ========== Topbar Start ========== -->
    <div class="navbar-custom">
        <div class="topbar container-fluid">
            <div class="d-flex align-items-center">

                <!-- Brand Logo Light -->
                <a href="index.html" class="logo logo-light">
                        <span class="logo-lg">
                            <img src="include/images/logo-light.png" alt="logo">
                        </span>
                    <span class="logo-sm">
                            <img src="include/images/logo-sm.png" alt="small logo">
                        </span>
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.html" class="logo logo-dark">
                        <span class="logo-lg">
                            <img src="include/images/logo-dark.png" alt="dark logo">
                        </span>
                    <span class="logo-sm">
                            <img src="include/images/logo-sm.png" alt="small logo">
                        </span>
                </a>
                <h2 class="text-light" id="selected_client_name">&nbsp;</h2>
            </div>
            <ul class="topbar-menu d-flex align-items-center gap-1">
                <li class="d-none d-sm-inline-block pe-2">
                    <a class="nav-link ml-auto mr-1" href="logout.php"><button class="btn btn-success ">Logout</button></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ========== Topbar End ========== -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="row">
        <div class="leftside-menu col-md-4" style="padding: 30px">
            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div id="leftside-menu-container" data-simplebar>

                <label for="client"><h4 class="header-title mb-0"> Select Client</h4></label>
                <select id="client" name="client" class="form-select">
                    <option value=""></option>
                    <?php foreach ($clients as $client) { ?>
                        <option value="<?= $client['id']; ?>"><?= $client['name']; ?></option>
                    <?php } ?>
                </select>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="w-100">
                                <h5 class=" mt-0">Client Info</h5>
                            </div>
                            <i class="mdi mdi-account text-light display-3 float-end"></i>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-check">
                                <input type="checkbox" name="isPrimaryContact" id="isPrimaryContact"
                                       class="form-check-input" style="margin-left: 0rem">
                                <label class="form-check-label" for="isPrimaryContact">
                                    Primary Contact Info
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label for="companyId">Company ID</label>
                                <input type="text" disabled id="companyId" name="companyId" class="form-control">
                            </div>
                            <div class="col-md-7">
                                <label for="businessName"> Business Name</label>
                                <input type="text" name="businessName" id="businessName" class="form-control">
                            </div>
                            <div class="col-md-5"
                                 style="display: flex;flex-wrap: nowrap;align-items: center;justify-content: space-around;">
                                <label for="iar">
                                    <input type="checkbox" id="iar" name="iar" class="form-check-input">IAR</label>
                                <label for="noniar">
                                    <input type="checkbox" id="noniar" name="noniar"
                                           class="form-check-input">NON-IAR</label>
                            </div>
                            <div class="col-md-12">
                                <label for="streetAddress"> Street Address</label>
                                <input type="text" name="streetAddress" id="streetAddress" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="city"> City</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="state"> State</label>
                                <input type="text" name="state" id="state" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="zip"> Zip</label>
                                <input type="text" name="zip" id="zip" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="number_of_pcs"> # of PCs</label>
                                <input type="text" name="number_of_pcs" id="number_of_pcs" class="form-control">
                            </div>
                            <div class="col-md-9">
                                <label for="phone"> Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="number_of_macs"> # of MACs</label>
                                <input type="text" name="number_of_macs" id="number_of_macs" class="form-control">
                            </div>
                            <div class="col-md-9">
                                <label for="website"> Website</label>
                                <input type="text" name="website" id="website" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="number_of_employees"> # of Emp.</label>
                                <input type="text" name="number_of_employees" id="number_of_employees"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="w-100">
                                <h5 class=" mt-0">Primary Point of Contact</h5>
                            </div>
                            <i class="mdi mdi-account text-light display-3 float-end"></i>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname"> First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="primary_contact_phone">Phone #</label>
                                <input type="text" name="primary_contact_phone" id="primary_contact_phone"
                                       class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="primary_contact_email">Email</label>
                                <input type="text" name="primary_contact_email" id="primary_contact_email"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-grid">

                            <input type="button" class="btn btn-soft-info mb-2" value="Create Client Dir">

                            <input type="button" class="btn btn-soft-info mb-2" value="Create ConnectWise Customer">

                            <input type="button" class="btn btn-soft-info mb-2" value="Created New Project - IAR">

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="w-100">
                                <h5 class=" mt-0">Mimecast Implementation Complete</h5>
                            </div>
                            <i class="mdi mdi-text-box-check text-light display-3 float-end"></i>
                        </div>
                        <div class="d-grid">

                            <input type="button" class="btn btn-soft-success mb-2"
                                   value="Mimecast Implementation Complete">

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="w-100">
                                <h5 class=" mt-0">Onboarding Complete</h5>
                            </div>
                            <i class="mdi mdi-text-box-check text-light display-3 float-end"></i>
                        </div>
                        <div class="d-grid">

                            <input type="button" class="btn btn-soft-success mb-2" value="Onboarding Complete NON-IAR">
                            <input type="button" class="btn btn-soft-success mb-2" value="Onboarding Complete IAR">

                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="col-md-8">
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">

                                    <h4 class="page-title">IAR Onboarding Status Count</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-purple shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-bar-chart-line- font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['complete'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">Complete</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-info shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-users font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['inFlight'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">In Flight</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-pink shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-shuffle font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['backlog'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">Back Log</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-success shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-download font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['iarTotal'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">Total</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">

                                    <h4 class="page-title">NON-IAR Onboarding Status Count</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-purple shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-bar-chart-line- font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['noniarComplete'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">Complete</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-info shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-users font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['noniarInFlight'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">In Flight</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-pink shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-shuffle font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['noniarBacklog'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">Back Log</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="widget-rounded-circle card bg-success shadow-none">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-light">
                                                    <i class="fe-download font-28 avatar-title text-white"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <h2 class="text-white mt-2"><span
                                                                data-plugin="counterup"><?= $stats['noniarTotal'] ?></span>
                                                    </h2>
                                                    <p class="text-white mb-0 text-truncate">Total</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row" style="width: 100%">
                                            <div class="col-lg-6">
                                                <label for="onboarding_status" class="col-10 col-form-label-sm">Onboarding Status</label>
                                                <select class="form-control-sm color-change" name="onboarding_status"
                                                        id="onboarding_status" style="width: 100%;padding: 0px;text-align: center">
                                                    <option value=""></option>
                                                    <option value="In Flight">In Flight</option>
                                                    <option value="Complete">Complete</option>
                                                    <option value="Backlog">Backlog</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="onboarding_type" class="col-10 col-form-label-sm">Onboarding Type</label>
                                                <select class="form-control-sm color-change" name="onboarding_type"
                                                        id="onboarding_type" style="width: 100%;padding: 0px;text-align: center">
                                                    <option value=""></option>
                                                    <option value="IAR">IAR</option>
                                                    <option value="NON-IAR">NON-IAR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Onboarding Progress</h4>
                                        <div class="row" style="width: 100%">
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <label for="welcome_email" class="col-10 col-form-label-sm">Welcome
                                                        Email Sent</label>
                                                    <div class="col-2" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="welcome_email"
                                                                id="welcome_email" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="project_created" class="col-9 col-form-label-sm">Project Created</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="project_created"
                                                                id="project_created" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="domain_access" class="col-9 col-form-label-sm">Domain Access</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="domain_access"
                                                                id="domain_access" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="m365_licenses" class="col-9 col-form-label-sm">M365 E3 Licenses</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="m365_licenses"
                                                                id="m365_licenses" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <label for="mimecast_implementation" class="col-10 col-form-label-sm">Mimecast Implementation</label>
                                                    <div class="col-2" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="mimecast_implementation"
                                                                id="mimecast_implementation" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2" style="width: 100%">
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <label for="connectwise" class="col-10 col-form-label-sm">Customer In ConnectWise</label>
                                                    <div class="col-2" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="connectwise"
                                                                id="connectwise" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="ITGlue" class="col-9 col-form-label-sm">Documents in ITGlue</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="ITGlue"
                                                                id="ITGlue" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="rmm_agent" class="col-9 col-form-label-sm">RMM Agent Installed</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="rmm_agent"
                                                                id="rmm_agent" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="email_migration" class="col-9 col-form-label-sm">Email Migration</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="email_migration"
                                                                id="email_migration" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <label for="pc_encryption" class="col-10 col-form-label-sm">PC Encryption</label>
                                                    <div class="col-2" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="pc_encryption"
                                                                id="pc_encryption" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2" style="width: 100%">
                                            <div class="col-lg-3">
                                                <div class="row">
                                                    <label for="finra_setup" class="col-10 col-form-label-sm">M368 FINRA Setup</label>
                                                    <div class="col-2" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="finra_setup"
                                                                id="finra_setup" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="network_scan" class="col-9 col-form-label-sm">Network Scan</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="network_scan"
                                                                id="network_scan" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="row">
                                                    <label for="swag_box" class="col-9 col-form-label-sm">Swag Box</label>
                                                    <div class="col-3" style="padding: 0px">
                                                        <select class="form-control-sm color-change" name="swag_box"
                                                                id="swag_box" style="width: 100%;padding: 0px;text-align: center">
                                                            <?php echo $options;?>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5" style="display: flex;justify-content: flex-end">
                                                <input type="button" class="btn btn-soft-primary" value="Update Record" id="update_record">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
    </div>
</div>
<!-- END wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="include/js/bootstrap.min.js"></script>
<script>
    $('#client').on('change', function () {
        var clientId = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'include/get_client_info.php',
            data: {clientId: clientId},
            dataType: 'json',
            success: function (clientInfo) {
                $('#companyId').val(clientInfo.id);
                $('#businessName').val(clientInfo.name);
                $('#selected_client_name').html(clientInfo.name);
                $('#streetAddress').val(clientInfo.AddressLine1);
                $('#city').val(clientInfo.City);
                $('#state').val(clientInfo.State);
                $('#zip').val(clientInfo.Zip);
                $('#website').val(clientInfo.Website);
                $('#phone').val(clientInfo.PhoneNumber);
                $('#number_of_pcs').val(clientInfo.TotalPCs);
                $('#number_of_macs').val(clientInfo.TotalMacs);
                $('#number_of_employees').val(clientInfo.TotalEmployees);
                $('#onboarding_status').val(clientInfo.AdvisorsTechMSPStatus);
                $('#onboarding_type').val(clientInfo.OnboardingType);
                $('#welcome_email').val(clientInfo.InitialEmailSent);
                $('#welcome_email').trigger('change');
                $('#project_created').val(clientInfo.CWProjectCreated);
                $('#project_created').trigger('change');
                $('#domain_access').val(clientInfo.DomainAccess);
                $('#domain_access').trigger('change');
                $('#m365_licenses').val(clientInfo.M365E3);
                $('#m365_licenses').trigger('change');
                $('#mimecast_implementation').val(clientInfo.Mimecast);
                $('#mimecast_implementation').trigger('change');
                $('#connectwise').val(clientInfo.CompanyinCW);
                $('#connectwise').trigger('change');
                $('#ITGlue').val(clientInfo.InfoinITGlue);
                $('#ITGlue').trigger('change');
                $('#rmm_agent').val(clientInfo.AgentInstall);
                $('#rmm_agent').trigger('change');
                $('#email_migration').val(clientInfo.MailMirgration);
                $('#email_migration').trigger('change');
                $('#pc_encryption').val(clientInfo.PCEncryption);
                $('#pc_encryption').trigger('change');
                $('#finra_setup').val(clientInfo.M365FINRA);
                $('#finra_setup').trigger('change');
                $('#network_scan').val(clientInfo.NetworkScan);
                $('#network_scan').trigger('change');
                $('#swag_box').val(clientInfo.SwagBox);
                $('#swag_box').trigger('change');


            },
            error: function () {
                console.error('Error fetching client info');
            }
        });
    });

    $('#update_record').on('click', function () {
        var id = $('#companyId').val();
        var name=$('#businessName').val();
        var AddressLine1=$('#streetAddress').val();
        var City=$('#city').val();
        var State=$('#state').val();
        var Zip=$('#zip').val();
        var Website=$('#website').val();
        var PhoneNumber=$('#phone').val();
        var InitialEmailSent=$('#welcome_email').val();
        var CWProjectCreated=$('#project_created').val();
        var DomainAccess=$('#domain_access').val();
        var M365E3=$('#m365_licenses').val();
        var Mimecast=$('#mimecast_implementation').val();
        var CompanyinCW=$('#connectwise').val();
        var InfoinITGlue=$('#ITGlue').val();
        var AgentInstall=$('#rmm_agent').val();
        var MailMirgration=$('#email_migration').val();
        var PCEncryption=$('#pc_encryption').val();
        var M365FINRA=$('#finra_setup').val();
        var NetworkScan=$('#network_scan').val();
        var SwagBox=$('#swag_box').val();
        var OnboardingType=$('#onboarding_type').val();
        var AdvisorsTechMSPStatus=$('#onboarding_status').val();
        var TotalPCs=$('#number_of_pcs').val();
        var TotalMacs=$('#number_of_macs').val();
        var TotalEmployees=$('#number_of_employees').val();
        $.ajax({
            type: 'POST',
            url: 'include/update_onboarding_progress.php',
            data: {id: id,
                name:name,
                AddressLine1:AddressLine1,
                City:City,
                State:State,
                Zip:Zip,
                PhoneNumber:PhoneNumber,
                Website:Website,
            InitialEmailSent:InitialEmailSent,
            CWProjectCreated:CWProjectCreated,
            DomainAccess:DomainAccess,
            M365E3:M365E3,
            Mimecast:Mimecast,
            CompanyinCW:CompanyinCW,
            InfoinITGlue:InfoinITGlue,
            AgentInstall:AgentInstall,
            MailMirgration:MailMirgration,
            PCEncryption:PCEncryption,
            M365FINRA:M365FINRA,
            NetworkScan:NetworkScan,
            SwagBox:SwagBox,
            OnboardingType:OnboardingType,
            AdvisorsTechMSPStatus:AdvisorsTechMSPStatus,
            TotalPCs:TotalPCs,
            TotalMacs:TotalMacs,
            TotalEmployees:TotalEmployees},
            dataType: 'json',
            success: function (msg) {
                alert(msg);
            },
            error: function () {
                console.error('Error updating onboarding progress');
            }
        });
    });
    $('.color-change').on('change', function () {
        let email=$(this).val();
        switch (email){
            case '':
                $(this).css("background-color", "blue");
                $(this).css("color", "white");
                break;
            case 'Y':
                $(this).css("background-color", "green");
                $(this).css("color", "white");
                break;
            case 'N':
                $(this).css("background-color", "red");
                $(this).css("color", "white");
                break;
            case 'P':
                $(this).css("background-color", "yellow");
                $(this).css("color", "black");
                break;
            case 'R':
                $(this).css("background-color", "orange");
                $(this).css("color", "white");
                break;
        }
    });
</script>
</body>

</html>