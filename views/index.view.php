<?php
require '../includes/header.php';
?>
    <div class="container">
        <div class="content-container">
            <h2>List of products</h2>
            <a class="btn btn-primary mb-3" href="/create.php" role="button">Add Product</a>

            <form method="GET" action="index.php" class="mb-3 d-flex align-items-center gap-3">
                <label for="limit">Show:</label>
                <select name="limit" id="limit" class="form-select d-inline-block w-auto">
                    <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                    <option value="15" <?= ($perPage == 15) ? 'selected' : '' ?>>15</option>
                    <option value="20" <?= ($perPage == 20) ? 'selected' : '' ?>>20</option>
                </select>
                <button type="submit" class="btn btn-primary">Apply</button>
            </form>

            <form method="GET" action="index.php" class="mb-3 d-flex flex-wrap gap-3">
                <input type="hidden" name="limit" value="<?= $perPage ?>">

                <label for="search" class="align-self-center">Search:</label>
                <input type="text" name="search" id="search" class="form-control d-inline-block w-auto"
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">

                <label for="sort" class="align-self-center">Sort by:</label>
                <select name="sort" id="sort" class="form-select d-inline-block w-auto">
                    <option value="" <?= empty($_GET['sort']) ? 'selected' : '' ?>>Default</option>
                    <option value="name_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : '' ?>>Name (A-Z)</option>
                    <option value="name_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') ? 'selected' : '' ?>>Name (Z-A)</option>
                    <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : '' ?>>Price (Low to High)</option>
                    <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : '' ?>>Price (High to Low)</option>
                </select>

                <button type="submit" class="btn btn-primary">Apply</button>
                <a href="index.php?limit=<?= $perPage ?>" class="btn btn-secondary">Reset</a>
            </form>

            <!-- Tabel produse -->
            <div class="table-responsive">
                <table class="table mt-3">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Availability date</th>
                        <th>In stock</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td><?= $product['price'] ?> RON</td>
                            <td><img src="/images/<?= htmlspecialchars($product['image']) ?>.png" width="50"></td>
                            <td><?= $product['availability_date'] ?></td>
                            <td><?= $product['in_stock'] ? 'Yes' : 'No' ?></td>
                            <td>
                                <div class="d-flex flex-wrap gap-2 justify-content-center">
                                    <a class="btn btn-primary btn-sm" href="edit.php?id=<?= $product['id'] ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm delete-btn" href="delete.php?id=<?= $product['id'] ?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginare -->
            <div class="pagination d-flex justify-content-center align-items-center mt-3">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&limit=<?= $perPage ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>&sort=<?= $_GET['sort'] ?? '' ?>"
                       class="btn btn-secondary me-2">← Back</a>
                <?php endif; ?>

                <span>Page <?= $page ?> of <?= $totalPages ?></span>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>&limit=<?= $perPage ?>&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>&sort=<?= $_GET['sort'] ?? '' ?>"
                       class="btn btn-secondary ms-2">Next →</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSuccessModalLabel">Product Deleted</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The product has been deleted successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

<?php if (isset($_GET['deleted'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteSuccessModal = new bootstrap.Modal(document.getElementById("deleteSuccessModal"));
            deleteSuccessModal.show();
        });
    </script>
<?php endif; ?>

<?php
require '../includes/footer.php';
