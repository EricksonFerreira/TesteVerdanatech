conf:
	sudo apt-get install php7.2 php7.2-mbstring php7.2-mysql php7.2-intl php7.2-xml composer
	composer install --no-scripts
	# npm install
	# npm run dev
	cp .env.example .env
	php artisan key:generate
	sudo apt-get install mysql-server-5.7
	$(MAKE) bd-conf

conf-git-erickson:
	git config user.email "erickson.rinho@hotmail.com"
	git config user.name "Erickson"

bd-conf:
	mysql -u root -p --execute="drop database if exists pei; create database pei; drop user if exists 'pei'; create user 'pei' identified by 'piadaruim'; grant all privileges on pei.* to 'pei';"
	sed -i 's/DB_DATABASE.*/DB_DATABASE=pei/' .env
	sed -i 's/DB_USERNAME.*/DB_USERNAME=pei/' .env
	sed -i 's/DB_PASSWORD.*/DB_PASSWORD=piadaruim/' .env
	php artisan migrate:refresh --seed