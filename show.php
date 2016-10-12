<!DOCTYPE html>
<html>
    <head>
        <title>Results from solved Knapsack problem</title>
        <link href='css/form.css' rel='stylesheet' type='text/css'>
    </head>
    <body>

        <?php
        session_start();
        include_once "classes/backpack_class.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['maxWeight']) && isset($_POST['file'])){
                $method = $_POST['method'];
                if ($method == 'dynamic') {
                    $file = $_POST['file'];
                    $maxWeight = $_POST['maxWeight'];
                    $goods = new Backpack($file, $maxWeight);?>
                    <div class="main">
                    <div class="first">
                    <h2>Presented below are the solutions of Knapsack problem</h2></br>
                    <?php
                    echo '<p>' . 'Value of packed items: ' . $goods->showValue() . '</p>';
                    echo '<hr>';
                    echo '<p>' . "Weight of packed items: " . $goods->showWeight() . '</p>';
                    echo '<hr>';
                    ?><p><?php
                    echo '<p>' . "Items that have been packed to Knapsack: " . '<ul>';
                    foreach ($goods->showIds() as $item) {
                        echo '<li>' . $item . '</li>';
                    }?></ul></p>
                    </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>' . "There is lack of data or some of them are wrong" . '</p>';
            }
        }
        ?>
    </body>
</html>


<?php
//session_start();
//include_once "classes/backpack_class.php";
//
//if ($_SERVER['REQUEST_METHOD'] === 'POST'){
//    if(isset($_POST['maxWeight']) && isset($_POST['file'])){
//        $method = $_POST['method'];
//        if ($method == 'dynamic') {
//            $file = $_POST['file'];
//            $maxWeight = $_POST['maxWeight'];
//            $goods = new Backpack($file, $maxWeight);
//            echo 'Value of packed items: ' . $goods->showValue();
//            echo '<hr>';
//            echo '<p>' . "Weight of packed items: " . $goods->showWeight() . '</p>';
//            echo '<hr>';
//            ?><!--<p><ul>--><?php
//            echo "Items that have been packed to Knapsack: ";
//            foreach ($goods->showIds() as $item) {
//                echo '<li>' . $item . '</li>';
//            }?><!--</ul></p>-->
<!--            --><?php
//        }
//    } else {
//        echo '<p>' . "There is lack of data or some of them are wrong" . '</p>';
//    }
//} else {
//    echo "something wrong";
//}
//?>