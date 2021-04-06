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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) { ?>
                <tr class="d-none">
                    <td><input type="radio" name="timber_id" value="<?= $product->id ?>" /></td>
                    <td><?= $product->id ?></td>
                    <td><?= $product->title ?></td>
                    <td><?= $product->description ?></td>
                    <td><?= $product->price ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="row d-flex p-0 m-0 ml-2 mb-2">
        <button class="btn home-btn btn-warning mr-2" formaction="<?= APP_URL ?>/actions/edit/timber-edit.php">Edit</button>
        <button class="btn home-btn btn-danger mr-2" formaction="<?= APP_URL ?>/actions/delete/timber-delete.php">Delete</button>
    </div>
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