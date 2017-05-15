/**
 * Created by davidmaarek on 15/05/2017.
 */

var gulp = require("gulp");

var sass = require("gulp-sass");

gulp.task('sass', function () {
    return gulp.src('web/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('web/css'));
});

gulp.task('watch', function () {
    gulp.watch('web/sass/*.scss', ['sass']).on('change', function(event){
        console.log('Le fichier ' + event.path + ' a ete compile');
    })
});