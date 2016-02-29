module.exports = function (grunt){
	'use strict';

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		concat:{
			css:{
				src:[
					'webroot/css/bootstrap.css',
					'webroot/css/bootstrap-theme.css',
					'webroot/css/font-awesome.min.css',
					'webroot/css/sb-admin.css',
					'webroot/css/style.css',
				],
				dest: 'webroot/css/main.css'
			},
			js:{
				src:[
					'webroot/js/jquery.js',
					'webroot/js/jquery-ui.js',
					'webroot/js/bootstrap.js',
				],
				dest:'webroot/js/main.js'
			}
		},

		uglify:{
			my_target:{
				files: {
					'webroot/js/main.min.js': ['webroot/js/main.js']
				}
			}
		}, // minificando js

		cssmin: {
			target: {
				files: [{
					expand: true,
					src: ['webroot/css/main.css'],
					ext: '.min.css'
				}]
			}
		}, // minificando css



	});

	grunt.loadNpmTasks( 'grunt-contrib-concat' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
	//grunt.loadNpmTasks( 'grunt-contrib-watch' );

	//task default
	grunt.registerTask('default',['concat', 'uglify', 'cssmin']);

	//watch
	//grunt.registerTask( 'w', [ 'watch' ] );


}