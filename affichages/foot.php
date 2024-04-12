
<footer class="flex-rows">
      <nav>
      <?php 
        if(empty($_SESSION)) {
          echo '<a class="link" href="'.findTargetRoute(136).'">Voir les CGU</a>';
        } 
        else if($_SESSION['role'] == 1) {
            echo '<a class="link" href="'.findTargetRoute(137).'">Voir les CGU</a>';
        }
      ?></nav>
  <div class="centrale">
      Copyrigth &copy; <?=date('Y')?> &nbsp;
  </div>
  <aside class="adress">124 Bd Jean Jaurès,<br/> 13300 Salon-de-Provence<br/> téléphone: 06 59 64 95 42<br/> email: sebastienguyajeux@gmail.com</aside>
    </footer>
   </body>
 </html>
