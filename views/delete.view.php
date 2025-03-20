<?php require '../includes/header.php'; ?>

<div class="container">
    <div class="form-container">
        <h2 class="mb-4">Confirm Delete</h2>
        <p>Are you sure you want to delete <strong><?= htmlspecialchars($product['name']) ?></strong>?</p>

        <form method="post">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>
