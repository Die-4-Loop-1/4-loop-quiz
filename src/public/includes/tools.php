<?php

function prettyPrint($value, $label) {
    if ($label) print "<pre>$label";
    else print "<pre>";

    print_r($value); 
    print "</pre>";
}

function prettyERPrint($stuff) {
    echo ('<pre>');
    print_r($stuff);
    echo ('</pre>');
}

?>