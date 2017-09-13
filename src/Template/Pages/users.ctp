<?php
echo $this->Form->create(null, [
    'url' => ['controller' => 'Api\Users', 'action' => 'index']
]);
echo 'screen_name';
echo $this->Form->text('screen_name');
echo 'email';
echo $this->Form->text('email');
echo $this->Form->submit('submit');
echo $this->Form->end();
