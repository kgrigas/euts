<h1>Properties For Sale</h1>
<div id='propertiesListAll' class="tab-pane active fade in">
	<?php $this->widget('zii.widgets.CListView', array(
		'beforeAjaxUpdate' => 'function(){
			$("html, body").animate({scrollTop: $("#properties").position().top }, 300);
		}',
		'dataProvider'=>$properties->search(),
		'emptyText'=>'No properties found',
		'enableHistory'=>true,
		'htmlOptions'=>array(
			'data-page'=>(!empty($_REQUEST['MfgProperties_page']) ? $_REQUEST['MfgProperties_page'] : 1),
		),
		'id'=>'propertiesList',
		'itemView'=>'_searchItem',
		'pager'=>array(
			'class'=>'CLinkPager',
			'header'=>'',
			'htmlOptions'=>array(
				'style'=>'display: block; margin-left: auto; margin-right: auto;',
			),
			//'internalPageCssClass'=>'button',
		),
		'summaryText'=>'Showing {start}-{end} of {count} properties for sale',
		'template'=>'{items}{pager}'
	)); ?>
</div>