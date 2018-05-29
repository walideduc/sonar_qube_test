# README



### What is this repository for?



### How do I get set up?

```
cp application/infrastructure/docker/transaction-worker/etc/environment.dist application/infrastructure/docker/transaction-worker/etc/environment
```

#### Run composer and run the app containers
```
docker-compose -f infrastructure/docker/docker-compose-build.yml up --build
docker-compose -f infrastructure/docker/docker-compose-local.yml up -d  --build
```

Head to http://localhost:8082

### Running the worker 
```
docker-compose -f infrastructure/docker/docker-compose-local.yml up transaction-worker
```

### Running test

```
docker-compose -f infrastructure/docker/docker-compose-test.yml up --build
```

### CI/CD url
https://jenkins.tsipayment.net/blue/organizations/jenkins/transaction-service/branches/

# HipChat Rooms
LAB/Risks
jenkins

# Environments
http://rec-int-transaction-service.rancher.lan
http://preprod-int-transaction-service.tsi.lan

# Rancher URL
http://rancher.tsi.lan:8080/


### Who do I talk to? ###
Jonathan Ferreira <jonathan.ferreira@tsi-payment.com>
Waled Abushuraitah <waled.shuraitah@tsi-payment.com@tsi-payment.com>
Mohamed keita <mohamed.keita@tsi-payment.com>


### Docker Registry
https://registry.tsipayment.net/v2/_catalog
https://registry.tsipayment.net/v2/{repository_name}/tags/list

For more details on the availiable endpoints go to https://github.com/docker/distribution/blob/master/docs/spec/api.md#detail

### Coding style
We follow the PSR1/PSR2 coding style

https://hackernoon.com/how-to-configure-phpstorm-to-use-php-cs-fixer-1844991e521f
https://github.com/FriendsOfPHP/PHP-CS-Fixer

``
php-cs-fixer fix --allow-risky yes
``

