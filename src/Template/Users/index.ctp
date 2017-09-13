<?php 
echo $this->Form->create('User', ['type'=>'post']);
echo $this->Form->text('screen_name');
echo $this->Form->text('email');
echo $this->Form->text('access_token');
echo $this->Form->text('access_token_se');
echo $this->Form->int('user_type');
echo $this->Form->submit('送信');
echo $this->Form->end();
