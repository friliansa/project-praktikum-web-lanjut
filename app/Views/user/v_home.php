<?= $this->include('user/layout/header') ?>
<?= $this->include('user/layout/navbar') ?>
<?= $this->include('user/layout/sidebar') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <!-- <?php foreach ($product_category as $cat) : ?>
            <div class="row">
                <h3 class="card-title"><?= $cat['name']; ?></h3>
                <div class="col-md-12 grid-margin">
                    <div class="d-flex flex-row flex-nowrap overflow-auto">
                        <?php foreach ($products as $prod) : ?>
                            <a class="mx-3" href="/product/detail">
                                <div class="card" style="width: 10rem;">
                                    <img src="<?= base_url('assets/images/product-placeholder.svg') ?>" class="card-img-top" alt="placeholder">
                                    <div class="card-body" style="text-decoration:none;">
                                        <h6 class="card-title"><?= $prod['name']; ?></h6>
                                        <h5 class="my-3 mx-1"><?= 'Rp' . $prod['price']; ?></h5>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div> -->
    <?php endforeach; ?>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <?php foreach ($product as  $key => $value) { ?>
                <div class="d-flex flex-row flex-nowrap overflow-auto">
                    <a class="mx-3" href="/product/detail/<?= $value['product_id'] ?>">
                        <div class="card" style="width: 10rem;">
                            <img src="<?= base_url('assets/images/product-placeholder.svg') ?>" class="card-img-top" alt="placeholder">
                            <div class="card-body" style="text-decoration:none;">
                                <h6 class="card-title"><?= $value['name']; ?></h6>
                                <h5 class="my-3 mx-1"><?= number_to_currency($value['price'], 'IDR') ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>

    <!-- content-wrapper ends -->
    <?= $this->include('user/layout/footer_comment') ?>
    <?= $this->include('user/layout/footer') ?>