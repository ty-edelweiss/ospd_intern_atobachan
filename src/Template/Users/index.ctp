<?php 
echo $this->Form->create('User', ['type'=>'post']);
echo $this->Form->text('username');
echo $this->Form->submit('送信');
echo $this->Form->end();
