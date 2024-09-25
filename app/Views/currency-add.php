<?= $this->include('partials/main') ?>

<head>

    <?php echo view('partials/title-meta', array('title' => 'CRM')); ?>

    <?= $this->include('partials/head-css') ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?= $this->include('partials/menu') ?>
        <?php

        use App\Models\CurrencyModel; 
        use App\Models\CountryModel;    
        $currencyModel = new CurrencyModel();   
        $countryModel = new CountryModel();
        $countries = $countryModel->getCountries();
        //print_r($currencies);
        //exit();
        ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <?php if (session()->getFlashdata('message')): ?>
                                        <div class="alert alert-success">
                                            <?= session()->getFlashdata('message') ?>
                                        </div>
                                    <?php endif; ?>
                                    <form method="post" action="<?= base_url('currency/save') ?>">
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
                                            <?php if (!empty($countries)) : ?>
                                                <?php foreach ($countries as $country) : ?>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="country[]" value="<?= esc($country['country']); ?>" />
                                                            <?= esc($country['country']); ?>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="currency[]" value="<?= esc($country['currency']); ?>" />
                                                            <?= esc($country['currency']); ?>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="currency_code[]" value="<?= esc($country['currency_code']); ?>" />
                                                            <?= esc($country['currency_code']); ?>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="conversion_rate[]" value="<?= esc(isset($existingRates[$country['currency_code']]) ? $existingRates[$country['currency_code']] : ''); ?>" />
                                                        </td>
                                                        <td><?= date('Y-m-d'); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </td>
                                                    <td><?= date('Y-m-d'); ?></td>
                                                </tr>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="5">No conversions found</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </form>
                                        
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
</body>

</html>