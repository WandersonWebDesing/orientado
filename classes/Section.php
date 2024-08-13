<?php

class Section {
    private $id;
    private $title;
    private $content;

    public function __construct($id, $title, $content) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function render() {
        echo '
        <section id="' . $this->id . '" class="content-section">
            <div class="container">
                <h2>' . $this->title . '</h2>
                <p>' . $this->content . '</p>
            </div>
        </section>';
    }
}
?>
