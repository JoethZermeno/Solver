<?php
//Start server php -S 127.0.0.1:8000
//http://127.0.0.1:8000/home.php
//Test
?>

<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" language="javascript" >
        function solveSudoku(){

            var checkValid = true;
            for(let x = 0; x < 9; x++){
                for(let y = 0; y < 9; y++){
                    var value = document.getElementById("cell_id_"+x+"_"+y).value;
                    if(value.length == 1 || value == ''){
                        
                    }else{
                        checkValid = false;
                        alert('Value: '+value+' is not valid please enter nothing or a number between 1-9');
                    }
                }
            }

            var data = $("#sudokuContainer").serialize();

            if(checkValid){
                $.post("sql_sudoku_solver.php",{data:data},
                    function(data){
                        $('#results').html(data);
                    }
                );
            }
        }
    </script>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <style>
            table{
                border-collapse:collapse;
                border:1px solid #d3d3d3;
            }
            table td{
                border:1px solid #d3d3d3;
            }
            .top_border{
                border-top: 1px solid;
            }
            .left_border{
                border-left: 1px solid;
            }
            .bottom_border{
                border-bottom: 1px solid;
            }
            .right_border{
                border-right: 1px solid;
            }
            .cell_inp{
                border: none;
            }
        </style>
    </head>
    <body>
        <header>
            <i class="fa-solid fa-puzzle-piece"></i>
            <a class="logo" href="home.php">Sudoku.com</a>
        </header>
        <form name="sudokuContainer" id="sudokuContainer" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="container">
                <table class="container_Table">
                    <tr>
                    <?php
                        //Building the Table for sudoku
                        $html = '';
                        
                        for($x=0;$x<9;$x++){  
                            for($y=0;$y<9;$y++){
                                $temp = '';
                                if($y == 0){
                                    $temp .= "left_border ";
                                }
                                if($x == 0){
                                    $temp .= "top_border ";
                                }
                                if($y == 2 || $y == 5 || $y == 8){
                                    $temp .= "right_border ";
                                }
                                if($x == 2 || $x == 5 || $x == 8){
                                    $temp .= "bottom_border ";
                                }

                                $html .= "<td class='$temp'>";
                                $html .= "<input type=\"number\" id=\"cell_id_".$x."_".$y."\" name=\"cell_id_".$x."_".$y."\" class=\"cell_inp\" maxlength=\"1\" size=\"1\" min=\"1\" max=\"9\">";
                                $html .= "</td>";
                            
                                if($x == 8 && $y == 8){
                                    $html .= '</tr>';
                                }elseif($y == 8){
                                    $html .= '</tr><tr>';
                                }
                            }
                        }
                    echo $html;
                    ?>
                </table>
            </div>
            <div class="button-Contaitner" style="display: flex;justify-content: center;align-items: center;padding-top:5px;">
                <button type="button" value="Solve" onClick="solveSudoku()">Solve</button>
            </div>
        </form>
        <div id="results"></div>
        <footer>
            <div class="footer-content">
                <p>&copy; 2024 Sudoku.com . Creative Commons.</p>
                <nav class="footer-nav">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Contact Us</a>
                </nav>
            </div>
        </footer>
    </body>
</html>