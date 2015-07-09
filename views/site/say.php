<?php
use yii\helpers\Html;
use yii\web\Session;
?>
<?php echo Html::encode($message); ?>
<?php
$session = new Session;
$session->open();
//print_r($session['attr_login']);
foreach($session['attr_login'] as $name => $value){
	echo "<br>" . $name . ' => ';
	print_r($value);
}
?>