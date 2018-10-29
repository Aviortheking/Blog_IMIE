var gulp = require('gulp');
var sftp = require('gulp-sftp');
var args = require("yargs").argv;

gulp.task('deploy', function() {
	if(args.password == undefined) return
	return gulp.src('project/**/*')
		.pipe(sftp({
			host: 'ftp.cluster020.hosting.ovh.net',
			user: 'deltawinbo',
			pass: args.password,
			remotePath: '/home/deltawinbo/blog'
		}));
});