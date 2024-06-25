<?php
   // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
   if (!defined('C7E3L8K9E5')) {
      header("Location: /");
      die("Erro: Página não encontrada!");
   }

   // Acessa o IF quando encontrou algum registro no banco de dados
   if (!empty($this->data['home']['top'][0])) {
      //Ler o registro da página home retornado do banco de dados
      //A função extract é utilizado para extrair o array e imprimir através do nome da chave
      extract($this->data['home']['top'][0]);
?>
      <section class="top" style="background: linear-gradient(to right, var(--main-color) 25%, rgba(255, 255, 255, 0)), 
         url('<?php echo URL;?>app/sts/assets/images/home_top/<?php echo $image_top;?>'); 
         background-size: cover; background-attachment: fixed;">
         <div class="max-width">
            <div class="top-content">
               <div class="text-1"><?php echo $title_one_top;?></div>
               <div class="text-2"><?php echo $title_two_top;?></div>
               <div class="text-3"><?php echo $title_three_top;?></div>
               <a href="<?php echo $link_btn_top;?>"><?php echo $txt_btn_top;?></a>
            </div>
         </div>
      </section>
<?php
   } else {
      echo "<p style='color: #f00;'>Erro: Nenhum conteúdo do topo encontrado!</p>";
   }

   // Acessa o IF quando encontrou algum registro no banco de dados
   if (!empty($this->data['home']['serv'][0])) {
      extract($this->data['home']['serv'][0]);
?>
      <section class="services">
         <div class="max-width">
            <h2 class="title"><?php echo $serv_title;?></h2>
            <div class="serv-content">
               <div class="card">
                  <div class="box">
                     <i class="<?php echo $serv_icon_one;?>"></i>
                     <div class="text"><?php echo $serv_title_one;?></div>
                     <p><?php echo $serv_desc_one;?></p>
                  </div>
               </div>

               <div class="card">
                  <div class="box">
                     <i class="<?php echo $serv_icon_two;?>"></i>
                     <div class="text"><?php echo $serv_title_two;?></div>
                     <p><?php echo $serv_desc_two;?></p>
                  </div>
               </div>

               <div class="card">
                  <div class="box">
                     <i class="<?php echo $serv_icon_three;?>"></i>
                     <div class="text"><?php echo $serv_title_three;?></div>
                     <p><?php echo $serv_desc_three;?></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
<?php
   } else {
      echo "<p style='color: #f00;'>Erro: Nenhum serviço encontrado!</p>";
   }

   // Acessa o IF quando encontrou algum registro no banco de dados
   if (!empty($this->data['home']['prem'][0])) {
      extract($this->data['home']['prem'][0]);
?>
   <section class="premium">
      <div class="max-width">
         <h2 class="title"><?php echo $prem_title; ?></h2>
         <div class="premium-content">
            <div class="column left">
               <img src="<?php echo URL; ?>app/sts/assets/images/home_prem/<?php echo $prem_image; ?>" alt="Serviço premium">
            </div>
            <div class="column right">
               <div class="text">
                  <?php echo $prem_subtitle; ?>
               </div>
               <p>
                  <?php echo $prem_desc; ?>
               </p>
               <a href="<?php echo $prem_btn_link; ?>"><?php echo $prem_btn_text; ?></a>
            </div>
         </div>
      </div>
   </section>
<?php
   } else {
      echo "<p style='color: #f00;'>Erro: Nenhum serviço premium encontrado!</p>";
   }
?>