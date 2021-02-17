<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\models\Balance;
use common\models\BalanceCash;
use common\models\Settings;
use common\models\SupportQuestions;
use frontend\assets\CabinetAsset;
use yii\helpers\Html;
use yii\helpers\Url;


$balance = Balance::find()->where(['user_id' => Yii::$app->user->getId()])->one();
$balance_cash = BalanceCash::find()->where(['user_id' => Yii::$app->user->getId()])->one();
$exponent = intval(Settings::getSetting('balance_exponent'));
$support_count = SupportQuestions::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 2])->count();
if ($support_count == 0)
    $support_count = '';
CabinetAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!— Global site tag (gtag.js) - Google Analytics —>
    <script>
        var balance_cash = Number(<?= $balance_cash->amount ?>);
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138968129-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-138968129-1');
    </script>

    <!— Yandex.Metrika counter —>
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(51223025, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true,
            trackHash: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/51223025" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!— /Yandex.Metrika counter —>
</head>
<body>
<?php $this->beginBody() ?>

<div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <div class="mdc-persistent-drawer__wrapper">
        <aside class="mdc-persistent-drawer mdc-persistent-drawer--open" style="height: 100%;">
            <nav class="mdc-persistent-drawer__drawer">
                <div class="mdc-persistent-drawer__toolbar-spacer-wrapper">
                    <div class="mdc-persistent-drawer__toolbar-spacer">
                        <?= Html::img('/images/account.png', ['width' => '32', 'height' => '32']) ?>
                        <span class="brand-logo">
                            <?= Yii::$app->user->identity->email; ?>
                        </span>
                        <div class="email-tooltip"><?= Yii::$app->user->identity->email; ?></div>
                    </div>
                </div>
                <div class="mdc-list-group">
                    <nav class="mdc-list mdc-drawer-menu">
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/']); ?>">
                                <i class="fa fa-home" style="visibility: visible;"></i>
                                <span>На главную</span>
                            </a>
                        </div>
                        <div class="mdc-list mdc-drawer-item">
                            <div class="mdc-menu-anchor mr-1">
                                <a href="#" class="mdc-drawer-link" data-toggle="dropdown"
                                   toggle-dropdown="menu" data-mdc-auto-init="MDCRipple">
                                    <i class="material-icons">view_list</i>
                                    <span>Накрутка Behance</span>
                                    <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                                <!-- <div class="mdc-simple-menu mdc-simple-menu" tabindex="-1" id="menu">
                                    <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">

                                        <li class="mdc-list-item" role="menuitem" tabindex="0">

                                            <a style="text-decoration: none; font-size: 14px;"
                                               href="<?= Url::toRoute(['/cabinet/accounts']); ?>">
                                                <i class="fa fa-user" style="font-size: 16px;"></i>
                                                Аккаунты</a>

                                        </li>
                                        <li class="mdc-list-item" role="menuitem" tabindex="0">

                                            <a style="text-decoration: none; font-size: 14px;"
                                               href="<?= Url::toRoute(['/cabinet/works']); ?>">
                                                <i class="fa fa-suitcase" style="font-size: 16px;"></i>
                                                Работы</a>

                                        </li>
                                        <li class="mdc-list-item" role="menuitem" tabindex="0">

                                            <a style="text-decoration: none; font-size: 14px;"
                                               href="<?= Url::toRoute(['/cabinet/queue']); ?>">
                                                <i class="fa fa-heart" style="font-size: 16px;"></i>
                                                Работы в лайкере</a>

                                        </li>
                                        <li class="mdc-list-item" role="menuitem" tabindex="0">

                                            <a style="text-decoration: none; font-size: 14px;"
                                               href="<?= Url::toRoute(['/cabinet/payment']); ?>">
                                                <i class="fa fa-usd" style="font-size: 16px;"></i>
                                                Пополнить лайкер</a>
                                        </li>
                                        <li class="mdc-list-item" role="menuitem" tabindex="0">

                                            <a style="text-decoration: none; font-size: 14px;"
                                               href="<?= Url::toRoute(['/cabinet/cabinet/referal']); ?>">
                                                <i class="fa fa-user" style="font-size: 16px;"></i>
                                                Партнерская программа</a>
                                        </li>

                                    </ul>
                                </div> -->
                                <div class="mdc-simple-menu mdc-simple-menu" tabindex="-1" id="menu">
                                    <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                                        <div onClick="document.location='<?= Url::toRoute(['/cabinet/instruction']); ?>'">
                                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                <a style="text-decoration: none; font-size: 14px;"
                                                   href="<?= Url::toRoute(['/cabinet/instruction']); ?>">
                                                    <i class="fa fa-gears" style="visibility: visible;"></i>
                                                    Инструкция
                                                </a>
                                            </li>
                                        </div>
                                        <div onClick="document.location='<?= Url::toRoute(['/cabinet/accounts']); ?>'">
                                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                <a style="text-decoration: none; font-size: 14px;"
                                                   href="<?= Url::toRoute(['/cabinet/accounts']); ?>">
                                                    <i class="fa fa-user" style="font-size: 16px;"></i>
                                                    Аккаунты</a>
                                            </li>
                                        </div>
                                        <div onClick="document.location='<?= Url::toRoute(['/cabinet/works']); ?>'">
                                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                <a style="text-decoration: none; font-size: 14px;"
                                                   href="<?= Url::toRoute(['/cabinet/works']); ?>">
                                                    <i class="fa fa-suitcase" style="font-size: 16px;"></i>
                                                    Работы</a>
                                            </li>
                                        </div>
                                        <div onClick="document.location='<?= Url::toRoute(['/cabinet/queue']); ?>'">
                                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                <a style="text-decoration: none; font-size: 14px;"
                                                   href="<?= Url::toRoute(['/cabinet/queue']); ?>">
                                                    <i class="fa fa-heart" style="font-size: 16px;"></i>
                                                    Работы в лайкере</a>
                                            </li>
                                        </div>
                                        <div onClick="document.location='<?= Url::toRoute(['/cabinet/payment']); ?>'">
                                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                <a style="text-decoration: none; font-size: 14px;"
                                                   href="<?= Url::toRoute(['/cabinet/payment']); ?>">
                                                    <i class="fa fa-usd" style="font-size: 16px;"></i>
                                                    Пополнить лайкер</a>
                                            </li>
                                        </div>
                                        <div onClick="document.location='<?= Url::toRoute(['/cabinet/cabinet/referal']); ?>'">
                                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                <a style="text-decoration: none; font-size: 14px;"
                                                   href="<?= Url::toRoute(['/cabinet/cabinet/referal']); ?>">
                                                    <i class="fa fa-user" style="font-size: 16px;"></i>
                                                    Партнерская программа</a>
                                            </li>
                                        </div>
                                        <div onClick="document.location='<?= Url::toRoute('/cabinet/history') ?>'">
                                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                <a style="text-decoration: none; font-size: 14px;"
                                                   href="<?= Url::toRoute(['/cabinet/history']); ?>">
                                                    <i class="fa fa-history" style="visibility: visible;"></i>
                                                    История пополнений лайкера</a>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/accounts']); ?>">
                                <i class="fa fa-user" style="visibility: visible;"></i>
                                <span>Аккаунты</span>
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/works']); ?>">
                                <i class="fa fa-suitcase" style="visibility: visible;"></i>
                                <span>Работы</span>
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/queue']); ?>">
                                <i class="fa fa-heart" style="visibility: visible;"></i>
                                <span>Работы в лайкере</span>
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/payment']); ?>">
                                <i class="fa fa-usd"></i>
                                <span>Пополнить лайкер</span>
                            </a>
                        </div>
                        -->
                        <!--
                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="<?= Url::toRoute('/cabinet/history') ?>">
                                    <i class="fa fa-history" style="visibility: visible;"></i>
                                    <span>История пополнений</span>
                                </a>
                            </div>
                            -->

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/social-queue/create']); ?>">
                                <i class="fa fa-edit" style="visibility: visible;"></i>
                                <span>Накрутить</span>
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/social-queue/']); ?>">
                                <i class="fa fa-heart" style="visibility: visible;"></i>
                                <span>Мои заказы</span>
                            </a>
                        </div>
                        <!--
                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/social-queue']); ?>">
                                    <i class="fa fa-heart" style="visibility: visible;"></i>
                                    <span>Накрутка соц. сетей</span>
                                </a>
                            </div>
    -->

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/payment-cash']); ?>">
                                <i class="fa fa-usd"></i>
                                <span>Пополнить баланс</span>
                            </a>
                        </div>
                        <!--    <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<? /*= Url::toRoute('/cabinet/history') */ ?>">
                                <i class="fa fa-history" style="visibility: visible;"></i>
                                <span>История пополнений</span>
                            </a>
                        </div>-->

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute('/cabinet/history-cash') ?>">
                                <i class="fa fa-history" style="visibility: visible;"></i>
                                <span>История пополнений</span>
                            </a>
                        </div>

                        <div class="mdc-list-item mdc-drawer-item">
                            <a class="mdc-drawer-link" href="<?= Url::toRoute('/cabinet/support') ?>">
                                <i class="fa fa-headphones" style="visibility: visible;"></i>
                                <span>Тех. Поддержка </span>
                                <!--<small class="label pull-right bg-red"> <? /*= $support_count */ ?></small></span>-->
                                <b style="color:blue;"> &nbsp <?= $support_count ?></b>
                            </a>

                        </div>

                        <!--
                            <div class="mdc-list-item mdc-drawer-item">
                                <a class="mdc-drawer-link" href="<?= Url::toRoute('/cabinet/cabinet/referal') ?>">
                                    <i class="fa fa-users"></i>
                                    <span>Партнерская программа</span>
                                </a>
                            </div>
    -->

                        <!--                    					<div class="mdc-list-item mdc-drawer-item" href="#" data-toggle="expansionPanel" target-panel="sample-page-submenu">-->
                        <!--                    						<a class="mdc-drawer-link" href="#">-->
                        <!--                    							<i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pages</i>-->
                        <!--                    							Sample Pages-->
                        <!--                    							<i class="mdc-drawer-arrow material-icons">arrow_drop_down</i>-->
                        <!--                    						</a>-->
                        <!---->
                        <!--                    						<div class="mdc-expansion-panel" id="sample-page-submenu">-->
                        <!--                    							<nav class="mdc-list mdc-drawer-submenu">-->
                        <!--                    								<div class="mdc-list-item mdc-drawer-item">-->
                        <!--                    									<a class="mdc-drawer-link" href="pages/samples/blank-page.html">-->
                        <!--                    										Blank Page-->
                        <!--                    									</a>-->
                        <!--                    								</div>-->
                        <!--                    								<div class="mdc-list-item mdc-drawer-item">-->
                        <!--                    									<a class="mdc-drawer-link" href="pages/samples/403.html">-->
                        <!--                    										403-->
                        <!--                    									</a>-->
                        <!--                    								</div>-->
                        <!--                    								<div class="mdc-list-item mdc-drawer-item">-->
                        <!--                    									<a class="mdc-drawer-link" href="pages/samples/404.html">-->
                        <!--                    										404-->
                        <!--                    									</a>-->
                        <!--                    								</div>-->
                        <!--                    								<div class="mdc-list-item mdc-drawer-item">-->
                        <!--                    									<a class="mdc-drawer-link" href="pages/samples/500.html">-->
                        <!--                    										500-->
                        <!--                    									</a>-->
                        <!--                    								</div>-->
                        <!--                    								<div class="mdc-list-item mdc-drawer-item">-->
                        <!--                    									<a class="mdc-drawer-link" href="pages/samples/505.html">-->
                        <!--                    										505-->
                        <!--                    									</a>-->
                        <!--                    								</div>-->
                        <!--                    								<div class="mdc-list-item mdc-drawer-item">-->
                        <!--                    									<a class="mdc-drawer-link" href="pages/samples/login.html">-->
                        <!--                    										Login-->
                        <!--                    									</a>-->
                        <!--                    								</div>-->
                        <!--                    								<div class="mdc-list-item mdc-drawer-item">-->
                        <!--                    									<a class="mdc-drawer-link" href="pages/samples/register.html">-->
                        <!--                    										Register-->
                        <!--                    									</a>-->
                        <!--                    								</div>-->
                        <!---->
                        <!--                    							</nav>-->
                        <!--                    						</div>-->
                        <!--                    					</div>-->

                    </nav>
            </nav>
        </aside>
    </div>
    <!-- partial -->
    <!-- partial:partials/_navbar.html -->
    <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                <a href="#" class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
                <!-- --><?php /*if (Yii::$app->request->url == '/cabinet/accounts' or
                    Yii::$app->request->url == '/cabinet/works' or
                    Yii::$app->request->url == '/cabinet/queue' or
                    Yii::$app->request->url == '/cabinet/payment' or
                    Yii::$app->request->url == '/cabinet/instruction' or
                    Yii::$app->request->url == '/cabinet/cabinet/referal' or
                    Yii::$app->request->url == '/cabinet/history'): */ ?>
                <?php if (!empty($balance)): ?>
                    <div class="balance-block">
                        <span class="mdc-toolbar__icon" style="width: max-content">Лайки Behance:&nbsp;<span
                                    id="balance_likes"><?= $balance->likes ?></span></span>
                    </div>

                    <div class="balance-block">
                        <span class="mdc-toolbar__icon" style="width: max-content">Просмотры Behance:&nbsp;<span
                                    id="balance_views"><?= $balance->views ?></span></span>
                    </div>
                <?php endif; ?>
                <?php /*endif; */ ?>
                <?php if (!empty($balance_cash)): ?>
                    <div class="balance-block">
                        <a class="mdc-drawer-link" href="<?= Url::toRoute(['/cabinet/payment-cash']); ?>">
                        <span class="mdc-toolbar__icon">Баланс:&nbsp;<span
                                    id="balance_cash"><?= $balance_cash->amount / $exponent ?></span>$</span>
                        </a>
                    </div>
                <?php endif; ?>
            </section>
            <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
                <!--				<div class="mdc-menu-anchor">-->
                <!--					<a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="notification-menu" data-mdc-auto-init="MDCRipple">-->
                <!--						<i class="material-icons">notifications</i>-->
                <!--						<span class="dropdown-count">3</span>-->
                <!--					</a>-->
                <!--					<div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="notification-menu">-->
                <!--						<ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">-->
                <!--							<li class="mdc-list-item" role="menuitem" tabindex="0">-->
                <!--								<i class="material-icons mdc-theme--primary mr-1">email</i>-->
                <!--								One unread message-->
                <!--							</li>-->
                <!--							<li class="mdc-list-item" role="menuitem" tabindex="0">-->
                <!--								<i class="material-icons mdc-theme--primary mr-1">group</i>-->
                <!--								One event coming up-->
                <!--							</li>-->
                <!--							<li class="mdc-list-item" role="menuitem" tabindex="0">-->
                <!--								<i class="material-icons mdc-theme--primary mr-1">cake</i>-->
                <!--								It's Aleena's birthday!-->
                <!--							</li>-->
                <!--						</ul>-->
                <!--					</div>-->
                <!--				</div>-->


                <div class="mdc-menu-anchor mr-1">
                    <a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown"
                       toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple">
                        <i class="material-icons">more_vert</i>
                    </a>

                    <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu"
                         onClick="document.location='<?= Url::toRoute(['cabinet/logout']); ?>'">
                        <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                            <a style="text-decoration: none; font-size: 14px;"
                               href="<?= Url::toRoute(['cabinet/logout']); ?>">
                                <li class="mdc-list-item" role="menuitem" tabindex="0">
                                    <i class="material-icons mdc-theme--primary mr-1" style="font-size: 16px;">power_settings_new</i>
                                    Logout
                            </a>
                            </li>
                        </ul>
                    </div>

                    <!-- <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                        <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                            <a style="text-decoration: none; font-size: 14px;"
                               href="<?= Url::toRoute(['cabinet/logout']); ?>">
                                <li class="mdc-list-item" role="menuitem" tabindex="0">
                                    <i class="material-icons mdc-theme--primary mr-1" style="font-size: 16px;">power_settings_new</i>
                                    Logout</a>
                                </li>
                        </ul>
                    </div>
                    -->
                </div>
            </section>
        </div>
    </header>
    <!-- partial -->
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
            <div style="padding: 0px 20px;">

                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong style="font-size: 15px;"><?= Yii::$app->session->getFlash('error'); ?></strong>
                    </div>
                <?php endif; ?>

                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong style="font-size: 15px;"><?= Yii::$app->session->getFlash('success'); ?></strong>
                    </div>
                <?php endif; ?>

                <?= $content ?>
            </div>

        </main>


        <footer>
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">

                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 d-flex justify-content-end">

                    </div>
                </div>
            </div>
        </footer>


        <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
