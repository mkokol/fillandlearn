module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({
    });

    grunt.registerTask('build', function() {
        grunt.log.write("Start Grunt");
    });

    grunt.registerTask('default', ['build']);
}