<!-- Stretching Modal -->
<div class="modal fade" id="stretchingModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="stretchingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 display-5" id="stretchingModalLabel">Stretching - Select intensity to begin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="GET" action="./service.php">

                    <?php

                    $service_instruction_types = getServiceInstructionTypes(3);

                    foreach ($service_instruction_types as $service_type) { ?>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="radio" name="service-type" id="stretching-<?= $service_type["service_type"] ?>" 
                                value="<?= $service_type["service_type"] ?>" <?php if($service_type["service_type"] == "Active") { echo "checked";} ?>>
                            <label class="form-check-label" for="stretching-<?= $service_type["service_type"] ?>">
                                <?= $service_type["service_type"] ?>
                            </label>
                        </div>

                    <?php } ?>

                    <div>
                        <input type="hidden" name="service_id" value="3">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Select</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>