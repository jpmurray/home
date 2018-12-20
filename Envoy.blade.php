@servers(['home' => ['jpmurray@192.168.1.115']])

@task('deploy', ['on' => 'home'])
    cd /home/jpmurray/home.jpmurray.net
	git pull origin master
	composer install --no-interaction --prefer-dist --optimize-autoloader
	php artisan migrate --force
@endtask