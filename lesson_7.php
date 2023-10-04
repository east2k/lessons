<html>

<body>
    <a href="/lessons">Back</a>
    <br />
    <h1>Lesson 7</h1>
    <?php
    echo "<h3>Variable Naming</h3>";
    // Running on command prompt
    echo 'Variable names must begin with a letter or underscore character.
    <br/> A variable name can consist of numbers, letters, underscores but you cannot use characters like + , - , % , ( , ) . & , etc';
    echo "<h3>Variable Scope</h3>";

    echo "<h4>Local Variables</h4>";
    echo '$x = 4;
    <br/>function assignx () {
    <br/>33
    <br/>$x = 0;
    <br/>print "\$x inside function is $x. 
    <br/>";
    <br/>}
    <br/>assignx();
    <br/>print "\$x outside of function is $x. 
    <br/>";
    ';

    echo "<h4>Function Parameters</h4>";
    echo '// multiply a value by 10 and return it to the caller
    <br/>function multiply ($value) {
    <br/>$value = $value * 10;
    <br/>return $value;
    <br/>}
    <br/>$retval = multiply (10);
    <br/>Print "Return value is $retval\n";
    ';

    echo "<h4>Global Variables</h4>";
    echo '$somevar = 15;
    <br/>function addit() {
    <br/>GLOBAL $somevar;
    <br/>$somevar++;
    <br/>print "Somevar is $somevar";
    <br/>}
    <br/>addit();
    ';

    echo "<h4>Static Variables</h4>";
    echo 'function keep_track() {
    <br/>STATIC $count = 0;
    <br/>$count++;
    <br/>print $count;
    <br/>print "
    <br/>";
    <br/>PHP
    <br/>35
    <br/>}
    <br/>keep_track();
    <br/>keep_track();
    <br/>keep_track();
    ';
    ?>
</body>

</html>