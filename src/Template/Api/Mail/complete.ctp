<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$this->layout = false;

$siteDescription = '@おばあちゃん |　高齢者をつなぐSNS'
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $siteDescription ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('complete.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body>

<div id="app">
    <div class="header">
        <h1 class="brand">@おばあちゃん</h1>
    </div>
    <div class="contents">
        <div class="notification <?= $stats == 'success' ? 'notification-success' : 'notification-fail' ?>">
            <?php
            if ($stats == 'success') {
                echo '<p class="success-head">Twitterとの連携を完了しました</p>';
                echo '<p class="success-body">右上のDoneを押してこのページを閉じて下さい</p>';
            } else {
                echo '<p class="fail-head">Twitterと連携に失敗しました</p>';
                echo '<p class="fail-body">サーバ混雑のため時間を置いてアクセスして下さい</p>';
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
