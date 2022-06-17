<?php
    ## Extraction of the <enclosure> tag
    $content = file_get_contents('rss.xml');
    $rss = new SimpleXMLElement($content);
    foreach($rss->xpath('//enclosure') as $enclosure) {
        echo $enclosure['url'] . '<br/>';
    }
    echo '<br/>';
    ##List of attributes
    foreach($rss->xpath('//item[1]/enclosure/@*') as $attr) {
        echo "{$attr}<br/>";
    }