<div class="container">
    <div class="page">
        <div class="header" itemscope itemtype="http://schema.org/WPHeader">
            <div class="page__title">
                <h1 itemprop="name">О нас</h1>
            </div>
            <div class="breadcrumbs">
                <ul class="breadcrumbs__list" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem" class="home">
                        <a title="Перейти на главную" href="/" class="link" itemprop="item">
                            <span itemprop="name">Главная</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li class="active" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                        <a href="/<?= $moduls->link ?>" class="link" itemprop="item">
                            <span itemprop="name"><?= (!empty($moduls->title) ? $moduls->title : $moduls->name) ?></span>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>
                </ul>
            </div>
        </div>
        <div class="page__content">
            <div class="row">
                <div class="row__col-4">
                    <img class="page__image" src="/uploads/images/about.webp" alt="О компании">
                </div>
                <div class="row__col-8">
                    <div class="page__text">
                        <p>Интернет-магазин тканей и трикотажных полотен «АРТиШОК» это всегда широкий выбор различных
                            видов трикотажа самого высокого качества, ткани, ниток и фурнитуры. Мы работаем с ведущими
                            фабриками по производству тканей и трикотажа как за рубежом, так и с представительствами на
                            территории РФ.</p>
                        <p>Мы всегда стараемся поддерживать большой ассортимент в наличии на складе, что позволяет нам
                            своевременно и оперативно удовлетворять даже самые требовательные вкусы покупателей.</p>
                        <p>Мы дорожим каждым нашим клиентом и готовы отправить вам отрез любого необходимого размера. Вы
                            можете быть абсолютно уверены, что в кратчайшие сроки получите товар самого высоко качества,
                            что подтверждается большим количеством самых лестных отзывов.</p>
                    </div>
                </div>
                <div class="row__col-12">
                    <div class="page__text">
                        <p>Команда «АРТиШОК» нацелена на долгосрочное сотрудничество с каждым нашим заказчиком. Именно
                            поэтому мы крайне ответственно подходим к отбору всех позиций, которые представлены в
                            магазине. Полотна и ткань тщательно тестируются не только нами, но и многими популярными
                            швейными блогерами, что позволяет точно сказать – шить из наших материалов сплошное
                            удовольствие!</p>
                        <p>Наш интернет-магазин – это быстро развивающаяся компания. Мы постоянно ищем для вас только
                            лучших поставщиков тканей, трикотажа, фурнитуры и новых удобных способов логистики. Заказы
                            отправляются не только по России, но и в страны СНГ, Европу и США.</p>
                        <div class="page__text-title">
                            <h2>ПОЧЕМУ МЫ?</h2>
                        </div>
                        <p>Интернет-магазин тканей и трикотажных полотен «АРТиШОК» это быстро развивающаяся компания,
                            которая готова предложить Вам:</p>
                        <ul class="page__list">
                            <li>1. Быструю обработку заказа</li>
                            <li>2. Помощь в любых вопросах по выбору полотна, цвета, фурнитуры, а также поможем
                                рассчитать необходимый метраж.
                            </li>
                            <li>3. Оперативную сборку и отправку заказов</li>
                            <li>4. Возможность отдельно заказать образцы</li>
                            <li>5. Отправку заказов за рубеж</li>
                            <li>6. Постоянное пополнение ассортимента</li>
                            <li>7. Систему лояльности и акции</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
