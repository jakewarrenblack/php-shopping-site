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
            <th>Id</th>
            <th>Species</th>
            <th>description</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) { ?>
            <tr class="d-none">
                <td><?= $product->id ?></td>
                <td><?= $product->title ?></td>
                <td><?= $product->description ?></td>
                <td><?= $product->price ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
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