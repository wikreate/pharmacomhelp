<html>
  <head>
    <meta charset="utf-8"> 
    <title><?=!empty($meta["seo_title"]) ? @$meta["seo_title"] : @$pages["seo_title"]?></title>  
    <meta name="keyWords" content="<?=!empty($meta["seo_keywords"]) ? @$meta["seo_keywords"] : @$pages["seo_keywords"]?>">  
    <meta name="description" content="<?=!empty($meta["seo_description"]) ? @$meta["seo_description"] : @$pages["seo_description"]?>">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  </head>

  <body>
    {content}
  </body> 
</html>
 

 

 