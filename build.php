<?php
    $content = '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"></rss>';
    $xml = new SimpleXMLElement($content);
    /**
     * SimpleXMLElement::addChild adds a child element to the XML node
     * SimpleXMLElement::addChild(string $qualifiedName, ?string $value = null, ?string $namespace = null)
     * $qualifiedName - the name of the child element to add.
     * $value - if specified, the value of the child element.
     */

    $rss = $xml->addChild('channel');
    $rss->addChild('title', 'PHP');
    $rss->addChild('link', 'http://example.com');
    $rss->addChild('description', 'PHP dedicated portal');
    $rss->addChild('language', 'en');
    $rss->addChild('pubDate', date('r'));

    //Connection to the DB
    require_once('connect.php');
    try {
        $query = "SELECT * FROM news ORDER BY putdate DESC LIMIT 20";
        $itm = $pdo->query($query);

        while($news=$itm->fetch()) {
            $item = $rss->addChild('item');
            $item->addChild('title', $news['name']);
            $item->addChild('description', $news['content']);
            $item->addChild('link', "http://example.com/news/{$news['id']}");
            $item->addChild('guid', "news/{$news['id']}");
            $item->addChild('pubDate', date('r', strtotime($news['putdate'])));
            if(!empty($news['media'])) {
                $enclosure = $item->addChild('enclosure');
                $url = "http://example.com/images/{$news['id']}/{$news['media']}";
                $enclosure->addAttribute('url', $url);
                $enclosure->addAttribute('type', 'image/jpeg');
            }
        }
    } catch (PDOException $e) {
        echo 'Request error: ' . $e->getMessage();
    }
    $xml->asXML('build.xml');