<?php
class QuoteCodeDefinition extends JBBCode\CodeDefinition {

    public function __construct()
    {
        parent::__construct();
        $this->setTagName("quote");
    }

    public function asHtml(JBBCode\ElementNode $el)
    {
        $attribute = $el->getAttribute();
        $content = "";
        foreach($el->getChildren() as $child)
            $content .= $child->getAsHtml();

        $foundMatch = preg_match('/"(.*?)"]?$/i', $attribute, $matches);



        if(!$foundMatch)
            return '<blockquote>' . $content . '<footer>Fehler beim parsen</footer></blockquote>';
        else
          return '<blockquote>' . $content . '<footer>'.htmlspecialchars($matches[1]).'</footer></blockquote>';
    }
}

class YouTubeCodeDefinition extends JBBCode\CodeDefinition {

    public function __construct()
    {
        parent::__construct();
        $this->setTagName("video");
    }

    public function asHtml(JBBCode\ElementNode $el)
    {
        $content = "";
        foreach($el->getChildren() as $child)
            $content .= $child->getAsBBCode();

        $foundMatch = preg_match('/v=([A-z0-9=\-]+?)(&.*)?$/i', $content, $matches);
        if(!$foundMatch)
            return $el->getAsBBCode();
        else
            return "<iframe width=\"640\" height=\"390\" src=\"http://www.youtube.com/embed/".$matches[1]."\" frameborder=\"0\" allowfullscreen></iframe>";
    }
  }
?>
