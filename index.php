<!DOCTYPE html>
<html>
    <head>
        <title>Knapsack Problem Solver</title>
        <link href='css/form.css' rel='stylesheet' type='text/css'>
    </head>
    <body>
    <!-- form for uploading appropriate CSV file -->
        <div class="main">
        <div class="first">
        <h2>Solve your "Knapsack problem" </h2>
        </br>
        <p id="bold">Please complete form which you can find under this text</p>
        <hr>
        <form action="show.php" method="POST">
            <p>Below is a list where you can choose a method</p>
            <select name="method">
                <option value="dynamic">dynamic programming</option>
            </select>
            <p>Determine the maximum weight capacity of Knapsack</p>
            <input type="number" name="maxWeight" placeholder="Type the weight" required/>
            <p>Select CSV File (CSV file must have in first column item id, next column item weight and third item value)</p>
            <input type="file" name="file" placeholder="Choose your csv file" required/>
            <input id='btn' name="submit" type='submit' value='Submit'>
        </form>
        </div>
        </div>
    </body>
</html>
