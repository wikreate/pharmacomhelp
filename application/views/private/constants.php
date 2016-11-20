
<div class="row">
   <div class="col-md-12">
      <form action="" method="get">
         <div class="form-group"> 
            <div class="col-sm-3 <?=!empty($_GET['txt']) ? 'col-sm-offset-8' : 'col-sm-offset-9'?>">
               <div class="input-group m-bot15">  
                     <input type="hidden" name="filter" value="search">
                     <input type="text" class="form-control" name="txt" placeholder="" value="<?=!empty($_GET['txt']) ? $_GET['txt'] : '' ?>"> 
                     <span class="input-group-btn">
                       <button class="btn btn-white" type="submit">Поиск</button>
                     </span>  
               </div> 
            </div>
            <?php if (!empty($_GET['txt'])): ?>
               <div class="col-sm-1">
                  <a class="btn btn-default" href="/cp/constants">Сбросить</a> 
               </div> 
            <?php endif ?> 
         </div>
      </form>
   </div>
</div>


<?php if (!empty($_SESSION['msg'])): ?>
   <div class="row">
      <div class="col-md-12">
         <?=$_SESSION['msg']?>
         <?php unset($_SESSION['msg'])?>
      </div>
   </div> 
<?php endif ?>

<div id="fade-respond" class="alert"> </div>
<div class="row">
   <div class="col-md-12">
      <form action="/cp/<?=$method?>/" class="form-horizontal onsubmit" data-redirect="/cp/<?=$method?>/">
       
      <?php foreach ($data as $item): ?>     
         <div class="form-group"> 
           <label for="" class="col-lg-12 col-sm-12 control-label const-descr"><?=$item['description']?></label> 
            <div class="col-sm-12">   
            <?php if ($item['ckeditor'] == '1'): ?>
               <textarea style="min-height:55px !important; resize: vertical !important;" name="<?=$item['id']?>" id="ckeditor_<?=$item['id']?>" class="form-control ckeditor"><?=$item['value']?></textarea>   
            <?php else: ?>
               <textarea style="min-height:55px !important; resize: vertical !important;" name="<?=$item['id']?>" class="form-control"><?=$item['value']?></textarea>   
            <?php endif ?>
                
            </div>
         </div>   
      <?php endforeach ?> 
      <?php if (!empty($_GET['filter']) && empty($data)): ?>
         <div class="empty-page">
            <h1>
               No found
            </h1>
         </div>
      <?php endif ?>

      <br> 
      <div class="form-group">
         <div class="col-lg-12">
            <button type="submit" class="btn green">Сохранить</button> 
         </div>
      </div>
      </form>
   </div>
</div>