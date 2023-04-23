<?php

defined('_JEXEC') or die;

// Регистрация класса в списке автозагрузки
JLoader::register('ModApplicationForCostCalculation', __DIR__ . '/helper.php');

// Подключение дополнительных файлов к модулю
$document = \Joomla\CMS\Factory::getDocument();
$document->addStyleSheet(JURI::root() . '/modules/mod_application_for_cost_calculation/css/style.css');
$document->addScript(JURI::root() . '/modules/mod_application_for_cost_calculation/js/script.js');

// Запись полученной админской почты
$admin_mail = $params->get('admin_mail');

// Формирование массива данных формы
$form_data = array(
    "object_name" => $_POST['object'],
    "area" => $_POST['area'],
    "type_1" => $_POST['type-1'],
    "type_2" => $_POST['type-2'],
    "type_3" => $_POST['type-3'],
    "email" => $_POST['email'],
    "phone_number" => $_POST['phone_number']
);

if (isset($_POST['btnSend'])) {

    ModApplicationForCostCalculation::SendMail($admin_mail, $form_data);

    ModApplicationForCostCalculation::StoreDataBase($form_data);

    //$response = ['message' => $message_SendMail . $message_StoreDataBase];

    //header("Content-Type: application/json");
    //echo json_encode($response);
}

// Подключение пути к макету для модуля
require JModuleHelper::getLayoutPath('mod_application_for_cost_calculation', 'default');