<?php
require '../includes/header.php';
?>
    <div class="container">
        <div class="form-container">
            <h2 class="mb-5">New Product</h2>

            <?php if (!empty($errors)): ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                        errorModal.show();
                    });
                </script>
            <?php endif; ?>

            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Product name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($name) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="description"><?= htmlspecialchars($description) ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" class="form-control" name="price" value="<?= htmlspecialchars($price) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Image Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="image" id="imageInput"
                               value=""
                               data-bs-toggle="tooltip" data-bs-placement="top"
                               title='For test cases, you can use "test" because the images are being taken from the images folder'>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Availability Date</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="availability_date" value="<?= htmlspecialchars($availability_date) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Is it in stock?</label>
                    <div class="col-sm-6">
                        <input type="checkbox" name="in_stock" <?= $in_stock ? 'checked' : '' ?>>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a href="./index.php" class="btn btn-primary" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Validation Errors</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($errors)): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                errorModal.show();
            });
        </script>
    <?php endif; ?>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Product added successfully!</p>
                </div>
                <div class="modal-footer">
                    <a href="create.php" class="btn btn-primary">Add More</a>
                    <a href="index.php" class="btn btn-secondary">Home</a>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var successModal = new bootstrap.Modal(document.getElementById("successModal"));
                successModal.show();
            });
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

<?php
require '../includes/footer.php';