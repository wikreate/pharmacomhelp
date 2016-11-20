
<?php if (!empty($_SESSION['msg'])): ?>
   <div class="row">
      <div class="col-md-12">
         <?=$_SESSION['msg']?>
         <?php unset($_SESSION['msg'])?>
      </div>
   </div> 
<?php endif ?>

<?php if (!$this->uri->segment(3)): ?>
   <div class="note note-success" id="add_post" style="cursor:pointer; background-color:#F5F5F5;">
      <i class="fa fa-plus"></i> Добавить
   </div>
<?php endif ?>
 
<div id="fade-respond" class="alert"> </div> 
<?php if (!$this->uri->segment(3)): ?> 
<div class="row taggle_win">
   <div class="col-md-12">
      <div class="portlet light bg-inverse"> 

            <div class="portlet-body form">
               <!-- BEGIN FORM-->
               <form action="/cp/<?=$method?>/" class="form-horizontal onsubmit" data-redirect="/cp/<?=$method?>/">
                  <div class="form-body"> 
                   
                     <?=getInput(false, 'Вопрос', 'question', 'text', 'input', false)?> 
                     
                     <div class="form-group">
                        <label class="col-md-1 control-label">Ссылка</label>
                        <div class="col-md-11">
                           <input type="text" class="form-control" name="url"> 
                           <span class="help-block" style="color:#e86161">
                              Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например <i>Наш подход - our-approach</i>
                           </span>
                        </div>
                     </div>
                     
                     <?=getInput(false, 'Ответ', 'text', false, 'textarea', 'ckeditor')?>
  
                     
                     <div class="form-group">
                        <label class="col-md-2 control-label">Категория:  
                        </label>
                        <div class="col-md-10">
                           <select class="table-group-action-input form-control " name="id_category">
                              <option value="">Выбрать...</option>
                              <?php foreach ($categories as $item): ?>
                                  <option value="<?=$item['id']?>"><?=$item['name']?></option>
                               <?php endforeach ?> 
                           </select>
                        </div>
                     </div> 
                  
                  </div>
                  <div class="form-actions">
                     <div class="row">
                        <div class="col-md-offset-2 col-md-4">
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


<?php if (!empty($data)): ?>
   <div class="row">
      <div class="col-md-12">
          
               <?php $cName='zzz'; ?>
               <?php foreach ($data as $item): ?>
                  <?php if ($cName !== $item['cat_name']): ?>
                     <?php $cName = $item['cat_name']; if ($cName!=='zzz') echo '</table>'; ?>
                     <h2><?=$item['cat_name']?></h2> 
                     <table class="table table-striped table-advance table-hover table-bordered" style="margin: 0; margin-top: -1px;">
                        <thead>
                           <tr>
                              <td></td>
                              <td><i class="fa fa-eye fa-center tooltips" data-placement="top" data-original-title="View" data-toggle="tooltip"></i></td> 
                              <td>Вопросы</td> 
                              <td></td>
                           </tr>
                        </thead>
                        <tbody id="sort-items" data-table="<?=$db_table?>">  
                  <?php endif ?>
                  <tr id="<?=$item['id']?>">
                     <td style="width:5%; text-align:center;" class="handle"> </td>
                     <td class="t-border" style="width:2%;"> 
                        <?php if ($item['view'] == 1): ?>
                        <input checked onclick="buttonView(this, '<?=$db_table?>', '<?=$item['id']?>')" class="checkbox" name="view" type="checkbox"> 
                        <?php else: ?>
                        <input onclick="buttonView(this, '<?=$db_table?>', '<?=$item['id']?>')" class="checkbox" name="view" type="checkbox">
                        <?php endif ?>  
                     </td> 

                     <td style="width:80%;"><a href="/cp/<?=$method?>/<?=$item['id']?>"><?=$item['question']?></a></td> 

                     <td style="width:7%;" class="t-right">
                        <a href="/cp/<?=$method?>/<?=$item['id']?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a> 
                         
                        <a class="btn btn-danger btn-xs" data-toggle="modal" href="#static<?=$item['id']?>"><i class="fa fa-trash-o "></i></a>  

                        <div id="static<?=$item['id']?>" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Confirm the action</h4>
                                 </div>
                                 <div class="modal-body">
                                    <p>
                                       Are you sure you want to delete?
                                    </p>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                    <button type="button" data-dismiss="modal" onclick="toDelete(this, '<?=base_url('cp/deleteElement/')?>','<?=$item['id']?>', '<?=$db_table?>')" class="btn red">Delete</button>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </td>
                  </tr>
               <?php endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
<?php endif ?>


<?php else: ?>


<div class="row">
   <div class="col-md-12">
      <div class="portlet light bg-inverse"> 

            <div class="portlet-body form">
               <!-- BEGIN FORM-->
               <form action="/cp/<?=$method?>/<?=$data['id']?>/" class="form-horizontal onsubmit" data-redirect="/cp/<?=$method?>/">
                  <div class="form-body">  
                     <input type="hidden" class="form-control" name="id" value="<?=$data['id']?>">
                       
                        <?=getInput($data, 'Вопрос', 'question', 'text', 'input', false)?> 
                        
                        <div class="form-group">
                           <label class="col-sm-1 control-label">Ссылка </label>
                           <div class="col-sm-11">
                              <input type="text" class="form-control" name="url" value="<?=$data['url']?>"> 
                               <span class="help-block" style="color:#e86161">
                                 Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например <i>Наш подход - our-approach</i>
                              </span>
                           </div>
                        </div>

                        <?=getInput($data, 'Ответ', 'text', false, 'textarea', 'ckeditor')?>

                        <div class="form-group">
                           <label class="col-md-2 control-label">Категория:  
                           </label>
                           <div class="col-md-10">
                              <select class="table-group-action-input form-control " name="id_category">
                                 <option value="">Выбрать...</option>
                                 <?php foreach ($categories as $item): ?>
                                    <?php if ($data['id_category'] == $item['id']): ?>
                                       <option selected value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php else: ?>
                                       <option value="<?=$item['id']?>"><?=$item['name']?></option>
                                    <?php endif ?> 
                                  <?php endforeach ?> 
                              </select>
                           </div>
                        </div>  
  
                  </div>
                  <div class="form-actions">
                     <div class="row">
                        <div class="col-md-offset-2 col-md-4">
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

<?php endif ?>
 