<?php
//Start server php -S 127.0.0.1:8000
//http://127.0.0.1:8000/home.php
//Test

//Building the Table for sudoku
$html = '';
for($x=1;$x<9*9+1;$x++){
    // < -> &lt;
    // > -> &gt;

    $temp = '';

    if($x % 9 == 1){
        $temp .= "left_border ";
    }
    if($x <= 9){
        $temp .= "top_border ";
    }
    if($x % 9 == 0 || $x % 9 == 3 || $x % 9 == 6){
        $temp .= "right_border ";
    }
    if($x >= 73 || ($x >= 19 && $x <=27) || ($x >= 46 && $x <=54)){
        $temp .= "bottom_border ";
    }

    $html .= "&lt;td class='$temp'&gt; <br>";
    $html .= "&lt;input type=\"number\" id=\"cell_id_$x\" name=\"cell_id_$x\" class=\"cell_inp\" maxlength=\"1\" size=\"1\" min=\"1\" max=\"9\"&gt; <br>";
    $html .= "&lt;/td&gt; <br>";

    if($x%9==0){
        $html .= '&lt;/tr&gt; <br> &lt;tr&gt;<br>';
    }
}
//echo $html;
?>

<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" language="javascript" >
        function solveSudoku(){

            var checkValid = true;
            for(let x = 1; x < 9*9; x++){
                var value = document.getElementById("cell_id_"+x).value;
                if(value.length == 1 || value == ''){
                    
                }else{
                    checkValid = false;
                    alert('Value: '+value+' is not valid please enter nothing or a number between 1-9');
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
    <title>Code Sudoku - Play Free Sudoku!</title>
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
            <i class="fa-solid fa-code"></i>
            <a class="logo" href="home.php">Sudoku</a>
        </header>
        <nav class="nav-bar">
            <ul>
                <a class="hvr-icon-wobble-horizontal" href="#HTP">How to Play! <i class="fa-solid fa-arrow-right hvr-icon"></i></a>
                <a class="hvr-icon-wobble-horizontal" href="#STR">Strategies <i class="fa-solid fa-arrow-right hvr-icon"></i></a>
                <a class="hvr-icon-wobble-horizontal" href="#ABT">About <i class="fa-solid fa-arrow-right hvr-icon"></i></a>
                <a class="brands" href="#"><i class="fa-brands fa-github"></i></a>
                <a class="brands" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a class="brands-clr" href="#"><i class="fa-brands fa-discord"></i></a>
            </ul>
        </nav>
        <div class="home-btn">
            <a href="home.php"><i class="fa-solid fa-home"></i></a>
        </div>
        <form name="sudokuContainer" id="sudokuContainer" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="container">
                <table class="container_Table">
                    <tr>
                        <td class='left_border top_border '>
                            <input type="number" id="cell_id_1" name="cell_id_1" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border '>
                            <input type="number" id="cell_id_2" name="cell_id_2" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border right_border '>
                            <input type="number" id="cell_id_3" name="cell_id_3" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border '>
                            <input type="number" id="cell_id_4" name="cell_id_4" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border '>
                            <input type="number" id="cell_id_5" name="cell_id_5" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border right_border '>
                            <input type="number" id="cell_id_6" name="cell_id_6" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border '>
                            <input type="number" id="cell_id_7" name="cell_id_7" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border '>
                            <input type="number" id="cell_id_8" name="cell_id_8" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='top_border right_border '>
                            <input type="number" id="cell_id_9" name="cell_id_9" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border '>
                            <input type="number" id="cell_id_10" name="cell_id_10" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_11" name="cell_id_11" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_12" name="cell_id_12" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_13" name="cell_id_13" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_14" name="cell_id_14" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_15" name="cell_id_15" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_16" name="cell_id_16" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_17" name="cell_id_17" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_18" name="cell_id_18" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border bottom_border '>
                            <input type="number" id="cell_id_19" name="cell_id_19" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_20" name="cell_id_20" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_21" name="cell_id_21" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_22" name="cell_id_22" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_23" name="cell_id_23" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_24" name="cell_id_24" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_25" name="cell_id_25" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_26" name="cell_id_26" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_27" name="cell_id_27" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border '>
                            <input type="number" id="cell_id_28" name="cell_id_28" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_29" name="cell_id_29" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_30" name="cell_id_30" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_31" name="cell_id_31" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_32" name="cell_id_32" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_33" name="cell_id_33" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_34" name="cell_id_34" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_35" name="cell_id_35" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_36" name="cell_id_36" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border '>
                            <input type="number" id="cell_id_37" name="cell_id_37" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_38" name="cell_id_38" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_39" name="cell_id_39" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_40" name="cell_id_40" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_41" name="cell_id_41" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_42" name="cell_id_42" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_43" name="cell_id_43" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_44" name="cell_id_44" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_45" name="cell_id_45" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border bottom_border '>
                            <input type="number" id="cell_id_46" name="cell_id_46" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_47" name="cell_id_47" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_48" name="cell_id_48" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_49" name="cell_id_49" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_50" name="cell_id_50" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_51" name="cell_id_51" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_52" name="cell_id_52" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_53" name="cell_id_53" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_54" name="cell_id_54" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border '>
                            <input type="number" id="cell_id_55" name="cell_id_55" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_56" name="cell_id_56" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_57" name="cell_id_57" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_58" name="cell_id_58" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_59" name="cell_id_59" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_60" name="cell_id_60" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_61" name="cell_id_61" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_62" name="cell_id_62" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_63" name="cell_id_63" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border '>
                            <input type="number" id="cell_id_64" name="cell_id_64" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_65" name="cell_id_65" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_66" name="cell_id_66" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_67" name="cell_id_67" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_68" name="cell_id_68" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_69" name="cell_id_69" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_70" name="cell_id_70" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class=''>
                            <input type="number" id="cell_id_71" name="cell_id_71" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border '>
                            <input type="number" id="cell_id_72" name="cell_id_72" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                    <tr>
                        <td class='left_border bottom_border '>
                            <input type="number" id="cell_id_73" name="cell_id_73" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_74" name="cell_id_74" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_75" name="cell_id_75" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_76" name="cell_id_76" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_77" name="cell_id_77" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_78" name="cell_id_78" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_79" name="cell_id_79" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='bottom_border '>
                            <input type="number" id="cell_id_80" name="cell_id_80" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                        <td class='right_border bottom_border '>
                            <input type="number" id="cell_id_81" name="cell_id_81" class="cell_inp" maxlength=1 size=1 min=1 max=9>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="button-Contaitner" style="display: flex;justify-content: center;align-items: center;padding-top:5px;">
                <button type="button" value="New"   onclick="">New</button>
                <button type="button" value="Solve" onClick="solveSudoku()">Solve</button>
            </div>
        </form>
        <div class="results" id="results"></div>
        <section id="HTP" class="HTP">
            <div class="HTP-content-container">
                <h2>How to Play Sudoku</h2>
                <p>Sudoku is a logic-based number puzzle. Follow these steps to become a Sudoku master!</p>
                <ol>
                    <li>Fill each row, column, and 3x3 grid with numbers from <strong>1 to 9</strong>.</li>
                    <li>A number can only appear <strong>once</strong> in each row, column, or 3x3 grid.</li>
                    <li>Use logic and process of elimination to place numbers.</li>
                    <li>Keep going until the entire grid is correctly filled!</li>
                </ol>
                <p>Tip: Start with rows, columns, or grids that already have the most numbers filled in.</p>
            </div>
        </section>
        <section id="STR" class="STR">
            <div class="STR-content-container">
                <h2>Strategies to Solve Sudoku</h2>
                <p>Improve your Sudoku skills with these expert tips and strategies:</p>
                <ul>
                    <li>
                        <strong>Start with the obvious:</strong> Look for rows, columns, or 3x3 grids with only one or two empty spaces and fill them in.
                    </li>
                    <li>
                        <strong>Scan for missing numbers:</strong> Focus on one number at a time (e.g., all 1s) and figure out where they fit.
                    </li>
                    <li>
                        <strong>Use the elimination method:</strong> Check where numbers cannot go to narrow down their correct positions.
                    </li>
                    <li>
                        <strong>Pencil in possibilities:</strong> Write down potential numbers in empty cells to visualize options, then erase as you solve.
                    </li>
                    <li>
                        <strong>Look for hidden pairs and triples:</strong> Identify small groups of numbers that must fit in a specific area.
                    </li>
                    <li>
                        <strong>Stay patient:</strong> Don’t guess! Every puzzle can be solved with logic and reasoning.
                    </li>
                </ul>
                <p>Keep practicing and you’ll master Sudoku in no time!</p>
            </div>
        </section>
        <section id="ABT" class="ABT">
            <div class="ABT-content-container">
                <h2>About Our Sudoku Website</h2>
                <p>Welcome to our Sudoku website, the ultimate destination for Sudoku enthusiasts! Whether you're a beginner or a seasoned expert, our site is designed to provide a fun, challenging, and immersive Sudoku experience.</p>
                <div class="features">
                    <h3>Features:</h3>
                    <ul>
                        <li>Interactive Sudoku puzzles at varying difficulty levels.</li>
                        <li>A clean, user-friendly interface optimized for all devices.</li>
                        <li>Helpful tips and strategies to improve your skills.</li>
                        <li>Track your progress and challenge your friends!</li>
                    </ul>
                </div>
                <p>Our mission is to bring the joy of Sudoku to players of all ages and skill levels. Dive into the world of numbers, logic, and fun!</p>
            </div>
        </section>
        <!--<footer>
            <div class="footer-content">
                <p>&copy; 2024 Sudoku . Creative Commons.</p>
                <nav class="footer-nav">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Contact Us</a>
                </nav>
            </div>
        </footer> -->
    </body>
</html>