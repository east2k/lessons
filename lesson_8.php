<html>

<body>
    <a href="/lessons">Back</a>
    <br />
    <h1>Lesson 8</h1>
    <?php
    echo "<h3>Constants</h3>";
    
    echo 'define("MINSIZE", 50);
    <br/>echo MINSIZE;
    <br/>echo constant("MINSIZE"); // same thing as the previous line';

    echo "<h4>Valid and Invalid Constant</h4>";
    echo '// Valid constant names
    <br/>define("ONE", "first thing");
    <br/>define("TWO2", "second thing");
    <br/>define("THREE_3", "third thing")
    <br/>// Invalid constant names
    <br/>define("2TWO", "second thing");
    <br/>define("__THREE__", "third value");
    ';
    ?>
</body>

</html>