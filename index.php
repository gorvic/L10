<?php
header("Content-Type: text/html; charset=utf-8");
require_once ('./includes/initialize.php');

//header
$smarty->assign('lesson_number', 10);

//cities
$arr_cities = dbs_find_all_items('cities','id', 'name');
$smarty->assign('cities', $arr_cities);

//categories
$arr_categories  = dbs_find_all_items('categories','id','name');
$smarty->assign('categories', $arr_categories);

//organization form
$arr_organization_form = array('0'=>'Частное лицо','1'=>'Организация');
$smarty->assign('organization_form', $arr_organization_form);


//имя кнопки по умолчанию
$default_button_value = 'Отправить';
$default_button_name = 'submit';
$default_edit_id = '';

$form_array =  array(); //[];
$form_array['seller_name'] = "";
$form_array['phone'] = "";
$form_array['allow_mails'] = "";
$form_array['category_id'] = "";
$form_array['location_id'] = "";
$form_array['title'] = "";
$form_array['description'] = "";
$form_array['price'] = "0";
$form_array['email'] = "";
$form_array['organization_form_id'] = 1;


//get advertises
$ads_array = dbs_find_all_items('ads','id', implode(', ',array_keys($form_array)));


if (request_is_post()) {

    $from_submit = isset($_POST['submit']);
    $from_edit = isset($_POST['edit']);
    
    

    if ($from_submit || $from_edit) {

        $tmp_post = $_POST; //можно ли сразу перезаписывать в пост или лучше через буферную переменную?

        //проверим чекбокс. Если нет галки - в ПОСТ не приходит
        if (!isset($tmp_post['allow_mails'])) {
			$tmp_post['allow_mails'] = "";
        }

        //обработка значений ПОСТ; может быть значительно сложнее
        /*foreach ($tmp_post as $key => $value) {
			$tmp_post[$key] = strip_tags($value);
        }*/

        if ($from_submit) {
			//убираем ключи, для согласования колонок в таблице sql
			unset($tmp_post['submit']); //убираем, для согласования колонок в таблице sql
			unset($tmp_post['edit_id']); //убираем, для согласования колонок в таблице sql
			dbs_create_new_ad($tmp_post);
	    
		} elseif ($from_edit) {
			$id = (int)$_POST['edit_id'];
			//убираем ключи, для согласования колонок в таблице sql
			unset($tmp_post['edit_id']);
			unset($tmp_post['edit']);
			unset($tmp_post['submit']); //убираем, для согласования колонок в таблице sql
			dbs_update_ad($id, $tmp_post);
        }
	
		//перезапрос GET
		redirect_to($_SERVER["PHP_SELF"]);

    }

} elseif (request_is_get()) { //пришло из ссылок

    if (isset($_GET['id']) && isset($_GET['mode'])) {

        //проверяем параметры
        $id = (int) $_GET['id'];
        $mode = strip_tags($_GET['mode']);

        if ($mode == "show") { //проставить

            //заполним массив для вывода html
			$ad = dbs_find_item_by_id('ads', $id);
            foreach ($ad as $key => $value) {
                $form_array[$key] = $value;
            }

            $default_button_value = 'Записать изменения';
            $default_button_name = 'edit';
            $default_edit_id = (int)$_GET['id']; //для прописи в хидден

        } elseif ($mode == "delete") { //удалить

            //проверим, существует ли ключ в соответствии
            if (array_key_exists($id,  $ads_array)) {
				dbs_delete_ad($id);
				redirect_to($_SERVER["PHP_SELF"]);
			} else {
                echo "Передан неверный ID объявления";
            }
        }
    }
}

$smarty->assign('form_array', $form_array);

//email, значение для checked
$smarty->assign('is_allow_mail', $form_array['allow_mails'] == 1 ? 'checked' :'');

//город, значение для selected
$smarty->assign('city_selected_id', $form_array['location_id']);

//category, if exists selected value
$smarty->assign('category_selected_id', $form_array['category_id']);


//button
$smarty->assign('button_name', $default_button_name);
$smarty->assign('button_value', $default_button_value);
$smarty->assign('default_edit_id',$default_edit_id);


$smarty->assign('arr_ads', $ads_array);

$smarty->display('index.tpl');
	
?>