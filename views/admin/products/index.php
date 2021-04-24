<?php

use BookWorms\Model\Timber;

$products = Timber::findAll();
$numProducts = count($products);
$pageSize = 10;
$numPages = ceil($numProducts / $pageSize);
?>
<form class="d-contents" method="get">
    <table class="table" id="table-products">
        <thead>
            <tr>
                <th>Id</th>
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
                    <td><input type="radio" name="timber_id" value="<?= $product->id ?>" /></td>
                    <td><?= $product->title ?></td>
                    <td><?= $product->description ?></td>
                    <td><?= $product->price ?></td>
                    <td><button formaction="<?= APP_URL ?>/views/admin/products/timber-edit.php"><i class="fas fa-pen"></i></button></td>
                    <td class="btn-product-delete" ><button  class="btn-product-delete" formaction="<?= APP_URL ?>/actions/delete/timber-delete.php"><i class="fas fa-trash"></i></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="<?= APP_URL ?>/assets/js/script.js"></script>
</form>

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