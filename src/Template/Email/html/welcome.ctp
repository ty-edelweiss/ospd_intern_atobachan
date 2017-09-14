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

$prefix = 'あなたのお孫さんから@おばあちゃんへの登録が申請されました。下のアドレスを開いてください。';
$suffix = '何かあればこちらにご連絡下さい -> xxxx-xxxx-xxxx';

echo $this->Text->autoParagraph($prefix);
echo $this->Text->autoLink($content);
echo $this->Text->autoParagraph($suffix);
