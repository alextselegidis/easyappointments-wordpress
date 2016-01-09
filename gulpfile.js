var gulp = require('gulp'),
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
