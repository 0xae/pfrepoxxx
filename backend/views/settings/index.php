<style type="text/css"> .content.box_cont { padding-left: 0; padding-right: 0; } </style> 
<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Settings';
?>

<div class="container-fluid settings" ng-controller="SettingsController">
	<div role="tabpanel" style="padding:0;">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#usertab" aria-controls="home" role="tab" data-toggle="tab">Users</a>
			</li>
			<li role="presentation">
				<a href="#permissaotab" aria-controls="profile" role="tab" data-toggle="tab">Permissions</a>
			</li>
			<li role="presentation">
				<a href="#countryTab" aria-controls="country" role="tab" data-toggle="tab">Country</a>
			</li>
			<li role="presentation">
				<a href="#businessRule" aria-controls="business" role="tab" data-toggle="tab">Business Rule</a>
			</li>
			<li role="presentation">
				<a href="#paymentChannel" aria-controls="payment_channel" role="tab" data-toggle="tab">Payments</a>
			</li>
			<li role="presentation">
				<a href="#faq" aria-controls="faq" role="tab" data-toggle="tab">FAQ</a>
			</li>
		</ul>

		<div class="tab-content">
			<div role="tabpanel" class="biz-pane tab-pane active" id="usertab">
                <?php echo $this->render('users_module', ['users' => $users]); ?>
			</div>

			<div role="tabpanel" class="biz-pane tab-pane" id="permissaotab">
                <?php echo $this->render('permissions_module', ['permissions' => $permissions]); ?>
			</div>

			<div role="tabpanel" class="biz-pane tab-pane" id="countryTab">
                <?php echo $this->render('country_module', ['countries' => $countries]); ?>
			</div>

			<div role="tabpanel" class="biz-pane tab-pane" id="businessRule">
                <?php echo $this->render('bizrule_module', ['rules' => $rules]); ?>
			</div>

			<div role="tabpanel" class="biz-pane tab-pane" id="paymentChannel">
                <?php echo $this->render('paymentchannel_module', ['paymentChannels' => $paymentChannels,
                                                                   'paymentCards'=>$paymentCards]); ?>
			</div>

			<div role="tabpanel" class="biz-pane tab-pane" id="faq">
                <?php echo $this->render('faq_module', ['faqs' => $faqs]); ?>
			</div>
		</div>
	</div>
</div>

<?php
$view = @$_GET['view'];
$script = <<<JS
var tab = '$view';
$("a[href='#"+tab+"']").tab('show');
JS;

$this->registerJs($script);
?>

