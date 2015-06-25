{include file="header.tpl" task_number='1'}



    <form action="" method="post">
          
        <div>
            {html_radios name="organization_form_id" options=$organization_form selected=$form_array.organization_form_id|default:0 separator="&nbsp;"}
        </div>
          
        <div> <label><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" value="{$form_array.seller_name|default:''}" name="seller_name" id="fld_seller_name">
        </div>
        <div> <label>Электронная почта</label>
            <input type="text" value="{$form_array.email|default:''}" name="email" id="fld_email">
        </div>
        
        <div> <label> <input type="checkbox" value="1" name="allow_mails" id="allow_mails" {$is_allow_mail}><span>Я не хочу получать вопросы по объявлению по e-mail</span> </label> </div>
        
        <div> <label>Номер телефона</label> <input type="text" value="{$form_array.phone|default:''}" name="phone" id="fld_phone"></div>
                
        <div style="display: none;" id="params" > <label class="form-label ">
            Выберите параметры
        </label> <div id="filters">
        </div> </div>
        <div> <label for="region">Город</label> {html_options name=location_id options=$cities selected=$city_selected_id}
        
         <div> <label for="region">Категория</label> {*name=category_id *}
         <select title="Выберите категорию" name="category_id"  required>
       
            
            {foreach from=$labels item=label key=key}
                <optgroup label="{$label}">
                    {html_options  options=$subcategories.$key selected=$category_selected_id|default:''}
                </optgroup>
            {/foreach} 
         </select> 
          </div>   
            
        <div id="f_title"> <label for="fld_title" >Название объявления</label> <input type="text" maxlength="50"  value="{$form_array.title|default:''}" name="title" id="fld_title" required> </div>
    
        <div> <label for="fld_description" id="js-description-label">Описание объявления</label> <textarea maxlength="3000" name="description" id="fld_description" required>{$form_array.description|default:''}</textarea> </div>
        <div> <label>Цена</label> <input type="text" maxlength="9" value="{$form_array.price|default:0}" name="price" required>&nbsp;<span>руб.</span> </div>
            
        <div>    
            <input type="submit" name={$button_name} value={$button_value} />
            <input type="hidden" name="edit_id" id="hiddenField" value="{$default_edit_id}" />
        </div>
    </form>

{*{if $qty_of_ads != 0}
    {html_table loop=$arr_ads cols="Название объявления, Имя,Цена, Действие" rows=$qty_of_ads table_attr='border="1" cellpadding="1"'}
{/if}*}
 

<table border="1">
<tr>
    <td>Название</td>
    <td>Имя</td>
    <td>Цена</td>
    <td>Действие</td>
</tr>


{foreach name=outer key=id item=ads from=$arr_ads}
  <tr>
  {foreach key=key item=ad from=$ads}
    
    {if $key == 'title'}
        <td><a href="?id={$id}&mode=show">{$ad}</a></td>
    {elseif $key eq 'price' or $key eq 'seller_name'}
        <td>{$ad}</td>
    {/if}    
  {/foreach}
  <td><a href="?id={$id}&mode=delete">Удалить</a></td>
  </tr>
{/foreach}


</table>



