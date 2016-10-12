<?php

class Backpack {
    public $file;
    public $maxWeight;


    function __construct($file,$maxWeight)
    {
        $this->setFile($file);
        $this->setMaxWeight($maxWeight);
    }
    
    public function getFile()
    {
        return $this->file;
    }
    
    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getMaxWeight()
    {
        return $this->maxWeight;
    }
    
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;
    }
    
    // Importing data from csv file to multidimensional array and removing first-legend line.
    public function readCsv()
    {
        $csv = $this->file;
        $items = array();

        foreach (file($csv) as $row){
            $items[] = str_getcsv($row, ';');
        }
        array_shift($items);
        return $items;
    }

    //Separating columns from two-dimensional array according to attributes stored inside column and change data to integers.
    public function separateItemsValues($key)
    {
        $singleColumn = array_column(self::readCsv(), $key);
        $singleArray = [];
        foreach ($singleColumn as $element){
            $singleArray[]=(int)$element;
        }
        return $singleArray;
    }

    //Creating array; used for estimation of the best solution; containing the possible connection between weight and item
    protected static function buildKnapsack($columns, $rows)
    {
        $knapsack = array();
        for ($x = 0; $x <= $columns; $x++)
        {
            $knapsack[$x] = array();
            for ($y = 0; $y <= $rows; $y++) {
                $knapsack[$x][$y] = array(
                    'value' => 0,
                    'take' => 0
                );
            }
        }
        return $knapsack;
    }

    //Creating array with values of items that can be pack to Knapsack and marking the chosen ones.
    public function tryToPack()
    {
        $maxWeight=intval($this->maxWeight);
        $itemsWeight =self::separateItemsValues(1);
        $itemsValue =self::separateItemsValues(2);
        $totalItems=count($itemsWeight);
        $knapsack = self::buildKnapsack($totalItems, $maxWeight);

        for ($item = 1; $item <=$totalItems; $item++) {
            $valueOfItem=$itemsValue[$item -1];
            $weightOfItem=$itemsWeight[$item -1];

            for ($capacity = 1; $capacity <= $maxWeight; $capacity++){
                if ($weightOfItem <= $capacity){
                    // Checking value of previous item at weight position equal max weight - current item weight
                    $addingPrevious = $knapsack[$item -1][$capacity - $weightOfItem]['value'];
                    // Fill up position taken in knapsack array with item which value've been taken
                    $addingPreviousAndMark = $knapsack[$item -1][$capacity - $weightOfItem]['take'];
                    // Using value of previous item at weight position equal to the current item weight
                    $usingPrevious = $knapsack[$item - 1][$capacity]['value'];
                    if ($valueOfItem + $addingPrevious > $usingPrevious){
                        $knapsack [$item][$capacity]['value']= $valueOfItem + $addingPrevious;
                        $knapsack [$item][$capacity]['take']= 1 + $addingPreviousAndMark;
                    } else {
                        $knapsack [$item][$capacity]['value'] = $usingPrevious;
                    }
                } else {
                    $knapsack [$item][$capacity]['value'] = $knapsack[$item - 1][$capacity]['value'];
                }
            }
        }
        return $knapsack;
    }

    //Preparing a list of items which have been packed to Knapsack
    public function packedKnapsack()
    {
        $myBag = self::tryToPack();
        $maxWeight=$this->maxWeight;
        $itemsWeight =self::separateItemsValues(1);
        $totalItems=count($itemsWeight);
        $packedItems=[];
        $i = $totalItems;
        $w = intval($maxWeight);

        while ($i>0 && $w >0){

            if ($myBag[$i][$w]['take'] >0){
                $w = $w-$itemsWeight[$i-1];
                $packedItems[] = $i;
                $i = $i-1;
            } else {
                $i = $i -1;
            }
        }
        return $packedItems;
    }

    // Displaying value of chosen items
    public function showValue()
    {
        $itemToBeShowed =self::packedKnapsack();
        $itemsValue =self::separateItemsValues(2);
        $numberOfPackedItems=count($itemToBeShowed);
        $sumValue = 0;

        for ($i=0;$i<$numberOfPackedItems;$i++){
            $a = $itemToBeShowed[$i];
            $sumValue =$sumValue + $itemsValue[$a-1];
        }
        return $sumValue;
    }

    // Displaying weight of chosen items
    public function showWeight()
    {
        $itemToBeShowed =self::packedKnapsack();
        $itemsWeight =self::separateItemsValues(1);
        $numberOfPackedItems=count($itemToBeShowed);
        $sumWeight = 0;

        for ($i=0;$i<$numberOfPackedItems;$i++){
            $a = $itemToBeShowed[$i];
            $sumWeight += $itemsWeight[$a-1];
        }
        return $sumWeight;
    }

    // Displaying id of chosen items
    public function showIds()
    {
        $itemToBeShowed = self::packedKnapsack();
        $itemsId = self::separateItemsValues(0);
        $numberOfPackedItems = count($itemToBeShowed);
        $sumItems = [];

        for ($i = 0; $i < $numberOfPackedItems; $i++) {
            $a = $itemToBeShowed[$i];
            $sumItems[] = $itemsId[$a - 1];
        }
        sort($sumItems);
        return $sumItems;
    }
}


