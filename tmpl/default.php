<?php

defined('_JEXEC') or die;

?>
<div class="form-block">
    <form method="post" id="form" class="form__body">

        <div class="form-block-container">
            <div class="form-block-left">
                <div class="selection-of-an-object">
                    <div class="title-selection-of-an-object">Выберите объект</div>
                    <div class="object-group">
                        <input type="radio" name="object" class="object _req" value="Линейные объекты" id="object-1">
                        <label for="object-1" class="object-group-item">
                            <span>Линейные объекты</span>
                        </label>

                        <input type="radio" name="object" class="object _req" value="Благоустройство" id="object-2">
                        <label for="object-2" class="object-group-item">
                            <span>Благоустройство</span>
                        </label>

                        <input type="radio" name="object" class="object _req" value="Производственное здание" id="object-3">
                        <label for="object-3" class="object-group-item">
                            <span>Производственное здание</span>
                        </label>

                        <input type="radio" name="object" class="object _req" value="Склад / Ангар" id="object-4">
                        <label for="object-4" class="object-group-item">
                            <span>Склад<br>Ангар</span>
                        </label>

                        <input type="radio" name="object" class="object _req" value="Жилой дом" id="object-5">
                        <label for="object-5" class="object-group-item">
                            <span>Жилой дом</span>
                        </label>

                        <input type="radio" name="object" class="object _req" value="Административное здание" id="object-6">
                        <label for="object-6" class="object-group-item">
                            <span>Административное здание</span>
                        </label>

                        <input type="radio" name="object" class="object _req" value="Коммерческие строения" id="object-7">
                        <label for="object-7" class="object-group-item">
                            <span>Коммерческие строения</span>
                        </label>

                        <input type="radio" name="object" class="object _req" value="Другое" id="object-8">
                        <label for="object-8" class="object-group-item">
                            <span>Другое</span>
                        </label>
                    </div>
                </div>

                <div class="form-block-left-down">
                    <div class="selection-of-area">
                        <div class="title-selection-of-area">Площадь</div>
                        <select name="area" id="area" class="_req">
                            <option disabled="disabled" selected value="">Выберите площадь проектируемого объекта</option>
                            <option value="от 1000 до 1500 м²">от 1000 до 1500 м²</option>
                            <option value="от 1500 до 5000 м²">от 1500 до 5000 м²</option>
                            <option value="от 5000 до 25000 м²">от 5000 до 25000 м²</option>
                            <option value="свыше 25000 м²">свыше 25000 м²</option>
                        </select>
                    </div>

                    <div class="type-of-work">
                        <div class="title-type-of-work">Вид работ</div>
                        <div class="type-group">
                            <div class="type-group-item">
                                <input type="checkbox" name="type-1" id="cbx1" class="checkbox_test _req">
                                <label for="cbx1" class="toggle"><span></span></label>
                                <p>Проектирование</p>
                            </div>
                            <div class="type-group-item">
                                <input type="checkbox" name="type-2" id="cbx2" class="checkbox_test _req">
                                <label for="cbx2" class="toggle"><span></span></label>
                                <p>Согласование</p>
                            </div>
                            <div class="type-group-item">
                                <input type="checkbox" name="type-3" id="cbx3" class="checkbox_test _req">
                                <label for="cbx3" class="toggle"><span></span></label>
                                <p>Другое</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-block-right">
                <div class="contacts-block">
                    <p class="title-contacts-block">Наш специалист подготовит расчёт полной стоимости объекта в
                        течение 1 рабочего дня
                    </p>
                    <input type="email" name="email" class="contacts-input _req _email" placeholder="✉ Почта" required>
                    <input type="tel" name="phone_number" class="contacts-input _req" placeholder="☎ Телефон (обязательное поле)" maxlength="11" pattern="[0-9]{1}[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" required>
                    <input type="submit" name="btnSend" class="form-btn" value="Заказать расчет!">
                    <a href="">Согласие на обработку персональных данных</a>
                </div>

                <div class="PDF-block">
                    <div class="title-PDF-block">Получите Пошаговое руководство на строительство здания после отправки заявки</div>
                    <img src="/modules/mod_application_for_cost_calculation/img/PDF-file.png" alt="png-file">
                </div>
            </div>
        </div>
    </form>
</div>