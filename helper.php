<?php

defined('_JEXEC') or die;

class ModApplicationForCostCalculation {

    public static function SendMail($admin_mail, $form_data) {

        // Создание объекта класса
        $modAFCC = new ModApplicationForCostCalculation();

        // Проверка на существование и заполненность переданных данных
        $checkIssetAndNotEmpty = $modAFCC->checkIssetAndNotEmpty($form_data);

        if ($checkIssetAndNotEmpty == false) {
            return $message = "Ошибка! Поля формы не заполненны или произошла непредвиденная ошибка, перезагрузите страницу и попробуйте снова!";
        }

        $mailer = JFactory::getMailer();

        // Определение почты отправителя
        $mailer->setSender($form_data["email"]);

        // Определение почты получателя
        $recipients = explode(", ", $admin_mail);
        $mailer->addRecipient($recipients);

        // Установка темы письма
        $subject = "Заявка для расчёта стоимости строительного объекта.";
        $mailer->setSubject($subject);

        // Создание письма
        $types = $modAFCC->rewriteFormData($form_data);

        $body = '<h1>Уважаемый, ' . $admin_mail . '</h1>';
        $body .= '<p>Прошу сделать расчёты по объекту со следующими данными: </p>';
        $body .= '<p><strong>Наименование объекта: </strong>' . $form_data["object_name"] . '</p>';
        $body .= '<p><strong>Площадь: </strong>' . $form_data["area"] . '</p>';
        $body .= '<p><strong>Проектирование: </strong>' . $types[0] . '</p>';
        $body .= '<p><strong>Согласование: </strong>' . $types[1] . '</p>';
        $body .= '<p><strong>Другое: </strong>' . $types[2] . '</p>';
        $body .= '<p><strong>Email: </strong>' . $form_data["email"] . '</p>';
        $body .= '<p><strong>Телефон: </strong>' . $form_data["phone_number"] . '</p>';

        $mailer->setBody($body);

        // Определение типа письма
        $mailer->IsHTML(true);

        // Отправка письма
        if (!$mailer->Send()) {
            $message = 'Ошибка! Данные формы не отправленны на почту! ';
        } else {
            $message = 'Данные успешно отправлены на почту! ';
        }

        return $message;
    }

    public static function StoreDataBase($form_data) {
        // Получение подключения к базе данных
        $db = JFactory::getDbo();

        // Создание нового объекта запроса
        $query = $db->getQuery(true);

        $query = "CREATE TABLE IF NOT EXISTS `#__application_for_cost_calculation` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `Наименование объекта` varchar(64) NOT NULL,
            `Площадь` varchar(64) NOT NULL,
            `Проектирование` char(1) NOT NULL,
            `Согласование` char(1) NOT NULL,
            `Другое` char(1) NOT NULL,
            `Email` varchar(255) NOT NULL,
            `Телефон` decimal(11, 0) NOT NULL,
            PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

        // Подготовка и выполнение запроса
        $db->setQuery($query);

        // Отправка письма
        if (!$db->execute()) {
            $message = 'Ошибка! Таблица в базе данных не создана! ';
            return $message;
        } else {
            $message = 'Таблица в базе данных успешно создана! ';
        }

        // Создание нового объекта запроса
        $query = $db->getQuery(true);

        $modAFCC = new ModApplicationForCostCalculation();

        // Проверка на существование и заполненность переданных данных
        $checkIssetAndNotEmpty = $modAFCC->checkIssetAndNotEmpty($form_data);

        if ($checkIssetAndNotEmpty == false) {
            return $message = "Ошибка! Поля формы не заполненны или произошла непредвиденная ошибка, перезагрузите страницу и попробуйте снова!";
        }

        // Проверка на SQL-Injection
        $modAFCC->checkSqlInjection($form_data, $db);

        $types = $modAFCC->rewriteFormData($form_data);

        $query = "INSERT INTO `#__application_for_cost_calculation`
            (`Наименование объекта`, `Площадь`, `Проектирование`, `Согласование`, `Другое`, `Email`, `Телефон`)
            VALUES ('{$form_data["object_name"]}', '{$form_data["area"]}', '{$types[0]}', '{$types[1]}', '{$types[2]}', '{$form_data["email"]}', '{$form_data["phone_number"]}');";

        // Подготовка и выполнение запроса
        $db->setQuery($query);

        if (!$db->execute()) {
            $message = 'Ошибка! Данные формы не записаны в таблицу базы данных!';
        } else {
            $message .= 'Данные успешно записаны в таблицу базы данных!';
        }

        return $message;
    }

    function checkIssetAndNotEmpty($form_data) {
        if (isset($form_data["object_name"]) &&
            isset($form_data["area"]) &&
            isset($form_data["email"]) &&
            isset($form_data["phone_number"])) {
            if (!(empty($form_data["object_name"]) &&
                empty($form_data["area"]) &&
                empty($form_data["email"]) &&
                empty($form_data["phone_number"]))) {
                $form_data["object_name"] = trim($form_data["object_name"]);
                $form_data["area"] = trim($form_data["area"]);
                $form_data["email"] = trim($form_data["email"]);
                $form_data["phone_number"] = trim($form_data["phone_number"]);

                return true;
            } else return false;
        } else return false;
    }

    function checkSqlInjection($form_data, $db) {
        $form_data["object_name"] = $db->real_escape_string(trim($form_data["object_name"]));
        $form_data["area"] = $db->real_escape_string(trim($form_data["area"]));
        $form_data["email"] = $db->real_escape_string(trim($form_data["email"]));
        $form_data["phone_number"] = $db->real_escape_string(trim($form_data["phone_number"]));
    }

    function rewriteFormData($form_data) {
        ($form_data["type_1"] == 'on') ? $type_1 = '✓' : $type_1 = '—';
        ($form_data["type_2"] == 'on') ? $type_2 = '✓' : $type_2 = '—';
        ($form_data["type_3"] == 'on') ? $type_3 = '✓' : $type_3 = '—';

        return $types = [$type_1, $type_2, $type_3];
    }
}