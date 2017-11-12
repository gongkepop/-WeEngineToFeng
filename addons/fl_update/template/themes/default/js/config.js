require.config({
	baseUrl: '/web/resource/js/app',
	paths: {
		'jquery': '/web/resource/js/lib/jquery-1.11.1.min',
		'jquery.ui': '/web/resource/js/lib/jquery-ui-1.10.3.min',
		'jquery.caret': '/web/resource/js/lib/jquery.caret',
		'jquery.jplayer': '/web/resource/components/jplayer/jquery.jplayer.min',
		'jquery.zclip': '/web/resource/components/zclip/jquery.zclip.min',
		'bootstrap': '/web/resource/js/lib/bootstrap.min',
		'bootstrap.switch': '/web/resource/components/switch/bootstrap-switch.min',
		'angular': '/web/resource/js/lib/angular.min',
		'angular.sanitize': '/web/resource/js/lib/angular-sanitize.min',
		'underscore': '/web/resource/js/lib/underscore-min',
		'chart': '/web/resource/js/lib/chart.min',
		'moment': '/web/resource/js/lib/moment',
		'filestyle': '/web/resource/js/lib/bootstrap-filestyle.min',
		'datetimepicker': '/web/resource/components/datetimepicker/jquery.datetimepicker',
		'daterangepicker': '/web/resource/components/daterangepicker/daterangepicker',
		'colorpicker': '/web/resource/components/colorpicker/spectrum',
		'map': 'http://api.map.baidu.com/getscript?v=2.0&ak=F51571495f717ff1194de02366bb8da9&services=&t=20140530104353',
		'editor': '/web/resource/components/tinymce/tinymce.min',
		'kindeditor':'/web/resource/components/kindeditor/lang/zh_CN',
		'kindeditor.main':'/web/resource/components/kindeditor/kindeditor-min',
		'css': '/web/resource/js/lib/css.min',
		'webuploader' : '../../components/webuploader/webuploader.min',
		'json2' : '../lib/json2',
		'wapeditor' : './wapeditor',
		'jquery.wookmark': '../lib/jquery.wookmark.min',
		'validator': '../lib/bootstrapValidator.min',
		'select2' : '../../components/select2/zh-CN',
		'clockpicker': '../../components/clockpicker/clockpicker.min',
		'jquery.qrcode': '../lib/jquery.qrcode.min',
		'raty': '../lib/raty.min'
	},
	shim:{
		'jquery.ui': {
			exports: "$",
			deps: ['jquery']
		},
		'jquery.caret': {
			exports: "$",
			deps: ['jquery']
		},
		'jquery.jplayer': {
			exports: "$",
			deps: ['jquery']
		},
		'bootstrap': {
			exports: "$",
			deps: ['jquery']
		},
		'bootstrap.switch': {
			exports: "$",
			deps: ['bootstrap', 'css!../../components/switch/bootstrap-switch.min.css']
		},
		'angular': {
			exports: 'angular',
			deps: ['jquery']
		},
		'angular.sanitize': {
			exports: 'angular',
			deps: ['angular']
		},
		'emotion': {
			deps: ['jquery']
		},
		'chart': {
			exports: 'Chart'
		},
		'filestyle': {
			exports: '$',
			deps: ['bootstrap']
		},
		'daterangepicker': {
			exports: '$',
			deps: ['bootstrap', 'moment', 'css!../../components/daterangepicker/daterangepicker.css']
		},
		'datetimepicker' : {
			exports : '$',
			deps: ['jquery', 'css!../../components/datetimepicker/jquery.datetimepicker.css']
		},
		'kindeditor': {
			deps: ['kindeditor.main', 'css!../../components/kindeditor/themes/default/default.css']
		},
		'colorpicker': {
			exports: '$',
			deps: ['css!../../components/colorpicker/spectrum.css']
		},
		'map': {
			exports: 'BMap'
		},
		'json2': {
			exports: 'JSON'
		},
		'webuploader': {
			deps: ['css!../../components/webuploader/webuploader.css', 'css!../../components/webuploader/style.css']
		},
		'wapeditor' : {
			exports : 'angular',
			deps: ['angular.sanitize', 'jquery.ui', 'underscore', 'fileUploader', 'json2', 'datetimepicker']
		},
		'jquery.wookmark': {
			exports: "$",
			deps: ['jquery']
		},
		'validator': {
			exports: "$",
			deps: ['bootstrap']
		},
		'select2': {
			deps: ['css!../../components/select2/select2.min.css', './resource/components/select2/select2.min.js']
		},
		'clockpicker': {
			exports: "$",
			deps: ['css!../../components/clockpicker/clockpicker.min.css', 'bootstrap']
		},
		'jquery.qrcode': {
			exports: "$",
			deps: ['jquery']
		}
	}
});