<?php

use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $reviews object
 * @var $cases object
 */


$this->title = 'О сервисе';

if ($seo) {
    $meta = json_decode($seo->value);

    $this->registerMetaTag([
        'name' => 'description',
        'content' => $meta->descr
    ]);

    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $meta->keywords
    ]);

    $this->title = $meta->title;
}

$this->registerCssFile('/css/service.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
?>


<div class="root">
    <header class="header-small-wrap">
        <div class="header__stars1 header__stars">
            <div class="stars"></div>
            <div class="stars2"></div>
            <div class="stars3"></div>
            <img src="/images/header-bg3.png" alt=""/>
        </div>
        <div class="header">
            <div class="container">
                <?= $this->render('header-menu'); ?>
                <div class="header__phone">
                    <?= \frontend\widgets\BehancePhoneWidget::widget(['userIsGuest' => Yii::$app->user->isGuest]); ?>
                    <div class="header__phone-text">
                        <a class="btn btn-pink"
                           href="<?= (Yii::$app->user->isGuest) ? Url::toRoute(['site/signup']) : Url::toRoute(['/cabinet/cabinet/referal']); ?>">
                            <span class="btn-thumb">
                                <i class="fa fa-thumbs-up wow"></i>
                                <span class="btn-thumb-circle wow"></span>
                            </span>
                            <span>получить <span class="fw-extra-bold"><span
                                            class="btn-number">Бонус</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <section class="about-wrap">
            <div class="container">
                <div class="about">
                    <div class="about__title">
                        <h2 class="title d-inline-block ml-auto title-light mb-0">узнай больше</h2>
                        <h1 class="title-big title-big-second">О сервисе</h1>
                    </div>
                    <div class="about__main-text main-text">
                        <p>Выйти на новый уровень дизайнеру поможет Behance — ресурс, где с хорошим портфолио и
                            рейтинговым кол-вом лайков / просмотров, предложения о сотрудничестве будут приходить сами,
                            без долгих дополнительных поисков.</p>
                        <p>Наш сервис это не просто «накрутка», мы делаем уникальное продвижение Ваших работ по
                            разработанному алгоритму, которое позволяет увеличить лайки аккаунта и отдельной работы до
                            3000 и просмотры до 10000, благодаря чему Ваш проект попадает в недельный ТОП Behance и
                            получает ряд преимуществ:</p>
                    </div>
                    <div class="about__main">
                        <div class="about__main-left">
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">Как можно больше активности </span><span
                                            class="action__item-text">от пользователей Behance (лайки, подписки и добавление работ в коллекции)
коментарии и адекватную критику своих работ, а так же выгодно выделиться
на фоне новичков.</span></div>
                            </div>
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span
                                            class="action__item-title">Получте уже сейчас</span><span
                                            class="action__item-text">коммерческие заказы  / предложения долгосрочного сотрудничества
и начните зарабатывать на своих работах, не прилагая усилий</span></div>
                            </div>
                            <div class="about__item action__item">
                                <div class="action__item-img"><img src="/images/icons/action1.png" alt=""/></div>
                                <div class="action__item-main"><span class="action__item-title">вывод в топ</span><span
                                            class="action__item-text">Возможность быстрее конкурентов попасть в ТОП, вероятность что
кураторы Behance добавят Вашу работу в одну из курируемых галерей
возрастает (behance.net/galleries)
</span></div>
                            </div>
                            <div class="about__bottom action__bottom"><span class="action__bottom-text">Хочу принять участие в акции</span>
                                <div class="btn-arrow">
                                    <svg class="arrow-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 43.1 85.9" style="enable-background:new 0 0 43.1 85.9;"
                                         xml:space="preserve">
<path stroke-linecap="round" stroke-linejoin="round" class="st0 draw-arrow wow"
      d="M11.3,2.5c-5.8,5-8.7,12.7-9,20.3s2,15.1,5.3,22c6.7,14,18,25.8,31.7,33.1"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              class="draw-arrow tail-1 wow" d="M40.6,78.1C39,71.3,37.2,64.6,35.2,58"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              class="draw-arrow tail-2 wow" d="M39.8,78.5c-7.2,1.7-14.3,3.3-21.5,4.9"/>
</svg>
                                    <a href="<?= (Yii::$app->user->isGuest) ? Url::toRoute(['site/signup']) : Url::toRoute(['/cabinet/cabinet/referal']); ?>">
                                        <button class="btn btn-pink"><span>получить <span class="fw-extra-bold">
                                        <span class="btn-number">Бонус</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="about__main-right">
                            <div class="action__right">
                                <div class="action__img">
                                    <div class="action__img-text"><span
                                                class="fw-extra-bold js-number">11,470</span><span>просмотров!</span>
                                    </div>
                                    <img src="/images/girl.png" alt=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?= $this->render('contact'); ?>
    </main>

    <?= $this->render('footer'); ?>
</div>

