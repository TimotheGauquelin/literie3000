<?php
$offsetpage = 0;

function offsetpagination($param)
{
    return $param + 1;
}

$dsn = "mysql:host=localhost;dbname=literie";
$db = new PDO($dsn, "root", "");


$query = $db->query("SELECT * FROM lit LIMIT 4 OFFSET $offsetpage");
$lits = $query->fetchAll();


include("templates/header.php");
?>

<main>
    <div class="container">
        <table class="table table-striped m-2">
            <thead>
                <tr class="bg-dark">
                    <th colspan="5" class="text-white text-center"><u>Catalogue</u></th>
                </tr>
                <tr>
                    <th scope="col" class="text-center">Photo</th>
                    <th scope="col" class="text-center">Marque</th>
                    <th scope="col" class="text-center">Nom/Taille</th>
                    <th scope="col" class="text-center">Ancien & Nouveau Prix</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>

            <?php
            foreach ($lits as $lit) {
                $promotion =  round($lit["prix"] - ($lit["prix"] * ($lit["promotion"] / 100)));
            ?>

                <tbody>
                    <tr>
                        <td><img src="assets/<?= $lit["nom"] ?>.jpg" alt=""></td>
                        <td><?= strtoupper($lit["marque"]) ?></td>
                        <td>
                            <p>Matelas <strong><?= ucfirst($lit["nom"]) ?></strong></p>
                            <p><?= $lit["largeur"] . "x" .  $lit["longueur"] ?></p>
                        </td>
                        <td>
                            <div>
                                <p><del> <?= $lit["prix"] ?>€</del></p>
                                <p class="text-danger"><strong><?= $promotion ?>€</strong></p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <a class="btn btn-dark m-1" href="./deletebed.php?nomLit=<?= $lit["nom"] ?>" onclick="post">Supprimer l'article</a>
                                <a class="btn btn-dark m-1" href="./updatebed.php?nomLit=<?= $lit["nom"] ?>" onclick="post">Modifier l'article</a>
                            </div>
                        </td>
                    </tr>
                </tbody>

            <?php
            }
            ?>

        </table>

        <nav class="navpag" aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item page-link btn">Précédent</li>
                <li class="page-item page-link btn">1</li>
                <li class="page-item page-link btn">2</li>
                <li class="page-item page-link btn">3</li>
                <li class="page-item page-link btn" onclick="<?= offsetpagination($offsetpage) ?>">Prochain</li>
            </ul>
        </nav>

        <strong>Vous y découvrirez toutes nos dimensions :</strong>
        <p>90x190, 140x190, 160x200, 180x200, 200x200</p>

    </div>

</main>

<?php
var_dump($offsetpage);
include("templates/footer.php")

?>