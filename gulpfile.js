var gulp = require('gulp'),
    exec = require('child_process').execSync,
    fs = require('fs-extra');

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
