<?php

// TODO: Quote mit Usernamen die '[' oder ']' enthalten können nicht geparsed werden.
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

        if($attribute == null)
          return '<blockquote>' . $content . '</blockquote>';

        preg_match('/"(.*?)"]?$/i', $attribute, $matches);
        return '<blockquote>' . $content . '<footer>'.htmlspecialchars($matches[1]).'</footer></blockquote>';


    }
}

class YouTubeCodeDefinition extends JBBCode\CodeDefinition {

    public function __construct()
    {
        parent::__construct();
        $this->setTagName("video");
    }

    public function endsWith($content, $suffix)
    {
      return $suffix === '' || substr_compare($content, $suffix, -strlen($suffix)) === 0;
    }

    public function asHtml(JBBCode\ElementNode $el)
    {
        $content = "";
        foreach($el->getChildren() as $child)
            $content .= $child->getAsBBCode();

        // TODO: Das geht doch bestimmt schöner.
        if($this->endsWith($content, '.webm')){
          return '<div class="embed-responsive embed-responsive-16by9"><video autoplay loop class="embed-responsive-item"><source src="'.$content.'" type=video/webm></video></div>';
        }
        else if($this->endsWith($content, '.mp4')){
          return '<div class="embed-responsive embed-responsive-16by9"><video autoplay loop class="embed-responsive-item"><source src="'.$content.'" type=video/mp4></video></div>';
        }
        else {
          $foundMatch = preg_match('/v=([A-z0-9=\-]+?)(&.*)?$/i', $content, $matches);
          if($foundMatch)
            return '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="http://www.youtube.com/embed/'.$matches[1].'"></iframe></div>';
          else
            return $el->getAsBBCode();
        }
    }

  }
?>
