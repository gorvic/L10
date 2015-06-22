<?php
require_once ("./includes/db_connection.php");
require_once ("./includes/functions.php");

$arr_categories = [
	'--- Выберите категорию---',
	'Автомобили с пробегом',
	'Новые автомобили',
	'Мотоциклы и мототехника',
	'Грузовики и спецтехника',
	'Водный транспорт',
	'Запчасти и аксессуары',
	'Квартиры',
	'Комнаты',
	'Дома, дачи, коттеджи',
	'Земельные участки',
	'Гаражи и машиноместа',
	'Коммерческая недвижимость',
	'Недвижимость за рубежом',
	'Вакансии (поиск сотрудников)',
	'Резюме (поиск работы)Услуги',
	'Предложения услуг',
	'Запросы на услуги',
	'Личные вещи',
	'Одежда, обувь, аксессуары',
	'Детская одежда и обувь',
	'Товары для детей и игрушки',
	'Часы и украшения',
	'Красота и здоровье',
	'Для дома и дачи',
	'Бытовая техника',
	'Мебель и интерьер',
	'Посуда и товары для кухни',
	'Продукты питания',
	'Ремонт и строительство',
	'Растения',
	'Бытовая электроника',
	'Аудио и видео',
	'Игры, приставки и программы',
	'Настольные компьютеры',
	'Ноутбуки',
	'Оргтехника и расходники',
	'Планшеты и электронные книги',
	'Телефоны',
	'Товары для компьютера',
	'Фототехника',
	'Хобби и отдых',
	'Билеты и путешествия',
	'Велосипеды',
	'Книги и журналы',
	'Коллекционирование',
	'Музыкальные инструменты',
	'Охота и рыбалка',
	'Спорт и отдых',
	'Знакомства',
	'Животные',
	'Собаки',
	'Кошки',
	'Птицы',
	'Аквариум',
	'Другие животные',
	'Товары для животных',
	'Для бизнеса',
	'Готовый бизнес',
	'Оборудование для бизнеса'
	];

$arr_cities = ['---Выберите город---',
		'Новосибирск',
                'Барабинск',
                'Бердск',
                'Искитим',
                'Колывань',
                'Краснообск',
                'Куйбышев',
                'Мошково',
                'Обь',
                'Ордынское',
                'Черепаново'
		];

fill_simple_table($arr_cities,'cities','name');
fill_simple_table($arr_categories,'categories','name');
exit;
?>