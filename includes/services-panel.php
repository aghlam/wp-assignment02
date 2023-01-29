<div class="container">
    <div class="row my-5">
        <h1 class="display-2">Services Available!</h1>
        <h2 class="display-6">Select from one of the services below to get started:</h2>
    </div>
    <div class="row text-center">

        <?php
        $services = getServices();
        // Images sourced from https://www.flaticon.com/
        foreach ($services as $service) { ?>
            <div class="col-3 p-3">
                <a href="" class="text-decoration-none" <?= getModal($service['service_id']) ?>>
                    <img class="img-fluid m-0" src="<?= $service['image_path']; ?>" alt="<?= $service['name'] . '-icon' ?>">
                    <h3 class="display-6 mt-2"><?= $service['name']; ?></h3>
                </a>
            </div>
        <?php } ?>
    </div>

    <!-- Service Modals -->
    <?php
    require_once("./includes/yoga-modal.php");
    require_once("./includes/meditation-modal.php");
    require_once("./includes/stretching-modal.php");
    require_once("./includes/healthy-habits-modal.php");
    ?>

</div>