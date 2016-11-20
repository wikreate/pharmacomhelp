<div class="main-content container">
   <div class="row">
      <div class="col-md-12">
         <div class="bread">
            <ul class="breadcrumb">
               <li><a href="/">Главная</a></li>
               <li><?=$pages['name']?></li>
            </ul>
         </div>
         <div class="faq-blogs">
            <h1><?=$pages['name']?></h1>
            <div class="faq-content default-content">
            <?php if(!empty($_SESSION['msg'])):?> 
              <?=$_SESSION['msg'];?>
              <?unset($_SESSION['msg']);?> 
            <?php endif?>
               <?=htmlspecialchars_decode($pages['text'])?> 
               <?php if ($this->uri->segment('1')=='subscribe'): ?>
               <div id="content">
                  <div id="contact" class="current">
                     <form class="c-form onsubmit" style="padding: 30px 0;" id="contactForm" data-redirect="<?=base_url('subscribe')?>" action="/subscribe/" method="post">
                        <label>Адрес электронной почты <span>*</span></label>
                        <input type="text" name="email" name="senderName" id="senderName"  > 
                        <div id="error-respond"></div>
                        <button type="submit" id="submit-btn">Отправить</button>
                     </form>
                  </div>
               </div>
               <?php endif ?>
               <?php if ($this->uri->segment('1')=='reklama'): ?> 
                 <br>
                 <div class="pay_adv">
                    <p><big><b>Вы можете произвести оплату за услуги "Russian Meridian" здесь:</b></big> </p>
                    <form action="/payAdversting/"  method='POST' class="form-horizontal onsubmit" data-redirect="<?=base_url('reklama')?>">
                       <p>Заполните необходимую сумму:</p> 
                       <input type="text" id="mask_price" name="amount" class="input_field" placeholder="CAD $">
                       <br>
                       <small><i>Допустимы только цифры а также символ: '.'</i></small>
                       <br />
                       <p class="tax_adv">Tax: +13%</p> 
                       <div id="error-respond"></div>
                       <input type="submit" value="Оплатить"> <br>
                       <img src="/image/paypal.png" class="pay_system" alt="">
                    </form>
                 </div> 
               <?php endif ?>
            </div>
         </div>
      </div>
   </div>
</div>
<style>

    .pay_system{
      width: 150px;
    }

    .tax_adv{
      color: red;
      text-decoration: underline;
    }
   .pay_adv{
     margin-top: 20px;
     display: inline-block;
     padding: 20px;
     background-color: #fafafa;
     border: 1px solid #ededed;
     border-radius: 5px;
   } 
   .input_field{
     padding: 0 10px;
     text-align: left !important;
   }

   .pay_adv small{
      color: #878787;
   }
</style>

 