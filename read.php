<?php   
    ##Reading of an XML-file
    $content = file_get_contents('rss.xml');
    $rss = new SimpleXMLElement($content);
    echo $rss->channel->title."<br/>";
    echo $rss->channel->description."<br/>";
    echo $rss->channel->pubDate."<br/>";
    echo "<br/>";

    ## Tag collections
    foreach($rss->channel->item as $item) {
        echo date("Y.m.d H:i", strtotime($item->pubDate))." ";
        echo $item->title."<br/>";
        echo $item->description."<br/>";
        //List of attributes
        foreach($rss->channel->item->enclosure->attributes() as $name=>$value) {
            echo "{$name} = {$value}<br/>";
        }
        echo "<br/>";
    }

    ## Amount of elements in the collection
    echo "There are " . $rss->channel->item->count() . 
         " elements in this collection <br/>";
    echo "<br/>";

    

