<?php
require('sources/imagesCarousel/objects/SQLCarousel.php');
Class displayCarousel extends SQLCarousel {
    public function displayPicture () {
        $this->dataAdminPicture();
        echo '<div class="gallery">';
        echo '</div>';
    }
}