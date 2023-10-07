
#[Route('/load', name: 'app_actions', methods:['get'])]
public function load(ManagerRegistry $doctrine): JsonResponse
{
$j = '[{"name":"Отметьте 5 любимых брендов","short_description":"Adidas, Baon, Mango и ещё 5000 брендов на Lamoda","full_description":"Поставьте сердечко на 5 брендов, которые любите больше всего. Вы сможете фильтровать товары по любимым брендам в каталоге!","status":"new","progress":0,"price":10,"condition":null,"action_text":"Перейти к брендам","due_time":"1696632991","link":"https://www.lamoda.ru/brands/?sitelink=topmenuM%26l=6"},{"name":"Сделайте заказ на сумму от 5000Р","short_description":"Баллы будут начислены через 14 дней с момента выкупа","full_description":"Купите любые товары на сумму от 5000Р. Оплата и доставка любым способом!","status":"inProgres","progress":0,"price":10,"condition":null,"action_text":"Перейти к заказу","due_time":"1696626751","link":"https://www.lamoda.ru/checkout/cart/"},{"name":"Примените промокод при покупке товара BEFREE","short_description":"Дополнительно -15%","full_description":"Купите любой товар BEFREE с применённым промокодом AUTMN23","status":"done","progress":0,"price":10,"condition":null,"action_text":"Перейти к покупкам","due_time":"1697920295","link":"https://www.lamoda.ru/cb/4153-22318/default-women-befree/?sitelink=topmenuW%26l=3"},{"name":"Напишите отзыв и дополните его фото купленного товара","short_description":"Отзывы помогают сделать правильный выбор!","full_description":"Поделитесь впечатлениями от купленного товара. Не забудьте приложить фото!","status":"new","progress":0,"price":10,"condition":null,"action_text":"Оставить отзыв","due_time":"1697920295","link":"https://www.lamoda.ru/sales/order/history/?sitelink=profile_hover_menu"},{"name":"Расскажите о Lamoda друзьям!","short_description":"","full_description":"Пригласите друга в Lamoda по своей уникальной ссылке","status":"new","progress":0,"price":10,"condition":null,"action_text":"Пригласить","due_time":"","link":""}]';
$em = $doctrine->getManager();

$json = json_decode($j, true);

foreach ($json as $item) {
$action = new Action();
$action->setName($item["name"]);
$action->setStartDate(new \DateTimeImmutable());
$action->setFinishDate(new \DateTimeImmutable());
$action->setVisible(true);
$action->setShortDescription($item["short_description"]);
$action->setFullDescription($item["full_description"]);
$action->setPrice($item["price"]);
$action->setActionText($item["action_text"]);
$action->setlink($item["link"]);
//            $action->setGoal($item["name"]);
$action->setProcessor(uniqid());
$action->setSteps(uniqid());

$em->persist($action);
}
$em->flush();

return $this->json([]);
}


#[Route('/load', name: 'app_dump', methods:['get'])]
public function load(ManagerRegistry $doctrine): JsonResponse
{
$j = '[{"name":"Отметьте 5 любимых брендов","short_description":"Adidas, Baon, Mango и ещё 5000 брендов на Lamoda","full_description":"Поставьте сердечко на 5 брендов, которые любите больше всего. Вы сможете фильтровать товары по любимым брендам в каталоге!","status":"new","steps":"<br/>Нажмите на кнопку “Активировать задание” <br/> Перейдите в раздел “Каталог” <br/> Выберите 5 товаров <br/> Нажмите на каждом иконку <br/> Дождитесь награды – она придет в течение суток","progress":0,"price":10,"condition":null,"action_text":"Перейти к брендам","due_time":"1696632991","link":"https://www.lamoda.ru/brands/?sitelink=topmenuM%26l=6"},{"name":"Сделайте заказ на сумму от 5000Р","steps":"","short_description":"Баллы будут начислены через 14 дней с момента выкупа","full_description":"Купите любые товары на сумму от 5000Р. Оплата и доставка любым способом!","status":"inProgres","progress":null,"price":10,"condition":null,"action_text":"Перейти к заказу","due_time":"1696626751","link":"https://www.lamoda.ru/checkout/cart/"},{"name":"Примените промокод при покупке товара BEFREE","steps":"","short_description":"Дополнительно -15%","full_description":"Купите любой товар BEFREE с применённым промокодом AUTMN23","status":"done","progress":null,"price":10,"condition":null,"action_text":"Перейти к покупкам","due_time":"1697920295","link":"https://www.lamoda.ru/cb/4153-22318/default-women-befree/?sitelink=topmenuW%26l=3"},{"name":"Напишите отзыв и дополните его фото купленного товара","steps":"","short_description":"Отзывы помогают сделать правильный выбор!","full_description":"Поделитесь впечатлениями от купленного товара. Не забудьте приложить фото!","status":"inProgres","progress":2,"price":10,"condition":null,"action_text":"Оставить отзыв","due_time":"1697920295","link":"https://www.lamoda.ru/sales/order/history/?sitelink=profile_hover_menu"},{"name":"Расскажите о Lamoda друзьям!","steps":"","short_description":"","full_description":"Пригласите друга в Lamoda по своей уникальной ссылке","status":"new","progress":null,"price":10,"condition":null,"action_text":"Пригласить","due_time":"","link":""}]';
$em = $doctrine->getManager();

$json = json_decode($j, true);

foreach ($json as $item) {
$action = new Action();
$action->setName($item["name"]);
$action->setStartDate(new \DateTimeImmutable());
$action->setFinishDate(new \DateTimeImmutable());
$action->setVisible(true);
$action->setShortDescription($item["short_description"]);
$action->setFullDescription($item["full_description"]);
$action->setPrice($item["price"]);
$action->setActionText($item["action_text"]);
$action->setlink($item["link"]);
$action->setProcessor(uniqid());
$action->setSteps(uniqid());

$em->persist($action);
}
$em->flush();

return $this->json([]);
}