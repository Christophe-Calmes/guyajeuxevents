<?php $dataPictures = $pictures->listPictureJS ();
?>
<script type="text/javascript" defer>
        const imageElement = document.getElementById("displayPicture");
        const legendPicture = document.getElementById("legend");
        const goPicture = document.getElementById("go");
        const backPicture = document.getElementById("back");
        listPicture = [
            <?php 
            foreach ($dataPictures as $value) {
              $adress = $value['pictureName'];
              $legend = htmlspecialchars_decode($value['legend']);
                echo '{"adress":"'.$adress.'", "legend":"'.$legend.'"},';
            }
            ?>
        ];
        let i= 1;
        const intervalId = setInterval(() => {
    imageElement.setAttribute("src", listPicture[i].adress);
    legendPicture.textContent = listPicture[i].legend;
    i++;
    if (i === listPicture.length) {
      i = 0;
    }
    console.log(i);
  }, 10000);
  const plus = (startIndex, goPicture, backPicture, listPicture, legendPicture) => {
  let i = startIndex; 
  goPicture.addEventListener("click", () => {
    imageElement.setAttribute("src", listPicture[i].adress);
    legendPicture.textContent = listPicture[i].legend;
    i++; 
  console.log(i);
    if (i === listPicture.length) {
      i = 0; 
    }
  });
    backPicture.addEventListener("click", () => {
     imageElement.setAttribute("src", listPicture[i].adress);
      legendPicture.textContent = listPicture[i].legend;
    i--; 
  console.log(i);
    if (i <= 0) {
      i = listPicture.length-1;
    }
  });

  return i;
};
i = plus(i, goPicture, backPicture, listPicture, legendPicture);
</script>