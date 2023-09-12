    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body bgcolor = "#D7FEFC">
    <?php

    $host = "localhost";
    $databaseName = "dictionary";
    $username = "root";
    $password = "root";

    $dsn = "mysql:host=$host; dbname = $databaseName";
    $word = $_GET['sword'];
    try {
        $dbConnection = new PDO("mysql:host=$host;dbname=$databaseName",$username,$password);
        $sql = $dbConnection->query("SELECT * FROM Word where Word = '$word'");
        if ($word==NULL) {
            echo "Word Not found";
        }
        foreach ($sql as $row) {
            $wid = $row['Wid'];
            echo "<h1>". $row['Word']."</h1>";
            $sql = $dbConnection->query("SELECT ImageSource from Image where Image.Wid = $wid");
            foreach ($sql as $row ) {
                
                echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['ImageSource']).'"/>'."<br>";
            }

            $sql = $dbConnection->query("SELECT Syllable from Syllable where Syllable.Wid = $wid");
            foreach($sql as $row){
            echo "<b>". "Syllable : " . "(" .$row['Syllable']. ")" ."</b>". "<br>";
            }
            $sql = $dbConnection->query("SELECT Pronunciation from Pronunciation where Pronunciation.Wid=$wid");
            foreach($sql as $row){
                echo "<b>". "Pronunciation : "  .$row['Pronunciation'] ."</b>". "<br><hr>";
                }
                $sql = $dbConnection->query("SELECT Scientific_Name from Sname where Sname.Wid = $wid");
                foreach($sql as $row){
                    if($row!=NULL){
                    echo "<b>". "Scientific Name : "  .$row['Scientific_Name'] ."</b>". "<br>";
                    echo "<hr>";
                }
                    }
                $sql = $dbConnection->query("SELECT * from PartsOfSpeech where PartsOfSpeech.Wid = $wid");
                foreach ($sql as $row) {
                    $pid = $row['Pid'];
                     echo  "<h3>" . $row['PartOfSpeech']."</h3>". "<br>";

                     $sql = $dbConnection->query("SELECT * FROM Meaning where Meaning.Pid = $pid");
                     foreach ($sql as $row) {
                        $mid = $row['Mid'];
                        echo $row['Meaning'] . "<br>" ;

                        $sql = $dbConnection->query("SELECT Example from Examples where Examples.Pid = $pid AND Examples.Mid = $mid");
                        foreach ($sql as $row) {
                            echo "<b>". "Example " . "</b>" .$row['Example']. "<br>";
                        }

                        $sql = $dbConnection->query("SELECT Synonyms FROM Synonyms WHERE Synonyms.Pid = $pid AND Synonyms.Mid = $mid");
                        foreach ($sql as $row) {
                            echo "<b>". "Synonyms ". "</b>". $row['Synonyms']. "<br>";
                        }
                        $sql = $dbConnection->query("SELECT Antonyms FROM Antonyms WHERE Antonyms.Pid = $pid AND Antonyms.Mid = $mid");
                        foreach ($sql as $row) {
                            echo "<b>". "Antonyms ". "</b>". $row['Antonyms']. "<br><br><hr>";
                        }
                     }
                     $sql = $dbConnection->query("SELECT Hindi, Malayalam, Bangla FROM Language WHERE Language.wid = $wid");
                     foreach ($sql as $row) {
                        echo "<b>". "Hindi  "."</b>". $row['Hindi']. "<br><br>";
                        echo "<b>". "Malayalam  "."</b>". $row['Malayalam']. "<br><br>";
                        echo "<b>". "Bangla  "."</b>". $row['Bangla']. "<br><br><hr>";
                     }
                }
        }
    } catch ( PDOException $error) {
        echo "$error";
    }
    


    ?>    
    </body>
    </html>