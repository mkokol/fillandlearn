from fabric.api import local, env, cd
from fabric.operations import run, settings, put

# connect to EC2
env.host_string = 'ec2-54-194-205-17.eu-west-1.compute.amazonaws.com'
env.user = 'ubuntu'
env.key_filename = '../p/mk-ireland.pem'

def deploy():
    local("export COPYFILE_DISABLE=true")
    local("rm -rf app/cache/prod")
    local("rm -rf app/cache/dev")

    local("tar czf update-fill-and-learn.tar.gz app bin build components src vendor web build.xml composer.json composer.lock composer.phar")

    run("sudo rm -rf /var/www/fillandlearn.com.new")
    run("sudo rm -rf /var/www/fillandlearn.com.old")
    run("mkdir /var/www/fillandlearn.com.new");
    put("./update-fill-and-learn.tar.gz", "/var/www/fillandlearn.com.new/")

    with cd("/var/www/fillandlearn.com.new/"):
        run("tar -xzf update-fill-and-learn.tar.gz")
        run("rm update-fill-and-learn.tar.gz")
        run("chmod 777 -Rf ./app/cache")
        run("chmod 777 -Rf ./app/logs")

    run("mv /var/www/fillandlearn.com /var/www/fillandlearn.com.old")
    run("mv /var/www/fillandlearn.com.new /var/www/fillandlearn.com")

    with cd("/var/www/fillandlearn.com/"):
        run("php -r 'opcache_reset();'")
        run("php app/console assetic:dump --env=prod --no-debug")
        run("php vendor/phing/phing/bin/phing.php -Denv=prod")
        run("php composer.phar dump-autoload --optimize")
        run("sudo rm -rf app/cache/prod")
        run("sudo rm -rf app/cache/dev")

    run("sudo chown www-data:www-data -Rf /var/www/fillandlearn.com")

    run("php  -r 'opcache_reset();'")
    run("sudo service php5-fpm restart")

    local("rm update-fill-and-learn.tar.gz")
