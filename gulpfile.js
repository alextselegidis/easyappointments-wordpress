var gulp = require('gulp'),
    sync = require('gulp-dir-sync'),
    exec = require('child_process').execSync,
    fs = require('fs-extra'),
    zip = require('zip-dir'),
    autoprefixer = require('gulp-autoprefixer')
    cssnano = require('gulp-cssnano'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

/**
 * Create a ZIP package for the plugin.
 */
gulp.task('build', ['styles', 'scripts'], function(done) {
    fs.removeSync('.tmp-package');
    fs.removeSync('easyappointments-wp.zip');
    fs.mkdirSync('.tmp-package');
    fs.copySync('src', '.tmp-package/easyappointments-wp');
    fs.copySync('LICENSE', '.tmp-package/easyappointments-wp/LICENSE');
    fs.copySync('doc/wp-readme.txt', '.tmp-package/easyappointments-wp/readme.txt');
    fs.copySync('doc/screenshot-1.png', '.tmp-package/easyappointments-wp/screenshot-1.png');
    fs.copySync('doc/screenshot-2.png', '.tmp-package/easyappointments-wp/screenshot-2.png');
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
 * Compile the JavaScript Files
 */
gulp.task('scripts', function() {
    return gulp.src([
        'src/assets/js/*.js',
        '!src/assets/js/*.min.js'
    ])
        .pipe(jshint({laxbreak: true}))
        .pipe(jshint.reporter('default'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('src/assets/js'));
});

/**
 * Compile the CSS Files
 */
gulp.task('styles', function() {
    return gulp.src([
        'src/assets/css/*.css',
        '!src/assets/css/*.min.css'
    ])
        .pipe(autoprefixer())
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('src/assets/css'));
});

/**
 * Development Task
 *
 * While developing the plugin this task will synchronize the changes made in the
 * "wp-content/plugins/easyappointments-wp" directory with the original plugin source
 * files that are finally committed to the repository.
 */
gulp.task('dev', ['styles', 'scripts'], function() {
    gulp.watch('src/assets/js/*.js', ['scripts']);
    gulp.watch('src/assets/css/*.css', ['styles']);
    return sync('src', 'wordpress/wp-content/plugins/easyappointments-wp');
});
