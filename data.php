<html>
<head>
    <meta http-equiv="refresh" content="0; URL=index.html" />
</head>
<body>
    <?php

        //Retriving text form the form
        $name = $_POST["name"];
        $mail = $_POST["email"];
        $message = $_POST["message"];
        echo "Details<br>";
        echo "Name : ",$name,"<br>";
        echo "Mail : ",$mail,"<br>";
        echo "Mess : ",$message,"<br>";

        $data = <<<val
            Name    : $name
            Mail id : $mail
            Message : $message
        val;
        $file = fopen("Data.txt","w");
        fwrite($file,$data);
        fclose($file);

    ?>
</body>
</html>