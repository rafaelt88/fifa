<?php
return CMap::mergeArray(
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'Quiniela Brasil 2014',
        'charset' => 'UTF-8',
        'theme' => 'default',
        'language' => 'es',
        'import' => array(
            'application.components.*',
            'application.models.*',
            'application.models.base.*'
        ),
        'modules' => array(
        ),
        'components' => array(
            'widgetFactory' => array(
                'widgets' => array(
                    'CDetailView' => array(
                        'itemTemplate' => "<tr><td class='col-sm-4'><b>{label}</b></td><td class='col-sm-8'>{value}</td></tr>\n",
                        'htmlOptions' => array(
                            'role' => 'view',
                            'class' => 'table table-bordered table-striped'
                        )
                    ),
                    'CGridView' => array(
                        'cssFile' => false,
                        'template' => '<div class="row" style="margin: 0px; margin-bottom: 5px;"><small>{summary}</small>{pager}</div>{items}',
                        'loadingCssClass' => null,
                        'itemsCssClass' => 'table table-bordered table-hover',
                        'pagerCssClass' => 'pull-right',
                        'summaryCssClass' => 'pull-left hidden-xs',
                        'rowCssClassExpression' => null,
                        'ajaxType' => 'POST',
                        'htmlOptions' => array(
                            'role' => 'grid',
                            'style' => 'cursor: pointer; width: auto;'
                        )
                    ),
                    'CLinkPager' => array(
                        'cssFile' => false,
                        'header' => false,
                        'firstPageLabel' => '<span class="fa fa-step-backward"></span>',
                        'lastPageLabel' => '<span class="fa fa-step-forward"></span>',
                        'prevPageLabel' => '<span class="fa fa-chevron-left"></span>',
                        'nextPageLabel' => '<span class="fa  fa-chevron-right"></span>',
                        'maxButtonCount' => 5,
                        'firstPageCssClass' => null,
                        'lastPageCssClass' => null,
                        'previousPageCssClass' => null,
                        'nextPageCssClass' => null,
                        'internalPageCssClass' => null,
                        'hiddenPageCssClass' => null,
                        'selectedPageCssClass' => 'active',
                        'htmlOptions' => array(
                            'role' => 'pager',
                            'class' => 'pagination pagination-sm pull-right',
                            'style' => 'padding: 0px; margin: 0px;'
                        )
                    ),
                    'CActiveForm' => array(
                        'enableClientValidation' => true,
                        'errorMessageCssClass' => 'has-error',
                        'clientOptions' => array(
                            'errorCssClass' => 'has-error text-danger',
                            'successCssClass' => 'has-success',
                            'inputContainer' => '.form-group'
                        ),
                        'errorMessageCssClass' => 'text-danger',
                        'htmlOptions' => array(
                            'role' => 'form',
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                            'autocomplete' => 'off'
                        )
                    ),
                    'CBreadcrumbs' => array(
                        'separator' => '<span class="fa fa-sort-desc fa-rotate-90" style="margin-right: 5px;"></span>',
                        'encodeLabel' => false,
                        'htmlOptions' => array(
                            'class' => 'breadcrumb pull-right',
                            'style' => 'font-size: 12px;'
                        )
                    ),
                    'CJuiDatePicker' => array(
                        'language' => 'es',
                        'options' => array(
                            'showAnim' => 'fold',
                            'changeMonth' => 'true',
                            'changeYear' => 'true'
                        ),
                        'htmlOptions' => array(
                            'style' => 'z-index:99;'
                        )
                    ),
                    'CJuiAutoComplete' => array(
                        'options' => array(
                            'minLength' => 2,
                            'showAnim' => 'fold'
                        )
                    ),
                    /* jQuery UI
                    'CJuiWidget' => array(
                        'themeUrl' => '/css/jqueryui',
                        'theme' => 'fc',
                    ),
                    */
                )
            ),
            'user' => array(
                'authTimeout' => 3600
            ),
            'format' => array(
                'class' => 'CLocalizedFormatter',
                'locale' => 'es_ve'
            ),
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => array(
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>/<id:\w+==>' => '<controller>/<action>'
                )
            ),
            'coreMessages' => array(
                'basePath' => dirname(__FILE__) . '/../messages'
            ),
            'errorHandler' => array(
                'errorAction' => 'site/error'
            )
        )
    ), require_once ('params.php'));
