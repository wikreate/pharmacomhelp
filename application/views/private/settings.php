 

<?php if (!empty($_SESSION['msg'])): ?>
   <div class="row">
      <div class="col-md-12">
         <?=$_SESSION['msg']?>
         <?php unset($_SESSION['msg'])?>
      </div>
   </div> 
<?php endif ?>

<div id="fade-respond" class="alert"> </div> 


<?php if (!empty($settings)): ?> 
<div class="row">
   <div class="col-md-12">
   <form action="/cp/editSettings/" class="form-horizontal onsubmit" data-redirect="/cp/settings/">
      <table class="table table-striped table-advance table-hover table-bordered">  
         <?php foreach ($settings as $item): ?>
            <tr>
               <td style="width:30%;"><?=$item['description']?></td>
               <td>
                  <?php if ($item['type'] == 'input'): ?>
                     <input type="text" class="form-control" name="settings[<?=$item['var']?>]" value="<?=$item['value']?>">
                     <?php else: ?>
                        <?php if (!empty($item['value'])): ?>
                           <input type="checkbox" checked class="action-switch" data-size="small" name="settings[<?=$item['var']?>]">
                        <?php else: ?>
                           <input type="checkbox" class="action-switch" data-size="small" name="settings[<?=$item['var']?>]">
                        <?php endif ?> 
                  <?php endif ?>
               </td>
            </tr> 
         <?php endforeach ?>  
      </table>
 
      <button type="submit" class="btn green">Сохранить</button>
   </form>
   </div>
</div>
<br> 
<br> 
<?php endif ?>
 

<div class="row">
   <div class="col-md-12"> 
 <div class="portlet light bordered">
      <div class="portlet-title">
         <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase" style="color:#333 !important;">Персональные данные</span> 
         </div> 
      </div>
      <div class="portlet-body form">
         <!-- BEGIN FORM--> 
          <form action="/cp/editUserdata/" class="form-horizontal onsubmit" data-redirect="/cp/settings/">
            <div class="form-body">
              <?php foreach ($userdata as $item): ?>
               <?php if ($_SESSION['admin_user']['id'] == $item['id']): ?>
                
               <div class="form-group">
                  <label for="" class="col-lg-2 col-sm-2 control-label">Логин</label>
                  <div class="col-lg-3">
                     <input type="text" class="form-control" id="disabledInput" value="<?=$item['login']?>" disabled>
                  </div>
               </div>
               <div class="form-group">
                  <label for="" class="col-lg-2 col-sm-2 control-label">Новый пароль</label>
                  <div class="col-lg-3">
                     <input type="password" class="form-control" name="password">
                  </div>
               </div>
               <div class="form-group">
                  <label for="" class="col-lg-2 col-sm-2 control-label">Повторите пароль</label>
                  <div class="col-lg-3">
                     <input type="password" class="form-control" name="repeat_password">
                  </div>
               </div>
               <?php break; ?>
               <?php endif ?> 
               <?php endforeach ?>   
            </div>
            <div class="form-actions">
               <div class="row">
                  <div class="col-md-offset-2 col-md-9">
                     <button type="submit" class="btn green">Сохранить</button> 
                  </div>
               </div>
            </div>
         </form>
         <!-- END FORM-->
      </div>
      </div>
   </div>
</div>

 
<div class="row" >
   <div class="col-lg-12"> 

       <div class="portlet light bordered">
      <div class="portlet-title">
         <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase" style="color:#333 !important;">Добавить пользователя</span>
             
         </div>
         
         
      </div>
      <div class="portlet-body form">
         <!-- BEGIN FORM-->  
         <form action="/cp/addNewUser/" class="form-horizontal onsubmit" data-redirect="/cp/settings/">
            <div class="form-body">
              <div class="form-group">
                  <label for="" class="col-lg-2 col-sm-2 control-label">Логин</label>
                  <div class="col-lg-3">
                     <input type="text" class="form-control" name="login">
                  </div>
               </div>
               <div class="form-group">
                  <label for="" class="col-lg-2 col-sm-2 control-label">Новый пароль</label>
                  <div class="col-lg-3">
                     <input type="password" class="form-control" name="password">
                  </div>
               </div>
               <div class="form-group">
                  <label for="" class="col-lg-2 col-sm-2 control-label">Повторите пароль</label>
                  <div class="col-lg-3">
                     <input type="password" class="form-control" name="repeat_password">
                  </div>
               </div>  
            </div>
            <div class="form-actions">
               <div class="row">
                  <div class="col-md-offset-2 col-md-9">
                     <button type="submit" class="btn green">Сохранить</button> 
                  </div>
               </div>
            </div>
         </form>
         <!-- END FORM-->
      </div>
      </div> 
   </div>
</div>

<div class="row">
   <div class="col-lg-12">
      <section class="panel">
         <header class="panel-heading">
            Пользователи
         </header>
         <table class="table table-striped table-advance table-hover table-bordered">
            <thead>
               <tr>
                  <th>Логин</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($userdata as $item): ?>
               <?php if ($_SESSION['admin_user']['id'] != $item['id']): ?>
               <tr>
                  <td class='disabled'><a href="#"><?=$item['login']?></a></td>
                  <td class="t-right">
                     <!-- <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button> -->
                     <button class="btn btn-danger btn-xs" data-toggle="modal" href="#myModal<?=$item['id']?>"><i class="fa fa-trash-o "></i></button>
                     <!-- Modal -->
                     <div class="modal fade theme-modal" id="myModal<?=$item['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                           <h4 class="modal-title">Подтвердить операцию</h4>
                        </div>
                        <div class="modal-body"> 
                           Вы действительно желаете удалить даннгого пользователя?
                        </div>
                        <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">Отмена</button>
                           <button class="btn btn-success" type="button" onclick="toDelete(this,'<?=base_url('cp/deleteElement/')?>','<?=$item['id']?>', 'users')">Удалить</button>
                        </div> 
                     </div>
                     <!-- Modal --> 
                  </td>
               </tr>
               <?php endif ?>
               <?php endforeach ?> 
            </tbody>
         </table>
      </section>
   </div>
</div> 
 