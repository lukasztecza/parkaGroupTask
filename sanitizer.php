<?php 
/**
  *  task 1. Write a function that will sanitize input
  */

/**
 * Sanitize string to avoid XSS but allow following html tags a, b, i, img
 * @param string $str
 * @return string
 */
function customInputSanitizer($str) {
    $str = htmlspecialchars($str);
    $str = preg_replace(array(
        '/&lt;i&gt;/', //
        '/&lt;\/i&gt;/',
        '/&lt;b&gt;/',
        '/&lt;\/b&gt;/',
        '/(&lt;a href=(&quot;|\'))((https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?)((&quot;|\')&gt;)/',
        '/&lt;\/a&gt;/',
        '/(&lt;img src=(&quot;|\'))((https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?)((&quot;|\') \/&gt;)/', //TODO
    ), array(
        '<i>', 
        '</i>',
        '<b>', 
        '</b>',
        '<a href="$3">', 
        '</a>',
        '<img src="$3" />' 
    ), $str);    
    return $str;
}

/**
 * Test if customInputSanitizer works as expected
 */
$text = 'some image: <img src="http://www.lukasztecza.pl/ceevee.jpg" /> ';
$text .= 'i and b tags: <i>italic</i> and <b>bold</b> ';
$text .= 'some link: <a href="http://www.lukasztecza.pl">some site</a> ';
$text .= 'some other tags: <em>emphasis</em> <br /> <table><tr><td>1</td><td>1</td></tr></table>';
$text .= 'some script: <script>alert("hello")</script>';

$text = customInputSanitizer($text);

echo $text;