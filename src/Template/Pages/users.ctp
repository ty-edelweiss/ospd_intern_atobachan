<?php
echo $this->Form->create(null, [
    'url' => ['controller' => 'Api\Users', 'action' => 'index']
]);
echo 'young_screen_name';
echo $this->Form->text('young_screen_name');
echo 'old_screen_name';
echo $this->Form->text('old_screen_name');
echo 'email';
echo $this->Form->text('email');
echo $this->Form->submit('submit');
echo $this->Form->end();
