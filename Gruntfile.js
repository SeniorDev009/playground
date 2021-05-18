module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        phpcs: {
            application: {
                dir: ['src/**/*.php']
            },
            options: {
                standard: 'Symfony2',
                errorSeverity: 0,
                extensions: 'php'
            }
        },

        watch: {
            php: {
                files: 'src/**/*.php',
                tasks: ['phpcs'],
                options: {
                    spawn: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks("grunt-phplint");
    grunt.loadNpmTasks("grunt-phpcs");
};
