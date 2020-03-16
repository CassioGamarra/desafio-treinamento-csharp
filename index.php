<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESAFIO DEVRAMPER - TREINAMENTO C# - CÁSSIO GAMARRA</title>
    <!--Utilizando o CSS do Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <form action="" method="POST">
        <fieldset>
            <legend>DESAFIO DEVRAMPER - DIAMANTES - CÁSSIO GAMARRA</legend>
            <label for="letra">Digite uma letra:</label>
            <!--Campo para inserir a letra desejada, com regex para evitar o uso de mais de uma letra ou números/caracteres especiais-->
            <input type="text" name="campoLetra" pattern="[A-Za-z]{1}" title="Digite uma LETRA"/>
            <input type="submit" value="Mostrar Diamante" name="diamante"/> <!--Submit para exibir o diamante da letra inserida-->
            <input type="submit" value="Diamante Completo" name="diamanteCompleto"/> <!--Submit para exibir um diamante de A até Z-->
        </fieldset>
    </form>
    </div>
</body>
</html>

<?php
    $diamante = ""; //Variável para armazenar o diamante formado
    $letra = 90; //Letra Z em ASCII para formar o diamante completo
    
    //Para exibir o diamante da letra inserida
    if(isset($_POST['diamante'])){ //Verifica qual submit foi clicado
        if(isset($_POST['campoLetra'])){//Verifica o campo letra
            $letraUser = $_POST['campoLetra']; //Variavel local para realizar testes com o valor que o usuário digitou
            if($letraUser === ""){ //Caso o usuário não forneça uma letra
                echo "<div class='container'><h3>Campo LETRA está vazio!</h3></div>";
            }
            else if(strToUpper($letraUser) == 'A'){ //Caso o usário digite a letra A
                echo "<div class='container'><h3>Não é possível criar um diamante apenas com a letra <b>A</b></h3></div>";
            }
            else{
                global $letra; //Transforma a varíavel $letra em global
                $letra = ord(strToUpper($letraUser)); //Transforma o valor do caractere para numério, após transformar em UpperCase
                echo "<h4>Letra escolhida: ".strToUpper($letraUser)."</h4><br/>"; //Exibie a letra escolhida
                mostra(); //Exibe o diamante
            }
        }
    }

    //Para exibir o diamante completo
    if(isset($_POST['diamanteCompleto'])){ //Verifica o submit clicado
        echo "<br/>";
        mostra(); //Exibe o diamante
    }
    
    //Função para exibir o diamante
    function mostra(){
        global $diamante; //Transforma a varíavel em global
        $diamante = desenhaDiamante(); //Recebe os valores da função desenhaDiamante();
        //Valores randomicos para a cor da letra
        $r = rand(100,255);
        $g = rand(100,255);
        $b = rand(100,255);
        //Exibe o diamante
        echo "<div class='container' style='color:rgb($r, $g, $b)'>$diamante</div>";
        echo "<br/>";
    }

    //Função para realizar o "desenho" do diamante
    function desenhaDiamante(){
        global $diamante;
        global $letra;
        //Monta a parte superior do diamante, o $i = 65 se refere a letra A em ASCII.
        for($i = 65; $i <= $letra; $i++){
            montarLinha($diamante, $i); //Chama a função para montar as linhas
            $diamante .= '<br>';
        }
        //Monta a parte inferior do diamante
        for($i = $letra - 1; $i >= 65; $i--){
            montarLinha($diamante, $i);
            if($i != 65){
                $diamante .= '<br>';
            }
        }
        return $diamante;
    }

    //Montar a linha
    function montarLinha($diamante, $i){
        global $letra;
        global $diamante;

        $x = $letra - $i; 
        $y = $i - 65;

        //Para os valores da esquerda
        for($j = $x; $j > 0; $j--){
            $diamante .= '&nbsp';//Monta os espaços 
        }
        $diamante .= chr($i);

        for($j = 2*$y - 1; $j > 0; $j--){
            $diamante .= '&nbsp'; 
        }
        //Para os valores da direita
        if($y !=0){
            $diamante .= chr($i);
        }

        for($j = $x; $j > 0; $j--){
            $diamante .= '&nbsp';
        }
    }
?>

<style>
    body{
        background:black;
        color: #FFF;
        font-family: "Courier New", Courier, monospace;
        font-weight: 700;
        text-align: center;
    }
</style>