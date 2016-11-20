
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
  
<?php if (!$this->uri->segment(3)): ?> 
<div class="row taggle_win">
   <div class="col-md-12">
      <div class="portlet light bg-inverse">
            <div class="portlet-title" style="border-bottom:0px; margin-bottom:0!important;">
               <div class="caption"> 
                  <span class="caption-subject font-red-sunglo bold uppercase"> </span> 
                  <div class="tabbable-line">
                     <ul class="nav nav-tabs" style="background-color:#f7f7f7;">
                        <li class="active">
                           <a href="#tab_1_1" data-toggle="tab">Общая информация</a>
                        </li>
                        <li>
                           <a href="#tab_1_2" data-toggle="tab">Seo</a>
                        </li>
                     </ul>
                  </div>
                   
               </div> 
            </div>

            <div class="portlet-body form">
               <!-- BEGIN FORM-->
               <form action="/cp/<?=$method?>/" class="form-horizontal onsubmit" data-redirect="/cp/<?=$method?>/">
                  <div class="form-body"> 
                  <div class="tabbable-line"> 
                     <div class="tab-content" style="background-color:#f7f7f7;">
                        <div class="tab-pane active" id="tab_1_1">
                           <?=getInput(false, 'Название', 'name', 'text', 'input')?>     

                           <div class="form-group">
                              <label class="col-md-1 control-label">Ссылка</label>
                              <div class="col-md-11">
                                 <input type="text" class="form-control" name="url"> 
                                 <span class="help-block" style="color:#e86161">
                                    Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например <i>Наш подход - our-approach</i>
                                 </span>
                              </div>
                           </div>

                           <?=getInput(false, 'Текст', 'text', false, 'textarea', 'ckeditor')?>

                        </div>  

                        <div class="tab-pane" id="tab_1_2">
                           <?=getInput(false, 'Заголовок', 'seo_title', 'text', 'input')?>

                           <?=getInput(false, 'Описание', 'seo_description', false, 'textarea', false)?>
 
                           <?=getInput(false, 'Ключевые слова', 'seo_keywords', false, 'input', false, array('id' => 'tags_1'))?>
                        </div>  
                     </div>
                  </div>
                    
                  </div>
                  <div class="form-actions">
                     <div class="row">
                        <div class="col-md-offset-1 col-md-4">
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

<div id="fade-respond" class="alert"> </div> 
<?php if (!empty($data)): ?>
   <div class="row">
      <div class="col-md-12">
         <table class="table table-striped table-advance table-hover" style="margin: 0; margin-top: -1px;">
            <thead>
               <tr>
                  <td></td>
                  <td><i class="fa fa-eye" data-placement="top" data-original-title="View Top" data-toggle="tooltip"></i></td>
                  
                  <td>Название</td>
                  <td></td>
               </tr>
            </thead>
            <tbody id="sort-items" data-table="<?=$db_table?>">
               <?php foreach ($data as $item): ?>
                  <tr id="<?=$item['id']?>">
                     <td style="width:50px; text-align:center;" class="handle"> </td>
                     <td class="t-border" style="width:30px;"> 
                        <?php if ($item['view'] == 1): ?>
                        <input checked onclick="buttonView(this, '<?=$db_table?>', '<?=$item['id']?>', 'view')" class="checkbox" name="view" type="checkbox"> 
                        <?php else: ?>
                        <input onclick="buttonView(this, '<?=$db_table?>', '<?=$item['id']?>', 'view')" class="checkbox" name="view" type="checkbox">
                        <?php endif ?>  
                     </td> 
                     <td><a href="/cp/<?=$method?>/<?=$item['id']?>"><?=$item['name']?></a></td>
                     <td class="t-right">
                        <a href="/cp/<?=$method?>/<?=$item['id']?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a> 
                        
                        <a class="btn btn-danger btn-xs" data-toggle="modal" href="#static<?=$item['id']?>"><i class="fa fa-trash-o "></i></a>  

                        <div id="static<?=$item['id']?>" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                       <h4 class="modal-title">Подтвердить операцию</h4>
                                    </div>
                                    <div class="modal-body">
                                       <p>
                                          Вы действительно желаете удалить?
                                       </p>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" data-dismiss="modal" class="btn default">Отмена</button>
                                       <button type="button" data-dismiss="modal" onclick="toDelete(this, '<?=base_url('cp/deleteElement/')?>','<?=$item['id']?>', '<?=$db_table?>')" class="btn red">Удалить</button>
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
            <div class="portlet-title" style="border-bottom:0px; margin-bottom:0!important;">
               <div class="caption"> 
                  <span class="caption-subject font-red-sunglo bold uppercase"> </span> 
                  
                  <div class="tabbable-line">
                     <ul class="nav nav-tabs" style="background-color:#f7f7f7;">
                        <li class="active">
                           <a href="#tab_1_1" data-toggle="tab">Общая информация</a>
                        </li>
                        <li>
                           <a href="#tab_1_2" data-toggle="tab">Seo</a>
                        </li>
                     </ul>
                  </div>
                   
               </div> 
            </div>

            <div class="portlet-body form">
               <!-- BEGIN FORM-->
               <form action="/cp/<?=$method?>/<?=$data['id']?>/" class="form-horizontal onsubmit" data-redirect="/cp/<?=$method?>/">
                  <div class="form-body"> 
                  <div class="tabbable-line"> 
                     <input type="hidden" class="form-control" name="id" value="<?=$data['id']?>">
                     <div class="tab-content" style="background-color:#f7f7f7;">
                        <div class="tab-pane active" id="tab_1_1">
                           <?=getInput($data, 'Название', 'name', 'text', 'input')?>    
 
                           <?php if ($data['let_alone'] != 1): ?>
                           <div class="form-group">
                              <label class="col-sm-1 control-label">Ссылка </label>
                              <div class="col-sm-11">
                                 <input type="text" class="form-control" name="url" value="<?=$data['url']?>"> 
                                  <span class="help-block" style="color:#e86161">
                                    Без http://www и.т.п просто английская фраза, без пробелов, отражающая пункт меню, например <i>Наш подход - our-approach</i>
                                 </span>
                              </div>
                           </div>
                           
                           <?php else: ?> 
                           <input type="hidden" class="form-control" name="url" value="<?=$data['url']?>"> 
                           <?php endif ?> 

                           <?=getInput($data, 'Текст', 'text', false, 'textarea', 'ckeditor')?>

                        </div>  

                        <div class="tab-pane" id="tab_1_2">
                           <?=getInput($data, 'Заголовок', 'seo_title', 'text', 'input')?>

                           <?=getInput($data, 'Описание', 'seo_description', false, 'textarea', false)?>

                           <?=getInput($data, 'Ключевые слова', 'seo_keywords', false, 'input', false, array('id' => 'tags_1'))?>
                        </div>  
                     </div>
                  </div>
                    
                  </div>
                  <div class="form-actions">
                     <div class="row">
                        <div class="col-md-offset-1 col-md-4">
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