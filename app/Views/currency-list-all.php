<?= $this->include('partials/main') ?>

<head>

    <?php echo view('partials/title-meta', array('title' => 'CRM')); ?>
    
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="/assets/libs/nouislider/nouislider.min.css">

    <!-- gridjs css -->
    <link rel="stylesheet" href="/assets/libs/gridjs/theme/mermaid.min.css">
    
    <?= $this->include('partials/head-css') ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>
        <?php

        use App\Models\CurrencyModel;    
        $currencyModel = new CurrencyModel();
        $currencies = $currencyModel->getConversions();
        //print_r($currencies);
        //exit();
        ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                        <?php /* ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0 flex-grow-1">Base Example</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div id="table-gridjs"></div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        <?php */ ?>
                    
                    <div class="row">
                        <div class="col-xxl-7">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-nowrap align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 30%;">Country</th>
                                                    <th scope="col" style="width: 10%;">Currency</th>
                                                    <th scope="col" style="width: 5%;">Currency Code</th>
                                                    <th scope="col" style="width: 20%;">Conversion Rate</th>
                                                    <th scope="col" style="width: 15%;">Date</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            <?php if (!empty($currencies)) : ?>
                                                <?php foreach ($currencies as $currency) : ?>    
                                                <tr>
                                                    <td><?= esc($currency['country']); ?></td>
                                                    <td><?= esc($currency['currency']); ?></td>
                                                    <td><?= esc($currency['currency_code']); ?></td>
                                                    <td><input type="text" name="conversion_rate" id="conversion_rate" value="<?= esc($currency['conversion_rate']); ?>" /></td>
                                                    <td><?= esc(substr($currency['conversion_date'],0,10)); ?></td>
                                                </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="5">No conversions found</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div><!-- end table responsive -->
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?= $this->include('partials/footer') ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <?= $this->include('partials/customizer') ?>

    <?= $this->include('partials/vendor-scripts') ?>

    <!-- apexcharts -->
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Dashboard init -->
    <script src="/assets/js/pages/dashboard-crm.init.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.js"></script>

    <!-- gridjs js -->
    <script src="/assets/libs/gridjs/gridjs.umd.js"></script>
    <!-- gridjs init -->
    <script src="/assets/js/pages/gridjs.init.js"></script>
</body>

</html>