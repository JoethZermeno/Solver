<?php

parse_str($_POST['data'], $searcharray);

convert_inArr_to_2dArr($searcharray);


function convert_inArr_to_2dArr($searcharray){

    //declare 2D array
    $sudoku_array = array(array());

    $counterRow = 0;
    $counterCol = 0;

    //$x is key example: cell_id_1
    //$y is value example: '' or 1-9
    foreach($searcharray as $x => $y){
        //explode to make array of length 3
        //example: array(cell,id,1)
        $num = explode('_',$x);

        $input = isset($y) ? $y : '';

        //If cell is empty set to 0
        if($input == ''){
            $input = 0;
        }

        //Load single input from for each loop into 2D array
        $sudoku_array[$counterRow][$counterCol] = (int)$input;

        //Change column reference after each input
        $counterCol++;

        //Make new row in array when Cell_ID % 9 equal 0
        if($num[2] % 9 == 0){
            $counterRow++;
            $counterCol = 0;
        }
    }

    //print_r($sudoku_array);

    //Check to see if input puzzle is valid
    check_if_valid_inp_sudoku($sudoku_array);

    //Brute force method
    //brute_force_solver($sudoku_array,0,0);
}

function check_if_valid_inp_sudoku($sudoku_array){

    $check_inp_array = array(
        0 => 0,
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0,
        6 => 0,
        7 => 0,
        8 => 0,
        9 => 0);

    $minInputsCnt = 0;

    //echo $sudoku_array[0][0];

    foreach($sudoku_array as $row){
        foreach($row as $col){
            $num = $col;

            //If num is not empty or between 1-9 kill program
            if($num < 0 || $num > 9){
                die("Input at Row: ".($row+1)." Column: ".($col+1)." is not within 1-9 or empty");
            }

            //Increase counter for input number to ensure no more then 9 numbers of the same kind are entered
            $check_inp_array[$num]++;
        }
    }

    //Add up total number of inputs given
    for($x=1;$x<count($check_inp_array);$x++){
        $minInputsCnt += $check_inp_array[$x];
    }

    //17 Clues is the min # of clues need to solve a puzzle
    if($minInputsCnt < 17){
        die("Need at least 17 clues. Only have $minInputsCnt clue(s) right now");
    }

    //Check to see if duplicate numbers in row
    $check_valid_row = check_if_valid_row($sudoku_array);
    if($check_valid_row != 0){
        die("Row $check_valid_row not valid");
    }

    //Check to see if duplicate numbers in column
    $check_valid_col = check_if_valid_col($sudoku_array);
    if($check_valid_col != 0){
        die("Col $check_valid_col not valid");
    }

    $check_valid_3x3 = check_if_valid_3x3($sudoku_array);
    if($check_valid_3x3 != 0){
        die("Box $check_valid_3x3 not valid");
    }
}

//Function checks row passed through param
//If row is valid Return: 0
//If row is not valid Return: Row index
function check_if_valid_row($arr){
    $row_cnt = 1;
    foreach($arr as $rowArr){
        $check_row_array = array(
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0);

        //Adds to counter of amount of each number
        foreach($rowArr as $x){
            $check_row_array[$x]++;
        }

        //If stored value is greater than 1 then it has more than 1 of the same numbers in the row
        for($x=1;$x<count($check_row_array);$x++){
            if($check_row_array[$x] > 1){
                return $row_cnt;
            }
        }
        $row_cnt++;
    }
    return 0;
}

//Function checks entire array for valid columns
//Return: 0 -Valid Columns
//Return: Column index -At least 1 column invalid
//Param: entire sudoku arr
function check_if_valid_col($arr){
    //Could be made with nested for loop
    //If column for loop control is on the outer for loop
    //And row for loop control is the nested for loop
    for($y=0;$y<count($arr);$y++){
        $check_col_array = array(
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0);

        //Have to lock in row then search by column by doing (row index) + for loop control
        $check_col_array[$arr[0][0+$y]]++;
        $check_col_array[$arr[1][0+$y]]++;
        $check_col_array[$arr[2][0+$y]]++;

        $check_col_array[$arr[3][0+$y]]++;
        $check_col_array[$arr[4][0+$y]]++;
        $check_col_array[$arr[5][0+$y]]++;

        $check_col_array[$arr[6][0+$y]]++;
        $check_col_array[$arr[7][0+$y]]++;
        $check_col_array[$arr[8][0+$y]]++;
        
        //If stored value is greater than 1 then it has more than 1 of the same numbers in the column
        //Return for loop control + 1 to get column not valid
        for($x=1;$x<count($check_col_array);$x++){
            if($check_col_array[$x] > 1){
                return $y+1;
            }
        }
    }
    return 0;
}

function check_if_valid_3x3($arr){
    for($y=0;$y<3;$y++){
        for($x=0;$x<3;$x++){
            $check_3x3_array = array(
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0);
            if($x == 0){
                $addYbyX = 0;
            }elseif($x == 1){
                $addYbyX = 3;
            }else{
                $addYbyX = 6;
            }
            if($y == 0){
                $addXbyY = 0;
            }elseif($y == 1){
                $addXbyY = 3;
            }else{
                $addXbyY = 6;
            }

            $check_3x3_array[$arr[0+$addXbyY][0+$addYbyX]]++;
            $check_3x3_array[$arr[0+$addXbyY][1+$addYbyX]]++;
            $check_3x3_array[$arr[0+$addXbyY][2+$addYbyX]]++;

            $check_3x3_array[$arr[1+$addXbyY][0+$addYbyX]]++;
            $check_3x3_array[$arr[1+$addXbyY][1+$addYbyX]]++;
            $check_3x3_array[$arr[1+$addXbyY][2+$addYbyX]]++;

            $check_3x3_array[$arr[2+$addXbyY][0+$addYbyX]]++;
            $check_3x3_array[$arr[2+$addXbyY][1+$addYbyX]]++;
            $check_3x3_array[$arr[2+$addXbyY][2+$addYbyX]]++;

            //If stored value is greater than 1 then it has more than 1 of the same numbers in the column
            //Return for loop control + 1 to get column not valid
            for($z=1;$z<count($check_3x3_array);$z++){
                if($check_3x3_array[$z] > 1){
                    //print_r($check_3x3_array);
                    return $y+$x+1;
                }
            }
        }
    }
    return 0;
}
//45 is the sum of 1-9
function brute_force_solver($arr,$curCol,$curRow){

}


?>