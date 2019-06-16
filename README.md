## Installation

#### Configuration
Create **.env** file from **.env.dist** example
```
cp .env.dist .env
```


#### Database
Set your database settings to **.env** file
```
DATABASE_URL=mysql://db_username:db_password@127.0.0.1:3306/db_name
```

#### Generate the SSH keys

You will enter **pass phrase** during installation
```bash
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

Put your **pass phrase** to **.env** file
```
JWT_PASSPHRASE=your-pass-phrase
```

#### Run migration
```
php bin/console doctrine:migrations:migrate
```

### All done, you are awesome!
