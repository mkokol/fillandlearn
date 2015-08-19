from fabric.api import local, env, cd
from fabric.operations import run, settings, put

# connect to EC2
env.host_string = 'ec2-54-194-205-17.eu-west-1.compute.amazonaws.com'
env.user = 'ubuntu'
env.key_filename = '../p/mk-ireland.pem'

def deploy():
    local("php app/console cache:clear --env=dev --no-debug")
    local("php app/console cache:clear --env=prod --no-debug")
    local("tar czf update-fill-and-learn.tar.gz app bin build components logs src vendor web build.xml ")

    run("sudo rm -rf /var/www/fillandlearn.com.new");
    run("sudo rm -rf /var/www/fillandlearn.com.old");
    run("mkdir /var/www/fillandlearn.com.new");
    put("./update-fill-and-learn.tar.gz", "/var/www/fillandlearn.com.new/")

    run("php  -r 'opcache_reset();'")

    with cd("/var/www/fillandlearn.com.new/"):
        run("tar -xzf update-fill-and-learn.tar.gz")
        run("rm update-fill-and-learn.tar.gz")
        run("chmod 777 -Rf ./app/cache")
        run("chmod 777 -Rf ./app/logs")
        run("chmod 777 -Rf ./logs")
        run("php app/console assetic:dump --env=prod --no-debug")


    run("mv /var/www/fillandlearn.com /var/www/fillandlearn.com.old");
    run("mv /var/www/fillandlearn.com.new /var/www/fillandlearn.com");

    with cd("/var/www/fillandlearn.com/"):
        run("php vendor/phing/phing/bin/phing.php")

    run("php  -r 'opcache_reset();'")
    run("sudo service php5-fpm restart")

    local("rm update-fill-and-learn.tar.gz")


# composer install --no-dev --optimize-autoloader
