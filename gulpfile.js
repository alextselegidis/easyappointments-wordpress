var gulp = require('gulp'),
    sync = require('gulp-dir-sync'),
    exec = require('child_process').execSync,
    fs = require('fs-extra'),
    zip = require('zip-dir');

/**
 * Create a ZIP package for the plugin.
 */
gulp.task('build', function(done) {
    fs.removeSync('.tmp-package');
    fs.removeSync('easyappointments-wp.zip');
    fs.copySync('src', '.tmp-package');
    fs.copySync('LICENSE', '.tmp-package/LICENSE');
    zip('.tmp-package', { saveTo: 'easyappointments-wp.zip' }, function (err, buffer) {
        if (err) {
            console.log('Zip Error', err);
        }
        done();
    });
});

/**
 * Generate Code Documentation (ApiGen)
 */
gulp.task('doc', function(done) {
    fs.removeSync('doc/apigen');
    var command = 'php doc/apigen.phar generate -s "src" -d "doc/apigen" --exclude "*ea-vendor*" '
            + '--todo --template-theme "bootstrap"'
    exec(command, function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
    });

    done();
});

/**
 * Execute the PHPUnit tests.
 */
gulp.task('test', function(done) {
    exec('phpunit test', function(err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
    });

    done();
});

/**
 * Development Task
 *
 * While developing the plugin this task will synchronize the changes made in the
 * "wp-content/plugins/easyappointments-wp" directory with the original plugin source
 * files that are finally commited to the repository.
 */
gulp.task('dev', function() {
    return sync('src', 'wordpress/wp-content/plugins/easyappointments-wp');
});
