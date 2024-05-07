
<?php
echo "<!DOCTYPE html>";
echo"<html>";
echo"<head>";
echo"<style>";
        echo"body {
            font-family: Arial, sans-serif;
            background-color: #2ad8eb;
            margin: 0;
            padding: 0;
            text-align: center; /* Center-align the entire page content */
        }
    
        #AnimalForm {
            display: inline-block; /* Center-align the form */
            text-align: left; /* Reset text alignment for form elements */
        }
    
        h2 {
            text-align: center; /* Center-align the heading */
        }
    
        table {
            margin: 0 auto; /* Center-align the table */
        }
    
        #userName, #animalSelection, #nameSubmit, #animalSubmit {
            padding: 5px;
            font-size: 16px;
        }
    
        #nameError, #animalError {
            color: red;
            font-weight: bold;
        }
    
        #userNameS {
            font-weight: bold;
        }
    
        img {
            display: block;
            margin: 0 auto; /* Center-align the images */
        }
    </style>";

echo "<title>Animal Zoo</title>";
echo "</head>";


$userName = $_POST['Name'];
$animal = $_POST['selectionAnimal'];


function readAnimalText($animalName)
{
    $filePath = "./theZoo/{$animalName}.txt";

    if(file_exists($filePath))
    {   
       
        $animalFile = fopen($filePath, "r");
        
        if($animalFile)
        {
            $animalDescription = fread($animalFile, filesize($filePath));
            fclose($animalFile);
            return $animalDescription;
        }
        else
        {
            return "Error Reading the file";
        }
    }
}


echo"<body>";
echo"<h1 align = 'center' Welcome, $userName </h1>";
echo"<br>";


if($animal == "Lion")
{
    $LionDescription = readAnimalText("Lion");
    echo "<h2>Lion</h2>";
    echo "<img src='./theZoo/Lion.jpg' alt = 'Lion' width = '400' height = '400'>";
    echo "<p>$LionDescription</p>";
}
else if ($animal == "Leopard")
{
    $LeopardDescription = readAnimalText("Leopard");
    echo "<h2>Leopard</h2>";
    echo "<img src='./theZoo/Leopard.jpg' alt='Leopard' width='400' height='400'>";
    echo "<p>$LeopardDescription</p>";
}
else if ($animal == "Tiger")
{
    $TigerDescription = readAnimalText("Tiger");
    echo "<h2>Tiger</h2>";
    echo "<img src = './theZoo/Tiger.jpg' alt = 'Tiger' width = '400' height = '400'>";
    echo "<p>$TigerDescription</p>";
}
else if ($animal == "PolarBear")
{
    $PolarBearDescription = readAnimalText("PolarBear");
    echo "<h2>PolarBear</h2>";
    echo "<img src = './theZoo/PolarBear.jpg' alt = 'PolarBear' width = '400' height = '400'>";
    echo "<p>$PolarBearDescription</p>";
}
else if ($animal == "Wolf")
{
    $WolfDescription = readAnimalText("Wolf");
    echo "<h2>Wolf</h2>";
    echo "<img src = './theZoo/Wolf.jpg' alt = 'Wolf' width = '400' height = '400'>";
    echo "<p>$WolfDescription</p>";
}
else if ($animal == "Jaguar")
{
    $JaguarDescription = readAnimalText("Jaguar");
    echo "<h2>Jaguar</h2>";
    echo "<img src = './theZoo/Jaguar.jpg' alt = 'Jaguar' width = '400' height = '400'>";
    echo "<p>$JaguarDescription</p>";
}

echo"</body>";
echo"</html>";
?>



