<?php

use BookWorms\Model\Timber;

$products = Timber::findAll();
$numProducts = count($products);
$pageSize = 10;
$numPages = ceil($numProducts / $pageSize);
?>
    <table class="table" id="table-products">
        <thead>
            <tr>
                <th>Species</th>
                <th>description</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) { ?>
                <tr class="d-none">
                    <td><?= $product->title ?></td>
                    <td><?= $product->description ?></td>
                    <td><?= $product->price ?></td>
                    <td><a href="<?= APP_URL ?>/views/admin/products/timber-edit.php?timber_id=<?= $product->id ?>"><i class="fas fa-pen"></i></a></td>
                    <td class="btn-product-delete" ><a  class="btn-product-delete" href="<?= APP_URL ?>/actions/delete/timber-delete.php?timber_id=<?= $product->id ?>"><i class="fas fa-trash"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="<?= APP_URL ?>/assets/js/script.js"></script>

<nav id="nav-products">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" data-page="previous">
                &laquo;
            </a>
        </li>
        <?php for ($i = 0; $i < $numPages; $i++) { ?>
            <li class="page-item">
                <a class="page-link" href="#" data-page="<?= $i + 1 ?>">
                    <?= $i + 1 ?>
                </a>
            </li>
        <?php } ?>
        <li class="page-item">
            <a class="page-link" href="#" data-page="next">
                &raquo;
            </a>
        </li>
    </ul>
</nav>