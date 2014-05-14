yuki-html2
==========

Lightweight version, php 5.4+

The main purpose is to generate editable lightweight HTML to pass further. (generating img tag on a Model level, adding style or other attributes on the View level)


```php
<?php

$a = new tag('a');
$a['href'] = 'http://github.com/olamedia/yuki-html2';
$a[] = ['<span>just a span</span>', "\r\n", '<b>just another tag</b>'];
$a->html($a->html()); // get inner html, replace inner html
$a->text('this > is < a text'); // append text
echo $a."\r\n";
$img = new tag('img');
$img['src'] = 'test.png';
echo $img."\r\n";
/*
 * <a href="http://github.com/olamedia/yuki-html2"><span>just a span</span>
 * <b>just another tag</b>this &gt; is &lt; a text</a>
 * <img src="test.png" />
 */
```
